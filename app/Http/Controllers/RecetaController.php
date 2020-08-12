<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta;
use App\Insumo_Producto;
use Validator;

class RecetaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $recetas = \DB::table('recetas')
                    ->select('recetas.*')
                    ->orderBy('id','DESC')
                    ->get();

        $productos = \DB::table('productos')
                    ->select('productos.*')
                    ->orderBy('id','DESC')
                    ->get();

        return view('recetas')->with('recetas',$recetas)
                              ->with('productos',$productos);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre'=>'required',
            'descripcion'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $receta = Receta::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'rutaImagen'=>'default.jpg',
                'estatus'=>'1'
            ]);
    
            $lastInsert = Receta::latest('id')->first();
            
            echo '<script type="text/javascript">
                    alert('.$request->txtID.');
                    </script>';
            $id = explode(",", $request->txtID);
            $cant = explode(",", $request->txtCANT);

            for($p = 0;$p<count($id)-1;$p++){
                $receta_producto = Receta_Producto::create([
                    'CantidadAux'=>floatval($cant[$p]),
                    'producto_id'=>$id[$p],
                    'receta_id'=>$lastInsert->id
               ]);
            }
        }

        return back()->with('Listo', 'La receta fue agregada de manera correcta');
    }
}
