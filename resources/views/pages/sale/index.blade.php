@extends('layouts.main', [
    'pageTItle' => 'Vendas'
])

@section('content')

    <div class="page page-sale page-form">

        <div class="page-header">
            <h1>Vendas <small>Listagem de vendas</h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if ( count($sales) > 0 )

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Valor</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @foreach ($sales as $sale)

                        <tbody>

                            <tr>

                                <td>{{$sale->id}}</td>
                                <td>{{$sale->total}}</td>
                                <td>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('sale/'.$sale->id. '/products') }}">Detalhes</a>
                                    <a  class="btn btn-danger btn-sm" href="{{ url('sale/'.$sale->id. '/delete') }}">Remover</a>
                                </td>

                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else

                <div class="page-message">

                <h3>Nenhuma venda cadastrada</h3>

                </div>
            @endif

            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('sale/create') }}">Nova Venda</a>

            </div>

        </div>

    </div>

@endsection
