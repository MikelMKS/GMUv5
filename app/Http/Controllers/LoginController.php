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
            return redirect()->route('index');
        }
    }

    public function valida(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $username = $request->username;
		$password = $request->password;

        $response = noVacio($username,'USUARIO',$response);
        $response = noVacio($password,'CONTRASEÑA',$response);
        

        if($response['sta'] != '1'){
            $consulta = DB::connection('mysql')->select("SELECT * FROM usuarios WHERE user = '$username' AND pass = '$password' AND estatus != 2");


            if($consulta == null){
                $response['sta'] = '1';
                $response['msg'] = "USUARIO O CONTRASEÑA INCORRECTOS";
            }else{
                if($consulta[0]->estatus == 0){
                    $response['sta'] = '1';
                    $response['msg'] = "ACCESO DE USUARIO DESACTIVADO";
                }else{
                    Session::put('Sid', $consulta[0]->id);
                    Session::put('Sname', $consulta[0]->user);
                    Session::put('Stipo', $consulta[0]->idTipo);

                    $sessionid = Session::get('Sid');
                    $sessionnick = Session::get('Sname');
                    $sessiontipo = Session::get('Stipo');
                }
            }
        }
        
        echo json_encode($response);
        // return $consulta;
    }

    public function closesesion(){
    Session::forget('Sid');
    Session::forget('Sname');
    Session::forget('Stipo');

    return redirect()->route('login');
    }

    public function editarPerfil(){
        $id = Session::get('Sid');
        $datos = DB::connection('mysql')->select("SELECT * FROM usuarios WHERE id = '$id'");

        return view('Login.editarPerfil',compact('id','datos'));
    }

    public function updatePerfil(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $id = $request->idEditPerfil;
        $usuario = $request->usuarioEditPerfil;
        $contraseña = $request->contraseñaEditPerfil;
        $nombre = $request->nombreEditPerfil;
        $imagen = $request->file('imagenEditPerfil');

        $response = noVacio($usuario,'USUARIO',$response);
        $response = noVacio($contraseña,'CONTRASEÑA',$response);

        if($response['sta'] == 0){
            $consultar = DB::connection('mysql')->select("SELECT id FROM usuarios WHERE user = '$usuario' AND id != '$id'");

            if($consultar != null){
                $response['sta'] = '1';
                $response['msg'] = "YA EXISTE UN USUARIO CON ESE NOMBRE";
            }

            if($response['sta'] == 0){
                DB::connection('mysql')->table('usuarios')->where('id','=',$id)->update([
                    'user' => $usuario,
                    'pass' => $contraseña,
                    'nombre' => $nombre,
                ]);

                if($imagen != null){
                    $filename = $id.'.png';
                    \Storage::disk('administrativos')->put($filename, \File::get($imagen));
                }

                Session::put('Sname', $usuario);
            }
        }

        echo json_encode($response);
    }
}
