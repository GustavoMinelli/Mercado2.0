<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    /**
     * Exibir categorias criadas
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $categories = Category::orderBy('id','asc')->get();

        $data = [
            'categories' => $categories
        ];

        return view('pages.category.index', $data);
    }

    /**
     * Exibe dados da categoria
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id){

        $category = Category::find($id);

        $products = $category->products;

        $data = [
            'category' => $category,
            'products' => $products
        ];

        return view('pages.category.details', $data);
    }



    /**
     * Criar uma nova categoria
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create() {

        $category = new Category();

        return $this->form($category);
    }


    /**
     * Carrega o formulario para editar uma categoria
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id){

        $category = Category::find($id);

        return $this->form($category);

    }


    /**
     * Insere uma nova categoria no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request){
        return $this->insertOrUpdate($request);
    }


    /**
     * Persistir atualizações de uma categoria no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        return $this->insertOrUpdate($request);
    }

    /**
     * Deletar uma categoria
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(int $id) {

        try {

            DB::beginTransaction();

            $category = Category::find($id);

            if(!$category) {
                throw new \Exception('Categoria não encontrada.');

            }
            $this->preDelete($category);



            $category->delete();

            DB::commit();

            Session::flash('success', 'Categoria removida com sucesso.');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Não foi possivel remover a categoria: '.$e->getMessage());
        }

        return redirect('categories');
    }

    private function preDelete(Category $category){

        $products = $category->products;

        foreach($products as $product) {

            $promotions = $product->promotions;

            $promotions->each->delete();

            if($product->sales = []) {
                throw new \Exception('Não foi possivel excluir');

            }


        }

        $products->each->delete();


    }


    /**
     * Carregar o formulario para criar/editar uma categoria
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function form (Category $category){

        $data = [
            'category' => $category,
        ];

        return view('pages.category.form', $data);
    }

    /**
     * Inserir ou atualizar a categoria no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insertOrUpdate(Request $request){

        $validator = $this->getInsertUpdateValidator($request);

        if($validator->fails()) {

            $error = $validator->errors()->first();

            // Retornar para a tela do form alertando um erro na validação
            return back()->withInput()->withErrors($error);

        } else {

            try {

                DB::beginTransaction();

                $isEdit = $request->method() == 'PUT';

                // Instanciar uma nova categoria ou obter referencia ja salva no banco de dados
                $category = $isEdit ? Category::find($request->id) : new Category();

                // Setar alterações
                $this->save($category, $request);

                DB::commit();

                Session::flash('success', 'A categoria foi'.($isEdit ? 'alterada' : 'criada'). ' com sucesso');

                // Retornar a lista de categorias
                return redirect('categories');
            } catch (\Exception $e){

                DB::rollBack();

                $error = $e->getMessage();

                // Retornar para a tela de formulario alertando um erro
                return back()->withInput()->withErrors($error);

            }
        }
    }

    /**
     * Valida dos dados do $request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    private function getInsertUpdateValidator(Request $request) {

        $data = $request->all();

        $method = $request->method();

        $rules = [
            'name' => ['required','max:250',]
        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:categories,id'], function() use ($method) {
            return $method == 'PUT';
        });

        return $validator;
    }

    private function save(Category $category, Request $request) {

        $category->name = $request->name;

        $category->save();
    }





}
    // public function update(Request $request){
    //     $category = Category::find($request->id);

    //     $validator = $this->validator($request);

    //     if($validator->fails()){

    //         return redirect('/edit/category/'.$category->id)->with('msg', 'Não foi possível editar: '.$validator->errors()->first());

    //     }
    //     else{

    //         $this->save($category, $request);

    //         return redirect('/categories')->with('msg', 'Editado com sucesso');

    //     }

    // }



    // private function validator(Request $request){

    //     $rules = [
    //         'name' => 'required|max:250'
    //     ];

    //     $msg = [
    //         'name.required' => 'nome necessário',
    //         'name.max' => 'nome inválido'
    //     ];

    //     $validator = Validator::make($request->all(), $rules, $msg);

    //     return $validator;
    // }

    // private function save(Category $category, Request $request){


    //     DB::beginTransaction();

    //     try{

    //         $category->name =$request->name;

    //         $category->save();

    //         DB::commit();

    //     }catch(Exception $e){

    //         DB::rollBack();
        // }



