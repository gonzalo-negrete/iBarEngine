@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de mesas</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm" data-toggle="modal" data-target="#modalAgregar">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Agregar mesa
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
                    <th>Tipo de mesa</th>
                    <th class="text-right">N° de sillas</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mesas as $mesa)
                <tr>
                    <td>{{ $mesa->tipoMesa }}</td>
                    <td class="text-right">{{ $mesa->numSillas }}</td>
                    <td class="text-center">
                        <button class="btn btn-round btnEliminar" data-id="{{ $mesa->id }}" data-toggle="modal" data-target="#modalEliminar">
                            <i class="fa fa-trash"></i> 
                        </button>
                        <button class="btn btn-round btnEditar" 
                        data-id="{{ $mesa->id }}"
                        data-tipomesa="{{ $mesa->tipoMesa }}"
                        data-numsillas="{{ $mesa->numSillas }}"
                        data-toggle="modal" 
                        data-target="#modalEditar">
                            <i class="fa fa-edit"></i> 
                        </button>
                        <form action="{{ url('/admin/mesas', ['id'=>$mesa->id]) }}" method="post" id="formEliPro_{{ $mesa->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $mesa->id }}">
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/mesas" method="post">
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
                            <label>Tipo de mesa:</label>
                            <select name="tipoMesa" id="tipoMesa" class="form-control">
                                <option value=""></option>
                                <option value="Planta baja">Planta Baja</option>
                                <option value="Terraza">Terraza</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>N° de sillas:</label>
                            <input class="form-control" name="numSillas" placeholder="Ingresa el número de sillas que tiene la mesa" value="{{ old('numSillas') }}"> 
                        </div>
                    </div>
                </div>
                <br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/mesas/edit" method="post">
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
                            <label>Tipo de mesa:</label>
                            <select name="tipoMesaEdit" id="tipoMesaEdit" class="form-control">
                                <option value=""></option>
                                <option value="Planta baja">Planta Baja</option>
                                <option value="Terraza">Terraza</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>N° de sillas:</label>
                            <input class="form-control" id="numSillasEdit" name="numSillasEdit" placeholder="Ingresa el número de sillas que tiene la mesa" value="{{ old('numSillasEdit') }}"> 
                        </div>
                    </div>
                </div>
                <br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Estas seguro de que deseas eliminar esta mesa?</h5>
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
                $('#numSillasEdit').val($(this).data('numsillas'));
            });
        });
    </script>
@endsection