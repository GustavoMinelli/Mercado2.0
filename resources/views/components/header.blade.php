@php

	$pages = [
        ['Pessoas', 'people'],
        ['Clientes', 'customers'],
        ['Funcionários', 'employees'],
        ['Gerente', 'managers'],
        ['Usuarios', 'users'],
		['Categorias', 'categories'],
		['Produtos', 'products'],
		['Estoque', 'inventories'],
		['Vendas', 'sales'],
		['Promoções', 'promotions'],
        ['Carrinho', 'cart'],
        ['Cargos', 'roles'],
	];

@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">


    <div class="container-fluid">


        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.app_name') }}</a>

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

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        {{-- @if(Auth::user()->role == 0)


        @endif --}}






        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <a href="#" class="dropdown-item">Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

    </div>

</nav>
