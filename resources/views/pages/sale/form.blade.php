@extends('layouts.main',[
    'pageTitle' => 'Vendas'
])
@section('content')

    <div class="page page-sale page-form">

        <div class="page-header">
            <h1>Venda <small>Nova venda</small></h1>
        </div>

        <div class="page-body">

            @include('components.alert')

            <form action="{{ url('sale') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Cliente: </label>
                    <select name="customer_id" required>
                        <option selected>Selecione um cliente</option>

                        @foreach ($customers as $customer)

                            <option value="{{$customer->id}}">{{$customer->name}}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>Funcionário: </label>
                    <select name="employee_id" required>
                        <option selected>Selecione um funcionário</option>

                        @foreach ($employees as $employee)

                            <option value="{{$employee->id}}">{{$employee->name}}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    @if (count($products) > 0)
                        <label>Qual produto foi comprado e sua quantidade: </label><br>

                        @foreach ($products as $k => $product)

                            <input type="checkbox" name="product_id[{{$k}}]" value="{{ $product->id }}">{{$product->name}}

                            <input type="number" name="qty_sales[]">
                            <br>

                        @endforeach

                    @else

                        <h3>Nenhum produto cadastrado</h3>
                        <p><a href="{{ url('product/create') }}">    Clique aqui</a> para criar um novo</p>



                    @endif

                </div>

                <div class="page-controls">

                    <a class="btn btn-outline-primary" href="{{ url('sales') }}">Voltar</a>

                    <button type="submit" class="btn btn-outline-success">Enviar</button>

                </div>

            </form>

        </div>

    </div>


@endsection
