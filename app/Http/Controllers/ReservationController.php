<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Mesa;
use Validator;

class ReservationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $reservations = Reservation::all();
        $mesas = $this->indexM();
        return view('reservations.index',compact('reservations', 'mesas'));
        
    }

    public function indexM()
    {
        
        $mesas = Mesa::all();

        $mesas = \DB::table('mesas')
                    ->select('mesas.id','mesas.tipoMesa')
                    ->orderby('tipoMesa','ASC')
                    ->get();

        return ($mesas);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fechaReservacion'=>'required',
            'numPersonas'=>'required|max:5',
            'titularMesa'=>'required',
            'estatus'=>'required',
            'horaInicio'=>'required',
            'horaFin'=>'required',
            'user_id'=>'required',
            'mesa_id'=>'required',
        ]);
        if($validator ->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert', 'Favor de llenar los campos')
            ->withErrors($validator);
        }
        else{
            $reservations = Reservation::create([
                'fechaReservacion'=>$request->fechaReservacion,
                'numPersonas'=>$request->numPersonas,
                'titularMesa'=>$request->titularMesa,
                'estatus'=>1,
                'horaInicio'=>$request->horaInicio,
                'horaFin'=>$request->horaFin,
                'mesa_id'=>$request->mesa_id,
                'user_id'=> \Auth::user()->id
              //'user_id'=>$request->mesa_id
            ]);
            return redirect()->route('reservations.index')
                        ->with('Listo','Reservación realizada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show',compact('reservation'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        
        return view('reservations.edit',compact('reservation'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'fechaReservacion'=>'required',
            'numPersonas'=>'required|max:5',
            'titularMesa'=>'required',
            'estatus'=>'required',
            'horaInicio'=>'required',
            'horaFin'=>'required',
            'mesa_id'=>'required',
            'user_id'=>'required'
        ]);
  
        $reservation->update($request->all());
  
        return redirect()->route('reservations.index')
                        ->with('success','Reservación actualizada correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
  
        return redirect()->route('reservations.index')
                        ->with('Listo','Reservación cancelada');
    }
}
