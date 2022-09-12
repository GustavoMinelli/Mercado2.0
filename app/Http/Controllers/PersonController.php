<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Exibir clientes cadastrados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $people = Person::orderBy('id','asc')->get();
        $users = User::orderBy('id','asc')->get();

        $data = [
            'people' => $people,
            'users' => $users
        ];

        return view('pages.person.index', $data);
    }

    /**
     * Exibir funcionarios criados
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id){
        $person = Person::find($id);

        $data = [
            'person' => $person
        ];

        return view('pages.person.details', $data);

    }

    /**
     * Carrega um formulario para criar um novo funcionario
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){

        $person = new Person();


        return $this->form($person);
    }

    /**
     * Carrega um formulario para editar um funcionario
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id) {

        $person = Person::find($id);


        return $this->form($person);
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

            $person = Person::find($id);

            if (!$person) {
                throw new \Exception('Funcionario não encontrado');
            }

            $user = $person->user;


            $person->delete();

            $user->delete();

            DB::commit();

            Session::flash('sucess', 'Funcionario removido com sucesso');

        } catch (\Exception $e) {

            DB::rollBack();

            Session::flash('error', 'Nao foi possivel remover o cliente:' .$e->getMessage());

        }

        return redirect('people');


    }

    /**
     * Carrega um formulario para criar/editar uma pessoa
     *
     * @param Person $person
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    private function form(Person $person){

        $user = User::get();



        $data = [
            'person' => $person,
            'user' =>$user,
        ];

        return view('pages.person.form', $data);
    }

    /**
     * Inserir/atualizar um funcionario no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    private function insertOrUpdate(Request $request) {

        $validator = $this->getInsertUpdateValidator($request);

        // $user = Auth::user();

        if ($validator->fails()) {

            $error = $validator->errors()->first();

			// Retornar para a tela do formulário alertando um erro na validação da requisição
            return back()->withInput()->withErrors($error);

        } else {

            try {

				DB::beginTransaction();

				$isEdit = $request->method() == 'PUT';

				$person = $isEdit ? Person::where('id', $request->id)->first() : new Person();

				$user = $isEdit ? User::find($person->user->id) : new User();

				$this->save($person, $request, $user);

				DB::commit();

				Session::flash('success', 'O funcionario foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');

				// Redirecionar para a listagem de clientes
				return redirect('person');

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
            
        ];

        $validator = Validator::make($data, $rules);

        $validator->sometimes('id', ['required', 'integer', 'exists:people,id'], function() use ($method){
            return $method =='PUT';
        });

        return $validator;
    }
    /**
     * Salvar alteraçoes do funcionario
     *
     * @param Person $person
     * @param Request $request
     * @return void
     */
    private function save(Request $request, User $user, Person $person){


        $user->email = $request->email;
        if ($request->password) {

        $user->password = Hash::make($request->password);

        }

        $user->save();


        $person->name = $request->name;
        $person->rg = $request->rg;
        $person->phone = $request->phone;
        $person->gender = $request->gender;
        $person->address = $request->address;

        $person->save();

    }

}
