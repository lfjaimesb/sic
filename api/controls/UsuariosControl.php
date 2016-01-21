<?php
namespace Control;
use Control\App;
use Core\Config;
use Lib\Jwt\JWT;
use Control\EmpresasControl as Empresa;
use Control\PeriodosControl as Periodos;

class UsuariosControl extends App {
    function authenticate(){
        $usuario = $this->Usuarios->findByUsuario($this->Post["usuario"]);

        if(!empty($usuario)){
            if (password_verify($this->Post["password"], $usuario["pass"])) {
                unset($usuario["pass"]);

                $secretKey = base64_decode(Config::Reader("SALT"));

                $data = [
                    'iss'  => SITE,
                    'aud'  => SITE,
                    'iat'  => time(),
                    'exp'  => time() +  (60 * 60 * 24 * 7),
                    'sub' => 'usuario',
                    'admin' => true,
                    'data' => $usuario
                ];

                $jwt = JWT::encode($data, $secretKey,'HS512');

                $this->Response = ['token' =>$jwt];
            }else $this->Response = ["error"=>"La contraseña o usuario incorrecto"];
        }else $this->Response = ["error"=>"El usuario no existe"];

    }
}

?>
