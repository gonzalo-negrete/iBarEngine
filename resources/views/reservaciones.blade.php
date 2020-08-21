@extends('layouts.main')
@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estas en la gestión de reservaciones</h1>
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
                    <th>Titular de la mesa</th>
                    <th class="text-right">N° de personas</th>
                    <th class="text-right">Fecha</th>
                    <th class="text-right">Hora inicio</th>
                    <th class="text-right">Hora fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservaciones as $r)
                <tr>
                    <td>{{ $r->titularMesa }}</td>
                    <td class="text-right">{{ $r->numPersonas }}</td>
                    <td class="text-right">{{ $r->fechaReservacion }}</td>
                    <td class="text-right">{{ $r->horaInicio }}</td>
                    <td class="text-right">{{ $r->horaFin }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection