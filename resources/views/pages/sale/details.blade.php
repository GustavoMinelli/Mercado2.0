@extends('layouts.main', [
    'pageTItle' => 'Vendas'
])

@section('content')

    <div class="page page-costumer page-details">

        <div class="page-header">
            <h2>Vendas <small>Produtos da Venda</small></h2>
        </div>

        <div class="page-body">

            @foreach ($sales as $sale)

            <ul>
                <li><b>ID:</b>{{$sale->id}}</li>
                <li><b>Cliente: </b>{{$sale->client}}</li>
                <li><b>Funcionario: </b>{{$sale->employee}}</li>
                <li><b>Produto: </b>{{$sale->product}}</li>
                <li><b>Quantidade: </b>{{$sale->qty_sales}}</li>
                <li><b>Preço: </b>{{$sale->total_price}}</li>
            </ul>

            @endforeach

            <div class="page-controls">
                <a class="btn btn-outline-primary" href="{{ url('sales') }}">Voltar</a>

            </div>


        </div>

    </div>

@endsection
