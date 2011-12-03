<?php

    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();

    $id = $_POST['id'];
    unset($_POST);

    $_POST['id']=$id;
    $_POST['TIPO']='Jugador';
    $Jugador = $instancia->obtener();
    $Est = $instancia->consultarEstadisticas($Jugador); //Estadisticas de Jugador
    unset ($_POST);

    $_POST['id']=$Jugador->equipo;
    $_POST['TIPO']='Equipo';
    $Equipo = $instancia->obtener();


    include("Static/head.php");
    include("Static/header.php");

?>

<link rel="stylesheet" href="assets/styles/style_Datos_J.css"  type="text/css" />

        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
        </ul>
  </div>

	   
    <div id="content">
        <div id="contenido_interno_datos">

            <div id="box_info">
                <form id="Alcance">
                    <table width="550" border="0">
                        <tr>
                            <td>
                                <table width="400" border="0">
                                    <tr>
                                        <td colspan="2" align="right">Nombre del Equipo:</td>
                                        <td colspan="2" align="center"><?php echo $Equipo->nombre; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td><?php echo $Jugador->nombres; ?></td>
                                        <td>Apellido:</td>
                                        <td><?php echo $Jugador->apellidos; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Numero:</td>
                                        <td><?php echo $Jugador->numero; ?></td>
                                        <td>Precio:</td>
                                        <td><?php echo $Jugador->precio; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Posicion:</td>
                                        <td><?php echo $Jugador->posicion; ?></td>
                                        <td>Fecha de nacimiento:</td>
                                        <td><?php echo $Jugador->fecha_nacimiento; ?></td>
                                    </tr>
                                </table>

<?php
                if($Jugador->posicion=='P'){
                  echo '<table width="400" border="0">
                            <tr>
                                <td>Entradas Lanzadas</td>
                                <td>'. (isset($Est['el']) ? $Est['el'] : 0) .'</td>
                                <td>Carreras Limpias</td>
                                <td>'. (isset($Est['cl']) ? $Est['cl'] : 0) .'</td>
                            </tr>
                            <tr>
                                <td>Imparables</td>
                                <td>'. (isset($Est['i']) ? $Est['i'] : 0) .'</td>
                                <td>Bases por Bolas</td>
                                <td>'. (isset($Est['bb']) ? $Est['bb'] : 0) .'</td>
                            </tr>
                            <tr>
                                <td>Ponches</td>
                                <td>'. (isset($Est['k']) ? $Est['k'] : 0) .'</td>
                                <td>Juegos Ganados  </td>
                                <td>'. (isset($Est['jg']) ? $Est['jg'] : 0) .'</td>
                            </tr>
                            <tr>
                                <td>Errores</td>
                                <td>'. (isset($Est['errores']) ? $Est['errores'] : 0) .'</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>';
                } else  {
                echo '<table width="400" border="0">
                            <tr>
                                <td>Carreras Anotadas</td>
                                <td>'. (isset($Est['ca']) ? $Est['ca'] : 0) .'</td>
                                <td>Total de Bases</td>
                                <td>'. (isset($Est['tb']) ? $Est['tb'] : 0) .'</td>
                            </tr>
                            <tr>
                                <td>Carreras Impulsadas</td>
                                <td>'. (isset($Est['ci']) ? $Est['ci'] : 0) .'</td>
                                <td>Bases por Bolas</td>
                                <td>'. (isset($Est['bb']) ? $Est['bb'] : 0) .'</td>
                            </tr>
                            <tr>
                                <td>Bases Robadas</td>
                                <td>'. (isset($Est['br']) ? $Est['br'] : 0) .'</td>
                                <td>Ponches</td>
                                <td>'. (isset($Est['k']) ? $Est['k'] : 0) .'</td>
                            </tr>
                        </table>';                  
                }
?>
                        
                            </td>
                            <td>
                                <img src="<?php echo $Jugador->foto; ?>" width="132" height="180" />
                            </td>
                        </tr>
                    </table>
                </form>	
                <div id="env" >
                    <form action="gestion_jugadores.php">
                            <input type="submit" value="Regresar"/>
                    </form>

                    <form action="Listar_D_J.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $Jugador->id; ?>" />
                            <input type="submit" name="Detalles" value="Ver Detalles"  />

                    </form>

                    <form action="Modificar_J.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $Jugador->id; ?>" />
                            <input type="submit" name="Modificar" value="Modificar"  />      
                    </form>			

                    <form action="Modificar_J.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $Jugador->id; ?>" />
                            <input type="submit" name="Eliminar" value="Eliminar"  />      
                    </form>			
                </div>
            </div>
        </div>
        
<?php

    include("Static/sideBar.php");
    include("Static/footer.php");	

?>
