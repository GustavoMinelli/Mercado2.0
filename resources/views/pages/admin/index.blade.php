@extends('layouts.main', [
    'pageTitle' => 'Admin'
])

@section('content')
<div class="page page-admin page-index">

    <div class="page-header">
        <h1>Admin <small>Listagem de Admins</small></h1>
    </div>

    <div class="page-body">

        @include('components.alert')

        @if (count($user) > 0)

           <table class="table table-striped">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>

                    </tr>

                </thead>

                @foreach ($user as $user)

                    <tbody>

                        <tr>

                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" role="button" href="{{ url('admins/'.$user->id.'/show') }}">Visualizar</a>
                                <a  class="btn btn-primary btn-sm" href="{{ url('admins/'.$user->id. '/edit') }}">Editar</a>
                                <a  class="btn btn-danger btn-sm" href="{{ url('admins/'.$user->id. '/delete') }}">Remover</a>

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
            <a class="btn btn-primary" href="{{ url('admins/create') }}">Novo Admin</a>
        </div>

    </div>

</div>

@endsection
