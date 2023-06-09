<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Customer Controller
 *
 * @author Victor Noleto <victornoleto@sysout.com.br>
 * @since 22/08/2022
 * @version 1.0.0
 */
class CustomerController extends Controller {

    /**
     * Exibir clientes cadastrados
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function index() {

        $customers = Customer::orderBy('id','asc')->get();
        $people = Person::orderBy('id','asc')->get();
        $users = User::orderBy('id','asc')->get();

        $data = [
            'customers' => $customers,
            'people' => $people,
            'users' => $users,

        ];

        return view('pages.customer.index', $data);
    }

    /**
     * Exibir dados de um cliente
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id) {

        $customer = Customer::find($id);
        $user = User::find($id);
        $person = Person::find($id);

        $data = [
            'customer' => $customer,
            'user' => $user,
            'person' => $person,
        ];

        return view('pages.customer.details', $data);
    }

    /**
     * Carregar formulário para criar um novo cliente
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create() {

        $customer = new Customer();

        $person = new Person();

        $user = new User();

        return $this->form($customer, $person, $user);
    }

    /**
     * Carregar formulário para editar um cliente
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id) {

        $customer = Customer::find($id);
        
        return $this->form($customer);
    }

    /**
     * Inserir novo cliente no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request) {
        return $this->insertOrUpdate($request);
    }
    
    /**
     * Persistir atualizações de um cliente no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        return $this->insertOrUpdate($request);
    }
    
    /**
     * Remover cliente
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(int $id) {
        
        try {
            
            // Iniciar transação
            DB::beginTransaction();
            
            $customer = Customer::find($id);
            
            if (!$customer) {
                throw new \Exception('Cliente não encontrado!');
            }
            
            // É necessário fazer algo antes de remover o registro?
            // $this->preDelete(...);
            // $this->preDelete($customer);
            
            $customer->delete();
            
            // É necessário fazer algo após remover o registro?
            // $this->postDelete(...);
            
            DB::commit();
            
            Session::flash('success', 'Cliente removido com sucesso!');
            
        } catch (\Exception $e) {
            
            DB::rollBack();
            
            Session::flash('error', 'Não foi possível remover o cliente: '.$e->getMessage());
        }
        
        return redirect('customers');
    }
    
    // private function preDelete(Customer $customer){
        
    //     $user = $customer->user;

    //     $user->each->delete();
    // }
    /**
     * Carregar formulário para criar/editar um cliente
     *
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    private function form(Customer $customer) {
        
        $people = Person::get();

        $data = [
            'customer' => $customer,
            'people' => $people
        ];
        
        return view('pages.customer.form', $data);
    }
    
    /**
     * Inserir ou atualizar cliente no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    private function insertOrUpdate(Request $request) {
        
        $validator = $this->getInsertUpdateValidator($request);
        
        if ($validator->fails()) {
            
            $error = $validator->errors()->first();
            
			// Retornar para a tela do formulário alertando um erro na validação da requisição
            return back()->withInput()->withErrors($error);
            
        } else {
            
            try {
                
                DB::beginTransaction();
                
				$isEdit = $request->method() == 'PUT';
                
				// Instanciar um novo cliente ou obter referência já salva no banco de dados
				$customer = $isEdit ? Customer::find($request->id) : new Customer();
                
                $person = $isEdit ? Person::where('id', $request->id)->first() : new Person();
                
                $customerUser = $customer->user;
                
                $customerPerson = $customer->person;
                
                if (!$customer->id) {
                    $customerUser = new User();
                }

                if (!$person->id) {
                    $customerPerson = new Person();
                }
                
				// Setar alterações
				$this->save($customer, $request, $customerUser, $customerPerson);
                
				DB::commit();   
                
				Session::flash('success', 'O cliente foi '.($isEdit ? 'alterado' : 'criado'). ' com sucesso!');
                
				// Redirecionar para a listagem de clientes
				return redirect('customers');
                
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
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    private function getInsertUpdateValidator(Request $request) {
        
        $data = $request->all();
        
        $method = $request->method();
        
        $rules = [
            // 'name' => ['required', 'max:250'],
            // 'email' => ['required', 'email'],
            // 'rg' => ['required', 'string', 'max:14'],
            // 'cpf' => ['required', 'string', 'max:14'],
            // 'address' => ['required', 'string', 'max:250']
        ];
        
        $validator = Validator::make($data, $rules);
        
        $validator->sometimes('id', ['required', 'integer', 'exists:customers,id'], function() use ($method) {
            return $method == 'PUT';
        });
        
        // Regras mais específicas (menos genéricas)
        /* $validator->after(function($validator) use ($request) {
        }); */
        
        return $validator;
    }
    
    /**
     * Salvar alterações do cliente
     *
     * @param Customer $customer
     * @param Request $request
     * @return void
     */
    private function save(Customer $customer, Request $request, User $user, Person $person) {
        
        
        // $person->name = $request->name;
        // $person->rg = $request->rg;
        // $person->cpf = $request->cpf;
        // $person->phone = $request->phone;
        // $person->address = $request->address;
        // $person->gender = $request->gender;
        // $person->save();
        
        $customer->person_id = $request->person_id;
        $customer->is_new = false;
        $customer->save();
        
        // $user->email = $request->email;
        // $user->customer_id = $customer->id;
        
        // if ($request->password) {
        //     $user->password = Hash::make($request->password);
        // }
        
        // $user->save();
        // if (!$customer->person_id) {
            //     $customer->person_id = $person->id;
            // }
            
            
            
        }
        
        
}
