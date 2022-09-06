<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Exibir clientes cadastrados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $employees = Employee::orderBy('id','asc')->get();
        $users = User::orderBy('id','asc')->get();

        $data = [
            'employees' => $employees,
            'users' => $users
        ];

        return view('pages.employee.index', $data);
    }

    /**
     * Exibir funcionarios criados
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id){
        $employee = Employee::find($id);

        $data = [
            'employee' => $employee
        ];

        return view('pages.employee.details', $data);

    }

    /**
     * Carrega um formulario para criar um novo funcionario
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){

        $employee = new Employee();


        return $this->form($employee);
    }

    /**
     * Carrega um formulario para editar um funcionario
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id) {

        $employee = Employee::find($id);


        return $this->form($employee);
    }

    /**
     * Inserir novo funcionario no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request){

        // dd('ola');
        return $this->insertOrUpdate($request);
    }

    /**
     * Persistir atualizações de um funcionario no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        return $this->insertOrUpdate($request);
    }

    /**
     * Remover funcionario
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(int $id){

        try {

            DB::beginTransaction();

            $employee = Employee::find($id);

            if (!$employee) {
                throw new \Exception('Funcionario não encontrado');
            }

            $user = $employee->user;


            $employee->delete();

            $user->delete();

            DB::commit();

            Session::flash('sucess', 'Funcionario removido com sucesso');

        } catch (\Exception $e) {

            DB::rollBack();

            Session::flash('error', 'Nao foi possivel remover o cliente:' .$e->getMessage());

        }

        return redirect('employees');


    }

    /**
     * Carrega um formulario para criar/editar um cliente
     *
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    private function form(Employee $employee){

        $user = User::get();

        // dd($employee);


        $data = [
            'employee' => $employee,
            'user' =>$user,
        ];

        return view('pages.employee.form', $data);
    }

    /**
     * Inserir/atualizar um funcionario no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    private function insertOrUpdate(Request $request) {

        $validator = $this->getInsertUpdateValidator($request);

        $user = Auth::user();

        if ($validator->fails()) {

            $error = $validator->errors()->first();

			// Retornar para a tela do formulário alertando um erro na validação da requisição
            return back()->withInput()->withErrors($error);

        } else {

            try {

				DB::beginTransaction();

				$isEdit = $request->method() == 'PUT';

				$employee = $isEdit ? Employee::where('id', $request->id)->first() : new Employee();

				$user = $isEdit ? User::find($employee->user->id) : new User();

				$this->save($employee, $request, $user);

				DB::commit();

				Session::flash('success', 'O funcionario foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');

				// Redirecionar para a listagem de clientes
				return redirect('employees');

			} catch (\Exception $e) {

				DB::rollBack();

				$error = $e->getMessage();

				// Retornar para a tela de formulário alertando um erro interno
				return back()->withInput()->withErrors($error);
			}
        }
    }

    /**
     * Valida os dados do $request
     *
     * @param Request $request
     * @return object
     */
    private function getInsertUpdateValidator(Request $request) {

        $data = $request->all();

        $method = $request->method();

        $rules = [
            'name' => ['required', 'max:250'],
            'email' => ['required', 'email'],
            'rg' => ['required', 'string', 'max:14'],
            'cpf' => ['required', 'string', 'max:14'],
            'address' => ['required', 'string', 'max:250'],
            'phone' => ['required', 'string', 'max:14'],
            'work_code' => ['required', 'string'],

        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:employees,id'], function() use ($method){
            return $method =='PUT';
        });

        return $validator;
    }
    /**
     * Salvar alteraçoes do funcionario
     *
     * @param Employee $employee
     * @param Request $request
     * @return void
     */
    private function save(Employee $employee, Request $request, User $user){

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {

        $user->password = Hash::make($request->password);

        }

        $user->save();

        $employee->address = $request->address;
        $employee->cpf = $request->cpf;
        $employee->rg = $request->rg;
        $employee->phone = $request->phone;
        $employee->work_code = $request->work_code;
        $employee->user_id = $user->id;
        $employee->is_new = false;

        $employee->save();

    }

}

        // private function validator(Request $request){

        //     $rules = [
        //         'name' => 'required|max:100',
        //         'address' => 'required|max:250',
        //         'cpf' => 'required|string|max:14',
        //         'rg' => 'required|string|max:14',
        //         'email' => 'required|email',
        //         'phone' => 'required|string',
        //         'work_code' => 'required|string'
        //     ];

        //     $msg = [
        //         'name.required' => 'nome necessário',
        //         'name.max' => 'nome inválido',
        //         'email.required' => 'necessário um email para o cadastro',
        //         'email.email' => 'email inválido',
        //         'rg.required' => 'necessário um RG para o cadastro',
        //         'rg.max' => 'RG inválido',
        //         'cpf.required' => 'necessário um CPF para o cadastro',
        //         'cpf.max' => 'CPF inválido',
        //         'address.required' => 'necessário um endereço para o cadastro',
        //         'address.max' => 'endereço inválido',
        //         'work_code.required' => '',
        //         'work_code.' => ''
        //     ];

        //     $validator = Validator::make($request->all(), $rules, $msg);

        //     return $validator;
        // }
