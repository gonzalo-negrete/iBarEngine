@extends('store.template')

@section('content')


<div class="container text-center">
	<div id="products">
		@foreach($products as $product)
			<div class="product white-panel">
				<h3>{{ $product->name }}</h3>
				<img src="{{ $product->rutaImagen }}" width="100">
				<div class="product-info panel"><hr>
					<p>{{ $product->nombre }}</p>
					<p>{{ $product->descripcion }}</p>
					<p><h4>precio: ${{ number_format($product->precio,2) }}</h4></p>
					<p>
						<a class="btn btn-outline-success" href="{{ route('cart-add', $product->id) }}"><i class="fa fa-cart-plus"></i> Add to car</a>
						<a class="btn btn-outline-primary" href="{{ route('product-detail', $product->id) }}"><i class="fa fa-chevron-circle-right"></i>Dettalles</a>
					</p>
				</div>
			</div>
		@endforeach
	</div>
	{!! $products->render() !!}
</div>
@include('store.partials.footer')
@endsection