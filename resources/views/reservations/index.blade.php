@extends('store.template')

@section('content')

<div class="container text-center">
	<div class="page-header">
  		<h1><i class="fa fa-calendar"></i> Lista de reservaciones</h1>
	</div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <a class="btn btn-outline-success" href="{{ route('reservations.create') }}"><i class="fa fa-plus-circle"></i> Realizar reservación</a>
            </div>
        </div>
    </div>
    
   <hr>

    
    <div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
    
        <tr class="table-primary">
            <th>Titular de la mesa</th>
            <th>Fecha reservación</th>
            <th>Hora de lleagada</th>
            <th>Hora de salida</th>
            <th>Número de personas</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($reservations as $reservation)
        @if(Auth::user()->id == $reservation->user_id)

                <td >{{ $reservation->titularMesa }}</td>
                <td>{{ $reservation->fechaReservacion }}</td>
                <td>{{ $reservation->horaInicio }}</td>
                <td>{{ $reservation->horaFin }}</td>
                <td>{{ $reservation->numPersonas }}</td>

            <td>
                <form action="{{ route('reservations.destroy',$reservation->id) }}" method="POST">
                <p>
	  				<a class="btn btn-outline-primary" href="{{ route('reservations.show', $reservation->id) }}">
					<i class="fa fa-eye"></i>
                    </a>

                    <a class="btn btn-outline-primary" href="{{ route('reservations.edit',$reservation->id) }}">
					    <i class="fa fa-pencil"> </i>
                    </a>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" onclick="return confirm('¿Desea cancelar la reservación?');" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                </p>
                </form>
            </td>
            </tr>
	        @endif
        @endforeach
        </table>
    </div>
</div>

      
    @endsection