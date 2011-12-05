<?php

require_once 'Jugador.php';
require_once 'Equipo.php';
require_once 'Estadio.php';
require_once 'Roster.php';
require_once 'Roster_Equipo.php';
require_once 'Roster_Jugador.php';
require_once 'Estadistica_Pitcheo.php';
require_once 'Estadistica_Bateo.php';
require_once 'Usuario.php';
require_once 'Manager.php';
require_once 'Perfil_Usuario.php';
require_once 'Contenidos.php';

class fachadaInterface {
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

    public function login(){
        session_start();
        if (!isset($_SESSION['Administrador']) && !isset($_SESSION['Manager'])){
            $res = $this->obtener();
            if ($res->id != -1) {
                unset($_POST);
                $_POST['TIPO'] = "Manager";
                $_POST['usuario'] = $res->id;
                $res = $this->obtener();
                if ($res->id == -1) {
                    $_SESSION['Administrador'] = $_POST['id'];
                } else {
                    $_SESSION['Manager'] = $res->id;
                }
            }
        }
    }

    //Funciones Nuevas a Agregar
    public function consultarEstadisticasDetalladas(Jugador $Jugador){
        return $Jugador->obtenerTodasEstadisticas();
    }

    public function obtenerEstadistica(Jugador $Jugador){
        return $Jugador->obtenerEstadistica($_POST);
    }
}

?>
