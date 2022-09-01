@extends('layouts.main', [
    'pageTItle' => 'Admin'
])

@section('content')
    <div class="page page-admin page-details">

        <div class="page-header">
            <h2>Admin <small>Tabela da Admin</small></h2>
        </div>

        <div class="page-body">

            {{-- @dd($users) --}}

            {{-- @foreach ($users as $user) --}}

            <ul>
                <li><b>ID:</b>{{$users->id}}</li>
                <li><b>Name:</b>{{$users->name}}</li>
                <li><b>Email:</b>{{$users->email}}</li>
            </ul>

            {{-- @endforeach --}}

            <div class="page-controls">
                <a class="btn btn-outline-primary" href="{{ url('admins') }}">Voltar</a>

            </div>


        </div>

    </div>

    @endsection
