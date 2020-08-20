<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Proveedor;
use Auth;

class ProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $proveedores = \DB::table('proveedores')
                    ->select('proveedores.*')
                    ->orderBy('id','DESC')
                    ->get();

        if(Auth::User()->nivel != 'admin'){
            return redirect('/admin');
        }

        return view('proveedores')->with('proveedores',$proveedores);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|min:3|max:20',
            'claveProveedor'=>'required|min:3|max:20',
            'correo'=>'required',
            'telefono'=>'required',
            'descripcion'=>'required|max:200',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $imagen = $request -> file('rutaImagen');
            $tituloImg = time().'.'.$imagen->getClientOriginalExtension();
            $tituloAux = asset('/img/proveedores');
            $destino = public_path('img/proveedores');

            $request->rutaImagen->move($destino, $tituloImg);

            $rutaFinal = $tituloAux . "/" . $tituloImg;

            $proveedor = Proveedor::create([
                'claveProveedor'=>$request->claveProveedor,
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'correo'=>$request->correo,
                'rutaLogo'=>$rutaFinal,
                'telefono'=>$request->telefono,
                'estatus'=>'1'
            ]);
            return back()->with('Listo', 'El proveedor fue agregado de manera correcta');
        }
    }

    public function destroy($id){
        $proveedor = Proveedor::find($id);

        $proveedor->delete();
        return back()->with('Listo', 'El registro se eliminó correctamente');
    }

    public function editarProveedor(Request $request){
        $proveedor = Proveedor::find($request->id);

        $validator = Validator::make($request->all(),[
            'nameEdit'=>'required|min:3|max:20',
            'cveEdit'=>'required|min:3|max:20',
            'correoEdit'=>'required',
            'telefonoEdit'=>'required',
            'descripcionEdit'=>'required|max:200',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $proveedor->nombre = $request->nameEdit;
            $proveedor->claveProveedor = $request->cveEdit;
            $proveedor->correo = $request->correoEdit;
            $proveedor->telefono = $request->telefonoEdit;
            $proveedor->descripcion = $request->descripcionEdit;
            
            $validator2 = Validator::make($request->all(),[
                'rutaImagenEdit'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            if(!$validator2->fails()){
                $imagen = $request -> file('rutaImagenEdit');
                $tituloImg = time().'.'.$imagen->getClientOriginalExtension();
                $tituloAux = asset('/img/proveedores');
                $destino = public_path('img/proveedores');

                $request->rutaImagenEdit->move($destino, $tituloImg);

                $rutaFinal = $tituloAux . "/" . $tituloImg;
                $proveedor->rutaLogo = $rutaFinal;
            }

            $proveedor->estatus = '1';
            $proveedor->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }
}
