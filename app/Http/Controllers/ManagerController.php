<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    /**
     * Exibir gerentes cadastrados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */ 
    public function index(){
        $managers = Manager::orderBy('id', 'asc')->get();
        $users = User::orderBy('id', 'asc')->get();
        $people = Person::orderBy('id', 'asc')->get();

        $data = [
            'managers' => $managers,
            'users' => $users,
            'people' => $people
        ];

        return view('pages.manager.index', $data);

    }

    public function show(int $id){

        $people = Person::find($id);
        $managers =  Manager::find($id);
        $users = User::find();
        // dd($users);

        $data = [
            'managers' => $managers,
            'people' => $people,
            'users' => $users,
        ];

        return view('pages.manager.details', $data);

    }

    public function create(){

        $manager = new Manager();

        return $this->form($manager);
    }

    public function edit(int $id){

        $manager = Manager::find($id);

        return $this->form($manager);

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

            $manager = Manager::find($id);

            if (!$manager) {
                throw new \Exception('Gerente não encontrado');

            }
            $person = $manager->person;

            $user = $manager->user;

            $manager->delete();
            
            $user->delete();
            
            $person->delete();

            DB::commit();

            Session::flash('success', 'Gerente removido com sucesso');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Nao foi possivel remover o gerente:' .$e->getMessage());
        }

        return redirect('/managers');

    }

    private function form(Manager $manager){

        $user = User::get();
        $people = Person::get();

        $data = [
            'user' => $user,
            'manager'=>$manager,
            'people' => $people
        ];

        return view('pages.manager.form', $data);
    }

    private function insertOrUpdate(Request $request) {

        $validator = $this->getInsertUpdateValidator($request);

        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return back()->withInput()->withErrors($error);

        } else {

            try {

                DB::beginTransaction();

                $isEdit = $request->method() == 'PUT';

                $manager = $isEdit ? Manager::find('id'. $request->id) : new Manager();

                $user = $isEdit ? User::find($manager->user->id) : new User();

                $person = $isEdit ? Person::where($request->id) : new Person();


                $this->save($manager, $user, $request, $person);

                DB::commit();

                Session ::flash('sucess', 'O gerente foi ', ($isEdit ? 'aleterado' : 'criado'). ' com sucesso!');

                return redirect('/managers');

            } catch(\Exception $e) {
                DB::rollBack();

                $error = $e->getMessage();

                return back()->withInput()->withErrors($error);

            }
        }
    }

    private function getInsertUpdateValidator(Request $request) {

        $data = $request->all();

        $method = $request->method();

        $rules = [
            // 'name' => ['required'],
            // 'email' => ['required', 'email'],
            // 'password' => ['required', 'confirmed']
            'person_id' => ['required']

        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:users,id'], function() use ($method) {
            return $method == 'PUT';

        });

        return $validator;
    }

    private function save(Manager $manager, User $user, Request $request, Person $person) {

        // $user->email = $request ->email;
        //  if ($request->password) {
        //      $user->password =  Hash::make($request->password);
        // }

        // $user->save();


        // $person->name = $request->name;
        // $person->rg = $request->rg;
        // $person->phone = $request->phone;
        // $person->gender = $request->gender;
        // $person->address = $request->address;

        // $person->save();

        $manager->person_id = $request->person_id;

        $manager->is_new = false;
        $manager->save();



    }
}

