<?php

	error_reporting( E_ALL );
		include "config.php";
/*
		class fachadaBD {
		var $con;
		
		function __construct (){
			   $this->con = NULL;		
		}

		public function connect() {
			$this->con = mysql_connect("localhost", "gcm", "zeonpepe") or die(mysql_error());
			mysql_select_db("mlb", $this->con) or die(mysql_error("Error de Conexión"));
		}
			
		public function kill(){
			mysql_close($this->con);
		}
		
		public function alter($query){
			$exe = mysql_query($query, $this->con) or die(mysql_error().' Falle haciendo '.$query);
		}
		
		public function query($query){
			$exe = mysql_query($query, $this->con) or die(mysql_error().' Falle haciendo '.$query);			
			return $exe;
		}		
	}

	
//	class ingresar{
	
//		function ingresarjugador(){
	

	if($_POST['id'] == null){
		//insertarjugador->ingresarjugador();
		$_POST['id'] = "troll";
		
	} else {
		$_POST['id'] = "distinto a null";
		//$this->ingresarjugador();
	}
	echo $_POST['id'];		
*/
//	echo "consulto";
	$Nombre = trim($_POST['nombre']);
	$Apellido = trim($_POST['apellido']);
	$Numero = trim($_POST['numero']);
	$Tipo = trim($_POST['tipo']);
	$Posicion = trim($_POST['posicion']);
	$Fecha = trim($_POST['fecha']);
	$Lugar = trim($_POST['lugar']);
	$Peso = trim($_POST['peso']);
	$Altura = trim($_POST['altura']);
	$Equipo = trim($_POST['equipo']);

        $consulta=$bd->prepare('INSERT into jugador ("Id_jugador","Nombre_jugador","Apellido_jugador","Nro_jugador","Tipo_jugador","Posición_jugador","Fecha_nacimiento","lugar_nacimiento","peso" ,"altura","equipo_id") VALUES (:Nombre, :Apellido, :Numero, :Tipo, :Posicion,:Fecha,:Lugar,:Peso,:Altura,:Equipo)');


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

	$consulta->execute();

	
//		}
		
		
//	}

	header( 'Location: insertar.html');
?>
