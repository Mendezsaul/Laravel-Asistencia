<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class indexController extends Controller
{
    public function getNombre()
    {
    	$nombres=DB::table('datospersonales')
    	->select('nombres','apellidos','id_personal')
    	->orderBy('nombres', 'asc')
    	->get();
    			return view('index')->with('info',$nombres);
    }
}
