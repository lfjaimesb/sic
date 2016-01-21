<?php
namespace Control;
use Control\App;
use Core\Config;

class RegimenControl extends App{
    function __info(&$empresa){
        $regimenes = $this->Regimen->find("all");

        $regimes = ["fisica"=>[], "moral"=>[]];

        foreach ($regimenes as $regimen) {
            if($regimen["id_regimen"] == $empresa["id_regimen"]){
                $empresa["regimen"] = $regimen;
            }

            $regimes[$regimen["persona"]][] = $regimen;
        }

        return $regimes;
    }
}
?>
