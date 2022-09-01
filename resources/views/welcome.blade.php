@extends('layouts.main')

@section('title')

@section('content')
<div class="context">


<div class="page page-product page-index">

    </div>

    <div class="page-body">

    @include('components.alert')

        <div class="row col-12">

            <div class="card col-12 col-md-4">

                <img src="assets/img/products.png" class="card-img-top" alt="Teste" width="300" height="300"">

                <h5 class="card-title">Produtos</h5>
                {{-- <p class="card-text">Adc produtos e ver suas </p> --}}
                <a href="/products" class="btn btn-primary">Ver produtos</a>

            </div>

            <div class="card col-12 col-md-4">

                <img src="assets/img/Estoque.png" class="card-img-top" alt="Teste" width="300" height="300"">

                <h5 class="card-title">Estoque</h5>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                <a href="/inventories" class="btn btn-primary">Estoque</a>

            </div>

            <div class="card col-12 col-md-4">

                <img src="assets/img/sales.png" class="card-img-top" alt="Teste" width="300" height="300"">

                <h5 class="card-title">Vendas</h5>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                <a href="/sales" class="btn btn-primary">Vendas</a>

            </div>

        </div>

        <div class="row col-12">

            <div class="card col-12 col-md-4">

                <img src="assets/img/promotion.png" class="card-img-top" alt="Teste" width="300" height="300"">

                <h5 class="card-title">Promoção</h5>
                {{-- <p class="card-text">Adc produtos e ver suas </p> --}}
                <a href="/promotions" class="btn btn-primary">Promoção</a>

            </div>

            <div class="card col-12 col-md-4">

                <img src="assets/img/Clientes.png" class="card-img-top" alt="Teste" width="300" height="300"">

                <h5 class="card-title">Clientes</h5>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                <a href="/employees" class="btn btn-primary">Clientes</a>

            </div>

            <div class="card col-12 col-md-4">

                <img src="assets/img/categoria.png" class="card-img-top" alt="Teste" width="300" height="300"">

                <h5 class="card-title">Categorias</h5>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                <a href="/categories" class="btn btn-primary">Categorias</a>

            </div>

        </div>

@endsection
