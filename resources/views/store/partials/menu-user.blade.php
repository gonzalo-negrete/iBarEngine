@if(Auth::check())
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle fa-2x"></i> {{ Auth::user()->aPaterno }} </a>
        <div class="dropdown-menu">
        	<form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item" type="submit">Finalizar sesión</button>
          </form>
        </div>
	</li>
@else
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle fa-2x"></i></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a>
          <a class="dropdown-item" href="{{ route('register') }}">Registrarse</a>
        </div>
    </li>
@endif