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
            <li><b>Nome: </b>{{ $employee->person->name }}</li>
            <li><b>Endereço: </b>{{ $employee->person->address }}</li>
            <li><b>CPF: </b>{{ $employee->person->cpf }}</li>
            <li><b>RG: </b>{{ $employee->person->rg }}</li>
        </ul>

        <div class="page-controls">
            {{-- @if (Auth::user()->role == 0)
                <a class="btn btn-outline-primary" href="{{ url('employees') }}">Voltar</a>
                <a class="btn btn-primary" href="{{ url('/employee/'. $employee->id .'/edit') }}">Editar</a>
            @else
            
            @endif --}}
            <a class="btn btn-primary" href="{{ url('employees') }}">Voltar</a>

            </div>

    </div>

</div>

@endsection                                {{-- <td><a href="/category/{{$product->category->id}}/products">{{ $product->category->name }}</td> --}}

