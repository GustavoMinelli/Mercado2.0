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
                                <td><a class="btn btn-outline-secondary" href="{{url('category/'.$product->category->id.'/products')}}">{{ $product->category->name }}</td>
                                <td>{{ $product->current_qty }}</td>
                                {{-- @dd($product->current_qty) --}}
                                <td>
                                    <a class="btn btn-primary btn-sm" href={{ url ('product/'.$product->id. '/edit') }}>Editar</a>
                                    <a class="btn btn-primary btn-sm" href="{{ url ('product/'.$product->id. '/delete') }}">Deletar</a>
                                </td>

                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else
                <div class="page-message">
                    <h3>Nenhum produto cadastrado</h3>
                </div>
            @endif
            <div class="page-controls">
                <a class="btn btn-primary btn-sm" href={{ url ('product/create') }}>Novo produto</a>
            </div>

        </div>

    </div>

@endsection
