<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class AdministrativosController extends Controller
{
    public function __construct(){
        $this->tittle = "ADMINISTRATIVOS";
    }

    public function index(){
        $administrativos = DB::connection('mysql')->select("SELECT * FROM usuarios");

        return view('Administrativos.index',compact('administrativos'))->with(['tittle' => $this->tittle]);
    }
}
