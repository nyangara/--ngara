<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");
require_once("Clases/JugadorFachada.php");

require_once("Clases/EstadisticaBateo.php");
require_once("Clases/EstadisticaPicheo.php");
require_once("Clases/EstadisticaFachada.php");


$ID_Jugador = isset($_POST['idjugador'])?$_POST['idjugador']:-1;
$Fecha = isset($_POST['fecha'])?$_POST['fecha']:-1;

$FachadaJ = new JugadorFachada();
$Jugador = $FachadaJ->getJugador($ID_Jugador);
$FachadaE = new EstadisticaFachada();
$Estadistica=$FachadaE->getEstadistica($Jugador,$Fecha);

$est = $Estadistica->getArregloEstadisticas(); // de Fecha hasta el ultimo
$des = $Estadistica->getArregloDescriptor();   // desde Fecha hasta el ultimo
$var = $Estadistica->getOrdenInsert();         // desde ID hasta el Ultimo

// En caso de que se valla a agregar
if(isset($_POST['Aplicar'])){
	
	$Estadistica->ReFill($_POST[$var[2]],$_POST[$var[3]],$_POST[$var[4]],$_POST[$var[5]],$_POST[$var[6]],$_POST[$var[7]],$_POST[$var[8]]);
	
	$FachadaE->updateEstadistica($Estadistica);
	
	header('Location: gestion_jugadores.php'); 

}

if(isset($_POST['Eliminar'])){
	
	$FachadaE->deleteEstadistica($Estadistica);
	header('Location: gestion_jugadores.php'); 
}

?>

<?php

include("static/head.php");
include("static/header.php");



echo '<link rel="stylesheet" href="assets/styles/style_Listar_D_J.css"  type="text/css" />'; 

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
		<div id="contenido_interno">';

		echo '
		
			<div id="box_info">
		
			<form  action="Modificar_E.php" method="post">
				<input type="hidden" name="idjugador" value="'.$ID_Jugador.'"/>
				<input type="hidden" name="fecha" value="'.$Fecha.'"/>	
					
				<label for="'.$var[2].'">'.$des[1].'</label>
				<input size="10" type="text" name="'.$var[2].'" value="'.$est[1].'" />
				
				<label for="'.$var[3].'">'.$des[2].'</label>
				<input size="10" type="text" name="'.$var[3].'" value="'.$est[2].'" />

				<label for="'.$var[4].'">'.$des[3].'</label>
				<input size="10" type="text" name="'.$var[4].'" value="'.$est[3].'" />

				<label for="'.$var[5].'">'.$des[4].'</label>
				<input size="10" type="text" name="'.$var[5].'" value="'.$est[4].'" />

				<label for="'.$var[6].'">'.$des[5].'</label>
				<input size="10" type="text" name="'.$var[6].'" value="'.$est[5].'" />

				<label for="'.$var[7].'">'.$des[6].'</label>
				<input size="10" type="text" name="'.$var[7].'" value="'.$est[6].'" />

				<label for="'.$var[8].'">'.$des[7].'</label>
				<input size="10" type="text" name="'.$var[8].'" value="'.$est[7].'" />

		        <input type="submit" name="Aplicar" value="Agregar A Estadistica" />
		      </form>
			  
			  </div>';
		
	echo '</div>';
		
		
include("static/sideBar.php");
include("static/footer.php");

?>
