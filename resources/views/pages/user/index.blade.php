@extends('layouts.main', [
    'pageTitle' => 'Usuarios'
])

@section('content')



    <div class="page page-customer page-index">

        <div class="page-header">
            <h1>Usuarios <small>Listagem de usuarios</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($users) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>
                            <th>ID</th>
                            {{-- <th>Nome</th> --}}
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>

                    </thead>

                    
                    @foreach ($users as $user)
           
                    <tbody>
                        
                        <tr>
                            <td>{{ $user->id }}</td>
                            {{-- <td>{{ $person->name }}</td> --}}
                            <td>{{ $user->email }}</td>
                            
                            <td>
                                <a class="btn btn-primary btn-sm" role="button" href="{{ url('users/'.$user->id.'/show') }}">Visualizar</a>
                                <a class="btn btn-primary btn-sm" role="button" href="{{ url('users/'.$user->id.'/edit') }}">Editar</a>
                                <a class="btn btn-danger btn-sm" role="button" href="{{ url('users/'.$user->id.'/delete') }}">Remover</a>
                            </td>
                        </tr>
                            
                    </tbody>
                    

                    @endforeach
                        
                        
                    </table>

                    @else

                <div class="page-message">
                    <h3>Nenhum cliente cadastrado</h3>
                </div>

            @endif

            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('users/create') }}">Novo Usuario</a>
            </div>

        </div>

    </div>

@endsection

