<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>iBarEngine</title>
  
  <link rel="icon" href="{{ asset('/dashC/img/iBarEngine.ico') }}">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('/dashC/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('/dashC/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/dashC/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="{{ asset('/dashC/css/landing-page.min.css') }}" rel="stylesheet">
  

</head>

  <!-- Navigation -->
  
  <!-- Masthead 
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto bg-secondary text-white">
          <h1 class="mb-5"><strong>Bienvenido a iBarEngine</strong></h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto"></div>
      </div>
    </div>
  </header>
-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" style="color:navy" href="{{ url('/') }}"><i class="fa fa-bars"></i> iBarEngine</a>
  <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-beer"></i> Productos <span class="sr-only">(current)</span></a>
  @if(Auth::check())
	<div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i> {{ Auth::user()->name }} </a>
        <div class="dropdown-menu">
        	<form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item" type="submit">Finalizar sesión</button>
          </form>
        </div>
	</div>
@else
	<div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a>
          <a class="dropdown-item" href="{{ route('register') }}">Registrarse</a>
        </div>
    </div>
@endif
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      </li>
      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    <h2 alaign="center"><i class="fa fa-beer"></i>&nbsp; &nbsp;Bienvenido a iBarEngine</h2>
    </ul>  
  </div>
</nav>
<hr>
<!-- Carrusel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('/dashC/img/bar1.jpg') }}" alt="Responsive image" 
      style="width: 100px; height: 500px;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('/dashC/img/bar2.jpg') }}" alt="Responsive image"
      style="width: 100px; height: 500px;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('/dashC/img/bar3.jpg') }}" alt="Responsive image"
      style="width: 100px; height: 500px;">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>  


  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 text-dark" >
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="glyphicon glyphicon-glass m-auto text-primary"></i>
            </div>
            <h2>Nuestros Productos</h2>
            <p class="lead mb-0 " style="font-size:16px; text-align: justify">Contamos con una gran cantidad de bebidas y marcas que nos respaldan</p>
          </div>
          <a class="btn btn-primary  btn-lg" href="{{ route('home') }}">Ver productos</a>
        </div>
        <div class="col-lg-4 text-dark">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
                <i class="glyphicon glyphicon-calendar m-auto text-primary"></i>
            </div>
            <h2>Reservación</h2>
            <p class="lead mb-0" style="font-size:16px; text-align: justify">Puedes realizar tu reservación en línea para evitar las filas o algun tipo de inconveniente</p>
          </div>
          <a class="btn btn-primary  btn-lg" href="{{ url('reservations') }}">Reservación</a>
        </div>
        <div class="col-lg-4 text-dark">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="glyphicon glyphicon-shopping-cart m-auto text-primary"></i>
            </div>
            <h2>Carrito de compras</h2>
            <p class="lead mb-0" style="font-size:16px; text-align: justify">Ahora puedes realizar tus compras sin tener que estar en el establecimiento</p>
          </div>
          <a class="btn btn-primary  btn-lg" href="{{ route('home') }}">Comprar</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/dashC/img/nosotros.jpg');">
        <img class="img-fluid  mb-3" src="{{ asset('/dashC/img/nosotros.jpg') }}" alt="">
        </div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text bg-info text-white">
          <h2>Acerca de nosotros</h2>
          <p class="lead mb-0 " style="text-align: justify">Somos una empresa 100% leonesa que se propone expandirse a nivel nacional 
          y posteriorimente internacional</p>
        </div>
        
      </div>
      
      <div class="row no-gutters">
      
        <div class="col-lg-6 text-white showcase-img " style="background-image: url('/dashC/img/mision.jpg');">
        <img class="img-fluid  mb-3" src="{{ asset('/dashC/img/mision.jpg') }}" alt="">
        </div>
        <div class="col-lg-6 my-auto showcase-text bg-info text-white">
          <h2>Misión</h2>
          <p class="lead mb-0 " style="text-align: justify">Satisfacer la necesidad de nuestros clientes enfocándonos en la calidad 
          de nuestros servicios ofreciéndole las mejores marcas en el consumo de bebidas 
          alcohólicas, así como el mejor entretenimiento dentro de nuestras instalaciones.</p>
          
        </div>
        
      </div>
      
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/dashC/img/vision.jpg');">
        <img class="img-fluid  mb-3" src="{{ asset('/dashC/img/vision.jpg') }}" alt="">
        </div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text bg-info text-white">
          <h2>Visión</h2>
          <p class="lead mb-0" style="text-align: justify">IBarEngine pretende en un corto plazo ser el lugar más concurrido 
          de la zona y a un mediano o largo plazo crecer con nuevas sucursales posicionándose como
           empresa líder en el ramo.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <p class="text-muted small mb-4 mb-lg-0">&copy; iBarEngine 2020. Todos los derechos reservados.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('/dash/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/dash/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/jquery/jQuery/pinterest_grid.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pinterest_grid.js') }}"></script>

</body>

</html>
