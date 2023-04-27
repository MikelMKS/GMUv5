<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ReportesController extends Controller
{
    public function __construct(){
        $this->tittle = "REPORTES";
    }

    public function index(){
        return view('Reportes.index')->with(['tittle' => $this->tittle]);
    }
    
    public function reportePendientes(){
        $tabla = DB::select("SELECT id,nombre,apellidoP,apellidoM,deuda FROM clientes WHERE deuda > 0");

        return view('Reportes.Pendientes.reportePendientes',compact('tabla'))->with(['tittle' => $this->tittle,'subtit' => 'Pendientes','chart' => 'cPendientes']);
    }
    
    public function reporteCorte(){
        return view('Reportes.Corte.reporteCorte')->with(['tittle' => $this->tittle,'subtit' => 'Corte','chart' => 'cCorte']);
    }

    public function reporteCorteTabla(){
        $inicio = $_REQUEST['inicio'];
        $fin = $_REQUEST['fin'];

        $tabla = DB::select("SELECT s_a.*,CONCAT(IFNULL(nombre,''),' ',IFNULL(apellidoP,''),' ',IFNULL(apellidoM,'')) AS Cliente
        ,IFNULL(TotalGym,0)+IFNULL(Semanal,0)+IFNULL(Visita,0)+IFNULL(Herbalife,0) AS Total
        FROM(
                    SELECT idCliente,MIN(CAST(fechaRegistro AS DATE)) AS Fecha
                    ,MIN(CASE WHEN idTipoPago = 1 THEN fechaInicio END) AS InicioGym
                    ,SUM(CASE WHEN (idTipoPago = 1 OR idReferencia = 1) THEN importe END) AS TotalGym
                    ,NULLIF(COUNT(CASE WHEN (idTipoPago = 1 OR idReferencia = 1) THEN id END),0) AS PagosGym
                    ,SUM(CASE WHEN (idTipoPago = 3 OR idReferencia = 3) THEN importe END) AS Semanal
                    ,SUM(CASE WHEN (idTipoPago = 2 OR idReferencia = 2) THEN importe END) AS Visita
                    ,SUM(CASE WHEN (idTipoPago = 4 OR idReferencia = 4) THEN importe END) AS Herbalife
                    FROM pagos AS p
                    WHERE CAST(fechaRegistro AS DATE) BETWEEN '2023-03-04' AND '2023-04-04'
                    GROUP BY idCliente
        ) AS s_a
        LEFT JOIN(SELECT id,nombre,apellidoP,apellidoM FROM clientes) AS c ON s_a.idCliente = c.id
        ORDER BY fecha ASC
        ");

        return view('Reportes.Corte.reporteCorteTabla',compact('tabla'))->with(['tittle' => $this->tittle,'subtit' => 'Corte','chart' => 'cCorte']);
    }
}
