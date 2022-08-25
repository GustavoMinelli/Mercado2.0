<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Exibir estoques cadastrados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $inventories = Inventory::orderBy('id','asc')->get();

        $data = [
            'inventories' => $inventories
        ];

        return view('pages.inventory.index', $data);
    }
    /**
     * Carregar um formulario para criar um novo produto
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){

        $inventory = new Inventory();

        return $this->form($inventory);
    }

    /**
     * Carregar formulário para editar um produto
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id){
        $inventory = Inventory::find($id);

        return $this->form($inventory);
    }

    /**
     * Inserir novo produto no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request){

        return $this->insertOrUpdate($request);

    }

     /**
     * Persistir atualizações de um produto no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        return $this->insertOrUpdate($request);


    }

    /**
     * Remover um produto no banco de dados
     *
     * @param [type] $id
     * @return @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete($id){

        try {

            DB::beginTransaction();

            $inventory = Inventory::find($id);

            if(!$inventory) {
                throw new \Exception('Estoque não encontrado!');
            }

            $product = Product::find($inventory->product_id);

            $product->decrement('current_qty', $inventory->qty);

            $inventory->delete();

            DB::commit();

            Session::flash('success', 'Estoque removido com sucesso');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Não foi possivel remover o estoque');


        }

        return redirect('/inventories');
    }

    /**
     * Carregar um formulario para criar/editar um estoque
     *
     * @param Inventory $inventory
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function form(Inventory $inventory){

        $products = Product::get();

        $data = [
            'inventory' => $inventory,
            'products' => $products
        ];

        return view('pages.inventory.form', $data);

    }

    /**
     * Inserir ou atualizar o estoque no banco de dados
     *
     * @param Request $request
     * @return object
     */
    private function insertOrUpdate(Request $request){

        $validator = $this->getInsertUpdateValidator($request);

        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return back()->withInput()->withErrors($error);

        } else {

            try {
                DB::beginTransaction();

                $isEdit = $request->method() == 'PUT';

                $inventory = $isEdit ? Inventory::find($request->id) : new Inventory();

                $this->save($inventory, $request);

                DB::commit();

                Session::flash('success', 'O estoque foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');

                return redirect('inventories');


            } catch (\Exception $e) {

                DB::rollBack();

                $error = $e->getMessage();

                return back()->withInput()->withErrors($error);

            }
        }
    }

    private function getInsertUpdateValidator(Request $request){

        $data = $request->all();

        $method = $request->method();

        $rules = [
            'qty' => ['required'],
            'created_at' => ['required']

        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:inventories,id'], function() use ($method){
            return $method == 'PUT';
        });

        return $validator;
    }

    private function save(Inventory $inventory, Request $request){



            $product = Product::find($request->product_id);

            $inventory->qty = $request->qty;

            $inventory->created_at = $request->created_at;

            $inventory->product_id = $request->product_id;

            $product->increment('current_qty', $request->qty);

            $inventory->save();



    }
}
