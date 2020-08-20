@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de insumos</h1>
        <a href="/admin/productos" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50">
            </i> Agregar insumo
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
                    <th class="text-right">Total Mililitros</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insumos as $insumo)
                <tr>
                    <td>{{ $insumo->nombre }}</td>
                    <td>{{ $insumo->descripcion }}</td>
                    <td class="text-right">{{ $insumo->totalML }}</td>
                    <td class="text-center">
                        
                        <button class="btn btn-round btnEditar" 
                        data-id="{{ $insumo->id }}"
                        data-nombre="{{ $insumo->nombre }}"
                        data-descripcion="{{ $insumo->descripcion }}"
                        data-toggle="modal" data-target="#modalEditar">
                            <i class="fa fa-edit"></i> 
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos del insumo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/insumos/edit" method="post">
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
                            <input class="form-control" id="nombreEdit" name="nombreEdit" value="{{ old('nombreEdit') }}"> 
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" value="{{ old('numSillasEdit') }}"></textarea>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.btnEditar').click(function(){
                $('#idEdit').val($(this).data('id'));
                $('#nombreEdit').val($(this).data('nombre'));
                $('#descripcionEdit').val($(this).data('descripcion'));
            });
        });
    </script>
@endsection