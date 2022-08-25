@extends('layouts.main', [
    'pageTitle' => 'Clientes'
])

@section('content')

    <div class="page page-customer page-details">

        <div class="page-header">
            <h1>Clientes <small>Detalhes do cliente</small></h1>
        </div>

        <div class="page-body">

            <ul>
                <li><b>Nome: </b>{{ $customer->name }}</li>
                <li><b>E-mail: </b>{{ $customer->email }}</li>
                <li><b>Endereço: </b>{{ $customer->address }}</li>
                <li><b>CPF: </b>{{ $customer->cpf }}</li>
                <li><b>RG: </b>{{ $customer->rg }}</li>
            </ul>

            <div class="page-controls">
                <a class="btn btn-outline-primary" ssshref="{{ url('customer') }}">Voltar</a>
            </div>

        </div>

    </div>

@endsection
