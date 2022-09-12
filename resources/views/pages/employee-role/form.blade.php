@extends('layouts.main', [
        'pageTitle' => 'Cargos'
])


@section('content')

    @php
        $isEdit = !empty($employeerole->id);
    @endphp

    <div class="page page-employeerole" page-form">

        <div class="page-header">
            <h1>Cargo<small>{{ $isEdit ? 'Editar cargo' : 'Novo cargo' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('roles') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{$employeerole->id}}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input class="form-control" type="text" name="name" max="250" required value="{{$employeerole->name }}">
                </div>

                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('roles') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                </div>

            </form>

        </div>

    </div>

@endsection
