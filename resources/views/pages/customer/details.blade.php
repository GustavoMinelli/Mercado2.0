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
                <li><b>Nome: </b>{{ $customer->person->name }}</li>
                {{-- <li><b>E-mail: </b>{{ $customer->user->email }}</li> --}}
                <li><b>Endereço: </b>{{ $customer->person->address }}</li>
                <li><b>CPF: </b>{{ $customer->person->cpf }}</li>
                <li><b>RG: </b>{{ $customer->person->rg }}</li>
            </ul>

            <div class="page-controls">
                <a class="btn btn-primary" ssshref="{{ url('customers') }}">Voltar</a>
            </div>

        </div>

    </div>

@endsection
