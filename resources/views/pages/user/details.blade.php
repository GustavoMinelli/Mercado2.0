@extends('layouts.main', [
    'pageTItle' => 'Usuario'
])

@section('content')
    <div class="page page-admin page-details">

        <div class="page-header">
            <h2>Usuario <small>Tabela da Usuario</small></h2>
        </div>

        <div class="page-body">

            <ul>
                <li><b>ID:</b>{{$person->id}}</li>
                <li><b>Name:</b>{{$user->name}}</li>
                {{-- <li><b>Email:</b>{{$person->email}}</li> --}}
               




            </ul>

            <div class="page-controls">
                <a class="btn btn-outline-primary" href="{{ url('users') }}">Voltar</a>

            </div>


        </div>

    </div>

    @endsection
