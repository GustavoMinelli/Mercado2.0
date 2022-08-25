@extends('layouts.main', [
    'pageTitle' => 'Produtos'
])

@section('content')

    @php
        $isEdit = !empty($product->id)
    @endphp


    <div class="page page-procut page-form">

        <div class="page-header">
            <h1>Produtos<small>{{$isEdit ? 'Editar produto' : 'Novo produto' }}</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{url('product')}}" method="POST">

                @csrf

                @method($isEdit ? 'PUT' : 'POST')

                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" name="name" required value="{{ $product->name}}">
                </div>

                <div class="form-group">
                    <label>Preço: </label>
                    <input type="number" name="price" step="0.01" required value="{{ $product->price }}">
                </div>


                <div class="form-group">
                    <label>Categorias</label>
                    <select name="category_id" required>

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

                    <button class="btn btn-outline-primary" type="submit">Enviar</button>

                    <a class="btn btn-outline-primary" href="{{ url('products') }}">Voltar</a>

                </div>

            </form>

        </div>

    </div>

@endsection
