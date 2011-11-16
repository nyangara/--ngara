<?php
	require_once("Jugador.php");
	require_once("Database.php");
	require_once("EstadisticaPicheo.php");
	require_once("EstadisticaBateo.php");
	
	
	class JugadorFachade{

		
	  public function listall(){
		$prueba = array();
		$instancia = Database::getInstance();
		$link = $instancia->connect();
	  
		$query = "SELECT * FROM \"Fantasy\".\"Jugador\"";
		$result  = $instancia->query($query);
		
		if (!$result) {
			echo "false\n" ;
		} else {
			$lengths = $instancia->num_rows($result);
			for($i=0;$i<$lengths;$i++){
				$row = $instancia->fetch($result);
				$prueba[$i] = new Jugador($row['nombres'],$row['apellidos'],$row['fecha_nacimiento'],$row['posicion'],$row['numero'],$row['precio'],$row['equipo'],$row['id']);
			}
		}
		$instancia->disconnect($link);
		
		return $prueba;
	  }
	  
	  
	  
	  public function getJugador($id) {
		$instancia = Database::getInstance();
		$link = $instancia->connect();
		
		$query = "SELECT * FROM \"Fantasy\".\"Jugador\" where id =".$id;
		
		$result  = $instancia->query($query);
		
		if (!$result) {
			echo "false\n" ;
		} else {
			$row = $instancia->fetch($result);
			$jug = new Jugador($row['nombres'],$row['apellidos'],$row['fecha_nacimiento'],$row['posicion'],$row['numero'],$row['precio'],$row['equipo'],$row['id']);
			  
			if($row['posicion']=='P')//pitcher
				$q = "SELECT * FROM \"Fantasy\".\"Estadistica_Pitcheo\" WHERE jugador =".$id;
			else//Bateador
				$q = "SELECT * FROM \"Fantasy\".\"Estadistica_Bateo\" WHERE jugador =".$id;
			
			$r = $instancia->query($q);
			
			
			while($f = $instancia->fetch($r))
				if($row['posicion']=='P')//pitcher
					$jug->insertE(new Estadistica_Pitcheo($f['el'],$f['cl'],$f['i'],$f['bb'],$f['k'],$f['jg'],$f['e'],$f['fecha'],$f['jugador']));
				else
					$jug->insertE(new Estadistica_Bateo($f['ca'],$f['tb'],$f['ci'],$f['bb'],$f['br'],$f['k'],$f['e'],$f['fecha'],$f['jugador']));
		}
		
		$instancia->disconnect($link);
		return $jug;
	  }
	  
	  public function getAVGEst($Jugador){
		
		$iterador = $Jugador->getIteratorE();
		
		$i=0;			
		
		
		
		$res[0]=0;
		$res[1]=0;
		$res[2]=0;
		$res[3]=0;
		$res[4]=0;
		$res[5]=0;
		$res[6]=0;
			
		while($iterador->valid()) {
			$Tmp = $iterador->current();
			$Estd = $Tmp-> getArregloEstadisticas();
			
			$res[0]+=$Estd[1];
			$res[1]+=$Estd[2];
			$res[2]+=$Estd[3];
			$res[3]+=$Estd[4];
			$res[4]+=$Estd[5];
			$res[5]+=$Estd[6];
			$res[6]+=$Estd[7];

			$i++;
			$iterador->next();
		}
		
		if($i>0){		
			$res[0]=$res[0]/$i;
			$res[1]=$res[1]/$i;
			$res[2]=$res[2]/$i;
			$res[3]=$res[3]/$i;
			$res[4]=$res[4]/$i;
			$res[5]=$res[5]/$i;
			$res[6]=$res[6]/$i;
		}
		
		return $res;
		
	  }
	  
	  public function addJugador(Jugador $Jugador){
		$instancia = Database::getInstance();
		$link = $instancia->connect();
		
		$query = "INSERT INTO \"Fantasy\".\"Jugador\" (nombres, apellidos, fecha_nacimiento, posicion, numero, precio, equipo) VALUES ('".$Jugador->getnombres()."','".$Jugador->getapellidos()."','".$Jugador->getfecha_nacimiento()."','".$Jugador->getPosicion()."','".$Jugador->getNumero()."','".$Jugador->getPrecio()."','".$Jugador->getequipo()."')";
		$result  = $instancia->query($query);
		
		$instancia->disconnect($link);
		
	  }
	  
	  public function updateJugador(Jugador $Jugador) {
		$instancia = Database::getInstance();
		$link = $instancia->connect();
		
		$query = "UPDATE \"Fantasy\".\"Jugador\" SET 
					nombres='".$Jugador->getnombres()."', 
					apellidos='".$Jugador->getapellidos()."', 
					fecha_nacimiento='".$Jugador->getfecha_nacimiento()."', 
					posicion ='".$Jugador->getPosicion()."', 
					numero='".$Jugador->getNumero()."', 
					precio='".$Jugador->getNumero()."',
					equipo='".$Jugador->getequipo()."'
				  WHERE id = '".$Jugador->getId()."'";
					
		$result  = $instancia->query($query);
		
		$instancia->disconnect($link);
	  }
	  
	  public function deleteJugador(Jugador $jug) {
		$instancia = Database::getInstance();
		$link = $instancia->connect();
		
		$query = 'DELETE from "Fantasy"."Jugador" WHERE id='.$jug->getId() ;
		
		$result  = $instancia->query($query);
		
		$instancia->disconnect($link);
	  }
	  
		public function getNombreEquipo(Jugador $Jug){
		
			$database = Database::getInstance();
			$link = $database->connect();	
		
			$query = 'SELECT nombre from "Fantasy"."Equipo" WHERE id = '.$Jug->getequipo();
			
			$result = $database->query($query);
			$row = $database->fetch($result);
			
			$database->disconnect($link);
			
			return $row['nombre'];
		}	  
	  
	}
?>