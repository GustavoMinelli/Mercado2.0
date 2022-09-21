@extends('layouts.main', [
    'pageTitle' => 'Pessoa'
])

@section('content')

    @php
        $isEdit = !empty($person->id);
        $user = $person->user ?? $person;
    @endphp

    <div class="page page-employee page-form">

        <div class="page-header">
            <h1>Pessoa<small>{{ $isEdit ? ' Editar pessoa' : ' Nova pessoa' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('people') }}" method="POST">


                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $person->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $person->name) }}">
                </div>


                <div class="form-group">
                    <label>Endereço: </label>
                    <input type="text" class="form-control" name="address" required value="{{ old('adress', $person->address) }}">
                </div>

                {{-- <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                </div> --}}


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
                </div>

                <div class="form-group">
                    <label>Genero: </label>
                        <select class="form-select" name="gender" >
                            <option>Selecione seu genero</option>
                            <option>Masculino</option>
                            <option>Feminino</option>
                            <option>Prefiro nao dizer</option>
                        </select>

                </div>

                {{-- <input type="checkbox" name="funcionario" value="{{$employee->id}}"> --}}


            {{-- @if($isEdit)

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

                    <a class="btn btn-primary" href="{{ url('people') }}">Voltar</a>

                    <button type="submit" class="btn btn-primary">Enviar</button>

                </div>

            </form>

        </div>

    </div>
@endsection
