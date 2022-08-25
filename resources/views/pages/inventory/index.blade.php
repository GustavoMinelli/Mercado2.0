@extends('layouts.main', [
    'pageTitle' => 'Estoque'
])


@section('content')

    <div class="page page-inventory page-index">
        <div class="page-header">
            <h1>Estoque<small>Listagem de Estoques</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($inventories) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @foreach ($inventories as $inventory)

                        <tbody>

                            <tr>

                                <td>{{$inventory->id}}</td>

                                <td>{{$inventory->product->name}}</td>

                                <td>{{$inventory->qty}}</td>

                                <td>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('inventory/'.$inventory->id. '/delete') }}">Remover</a>
                                </td>

                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else
                <div class="page-message">
                    <h3>Não possui nenhum estoque criado</h3>
                </div>

            @endif

            <div class="page-controls">
                <a  class="btn btn-primary btn-sm" href="{{ url('inventory/create') }}">Criar um novo estoque</a>
            </div>

        </div>

    </div>

@endsection
