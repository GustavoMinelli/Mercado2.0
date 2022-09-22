@extends('layouts.main', [
    'pageTitle ' => 'Categorias'
])

@section('content')

    <div class="page page-customer page-details">


        <div class="page-header">
            <h1> Categorias <small> Detalhes da categoria </small></h1>
        </div>

        <div class="page-body">
            @foreach ($products as $product)

            <ul>
                <li><b>ID: </b>{{$product->id}}</li>
                <li><b>Nome: </b>{{$product->name}}</li>
                <li><b>Quantidade: </b>{{$product->current_qty}}</li>
            </ul>

            @endforeach

            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('categories') }}">Voltar</a>

            </div>



        </div>

    </div>

@endsection
