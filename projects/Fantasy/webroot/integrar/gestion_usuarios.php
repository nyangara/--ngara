<?php

require_once("Clases/fachadaInterface.php");

$instancia = fachadaInterface::singleton();
$_POST['TIPO']='Usuario';
$Usuarios = $instancia->obtenerTodos();

include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_gestionar_estadios.css"  type="text/css" />'; 

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="gestion_rosters.php">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
		  <li class="on"><a href="gestion_usuarios.php">Usuarios</a></li>
        </ul>
  </div>

	   
	<div id="content">
		<div id="contenido_interno">';
		
		echo '<h2> Usuarios</h2>';

		for($i=0;$i<count($Usuarios);$i++){
			$_POST['TIPO']='Perfil_Usuario';
			$_POST['usuario']=$Usuarios[$i]->id;
			$P_Usuario = $instancia->obtener();
			echo'
				<div class="alcanceEstadio">
					<form class="Fila" action="Datos_Usr.php" method="post" >
						<input type="hidden" name="idusuario" value="'.$Usuarios[$i]->id.'"/>
						<div class="datos">
							<div>Usuario: '.$Usuarios[$i]->username.'</div>
							<div>Email: '.$P_Usuario->email.'</div>
							<input type="submit" value="Modificar"/>						
						</div>
					</form>
				</div>';
		}	
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>
