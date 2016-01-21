<?php
namespace Control;
use Control\App;
use Core\Config;

class CuentasControl extends App{
    function __info($id){
        $cuentas = $this->Cuentas->findByIdEmpresa($id);

        foreach($cuentas as &$cuenta){
            $rubros = [];
            $temp = $this->Cuentas->Cuentas_rubros("id_rubro", ["conditions"=>["id_empresa"=>$id, "id_cuenta"=>$cuenta["id_cuenta"]]], true);

            foreach($temp as $tmp) $rubros[] = $tmp["id_rubro"];

            $cuenta["rubros"] = $rubros;
            $cuenta["show"] = true;
        }

        return $cuentas;
    }
}
?>
