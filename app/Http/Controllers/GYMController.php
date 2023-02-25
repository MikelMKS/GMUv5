<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class GYMController extends Controller
{
    public function __construct(){
        $this->tittle = "GYM";
    }

    public function index(){
        

        return view('GYM.index',compact('administrativos'))->with(['tittle' => $this->tittle]);
    }
}
