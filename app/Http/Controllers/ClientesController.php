<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ClientesController extends Controller
{
    public function __construct(){
        $this->tittle = "CLIENTES";
    }

    public function index(){
        $clientes = DB::connection('mysql')->select("SELECT * FROM usuarios WHERE estatus != 2");

        return view('Clientes.index',compact('clientes'))->with(['tittle' => $this->tittle]);
    }
}
