@extends('layouts.main', [
    'pageTitle' => 'Pessoa'
])

@section('content')

    @php
        $isEdit = !empty($user->id);
        // $user = $person->user ?? $person;
    @endphp

    <div class="page page-user page-form">


        <div class="page-header">
            <h1>Usuario<small>{{ $isEdit ? ' Editar usuario' : ' Novo usuario' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('users') }}" method="POST">

                @csrf

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $user->id }}">




                <div class="form-group person">
                    <label>Pessoa </label>
                    <select name="person_id" class="form-select person" required>

                        @if (count($people) > 0)

                        @foreach ($people as $person)

                        <option>Selecione a pessoa</option>


                        <option value="{{ $person->id }}">{{ $person->name }}</option>

                        @endforeach

                        @else

                        <option>Nenhuma pessoa criada</option>

                        @endif

                    </select>

                </div>

                <div class="row">

                    <div class="form-check checkbox-user">
                        <input class="form-check-input checkbox" type="checkbox" id="manager_id" data-type="manager" name="checkboxManager">
                        <label class="form-check-label" for="emloyee">Funcionario</label>
                    </div>

                    <div class="form-check select manager d-none">

                        <select name="manager_id" class="form-select">

                            <option value="">Selecione um funcionario</option>

                            @foreach ($employees as $employees)

                                <option value="{{ $people->id }}">{{ $person->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Cliente
                    </label>
                </div> --}}

                <div class="row">

                    <div class="form-check checkbox-user">
                        <input class="form-check-input checkbox" type="checkbox" id="manager_id" data-type="manager" name="checkboxManager">
                        <label class="form-check-label" for="manager_id">Gerente</label>
                    </div>

                    <div class="form-check select manager d-none">

                        <select name="manager_id" class="form-select">

                            <option value="">Selecione um gerente</option>

                            @foreach ($managers as $manager)

                                <option value="{{ $manager->id }}">{{ $person->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Cliente
                    </label>
                </div> --}}

                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Gerente
                    </label>
                </div> --}}

                <div class="row">

                    <div class="form-check checkbox-user">
                        <input class="form-check-input checkbox" type="checkbox" id="person" data-type="manager" name="checkboxPerson">
                        <label class="form-check-label" for="person">Pessoa</label>
                    </div>

                    <div class="form-check select manager d-none">

                        <select name="manager_id" class="form-select">

                            <option value="">Selecione uma pessoa</option>

                            @foreach ($people as $person)

                                <option value="{{ $people->id }}">{{ $person->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>






                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                </div>

                {{-- <input type="checkbox" name="funcionario" value="{{$employee->id}}"> --}}


                @if($isEdit)

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password"required>
                </div>

            @else

                <div class="form-group">

                    <label for="password">Senha</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                </div>

                <div class="form-group">

                    <label for="password-confirm">Confirmar senha</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required valuye>

                </div>

            @endif
                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('people') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                </div>

            </form>

        </div>

    </div>
@endsection
