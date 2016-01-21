<?php
namespace Control;
use Control\App;
use Core\Config;
use Lib\Jwt\JWT;
use Control\EmpresasControl as Empresa;
use Control\RegimenControl as Regimen;
use Control\CuentasControl as Cuentas;
use Control\RubrosControl as Rubros;

class ListasControl extends App{
    function index(){
        $ctrlEmpresa = new Empresa();
        $ctrlRegimen = new Regimen();
        $ctrlCuentas = new Cuentas();
        $ctrlRubros = new Rubros();

        $empresa = $ctrlEmpresa->__info($this->UserToken->data->id_empresa);
        $regimes = $ctrlRegimen->__info($empresa);
        $cuentas = $ctrlCuentas->__info($empresa["id_empresa"]);
        $rubros = $ctrlRubros->__info($empresa["id_empresa"]);
        $sat =  $this->Listas->Sat("*");

        $this->Response = ["empresa"=>$empresa, "regimes" => $regimes, "cuentas"=>$cuentas, "rubros"=>$rubros, "csat"=>$sat];
    }

    function sat(){
        $this->Response =  $this->Listas->Sat("*", ["conditions"=>["nombre like"=>$this->Post["sat"]."%"]]);
    }
}

?>
