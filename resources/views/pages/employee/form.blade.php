@extends('layouts.main', [
    'pageTitle' => 'Funcionarios'
])

@section('content')

    @php
        $isEdit = !empty($employee->id);
    @endphp

    <div class="page page-employee page-form">

        <div class="page-header">
            <h1>Funcionarios<small>{{ $isEdit ? 'Editar cliente' : 'Novo Cliente' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{url ('employee') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $employee->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $user  <li><b>Funcionario: </b>{{$sale->employee}}</li>->name) }}">
                </div>

                <div class="form-group">
                    <label>Endereço: </label>
                    <input type="text" class="form-control" name="address" required value="{{ old('adress', $employee->address) }}">
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label>Telefone: </label>
                    <input type="number" class="form-control" name="phone" required value="{{ old('phone', $employee->phone) }}">
                </div>

                <div class="form-group">
                    <label>CPF: </label>
                    <input type="number" class="form-control" name="cpf" required value="{{ old('cpf', $employee->cpf) }}">
                </div>

                <div class="form-group">
                    <label>RG: </label>
                    <input type="number" class="form-control" name="rg" required value="{{ old('rg', $employee->rg) }}">
                </div>

                <div class="form-group">
                    <label>Carteira de trabalho</label>
                    <input type="number" class="form-control" name="work_code" required value="{{ old('work_code', $employee->work_code) }}">
                </div>
                @if($isEdit)

                <div class="form-group">
                    <label for="password">Confirme sua senha</label>
                    <input type="password" class="form-control" name="password"id="password"required>
                </div>

            @else

                <div class="form-group">

                    <label for="password">Senha</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                </div>

                <div class="form-group">

                    <label for="password-confirm">Confirmar senha</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                </div>

            @endif
                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('employees') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                </div>

            </form>

        </div>

    </div>
@endsection
