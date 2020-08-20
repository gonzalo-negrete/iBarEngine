<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Producto;
use App\Venta_Producto;
use App\Receta_Insumo;
use App\Venta_Receta;
use App\Insumo;
use Validator;
use DateTime;

class CajaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $productos = \DB::table('productos')
                    ->select('productos.*')
                    ->orderBy('id','DESC')
                    ->get();

        $recetas = \DB::table('recetas')
                    ->select('recetas.*')
                    ->orderBy('id','DESC')
                    ->get();

        return view('caja')->with('productos',$productos)
                           ->with('recetas',$recetas);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'lstTipo'=>'required',
            'total'=>'required',
            'idPro'=>'required',
            'idUser'=>'required'
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $date = new DateTime();
            $venta = new Venta;

            $venta->total = $request->total;
            $venta->fechaVenta = $date->format('d-m-Y');
            $venta->estatus = '1';
            $venta->tipoPago = $request->lstTipo;
            $venta->observacionMerma = ' ';
            $venta->user_id = $request->idUser;

            $venta->save();
    
            $lastInsert = Venta::latest('id')->first();
            
            $idP = explode(",", $request->idPro);
            $idR = explode(",", $request->idRec);

            for($p = 0;$p<count($idP)-1;$p++){
                $producto = Producto::find($idP[$p]);

                if($producto->stock >= 1){

                    $NP = $producto->stock;
                    $producto->stock = ($NP-1);

                    $producto->save();

                    $venta_producto = new Venta_Producto;
                    $venta_producto->producto_id = $idP[$p];
                    $venta_producto->venta_id = $lastInsert->id;

                    $venta_producto->save();
                }
                else{
                    
                }
            }

            for($row = 0;$row<count($idR)-1;$row++){
                $receta_insumo = Receta_Insumo::where('receta_id',$idR[$row])->get();

                foreach($receta_insumo as $r){
                    $id_insumo = $r->insumo_id;
                    $CanReb = $r->CantidadAux;

                    $t_insumo = Insumo::find($id_insumo);

                    if($CanReb <= $t_insumo->totalML){
                        $totales = $t_insumo->totalML;
                        $t_insumo->totalML = ($totales-$CanReb);
                        $t_insumo->save();
                    }
                    else{

                    }
                }
                $venta_receta = new Venta_Receta;
                $venta_receta->receta_id = $idR[$row];
                $venta_receta->venta_id = $lastInsert->id;

                $venta_receta->save();
            }
        }

        return back()->with('Listo', 'La compra se realizo de manera correcta');
    }
}
