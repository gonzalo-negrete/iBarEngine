

@extends('store.template')

@section('content')
<div class="container text-center">
	<div class="page-header">
  		<h1><i class="fa fa-calendar"></i> Detalle de reservación</h1>
	</div>

	<div class="row container text-center">
		<div class="col-md-12">
			<div class="product-block">
				<h3>Titular de mesa: {{ $reservation->titularMesa }}</h3><hr>
				<div class="product-info panel">
					<p> Fecha de reservación: {{ $reservation->fechaReservacion }}</p>
                    <h3 class="text text-success"> Hora de llegada: {{ $reservation->horaInicio }}</h3> </h3>
                    <h3 class="text text-danger">Hora de salida: {{ $reservation->horaFin }}</h3>
                    <h3 class="text text-warning">Número de personas: {{ $reservation->numPersonas }}</h3>
					</p>
					<p>
						<a class="btn btn-outline-primary" href="{{ route('reservations.index') }}">
							<i class="fa fa-chevron-circle-left"></i> Regresar
						</a>
					</p>
				</div>
			</div>
		</div>
	</div><hr>
</div>

@endsection