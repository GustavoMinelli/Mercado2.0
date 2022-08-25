<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductsSale;
use App\Models\Promotion;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class SaleController extends Controller
{
    /**
     * Exibir vendas cadastradas
     *
     * @return  \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $sales = Sale::orderBy('id', 'asc')->get();

        $data = [
            'sales' =>$sales
        ];

        return view('pages.sale.index', $data);
    }

    /**
     * Exibe os dados de uma venda
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id){

        $sales = Sale::search($id)->get();

        $data = [
            'sales' => $sales
        ];

        return view('pages.sale.details', $data);
    }

    /**
     * Carrega um formulario para criar uma venda
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){

        $sale = new Sale();

        return $this->form($sale);

    }



    public function insert(Request $request){

        return $this->insertOrUpdate($request);

    }

    public function update(Request $request){

        return $this->insertOrUpdate($request);

    }

    public function delete(int $id){

        try {

            DB::beginTransaction();

            $sale = Sale::find($id);

            if(!$sale) {
                throw new \Exception('Venda nao encontrada');
            }

            $this->preDelete();

            $sale->delete();

            DB::commit();

            Session::flash('sucess', 'Venda removida com sucesso');

        } catch (\Exception $e) {

            DB::rollBack();

            Session::flash('error', 'Nao foi possivel remover a venda' .$e->getMessage());
        }

        return redirect('sales');



    }

    public function form(Sale $sale){

        $products = Product::orderBy('id','asc')->get();
        $customers = Customer::get();
        $employees = Employee::get();

        $data = [
            'customers' => $customers,
            'employees' => $employees,
            'sale' => $sale,
            'products' => $products

        ];

        return view('pages.sale.form', $data);
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

                $sale = $isEdit ? Sale::find($request->id) : new Sale();

                $this->save($sale, $request);

                DB::commit();

                Session::flash('success', 'A venda foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');

                return redirect('sales');


            } catch (\Exception $e) {

                DB::rollBack();

                $error = $e->getMessage();

                return back()->withInput()->withErrors($error);

            }
        }
    }

    // private function InsertOnly(Request $request){

    //     $validator = $this->getInsertOnlyValidator($request);

    //     if($validator->fails()) {

    //         $error = $validator->errors()->first();

    //         return back()->withInput()->withErrors($error);


    //     }else {

    //         try{

    //             DB::beginTransaction();

    //             $sale = Sale::find($request->id);

    //             $this->save($sale, $request);

    //             DB::commit();

    //             Session::flash('success', 'A venda foi criada com sucesso');

    //             return('sales');

    //         }catch (\Exception $e) {

    //             DB::rollBack();

    //             $error = $e->getMessage();

    //             return back()->withInput()->withErrors($error);

    //         }
    //     }
    // }

    // private function getInsertOnlyValidator(Request $request){

    //     $data = $request->all();


    //     $rules = [
    //         'customer_id' => 'required',
    //         'employee_id' => 'required',
    //         'product_id'  => 'required',
    //         // 'product_qty' => 'required'

    //     ];

    //     $validator = Validator::make($data, $rules);

    //     return $validator;
    // }

    private function getInsertUpdateValidator(Request $request){

        $data = $request->all();

        $method = $request->method();

        $rules = [
            'customer_id' => 'required',
            'employee_id' => 'required',

        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:sales,id'], function() use ($method){
            return $method == 'PUT';
        });

        return $validator;
    }





    private function save(Sale $sale, Request $request){

        // $sale->customer_id = $request->customer_id;
        // $sale->employee_id = $request->employee_id;

        // $products = $request->product_id;

        // $sale->save();

        // foreach($products as $k => $product){
        DB::beginTransaction();
        try{

            $sale->customer_id = $request->customer_id;
            $sale->employee_id = $request->employee_id;

            $products = $request->product_id;

            $sale->save();

            foreach($products as $k => $product){

                $product = Product::find($product);

                $price = Promotion::searchPrice($product)->first();

                if($request->qty_sales[$k]){

                    $qty_sale = (int)$request->qty_sales[$k];


                    if(isset($price->is_active)){
                        $total_price = $qty_sale * $price->promotion;
                    }
                    else {
                        $total_price = $qty_sale * $price->product;
                    }

                    // dd(isset($price->is_active));
                    $attachArray = [
                        'qty_sales' => $qty_sale,
                        'total_price' => $total_price
                    ];

                    $sale->products()->attach($product->id, $attachArray);

                    $product->decrement('current_qty', $qty_sale);

                    $sale->increment('total',$total_price);

                }

            }

            DB::commit();

        } catch(Exception $e){

            dd($e);

            DB::rollBack();

        }

    }

    // private function preDelete(Request $request);

    // $sale
}
