@extends('layouts.main', [
    'pageTitle' => 'Produtos'
])

@section('content')

    @php
        $isEdit = !empty($product->id)
    @endphp


    <div class="page page-product page-form">

        <div class="page-header">
            <h1>Produtos<small>{{$isEdit ? 'Editar produto' : 'Novo produto' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{url('products')}}" method="POST">

                @csrf

                @method($isEdit ? 'PUT' : 'POST')

                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input class="form-control" type="text" name="name" required value="{{ $product->name}}">
                </div>

                <div class="form-group">
                    <label>Preço: </label>
                    <input class="form-control" type="number" name="price" step="0.01" required value="{{ $product->price }}">
                </div>


                <div class="form-group">
                    <label>Categorias</label>
                    <select name="category_id" class="form-select" required>

                        @if (count($categories) > 0)

                            @foreach ($categories as $category)

                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endforeach

                        @else

                            <option>Nenhuma categoria criada</option>

                        @endif

                    </select>

                </div>

                <div class="page-controls">

                    <a class="btn btn-primary" href="{{ url('products') }}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Enviar</button>


                </div>

            </form>

        </div>

    </div>

@endsection
