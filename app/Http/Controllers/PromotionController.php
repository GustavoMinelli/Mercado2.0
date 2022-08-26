<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    /**
     * Exibir promoções
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){

        $promotions = Promotion::orderBy('id','asc')->get();

        $data = [

            'promotions' => $promotions

        ];

        return view('pages.promotion.index', $data);

    }

    /**
     * Carrega um formulario para criar uma nova promoção
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){

        return $this->form(new Promotion());

    }

    /**
     * Carrega um formulario para editar uma promoção
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id){

        $promotion = Promotion::find($id);

        return $this->form($promotion);

    }

    /**
     * Insere uma nova promoção ao banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request) {

        return $this->insertOrUpdate($request);

    }

    public function update(Request $request){

        return $this->insertOrUpdate($request);

    }

    /**
     * Delete uma promoção
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(int $id){

        try {

            DB::beginTransaction();

            $promotion = Promotion::find($id);

            if (!$promotion){
                throw new \Exception('Promoção não cadastrada');
            }

            $promotion->delete();

            DB::commit();

            Session::flash('success', 'Promoção removida com sucesso!');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Não foi possivel remover a promoção '.$e->getMessage());
        }

        return redirect('/promotions');

    }

    /**
     * Carrega um formuario para criar/editar um produto
     *
     * @param Promotion $promotion
     * @return Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function form(Promotion $promotion){

        $products = Product::get();


        $data = [
            'products' => $products,
            'promotion' => $promotion,

        ];

        return view('pages.promotion.form', $data);

    }
    /**
     * Insere/Atualiza a promoção no banco de dados
     *
     * @param Request $request
     * @return void
     */
    private function insertOrUpdate(Request $request){

        $validator = $this->getInsertUpdateValidator($request);

        if($validator->fails()) {

            $error = $validator->errors()->first();

            return back()->withInput()->withErrors($error);

        }else {

            try{
                DB::beginTransaction();

                $isEdit = $request->method() == 'PUT';

				$promotion = $isEdit ? Promotion::find($request->id) : new Promotion();

				$this->save($promotion, $request);

				DB::commit();

				Session::flash('success', 'A promoção foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');

				return redirect('promotions');

			} catch (\Exception $e) {

				DB::rollBack();

				$error = $e->getMessage();

				return back()->withInput()->withErrors($error);
            }
        }
    }
    /**
     * VAlida os dados do $request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    private function getInsertUpdateValidator(Request $request){

        $data = $request->all();

        $method = $request->method();

        $rules = [

            'price'      => 'required|min:0.01',
            'started_at' => 'required|date:Y-m-d',
            'ended_at'   => 'required|date:Y-m-d'

        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:promotion,id'], function() use ($method){
            return $method =='PUT';
        });

        return $validator;
    }

    /**
     * Salva as alterações da promoçao
     *
     * @param Promotion $promotion
     * @param Request $request
     * @return void
     */
    private function save(Promotion $promotion, Request $request){

            $promotion->product_id = $request->product_id;
            $promotion->price = $request->price;
            $promotion->started_at = $request->started_at;
            $promotion->is_active = $request->is_active ?? false;
            $promotion->ended_at = $request->ended_at;

            $promotion->save();




    }


}
