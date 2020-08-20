@extends('store.template')

@section('content')
	<div class="container text-center">
		<div class="page-header">
	  		<h1><i class="fa fa-shopping-cart"></i> Detalle de orden</h1>
		</div>
		<div class="page">
	  		<div class="table-responsive">
	  			<h3>Datos de usuario</h3>
	  			<table class="table table-striped table-type table-bordered">
	  				<tr><td>Nombre:</td><td>{{ Auth::user()->name . "". Auth::user()->last_name}}</td></tr>
	  				<tr><td>Usuario:</td><td>{{ Auth::user()->aPaterno }}</td></tr>
	  				<tr><td>Correo:</td><td>{{ Auth::user()->email }}</td></tr>
	  			</table>
	  		</div>
	  		<div class="table-responsive">
	  			<h3>Datos de pedido</h3>
	  			<table class="table table-striped table-type table-bordered">
	  				<tr>
	  					<th>Producto:</th>
	  					<th>Precio:</th>
	  					<th>Cantidad:</th>
	  					<th>Sub-total:</th>
	  				</tr>
	  				@foreach($cart as $item)
						<tr>
							<td>{{ $item->nombre }}</td>
							<td>{{ number_format($item->precio,2) }}</td>
							<td>{{ $item->quantity }}</td>
							<td>{{ number_format($item->precio * $item->quantity, 2) }}</td>
						</tr>
					</tbody>
					@endforeach
	  			</table><hr>
	  			<h3><span class=""> Total $ {{ number_format($total, 2) }}</span></h3><hr>
	  			<p>
	  				<a class="btn btn-outline-primary" href="{{ route('cart-show') }}">
					<i class="fa fa-chevron-circle-left"> Regresar</i>
				</a>

				<a class="btn btn-outline-success" href="{{ route('cart-compra') }}">
					Comprar <i class="fa fa-credit-card "></i>
				</a>
	  			</p>
	  		</div>
		</div>
	</div>
@endsection