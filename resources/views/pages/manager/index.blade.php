@extends('layouts.main', [
    'pageTitle' => 'Admin'
])

@section('content')
<div class="page page-admin page-index">

    <div class="page-header">
        <h1>Gerente <small>Listagem de Gerentes     </small></h1>
    </div>

    <div class="page-body">

        @include('components.alert')

        @if (count($managers) > 0)

           <table class="table table-striped">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nome</th>
                        {{-- <th>Funcionarios</th> --}}
                        <th>Ações</th>

                    </tr>

                </thead>

                @foreach ($managers as $manager)

                    <tbody>

                        <tr>

                            <td>{{ $manager->id }}</td>
                            <td>{{ $manager->person->name }}</td>
                            {{-- <td>{{ $manager->funcionarios->count() }}</td> --}}
                            <td>
                                <a class="btn btn-primary btn-sm" role="button" href="{{ url('managers/'.$manager->id.'/show') }}">Visualizar</a>
                                <a  class="btn btn-primary btn-sm" href="{{ url('managers/'.$manager->id. '/edit') }}">Editar</a>
                                <a  class="btn btn-danger btn-sm" href="{{ url('managers/'.$manager->id. '/delete') }}">Remover</a>

                            </td>
                        </tr>

                    </tbody>

                @endforeach

            </table>

        @else

            <div class="page-message">
                <h3>Nenhuma categoria cadastrada</h3>
            </div>
        @endif

        <div class="page-controls">
            <a class="btn btn-primary" href="{{ url('managers/create') }}">Novo gerente</a>
        </div>

    </div>

</div>

@endsection
