@extends('layouts.main', [
    'pageTitle' => 'Funcionarios'
])

@section('content')

    @php
        $isEdit = !empty($employee->id);
        $user = $employee->user ?? $employee;
        $person = $employee->person ?? $employee;
    @endphp

    <div class="page page-employee page-form">

        <div class="page-header">
            <h1>Funcionarios<small>{{ $isEdit ? 'Editar funcionario' : 'Novo Funcionario' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('employees') }}" method="POST">


                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $employee->id }}">

                {{-- @dd($employee) --}}
{{-- 
                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $person->name) }}">
                </div>


                <div class="form-group">
                    <label>Endereço: </label>
                    <input type="text" class="form-control" name="address" required value="{{ old('adress', $person->address) }}">
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ $user->email}}">
                </div>


                <div class="form-group">
                    <label>Telefone: </label>
                    <input type="number" class="form-control" name="phone" required value="{{ old('phone', $person->phone) }}">
                </div>

                <div class="form-group">
                    <label>CPF: </label>
                    <input type="number" class="form-control" name="cpf" required value="{{ old('cpf', $person->cpf ) }}">
                </div>

                <div class="form-group">
                    <label>RG: </label>
                    <input type="number" class="form-control" name="rg" required value="{{ old('rg', $person->rg ) }}">
                </div> --}}

                <div class="form-group">
                    <label>Carteira de trabalho</label>
                    <input class="form-control" type="number" name="work_code" value="{{ $employee->work_code }}" required />
                </div>  

                <div class="form-group">
                    <label>Cargo: </label>
                    <select name="role_id" class="form-select" required>

                        @if (count($roles) > 0)

                            @foreach ($roles as $role)

                            <option>Selecione o cargo</option>


                            <option value="{{ $role->id }}">{{ $role->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhum cargo criado</option>

                        @endif

                    </select>

                </div>

                <div class="form-group">
                    <label>Pessoa </label>
                    <select name="person_id" class="form-select" required>

                        @if (count($people) > 0)

                            @foreach ($people as $person)

                            <option>Selecione a pessoa</option>


                            <option value="{{ $person->id }}">{{ $person->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhuma pessoa criado</option>

                        @endif

                    </select>

                </div>
{{-- 
                <div class="form-group">
                    <label>Carteira de trabalho</label>
                    <input type="text" class="form-control" name="work_code" required value="{{ old('work_code', $employee->work_code) }}">
                </div> --}}
{{-- 
            @if($isEdit)

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password"id="password"required>
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

            @endif --}}
                <div class="page-controls">

                    <a class="btn btn-primary" href="{{ url('employees') }}">Voltar</a>

                    <button type="submit" class="btn btn-primary">Enviar</button>

                </div>

            </form>

        </div>

    </div>
@endsection
