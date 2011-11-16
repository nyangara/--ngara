<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");
require_once("Clases/JugadorFachada.php");

$ID_Jugador = isset($_POST['idjugador'])?$_POST['idjugador']:-1;

$FachadaJ = new JugadorFachada();
$Jugador = $FachadaJ->getJugador($ID_Jugador);
$Est = $FachadaJ->getAVGEst($Jugador); //Estadisticas de Jugador

include("Static/head.php");
include("Static/header.php");

?>

<link rel="stylesheet" href="assets/styles/style_Datos_J.css"  type="text/css" />

<?php

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
        </ul>
  </div>

	   
	<div id="content">
		<div id="contenido_interno_datos">';

echo'

	<div id="box_info">
		
		
		<form id="Alcance">
			<div id="Foto">
				<img src="assets/images/Fotos_Jugadores/generica.jpg" />
			</div>
			<div id="InfBas">
			
				<div>
					<label for="nombreEquipo">Nombre Del Equipo: </label>
					<input size="10" type="text" name="nombreEquipo" id="nombreEquipo" value="'.$FachadaJ->getNombreEquipo($Jugador).'"  readonly/>
				</div>
		
				<div>
					<label for="nombre">Nombre</label>
					<input size="10" type="text" name="nombre" id="nombre" value="'.$Jugador->getnombres().'"  readonly/>
					<label for="apellido">Apellido</label>
					<input size="10" type="text" name="apellido" id="apellido" value="'.$Jugador->getapellidos().'"  readonly/>
				</div>
			
				<div>
					<label for="numero">Numero</label>
					<input size="10" type="text" name="numero" id="numero" value="'.$Jugador->getNumero().'"  readonly/>
					<label for="precio">Precio</label>
					<input size="10" type="text" name="precio" id="precio" value="'.$Jugador->getPrecio().'"  readonly/>
				</div>
			
				<div>
				
					<label for="posicion">Posicion</label>
					<input size="10" type="text" name="posicion" id="posicion" value="'.$Jugador->getPosicion().'"  readonly/>
			
				</div>
			
				<label style="display:block; text-align:center" >Fecha de nacimiento:</label>
				<div> 
				
					<input size="10" type="text" name="fecha_nac" id="fecha_nac" value="'.$Jugador->getfecha_nacimiento().'"  readonly/>
				
				</div>                      
						  
			</div>
		
				<div id="InfExt">
		
			';
		
			if($Jugador->getPosicion()=='P')
			{
			echo'
				<div id="ExpL" >		
			
				<div>
					<label for="el">Entradas Lanzadas</label>
					<input size="8" type="text" name="el" id="el" value="'.$Est[0].'" readonly/>		
					<label for="cl">Carreras Limpias</label>
					<input size="8" type="text" name="cl" id="cl" value="'.$Est[1].'" readonly/>
				</div>

				<div>
					<label for="i">Imparables</label>
					<input size="8" type="text" name="i" id="i" value="'.$Est[2].'" readonly/>		
					<label for="bb">Bases por Bola</label>
					<input size="8" type="text" name="bb" id="bb" value="'.$Est[3].'" readonly/>
				</div>

				<div>
					<label for="k">Ponches</label>
					<input size="8" type="text" name="k" id="k" value="'.$Est[4].'" readonly/>		
					<label for="jg">Juegos Ganados</label>
					<input size="8" type="text" name="jg" id="jg" value="'.$Est[5].'" readonly/>
					<label for="e">Errores</label>
					<input size="8" type="text" name="e" id="e" value="'.$Est[6].'" readonly/>						
				</div>
					
			</div>';
			
		} else
		{
		echo '
			<div id="ExpB">

				<div>
					<label for="ca">Carreras Anotadas</label>
					<input size="8" type="text" name="ca" id="ca" value="'.$Est[0].'" readonly/>		
					<label for="tb">Total de Bases</label>
					<input size="8" type="text" name="tb" id="tb" value="'.$Est[1].'" readonly/>
				</div>	

				<div>
					<label for="ci">Carreras Impulsadas</label>
					<input size="8" type="text" name="ci" id="ci" value="'.$Est[2].'" readonly/>
					<label for="bb">Bases por Bolas</label>
					<input size="8" type="text" name="bb" id="bb" value="'.$Est[3].'" readonly/>
				</div>

					<div>
						<label for="br">Bases Robadas</label>
						<input size="8" type="text" name="br" id="br" value="'.$Est[4].'" readonly/>
						<label for="k">Ponches</label>
						<input size="8" type="text" name="k" id="k" value="'.$Est[5].'" readonly/>
						<label for="e">Errores</label>
						<input size="8" type="text" name="e" id="e" value="'.$Est[6].'" readonly/>
					</div>	
				</div>
			
			
			';
		}
		echo '
		</div>
	</form>	
		<div id="env" >
		
			<form action="gestion_jugadores.php">
				<input type="submit" value="Regresar"/>
			</form>

			<form action="Listar_D_J.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Jugador->getId().'" />
				<input type="submit" name="Detalles" value="Ver Detalles"  />
				
			</form>

			<form action="Modificar_J.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Jugador->getId().'" />
				<input type="submit" name="Modificar" value="Modificar"  />      
			</form>			
		
			<form action="Modificar_J.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Jugador->getId().'" />
				<input type="submit" name="Eliminar" value="Eliminar"  />      
			</form>			
		 
		</div>
	</div>';

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");	

?>
