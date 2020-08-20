@extends('layouts.main')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Estas en el módulo de caja</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" id="btnP" data-toggle="modal" data-target="#modalCarroCompra">
        <i class="fas fa-shopping-cart fa-sm text-white-50">
        </i> Orden 
    </a>
</div>

@if($message = Session::get('Listo'))
    <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡Atención!</strong>
        <span>{{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row fixed-top" id="DivAlertP">
    <div class="col-6"></div>
    <div class="col-6 alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡Atención!</strong>
        <span>Productos agregados al carro de compra</span>
        <button id="btnClose" type="button" class="close">
            <span>&times;</span>
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card bg-info text-white">
            <div class="card-body">Productos</div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-6">
        <div class="input-group">
            <input id="txtBuscarPro" type="text" class="form-control bg-light border-0 small" placeholder="Buscar...">
            <div class="input-group-append">
            <button class="btn btn-dark" type="button" id="btnBuscarPro" disabled>
                <i class="fas fa-search fa-sm"></i>
            </button>
            </div>
        </div>    
    </div>
</div>
<br>

<div class="row">
    <div class="col-12">
        <table class="table" id="tblProductosCarro">
            <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>
                            <input class="form-control" type="text" name="stock_{{ $producto->id }}" id="stock_{{ $producto->id }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success btnAgregar"
                            id="btnAgregar" name="btnAgregar"
                            data-id="{{ $producto->id }}"
                            data-stock="{{ $producto->stock }}"
                            data-precio="{{ $producto->precio }}"
                            data-nombre="{{ $producto->nombre }}">
                            Agregar a carrito
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card bg-info text-white">
            <div class="card-body">Bebidas preparadas</div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-6">
        <div class="input-group">
            <input id="txtBuscarRec" type="text" class="form-control bg-light border-0 small" placeholder="Buscar...">
            <div class="input-group-append">
            <button class="btn btn-dark" type="button" id="btnBuscarRec" disabled>
                <i class="fas fa-search fa-sm"></i>
            </button>
            </div>
        </div>    
    </div>
</div>
<br>

<div class="row">
    <div class="col-12">
        <table class="table" id="tblRecetasCarro">
            <thead>
                <th>Bebida</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                    <tr>
                        <td>{{ $receta->nombre }}</td>
                        <td>{{ $receta->descripcion }}</td>
                        <td>{{ $receta->precio }}</td>
                        <td>
                            <input class="form-control" type="text" name="num_{{ $receta->id }}" id="num_{{ $receta->id }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success btnAgregarRe"
                            id="btnAgregarRe" name="btnAgregarRe"
                            data-id="{{ $receta->id }}"
                            data-precio="{{ $receta->precio }}"
                            data-nombre="{{ $receta->nombre }}">
                            Agregar a carrito
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal carro de compra -->
<div class="modal fade" id="modalCarroCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Carro de compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/caja" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    @if($message = Session::get('Error1'))
                    <div class="col-12 alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>¡Atención!</strong>
                    <span>{{ $message }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="lstTipo">Tipo de pago</label>
                            <select class="form-control" name="lstTipo" id="lstTipo">
                                <option value=""></option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4" style="display: none" id="DivPago">
                        <div class="form-group">
                            <label>Efectivo</label>
                            <input type="text" class="form-control" id="tuPago" name="tuPago">
                        </div>
                    </div>
                </div>
                <hr>
                <span class="badge badge-primary">Productos</span>
                <hr>
                <table class="table col-12" id="tblProductos">
                    <thead>
                        <tr>
                            <td style="display:none;">ID</td>
                            <td>Producto</td>
                            <td class="text-right">Precio</td>
                            <td class="text-center">Acciones</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <br>
                <br>
                <hr>
                <span class="badge badge-primary">Bebidas preparadas</span>
                <hr>
                <table class="table col-12" id="tblBebidas">
                    <thead>
                        <tr>
                            <td style="display:none;">ID</td>
                            <td>Bebida</td>
                            <td class="text-right">Precio</td>
                            <td class="text-center">Acciones</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <input type="hidden" id="totalPro" value="0">
            <input type="hidden" id="totalRec" value="0">
            <input type="hidden" id="total" name="total">
            <input type="hidden" id="idPro" name="idPro">
            <input type="hidden" id="idRec" name="idRec">
            <input type="hidden" id="idUser" name="idUser" value="{{ Auth::user()->id }}">
            <div class="modal-footer">
                <h5><span class="badge badge-primary" id="txtTotal">Total $ </span></h5>
                <button type="submit" class="btn btn-success"> Comprar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin de modal carro de compra -->
@endsection

@section('scripts')
    <script>
        var totalP=0;
        var totalR=0;
        var total=0;
        var totalF=0;
        var idsP = "";
        var idsR = "";
        var precioAux = 0;
        $(document).ready(function(){
            $('#DivAlertP').hide();
            $('#btnClose').click(function(){
                $('#DivAlertP').hide();
            });

            //Productos
            $('.btnAgregar').click(function(){
                idsP = "";
                precioAux = 0;
                var producto = $(this).data('nombre');
                var precio = $(this).data('precio');
                var id = $(this).data('id');
                var cantidad = $('#stock_'+id).val();
                
                for (var i = 0; i < cantidad; i++) {
                    var tr = "<tr><td style='display:none;'>"+id+"</td><td>"+producto+"</td><td class='text-right'>"+precio+"</td><td class='text-center'><button data-id='"+id+"' data-precio="+precio+" class='btn btn-round btnQuitar' type='button'><i class='fa fa-window-close'></i> </button></td></tr>";
                    $('#tblProductos tr:last').after(tr);
                }

                $('.btnQuitar').each(function() {
                    idsP += $(this).data('id') + ",";
                    precioAux += $(this).data('precio');
                });

                totalR = $('#totalRec').val();
                
                totalF = parseFloat(precioAux)+parseFloat(totalR);
                
                $('#totalPro').val(precioAux);
                $('#total').val(totalF);
                $('#txtTotal').html('Total: $ '+totalF);
                $('#DivAlertP').show();

                $('#idPro').val(idsP);
                $('.btnQuitar').click(function(){
                    $(this).parents("tr").remove();

                    idsP = "";
                    precioAux=0;
                    $('.btnQuitar').each(function() {
                        idsP += $(this).data('id') + ",";
                        precioAux += $(this).data('precio');
                    });
                    $('#totalPro').val(precioAux);
                    totalR = $('#totalRec').val();
                    totalF = parseFloat(precioAux)+parseFloat(totalR);

                    $('#idPro').val(idsP);
                    $('#totalPro').val(precioAux);
                    $('#total').val(totalF);
                    $('#txtTotal').html('Total: $ '+totalF);
                });
            });

            //Recetas
            $('.btnAgregarRe').click(function(){
                idsR = "";
                precioAux = 0;
                var name = $(this).data('nombre');
                var precio = $(this).data('precio');
                var id = $(this).data('id');
                var cantidad = $('#num_'+id).val();
                
                for (var i = 0; i < cantidad; i++) {
                    var tr = "<tr><td style='display:none;'>"+id+"</td><td>"+name+"</td><td class='text-right'>"+precio+"</td><td class='text-center'><button data-id='"+id+"' data-precio="+precio+" class='btn btn-round btnQuitarR' type='button'><i class='fa fa-window-close'></i> </button></td></tr>";
                    $('#tblBebidas tr:last').after(tr);
                }

                $('.btnQuitarR').each(function() {
                    idsR += $(this).data('id') + ",";
                    precioAux += $(this).data('precio');
                });

                totalP = $('#totalPro').val();

                totalF = parseFloat(precioAux)+parseFloat(totalP);
                
                $('#totalRec').val(precioAux);
                $('#total').val(totalF);
                $('#txtTotal').html('Total: $ '+totalF);
                $('#DivAlertP').show();

                $('#idRec').val(idsR);
                $('.btnQuitarR').click(function(){
                    $(this).parents("tr").remove();

                    idsR = "";
                    precioAux=0;
                    $('.btnQuitarR').each(function() {
                        idsR += $(this).data('id') + ",";
                        precioAux += $(this).data('precio');
                    });

                    totalP = $('#totalPro').val();
                    totalF = parseFloat(precioAux)+parseFloat(totalP);
                    $('#totalRec').val(precioAux);
                    $('#idRec').val(idsR);
                    $('#total').val(totalF);
                    $('#txtTotal').html('Total: $ '+totalF);
                });
            });

            $('#lstTipo').change(function(){
                var tipo = $('#lstTipo').val();
                
                if(tipo === 'Efectivo'){
                    $('#DivPago').show();
                }
                else{
                    $('#DivPago').hide();
                }
            });

            $("#txtBuscarPro").keyup(function(){
                filtrarProductos();
            });

            function filtrarProductos() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("txtBuscarPro");
                filter = input.value.toUpperCase();
                table = document.getElementById("tblProductosCarro");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }
                }
            }

            $("#txtBuscarRec").keyup(function(){
                filtrarRecetas();
            });

            function filtrarRecetas() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("txtBuscarRec");
                filter = input.value.toUpperCase();
                table = document.getElementById("tblRecetasCarro");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }
                }
            }
        });
    </script>
@endsection