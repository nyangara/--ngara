<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachade.php");
require_once("Clases/JugadorFachade.php");

$FachadaE = new EquipoFachade();

// En caso de que se valla a agregar
if(isset($_POST['Aplicar'])){
	

	$FachadaJ = new JugadorFachade();
	
	$fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
	
	$Jugador = new Jugador($_POST['nombre'],$_POST['apellido'],$fecha,$_POST['posicion'],$_POST['numero'],$_POST['precio'],$FachadaE->getidEquipo($_POST['nombreEquipo']));
	
	$FachadaJ->addJugador($Jugador);
	
	header('Location: gestion_jugadores.php'); 
}


?>

<?php

include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Agregar_J.css"  type="text/css" />';

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

		
echo'

<div id="box_info">


	<form id="Alcance" action="Agregar_J.php" method="post">
		<div id="Foto">
			<img src="assets/images/Fotos_Jugadores/generica.jpg"/>
		</div>
		<div id="InfBas">
		
			<div>
				<label for="nombreEquipo">Nombre Del Equipo: </label>
				<select name="nombreEquipo"> ';
					$NE = $FachadaE->getTagsEquipo(); //Nombres Equipos
					$N = count($NE);
					for ($i = 0 ; $i<$N ; $i++)
						echo "<option value=".$NE[$i].">".$NE[$i]."</option>";
				echo'
				</select>
				
			</div>
		
		    <div>
				<label for="nombre">Nombre</label>
				<input size="10" type="text" name="nombre" id="nombre" value="" />
				<label for="apellido">Apellido</label>
				<input size="10" type="text" name="apellido" id="apellido" value=""  />
			</div>
			
			<div>
				<label for="numero">Numero</label>
				<input size="10" type="text" name="numero" id="numero" value=""  />
				<label for="precio">Precio</label>
				<input size="10" type="text" name="precio" id="precio" value=""  />
			</div>
			
			<div>
				<label for="posicion">Posicion</label>
				<input size="10" type="text" name="posicion" id="posicion" value=""  />
			</div>
	
			<label style="display:block; text-align:center" >Fecha de nacimiento:</label>
			<div > 
            
				<label for="dia">D&iacutea: </label>
					<select name="dia">';
						for ($i = 1 ; $i<=31 ; $i++)
							echo "<option value=".$i.">".$i."</option>";
				
				echo '
					</select>
			
				<label for="mes">Mes: </label>
				<select name="mes">
				';
		
					$mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Julio", "Junio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre");
					
					for ($i = 0 ; $i < 12 ; $i++)
						echo "<option value=".$i.">".$mes[$i]."</option>";
			
				echo '
				</select>
		
				<label for="anio">A&ntildeo: </label>
		
				<select name="anio">
				';
			           
					for ($i = 1960 ; $i<=date('Y') ; $i++)
						echo "<option value=".$i.">".$i."</option>";
				
				
				echo '
				</select>
			</div>                        
			
		</div>
		<input type="submit" name="Aplicar" value="Aplicar"  />
	</form>
	
	</div>';

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");	

?>