@php

	$pages = [
		['Clientes', 'customers'],
		['Produtos', 'products'],
		['Funcionários', 'employees'],
		['Categorias', 'categories'],
		['Vendas', 'sales'],
		['Estoque', 'inventories'],
		['Promoções', 'promotions'],
	];

@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">


    <div class="container-fluid">


        <a class="navbar-brand" href="{{ url('') }}">{{ env('APP_NAME') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">

				@foreach ($pages as $page)

					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ url($page[1]) }}">{{ $page[0] }}</a>
					</li>

				@endforeach

            </ul>

        </div>

    </div>

</nav>
