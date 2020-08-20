<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumo;
use Validator;
use Auth;

class InsumoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $insumos = \DB::table('insumos')
                    ->select('insumos.*')
                    ->orderBy('id','DESC')
                    ->get();
            
        if(Auth::User()->nivel == 'empleado' || Auth::User()->nivel == 'cliente'){
            return redirect('/admin');
        }
        
        return view('insumos')->with('insumos',$insumos);
    }

    public function editarInsumo(Request $request){
        $insumo = Insumo::find($request->id);

        $validator = Validator::make($request->all(),[
            'nombreEdit'=>'required',
            'descripcionEdit'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $insumo->nombre = $request->nombreEdit;
            $insumo->descripcion = $request->descripcionEdit;
            $insumo->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }
}
