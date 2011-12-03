<?php

$id_Manager=0;
$_POST['manager']=$id_Manager;

require_once("Clases/fachadaInterface.php");

$instancia = fachadaInterface::singleton();
$_POST['TIPO']='Roster';
$Rosters = $instancia->obtenerTodos();

include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Ljugadores.css"  type="text/css" />'; 

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a class="on" href="gestion_rosters.php">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
  </div>

	   
	<div id="content">
		<div id="contenido_interno_jugadores">';
		
		echo '<form id="form" action="Agregar_R.php" method="post">
		        <input type="submit" value="Nuevo Roster">
		      </form>';
		
		echo '<h2>Jugadores</h2>';

		for($i=0;$i<count($Rosters);$i++){
			$Tmp = $Rosters[$i];
			echo'
                            <div class="alcanceEquipoJ">
                                <center>
                                  <div id="box_jugador">

                                    <form class="Fila" action="InterfaceRoster.php" method="post" >
                                        <input type="hidden" name="id" value="'.$Tmp->id.'">
                                        <input class="imagen" type="image" src="assets/images/Fotos_Roster/generica.jpg" />
                                        <div class="datos">
                                            <div>Nombre: '.$Tmp->nombre.'</div>
                                            <div>]Fecha de Creacion: '.$Tmp->fecha_creacion.'</div>
                                        </div>
                                  </form>
                                  </div>
                                <center>
                            </div>';
		}
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>
