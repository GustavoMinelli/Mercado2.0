@extends('layouts.main', [
    'pageTItle' => 'Pessoa'
])

@section('content')
    <div class="page page-admin page-details">

        <div class="page-header">
            <h2>Pessoa <small>Tabela da Pessoa</small></h2>
        </div>

        <div class="page-body">

            <ul>
                <li><b>ID:</b>{{$person->id}}</li>
                <li><b>Name:</b>{{$person->name}}</li>
                {{-- <li><b>Email:</b>{{$person->email}}</li> --}}
                <li><b>Endereço:</b>{{$person->address}}</li>
                <li><b>Telefone:</b>{{$person->phone}}</li>
                <li><b>RG:</b>{{$person->rg}}</li>
                <li><b>CPF:</b>{{$person->cpf}}</li>
                <li><b>Genero:</b>{{$person->gender}}</li>




            </ul>

            <div class="page-controls">
                <a class="btn btn-outline-primary" href="{{ url('people') }}">Voltar</a>

            </div>


        </div>

    </div>

    @endsection
