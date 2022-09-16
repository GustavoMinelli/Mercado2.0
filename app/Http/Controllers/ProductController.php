<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Exibir produtos cadastrados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $products = Product::orderBy('id', 'asc')->get();

        $data = [
            'products' => $products
        ];

        return view('pages.product.index', $data);
    }

    /**
     * Cria um formulario para criar um novo produto
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){

        $product = new Product();

        return $this->form($product);
    }

    /**
     * Carregar o formulario de editar para um produto
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id){

        $product = Product::find($id);

        return $this->form($product);
    }

    /**
     * Insere um novo produto no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request) {
        return $this->insertOrUpdate($request);
    }

    /**
     * Persistir atualizações de um produto no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        return $this->insertOrUpdate($request);
    }

    /**
     * Remover um produto
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id){

        try{

            DB::beginTransaction();

            $product = Product::find($id);

            if(!$product){
                throw new \Exception('Produto nao encontrado');

            }

            $this->preDelete();

            $product->delete();



            DB::commit();

            Session::flash('success', 'Produto removido com sucesso!');

        } catch (\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Não foi possivel remover o produto: '.$e->getMessage());

        }

        return redirect('products');
    }

    /**
     * Carregar o formulario para criar/editar um produto
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function form(Product $product){
        $categories = Category::get();
        $data = [
            'product' => $product,
            'categories'=>$categories,
        ];

        return view('pages.product.form', $data);
    }

    private function insertOrUpdate(Request $request) {

        $validator = $this->getInsertUpdateValidator($request);


        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return back()->withInput()->withErrors($error);

        } else {

            try{

                DB::beginTransaction();

                $isEdit = $request -> method() == 'PUT';

                $product = $isEdit ? Product::find($request->id) : new Product();

                $this->save($product, $request);

                DB::commit();


				Session::flash('success', 'O produto foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');


				return redirect('products');

            } catch (\Exception $e) {

                DB::rollBack();

                $error = $e->getMessage();

                return back()->withInput()->withErrors($error);
            }
        }
    }

    /**
     * Valida os dados do $request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    private function getInsertUpdateValidator(Request $request){

        $data = $request->all();

        $method = $request->method();

        $rules = [
            'name' => 'required|max:100',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|min:0.01',
        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:products,id'], function() use ($method) {
            return $method == 'PUT';
        });

        return $validator;
    }

    /**
     * Salvar alteraçoes de um produto
     *
     * @param Product $product
     * @param Request $request
     * @return void
     */
    private function save(Product $product, Request $request){


            $product->name = $request->name;
            $product->price = $request->price;

            $product->category_id = $request->category_id;

            $product->save();


    }

    /*Carrinho Teste*/

    public function addToCart(Request $request, $id) {

        $product = Product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart ->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado no carrinho com sucesso.');

    }

    public function updateCart(Request $request){

        if($request->id && $request->current_qty){
            $cart = session()->get('cart');

            Session::put('cart', $cart);

            Session::flash('success', 'Carrinho atualizado com sucesso.');
        }
    }

    public function deleteCart($id){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
            Session::flash('success', 'Carrinho removido com sucesso');
    }
    

    public function indexCart(){


        $products = Product::orderBy('id', 'asc')->get();

        $data = [
            'products' => $products
        ];

        return view('pages.cart.index', $data);
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('pages.cart.index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
