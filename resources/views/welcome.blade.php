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

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
    </div>
    <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="btn btn-primary" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

  </nav>


  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Bienvenido a iBarEngine</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        </div>
      </div>
    </div>
  </header>

  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="glyphicon glyphicon-glass m-auto text-primary"></i>
            </div>
            <h2>Nuestros Productos</h2>
            <p class="lead mb-0" style="font-size:16px">Contamos con una gran cantidad de bebidas y marcas que nos respaldan</p>
          </div>
          <a class="btn btn-primary" href="{{ url('/products') }}">Ver productos</a>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
                <i class="glyphicon glyphicon-calendar m-auto text-primary"></i>
            </div>
            <h2>Reservación</h2>
            <p class="lead mb-0" style="font-size:16px">Puedes realizar tu reservación y así evitar filas o inconvenientes de lugar</p>
          </div>
          <a class="btn btn-primary" href="#">Reservación</a>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="glyphicon glyphicon-shopping-cart m-auto text-primary"></i>
            </div>
            <h2>Carrito de compras</h2>
            <p class="lead mb-0" style="font-size:16px">Ahora puedes realizar tus compras sin tener que estar fisicamente en el establecimiento</p>
          </div>
          <a class="btn btn-primary" href="{{ url('/products') }}">Comprar</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/dash/img/bg-showcase-1.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Acerca de nosotros</h2>
          <p class="lead mb-0">Somos una empresa 100% leonesa que se propone expandirse a nivel nacional y posteriorimente internacional</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>Misión</h2>
          <p class="lead mb-0">Aquí pondremos la misión de la empresa</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-3.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Visión</h2>
          <p class="lead mb-0">Aquí pondría la misión de la empresa... Si tan solo la tuviera!!!!</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">Lo que la gente opina...</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
            <h5>Margaret E.</h5>
            <p class="font-weight-light mb-0">"Es el mejor bar de la ciudad"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
            <h5>Fred S.</h5>
            <p class="font-weight-light mb-0">"No puedo esperar para volver y disfrutar de sus bebidas!!"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
            <h5>Sarah W.</h5>
            <p class="font-weight-light mb-0">"La atención es lo mejor y su pagina en línea es inovador!"</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">Acerca de</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contacto</a>
            </li>
          </ul>
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

</body>

</html>
