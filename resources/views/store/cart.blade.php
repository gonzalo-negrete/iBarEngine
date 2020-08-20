@extends('store.template')

@section('content')

	<div class="container text-center">
		<div class="page-header">
  			<h1><i class="fa fa-shopping-cart"></i> Carrito de compra</h1>
		</div>

		<div class="table-cart">
		@if(count($cart))
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>
								Imagen
							</th>
							<th>
								Producto
							</th>
							<th>
								Precio
							</th>
							<th>
								Cantidad
							</th>
							<th>
								Sub-total
							</th>
							<th>
								Quitar
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $item)
						<tr>
							<td><img src="{{ $item->rutaImagen }}"></td>
							<td>{{ $item->nombre }}</td>
							<td>{{ number_format($item->precio,2) }}</td>
							<td>
								<input 
									type="number" 
									min="1"
									max="{{ $item->stock }}"
									value="{{ $item->quantity }}"
									id="producto_{{ $item->id }}" 
								>
								<a 
									class="btn btn-warning btn-update-item" 
									href="#"
									data-href="{{ route('cart-update', $item->id) }}"
									data-id="{{ $item->id }}"
									>

									<i class="fa fa-refresh"></i>
								</a>
							</td>
							<td>{{ number_format($item->precio * $item->quantity, 2) }}</td>
							
							<td>
								<a class="btn btn-danger" href="{{ route('cart-delete', $item->id) }}">
									<i class="fa fa-remove"></i>
								</a>
							</td>
						</tr>
					</tbody>
					@endforeach
				</table><hr>
				<h3><span class="label label-success">Total: {{ number_format($total, 2) }}</span></h3>
			</div>
			<p>
			<a class="btn btn-outline-danger" href="{{ route('cart-trash') }}">
				Vaciar carrito <i class="fa fa-trash"></i>
			</a>
			@if($item->quantity > $item->stock)
			<h3><span class="text-danger">Solo se tienen: {{$item->stock}} unidades disponibles de {{$item->nombre}} para su venta</span></h3>
			<p>
				<button class="btn btn-outline-primary" href="{{ route('home') }}" disabled="tue">
					<i class="fa fa-chevron-circle-left"> Seguir comprando</i>
				</button>
			
				<button class="btn btn-outline-success" href="{{ route('order-detail') }}" disabled="tue">
					Continuar <i class="fa fa-chevron-circle-right"></i>
				</button>
			</p>
			@else
			<p>
				<a class="btn btn-outline-primary" href="{{ route('home') }}">
					<i class="fa fa-chevron-circle-left"> Seguir comprando</i>
				</a>
			
				<a class="btn btn-outline-success" href="{{ route('order-detail') }}">
					Continuar <i class="fa fa-chevron-circle-right"></i>
				</a>
			</p>
			@endif
			</p>
			@else
				<h3><span class="text-danger">El carrito se encuentra vacío</span></h3>
			@endif
			<hr>
		</div>
	</div>

@endsection