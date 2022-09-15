@extends('layouts.main', [
    'pageTitle' => 'Pessoa'
])

@section('content')

    @php
        $isEdit = !empty($user->id);
        // $user = $person->user ?? $person;
    @endphp

    <div class="page page-user page-form">
        

        <div class="page-header">
            <h1>Usuario<small>{{ $isEdit ? ' Editar usuario' : ' Novo usuario' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('users') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $user->id }}">

               

                <div class="form-group person">
                    <label>Pessoa </label>
                    <select name="person_id" class="form-select person" required>

                        @if (count($people) > 0)

                            @foreach ($people as $person)

                            <option>Selecione a pessoa</option>


                            <option value="{{ $person->id }}">{{ $person->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhuma pessoa criada</option>

                        @endif

                    </select>

                </div>
                
                {{-- <div class="form-check">
                    <input class="form-check-input employee" type="checkbox" value="" required="employee_id">
                    <label class="form-check-label" for="employee_id">
                      Funcionario
                    </label>
                </div> --}}
                <div class="form-group person">
                    <label>Funcionario </label>
                    <select name="employee_id" class="form-select" required>

                        @if (count($employees) > 0)

                            @foreach ($employees as $employee)

                            <option>Selecione o funcionario</option>


                            <option value="{{ $employee->id }}">{{ $person->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhum funcionario criado</option>

                        @endif

                    </select>
                </div>

                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Cliente
                    </label>
                </div> --}}

                <div class="form-group person">
                    <label>Cliente </label>
                    <select name="customer_id" class="form-select" required>

                        @if (count($customers) > 0)

                            @foreach ($customers as $customer)

                            <option>Selecione o cliente</option>


                            <option value="{{ $customer->id }}">{{ $person->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhum cliente criado</option>

                        @endif

                    </select>
                </div>

                
                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Cliente
                    </label>
                </div> --}}
                  
                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Gerente
                    </label>
                </div> --}}

                <div class="form-group person">
                    <label>Gerente </label>

                    <select name="manager_id" class="form-select" required>

                        @if (count($managers) > 0)

                            @foreach ($managers as $manager)

                            <option>Selecione o gerente</option>


                            <option value="{{ $manager->id }}">{{ $person->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhum gerente criado</option>

                        @endif

                    </select>
                </div>
                
                
                

                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                </div>
                
                {{-- <input type="checkbox" name="funcionario" value="{{$employee->id}}"> --}}

                
                @if($isEdit)
                
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password"required>
                </div>
                
            @else

                <div class="form-group">

                    <label for="password">Senha</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                </div>

                <div class="form-group">

                    <label for="password-confirm">Confirmar senha</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required valuye>

                </div>

            @endif
                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('people') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                </div>

            </form>

        </div>

    </div>
@endsection
