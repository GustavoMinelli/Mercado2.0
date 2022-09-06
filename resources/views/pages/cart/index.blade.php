@extends('layouts.main', [
    'pageTitle ' => 'Carrinho',
])

@section('content')



@foreach ($products as $k => $product)

<tbody>

    {{-- @dd($product->category()->get()) --}}

    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td><a class="btn btn-outline-secondary" href="{{url('categories/'.$product->category->id.'/products')}}">{{ $product->category->name }}</td>
        <td>{{ $product->current_qty }}</td>
        {{-- @dd($product->current_qty) --}}
        <td>
            <a class="btn btn-primary btn-sm" href={{ url ('products/'.$product->id. '/edit') }}>Editar</a>
            <a class="btn btn-danger btn-sm" href="{{ url ('products/'.$product->id. '/delete') }}">Remover</a>
        </td>

    </tr>

</tbody>
