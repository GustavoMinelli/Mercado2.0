<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeRoleController extends Controller
{

    /**
     * Exibir cargos criados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $employeeroles = EmployeeRole::orderBy('id','asc')->get();

        $data = [
            'employeeroles' => $employeeroles
        ];

        return view('pages.employee-role.index', $data);
    }

    /**
     * Exibe dados do cargo
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id){

        $employeerole = EmployeeRole::find($id);

        $employees = $employeerole->employees;

        $data = [
            'employeerole' => $employeerole,
            'employees' => $employees
        ];

        return view('pages.employee-role.details', $data);
    }



    /**
     * Criar um novo cargo
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create() {

        $employeerole = new EmployeeRole();

        return $this->form($employeerole);
    }


    /**
     * Carrega o formulario para editar um cargo
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id){

        $employeerole = EmployeeRole::find($id);

        return $this->form($employeerole);

    }


    /**
     * Insere um novo cargo no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request){
        return $this->insertOrUpdate($request);
    }


    /**
     * Persistir atualizações de um cargo no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        return $this->insertOrUpdate($request);
    }

    /**
     * Deletar um cargo
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(int $id) {

        try {

            DB::beginTransaction();

            $employeerole = EmployeeRole::find($id);

            if(!$employeerole) {
                throw new \Exception('Cargo não encontrado.');

            }
            $this->preDelete($employeerole);



            $employeerole->delete();

            DB::commit();

            Session::flash('success', 'Cargo removido com sucesso.');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Não foi possivel remover o cargo: '.$e->getMessage());
        }

        return redirect('roles');
    }

    private function preDelete(EmployeeRole $employeerole) {

        $employees = $employeerole->employees;

        // foreach($employees as $employee) {

        //     $promotions = $product->promotions;

        //     $promotions->each->delete();

        //     if($product->sales = []) {
        //         throw new \Exception('Não foi possivel excluir');

        //     }


        // }

        // $employees->each->delete();


    }


    /**
     * Carregar o formulario para criar/editar um cargo
     *
     * @param EmployeeRole $role
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function form (EmployeeRole $employeerole){

        $data = [
            'employeerole' => $employeerole,
        ];

        return view('pages.employee-role.form', $data);
    }

    /**
     * Inserir ou atualizar o cargo no banco de dados
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

                $employeerole = $isEdit ? EmployeeRole::find($request->id) : new EmployeeRole();

        
                $this->save($employeerole, $request);

                DB::commit();

                Session::flash('success', 'O cargo foi'.($isEdit ? 'alterado' : 'criado'). ' com sucesso');

                return redirect('roles');
            } catch (\Exception $e){

                DB::rollBack(); 

                $error = $e->getMessage();

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

        $validator->sometimes('id', ['required', 'integer', 'exists:employee_roles,id'], function() use ($method) {
            return $method == 'PUT';
        });

        return $validator;
    }

    private function save(EmployeeRole $employeerole, Request $request) {

        $employeerole->name = $request->name;

        $employeerole->save();
    }





}
