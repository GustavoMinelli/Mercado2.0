@extends('layouts.main', [
    'pageTitle' => 'Pessoas'
])


@section('content')


    <div class="page page-category page-index">
        <div class="page-header">
            <h1>Pessoas <small>Listagem de pessoas</small></h1>
        </div>

        <div class="page-body">

            @if (count($people) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @foreach ($people as $person)

                        <tbody>

                            <tr>

                                <td>{{$person->id}}</td>
                                <td>{{$person->name}}</td>
                                <td>{{$person->phone}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{url('people/'.$person->id. '/show') }}">Perfil</a>
                                    <a class="btn btn-primary" href="{{url('people/'.$person->id. '/edit') }}">Editar</a>
                                    <a class="btn btn-danger" href="{{url('people/'.$person->id. '/delete') }}">Remover</a>
                                </td>
                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else

                <div class="page-message">
                <h2>Nenhuma pessoa cadastrado</h2>
                </div>

            @endif

            <div class="page-controls">
                <a class="btn btn-primary" href="{{url('people/create') }}">Nova pessoa</a>
            </div>

        </div>

    </div>


@endsection
