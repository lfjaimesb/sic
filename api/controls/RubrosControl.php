<?php
namespace Control;
use Control\App;
use Core\Config;

class RubrosControl extends App{
    function __info($id){
        $rubros = $this->Rubros->findByIdEmpresa($id);
        $rubros = array_merge([["id_rubro"=>0, "id_empresa"=>1, "descripcion"=>"todos"]], $rubros);
        return $rubros;
    }
}
?>
