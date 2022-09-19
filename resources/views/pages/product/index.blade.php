@extends('layouts.main', [
    'pageTitle' => 'Produtos'
])


@section('content')




    <div class="page page-products page-index">
        <div class="page-header">
            <h1>Produtos<small> Listagem de produtos</small></h1>
        </div>

        <div class="page-body">

            @include("components.alert")

            @if (count($products) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    {{-- @foreach ($products as $k => $product) --}}
                    @foreach ($products as $k => $product)

                        <tbody>

                            {{-- @dd($product->category()->get()) --}}

                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td><a class="btn btn-outline-secondary" href="{{url('categories/'.$product->category->id.'/products')}}">{{ $product->category->name }}</td>
                                <td>{{ $product->current_qty }}</td>
                                <td>{{ $product->price }}</td>
                                {{-- @dd($product->current_qty) --}}

                                @if(Auth::check() && (Auth::user()->role == 'manager' || Auth::check() && (Auth::user()->role == 'employee' )))
                                <td>
                                    <a class="btn btn-primary btn-sm" href={{ url ('products/'.$product->id. '/edit') }}>Editar</a>
                                    <a class="btn btn-danger btn-sm" href="{{ url ('products/'.$product->id. '/delete') }}">Remover</a>
                                </td>

                                @else
                                <td>
                                    <a href="{{ url ('products/'.$product->id. '/cart') }}" class="btn btn-success pull-right" role="button">+</a>

                                    <a href="{{ url ('products/remove/'.$product->id. '/cart') }}" class="btn btn-danger" role="button">-</button>

                                </td>
                                @endif
                                

                                

                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else
                <div class="page-message">
                    <h3>Nenhum produto cadastrado</h3>
                </div>
            @endif

            {{-- @if(Auth::check() && (Auth::user()->role == 0 || Auth::check() && (Auth::user()->role == 1 ))) --}}
            <div class="page-controls">
                <a class="btn btn-primary" role="button" href={{ url ('products/create') }}>Novo produto</a>
            {{-- </div> --}}

            {{-- @else --}}
            {{-- <div class="page-controls"> --}}
                <a class="btn btn-primary" href="{{ url('/') }}">Voltar</a>
            </div>
            {{-- @endif --}}

        </div>

    </div>

@endsection
