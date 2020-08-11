<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use Validator;

class MesaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $mesas = \DB::table('mesas')
                    ->select('mesas.*')
                    ->orderBy('id','DESC')
                    ->get();
        return view('mesas')->with('mesas',$mesas);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'tipoMesa'=>'required',
            'numSillas'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $mesa = Mesa::create([
                'tipoMesa'=>$request->tipoMesa,
                'numSillas'=>$request->numSillas
            ]);
            return back()->with('Listo', 'La mesa fue agregada de manera correcta');
        }
    }

    public function destroy($id){
        $mesa = Mesa::find($id);

        $mesa->delete();
        return back()->with('Listo', 'El registro se eliminó correctamente');
    }

    public function editarMesa(Request $request){
        $mesa = Mesa::find($request->id);

        $validator = Validator::make($request->all(),[
            'tipoMesaEdit'=>'required',
            'numSillasEdit'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $mesa->tipoMesa = $request->tipoMesaEdit;
            $mesa->numSillas = $request->numSillasEdit;
            $mesa->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }
}
