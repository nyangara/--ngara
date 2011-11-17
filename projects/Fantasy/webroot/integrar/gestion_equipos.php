<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachade.php");

include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_gestionar_equipos.css"  type="text/css" />'; 

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li class="on"><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
  </div>

	   
	<div id="content">
		<div id="contenido_interno">';
		
		echo '<form id="form" action="Agregar_Eq.php" method="post">
		        <input type="submit" value="Agregar Equipo">
		      </form>';
		
		echo '<h2>Equipos</h2>';


		$FachadaEquipo = new EquipoFachade;
		$Equipos = $FachadaEquipo->getEquipos();
		
		$N = count($Equipos);
		
		for($i=0;$i<$N;$i++){
			echo'
				<div class="alcanceEquipo">
					<form class="Fila" action="Datos_Eq.php" method="post" >
						<input type="hidden" name="idequipo" value="'.$Equipos[$i]->getId().'">
						<input class="imagen" type="image" src="assets/images/Fotos_Equipos/generico.jpg" />
						<div class="datos">
							<div>Nombre: '.$Equipos[$i]->getnombre().'</div>
							<div>Siglas: '.$Equipos[$i]->getsiglas().'</div>
							<div>Fecha de Fundacion: '.$Equipos[$i]->getfecha_fundacion().'</div>
						</div>
					</form>
				</div>';
		}
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>