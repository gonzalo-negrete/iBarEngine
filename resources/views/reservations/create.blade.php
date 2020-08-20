
@extends('store.template')

@section('content')

<div class=" text-center card-header ">
	<div class="page-header">
  		<h1><i class="fa fa-calendar"></i> Hacer Reservación</h1>
	</div>
</div>
<hr>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        </div>
        <div class="pull-left">
            <a class="btn btn-outline-primary" href="{{ route('reservations.index') }}">
            <i class="fa fa-chevron-circle-left"></i>Regresar</a>
        </div>
    </div>

   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2><strong>{{ __('Datos de la Reservación') }}</strong></h2></div>
                    <div class="card-body">
                    
                        <form action="{{ route('reservations.store') }}" method="POST" >
                            {{ csrf_field()}}
                             
                                <div class="form-group">
                                    <label for="titularMesa"><h4>{{'Titular de la Mesa'}}</h4></label></br>
                                    <input type="text" name="titularMesa" id="titularMesa" class="form-control" value="{{ Auth::user()->name}}" readonly>
                                    </label>
                                    </br>
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for = "fechaReservacion"><h4>{{'Fecha de la Reservación'}}</h4></label>
                                    <input type="date" name="fechaReservacion" id="fechaReservacion" class="form-control" 
                                    required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for = "numPersonas"><h4>{{'Número de Personas'}}</h4></label>
                                    <input type="number" name="numPersonas" id="numPersonas" max="5" min="1" value="" class="form-control">
                                </div>
                                
                            </div>
                            </br>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for = "horaInicio"><h4>{{'Hora de llegada'}}</h4></label>
                                    <input type="time" name="horaInicio" id="horaInicio" value="" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for = "horaFin"><h4>{{'Hora de Salida'}}</h4></label>
                                    <input type="time" name="horaFin" id="horaFin" value="" class="form-control"> 
                                </div>
                            </div>
                            </br>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    
                                    <input type="hidden" class="form-control" name="estatus" id="estatus" value="1" readonly="readonly">
                                    </br></br>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for = "mesa_id"><h4>{{'Mesa'}}</h4></label>
                                    <input type="text" name="mesa_id" id="mesa_id" value="1" class="form-control">
                                    </br></br>
                                </div>
                                <div class="form-group col-md-4">
                                    
                                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->id}}" readonly="readonly" >
                                    </br></br>
                                </div>
                            </div>   
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                    <input  class="btn btn-outline-success" type="submit" value="Agregar reservación">
                                    </div>
                                </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection