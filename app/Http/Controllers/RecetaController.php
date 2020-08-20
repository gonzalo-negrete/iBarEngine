<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta;
use App\Receta_Insumo;
use Validator;
use Auth;

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

        $insumos = \DB::table('insumos')
                    ->select('insumos.*')
                    ->orderBy('id','DESC')
                    ->get();
                    
        if(Auth::User()->nivel == 'empleado' || Auth::User()->nivel == 'cliente'){
            return redirect('/admin');
        }

        return view('recetas')->with('recetas',$recetas)
                              ->with('insumos',$insumos);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'img'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $imagen = $request -> file('img');
            $tituloImg = time().'.'.$imagen->getClientOriginalExtension();
            $tituloAux = asset('/img/recetas');
            $destino = public_path('img/recetas');

            $request->img->move($destino, $tituloImg);

            $rutaFinal = $tituloAux . "/" . $tituloImg;

            $receta = Receta::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'rutaImagen'=>'default.jpg',
                'precio'=>$request->precio,
                'estatus'=>'1',
                'rutaImagen'=>$rutaFinal
            ]);
    
            $lastInsert = Receta::latest('id')->first();
            
            $id = explode(",", $request->txtID);
            $cant = explode(",", $request->txtCANT);

            for($p = 0;$p<count($id)-1;$p++){
                $receta_insumo = Receta_Insumo::create([
                    'CantidadAux'=>floatval($cant[$p]),
                    'insumo_id'=>$id[$p],
                    'receta_id'=>$lastInsert->id
               ]);
            }
        }

        return back()->with('Listo', 'La receta fue agregada de manera correcta');
    }

    public function mostrarReceta(Request $request){
        
        //$recetas_insumos = Receta_Insumo::find($request->id);
        //$recetas_insumos = Receta_Insumo::where('receta_id',$request->id)->get();

        $recetas_insumos = Receta_Insumo::
        join('insumos', 'recetas_insumos.insumo_id', '=', 'insumos.id')
        ->select('recetas_insumos.CantidadAux','recetas_insumos.id' , 'insumos.nombre')
        ->where('recetas_insumos.receta_id', '=', $request->id)
        ->get();
        
        return response(json_encode($recetas_insumos),200)->header('content-type','text/plain');
    }

    public function mostrarDatosE(Request $request){

        $recetas_insumos = Receta_Insumo::
        join('insumos', 'recetas_insumos.insumo_id', '=', 'insumos.id')
        ->select('recetas_insumos.CantidadAux','insumos.id' , 'insumos.nombre')
        ->where('recetas_insumos.receta_id', '=', $request->id)
        ->get();
        
        return response(json_encode($recetas_insumos),200)->header('content-type','text/plain');
    }

    public function editarReceta(Request $request){
        $receta = Receta::find($request->idEdit);

        $validator = Validator::make($request->all(),[
            'nombreEdit'=>'required',
            'descripcionEdit'=>'required',
            'precioEdit'=>'required'
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $receta->nombre = $request->nombreEdit;
            $receta->descripcion = $request->descripcionEdit;
            $receta->precio = $request->precioEdit;

            $validator2 = Validator::make($request->all(),[
                'imgCEdit'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            if(!$validator2->fails()){
                $imagen = $request -> file('imgCEdit');
                $tituloImg = time().'.'.$imagen->getClientOriginalExtension();
                $tituloAux = asset('/img/recetas');
                $destino = public_path('img/recetas');

                $request->imgCEdit->move($destino, $tituloImg);

                $rutaFinal = $tituloAux . "/" . $tituloImg;
                $receta->rutaImagen = $rutaFinal;
            }

            $receta->save();
            
            $recetas_insumos = Receta_Insumo::where('receta_id',$request->idEdit)->get();

            if($recetas_insumos != null){
                foreach($recetas_insumos as $r){
                    $aux = Receta_Insumo::find($r->id);
    
                    $aux->delete();
                }
            }

            $id = explode(",", $request->txtIDEdit);
            $cant = explode(",", $request->txtCANTEdit);

            for($p = 0;$p<count($id)-1;$p++){
                $receta_insumo = Receta_Insumo::create([
                    'CantidadAux'=>floatval($cant[$p]),
                    'insumo_id'=>$id[$p],
                    'receta_id'=>$request->idEdit
               ]);
            }
        }

        return back()->with('Listo', 'La receta fue actualizada de manera correcta');
    }

    public function destroy($id){
        $recetas_insumos = Receta_Insumo::where('receta_id',$id)->get();

        if($recetas_insumos != null){
            foreach($recetas_insumos as $r){
                $aux = Receta_Insumo::find($r->id);

                $aux->delete();
            }
        }

        $receta = Receta::find($id);

        $receta->delete();
        return back()->with('Listo', 'El registro se eliminó correctamente');
    }
}
