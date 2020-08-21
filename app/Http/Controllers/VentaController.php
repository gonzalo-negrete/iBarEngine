<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use Auth;

class VentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $ventas = Venta::where('estatus','1')->get();

        if(Auth::User()->nivel == 'cliente'){
            return redirect('/');
        }

        if(Auth::User()->nivel == 'empleado'){
            return redirect('/admin');
        }

        return view('ventas')->with('ventas',$ventas);
    }

    public function crearMerma(Request $request){
        $venta = Venta::find($request->idVentaM);

        $venta->estatus = '0';
        $venta->observacionMerma = $request->observ;

        $venta->save();
        return back()->with('Listo', 'La merma se agrego de forma correcta');
    }

    public function getMermas(Request $request){
        $ventas = Venta::where('estatus','0')->get();

        return response(json_encode($ventas),200)->header('content-type','text/plain');
    }

}
