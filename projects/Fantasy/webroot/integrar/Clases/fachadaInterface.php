<?php
        require_once 'model/Jugador.php';
        require_once 'model/Equipo.php';
        require_once 'model/Estadio.php';
        require_once 'model/Roster.php';
        require_once 'model/tiene.php';
        require_once 'model/EstadisticaPitcheo.php';
        require_once 'model/EstadisticaBateo.php';
        require_once 'model/Usuario.php';
        require_once 'model/Perfil_Usuario.php';

        class fachadaInterface {
                protected static $casos_insert = array(
                        'Jugador',
                        'Equipo',
                        'Estadio',
                        'Roster',
                        'tiene'
                );

                protected static $casos_update = array(
                        'Jugador',
                        'Equipo',
                        'Estadio',
                        'Roster',
                        'tiene',
                        'Perfil_Usuario',
                        'Usuario'
                );

                protected static $casos_remove = array(
                        'Jugador',
                        'Equipo',
                        'Estadio',
                        'Roster',
                        'tiene',
                        'Perfil_Usuario',
                        'Usuario'
                );

                protected static $casos_select = array(
                        'Jugador',
                        'Equipo',
                        'Estadio',
                        'Roster',
                        'tiene',
                        'Perfil_Usuario',
                        'Usuario'
                );

                protected static $casos_retrieveAll = array(
                        'Jugador',
                        'Equipo',
                        'Estadio',
                        'Roster',
                        'tiene',
                        'Usuario'
                );

                protected static function do($action) {
                        if (array_key_exists('TIPO', $_POST) && in_array($_POST['TIPO'], ${'casos_' . $action})) {
                                $o = new $_POST['TIPO']($_POST);
                                return call_user_func(array($o, $action));
                        }
                        return null;
                }

                public static function insert     () { self::do(__FUNCTION__); }
                public static function select     () { self::do(__FUNCTION__); }
                public static function update     () { self::do(__FUNCTION__); }
                public static function remove     () { self::do(__FUNCTION__); }
                public static function retrieveAll() { self::do(__FUNCTION__); }

                //De Toda la Gestion de Estadisticas se encarga el Jugador
                public function G_Estadistica(Jugador $Jugador) {
                        $Jugador->G_Estadistica($_POST);
                }

                public function consultarEstadisticas($obj) {
                        $Res = array();
                        unset($_POST); // WTF???
                        switch (get_class($obj)):
                        case "Jugador":
                                $Res = $obj->selectSUMEstadisticas();
                                break;

                        case "Equipo":
                                $_POST['TIPO'] = 'Jugador';
                                $_POST['equipo'] = $obj->id;
                                $Jugadores = $this->retrieveAll();

                                $i = 0;
                                $j = 0;
                                foreach ($Jugadores as $Jugador) {
                                        if($Jugador->posicion == 'P') {
                                                $TmpP[$i] = $this->consultarEstadisticas($Jugador);
                                                $i++;
                                        }else{
                                                $TmpB[$j] = $this->consultarEstadisticas($Jugador);
                                                $j++;
                                        }
                                }

                                $i = 0;
                                for($i = 0; $i<count($TmpP); $i++)
                                        foreach ($TmpP[$i] as $key => $value) {
                                                if(is_int($value))
                                                        if(isset($Res[0][$key]))
                                                                $Res[0][$key] += $value;
                                                        else
                                                                $Res[0][$key] = $value;
                                        }
                                $i = 0;
                                for($i = 0; $i<count($TmpB); $i++)
                                        foreach ($TmpB[$i] as $key => $value) {
                                                if(is_int($value))
                                                        if(isset($Res[1][$key]))
                                                                $Res[1][$key] += $value;
                                                        else
                                                                $Res[1][$key] = $value;
                                        }

                                break;
        endswitch;

                        return $Res;
                }

                public function CreateTable($id, $Matriz) {
                        $n = count($Matriz);
                        $m = count($Matriz[0]);

                        echo '<table id="' . $id . '">';
                        for($i = 0; $i < $n; ++$i) {
                                echo '<tr id="' . $id . '.' . $i . '">';
                                for($j = 0; $j < $m; ++$j) {
                                        if($Matriz[$i][$j]!=null)
                                                echo '<td id="' $id . "." . $i . '.' . $j . '">' . $Matriz[$i][$j] . '</td>';
                                }
                                echo '</tr>';
                        }
                        echo '</table>';
                }
        }
?>
