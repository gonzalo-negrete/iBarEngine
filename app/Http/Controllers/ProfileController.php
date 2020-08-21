<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $datos = \DB::table('users')
                    ->select('users.*')
                    ->where('id',Auth::user()->id)
                    ->get();
        
        if(Auth::User()->nivel == 'cliente'){
            return redirect('/');
        }

        return view('profiles')->with('datos',$datos);
    }

    public function editarPerfil(Request $request){
        
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|min:3|max:20',
            'email'=>'required|min:3|email',
            'aPaterno'=>'required|min:3|max:20',
            'aMaterno'=>'required|min:3|max:20',
            'telefono'=>'required|min:3|max:10',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->aPaterno = $request->aPaterno;
            $user->aMaterno = $request->aMaterno;
            $user->telefono = $request->telefono;

            $validator2 = Validator::make($request->all(),[
                'pass1Edit'=>'required|min:6|required_with:pass2Edit|same:pass2Edit',
                'pass2Edit'=>'required|min:6',
            ]);

            if(!$validator2->fails()){
                $user->password = Hash::make($request->pass1Edit);
            }

            $validator3 = Validator::make($request->all(),[
                'imgUsuario'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            if(!$validator3->fails()){
                $imagen = $request -> file('imgUsuario');
                $tituloImg = time().'.'.$imagen->getClientOriginalExtension();
                $tituloAux = asset('/img/usuarios');
                $destino = public_path('img/usuarios');
                $request->imgUsuario->move($destino, $tituloImg);

                $rutaFinal = $tituloAux . "/" . $tituloImg;
                $user->img = $rutaFinal;
            }

            $user->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }
}
