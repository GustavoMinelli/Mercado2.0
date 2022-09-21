@extends('layouts.main', [
    'pageTitle' => 'Clientes'
])

@section('content')



    <div class="page page-customer page-index">

        <div class="page-header">
            <h1>Clientes <small>Listagem de clientes</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($customers) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            {{-- <th>E-mail</th> --}}
                            <th>Ações</th>
                        </tr>

                    </thead>

                    
                @foreach ($customers as $customer)
        
                <tbody>
                    
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->person->name }}</td>
                        
                        <td>
                            <a class="btn btn-primary btn-sm" role="button" href="{{ url('customers/'.$customer->id.'/show') }}">Visualizar</a>
                            <a class="btn btn-primary btn-sm" role="button" href="{{ url('customers/'.$customer->id.'/edit') }}">Editar</a>
                            <a class="btn btn-primary btn-sm" role="button" href="{{ url('customers/'.$customer->id.'/delete') }}"><i class="fa-sharp fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                        
                </tbody>
                

                @endforeach
                    
                    
                </table>

            @else

                <div class="page-message">
                    <h3>Nenhum cliente cadastrado</h3>
                </div>

            @endif

            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('customers/create') }}">Novo Cliente</a>
            </div>

        </div>

    </div>

@endsection

