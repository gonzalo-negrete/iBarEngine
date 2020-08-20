@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Datos Personales</h1>
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
    </div>
    <form action="/admin/profiles/edit" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" name="nombre" id="nombre">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Apellido Paterno:</label>
                    <input type="text" value="{{ Auth::user()->aPaterno }}" class="form-control" name="aPaterno" id="aPaterno">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Apellido Materno:</label>
                    <input type="text" value="{{ Auth::user()->aMaterno }}" class="form-control" name="aMaterno" id="aMaterno">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Nivel jerarquico:</label>
                    <input disabled type="text" value="{{ Auth::user()->nivel }}" class="form-control" name="nivel" id="nivel">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="number" value="{{ Auth::user()->telefono }}" class="form-control" name="telefono" id="telefono">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="form-control" name="email" id="email">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Foto de perfil</label>
                    <img style="width:250px; height:250px;" class="img-thumbnail" id="imgMostrar" src="{{ Auth::user()->img }}">
                    <input type="file" name="imgUsuario">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Contraseña:</label>
                    <input class="form-control" name="pass1Edit" type="password">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Confirmar contraseña:</label>
                    <input class="form-control" name="pass2Edit" type="password">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <button type="submit" class="btn btn-success btn-lg btn-block float-right">Editar</button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection