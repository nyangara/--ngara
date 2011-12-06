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
//ROSTER NUEVO JESUS            
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "Roster_Jugador":
                $obj = new Roster_Jugador($_POST);
                break;
            case "Roster_Equipo":
                $obj = new Roster_Equipo($_POST);
                break;
//            
            case "Usuario":
                $obj = new Usuario($_POST);
                break;
            case "Manager":
                $obj = new Manager($_POST);
                break;
			case "Perfil_Usuario":
                    $obj = new Perfil_Usuario($_POST);
                break;
            case "Contenidos":
                $obj = new Contenidos($_POST);
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
            case "Manager":
                $obj = new Manager($_POST);
                break;
//            
//ROSTER NUEVO JESUS
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "Roster_Jugador":
                $obj = new Roster_Jugador($_POST);
                break;            
            case "Roster_Equipo":
                $obj = new Roster_Equipo($_POST);
                break;                        
//
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
//ROSTER NUEVO JESUS                
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "Roster_Jugador":
                $obj = new Roster_Jugador($_POST);
                break;            
            case "Roster_Equipo":
                $obj = new Roster_Equipo($_POST);
                break; 
//ROSTER
            case "Manager":
                $obj = new Manager($_POST);
                break;      
            case "Contenidos":
                $obj = new Contenidos($_POST);
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
            case "Manager":
                $obj = new Manager($_POST);
                break;
//      
//ROSTER NUEVO JESUS                
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "Roster_Jugador":
                $obj = new Roster_Jugador($_POST);
                break;            
            case "Roster_Equipo":
                $obj = new Roster_Equipo($_POST);
                break;                     
//ROSTER            
            case "Contenidos":
                $obj = new Contenidos($_POST);
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
            case "Perfil_Usuario":
                    $obj = new Perfil_Usuario($_POST);
                    break;
            case "Usuario":
                $obj = new Usuario($_POST);
                break;
            case "Manager":
                $obj = new Manager($_POST);
                break;       
//
//ROSTER NUEVO JESUS                
            case "Roster":
                $obj = new Roster($_POST);
                break;
            case "Roster_Jugador":
                $obj = new Roster_Jugador($_POST);
                break;            
            case "Roster_Equipo":
                $obj = new Roster_Equipo($_POST);
                break;
//ROSTER            
            case "Contenidos":
                $obj = new Contenidos($_POST);
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
