

@extends('store.template')

@section('content')
  <div class=" text-center card-header">
	<div class="page-header">
  		<h1><i class="fa fa-calendar"></i> Modificar Reservación</h1>
	</div>
</div>
<hr>

    <div class="pull-center">
        <a class="btn btn-outline-primary" href="{{ route('reservations.index') }}">
        <i class="fa fa-chevron-circle-left"></i> Regresar</a>
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
                <div class="card-header"><h3><strong>{{ __('Datos de la Reservación') }}</strong></h3></div>
                    <div class="card-body">
                        <form action="{{ route('reservations.update',$reservation->id) }}" method="POST">
                         @csrf
                            @method('PUT')
   
                <div class="form-group">
                    <h4>Titular de la mesa</h4>
                    <input type="text" name="titularMesa" id="titularMesa"  value="{{ $reservation->titularMesa }}" class="form-control" placeholder="titularMesa" readonly>
                </div>
                </br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <h4>Fecha de la Reservación</h4>
                    <input type="date" name="fechaReservacion" value="{{ $reservation->fechaReservacion }}"  id="fechaReservacion" class="form-control"
                    required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                </div>
                <div class="form-group col-md-6">
                    <h4>Numero de Personas</h4>
                    <input type="number" min="1" max="5" name="numPersonas" id="numPersonas" class="form-control" value="{{ $reservation->numPersonas }}">
                </div>
            </div>
            </br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <h4>Hora de llegada</h4>
                    <input type="time" name="horaInicio" id="horaInicio" class="form-control" value="{{ $reservation->horaInicio }}">
                </div>
                <div class="form-group col-md-6">
                    <h4>Hora de Salida</h4>
                    <input type="time" name="horaFin" id="horaFin" class="form-control" value="{{ $reservation->horaFin }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">

                    <input type="hidden" name="estatus" id="estatus" value="1" class="form-control" >
                </div>
                <div class="form-group col-md-5">
                    <h4>Mesa</h4>
                    <input type="text" name="mesa_id" id="mesa_id" class="form-control" value="{{ $reservation->mesa_id }}" >
                </div>
                <div class="form-group col-md-4">

                    <input type="hidden" name="user_id" id="user_id"  class="form-control" value="{{ $reservation->user_id }}" >
                </div>
            </div>
                          <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <input  class="btn btn-outline-success" type="submit" value="Modificar reservación">
                                </div>
                            </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


