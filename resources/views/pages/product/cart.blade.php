@extends('layouts.main', [
    'pageTitle' => 'Carrinho'
])

@section('content')

    <div class="page page-products page-cart">

        <div class="page-header">
            <h1>Carrinho <small>Listagem de produtos no carrinho</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            @if (Session::has('cart'))

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Preço unitário</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    @php

                        $total = 0;

                    @endphp

                    @foreach (Session::get('cart') as $id => $details)

                        @foreach ($products as $product )
                            
                        
                        <tbody>

                            <tr>

                            
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['qty'] }}</td>
                                <td>R$ {{ number_format($details['price'], '2', ',', ' ') }}</td>
                                <td>

                                    <div class="table-options">
                                        
                                        <a href="{{ url ('products/'.$product->id. '/cart') }}" class="btn btn-primary btn-sm pull-right" role="button"><i class="fa-sharp fa-solid fa-plus"></i></a>
                                        
                                        <a href="{{ url ('products/remove/'.$product->id. '/cart') }}" class="btn btn-primary btn-sm removeCart"><i class="fa-sharp fa-solid fa-minus"></i></a>
                                        
                                    </div>
                                    
                                </td>
                                
                            </tr>
                            
                        </tbody>
                        
                        @php

                            $total += $details['price']*$details['qty'];

                        @endphp
                        @endforeach

                    @endforeach

                    <tfoot>
                        <tr>
                            <td>Total: </td>

                            {{-- <td></td> --}}
                            <td></td>
                            <td></td>
                            <td>R$ {{ number_format($total, '2', ',', ' ') }}</td>
                        </tr>
                    </tfoot>

                </table>
               
                    <button type="button" class="btn btn-primary btn-sm buttons sale">Concluir venda</button>

                    <a href="/products" class="btn btn-primary btn-sm">Voltar aos produtos</a>


            

            @else

                <h4>Nao tem produtos no seu carrinho </h4>

            @endif

        </div>

        {{-- <form action="/sale" method="POST" class="d-none sale-form">

            @csrf

            @foreach (Session::get('cart') as $id => $product)

                <input type="hidden" name="customer_id" value="{{ Auth::user()->customer_id }}">
                <input type="hidden" name="product_id[]" value="{{ $id }}">
                <input type="hidden" name="qty_sales[]" value="{{ $product['qty'] }}">

            @endforeach

        </form> --}}
    </div>


@endsection
