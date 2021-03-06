<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use App\Models\Tablero;
use App\Models\Usuario;
use App\Models\Tablero_Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function crear()
    {
        $usuario = new Usuario();
        $usuario->correo = "";
        $usuario->password = "";
        $verificar = $usuario->save();
        if($verificar){
            echo json_encode(["estatus" => "success"]);
        }else{
            echo json_encode(["estatus" => "error"]);
        }
    }

    public function editar($id)
    {
        $usuario = Usuario::find($id);
        $usuario->correo = "";
        $usuario->password = "";
        $verificar = $usuario->save();
        if($verificar){
            echo json_encode(["estatus" => "success"]);
        }else{
            echo json_encode(["estatus" => "error"]);
        }
    }

    public function mostrar($id)
    {
        $usuario = Usuario::find($id);
        if($usuario){
            echo json_encode(["estatus" => "success","usuario" => $usuario]);
        }else{
            echo json_encode(["estatus" => "error"]);
        }
    }

    public function mostrarTodo()
    {
        $usuarios = Usuario::get();
        if($usuarios){
            echo json_encode(["estatus" => "success","usuarios" => $usuarios]);
        }else{
            echo json_encode(["estatus" => "error"]);
        }
    }

    public function eliminar($id)
    {
        $usuario = Usuario::find($id);
        $verificar = $usuario->delete();
        if($verificar){
            echo json_encode(["estatus" => "success"]);
        }else{
            echo json_encode(["estatus" => "error"]);
        }
    }

    public function bienvenida(){
        return view("bienvenida");
    }

    public function login(){
        return view("login");
    }

    public function registro(){
        return view("registro");
    }

    public function menu(){
        $tableros = Tablero::where('usuario1_id',session('usuario')->id)->orWhere('usuario2_id',session('usuario')->id)->get();
        $tableros2 = Tablero::where('usuario1_id',session('usuario')->id)->orWhere('usuario2_id',session('usuario')->id)->where('ganador_id',session('usuario')->id)->get();
        $contador=0;
        $contador2=0;
        foreach($tableros as $a){
            if($a->usuario1_id==session('usuario')->id||$a->usuario2_id==session('usuario')->id)
            $contador++;
        }
        foreach($tableros2 as $a){
            if($a->ganador_id==session('usuario')->id)
            $contador2++;
        }
        return view("menu",["mensaje"=>$contador],["mensaje2"=>$contador2]);
    }

    public function registroForm(Request $datos){

        if(!$datos->correo || !$datos->password1 || !$datos->password2)
            return view("registro",["estatus"=> "error", "mensaje"=> "??Falta informaci??n!"]);

        $usuario = Usuario::where('correo',$datos->correo)->first();
        if($usuario)
            return view("registro",["estatus"=> "error", "mensaje"=> "??El correo ya se encuentra registrado!"]);

        $correo = $datos->correo;
        $password2 = $datos->password2;
        $password1 = $datos->password1;

        if($password1 != $password2){
            return view("registro",["estatus" => "??Las contrase??as son diferentes!"]);
        }

        $usuario = new Usuario();
        $usuario->correo =  $correo;
        $usuario->password = bcrypt($password1);
        $usuario->save();
            return view("login",["estatus"=> "success", "mensaje"=> "??Cuenta Creada!"]);

    }

    public function verificarCredenciales(Request $datos){

        if(!$datos->correo || !$datos->password)
            return view("login",["estatus"=> "error", "mensaje"=> "??Completa los campos!"]);

        $usuario = Usuario::where("correo",$datos->correo)->first();
        if(!$usuario)
            return view("login",["estatus"=> "error", "mensaje"=> "??El correo no esta registrado!"]);

        if(!Hash::check($datos->password,$usuario->password))
            return view("login",["estatus"=> "error", "mensaje"=> "??Datos incorrectos!"]);

        Session::put('usuario',$usuario);

        if(isset($datos->url)){
            $url = decrypt($datos->url);
            return redirect($url);
        }else{
            return redirect()->route('usuario.menu');
        }

    }

    public function cerrarSesion(){
        if(Session::has('usuario'))
            Session::forget('usuario');

        return redirect()->route('bienvenida');
    }

    public function crearTablero(){
        return view('crear-tablero');
    }

    public function misTableros (){
        $tableros = Tablero::where('usuario1_id',session('usuario')->id)->get();
        foreach ($tableros as $tablero){
            $usuario1 = Usuario::find($tablero->usuario1_id);
            $usuario2 = Usuario::find($tablero->usuario2_id);
            $ganador = Usuario::find($tablero->ganador_id);
            $tablero->correoUsuario1 = $usuario1->correo;
            $tablero->correoUsuario2 = $usuario2->correo;
            $tablero->ganador = $ganador->correo;
        }
        return view('mistableros',["tableros" => $tableros]);
    }

    public function tableros (){
        $tableros = Tablero::where("estatus","nuevo")->orWhere('estatus','activo')->get();
        foreach ($tableros as $tablero){
            $usuario1 = Usuario::find($tablero->usuario1_id);
            if($usuario1){
                $tablero->correoUsuario1 = $usuario1->correo;
            }
        }
        return view("tableros",["tableros" => $tableros]);
    }

    public function historial(){
        $tableros = Tablero::where('estatus','finalizado')->where('usuario1_id',session('usuario')->id)->orWhere('usuario2_id',session('usuario')->id)->get();
        foreach ($tableros as $tablero) {
            $usuario = Usuario::find($tablero->usuario1_id);
            $usuario2 = Usuario::find($tablero->usuario2_id);
            $tablero->nombreJugador = $usuario->correo;
            $tablero->nombreJugador2 = $usuario2->correo;
        }
        return view('historial',["tableros" => $tableros]);

    }

    public function mensaje($codigo){
        $tablero = Tablero::where("codigo",$codigo)->first();
        $ultimoTiro = Tablero_Movimiento::where("tablero_id",$tablero->id)->orderBy("created_at",'desc')->first();
        $ultimo = $ultimoTiro->usuario_id;
        if($ultimoTiro->usuario_id==$tablero->usuario1_id||$ultimoTiro->usuario_id==$tablero->usuario2_id){
            $usuario = Tablero::find($codigo);
            $tablero->ganador_id=$ultimo;
            $tablero->save();
        }
         $usuarios = Usuario::where('id',$ultimo)->first();
         $nombre = $usuarios->correo;
         return view("mensaje",["ganador"=>$nombre]);
    }



}
