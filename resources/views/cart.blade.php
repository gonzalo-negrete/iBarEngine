@extends('layouts.mainC')

@section('contenido')

</br>
</br>
{{-- Agregar detalle al carrito --}}
     <?php $valor = 0 ?>

        @if(session('cart'))

            <table class="table">
                <thead class="thread-dark">
                <tr>
                <td>
                    Producto
                </td>
                <td>
                    Precio unitario
                </td>
                <td>
                    Cantidad
                </td>
                <td>
                    Precio Total
                </td>
                </tr>
                </thead>

                        @foreach(session('cart') as $id=>$details)
                            <?php $valor += $details['precio'] * $details['quantity'] ?>
                            
                            <tr>
                                <th>
                                    {{ $details['nombre'] }}
                                </th>
                                <th>
                                    $ {{ $details['precio'] }}
                                </th>
                                <th>
                                    {{ $details['quantity'] }}
                                </th>
                                <th>
                                    {{ $details['precio'] * $details['quantity'] }}
                                </th>

                            </tr>

                            @endforeach
                        </table>
                        @endif
                    <table aligne=""rigth>
                        <th>
                            <div class="badge badge text-wrap" style="width: 75rem;">
                            <p></p>
                            <p><strong> Total $ {{ $valor }}</strong></p>
                            </div>
                        </th>
                    </table>
                    </br>
                    <a href="{{ url('products/') }}" class="btn btn-success" role="button" aria-pressed="true">Realizar compra</a>
                    </br>
                    </br>
                    <a href="{{ url('products/') }}" class="btn btn-success" role="button" aria-pressed="true">Agregar más productos a carrito</a>                    
                    {{-- Agregar detalle al carrito --}}
                </div>
@endsection
