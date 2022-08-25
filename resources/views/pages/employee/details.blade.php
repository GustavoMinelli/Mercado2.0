@extends('layouts.main', [
    'pageTitle' => 'Funcionarios'
])

@section('content')

<div class="page page-employee page-details">

    <div class="page-header">
        <h1>Funcionarios <small>Detalhes do funcionario</small></h1>
    </div>

    <div class="page-body">

        <ul>
            <li><b>Nome: </b>{{ $employee->name }}</li>
            <li><b>E-mail: </b>{{ $employee->email }}</li>
            <li><b>Endereço: </b>{{ $employee->address }}</li>
            <li><b>CPF: </b>{{ $employee->cpf }}</li>
            <li><b>RG: </b>{{ $employee->rg }}</li>
        </ul>

        <div class="page-controls">
            <a class="btn btn-outline-primary" href="{{ url('employees') }}">Voltar</a>
        </div>

    </div>

</div>

@endsection                                {{-- <td><a href="/category/{{$product->category->id}}/products">{{ $product->category->name }}</td> --}}

