@extends('layouts.main', [
    'pageTItle' => 'Usuario'
])

@section('content')

@php
        // $isEdit = !empty($user->id);
        $person = $user->person ?? $user;
    @endphp
    <div class="page page-admin page-details">

        <div class="page-header">
            <h2>Usuario <small>Detalhes da Usuario</small></h2>
        </div>

        <div class="page-body">

            <ul>
                <li><b>ID:</b>{{$user->id}}</li>
                <li><b>Name:</b>{{$person->name}}</li>
                <li><b>Email:</b>{{$user->email}}</li>
               




            </ul>

            <div class="page-controls">
                <a class="btn btn-outline-primary" href="{{ url('users') }}">Voltar</a>

            </div>


        </div>

    </div>

    @endsection
