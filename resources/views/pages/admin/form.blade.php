@extends('layouts.main', [
    'pageTitle' => 'Admin'
])

@section('content')

    @php
        $isEdit = !empty($user->id);
    @endphp

    <div class = "page page-admin page-form">

        <div class="page-header">
            <h1>Admin<small>{{$isEdit ? 'Editar Admin' : 'Novo Admin '}}</small></h1>
        </div>

        <div class = "page-body">

            @include('components.alert')

            <form action="{{url ('admins') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{$user->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label>Senha: </label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label>Confirmar senha: </label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control" >
                </div>
                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('admins') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                    {{-- @if($isEdit =)

                    <button type="button" class="btn btn-primary btn-lg">
                        Launch demo modal
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                              ...
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif --}}

                </div>

            </form>
        </div>
    </div>
@endsection
