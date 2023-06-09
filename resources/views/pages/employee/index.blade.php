@extends('layouts.main', [
    'pageTitle' => 'Funcionarios'
])


@section('content')


    <div class="page page-category page-index">
        <div class="page-header">
            <h1>Funcionarios <small>Listagem de Funcionarios</small></h1>
        </div>

        <div class="page-body">

            @if (count($employees) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>Nome</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @foreach ($employees as $employee)

                        <tbody>

                            <tr>

                                <td>{{$employee->id}}</td>
                                <td>{{$employee->person->name}}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{url('employees/'.$employee->id. '/show') }}">Perfil</a>
                                    <a class="btn btn-primary btn-sm" href="{{url('employees/'.$employee->id. '/edit') }}">Editar</a>
                                    <a class="btn btn-primary btn-sm" href="{{url('employees/'.$employee->id. '/delete') }}"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                </td>
                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else

                <div class="page-message">
                <h2>Nenhum funcionário cadastrado</h2>
                </div>

            @endif

            <div class="page-controls">
                <a class="btn btn-primary" href="{{url('employees/create') }}">Novo funcionario</a>
            </div>

        </div>

    </div>


@endsection
