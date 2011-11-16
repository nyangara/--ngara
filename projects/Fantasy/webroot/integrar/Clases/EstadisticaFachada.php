<?php

	class EstadisticaFachade{
		
		public function addEstadistica($Estadistica){
			$instancia = Database::getInstance();
			$link = $instancia->connect();
			
			$Est = $Estadistica->getArregloEstadisticas();
			$ins = $Estadistica->getOrdenInsert();
			
			$query = "INSERT INTO \"Fantasy\".\"".$Estadistica->getNombreTabla()."\" (".$ins[0].",".$ins[1].",".$ins[2].",".$ins[3].",".$ins[4].",".$ins[5].",".$ins[6].",".$ins[7].",".$ins[8].") VALUES ('".$Estadistica->getjugador()."','".$Est[0]."','".$Est[1]."','".$Est[2]."','".$Est[3]."','".$Est[4]."','".$Est[5]."','".$Est[6]."','".$Est[7]."')";
			
			$result  = $instancia->query($query);
			$instancia->disconnect($link);
		}
		
		public function getEstadistica($Jugador,$fecha){
			$instancia = Database::getInstance();
			$link = $instancia->connect();			
			
			if($Jugador->getPosicion()=='P')//Picher
				$query = "SELECT * FROM \"Fantasy\".\"Estadistica_Pitcheo\" WHERE jugador ='".$Jugador->getId()."' AND fecha = '".$fecha."'";
			else 
				$query = "SELECT * FROM \"Fantasy\".\"Estadistica_Bateo\" WHERE jugador ='".$Jugador->getId()."' AND fecha = '".$fecha."'";				
			
			$result  = $instancia->query($query);
			
			if($row = $instancia->fetch($result))
				if($Jugador->getPosicion()=='P')//Picher
					$res = new Estadistica_Pitcheo($row['el'],$row['cl'],$row['i'],$row['bb'],$row['k'],$row['jg'],$row['e'],$row['fecha'],$row['jugador']);
				else
					$res = new Estadistica_Bateo($row['ca'],$row['tb'],$row['ci'],$row['bb'],$row['br'],$row['k'],$row['e'],$row['fecha'],$row['jugador']);
			
			$instancia->disconnect($link);
			return $res;
		}
		
		public function updateEstadistica($Estadistica) {
		$instancia = Database::getInstance();
		$link = $instancia->connect();
		
		$Est = $Estadistica->getArregloEstadisticas();
		$ins = $Estadistica->getOrdenInsert();
		
		$query = "UPDATE \"Fantasy\".\"".$Estadistica->getNombreTabla()."\" SET  
					".$ins[2]."='".$Est[1]."', 
					".$ins[3]."='".$Est[2]."', 
					".$ins[4]." ='".$Est[3]."', 
					".$ins[5]."='".$Est[4]."', 
					".$ins[6]."='".$Est[5]."', 
					".$ins[7]."='".$Est[6]."', 
					".$ins[8]."='".$Est[7]."'
				  WHERE ".$ins[0]." = '".$Estadistica->getjugador()."'
				  AND   ".$ins[1]."     = '".$Est[0]."'";
		
		
		$result  = $instancia->query($query);
		
		$instancia->disconnect($link);
	  }
	  
	  public function deleteEstadistica($Estadistica) {
		$instancia = Database::getInstance();
		$link = $instancia->connect();
		
		$query = "DELETE from \"Fantasy\".\"".$Estadistica->getNombreTabla()."\" WHERE jugador='".$Estadistica->getjugador()."' AND fecha='".$Estadistica->getfecha()."'";
		
		$result  = $instancia->query($query);
		
		$instancia->disconnect($link);
	  }
		
	}
	
?>