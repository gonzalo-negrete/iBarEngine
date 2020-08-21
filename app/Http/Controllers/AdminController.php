<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::User()->nivel == 'cliente'){
            return redirect('/');
        }

        return view('admin');
    }
}
