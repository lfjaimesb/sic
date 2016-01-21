<?php
namespace Plugins;
use Core\Plugins;
use Core\Config;

class Jwt extends Plugins{
    private $alg = false;
    private $typ = false;
    private $algs = [
        'HS256' => ['hash_hmac', 'sha256'],
        'HS512' => ['hash_hmac', 'sha512'],
        'HS384' => ['hash_hmac', 'sha384'],
        'RS256' => ['openssl', 'sha256'],
    ];

    function header($typ = "JWT", $alg = "HS256"){
        $this->alg =  $alg;
        $this->typ =  $typ;

        return $this->UrlEncode(["alg" => $alg, "typ" => $typ]);
    }

    function payload($data){
        return $this->UrlEncode($data);
    }

    function signature($header, $payload){
        $f = $this->algs[$this->alg];
        $s = $f[0]($f[1], $header.".".$payload, "norman");
        return $this->UrlEncode($s);
    }

    private function UrlEncode($input){
        //return str_replace('=', '', strtr(base64_encode(json_encode($input)), '+/', '-_'));
         return rtrim(strtr(base64_encode(json_encode($input)), '+/', '-_'), '=');
    }
}

?>
