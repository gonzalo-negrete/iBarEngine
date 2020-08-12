@extends('layouts.mainC')
@section('contenido')

<a class="navbar-brand" href="{{ url('/products') }}"> Ver más productos</a>
</br>
</br>
    {{-- Detalle Productos --}}
    <div class="col-12">
        <img src="{{$product->rutaImagen}}" width="300" height="300">
        <h4>{{ $product->nombre }}</h4>
        <p>{{ $product->descripcion }}</p>
        <p><strong>Precio: </strong> {{ $product->precio }}$</p>
        <p><strong>Stock: </strong> {{ $product->stock }} unidades</p>
    </div>
    {{-- Detalle Productos --}}
@endsection
