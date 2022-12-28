<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class InicioController extends Controller
{
    public function index(){
        $titulo = "INICIO";
        $active = "navinicio";

        return view('Inicio.index',compact('titulo','active'));
    }

    public function tabla(){
        $titulo = "INICIO";
        $active = "navinicio";

        return view('Inicio.tabla',compact('titulo','active'));
    }
}
