@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de ventas</h1>
        <a id="btnMerma" href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm">
            <i class="fas fa-filter fa-sm text-white-50">
            </i> Consultar Mermas
        </a>
    </div>
    <div class="row">
        @if($message = Session::get('Listo'))
        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Atención!</strong>
            <span>{{ $message }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <br>
        <div class="col-6">
            <div class="input-group">
                <input id="txtBuscarV" type="text" class="form-control bg-light border-0 small" placeholder="Buscar...">
                <div class="input-group-append">
                <button class="btn btn-dark" type="button" id="btnBuscarV" disabled>
                    <i class="fas fa-search fa-sm"></i>
                </button>
                </div>
            </div>    
        </div>
        <br>
        <br>
        <br>
        <div class="col-12">
            <table class="table col-12" id="tblVentas">
                <thead>
                    <tr>
                        <th>Tipo de pago</th>
                        <th class="text-right">Fecha</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->tipoPago }}</td>
                        <td class="text-right">{{ $venta->fechaVenta }}</td>
                        <td class="text-right">{{ $venta->total }}</td>
                        <td class="text-center">
                            <button class="btn btn-round btnEliminar" data-id="{{ $venta->id }}" data-toggle="modal" data-target="#modalEliminar">
                                <i class="fa fa-angle-double-right"></i> 
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Merma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="/admin/ventas/crearMerma" method="post">
                @csrf
                    <h5>¿Estas seguro de que desea convertir esta venta en una merma?</h5>
                    <hr>
                    <label for="">Escribe una observación del porque esta venta se hara merma</label>
                    <textarea class="form-control" name="observ" id="observ" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idVentaM" name="idVentaM">
                        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"> Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-danger btnModalEliminar"> Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal eliminar -->

    <!-- Modal consultar mermas -->
    <div class="modal fade" id="modalConsultar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Consultar Mermas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                                <strong>¡Atención!</strong>
                                <span>Aqui se muestra un listado de las mermas disponibles</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <table class="table col-12" id="tblMermas">
                            <thead>
                                <tr>
                                    <th>Tipo de pago</th>
                                    <th class="text-right">Fecha</th>
                                    <th class="text-right">Total</th>
                                    <th>Obervaciones de merma</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyMermas">
                                
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="idVentaM" name="idVentaM">
                            <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"> Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-danger btnModalEliminar"> Aceptar</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal consultar mermas -->
@endsection

@section('scripts')
    <script>
        var idEliminar = 0;
        $(document).ready(function(){
            @if($message = Session::get('ErrorInsert'))
                $('#modalAgregar').modal('show');
            @endif
            $('.btnEliminar').click(function(){
                $('#idVentaM').val($(this).data('id'));
            });

            $('#btnMerma').click(function(){
                $.ajax({
                    url: '/admin/ventas/showMerma',
                    method: 'POST',
                    data:{
                        _token: $('input[name="_token"]').val()
                    }
                }).done(function(res){
                    var array = JSON.parse(res);
                    var todo = "";
                    console.log(array);
                    for(var x=0;x<array.length;x++){
                        todo += '<tr><td>'+array[x].tipoPago+'</td>';
                        todo += '<td class="text-right">'+array[x].fechaVenta+'</td>';
                        todo += '<td class="text-right">'+array[x].total+'</td>';
                        todo += '<td>'+array[x].observacionMerma+'</td></tr>';
                    }
                    $('#tbodyMermas').html(todo);
                    $('#modalConsultar').modal('show');
                });
            });

            $("#txtBuscarV").keyup(function(){
                filtrarVentas();
            });

            function filtrarVentas() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("txtBuscarV");
                filter = input.value.toUpperCase();
                table = document.getElementById("tblVentas");
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