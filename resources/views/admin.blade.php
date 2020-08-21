@extends('layouts.main')

@section('contenido')
<div class="row">
    <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡Atención!</strong>
        <span>Bienvenido al sistema, puedes gestionar nuestro bar desde este espacio</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<div class="row">
    @if(Auth::user()->nivel != 'empleado')
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/admin/productos">
                <div class="h5 mb-0 font-weight-bold text-gray-800"> Productos</div>
            </a>
            </div>
            <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/admin/ventas">
                <div class="h5 mb-0 font-weight-bold text-gray-800"> Ventas</div>
            </a>
            </div>
            <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/admin/recetas">
                <div class="h5 mb-0 font-weight-bold text-gray-800"> Recetas</div>
            </a>
            </div>
            <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>
    @endif

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/admin/caja">
                <div class="h5 mb-0 font-weight-bold text-gray-800"> Caja</div>
            </a>
            </div>
            <div class="col-auto">
            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<div class="row">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection