<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ServiciosController extends Controller
{
    public function __construct(){
        $this->tittle = "SERVICIOS";
    }

    public function index(){
        return view('Servicios.index')->with(['tittle' => $this->tittle]);
    }

    public function deudaCliente(){
        $cliente = $_REQUEST['cliente'];

        $buscar = DB::connection('mysql')->select("SELECT id,IFNULL(deuda,0) AS deuda FROM clientes WHERE id = $cliente");

        return flotFormatoM20($buscar[0]->deuda);
    }

    public function buscaMembresiasActivas(){
        $cliente = $_REQUEST['cliente'];
        
        $tabla = DB::connection('mysql')->select("SELECT *,CASE WHEN CURDATE() < fechaInicio THEN 'PENDENTE' WHEN CURDATE() > fechaFin THEN 'FINALIZADO' ELSE 'ACTIVO' END AS sta
        FROM(
            SELECT p.id,t.tipo,p.observacion,p.fechaInicio,DATE_ADD(fechaInicio, INTERVAL 1 MONTH) AS fechaFin
            FROM pagos AS p
            LEFT JOIN(SELECT id,tipo FROM tipopagos) AS t ON p.idTipoPago = t.id
            WHERE idCliente = $cliente AND p.idTipoPago IN (1,2,3)
        ) AS sg
        WHERE CURDATE() <= fechaFin
        ");

        return view('Servicios.membresiasActivas',compact('tabla'));
    }

    public function guardarServicio(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $cliente = $request->clientesNR;
        $servicio = $request->serviciosNR;
        $fecini = $request->feciniNR;
        $importe = str_replace(',','',$request->importeNR);
        $pendiente = str_replace(',','',$request->pendienteNR);
        $observacion = $request->observacionNR;

        $response = noVacio($cliente,'CLIENTE',$response);
        $response = noVacio($servicio,'SERVICIO',$response);
        $response = noVacio($importe,'IMPORTE',$response);

        if(in_array($servicio,[1,2,3])){
            $response = noVacio($fecini,'FECHA INICIO',$response);
        }

        if($response['sta'] == 0){

            $consultar = DB::connection('mysql')->select("SELECT id,IFNULL(deuda,0) AS deuda FROM clientes WHERE id = '$cliente'");
            $deuda = $consultar[0]->deuda;

            if($servicio == 5){
                $total = $deuda-$importe;
            }else{
                $total = $deuda+$pendiente;
            }

            if($total < 0){
                $total = 0;
            }

            DB::connection('mysql')->table('clientes')->where('id','=',$cliente)->update(['deuda' => $total]);

            DB::connection('mysql')->table('pagos')->insert([
                'idCliente' => $cliente,
                'idTipoPago' => $servicio,
                'importe' => $importe,
                'pendiente' => empty($pendiente) ? null : $pendiente,
                'observacion' => $observacion,
                'fechaInicio' => $fecini,
                'idRegistro' => Session::get('Sid'),
                'fechaRegistro' => Date('Y-m-d H:i')
            ]);

        }

        echo json_encode($response);
    }

    public function agregarServicioMain(){

        $clientes = DB::connection('mysql')->select("SELECT id,nombre,apellidoP,apellidoM FROM clientes ORDER BY nombre ASC");
        $servicios = DB::connection('mysql')->select("SELECT * FROM tipopagos ORDER BY id ASC");

        return view('Servicios.agregarServicioMain',compact('clientes','servicios'));
    }
}