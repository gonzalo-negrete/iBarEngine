@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de proveedores</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" data-toggle="modal" data-target="#modalAgregar">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Agregar proveedor
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
                    <th>Cve. Proveedor</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Correo</th>
                    <th class="text-right">Telefono</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->claveProveedor }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->descripcion }}</td>
                    <td>{{ $proveedor->correo }}</td>
                    <td class="text-right">{{ $proveedor->telefono }}</td>
                    <td class="text-center">
                        <button class="btn btn-round btnEliminar" data-id="{{ $proveedor->id }}" data-toggle="modal" data-target="#modalEliminar">
                            <i class="fa fa-trash"></i> 
                        </button>
                        <button class="btn btn-round btnEditar" 
                        data-id="{{ $proveedor->id }}"
                        data-nombre="{{ $proveedor->nombre }}"
                        data-cveproveedor="{{ $proveedor->claveProveedor }}"
                        data-correo="{{ $proveedor->correo }}"
                        data-telefono="{{ $proveedor->telefono }}"
                        data-descripcion="{{ $proveedor->descripcion }}"
                        data-toggle="modal" 
                        data-target="#modalEditar">
                            <i class="fa fa-edit"></i> 
                        </button>
                        <form action="{{ url('/admin/proveedores', ['id'=>$proveedor->id]) }}" method="post" id="formEliPro_{{ $proveedor->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $proveedor->id }}">
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/proveedores" method="post">
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
                            <input class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cve. Proveedor:</label>
                            <input class="form-control" name="claveProveedor" placeholder="Clave del proveedor" value="{{ old('claveProveedor') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Correo:</label>
                            <input class="form-control" name="correo" placeholder="Correo" type="email" value="{{ old('correo') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Teléfono:</label>
                            <input class="form-control" name="telefono" type="number" value="{{ old('telefono') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input class="form-control" name="rutaImagen" type="file"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" name="descripcion" rows="3" value="{{ old('descripcion') }}"></textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal agregar -->

    <!-- Modal editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/proveedores/edit" method="post">
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
                <input type="hidden" name="id" id="idEdit">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input class="form-control" id="nameEdit" name="nameEdit" placeholder="Nombre" value="{{ old('nameEdit') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cve. Proveedor:</label>
                            <input class="form-control" id="cveEdit" name="cveEdit" placeholder="Clave del proveedor" value="{{ old('cveEdit') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Correo:</label>
                            <input class="form-control" id="correoEdit" name="correoEdit" placeholder="Correo" type="email" value="{{ old('correoEdit') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Teléfono:</label>
                            <input class="form-control" id="telefonoEdit" name="telefonoEdit" type="number" value="{{ old('telefonoEdit') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input class="form-control" name="rutaImagen" type="file"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" rows="3" value="{{ old('descripcionEdit') }}"></textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-trash"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Editar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal agregar -->

    <!-- Modal eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Estas seguro de que deseas eliminar este proveedor?</h5>
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
        var idEliminar = 0;
        $(document).ready(function(){
            @if($message = Session::get('ErrorInsert'))
                $('#modalAgregar').modal('show');
            @endif
            $('.btnEliminar').click(function(){
                idEliminar = $(this).data('id');
            });
            $('.btnModalEliminar').click(function(){
                $('#formEliPro_'+idEliminar).submit();
            });
            $('.btnEditar').click(function(){
                $('#idEdit').val($(this).data('id'));
                $('#nameEdit').val($(this).data('nombre'));
                $('#cveEdit').val($(this).data('cveproveedor'));
                $('#correoEdit').val($(this).data('correo'));
                $('#telefonoEdit').val($(this).data('telefono'));
                $('#descripcionEdit').val($(this).data('descripcion'));
            });
        });
    </script>
@endsection