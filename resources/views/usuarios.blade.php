@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de usuarios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" data-toggle="modal" data-target="#modalAgregar">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Agregar usuario
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
                    <th>Telefono</th>
                    <th>Jerarquia</th>
                    <th>Email</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name . " " .  $usuario->aPaterno . " " . $usuario->aMaterno}}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->nivel }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td class="text-center">
                        <button class="btn btn-round btnEliminar" data-id="{{ $usuario->id }}" data-toggle="modal" data-target="#modalEliminar">
                            <i class="fa fa-trash"></i> 
                        </button>
                        <button class="btn btn-round btnEditar" 
                        data-id="{{ $usuario->id }}"
                        data-nombre="{{ $usuario->name }}"
                        data-aPaterno="{{ $usuario->aPaterno }}"
                        data-aMaterno="{{ $usuario->aMaterno }}"
                        data-telefono="{{ $usuario->telefono }}"
                        data-email="{{ $usuario->email }}"
                        data-toggle="modal" 
                        data-target="#modalEditar">
                            <i class="fa fa-edit"></i> 
                        </button>
                        <form action="{{ url('/admin/usuarios', ['id'=>$usuario->id]) }}" method="post" id="formEliPro_{{ $usuario->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $usuario->id }}">
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/usuarios" method="post">
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
                            <input class="form-control" name="name" value="{{ old('name') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>A. Paterno:</label>
                            <input class="form-control" name="aPaterno" value="{{ old('aPaterno') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>A. Materno:</label>
                            <input class="form-control" name="aMaterno" value="{{ old('aMaterno') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input class="form-control" name="pass1" type="password">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Confirmar contraseña:</label>
                            <input class="form-control" name="pass2" type="password">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input class="form-control" name="img" type="file"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Nivel:</label>
                            <select name="nivel" id="nivel" class="form-control">
                                <option value=""></option>
                                <option value="empleado">Empleado</option>
                                <option value="gerente">Gerente</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Telefono:</label>
                            <input class="form-control" name="telefono" type="number" value="{{ old('telefono') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" name="email" type="email" value="{{ old('email') }}"> 
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

    <!-- Modal eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Estas seguro de que deseas eliminar este usuario?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cancelar</button>
                    <button type="button" class="btn btn-danger btnModalEliminar"> Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de modal eliminar -->

    <!-- Modal agregar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/usuarios/edit" method="post">
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
                            <input class="form-control" name="nameEdit" id="nameEdit"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>A. Paterno:</label>
                            <input class="form-control" name="aPaternoEdit" id="aPaternoEdit" value="{{ old('aPaternoEdit') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>A. Materno:</label>
                            <input class="form-control" name="aMaternoEdit" id="aMaternoEdit"  value="{{ old('aMaternoEdit') }}"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input class="form-control" name="pass1Edit" type="password">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Confirmar contraseña:</label>
                            <input class="form-control" name="pass2Edit" type="password">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input class="form-control" name="imgEdit" type="file"> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Nivel:</label>
                            <select name="nivelEdit" id="nivelEdit" class="form-control">
                                <option value=""></option>
                                <option value="empleado">Empleado</option>
                                <option value="gerente">Gerente</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Telefono:</label>
                            <input class="form-control" name="telefonoEdit" id="telefonoEdit" type="number" value="{{ old('telefono') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" name="emailEdit" id="emailEdit" type="email" value="{{ old('email') }}"> 
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
                $('#aPaternoEdit').val($(this).data('apaterno'));
                $('#aMaternoEdit').val($(this).data('amaterno'));
                $('#telefonoEdit').val($(this).data('telefono'));
                $('#emailEdit').val($(this).data('email'));
            });
        });
    </script>
@endsection