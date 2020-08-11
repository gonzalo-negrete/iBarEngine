<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Producto;

class ProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $productos = \DB::table('productos')
                    ->select('productos.*')
                    ->orderBy('id','DESC')
                    ->get();

        $proveedores = \DB::table('proveedores')
                    ->select('proveedores.*')
                    ->orderby('nombre','ASC')
                    ->get();

        return view('productos')->with('productos',$productos)
                                ->with('proveedores',$proveedores);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|min:3|max:20',
            'claveProducto'=>'required|min:3|max:20',
            'precio'=>'required',
            'stock'=>'required',
            'proveedor_id'=>'required',
            'descripcion'=>'required|max:200',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $producto = Producto::create([
                'claveProducto'=>$request->claveProducto,
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'precio'=>$request->precio,
                'rutaImagen'=>'default.jpg',
                'stock'=>$request->stock,
                'estatus'=>'1',
                'proveedor_id'=>$request->proveedor_id
            ]);
            return back()->with('Listo', 'El producto fue agregado de manera correcta');
        }
    }

    public function destroy($id){
        $producto = Producto::find($id);

        $producto->delete();
        return back()->with('Listo', 'El registro se eliminó correctamente');
    }

    public function editarProducto(Request $request){
        $producto = Producto::find($request->id);

        $validator = Validator::make($request->all(),[
            'nombre'=>'required|min:3|max:20',
            'claveProducto'=>'required|min:3|max:20',
            'precio'=>'required',
            'stock'=>'required',
            'proveedor_id'=>'required',
            'descripcion'=>'required|max:200',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $producto->nombre = $request->nombre;
            $producto->claveProducto = $request->claveProducto;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->proveedor_id = $request->proveedor_id;
            $producto->descripcion = $request->descripcion;
            $producto->rutaImagen = 'default.jpg';
            $producto->estatus = '1';
            $producto->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }
}
