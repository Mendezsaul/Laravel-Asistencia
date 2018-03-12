<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use DateTime;
class inicioController extends Controller
{
   public function validarId($id=null)
    {
    	if($id!=null){
    		$check=DB::table('datospersonales')->where('id_personal','=',$id)->get();
    		if(count($check)>0){

                $date = new DateTime();
                $fecha=$date->format('Y-m-d');

                $nombres=DB::table('datospersonales')
                    ->where('id_personal','=',$id)
                    ->get();
                $informacion=DB::table('datospersonales')
                    ->select('nombres','apellidos','id_personal')
                    ->orderBy('nombres', 'asc')
                    ->get();
                $registro=DB::table('registro')->where([
                    ['id_persona_fk', '=', $id],
                    ['fecha', '=', $fecha]
                    ])
                    ->get();
                $llegaron=DB::table('registro')->where([
                    ['hora_ingreso', 'like', '%'],
                    ['fecha', '=', $fecha]
                    ])->join('datospersonales', 'id_personal', '=', 'registro.id_persona_fk')
                    ->get();
    			return view('principal')
                ->with('codigo',$nombres)
                ->with('info',$informacion)
                ->with('registro',$registro)
                ->with('llegaron',$llegaron);
    		}
        	else{
        		return redirect('/');
        	}
    	}else{
        	return redirect('/');
    	}
    }
    
    public function insertarRegistro(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $date = new DateTime();
        $fecha=$date->format('Y-m-d');
        $hora=$date->format('H:i:00');
        $id= $request->input('id');
        if($id!=null){
            $check=DB::table('registro')->where([
            ['id_persona_fk', '=', $id],
            ['fecha', '=', $fecha]
            ])->get();
            if(count($check)!=1){
                //No esta registrado;
                $registro = DB::table('registro')->insert(
                ['id_persona_fk' => $id,
                'fecha' => $fecha,
                'hora_ingreso' => $hora]
            );
                return redirect('/informacion/'.$id);
            }else{
                $horaingreso=DB::table('registro')->where([
                ['id_persona_fk', '=', $id],
                ['fecha', '=', $fecha]
                ])->get();

                    $horal = strtotime($horaingreso[0]->hora_ingreso);
                    $horae = strtotime($hora);

                $dif_hora=round(($horae - $horal)/3600,4);

                $registro = DB::table('registro')->where([
                ['id_persona_fk', '=', $id],
                ['fecha', '=', $fecha]
                ])->update(
                ['hora_salida' => $hora,
                'horas_dia' => $dif_hora]
            );
                $agregarhoras=DB::table('detallepractica')
                ->where('id_persona_fk', $id)
                ->increment('horas_total', $dif_hora);;
                return redirect('/informacion/'.$id);
            }
        }
    }
    
}
