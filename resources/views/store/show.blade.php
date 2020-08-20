@extends('store.template')

@section('content')
<div class="container text-center">
	<div class="page-header">
  		<h1><i class="fa fa-shopping-cart"></i> Detalle del producto</h1>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="product-block">
				<img src="{{ $product->rutaImagen }}" >
			</div>
		</div>
		<div class="col-md-6">
			<div class="product-block">
				<h3>{{ $product->nombre }}</h3><hr>
				<div class="product-info panel">
					<p>{{ $product->descripcion }}</p>
					<h3 class="text text-warning">precio: ${{ number_format($product->precio,2) }}</h3>
					
					<p>
					<a class="btn btn-outline-success" href="{{ route('cart-add', $product->id) }}">Add to car <i class="fa fa-cart-plus fa-2x"></i></a>
					</p>
					<p>
						<a class="btn btn-outline-primary" href="{{ route('home') }}">
							<i class="fa fa-chevron-circle-left"></i> Regresar
						</a>
					</p>
				</div>
			</div>
		</div>
	</div><hr>
</div>
@include('store.partials.footer')
@endsection