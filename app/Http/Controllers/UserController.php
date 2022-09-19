<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Person;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{


    public function index(){

        $users = User::orderBy('id', 'asc')->get();
        // $person = Person::get();

        $data = [
            'users' => $users,
            // 'person' => $person
        ];

        return view('pages.user.index', $data);
    }

    public function show($id){

        $user = User::find($id);
        $person = Person::find($id);


        // $employees = $user->employees;



        $data = [
            'user' => $user,
            // 'employees' => $employees
            'person' => $person
        ];

        return view('pages.user.details', $data);
    }


    public function create(){

        $user = new User();

        // $person = new Person();

        return $this->form($user);
    }

    public function edit(int $id){

        $user = User::find($id);

        return $this->form($user);

    }

    public function insert(Request $request){

        return $this->insertOrUpdate($request);
    }

    public function update(Request $request){

        return $this->insertOrUpdate($request);
    }

    public function delete(int $id){

        try{
            DB::beginTransaction();

            $user = User::find($id);

            if(!$user) {
                throw new \Exception('Usuario nao encontrado');

            }
            // $this->preDelete($user);

            $user->delete();

            DB::commit();

            Session::flash('success', 'Usuario removido com sucesso');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Não foi possivel remover o Usuario' .$e->getMessage());
        }

        return redirect('users');

    }

    private function preDelete(User $user){

        $people = $user->people;

        $people->each->delete();


        // if($user->employees=[]){
        //     throw new \Exception('Nao foi possivel excluir');

        // }

    }

    public function form(User $user){

        $people = Person::get();
        $employees = Employee::get();
        $managers = Manager::get();
        $customers = Customer::get();

        $data = [
            'user'=>$user,
            'people'=>$people,
            'employees'=>$employees,
            'managers'=>$managers,
            'customers' => $customers
        ];

        return view('pages.user.form', $data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return object
     */
    public function insertOrUpdate(Request $request){

        $validator = $this->getInsertUpdateValidator($request);

        if($validator->fails()) {

            $error = $validator->errors()->first();

            return back()->withInput()->withErrors($error);

        }else{

            try{
                DB::beginTransaction();

                $isEdit = $request->method() == 'PUT';

                $user = $isEdit ? User::find($request->id) : new User();

                // $person = $isEdit ? Person::where('id', $request->id)->first() : new Person();


                $this->save($user, $request);

                DB::commit();


                Session::flash('sucess', 'O usuario foi'.($isEdit ? 'alterado' : 'criado'). ' com sucesso');


                return redirect('users');

            } catch(\Exception $e){

                DB::rollBack();

                $error = $e->getMessage();

                return back()->withInput()->withErrors($error);
            }
        }
    }

    private function getInsertUpdateValidator(Request $request){

        $data = $request->all();

        $method =  $request->method();
        
        $rules = [
            'email' => ['required'],
            'password' => ['required']
        ];

        $validator = FacadesValidator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:users,id'], function() use ($method){
            return $method == 'PUT';
        });

        return $validator;


    }

    public function save(User $user, Request $request) {

        $user->email = $request->email;

        $user->employee_id = $request->employee_id;

        $user->customer_id = $request->customer_id;

        $user->manager_id = $request->manager_id;

        if ($request->password) {
        
        $user->password = Hash::make($request->password);

        }

        $user->save();
    }
}
