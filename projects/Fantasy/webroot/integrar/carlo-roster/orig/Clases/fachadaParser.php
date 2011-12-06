<?php

require_once 'Jugador.php';
require_once 'Equipo.php';
require_once 'Estadio.php';
require_once 'Estadistica_Pitcheo.php';
require_once 'Estadistica_Bateo.php';

class fachadaParser {
    
    private static $instancia;
    
    private function __construct(){}
    
    public static function singleton(){
        if (!isset(self::$instancia))
            self::$instancia = new fachadaParser();
        return self::$instancia;
    }
    
    private function obtenerMatrixBateador($equipo){
        $url = "http://www.lvbp.com/scripts/home/estadisticas_equip.asp?equipo=".$equipo."&co_temporada=1&co_ano_temporada=5&ds_temporada=Temporada%202011%20-%202012";

        $input = @file_get_contents($url) or die("Could not access file: $url");

        preg_match_all("|<tr>[\s\n]*<td align=\"left\" class=\"tdTablaPos1\"><div align=\"left\"><a href=\"(.*)\" class=\"fuenteLideresDet2\">(.*)</a></div></td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">".$equipo."</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<\/tr>|"
            , $input, $matches,PREG_PATTERN_ORDER);
        
        return $matches;
    }
    
    private function obtenerMatrixPitcher($equipo){
        $url = "http://www.lvbp.com/scripts/home/estadisticas_equip.asp?equipo=".$equipo."&co_temporada=1&co_ano_temporada=5&ds_temporada=Temporada%202011%20-%202012";

        $input = @file_get_contents($url) or die("Could not access file: $url");

        preg_match_all("|<tr>[\s\n]*<td align=\"left\" class=\"tdTablaPos1\"><a href=\"(.*)\" class=\"fuenteLideresDet2\">(.*)</a></td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">".$equipo."</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<\/tr>|"
            , $input, $matches,PREG_PATTERN_ORDER);
        
        return $matches;
    }
    
    public function sincronizarJugadores(){
        $arregloEquipos = array("AGUI","BRAV","CARD","CARI","LEON","MAGA","TIBU","TIGR");
        //$arregloEquipos = array("LEON");
        foreach ($arregloEquipos as $sigla) {
            $args["siglas"] = $sigla;
            $equipo = new Equipo($args);
            $equipo->obtener();
            
            $matrixBateador = self::obtenerMatrixBateador($sigla);
            $matrixPitcher = self::obtenerMatrixPitcher($sigla);
            
            for($i = 0; $i < count($matrixBateador[0]) ; $i++){
                $args['nombres'] = $matrixBateador[2][$i];
                $args['equipo'] = $equipo->id;
                $jugador = new Jugador($args);
                $jugador->posicion = "B";
                $jugador->precio = 0;
                $jugador->errores = 0;
                $jugador->foto = "\assets\images\Fotos_Jugadores\hitter.jpg";
                $jugador->insertar();
            }
            
            for($i = 0; $i < count($matrixPitcher[0]) ; $i++){
                $args['nombres'] = $matrixPitcher[2][$i];
                $args['equipo'] = $equipo->id;
                $jugador = new Jugador($args);
                $jugador->posicion = "P";
                $jugador->precio = 0;
                $jugador->errores = 0;
                $jugador->foto = "\assets\images\Fotos_Jugadores\pitcher.jpg";
                $jugador->insertar();
            }
        }
    }
    
    public function sincronizarEstadisticasJugadores(){
        $arregloEquipos = array("AGUI","BRAV","CARD","CARI","LEON","MAGA","TIBU","TIGR");
        //$arregloEquipos = array("LEON");
        date_default_timezone_set('America/Caracas');
        $date = date("Y/m/d");
        foreach ($arregloEquipos as $sigla) {
            $args["siglas"] = $sigla;
            $equipo = new Equipo($args);
            $equipo->obtener();
            
            $matrixBateador = self::obtenerMatrixBateador($sigla);
            $matrixPitcher = self::obtenerMatrixPitcher($sigla);
            
            for($i = 0; $i < count($matrixBateador[0]) ; $i++){
                $args['nombres'] = $matrixBateador[2][$i];
                $args['equipo'] = $equipo->id;
                $jugador = new Jugador($args);
                $jugador->obtener();
                $argsE['jugador'] = $jugador->id;
                $argsE['fecha'] = $date;
                $argsE['ci'] = (int)$matrixBateador[12][$i];
                $argsE['ca'] = (int)$matrixBateador[6][$i];
                $argsE['vb'] = (int)$matrixBateador[5][$i];
                $argsE['br'] = (int)$matrixBateador[18][$i];
                $argsE['bb'] = (int)$matrixBateador[13][$i];
                $argsE['h'] = (int)$matrixBateador[7][$i];
                $argsE['h2'] = (int)$matrixBateador[9][$i];
                $argsE['h3'] = (int)$matrixBateador[10][$i];
                $argsE['hr'] = (int)$matrixBateador[11][$i];
                $argsE['tb'] = (int)$matrixBateador[8][$i];
                $argsE['k'] = (int)$matrixBateador[14][$i];
                $estadisticas = new Estadistica_Bateo($argsE);
                
                $estadisticas->insertar();      
            }
            
            for($i = 0; $i < count($matrixPitcher[0]) ; $i++){
                $args2['nombres'] = $matrixPitcher[2][$i];
                $args2['equipo'] = $equipo->id;
                $jugador = new Jugador($args2);
                $jugador->obtener();
                $argsEP['jugador'] = $jugador->id;
                $argsEP['fecha'] = $date;
                $argsEP['el'] = (int)$matrixPitcher[11][$i];
                $argsEP['cl'] = (int)$matrixPitcher[17][$i];
                $argsEP['i'] = (int)$matrixPitcher[12][$i];
                $argsEP['bb'] = (int)$matrixPitcher[18][$i];
                $argsEP['k'] =  (int)$matrixPitcher[19][$i];
                $argsEP['jg'] = (int)$matrixPitcher[5][$i];
                //$argsEP['h3'] = (int)$matrixPitcher[10][$i];
                //$argsEP['hr'] = (int)$matrixPitcher[11][$i];
                //$argsEP['tb'] = (int)$matrixPitcher[8][$i];
                //$argsEP['k'] = (int)$matrixPitcher[14][$i];
                $estadisticasP = new Estadistica_Pitcheo($argsEP);
                
                $estadisticasP->insertar();      
            }
            
            
        }
    }

    
}

?>
