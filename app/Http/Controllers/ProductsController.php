<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductsController extends Controller
{
    public function products()
    {
        $products = Producto::paginate(6);
        return view('products', compact('products'));
    }

    public function detail($id)
    {
        $product = Producto::find($id);
        return view('detail')->with('product', $product);
    }

    public function cart()
    {
        return view('cart');
    }

    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products')
                        ->with('success','Product deleted successfully');
    }
    public function addToCart($id)
    {
        //logica para agregar productos
        $product = Producto::find($id);
        $cart = session()->get('cart');

        //si el carrito esta vacio entonces este es el primer producto
        if(!$cart)
        {
            $cart = [
                $id=>[
                    "nombre"=>$product->nombre,
                    "quantity"=>1,
                    "precio"=>$product->precio,
                    "rutaImagen"=>$product->rutaImagen
                ]
            ];

            session()->put('cart',$cart);
            return redirect()->back()->with('success','Product added to cart');
        }

        //si el carro no esta vacio entonces checar que el producto existe e incrementar la cantidad
        if(isset($cart[$id]))
        {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success','Product added to cart');
        }

        //si el producto no existe en el carrito entonces agregar al carrito con la cantidad 1
        $cart[$id]=[
            "nombre"=>$product->nombre,
            "quantity"=>1,
            "precio"=>$product->precio,
            "rutaImagen"=>$product->rutaImagen
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success','Product added to cart');
    }
}
    