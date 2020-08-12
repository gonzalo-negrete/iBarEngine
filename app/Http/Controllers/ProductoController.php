<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Producto;
use App\Insumo;
use App\Movimiento_Insumo;

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
                    ->select('proveedores.id','proveedores.nombre')
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
            'rutaImagen'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'cantidadML'=>'required'
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
            $tituloAux = asset('/img/productos');
            $destino = public_path('img/productos');

            $request->rutaImagen->move($destino, $tituloImg);

            $rutaFinal = $tituloAux . "/" . $tituloImg;

            $producto = Producto::create([
                'claveProducto'=>$request->claveProducto,
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'precio'=>$request->precio,
                'rutaImagen'=>$rutaFinal,
                'stock'=>$request->stock,
                'estatus'=>'1',
                'proveedor_id'=>$request->proveedor_id,
                'cantidadML'=>$request->cantidadML
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

            $validator2 = Validator::make($request->all(),[
                'rutaImagenEdit'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            if(!$validator2->fails()){
                $imagen = $request -> file('rutaImagenEdit');
                $tituloImg = time().'.'.$imagen->getClientOriginalExtension();
                $tituloAux = asset('/img/productos');
                $destino = public_path('img/productos');

                $request->rutaImagenEdit->move($destino, $tituloImg);

                $rutaFinal = $tituloAux . "/" . $tituloImg;
                $producto->rutaImagen = $rutaFinal;
            }

            $producto->estatus = '1';
            $producto->save();
            return back()->with('Listo', 'El registro se actualizó correctamente');
        }
    }

    public function agregarInsumos(Request $request){
        $producto = Producto::find($request->idPro);
    
        $validator = Validator::make($request->all(),[
            'nameInsumo'=>'required',
            'descripcionInsumo'=>'required',
            'numProducto'=>'required',
            'totalML'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('Error1', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $numP = $producto->stock;
            $numAux = $request->numProducto;
            $total = 0;
            
            if($numP<$numAux){
                return back()
                ->withInput()
                ->with('Error1', 'No cuentas con la cantidad de productos solicitados')
                ->withErrors($validator);
            }
            else{
                $total = $numP - $numAux;
                $producto->stock = $total;

                $producto->save();

                $insumos = \DB::table('insumos')
                ->select('insumos.*')
                ->where('producto_id', '=', $request->idPro)
                ->get();

                if(count($insumos) >= 1){
                    
                    $a1 = $insumos->totalML;
                    
                    $a2 = $a1 + $request->totalML;
                    $insumos->totalML = $a2;
                    $insumos->save();
                }
                else{
                    $insumo = Insumo::create([
                        'nombre'=>$request->nameInsumo,
                        'descripcion'=>$request->descripcionInsumo,
                        'totalML'=>$request->totalML,
                        'producto_id'=>$request->idPro
                    ]);
                }

                $movimiento_insumo = Movimiento_Insumo::create([
                    'descripcion'=>$request->descripcionInsumo,
                    'stock'=>$request->numProducto,
                    'producto_id'=>$request->idPro
                ]);
            }
        }

        return back()->with('Listo', 'Los insumos fueron agregados correctamente');
    }
}
