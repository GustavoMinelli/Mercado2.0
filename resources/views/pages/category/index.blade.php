@extends('layouts.main', [
    'pageTitle' => 'Categoria'
])



@section('content')


    <div class="page page-category page-index">
        <div class="page-header">
            <h1>Categorias <small>Listagem de Categorias</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($categories) > 0)

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
                                    <a  class="btn btn-primary btn-sm" href="{{ url('category/'.$category->id. '/products') }}">Produtos</a>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('category/'.$category->id. '/edit') }}">Editar</a>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('category/'.$category->id. '/delete') }}">Remover</a>
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
                <a class="btn btn-primary" href="{{ url('category/create') }}">Nova Categoria</a>
            </div>

        </div>

    </div>

@endsection
