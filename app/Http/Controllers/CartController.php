<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Venta;
use App\VentaProducto;
use Carbon\Carbon;
use DateTime;


class CartController extends Controller
{

	public function __construct()
	{
		if(!\Session::has('cart')) \Session::put('cart', array());
	}

    //show cart

	public function show()
	{
		$cart = \Session::get('cart');
		$total = $this->total();
		return view('store.cart', compact('cart', 'total'));

	}

    // add item

	public function add(Producto $producto)
	{
		$cart = \Session::get('cart');
		$producto ->quantity = 1;
		$cart[$producto ->id] = $producto;
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');
	}


    // delete item

	public function delete(Producto $producto)
	{
		$cart = \Session::get('cart');
		unset($cart[$producto->id]);
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');
	}

    // update item
	public function update(Producto $producto, $quantity)
	{
		$cart = \Session::get('cart');
		$cart[$producto->id]->quantity = $quantity;
		\Session::put('cart', $cart);
		return redirect()->route('cart-show');
	}

    // trash cart
	public function trash(Producto $producto)
	{
		\Session::forget('cart');

		return redirect()->route('cart-show');
	}
    // total

    public function total()
    {
    	$cart = \Session::get('cart');
    	$total=0;
    	foreach ($cart as $item) {
    		$total += $item->precio * $item->quantity;
    	}

    	return $total;
    }

    //detalle de pedido
    public function orderDetail()
    {

    	if(count(\Session::get('cart'))<=0)return redirect()->route('home');
    	$cart = \Session::get('cart');
    	$total = $this->total();
		return view('store.order-detail', compact('cart', 'total'));
    }

    public function compra(Producto $producto)
	{
		$this->saveVenta();
		\Session::forget('cart');
		return redirect()->route('home')->with('message', 'Compra realizada');
	}

	protected function saveVenta()
	{
		$subtotal = 0;
		$cart = \Session::get('cart');

		foreach ($cart as $producto) {
			$subtotal += $producto->quantity * $producto->precio;
		}
		$date = Carbon::now()->toDateTimeString();
		
		$venta = Venta::create([
			'total'=>$subtotal,
			'fechaVenta'=> $date,
			'estatus'=> 1,
			'tipoPago'=> "Tarjeta",
			'observacionMerma' => "",
			'user_id' => \Auth::user()->id
		]);

		foreach ($cart as $producto) 
		{
			$this->saveVentaProducto($producto, $venta->id);
		}

	}

	protected function saveVentaProducto($producto, $venta_id)
	{
		VentaProducto::create([
			'producto_id' => $producto->id,
			'venta_id' => $venta_id,
		]);
	}
}
