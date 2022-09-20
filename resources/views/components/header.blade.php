@php

	$pages = [
        ['Pessoas', 'people'],
        ['Clientes', 'customers'],
        ['Funcionários', 'employees'],
        // ['Gerente', 'managers'],
        // ['Usuarios', 'users'],
		['Categorias', 'categories'],
		['Produtos', 'products'],
		['Estoque', 'inventories'],
		['Vendas', 'sales'],
		['Promoções', 'promotions'],
        // ['Carrinho', 'cart'],
        ['Cargos', 'roles'],
	];

@endphp

{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> --}}
{{-- <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #222831;"> --}}
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #313131;">


    <div class="container-fluid">


        <a class="navbar-brand" href="{{ url('/') }}"><i class="fa-sharp fa-solid fa-store"></i> {{ config('app.app_name') }}</a>

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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                      Gerência
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="managers">Gerentes</a>
                        <a class="dropdown-item" href="users">Usuarios</a>
                      {{-- <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a> --}}
                    </div>
                  </li>
            </ul>

        </div>





            <a href="{{ url ('/cart')}}" class="fa-sharp fa-solid fa-cart-shopping"></a>

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
                        {{-- {{ (Auth::user()->manager->person->name) }} --}}
                        "Username"
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            {{-- <a href="{{url('users/'.$user->id.'/show') }}" class="dropdown-item">Perfil</a> --}}
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
