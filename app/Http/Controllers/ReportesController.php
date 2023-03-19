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
}
