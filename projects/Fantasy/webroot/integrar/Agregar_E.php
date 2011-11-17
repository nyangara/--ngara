<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");
require_once("Clases/JugadorFachada.php");

require_once("Clases/EstadisticaBateo.php");
require_once("Clases/EstadisticaPicheo.php");
require_once("Clases/EstadisticaFachada.php");


$ID_Jugador = isset($_POST['idjugador'])?$_POST['idjugador']:-1;
$FachadaJ = new JugadorFachada();
$Jugador = $FachadaJ->getJugador($ID_Jugador);

// En caso de que se valla a agregar
if(isset($_POST['Aplicar'])){

	$fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
	
	if($Jugador->getPosicion()<>'P')
		$Estadistica = new Estadistica_Bateo($_POST['ca'],$_POST['tb'],$_POST['ci'],$_POST['bb'],$_POST['br'],$_POST['k'],$_POST['e'],$fecha,$ID_Jugador);
	else
		$Estadistica = new Estadistica_Pitcheo($_POST['el'],$_POST['cl'],$_POST['i'],$_POST['bb'],$_POST['k'],$_POST['jg'],$_POST['e'],$fecha,$ID_Jugador);
	
	$FachadaE = new EstadisticaFachada();
	
	$FachadaE->addEstadistica($Estadistica);
	
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
		
		if($Jugador->getPosicion()<>'P'){ //bateador
		
		echo '
		
			<div id="box_info">
			
			<form  action="Agregar_E.php" method="post">
				<input type="hidden" name="idjugador" value="'.$ID_Jugador.'"/>

				<label for="fecha">Fecha del Juego </label>

				<div id="fecha" > 

					<label for="dia">D&iacutea: </label>
					<select name="dia">';
						for ($i = 1 ; $i<=31 ; $i++)
							echo "<option value=".$i.">".$i."</option>";
					
				echo'
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
				
	
				<label for="ca">Carreras Anotadas</label>
				<input size="10" type="text" name="ca" value="" />
				
				<label for="tb">Total de Bases</label>
				<input size="10" type="text" name="tb" value="" />

				<label for="ci">Carreras impulsadas</label>
				<input size="10" type="text" name="ci" value="" />

				<label for="bb">Bases por Bola</label>
				<input size="10" type="text" name="bb" value="" />

				<label for="br">Bases Robadas</label>
				<input size="10" type="text" name="br" value="" />

				<label for="k">Ponches</label>
				<input size="10" type="text" name="k" value="" />

				<label for="e">Errores</label>
				<input size="10" type="text" name="e" value="" />

		        <input type="submit" name="Aplicar" value="Agregar A Estadistica" />
		      </form>
			  
			</div>';
		
		}
		else{ //picheo
		
		echo '
		
		
			<div id="box_info">
		
				<form  action="Agregar_E.php" method="post">
				<input type="hidden" name="idjugador" value="'.$ID_Jugador.'"/>

				<label for="fecha">Fecha del Juego </label>

				<div id="fecha" > 

					<label for="dia">D&iacutea: </label>
					<select name="dia">';
						for ($i = 1 ; $i<=31 ; $i++)
							echo "<option value=".$i.">".$i."</option>";
					
				echo'
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
	
				<label for="el">Entradas Lanzadas</label>
				<input size="10" type="text" name="el" value="" />
				
				<label for="cl">Carreras Limpias</label>
				<input size="10" type="text" name="cl" value="" />

				<label for="i">Imparables</label>
				<input size="10" type="text" name="i" value="" />

				<label for="bb">Bases por Bola</label>
				<input size="10" type="text" name="bb" value="" />

				<label for="k">Ponches</label>
				<input size="10" type="text" name="k" value="" />

				<label for="jg">Juegos Ganados</label>
				<input size="10" type="text" name="jg" value="" />

				<label for="e">Errores</label>
				<input size="10" type="text" name="e" value="" />

		        <input type="submit" name="Aplicar" value="Agregar A Estadistica" />
		      </form>
			  
			</div>';
		
		}
		
		
		
echo '</div>';
include("static/sideBar.php");
include("static/footer.php");

?>
