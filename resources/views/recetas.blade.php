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
                    <th class="text-right">Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                <tr>
                    <td>{{ $receta->nombre }}</td>
                    <td>{{ $receta->descripcion }}</td>
                    <td class="text-right">{{ $receta->precio }}</td>
                    <td class="text-center">
                        <button class="btn btn-round btnMostrar" 
                        data-id="{{ $receta->id }}"
                        data-nombre="{{ $receta->nombre }}"
                        data-descripcion="{{ $receta->descripcion }}"
                        data-precio="{{ $receta->precio }}"
                        data-img="{{ $receta->rutaImagen }}"
                        data-toggle="modal" data-target="#modalMostrar">
                            <i class="fa fa-search"></i>
                        </button>
                        <button class="btn btn-round btnEditar"
                        data-id="{{ $receta->id }}"
                        data-nombre="{{ $receta->nombre }}"
                        data-descripcion="{{ $receta->descripcion }}"
                        data-precio="{{ $receta->precio }}"
                        data-img="{{ $receta->rutaImagen }}"
                        data-toggle="modal" data-target="#modalEditar">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-round btnEliminar"
                        data-id="{{ $receta->id }}" 
                        data-toggle="modal" 
                        data-target="#modalEliminar">
                            <i class="fa fa-trash"></i>
                        </button>
                        <form action="{{ url('/admin/recetas', ['id'=>$receta->id]) }}" method="post" id="formEliPro_{{ $receta->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $receta->id }}">
                        <input type="hidden" name="_method" value="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar receta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/recetas" method="post" enctype="multipart/form-data">
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
                        <label for="insumo">Insumo:</label>
                        <select name="insumo" id="insumo" class="form-control">
                            <option value=""></option>
                            @foreach($insumos as $insumo)
                                <option value='{{ $insumo->id }}'>{{ $insumo->nombre }}</option>
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
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Precio:</label>
                            <input type="number" id="precio" class="form-control" name="precio" value="{{ old('precio') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="img">Imagen</label>
                            <input type="file" name="img">
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-8 col-xs-8">
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

    <!-- Modal mostrar -->
    <div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver datos de la receta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/" method="post">
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
                            <label>Nombre:</label>
                            <input type="text" id="nombreMostrar" class="form-control" name="nombreMostrar" disabled> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Precio:</label>
                            <input type="number" id="precioMostrar" class="form-control" name="precioMostrar" disabled> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <img class="img-thumbnail" id="imgMostrar">
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <label for="descripcionEdit">Descripción</label>
                            <textarea id="descripcionMostrar" name="descripcionMostrar" class="form-control" rows="5" disabled></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="idShow" name="idShow">
                </div>
                <br>
                <br>
                <hr>
                <span class="badge badge-dark">Ingredientes</span>
                <hr>
                <table class="table col-12" id="tblMostrar">
                    <thead>
                        <tr>
                            <td style="display:none;">ID</td>
                            <td>Producto</td>
                            <td class="text-right">Cantidad en ML</td>
                        </tr>
                    </thead>
                    <tbody id="tbodyMostrar">

                    </tbody>
                </table>
                <br>
                </div>
                <div class="modal-footer">
                <div class="col-12 alert alert-info alert-dismissible fade show" role="alert">
                        <strong>¡Atención!</strong>
                        <span>Unicamente se pueden consultar los datos referente a la receta dentro de este apartado</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal mostrar -->

    <!-- Modal editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar receta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/recetas/edit" method="post" enctype="multipart/form-data">
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
                        <label for="insumoEdit">Insumo:</label>
                        <select name="insumoEdit" id="insumoEdit" class="form-control">
                            <option value=""></option>
                            @foreach($insumos as $insumo)
                                <option value='{{ $insumo->id }}'>{{ $insumo->nombre }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cantidad ML:</label>
                            <input type="number" id="cantidadMLEdit" class="form-control" name="cantidadMLEdit" placeholder="Cantidad de ml a usar" value="{{ old('cantidadMLEdit') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" id="nombreEdit" class="form-control" name="nombreEdit" placeholder="Nombre de la receta" value="{{ old('nombreEdit') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <img class="img-thumbnail" id="imgEdit">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="descripcionEdit">Descripción</label>
                            <textarea name="descripcionEdit" id="descripcionEdit" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Precio:</label>
                            <input type="number" id="precioEdit" class="form-control" name="precioEdit" value="{{ old('precioEdit') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="img">Imagen</label>
                            <input type="file" name="imgCEdit">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <button id="btnAddEdit" class="btn btn-dark float-right" type="button"> Agregar</button>
                        </div>
                    </div>
                    <input type="hidden" id="idEdit" name="idEdit">
                </div>
                <br>
                <br>
                <table class="table col-12" id="tblIngredientesEdit">
                    <thead>
                        <tr>
                            <td style="display:none;">ID</td>
                            <td>Producto</td>
                            <td class="text-right">Cantidad en ML</td>
                            <td class="text-center">Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="tbodyEdit">

                    </tbody>
                </table>
                <br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="txtIDEdit" name="txtIDEdit">
                    <input type="hidden" id="txtCANTEdit" name="txtCANTEdit">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal editar -->

    <!-- Modal eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar receta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Estas seguro de que deseas eliminar esta receta?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="button" class="btn btn-danger btnModalEliminar"> Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de modal eliminar -->
@endsection

@section('scripts')
    <script>
        var ids = "";
        var cantF = "";
        var idEliminar = 0;
        $(document).ready(function(){
            $('#btnAdd').click(function(){
                ids = "";
                cantF = "";
                var insumo = $('select[name="insumo"] option:selected').text();
                var canML = $('#cantidadML').val();
                var id = $('#insumo').val();

                var tr = "<tr><td style='display:none;'>"+id+"</td><td>"+insumo+"</td><td class='text-right'>"+canML+"</td><td class='text-center'><button data-id='"+id+"' data-can='"+canML+"' class='btn btn-round btnQuitar' type='button'><i class='fa fa-window-close'></i> </button></td></tr>";

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

            $('.btnMostrar').click(function(){
                //$('#tbodyMostrar').hmtl('');
                $('#idShow').val($(this).data('id'));
                $('#nombreMostrar').val($(this).data('nombre'));
                $('#precioMostrar').val($(this).data('precio'));
                $('#descripcionMostrar').val($(this).data('descripcion'));
                $("#imgMostrar").attr("src",$(this).data('img'));
                $idAux = $(this).data('id');
                $.ajax({
                    url: '/admin/recetas/show',
                    method: 'POST',
                    data:{
                        id: $idAux,
                        _token: $('input[name="_token"]').val()
                    }
                }).done(function(res){
                    var array = JSON.parse(res);
                    var todo = "";
                    console.log(array);
                    for(var x=0;x<array.length;x++){
                        todo += '<tr><td style="display:none;">'+array[x].id+'</td>';
                        todo += '<td>'+array[x].nombre+'</td>';
                        todo += '<td class="text-right">'+array[x].CantidadAux+'</td></tr>';
                    }
                    $('#tbodyMostrar').html(todo);
                });
            });
            
            $('.btnEditar').click(function(){
                
                $('#idEdit').val($(this).data('id'));
                $('#nombreEdit').val($(this).data('nombre'));
                $('#precioEdit').val($(this).data('precio'));
                $('#descripcionEdit').val($(this).data('descripcion'));
                $("#imgEdit").attr("src",$(this).data('img'));
                $idAux = $(this).data('id');
                $.ajax({
                    url: '/admin/recetas/preEdit',
                    method: 'POST',
                    data:{
                        id: $idAux,
                        _token: $('input[name="_token"]').val()
                    }
                }).done(function(res){
                    var array = JSON.parse(res);
                    var todo = "";
                    console.log(array);
                    for(var x=0;x<array.length;x++){
                        todo += '<tr><td style="display:none;">'+array[x].id+'</td>';
                        todo += '<td>'+array[x].nombre+'</td>';
                        todo += '<td class="text-right">'+array[x].CantidadAux+'</td>'
                        todo += '<td class="text-center"><button data-id='+array[x].id+' data-can='+array[x].CantidadAux+' class="btn btn-round btnQuitarE" type="button"><i class="fa fa-window-close"></i> </button></td></tr>';
                    }
                    $('#tbodyEdit').html(todo);
                    AccionesTabla();
                });

                $('#tblIngredientesEdit').on('click','.btnQuitarE',function(){
                    $(this).parents("tr").remove();

                    ids = "";
                    cantF = "";
                    $('.btnQuitarE').each(function() {
                        ids += $(this).data('id') + ",";
                        cantF += $(this).data('can') + ",";
                    });

                    $('#txtIDEdit').val(ids);
                    $('#txtCANTEdit').val(cantF); 
                });

            });

            function AccionesTabla(){
                ids = "";
                cantF = "";
                $('.btnQuitarE').each(function() {
                    ids += $(this).data('id') + ",";
                    cantF += $(this).data('can') + ",";
                });

                $('#txtIDEdit').val(ids);
                $('#txtCANTEdit').val(cantF);
            }

            $('#btnAddEdit').click(function(){
                ids = "";
                cantF = "";
                var insumo = $('select[name="insumoEdit"] option:selected').text();
                var canML = $('#cantidadMLEdit').val();
                var id = $('#insumoEdit').val();

                var tr = "<tr><td style='display:none;'>"+id+"</td><td>"+insumo+"</td><td class='text-right'>"+canML+"</td><td class='text-center'><button data-id='"+id+"' data-can='"+canML+"' class='btn btn-round btnQuitarE' type='button'><i class='fa fa-window-close'></i> </button></td></tr>";

                $('#tblIngredientesEdit tr:last').after(tr);

                $('.btnQuitarE').each(function() {
                    ids += $(this).data('id') + ",";
                    cantF += $(this).data('can') + ",";
                });

                $('#txtIDEdit').val(ids);
                $('#txtCANTEdit').val(cantF);
                $('.btnQuitarE').click(function(){
                    $(this).parents("tr").remove();

                    ids = "";
                    cantF = "";
                    $('.btnQuitarE').each(function() {
                        ids += $(this).data('id') + ",";
                        cantF += $(this).data('can') + ",";
                    });

                    $('#txtIDEdit').val(ids);
                    $('#txtCANTEdit').val(cantF); 
                });
            });

            $('.btnEliminar').click(function(){
                idEliminar = $(this).data('id');
            });
            $('.btnModalEliminar').click(function(){
                $('#formEliPro_'+idEliminar).submit();
            });

        });
    </script>
@endsection