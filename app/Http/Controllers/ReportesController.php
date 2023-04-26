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
}
