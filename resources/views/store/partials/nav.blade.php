<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" style="color:navy" href="{{ url('/') }}"><i class="fa fa-bars"></i> iBarEngine</a>
  <a class="navbar-brand" href="{{ url('reservations') }}"><i class="fa fa-calendar-check-o"></i> Reservación <span class="sr-only">(current)</span></a>
  <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-beer"></i> Productos <span class="sr-only">(current)</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      </li>
      @include('store.partials.menu-user')
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-warning my-2 my-sm-0" type="submit"><i class
      ="fa fa-search" aria-hidden="true"></i></button>
      &nbsp; &nbsp;
      <input class="form-control mr-sm-2" type="search" name="buscar" placeholder="Buscar producto">
    </form>
    &nbsp; &nbsp; &nbsp; &nbsp;
    <form class="">
      <a href="{{ route('cart-show') }}"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
    </form>
  </div>
</nav>
<hr>