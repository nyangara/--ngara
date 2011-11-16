<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");
require_once("Clases/JugadorFachada.php");

$ID_Jugador = isset($_POST['idjugador'])?$_POST['idjugador']:-1;

$FachadaJ = new JugadorFachada();
$Jugador = $FachadaJ->getJugador($ID_Jugador);
$FachadaE = new EquipoFachada();

// En caso de que modifique

if(isset($_POST['Aplicar'])){
	

	$fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
	
	$Jugador->setequipo($FachadaE->getidEquipo($_POST['nombreEquipo']));
	$Jugador->setnombres($_POST['nombre']);
	$Jugador->setapellidos($_POST['apellido']);
	$Jugador->setNumero($_POST['numero']);
	$Jugador->setPosicion($_POST['posicion']);
	$Jugador->setfecha_nacimiento($fecha);
	$Jugador->setPrecio($_POST['precio']);
	
	$FachadaJ->updateJugador($Jugador);
	
	header('Location: gestion_jugadores.php'); 
	
}

//En caso de que se elimine
if(isset($_POST['Eliminar'])){
	$FachadaJ->deleteJugador($Jugador);
	header('Location: gestion_jugadores.php'); 
}

?>

<?php

include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Modificar_J.css"  type="text/css" />';

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

echo'<div id="box_info">
	<form id="Alcance" action="Modificar_J.php" method="post">
		<div id="Foto">
			<img src="assets/images/Fotos_Jugadores/generica.jpg" />
		</div>
		<div id="InfBas">
		
		
						
			<div>
				<label for="nombreEquipo">Nombre Del Equipo: </label>
				<select name="nombreEquipo"> ';
					$NE = $FachadaE->getTagsEquipo(); //Nombres Equipos
					$N = count($NE);
					$EA = $FachadaJ->getNombreEquipo($Jugador); //Equipo Actual
					for ($i = 0 ; $i<$N ; $i++)
						if( $EA == $NE[$i])
							echo "<option value=".$NE[$i]." selected>".$NE[$i]."</option>";
						else
							echo "<option value=".$NE[$i].">".$NE[$i]."</option>";
				echo'
				</select>
				
			</div>
		
		    <div>
				<label for="nombre">Nombre</label>
				<input size="10" type="text" name="nombre" id="nombre" value="'.$Jugador->getnombres().'" />
				<label for="apellido">Apellido</label>
				<input size="10" type="text" name="apellido" id="apellido" value="'.$Jugador->getapellidos().'"  />
			</div>
			
			<div>
				<label for="numero">Numero</label>
				<input size="10" type="text" name="numero" id="numero" value="'.$Jugador->getNumero().'"  />
				<label for="posicion">Posicion</label>
				<input size="10" type="text" name="posicion" id="posicion" value="'.$Jugador->getPosicion().'"  />
			</div>

			
			<label style="display:block; text-align:center" >Fecha de nacimiento:</label>
			<div > 
            
				<label for="dia">Día: </label>
					<select name="dia">';
						
						$fecha = $Jugador->getfecha_nacimiento();
						$Aux = explode("-", $fecha); //Separa la fecha en Año, Mes  y dia
						
						for ($i = 1 ; $i<=31 ; $i++)
							if($Aux[2]==$i)
								echo "<option value=".$i." selected>".$i."</option>";
							else
								echo "<option value=".$i.">".$i."</option>";
				echo '
					</select>
			
				<label for="mes">Mes: </label>
				<select name="mes">
				';
		
					$mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Julio", "Junio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre");
					
					for ($i = 0 ; $i < 12 ; $i++)
						if($Aux[1]==$i)
							echo "<option value=".$i." selected>".$mes[$i]."</option>";
						else
							echo "<option value=".$i.">".$mes[$i]."</option>";
			
				echo '
				</select>
		
				<label for="anio">Año: </label>
		
				<select name="anio">
				';
			           
					for ($i = 1960 ; $i<=date('Y') ; $i++)
						if($Aux[0]==$i)
							echo "<option value=".$i." selected>".$i."</option>";
						else
							echo "<option value=".$i.">".$i."</option>";
				
				
				echo '
				</select>
			</div>                   
			
		</div>
		
		<div id="env" >
		
			<input type="hidden" name="idjugador" id="idjugador" value="'.$Jugador->getId().'" />
			<input type="submit" name="Aplicar" value="Aplicar"  />
		 
		</div>
	</form></div>';

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");	

?>
