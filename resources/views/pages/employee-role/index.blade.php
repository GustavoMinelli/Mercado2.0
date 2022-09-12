@extends('layouts.main', [
    'pageTitle' => 'Cargos'
])



@section('content')


    <div class="page page-employeerole page-index">

        <div class="page-header">
            <h1>Cargos <small>Listagem de Cargos</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($employeeroles) > 0)

               <table class="table table-striped">

                    <thead>
                        
                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @foreach ($employeeroles as $employeerole)

                        <tbody>

                            <tr>

                                <td>{{ $employeerole->id }}</td>
                                <td>{{ $employeerole->name }}</td>

                                {{-- @if(Auth::check() && (Auth::user()->role == 0 && Auth::check() && (Auth::user()->role == 1 ))) --}}

                                <td>
                                    {{-- <a  class="btn btn-primary btn-sm" href="{{ url('employeeroles/'.$employeerole->id. '/products') }}">Produtos</a> --}}
                                    <a  class="btn btn-primary btn-sm" href="{{ url('roles/'.$employeerole->id. '/edit') }}">Editar</a>
                                    <a  class="btn btn-danger btn-sm" href="{{ url('roles/'.$employeerole->id. '/delete') }}">Remover</a>
                                </td>

                         
                               
                                {{-- @endif --}}
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
                    <h3>Nenhum cargo cadastrado</h3>
                </div>
            @endif

            @if(Auth::check() && (Auth::user()->role == 0 || Auth::check() && (Auth::user()->role == 1 )))
            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('roles/create') }}">Novo Cargo</a>
            </div>

            @else
            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('/') }}">Voltar</a>
            </div>
            @endif

        </div>

    </div>

@endsection
