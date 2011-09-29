<?include 'config.php';
session_start();

/*Utilice lo del PDO que se supone que está en lo de config.php y supondre que lo viene por post tiene el mismo nombre que las cositas de la base de datos.
Solo hay que asegurarse que sea asi en el formulario.
*/
// Agregar jugador

$Nombre = trim($_POST['Nombre']);
$Apellido =	trim($_POST['Apellido']);
$Nro_uniforme = trim($_POST['Nro_uniforme']);
$ID_jugador = trim($_POST['ID_jugador']);
$nombre_equipo = trim($_POST['nombre_equipo']);


	$consulta=$baseball->prepare("INSERT into jugador (Nombre, Apellido, Nro_uniforme, ID_jugador, nombre_equipo) VALUES (:Nombre, :Apellido, :Nro_uniforme, :ID_jugador, :nombre_equipo)");

	$consulta->bindParam(':Nombre', $Nombre, PDO::PARAM_STR, strlen($Nombre));
	$consulta->bindParam(':Apellido', $Apellido, PDO::PARAM_STR, strlen($Apellido));
	$consulta->bindParam(':Nro_uniforme', $Nro_uniforme, PDO::PARAM_STR, strlen($Nro_uniforme));
	$consulta->bindParam(':ID_jugador', $ID_jugador, PDO::PARAM_STR, strlen($ID_jugador));
	$consulta->bindParam(':nombre_equipo', $nombre_equipo, PDO::PARAM_STR, strlen($nombre_equipo));

//Agregar Equipo

$Nombre_equipo = trim($_POST['Nombre_equipo']);
$cantidad_jugadores = trim($_POST['cantidad_jugadores']);


$consulta=$baseball->prepare("INSERT into equipo (Nombre_equipo, cantidad_jugadores) VALUES (:Nombre_equipo, :cantidad_jugadores)");

	$consulta->bindParam(':Nombre_equipo', $Nombre_equipo, PDO::PARAM_STR, strlen($Nombre_equipo));
	$consulta->bindParam(':cantidad_jugadores', $cantidad_jugadores, PDO::PARAM_STR, strlen($cantidad_jugadores));
	
	
//Agregar Estadio

$Capacidad = trim($_POST['Capacidad']);
$Nombre_estadio =	trim($_POST['Nombre_estadio']);
$Ciudad = trim($_POST['Ciudad']);

$consulta=$baseball->prepare("INSERT into estadio (Capacidad, Nombre_estadio, Ciudad) VALUES (:Capacidad, :Nombre_estadio, :Ciudad)");

	$consulta->bindParam(':Capacidad', $Capacidad, PDO::PARAM_STR, strlen($Capacidad));
	$consulta->bindParam(':Nombre_estadio', $Nombre_estadio, PDO::PARAM_STR, strlen($Nombre_estadio));
	$consulta->bindParam(':Ciudad', $Ciudad, PDO::PARAM_STR, strlen($Ciudad));

//Agregar Juego

$fecha = trim($_POST['fecha']);
$Nombre_equipo1 =	trim($_POST['Nombre_equipo1']);
$Nombre_equipo2 = trim($_POST['Nombre_equipo2']);
$Nombre_estadio = trim($_POST['Nombre_estadio']);

$consulta=$baseball->prepare("INSERT into juega (fecha, Nombre_equipo1, Nombre_equipo2, Nombre_estadio) VALUES (:fecha, :Nombre_equipo1, :Nombre_equipo2, :Nombre_estadio)");

	$consulta->bindParam(':fecha', $fecha, PDO::PARAM_STR, strlen($fecha));
	$consulta->bindParam(':Nombre_equipo1', $Nombre_equipo1, PDO::PARAM_STR, strlen($Nombre_equipo1));
	$consulta->bindParam(':Nombre_equipo2', $Nombre_equipo2, PDO::PARAM_STR, strlen($Nombre_equipo2));
	$consulta->bindParam(':Nombre_estadio', $Nombre_estadio, PDO::PARAM_STR, strlen($Nombre_estadio));
	
/*Consultas. Solo las que me parecen más utiles
 Jugadores dado el equipo
*/	

	$consulta=$baseball->prepare("SELECT * FROM jugador WHERE nombre_equipo = ".$nombre_equipo."");
	$consulta->execute();	
	$usuarios = $consulta->fetch();
	
// Juegos para una fecha dada

	$consulta=$baseball->prepare("SELECT * FROM juega WHERE fecha = ".$fecha."");
	$consulta->execute();	
	$usuarios = $consulta->fetch();

//Juegos donde juegue un equipo dado

	$consulta=$baseball->prepare("SELECT * FROM juega WHERE Nombre_equipo1 = ".$equipo." OR Nombre_equipo2 = ".$equipo."");
	$consulta->execute();	
	$usuarios = $consulta->fetch();

// Juegos en un estadio

	$consulta=$baseball->prepare("SELECT * FROM juega WHERE Nombre_estadio = ".$Nombre_estadio." ");
	$consulta->execute();	
	$usuarios = $consulta->fetch();

//Información del jugador dado el nombre y dado el apellido

	$consulta=$baseball->prepare("SELECT * FROM jugador WHERE Nombre = ".$Nombre." ");
	$consulta->execute();	
	$usuarios = $consulta->fetch();

	$consulta=$baseball->prepare("SELECT * FROM jugador WHERE Apellido = ".$Apellido." ");
	$consulta->execute();	
	$usuarios = $consulta->fetch();
	
//Estadios dada la ciudad

	$consulta=$baseball->prepare("SELECT Nombre_estadio FROM estadio WHERE Ciudad = ".$Ciudad." ");
	$consulta->execute();	
	$usuarios = $consulta->fetch();
	
/*Actualizaciones de todas las tablas. Suponiendo que los formularios de cada tabla esten prellenos para traerse todo con el post.
Todos los $_POST estan arriba solo agarras los que necesites por cada update :D.
 Update jugador 
*/
		
$consulta=$baseball->exec("UPDATE jugador SET Nombre='$Nombre', Apellido='$Apellido', Nro_uniforme='$Nro_uniforme', ID_jugador='$ID_jugador', nombre_equipo='$nombre_equipo' ");

if ($consulta>0) { 
	?>	
	<script>
		alert('La información del jugador fue modificada exitosamente.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del jugador no fue modificada.');		
	</script>
	
	<? } ;

	
// Update equipo
	
$consulta=$baseball->exec("UPDATE equipo SET Nombre_equipo='$Nombre_equipo', cantidad_jugadores='$cantidad_jugadores' ");


if ($consulta>0) { 
	?>	
	<script>
		alert(' La información del equipo fue modificada exitosamente.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del jugador no fue modificada.');		
	</script>
	
	<? } ;

//Update estadio

$consulta=$baseball->exec("UPDATE estadio SET Capacidad='$Capacidad', Nombre_estadio='$Nombre_estadio',Ciudad='$Ciudad' ");


if ($consulta>0) { 
	?>	
	<script>
		alert(' La información del estadio fue modificada exitosamente.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del estadio no fue modificada.');		
	</script>
	
	<? } ;	

//Update juega	

$consulta=$baseball->exec("UPDATE juega SET fecha='$fecha', Nombre_equipo1='$Nombre_equipo1', Nombre_equipo2='$Nombre_equipo2' Nombre_estadio='$Nombre_estadio' ");

if ($consulta>0) { 
	?>	
	<script>
		alert(' La información del juego fue modificada.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del juego no fue modificada.');		
	</script>
	
	<? } ;		
 

/*Eliminar de todas las tablas. 
 Delete jugador 
*/ 

	$count = $bd->exec("DELETE FROM jugador WHERE id = ".$id."");

	if ($count>0) { 
	?>	
	<script>
		alert('La información del jugador fue eliminada.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del jugador no pudo ser eliminada.');	
	</script>
	
	<? } ;
		
//Delete equipo

	$count = $bd->exec("DELETE FROM equipo WHERE id = ".$id."");

	if ($count>0) { 
	?>	
	<script>
		alert('La información del equipo fue eliminada.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del equipo no pudo ser eliminada.');		
	</script>
	
	<? } ;

//Delete estadio
	
	$count = $bd->exec("DELETE FROM estadio WHERE id = ".$id."");

	if ($count>0) { 
	?>	
	<script>
		alert('La información del estadio fue eliminada.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del estadio no pudo ser eliminada.');		
	</script>
	
	<? } ;
	
//Delete juego	 
	
	$count = $bd->exec("DELETE FROM juega WHERE id = ".$id."");

	if ($count>0) { 
	?>	
	<script>
		alert('La información del juego fue eliminada.');		
	</script>
	
	<? } else {?>	
	<script>
		alert('La información del juego no pudo ser eliminada.');		
	</script>
	
	<? } ;
	
?>	
