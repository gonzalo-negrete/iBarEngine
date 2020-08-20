<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;

class StoreController extends Controller
{
    public function index(Request $request)
    {        
        $buscar = $request->get('buscar');
        $products = Producto::where('nombre', 'like', '%'.$buscar.'%')->paginate(8);
        return view ('store.index', compact('products','buscar'));
    }

    public function show($id)
    {
    	$product = Producto::where('id', $id)->first();
    	//dd($product);
    	return view ('store.show', compact('product'));
    }
}
