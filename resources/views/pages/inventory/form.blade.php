@extends('layouts.main', [
    'pageTitle' => 'Estoque'
])


@section('content')

    @php
        $isEdit = !empty($inventory->id);
    @endphp

    <div class="page page-employee page-form">

        <div class="page-header">
            <h1>Estoque<small>{{ $isEdit ? 'Editar estoque' : 'Novo estoque'}}</small></h1>
        </div>

        <div class="page-body">

            <form action="{{ url('inventories') }}" method="POST">

                @csrf

                {{-- @dd($inventory->product); --}}

                @method($isEdit ? "PUT" : "POST")

                <input type="hidden" name="id" value="{{ $inventory->id }}">

                <div class="form-group">
                    <label>Produto: </label>
                    <select name="product_id" required>
                </div>

                <div class="form-group">

                    @if (count($products) > 0)

                        @foreach ($products as $product)

                            <option value="{{ $product->id }}">{{ $product->name }}</option>

                        @endforeach

                    @else

                        <option>Nenhum produto criado</option>

                    @endif

                </select>
                </div>

                <div class="form-group">
                    <label>Quantidade: </label>
                    <input type="number" name="qty" required value="{{ $inventory->qty }}">
                </div>

                <div class="form-group">
                    <label>Data: </label>
                    <input type="date" name="created_at" value="{{ $inventory->created_at }}">
                </div>

                <div class="page-controls">

                <button class="btn btn-outline-success" type="submit">Enviar</button>

                </div>

            </form>

        </div>

    </div>

@endsection
