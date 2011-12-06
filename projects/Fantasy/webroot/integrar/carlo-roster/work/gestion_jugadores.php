<?php

require_once("Clases/fachadaInterface.php");

$instancia = fachadaInterface::singleton();
$_POST['TIPO']='Jugador';
$Jugadores = $instancia->obtenerTodos();

foreach($Jugadores as $jugador){
    $_POST['TIPO']='Equipo';
    $_POST['id']=$jugador->equipo;
    $Equipo = $instancia->obtener();
    $Aux[$jugador->id] = '<img src="'.$Equipo->logo.'"/>' ; 
}
include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Ljugadores.css"  type="text/css" />'; 
?>
<?php if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="#">Mi Perfil</a></li>
        <li><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
    </ul>
<?php } elseif(isset($_SESSION['Administrador'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
		<li><a href="gestion_usuarios.php">Usuarios</a></li>
	</ul>
<?php } else { 
		echo '<ul id="navigation">
		<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        </ul>';
	}
echo '</div>

	   
	<div id="content">
		<div id="contenido_interno_jugadores">';
		
		echo '<form id="form" action="Agregar_J.php" method="post">
		        <input type="submit" value="Agregar Jugador">
		      </form>';
		
		echo '<h2>Jugadores</h2>';

		for($i=0;$i<count($Jugadores);$i++){
			$Tmp = $Jugadores[$i];
			echo'
				<div class="alcanceEquipoJ">
					<center>
					  <div id="box_jugador">
					
						<form class="Fila" action="Datos_J.php" method="post" >
							<input type="hidden" name="id" value="'.$Tmp->id.'">
							<input class="imagen" type="image" src="'.$Tmp->foto.'" />
							<div class="datos">
								<div>Nombre: '.$Tmp->nombres.' </div>
								<div>Posicion: '.$Tmp->posicion.'</div>
								<div>Precio: '.$Tmp->precio.'</div>
								<div id="imagen_equipo"> '.$Aux[$Tmp->id].' </div>
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
