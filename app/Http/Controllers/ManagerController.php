<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    public function index(){
        $user = User::where('role',1)->orderBy('id', 'asc')->get();

        $data = [
            'user' => $user
        ];

        return view('pages.admin.index', $data);

    }

    public function show(int $id){

        $user = User::find($id);
        // dd($users);

        $data = [
            'user' => $user
        ];

        return view('pages.admin.details', $data);

    }

    public function create(){

        $admin = new User();

        return $this->form($admin);
    }
    public function edit(int $id){

        $admin = User::find($id);

        return $this->form($admin);

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

            if (!$user) {
                throw new \Exception('Admin não encontrado');

            }
            $user->delete();

            DB::commit();

            Session::flash('success', 'Admin removido com sucesso');

        } catch(\Exception $e){

            DB::rollBack();

            Session::flash('error', 'Nao foi possivel remover o Admin:' .$e->getMessage());
        }

        return redirect('/admins');

    }

    private function form(User $user){

        $data = [
            'user' => $user
        ];

        return view('pages.admin.form', $data);
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

                $admin = $isEdit ? User::find('id'. $request->id) : new User();

                $this->save($admin, $request);

                DB::commit();

                Session ::flash('sucess', 'O admin foi ', ($isEdit ? 'aleterado' : 'criado'). ' com sucesso!');

                return redirect('/admins');

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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed']

        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:users,id'], function() use ($method) {
            return $method == 'PUT';

        });

        return $validator;
    }

    private function save(User $user, Request $request) {

        $user->name = $request ->name;
        $user->email = $request ->email;
         if ($request->password) {
             $user->password =  Hash::make($request->password);
         }

        $user->role = 1;
        $user->save();
    }




}

