@extends('layouts.main', [
    'pageTitle' => 'Clientes'
])

@section('content')

    @php
        $isEdit = !empty($customer->id);
        $user = $customer->user ?? $customer;
    @endphp

    <div class="page page-customer page-form">

        <div class="page-header">
            <h1>Clientes <small>{{ $isEdit ? 'Editar cliente' : 'Novo cliente' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form method="POST" action="{{ url('customers') }}">

                @csrf

                @method($isEdit ? 'PUT' : 'POST')

                <input type="hidden" name="id" value="{{ $customer->id }}">

                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="name" value="{{ $user->name }}" maxlength="100" required />
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="email" name="email" value="{{ $user->email }}" required />
                </div>

                <div class="form-group">
                    <label>Endereço</label>
                    <input class="form-control" type="text" name="address" value="{{ $person->address }}" maxlength="250" required />
                </div>

                <div class="form-group">
                    <label>RG</label>
                    <input class="form-control" type="number" name="rg" value="{{ $person->rg }}" required />
                </div>

                <div class="form-group">
                    <label>CPF</label>
                    <input class="form-control" type="number" name="cpf" value="{{ $person->cpf }}" required />
                </div>

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

                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('customers') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>
                @endif



                </div>

            </form>

        </div>

    </div>

@endsection
