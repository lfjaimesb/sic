<?php
namespace Control;
use Control\App;

class PeriodosControl extends App{
    function periodos($empresa){
        $this->json = false;
        list($a, $m) = explode("/", date("Y/n"));

        $meses = [1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre", "Ajuste"];

        $ejercicios = $this->Periodos->find("id_periodo, ejercicio, periodo", ["conditions"=>["id_empresa"=>$empresa], "order"=>["ejercicio"=>"desc", "periodo"=>"asc"]]);

        foreach ($ejercicios as &$ejercicio){
            $ejercicio["nombre"] = $meses[$ejercicio["periodo"]]." ".$ejercicio["ejercicio"];

            if($a == $ejercicio["ejercicio"] && $m == $ejercicio["periodo"]) $ejercicio["checked"] = true;
        }

        return $ejercicios;
    }

    private function __periodos($empresa, $ejercicio){


        $periodos = $this->Periodos->find("id_periodo, periodo", ["conditions"=>["id_empresa"=>$empresa, "ejercicio"=>$ejercicio], "group"=>["periodo desc"]]);

        foreach($periodos as &$periodo)
            $periodo["nombre"] = $meses[$periodo["periodo"]];

        return $periodos;
    }

    function nvo(){
        return $this->Post;
    }
}
?>
