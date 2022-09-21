@extends('layouts.main', [
        'pageTitle' => 'Categorias'
])


@section('content')

    @php
        $isEdit = !empty($category->id);
    @endphp

    <div class="page page-category page-form">

        <div class="page-header">
            <h1>Categoria<small>{{ $isEdit ? 'Editar categoria' : 'Nova categoria' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('categories') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{$category->id}}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input class="form-control" type="text" name="name" max="250" required value="{{$category->name }}">
                </div>

                <div class="page-controls">

                    <a class="btn btn-primary" href="{{ url('categories') }}">Voltar</a>

                    <button type="submit" class="btn btn-primary">Enviar</button>

                </div>

            </form>

        </div>

    </div>

@endsection
