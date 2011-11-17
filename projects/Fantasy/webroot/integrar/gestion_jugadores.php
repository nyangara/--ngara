<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");

include("static/head.php");
include("static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Ljugadores.css"  type="text/css" />'; 

echo '

	
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
  </div>

	   
	<div id="content">
		<div id="contenido_interno_jugadores">';
		
		echo '<form id="form" action="Agregar_J.php" method="post">
		        <input type="submit" value="Agregar Jugador">
		      </form>';
		
		echo '<h2>Jugadores</h2>';


		$FachadaEquipos = new EquipoFachada;
		$equipos = $FachadaEquipos->getAllequipo();

		for($i=0;$i<$equipos->count();$i++){
			$Tmp = $equipos->offsetGet($i);
			echo'
				<div class="alcanceEquipoJ">
				';
				  $iterador = $Tmp->getIteratorJ();
				  while($iterador->valid()) {
					$TmpJ = $iterador->current();
						echo'
						
							<center>
							  <div id="box_jugador">
							
								<form class="Fila" action="Datos_J.php" method="post" >
									<input type="hidden" name="idjugador" value="'.$TmpJ->getId().'">
									<input class="imagen" type="image" src="assets/images/Fotos_Jugadores/generica.jpg" />
									<div class="datos">
										<div>Nombre: '.$TmpJ->getnombres().' '.$TmpJ->getapellidos().'</div>
										<div>Numero: '.$TmpJ->getNumero().'</div>
										<div>Posicion: '.$TmpJ->getPosicion().'</div>
										<div>Precio: '.$TmpJ->getPrecio().'</div>
									</div>
							  </form>
							  </div>
							<center>
							';
					$iterador->next();
				  }
				  
			echo '</div>';
		}
		
echo '</div>';
include("static/sideBar.php");
include("static/footer.php");

?>
