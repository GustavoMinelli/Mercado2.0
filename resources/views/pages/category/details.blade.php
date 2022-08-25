@extends('layouts.main', [
    'pageTitle ' => 'Categorias'
])

@section('content')

    <div class="page page-customer page-detals">


        <div class="page-header">
            <h1> Categorias <small> Detalhes da categoria </small></h1>
        </div>

        <div class="page-body">
            @foreach ($products as $product)

            <ul>
                <li><b>ID: </b>{{$product->id}}</li>
                <li><b>Name: </b>{{$product->name}}</li>
                <li><b>ID: </b>{{$product->current_qty}}</li>
            </ul>

            @endforeach

            <div class="page-controls">
                <a class="btn btn-outline-primary" ssshref="{{ url('categories') }}">Voltar</a>

            </div>



        </div>

    </div>

@endsection
