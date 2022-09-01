@extends('layouts.main', [
    'pageTitle' => 'Usuario'
])



@section('content')


    <div class="page page-category page-index">

        <div class="page-header">
            <h1>Usuarios <small>Listagem de Usuarios</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($users) > 0)

               <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @foreach ($categories as $category)

                        <tbody>

                            <tr>

                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/products') }}">Produtos</a>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/edit') }}">Editar</a>
                                    <a  class="btn btn-danger btn-sm" href="{{ url('categories/'.$category->id. '/delete') }}">Remover</a>
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
                <a class="btn btn-primary" href="{{ url('categories/create') }}">Nova Categoria</a>
            </div>

        </div>

    </div>

@endsection
