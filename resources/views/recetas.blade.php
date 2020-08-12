@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de recetas</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" data-toggle="modal" data-target="#modalAgregar">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Agregar receta
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
        <table class="table col-12">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- Modal agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/recetas" method="post">
                @csrf
                <div class="modal-body">
                <div class="row">
                    @if($message = Session::get('ErrorInsert'))
                    <div class="col-12 alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Atención!</strong>
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                        <label for="producto">Producto:</label>
                        <select name="producto" id="producto" class="form-control">
                            <option value=""></option>
                            @foreach($productos as $producto)
                                <option value='{{ $producto->id }}'>{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cantidad ML:</label>
                            <input type="number" id="cantidadML" class="form-control" name="cantidadML" placeholder="Cantidad de ml a usar" value="{{ old('cantidadML') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre de la receta" value="{{ old('nombre') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <textarea name="descripcion" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button id="btnAdd" class="btn btn-dark float-right" type="button"> Agregar</button>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <table class="table col-12" id="tblIngredientes">
                    <thead>
                        <tr>
                            <td style="display:none;">ID</td>
                            <td>Producto</td>
                            <td class="text-right">Cantidad en ML</td>
                            <td class="text-center">Acciones</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="txtID" name="txtID">
                    <input type="hidden" id="txtCANT" name="txtCANT">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal agregar -->
@endsection

@section('scripts')
    <script>
        var ids = "";
        var cantF = "";
        $(document).ready(function(){
            $('#btnAdd').click(function(){
                ids = "";
                cantF = "";
                var producto = $('select[name="producto"] option:selected').text();
                var canML = $('#cantidadML').val();
                var id = $('#producto').val();

                var tr = "<tr><td style='display:none;'>"+id+"</td><td>"+producto+"</td><td class='text-right'>"+canML+"</td><td class='text-center'><button data-id='"+id+"' data-can='"+canML+"' class='btn btn-round btnQuitar' type='button'><i class='fa fa-window-close'></i> </button></td></tr>";

                $('#tblIngredientes tr:last').after(tr);

                $('.btnQuitar').each(function() {
                    ids += $(this).data('id') + ",";
                    cantF += $(this).data('can') + ",";
                });

                $('#txtID').val(ids);
                $('#txtCANT').val(cantF);
                $('.btnQuitar').click(function(){
                    $(this).parents("tr").remove();

                    ids = "";
                    cantF = "";
                    $('.btnQuitar').each(function() {
                        ids += $(this).data('id') + ",";
                        cantF += $(this).data('can') + ",";
                    });

                    $('#txtID').val(ids);
                    $('#txtCANT').val(cantF); 
                });
            });
        });
    </script>
@endsection