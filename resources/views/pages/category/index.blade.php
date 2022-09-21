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

                                {{-- @if(Auth::check() && (Auth::user()->role == 0 && Auth::check() && (Auth::user()->role == 1 ))) --}}
                                @if(!Session::get('customer'))

                                <td>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/products') }}">Produtos</a>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/edit') }}">Editar</a>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/delete') }}"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                </td>
                                
                                @else
                                <td> <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/products') }}">Produtos</a></td>
                                @endif
{{--
                                <td>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/products') }}">Produtos</a>
                                    <a  class="btn btn-primary btn-sm" href="{{ url('categories/'.$category->id. '/edit') }}">Editar</a>
                                    <a  class="btn btn-danger btn-sm" href="{{ url('categories/'.$category->id. '/delete') }}">Remover</a>
                                </td> --}}
                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else

                <div class="page-message">
                    <h3>Nenhuma categoria cadastrada</h3>
                </div>
            @endif

            @if(Auth::check() && (Auth::user()->role == 0 || Auth::check() && (Auth::user()->role == 1 )))
            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('categories/create') }}">Nova Categoria</a>
            </div>

            @else
            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('/') }}">Voltar</a>
            </div>
            @endif

        </div>

    </div>

@endsection
