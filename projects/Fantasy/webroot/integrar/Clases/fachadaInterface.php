<?php

require_once 'Jugador.php';
require_once 'Equipo.php';
require_once 'Estadio.php';
require_once 'Roster.php';
require_once 'tiene.php';
require_once 'Estadistica_Pitcheo.php';
require_once 'Estadistica_Bateo.php';
require_once 'Usuario.php';
require_once 'Perfil_Usuario.php';

class fachadaInterface {
    
    private static $instancia;
    
    private function __construct(){}
    
    public static function singleton(){
        if (!isset(self::$instancia))
            self::$instancia = new fachadaInterface();
        return self::$instancia;
    }
    
    public function insertar(){
        switch ($_POST['TIPO']):
            case "Jugador":
                $obj = new Jugador($_POST);
                break;
            case "Equipo":
                $obj = new Equipo($_POST);
                break;
            case "Estadio":
                $obj = new Estadio($_POST);
                break;
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "tiene":
                $obj = new tiene($_POST);
                break;
        endswitch;
        $obj->insertar();
    }
    
    //De Toda la Gestion de Estadisticas se encarga el Jugador
    public function G_Estadistica(Jugador $Jugador){
        $Jugador->G_Estadistica($_POST);
    }
    
    public function actualizar(){
        switch ($_POST['TIPO']):
            case "Jugador":
                $obj = new Jugador($_POST);
                break;
            case "Equipo":
                $obj = new Equipo($_POST);
                break;
            case "Estadio":
                $obj = new Estadio($_POST);
                break;    
//Actualizar Usrs y PerfUsrs
            case "Perfil_Usuario":
                    $obj = new Perfil_Usuario($_POST);
                    break;
            case "Usuario":
                    $obj = new Usuario($_POST);
                    break;
//            
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "tiene":
                $obj = new tiene($_POST);
                break;            
        endswitch;

        $obj->actualizar();
    }
    
    public function eliminar(){
        switch ($_POST['TIPO']):
            case "Jugador":
                $obj = new Jugador($_POST);
                break;
            case "Equipo":
                $obj = new Equipo($_POST);
                break;
            case "Estadio":
                $obj = new Estadio($_POST);
                break;
//Eliminar Usrs y PerfUsrs
            case "Perfil_Usuario":
                    $obj = new Perfil_Usuario($_POST);
                    break;
            case "Usuario":
                    $obj = new Usuario($_POST);
                    break;
//            
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "tiene":
                $obj = new tiene($_POST);
                break;            
        endswitch;
        $obj->eliminar();
    }
    
    public function obtener(){
        switch ($_POST['TIPO']):
            case "Jugador":
                $obj = new Jugador($_POST);
                break;
            case "Equipo":
                $obj = new Equipo($_POST);
                break;
            case "Estadio":
                $obj = new Estadio($_POST);
                break;
//Obtener Usrs y PerfUsrs
            case "Perfil_Usuario":
                    $obj = new Perfil_Usuario($_POST);
                    break;
            case "Usuario":
                    $obj = new Usuario($_POST);
                    break;
//            
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "tiene":
                $obj = new tiene($_POST);
                break;               
        endswitch;
        $obj->obtener();
        return $obj;
    }
    
    public function obtenerTodos(){
        switch ($_POST['TIPO']):
            case "Jugador":
                $obj = new Jugador($_POST);
                break;
            case "Equipo":
                $obj = new Equipo($_POST);
                break;
            case "Estadio":
                $obj = new Estadio($_POST);
                break;
//Obtener todos los usrs
            case "Usuario":
                    $obj = new Usuario($_POST);
                    break;            
//
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "tiene":
                $obj = new tiene($_POST);
                break;               
        endswitch;
        $arr = $obj->obtenerTodos();
        return $arr;
    }
    
    public function consultarEstadisticas($obj){
        $Res= array();
        unset($_POST);
        switch (get_class($obj)):
            case "Jugador":
                
                $Res = $obj->obtenerSUMEstadisticas();
                break;
                
            case "Equipo":
                $_POST['TIPO']='Jugador';
                $_POST['equipo']=$obj->id;
                $Jugadores = $this->obtenerTodos();
                
                $i=0;
                $j=0;
                foreach ($Jugadores as $Jugador){
                    if($Jugador->posicion=='P'){
                        $TmpP[$i] = $this->consultarEstadisticas($Jugador);
                        $i++;
                    }else{
                        $TmpB[$j] = $this->consultarEstadisticas($Jugador);
                        $j++;
                    }
                }
                
                $i=0;
                for($i=0;$i<count($TmpP);$i++)
                    foreach ($TmpP[$i] as $key => $value) {
                        if(is_int($value))
                            if(isset($Res[0][$key]))
                                $Res[0][$key]+=$value;
                            else
                                $Res[0][$key]=$value;
                    }
                $i=0;
                for($i=0;$i<count($TmpB);$i++)
                    foreach ($TmpB[$i] as $key => $value) {
                        if(is_int($value))
                            if(isset($Res[1][$key]))
                                $Res[1][$key]+=$value;
                            else
                                $Res[1][$key]=$value;
                    }
                
                break;
        endswitch;
        
        return $Res;
        
        
    }
    
    public function CreateTable($id,$Matriz){
        $n = count($Matriz);
        $m = count($Matriz[0]);
        
        echo '<table id='.$id.' >';
        for($i=0;$i<$n;$i++){
            echo '<tr id='.$i.'>';
            for($j=0;$j<$m;$j++){
                if($Matriz[$i][$j]!=null)
                    echo '<td id='.$i.'_'.$j.' >'.$Matriz[$i][$j].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
            
    }

}

?>
