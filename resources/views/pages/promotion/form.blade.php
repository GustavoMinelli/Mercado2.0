@extends('layouts.main', [
    'pageTitle' => 'Promoçoes',
])


@section('content')

    @php
    $isEdit = !empty($promotion->id);
    @endphp


    <div class="page page-promotion page-form">

        <div class="page-header">
            <h1>Promoção<small>{{ $isEdit ? 'Editar promoção' : 'Nova promoção' }}</small></h1>
        </div>

        <div class="page-body">

            <form action="{{ url('promotions') }}" method="POST">

                @csrf

                @method($isEdit ? 'PUT' : 'POST')

                <input type="hidden" name="id" value="{{ $promotion->id }}">

                <div class="form-group">
                    {{-- <label>Qual produto: </label> --}}
                        <select class="form-select" name="product_id">
                            <option>Produto:</option>
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            @else
                                <option>Nenhum produto cadastrado</option>
                            @endif

                        </select>

                </div>

                <div class="form-group">
                    <label>Preço: </label>
                    <input type="number" step="0.01" name="price" class="form-control"required value="{{ $promotion->price ?? '' }}">
                </div>

                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="is_active" {{ $promotion->is_active ? 'checked' : '' }}
                        value="{{ true }}"><label>Está ativo?</label>
                </div>

                <div class="form-group">
                    <label>Data inicial: </label>
                    <input type="date" name="started_at" required class="form-select"
                        value="{{ (string) $promotion->started_at ? $promotion->started_at->format('Y-m-d') : '' }}">
                </div>

                <div class="form-group">
                    <label>Data final: </label>
                    <input type="date" name="ended_at" required class="form-select"
                        value="{{ (string) $promotion->ended_at ? $promotion->ended_at->format('Y-m-d') : '' }}">
                </div>


                <div class="page-controls">

                    <button class="btn btn-primary" type="submit">Enviar</button>

                </div>

            </form>

        </div>

    </div>


    @endsection
