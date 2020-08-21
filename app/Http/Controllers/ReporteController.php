<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Reporte;
use App\Producto;
use App\Venta;
use App\User;
use Validator;
use DateTime;
use DateInterval;

class ReporteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $reportes = \DB::table('reportes')
                    ->select('reportes.*')
                    ->orderBy('id','DESC')
                    ->get();

        if(Auth::User()->nivel == 'cliente'){
            return redirect('/');
        }

        if(Auth::User()->nivel != 'admin'){
            return redirect('/admin');
        }

        $usuarios = \DB::table('users')
                    ->select('users.*')
                    ->where('nivel','!=','cliente')
                    ->orderBy('id','DESC')
                    ->get();

        return view('reportes')->with('reportes',$reportes)
                               ->with('usuarios',$usuarios);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'lstTipo'=>'required',
            'titulo'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $reporte = new Reporte;

            $reporte->titulo = $request->titulo;
            $reporte->tipoReporte = $request->lstTipo;
            $reporte->estatus = '1';

            $auxC = htmlspecialchars($request->editor1, ENT_QUOTES);

            $reporte->contenido = $auxC;

            $reporte->save();

            return back()->with('Listo', '¡El reporte fue creado con exito!');
        }
    }

    public function crear(Request $request){
        $reportes = Reporte::find($request->id);
        $tipoR = $request->tipo;

        if($request->tipo == 'Productos'){
            $content = html_entity_decode($reportes->contenido, ENT_QUOTES);
            $tabla = "";
            $date = new DateTime();

            $content = str_replace('#Fecha#', $date->format('d-m-Y'), $content);

            $productos = \DB::table('productos')
                    ->select('productos.*')
                    ->get();

            $tabla .= "<table border='0' cellpadding='1' cellspacing='1' style='width:100%'>";
            $tabla .= "<thead style='background-color: #000000; color: #FFFFFF'>";
            $tabla .= "<tr>";
            $tabla .= "<th style='text-align:left'>Cve. Producto</th>";
            $tabla .= "<th style='text-align:left'>Nombre</th>";
            $tabla .= "<th style='text-align:left'>Descripción</th>";
            $tabla .= "<th style='text-align:right'>Precio</th>";
            $tabla .= "<th style='text-align:right'>Stock</th>";
            $tabla .= "<th style='text-align:right'>Cantidad ML</th>";
            $tabla .= "</tr>";
            $tabla .= "</thead>";
            $tabla .= "<tbody>";
            foreach($productos as $p){
                $tabla .= "<tr>";
                $tabla .= "<td style='text-align:left'>".$p->claveProducto."</td>";
                $tabla .= "<td style='text-align:left'>".$p->nombre."</td>";
                $tabla .= "<td style='text-align:left'>".$p->descripcion."</td>";
                $tabla .= "<td style='text-align:right'>".$p->precio."</td>";
                $tabla .= "<td style='text-align:right'>".$p->stock."</td>";
                $tabla .= "<td style='text-align:right'>".$p->cantidadML."</td>";
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody>";
            $tabla .= "</table>";
            $content = str_replace('#Content#', $tabla, $content);

            $pdf = app('dompdf.wrapper');
            $pdf->loadHTML($content);
        }

        return $pdf->stream('Reporte'.$date->format("d-m-Y").'-'.$tipoR.'.pdf');
    }

    public function crearM(Request $request){
        $reportes = Reporte::find($request->idRMerma);

        $content = html_entity_decode($reportes->contenido, ENT_QUOTES);
        $tabla = "";
        $date = new DateTime();

        $content = str_replace('#Fecha#', $date->format('d-m-Y'), $content);

        $fechaInicio = new DateTime($request->dateInicio);
        $fechaFin = new DateTime($request->dateFin);

        $mermas = Venta::where('fechaVenta','>=', $fechaInicio->format('d-m-y'))
                        ->where('fechaVenta','<=', $fechaFin->format('d-m-y'))
                        ->where('estatus','0')
                        ->get();

        $tabla .= "<table border='0' cellpadding='1' cellspacing='1' style='width:100%'>";
        $tabla .= "<thead style='background-color: #000000; color: #FFFFFF'>";
        $tabla .= "<tr>";
        $tabla .= "<th style='text-align:left'>Tipo de pago</th>";
        $tabla .= "<th style='text-align:right'>Fecha de merma</th>";
        $tabla .= "<th style='text-align:right'>Total</th>";
        $tabla .= "<th style='text-align:left'>Observaciones</th>";
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";
        foreach($mermas as $m){
            $tabla .= "<tr>";
            $tabla .= "<td style='text-align:left'>".$m->tipoPago."</td>";
            $tabla .= "<td style='text-align:right'>".$m->fechaVenta."</td>";
            $tabla .= "<td style='text-align:right'>".$m->total."</td>";
            $tabla .= "<td style='text-align:left'>".$m->observacionMerma."</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $content = str_replace('#Content#', $tabla, $content);

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        return $pdf->stream('Reporte'.$date->format("d-m-Y").'-Mermas.pdf');
    }

    public function crearV(Request $request){
        $reportes = Reporte::find($request->idRVenta);

        $content = html_entity_decode($reportes->contenido, ENT_QUOTES);
        $tabla = "";
        $totalFinal = 0;
        $date = new DateTime();

        $content = str_replace('#Fecha#', $date->format('d-m-Y'), $content);
        $content = str_replace('#TEmpleados#', 'Todos los empleados', $content);
        $content = str_replace('#Empleado#', $request->nameE, $content);

        $fechaInicio = new DateTime($request->dateInicio);
        $fechaFin = new DateTime($request->dateFin);

        $fechaInicio->add(new DateInterval('P1D'));
        $fechaFin->add(new DateInterval('P1D'));

        if($request->tipoR == '2'){
            $ventas = Venta::where('fechaVenta','>=', $fechaInicio->format('d-m-y'))
                        ->where('fechaVenta','<=', $fechaFin->format('d-m-y'))
                        ->where('estatus','1')
                        ->get();
        }

        if($request->tipoR == '1'){
            $ventas = Venta::where('fechaVenta','>=', $fechaInicio->format('d-m-y'))
                        ->where('fechaVenta','<=', $fechaFin->format('d-m-y'))
                        ->where('estatus','1')
                        ->where('user_id',$request->lstEmpleado)
                        ->get();
        }

        $tabla .= "<table border='0' cellpadding='1' cellspacing='1' style='width:100%'>";
        $tabla .= "<thead style='background-color: #000000; color: #FFFFFF'>";
        $tabla .= "<tr>";
        $tabla .= "<th style='text-align:left'>Tipo de pago</th>";
        $tabla .= "<th style='text-align:right'>Fecha de merma</th>";
        $tabla .= "<th style='text-align:right'>Total</th>";
        $tabla .= "<th style='text-align:right'>Totales</th>";
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";
        foreach($ventas as $v){
            $totalFinal = $totalFinal + $v->total;
            $tabla .= "<tr>";
            $tabla .= "<td style='text-align:left'>".$v->tipoPago."</td>";
            $tabla .= "<td style='text-align:right'>".$v->fechaVenta."</td>";
            $tabla .= "<td style='text-align:right'>$ ".$v->total."</td>";
            $tabla .= "<td style='text-align:right'>----</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "<tr><td></td><td style='text-align:right'>Total de las ventas:</td><td style='text-align:right'>$ ".$totalFinal."</td><td></td></tr>";
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $content = str_replace('#Content#', $tabla, $content);

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($content);

        return $pdf->stream('Reporte'.$date->format("d-m-Y").'-Ventas.pdf');
    }

    public function editarReporte(Request $request){
        $validator = Validator::make($request->all(),[
            'lstTipoEdit'=>'required',
            'tituloEdit'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $reporte = Reporte::find($request->idEdit);

            $reporte->titulo = $request->tituloEdit;
            $reporte->tipoReporte = $request->lstTipoEdit;
            $reporte->estatus = '1';

            $auxC = htmlspecialchars($request->editor2, ENT_QUOTES);

            $reporte->contenido = $auxC;

            $reporte->save();

            return back()->with('Listo', '¡El reporte fue actualizado con exito!');
        }
    }

    public function eliminarReporte(Request $request){
        $reporte = Reporte::find($request->idDel);

        $reporte->delete();
        return back()->with('Listo', 'El reporte se eliminó correctamente');
    }
}
