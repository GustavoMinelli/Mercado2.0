@extends('layouts.main', [
    'pageTitle' => 'Promoções'
])



@section('content')

    <div class="page page-product page-index">

        <div class="page-header">
            <h1>Promoções <small> Listagem de promoções</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (count($promotions) > 0)

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>Preço</th>
                            <th>Produto</th>
                            <th>Data inicial</th>
                            <th>Data final</th>
                            <th>Estado</th>
                            @if(Auth::check() && (Auth::user()->role == 0 || Auth::check() && (Auth::user()->role == 1 )))

                            <th>Ações</th>

                            @endif

                        </tr>

                    </thead>

                    @foreach ($promotions as $promotion)

                        <tbody>

                            <tr>

                                <td>{{$promotion->id}}</td>
                                <td>{{number_format($promotion->price, 2, ',', ' ')}}</td>
                                <td>{{$promotion->product->name}}</td>
                                <td>{{$promotion->started_at->format('d/m/Y')}}</td>
                                <td>{{$promotion->ended_at->format('d/m/Y')}}</td>
                                <td>{{$promotion->is_active ? "Ativo" : "Inativo"}}</td>

                                @if(Auth::check() && (Auth::user()->role == 0 || Auth::check() && (Auth::user()->role == 1 )))

                                    <td>
                                        <a  class="btn btn-primary btn-sm" href="{{ url('promotions/'.$promotion->id. '/edit') }}">Editar</a>
                                        <a  class="btn btn-danger btn-sm" href="{{ url('promotions/'.$promotion->id. '/delete') }}">Remover</a>
                                    </td>

                                @endif

                            </tr>

                        </tbody>

                    @endforeach

                </table>

            @else

            <div class="page-message">

                <h3>Nenhuma promoção criada</h3>
                
            </div>

            @endif

            <div class="page-controls">
                <a class="btn btn-primary" href="{{ url('promotions/create') }}">Nova Promoção</a>
            </div>

        </div>

    </div>


@endsection
