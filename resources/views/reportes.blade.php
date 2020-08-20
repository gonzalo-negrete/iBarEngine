@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de reportes</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Crear reporte
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
                    <th>Titulo</th>
                    <th>Tipo de reporte</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                <tr>
                    <td>{{ $reporte->titulo }}</td>
                    <td>{{ $reporte->tipoReporte }}</td>
                    <td class="text-center">
                        <button class="btn btn-round btnEditar"
                        data-id="{{ $reporte->id }}"
                        data-titulo="{{ $reporte->titulo }}"
                        data-content="{{ html_entity_decode($reporte->contenido, ENT_QUOTES) }}">
                        <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-round btnCrear"
                        data-tipo="{{ $reporte->tipoReporte }}"
                        data-id="{{ $reporte->id }}">
                            <i class="fa fa-print"></i> 
                        </button>
                        <button class="btn btn-round btnEliminar"
                        data-id="{{ $reporte->id }}">
                        <i class="fa fa-trash"></i>
                        </button>
                        <form formtarget="_blank" action="{{ url('/admin/reportes/crear') }}" method="post" id="crear_{{ $reporte->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $reporte->id }}">
                        <input type="hidden" name="tipo" value="{{ $reporte->tipoReporte }}">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal crear -->
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/reportes" method="post">
                @csrf
                <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="lstTipo">Tipo de reporte</label>
                        <select class="form-control" name="lstTipo" id="lstTipo">
                            <option value=""></option>
                            <option value="Ventas">Ventas</option>
                            <option value="Mermas">Mermas</option>
                            <option value="Productos">Productos</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="titulo">Titulo</label>
                        <input type="text" class="form-control" name="titulo" id="titulo">
                    </div>
                    <div class="col-4">
                        <label>Banco de datos</label>
                        <select class="form-control" name="lstContenido" id="lstContenido">

                        </select>
                    </div>
                </div>
                <br>
                <br>
                <label>Crea tu plantilla</label>
                <textarea name="editor1" id="editor1" rows="10" cols="150" data-sample-short></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success btnModalEliminar"> Crear</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal crear -->

    <!-- Modal editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/reportes/edit" method="post">
                @csrf
                <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="lstTipoEdit">Tipo de reporte</label>
                        <select class="form-control" name="lstTipoEdit" id="lstTipoEdit">
                            <option value=""></option>
                            <option value="Ventas">Ventas</option>
                            <option value="Mermas">Mermas</option>
                            <option value="Productos">Productos</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="tituloEdit">Titulo</label>
                        <input type="text" class="form-control" name="tituloEdit" id="tituloEdit">
                    </div>
                    <div class="col-4">
                        <label>Banco de datos</label>
                        <select class="form-control" name="lstContenidoEdit" id="lstContenidoEdit">

                        </select>
                    </div>
                </div>
                <br>
                <br>
                <label>Crea tu plantilla</label>
                <textarea name="editor2" id="editor2" rows="10" cols="150" data-sample-short></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idEdit" name="idEdit">
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success btnModalEditar"> Editar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Estas seguro de que deseas eliminar este reporte?</h5>
                </div>
                <div class="modal-footer">
                <form action="/admin/reportes/delete" method="post">
                    @csrf
                    <input type="hidden" id="idDel" name="idDel">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-danger"> Eliminar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de modal eliminar -->

    <!-- Modal generar PDF merma -->
    <div class="modal fade" id="modalMerma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/reportes/crearM" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Atención!</strong>
                            <span>Seleccione las fechas en las que quiere generar su reporte de mermas</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Fecha inicio</label>
                            <input class="form-control" type="date" name="dateInicio" id="dateInicio" max="2020-08-18">
                        </div>
                        <div class="col-6">
                            <label>Fecha Fin</label>
                            <input class="form-control" type="date" name="dateFin" id="dateFin" max="2020-08-18">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idRMerma" name="idRMerma">
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success btnCrearRMerma"> Crear</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal generar PDF merma -->

    <!-- Modal generar PDF ventas -->
    <div class="modal fade" id="modalVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/reportes/crearV" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Atención!</strong>
                            <span>Seleccione las fechas en las que quiere generar su reporte de ventas</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="lstTipo">Reporte por:</label>
                            <select class="form-control" name="lstTipoV" id="lstTipoV">
                                <option value=""></option>
                                <option value="TEmpleados">Todos los empleados</option>
                                <option value="Empleado1">1 solo empleado</option>
                            </select>
                        </div>
                        <div class="col-4" style="display: none" id="DivEmpleados">
                            <label>Seleccione empleado</label>
                            <select class="form-control" name="lstEmpleado" id="lstEmpleado">
                                <option value=""></option>
                                @foreach($usuarios as $user)
                                    <option value="{{ $user->id }}">{{ $user->name . " " . $user->aPaterno . " " . $user->aMaterno }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label>Fecha inicio</label>
                            <input class="form-control" type="date" name="dateInicio" id="dateInicio" max="2020-08-18">
                        </div>
                        <div class="col-6">
                            <label>Fecha Fin</label>
                            <input class="form-control" type="date" name="dateFin" id="dateFin" max="2020-08-18">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="tipoR" name="tipoR">
                    <input type="hidden" id="nameE" name="nameE">
                    <input type="hidden" id="idRVenta" name="idRVenta">
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success btnCrearRMerma"> Crear</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal generar PDF ventas -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            @if($message = Session::get('ErrorInsert'))
                $('#modalAgregar').modal('show');
            @endif
            
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');

            $('#lstEmpleado').change(function(){
                var name = $('select[name="lstEmpleado"] option:selected').text();
                $('#nameE').val(name);
            });

            $('#lstTipoV').change(function(){
                var tipo = $('#lstTipoV').val();

                if(tipo === 'Empleado1'){
                    $('#DivEmpleados').show();
                    $('#tipoR').val('1');
                    $('#nameE').val('');
                }
                if(tipo === 'TEmpleados'){
                    $('#DivEmpleados').hide();
                    $('#tipoR').val('2');
                    $('#nameE').val('');
                }
            });

            $('#lstTipo').change(function(){
                var tipo = $('#lstTipo').val();

                if(tipo === 'Ventas'){
                    var content = "";

                    content += "<option></option>";
                    content += "<option value='#Empleado#'>Empleado</option>";
                    content += "<option value='#TEmpleados#'>Todos los empleados</option>";
                    content += "<option value='#Fecha#'>FechaActual</option>";
                    content += "<option value='#Content#'>Contenido</option>";

                    $('#lstContenido').html(content);
                }
                if(tipo === 'Mermas'){
                    var content = "";

                    content += "<option></option>";
                    content += "<option value='#Fecha#'>FechaActual</option>";
                    content += "<option value='#Content#'>Contenido</option>";

                    $('#lstContenido').html(content);
                }
                if(tipo === 'Productos'){
                    var content = "";

                    content += "<option></option>";
                    content += "<option value='#Fecha#'>FechaActual</option>";
                    content += "<option value='#Content#'>Contenido</option>";

                    $('#lstContenido').html(content);
                }
            });

            $('#lstContenido').change(function(){
                
                var editor = CKEDITOR.instances.editor1;
                var value = document.getElementById('lstContenido').value;

                if (editor.mode == 'wysiwyg')
                {
                    editor.insertHtml(value);
                } else
                    alert('Error');
            });

            $('.btnCrear').click(function(){
                var tipo = $(this).data('tipo');
                var id = $(this).data('id');
                
                if(tipo === 'Productos'){
                    $('#crear_'+id).submit();
                }
                if(tipo === 'Mermas'){
                    $('#idRMerma').val(id);
                    $('#modalMerma').modal('show');
                }
                if(tipo === 'Ventas'){
                    $('#idRVenta').val(id);
                    $('#modalVenta').modal('show');
                }
            });

            $('.btnEditar').click(function(){
                var contenido = $(this).data('content');
                var titulo = $(this).data('titulo');
                var id = $(this).data('id');
                
                var editor = CKEDITOR.instances.editor2;

                var edata = editor.getData();

                editor.setData(contenido);

                $('#tituloEdit').val(titulo);
                $('#modalEditar').modal('show');
                $('#idEdit').val(id);

                $('#lstTipoEdit').change(function(){
                    var tipo = $('#lstTipoEdit').val();

                    if(tipo === 'Ventas'){
                        var content = "";

                        content += "<option></option>";
                        content += "<option value='#Empleado#'>Empleado</option>";
                        content += "<option value='#TEmpleados#'>Todos los empleados</option>";
                        content += "<option value='#Fecha#'>FechaActual</option>";
                        content += "<option value='#Content#'>Contenido</option>";

                        $('#lstContenidoEdit').html(content);
                    }
                    if(tipo === 'Mermas'){
                        var content = "";

                        content += "<option></option>";
                        content += "<option value='#Fecha#'>FechaActual</option>";
                        content += "<option value='#Content#'>Contenido</option>";

                        $('#lstContenidoEdit').html(content);
                    }
                    if(tipo === 'Productos'){
                        var content = "";

                        content += "<option></option>";
                        content += "<option value='#Fecha#'>FechaActual</option>";
                        content += "<option value='#Content#'>Contenido</option>";

                        $('#lstContenidoEdit').html(content);
                    }
                });

            });

            $('.btnEliminar').click(function(){
                var id = $(this).data('id');
                $('#idDel').val(id);
                $('#modalEliminar').modal('show');
            });
        });
    </script>
@endsection