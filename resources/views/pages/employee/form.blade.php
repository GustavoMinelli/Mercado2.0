@extends('layouts.main', [
    'pageTitle' => 'Funcionarios'
])

@section('content')

    @php
        $isEdit = !empty($employee->id);
    @endphp

    <div class="page page-employee page-form">

        <div class="page-header">
            <h1>Funcionarios<small>{{ $isEdit ? 'Editar cliente' : 'Novo Cliente' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{url ('employee') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $employee->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="name" required value="{{ $employee->name }}">
                </div>

                <div class="form-group">
                    <label>Endereço: </label>
                    <input type="text" class="form-control" name="address" required value="{{ $employee->address }}">
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ $employee->email }}">
                </div>

                <div class="form-group">
                    <label>Telefone: </label>
                    <input type="number" class="form-control" name="phone" required value="{{ $employee->phone }}">
                </div>

                <div class="form-group">
                    <label>CPF: </label>
                    <input type="number" class="form-control" name="cpf" required value="{{ $employee->cpf }}">
                </div>

                <div class="form-group">
                    <label>RG: </label>
                    <input type="number" class="form-control" name="rg" required value="{{ $employee->rg }}">
                </div>

                <div class="form-group">
                    <label>Carteira de trabalho</label>
                    <input type="number" class="form-control" name="work_code" required value="{{ $employee->work_code }}">
                </div>

                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('employees') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                </div>

            </form>

        </div>

    </div>
@endsection
