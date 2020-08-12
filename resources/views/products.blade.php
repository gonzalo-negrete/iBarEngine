@extends('layouts.mainC')

@section('contenido')

{{-- Agregar Productos --}}
<div class="row">
    @foreach($products as $product)
        <div class="col-4">
        </br>
            <div class="card" style="width: 22rem;">
            <img class="card-img-top" src="{{$product->rutaImagen}}" width="100" height="250" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">{{ $product->nombre }}</h5>
            <p class="card-text">{{ $product->descripcion }}</p>
            <p class="card-text"><strong>Precio: </strong> {{ $product->precio }}$</p>
            <a href="{{ url('product.detail/'.$product->id) }}" class="btn btn-primary">Detalle</a>
            </br>
            <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-success">Agregar a carrito</a>
            </div>
            </div>
            </div>
            @endforeach
            </div>
            </br>
            <a href="{{ url('cart/') }}" class="btn btn-success" role="button" aria-pressed="true">Carrito de compras</a>
{{-- Agregar Productos --}}
            </br>
            {!! $products->render() !!}

</div>
@endsection