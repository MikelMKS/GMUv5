<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DateTime;

class AlertasController extends Controller
{
    public function __construct(){
        $this->tittle = "ALERTAS";
    }

    public function revisarAlertas(){
        $return = 0;
        $alertas = DB::connection('mysql')->select("SELECT id FROM alertas WHERE fecReg = CURDATE()");

        if($alertas == null){
            DB::connection('mysql')->delete("DELETE FROM alertas WHERE fecReg < CURDATE()");

            // CUMPLEAÑOS
            $cumpleaños = DB::connection('mysql')->select("SELECT COUNT(id) AS dato FROM clientes WHERE DATE_FORMAT(fechaNac,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
            if($cumpleaños[0]->dato > 0){
                DB::connection('mysql')->insert("INSERT INTO alertas (idTipo,visto,idUsuario,fecReg,dato) SELECT 1 AS idTipo,0 AS visto,id AS idUser,CURDATE() AS fecReg,".$cumpleaños[0]->dato." AS dato FROM usuarios");
            }

            DB::connection('mysql')->table('alertas')->insert(['fecReg' => Date('Y-m-d')]);

            $return = 1;
        }

        return $return;
    }

    public function verNotificacion(){
        $tipo = $_REQUEST['tipo'];

        // CUMPLEAÑOS
        if($tipo == 1){
            $hoy = new DateTime(date("Y-m-d"));
            $datos = DB::connection('mysql')->select("SELECT *,TIMESTAMPDIFF(YEAR,fechaNac,CURDATE()) AS edad 
            FROM clientes
            WHERE DATE_FORMAT(fechaNac,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
            $visto = DB::connection('mysql')->select("SELECT id,visto FROM alertas WHERE fecReg = CURDATE() AND idTipo = $tipo AND idUsuario = ".Session::get('Sid')."");

            return view('Alertas.cumple',compact('datos','hoy','visto')); 
        }
    }

    public function enteradoCumpleaños(){
        $id = $_REQUEST['id'];

        DB::connection('mysql')->table('alertas')->where('id','=',$id)->update(['visto' => 1]);
    }
}
