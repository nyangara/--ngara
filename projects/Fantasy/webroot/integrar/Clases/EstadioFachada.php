<?php
	require_once("Estadio.php");
	require_once("Database.php");
	
	class EstadioFachade {
	
		public function addEstadio(Estadio $Estadio){
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$query = "INSERT INTO \"Fantasy\".\"Estadio\" (nombre,ubicacion,propietario,medida_left_field,medida_center_field,medida_right_field,tipo_terreno,fecha_fundacion) 
					  VALUES ('".$Estadio->getnombre()."','".$Estadio->getubicacion()."','".$Estadio->getpropietario()."'
					  ,'".$Estadio->getmedida_left_field()."','".$Estadio->getmedida_center_field()."'
					  ,'".$Estadio->getmedida_right_field()."','".$Estadio->gettipo_terreno()."'
					  ,'".$Estadio->getfecha_fundacion()."')";
			$result  = $instancia->query($query);

			$instancia->disconnect($link);

		}

		public function updateEstadio(Estadio $Estadio) {
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$query = "UPDATE \"Fantasy\".\"Estadio\" SET 
						nombre='".$Estadio->getnombre()."', 
						ubicacion='".$Estadio->getubicacion()."', 
						propietario='".$Estadio->getpropietario()."', 
						medida_left_field ='".$Estadio->getmedida_left_field()."', 
						medida_center_field='".$Estadio->getmedida_center_field()."', 
						medida_right_field='".$Estadio->getmedida_right_field()."',
						tipo_terreno='".$Estadio->gettipo_terreno()."',
						fecha_fundacion='".$Estadio->getfecha_fundacion()."'
					  WHERE id = '".$Estadio->getId()."'";
						
			$result  = $instancia->query($query);

			$instancia->disconnect($link);
		}

		public function deleteEstadio(Estadio $Estadio) {
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$query = 'DELETE from "Fantasy"."Estadio" WHERE id='.$Estadio->getId() ;

			$result  = $instancia->query($query);

			$instancia->disconnect($link);
		}
		
		public function getEstadio($id){
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$query = "SELECT * FROM \"Fantasy\".\"Estadio\" WHERE id = '".$id."'";
			$result  = $instancia->query($query);
			$row = $instancia->fetch($result);
			
			$Estadio = new Estadio($row['nombre'],$row['ubicacion'],$row['propietario'],$row['medida_left_field'],$row['medida_center_field'],$row['medida_right_field'],$row['tipo_terreno'],$row['fecha_fundacion'],$row['id']);
			
			$instancia->disconnect($link);
			
			return $Estadio;
		}
		
		public function getNombre($id){
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$query = "SELECT nombre FROM \"Fantasy\".\"Estadio\" WHERE id = '".$id."'";
			$result  = $instancia->query($query);
			$row = $instancia->fetch($result);
			
			$instancia->disconnect($link);
			
			return $row['nombre'];
		}
		
		public function getID($nombre){
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$query = "SELECT id FROM \"Fantasy\".\"Estadio\" WHERE nombre = '".$nombre."'";
			$result  = $instancia->query($query);
			$row = $instancia->fetch($result);
			
			$instancia->disconnect($link);
			
			return $row['id'];
		}				
		
		public function getTagsEstadio(){
		
			$database = Database::getInstance();
			$link = $database->connect();	
			
			$q = "SELECT nombre FROM \"Fantasy\".\"Estadio\"";
			$result = $database->query($q);
			
			$Estadios = new ArrayObject();
			while($row = $database->fetch($result))
				$Estadios->append($row['nombre']);		
			
			$database->disconnect($link);
			return $Estadios->getArrayCopy();
		
		}
		
		public function getAllEstadio(){
			$instancia = Database::getInstance();
			$link = $instancia->connect();

			$Estadios = new ArrayObject();
				
			$query = "SELECT * FROM \"Fantasy\".\"Estadio\" ";
			$result  = $instancia->query($query);
			
			while($row = $instancia->fetch($result))
				$Estadios->append(new Estadio($row['nombre'],$row['ubicacion'],$row['propietario'],$row['medida_left_field'],$row['medida_center_field'],$row['medida_right_field'],$row['tipo_terreno'],$row['fecha_fundacion'],$row['id']));
			
			
			$instancia->disconnect($link);
			
			return $Estadios->getArrayCopy();			
		}
		
		
	}
	
?>