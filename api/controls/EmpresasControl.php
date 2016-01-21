<?php
namespace Control;
use Control\App;
use \Imagick;
use \ImagickPixel;

class EmpresasControl extends App{
    function __info($id){
        $empresa = $this->Empresas->findByIdEmpresa($id);
        $empresa["logo"] .= "?".time();
        $empresa["nivel"] = explode(",", $empresa["niveles"]);
        $empresa["iva"] = $empresa["iva"]==1?true:false;
        $empresa["isr"] = $empresa["isr"]==1?true:false;
        $empresa["bcert"] = file_exists(ROOT."csd".DS.$empresa["cert"])?"1a813a":"811a1d";
        $empresa["bllave"] = file_exists(ROOT."csd".DS.$empresa["llave"])?"1a813a":"811a1d";

        return $empresa;
    }

    function save(){
        $pathOpenSSL = "C:\OpenSSL-Win64\bin\openssl.exe";
        $col = ["fcer" => ["c"=>"cert", "e"=>"cert"], "fkey" => ["c"=>"llave", "e"=>"key"], "flogo"=>["c"=>"logo", "e"=>"jpg"]];
        $error = [];

        foreach ($_FILES as $key => $file) {
            $name = strtolower($this->Post["rfc"]) . "." . $col[$key]["e"];
            $this->Post[$col[$key]["c"]] = $name;

            if($key == "flogo"){
                $logo = dirname(ROOT).DS."img".DS."logos".DS.$name;
                $name = CACHE.time()."_".$file["name"];
            }else $name = ROOT. "csd".DS.$name;

            if(move_uploaded_file($file["tmp_name"], $name)){
                if($key == "fkey"){
                    exec("{$pathOpenSSL} pkcs8 -inform DER -in {$name} -passin pass:{$this->Post['csd']} -out {$name}.pem");

                    $valKey = file_get_contents($name.".pem");
    				if(!$valKey){
    					$error[] = "<p class='text-warning'>Contraseña CSD no valida</p>";
    					unlink($name.".pem");
    				}
                }else if($key == "fcer"){
                    exec("{$pathOpenSSL} x509 -inform DER -outform PEM -in {$name} > {$name}.pem");

                    $pem = openssl_x509_parse(file_get_contents($name.".pem"));
                    $this->Post["vigencia"] = date("Y-m-d H:i:s",$pem['validTo_time_t']);
                    $this->Post["certificado"] = $this->__convierte($pem['serialNumber']);
                }else{
                    $imagen = new Imagick($name);
                    $imagen->thumbnailImage(250, 250, true);
                    $h = (250 - $imagen->getImageHeight())/2;
                    $w = (250 - $imagen->getImageWidth())/2;


                    $i = new Imagick();
                    $i->newImage(250, 250,'white');
                    $i->setImageFormat('jpeg');
          					$i->compositeImage($imagen, $imagen->getImageCompose(), $w, $h);
                    $i->writeImage($logo);

                    $imagen->clear();
                    $imagen->destroy();

                    $imagen->clear();
                    $imagen->destroy();

                    chmod($logo, 0777);
                    unlink($name);
                }
            }
        }

        $empresa =["id_empresa" => $this->Post["id_empresa"]];
        unset($this->Post["id_empresa"]);

        if(count($error)) $this->Response = ["error"=>$error];
        else{
            $resp = $this->Empresas->modify($this->Post, $empresa);

            if(isset($resp["error"])) $this->Response = ["error"=> $resp["error"]];
            else $this->Response = ["success"=>"Los datos se han guardado correctaemte"];
        }



    }

    private function __convierte($dec) {
		$hex=$this->__bcdechex($dec);
		$ser="";
		for ($i=1; $i<strlen($hex); $i=$i+2) {
			$ser.=substr($hex,$i,1);
		}
		return $ser;
	}

	private function __bcdechex($dec) {
		$last = bcmod($dec, 16);
		$remain = bcdiv(bcsub($dec, $last), 16);
		if($remain == 0) {
			return dechex($last);
		} else {
			return $this->__bcdechex($remain).dechex($last);
		}
	}
}
?>
