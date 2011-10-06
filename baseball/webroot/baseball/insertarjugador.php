<?
include'config.php';
		$Nombre = trim($_POST['nombre']);
		$Apellido =        trim($_POST['apellido']);
		$Numero = trim($_POST['numero']);
		$Tipo = trim($_POST['tipo']);
		$Posicion = trim($_POST['posicion']);
		$Fecha = trim($_POST['fecha']);
		$Lugar =        trim($_POST['lugar']);
		$Peso = trim($_POST['peso']);
		$Altura = trim($_POST['altura']);
		$Equipo = trim($_POST['equipo']);

        $consulta=$Baseball->exec('INSERT into jugador ("Id_jugador","Nombre_jugador","Apellido_jugador","Nro_jugador","Tipo_jugador","Posición_jugador","Fecha_nacimiento","lugar_nacimiento","peso" ,"altura","equipo_id") VALUES (:Nombre, :Apellido, :Numero, :Tipo, :Posicion,:Fecha,:Lugar,:Peso,:Altura,:Equipo)');

	

        $consulta->bindParam(':Nombre', $Nombre, PDO::PARAM_STR, strlen($Nombre));
        $consulta->bindParam(':Apellido', $Apellido, PDO::PARAM_STR, strlen($Apellido));
        $consulta->bindParam(':Numero', $Numero, PDO::PARAM_STR, strlen($Numero));
        $consulta->bindParam(':Tipo', $Tipo, PDO::PARAM_STR, strlen($Tipo));
        $consulta->bindParam(':Posicion', $Posicion, PDO::PARAM_STR, strlen($Posicion));
   	$consulta->bindParam(':Fecha', $Fecha, PDO::PARAM_STR, strlen($Fecha));
        $consulta->bindParam(':Lugar', $Lugar, PDO::PARAM_STR, strlen($Lugar));
        $consulta->bindParam(':Peso', $Peso, PDO::PARAM_STR, strlen($Peso));
        $consulta->bindParam(':Altura', $Altura, PDO::PARAM_STR, strlen($Altura));
	$consulta->bindParam(':Equipo', $Equipo, PDO::PARAM_STR, strlen($Equipo));


?>
