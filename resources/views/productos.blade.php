@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de productos</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" data-toggle="modal" data-target="#modalAgregar">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Agregar producto
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
                    <th>Cve. Producto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->claveProducto }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td class="text-right">{{ $producto->precio }}</td>
                    <td class="text-right">{{ $producto->stock }}</td>
                    <td class="text-center">
                        <button class="btn btn-round btnEliminar" data-id="{{ $producto->id }}" data-toggle="modal" data-target="#modalEliminar">
                            <i class="fa fa-trash"></i> 
                        </button>
                        <button class="btn btn-round btnEditar" 
                        data-id="{{ $producto->id }}"
                        data-nombre="{{ $producto->nombre }}"
                        data-cveproducto="{{ $producto->claveProducto }}"
                        data-precio="{{ $producto->precio }}"
                        data-cantidad="{{ $producto->stock }}"
                        data-descripcion="{{ $producto->descripcion }}"
                        data-cantidadml="{{ $producto->cantidadML }}"
                        data-toggle="modal" 
                        data-target="#modalEditar">
                            <i class="fa fa-edit"></i> 
                        </button>

                        <button class="btn btn-round btnInsumo" data-toggle="modal" 
                        data-target="#modalInsumo"
                        data-id="{{ $producto->id }}"
                        data-ml="{{ $producto->cantidadML }}">
                            <i class="fa fa-angle-right"></i> 
                        </button>

                        <form action="{{ url('/admin/productos', ['id'=>$producto->id]) }}" method="post" id="formEliPro_{{ $producto->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $producto->id }}">
                        <input type="hidden" name="_method" value="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal crear insumos -->
    <div class="modal fade" id="modalInsumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar insumo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/productos/insumo" method="post">
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
                            <label>Nombre insumo:</label>
                            <input class="form-control" name="nameInsumo" placeholder="Nombre del insumo" value="{{ old('nameInsumo') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>N° de productos:</label>
                            <input type="number" class="form-control" id="numProducto" name="numProducto" placeholder="Número de productos a agregar" value="{{ old('numProducto') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Total ML:</label>
                            <input class="form-control" id="totalML" name="totalML" placeholder="Total de ML" type="number" value="{{ old('totalML') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" name="descripcionInsumo" rows="3" value="{{ old('descripcionInsumo') }}"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>ML por producto:</label>
                            <input class="form-control" id="MLXP" name="MLXP" disabled type="number" value="{{ old('MLXP') }}"> 
                        </div>
                    </div>
                </div>
                </div>
                <input type="hidden" id="idPro" name="idPro">
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success"> Agregar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin de modal crear insumos -->

    <!-- Modal agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/productos" method="post" enctype="multipart/form-data">
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
                            <label>Cve. Producto:</label>
                            <input class="form-control" name="claveProducto" placeholder="Clave del producto" value="{{ old('claveProducto') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Precio:</label>
                            <input class="form-control" name="precio" placeholder="Precio" type="number" value="{{ old('precio') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input class="form-control" name="stock" placeholder="Cantidad de productos" type="number" value="{{ old('stock') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Proveedor:</label>
                            <select class="form-control" name="proveedor_id">
                                <option></option>
                                @foreach($proveedores as $proveedor)
                                    <option value='{{ $proveedor->id }}'>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
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
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cantidad de mililitros:</label>
                            <input class="form-control" name="cantidadML" type="number" value="{{ old('cantidadML') }}"> 
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/productos/edit" method="post" enctype="multipart/form-data">
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
                            <input class="form-control" id="nameEdit" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cve. Producto:</label>
                            <input class="form-control" id="cveEdit" name="claveProducto" placeholder="Clave del producto" value="{{ old('claveProducto') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Precio:</label>
                            <input class="form-control" id="precioEdit" name="precio" placeholder="Precio" type="number" value="{{ old('precio') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input class="form-control" id="stockEdit" name="stock" placeholder="Cantidad de productos" type="number" value="{{ old('stock') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Proveedor:</label>
                            <select class="form-control" name="proveedor_id">
                                <option></option>
                                @foreach($proveedores as $proveedor)
                                    <option value='{{ $proveedor->id }}'>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input class="form-control" name="rutaImagenEdit" type="file"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" id="descripcionEdit" name="descripcion" rows="3" value="{{ old('descripcion') }}"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Cantidad de mililitros:</label>
                            <input class="form-control" id="cantidadMlEdit" name="cantidadMlEdit" type="number" value="{{ old('cantidadMlEdit') }}"> 
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
    <!-- Fin de modal editar -->

    <!-- Modal eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Estas seguro de que deseas eliminar este producto?</h5>
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
            @if($message = Session::get('Error1'))
                $('#modalInsumo').modal('show');
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
                $('#cveEdit').val($(this).data('cveproducto'));
                $('#precioEdit').val($(this).data('precio'));
                $('#stockEdit').val($(this).data('cantidad'));
                $('#descripcionEdit').val($(this).data('descripcion'));
                $('#cantidadMlEdit').val($(this).data('cantidadml'));
            });

            $('.btnInsumo').click(function(){
                $('#idPro').val($(this).data('id'));
                $('#MLXP').val($(this).data('ml'));
            });

            $('#numProducto').keyup(function() {
                var nP = $('#numProducto').val();
                var tML = $('#MLXP').val();
                var total = 0;
                
                total = parseFloat(nP) * parseFloat(tML);
                
                $('#totalML').val(total);
            });
            
        });
    </script>
@endsection