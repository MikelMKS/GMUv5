<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class LoginController extends Controller
{
    public function login(){
        if(Session::get('Sid') == null){
            return view('Login.login');
        }else{
            return redirect()->route('inicio');
        }
    }

    public function valida(Request $request){
        $response = array('status' => 0,'msg' => ''); 

        $username = $request->username;
		$password = $request->password;

        $response = noVacio($username,'USUARIO',$response);
        $response = noVacio($password,'CONTRASEÑA',$response);
        

        if($response['status'] != '1'){
            $consulta = DB::connection('mysql')->select("SELECT * FROM usuarios WHERE user = '$username' AND pass = '$password'");

            if($consulta == null){
                $response['status'] = '1';
                $response['msg'] = "USUARIO O CONTRASEÑA INCORRECTOS";
            }else{
                Session::put('Sid', $consulta[0]->id);
                Session::put('Sname', $consulta[0]->user);

                $sessionid = Session::get('Sid');
                $sessionnick = Session::get('Sname');
            }
        }
        
        echo json_encode($response);
        // return $consulta;
    }

    public function closesesion(){
    Session::forget('Sid');
    Session::forget('Sname');

    return redirect()->route('admonLvl');
    }
}
