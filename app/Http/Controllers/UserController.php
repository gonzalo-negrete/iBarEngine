<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $usuarios = \DB::table('users')
                    ->select('users.*')
                    ->orderBy('id','DESC')
                    ->get();
        return view('usuarios')->with('usuarios',$usuarios);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:3|max:20',
            'email'=>'required|min:3|email',
            'aPaterno'=>'required|min:3|max:20',
            'aMaterno'=>'required|min:3|max:20',
            'telefono'=>'required|min:3|max:10',
            'pass1'=>'required|min:6|required_with:pass2|same:pass2',
            'pass2'=>'required|min:6',
            'nivel'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $usuario = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'aPaterno'=>$request->aPaterno,
                'aMaterno'=>$request->aMaterno,
                'nivel'=>$request->nivel,
                'telefono'=>$request->telefono,
                'estatus'=>'1',
                'img'=>'default.jpg',
                'password'=>Hash::make($request->pass1)
            ]);
            return back()->with('Listo', 'El usuario fue agregado de manera correcta');
        }
    }

    public function destroy($id){
        $usuario = User::find($id);

        $usuario->delete();
        return back()->with('Listo', 'El registro se eliminó correctamente');
    }

    public function editarUsuario(Request $request){
        
        $user = User::find($request->id);
        $validator = Validator::make($request->all(),[
            'nameEdit'=>'required|min:3|max:20',
            'emailEdit'=>'required|min:3|email',
            'aPaternoEdit'=>'required|min:3|max:20',
            'aMaternoEdit'=>'required|min:3|max:20',
            'telefonoEdit'=>'required|min:3|max:10',
            'nivelEdit'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $user->name = $request->nameEdit;
            $user->email = $request->emailEdit;
            $user->aPaterno = $request->aPaternoEdit;
            $user->aMaterno = $request->aMaternoEdit;
            $user->telefono = $request->telefonoEdit;
            $user->nivel = $request->nivelEdit;

            $validator2 = Validator::make($request->all(),[
                'pass1Edit'=>'required|min:6|required_with:pass2Edit|same:pass2Edit',
                'pass2Edit'=>'required|min:6',
            ]);

            if(!$validator2->fails()){
                $user->password = Hash::make($request->pass1Edit);
            }

            $user->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }
}
