@extends('layouts.main', [
    'pageTitle' => 'Gerente'
])

@section('content')

    @php
        $isEdit = !empty($user->id);
        $user = $manager->user ?? $manager;
        $person = $manager->person ?? $manager;
    @endphp

    <div class = "page page-manager page-form">

        <div class="page-header">
            <h1>Gerente<small>{{$isEdit ? 'Editar gerente' : 'Novo gerente '}}</small></h1>
        </div>

        <div class = "page-body">

            @include('components.alert')

            <form action="{{url ('managers') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{$manager->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $person->name) }}">
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label>Senha: </label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label>Confirmar senha: </label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control" >
                </div>
                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('managers') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>
                    
                </div>

            </form>
        </div>
    </div>
@endsection
