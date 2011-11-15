<?php

	class Jugador {
	//att de Jugador
		private $id;
		private $nombres;
		private $apellidos;
		private $fecha_nacimiento;
		private $posicion;
		private $numero;
		private $precio;
		private $equipo; //Referencia a Equipo		

		private $Estadisticas; //Lista de Estadisticas de Cada juego que le pertenece al jugador
		
		function __construct($nombres,$apellidos,$fecha_nacimiento,$posicion,$numero,$precio,$equipo,$id=-1){
			$this->id = $id;
			$this->nombres = $nombres;
			$this->apellidos = $apellidos;
			$this->fecha_nacimiento = $fecha_nacimiento;
			$this->posicion = $posicion;
			$this->numero = $numero;
			$this->precio = $precio;
			$this->equipo = $equipo;
			
			$this->Estadisticas = new ArrayObject();
		}
		  
		// Funcion Insertar Estadistica
		function insertE($Estadistica){
			$this->Estadisticas->append($Estadistica);
		}
		
		//Devuelve true si elimina la estadistica, false en caso contrario
		function deleteE($Estadistica){
			$Cont_E = $this->Estadisticas->count();
			for($i=0;i<$Cont_E;$i++)
				if(	$this->Estadisticas->offsetGet($i) == $Estadistica){
					$this->Estadisticas->offsetUnset($i);
					return true;
					}
			return false;
		}
		
		//Devuelve un Iterador con todos Las Estadisticas del Jugador
		function getIteratorE()
		{
			if(isset($this->Estadisticas))
				return $this->Estadisticas->getIterator();
		}
		
		//Destructor para eliminar la instancia Jugador
	   	function __destruct(){
		
			if(isset($this->Estadisticas))
				$Cont_E = $this->Estadisticas->count();
			else
				$Cont_E = -1;
			
			for($i=$Cont_E-1;0<=$i;$i--)
				$this->Estadisticas->offsetUnset($i);
		
		}
		  
		  
		function getId(){
			return $this->id;
		}
		  
		function setId($id){
			$this->id = $id;			
		}
		   
		function getequipo(){
			return $this->equipo;
		}
		  
		function setequipo($equipo){
			$this->equipo = $equipo;
		}
		  
		function getnombres () {
			return $this->nombres;
		}
		  
		function setnombres($nombres) {
			$this->nombres = $nombres;
		}
		  
		function getapellidos () {
			return $this->apellidos;
		}
		  
		function setapellidos($apellidos) {
			$this->apellidos = $apellidos;
		}

		function getNumero() {
			return $this->numero;
		}
		  
		function setNumero($numero) {
			$this->numero = $numero;
		}
		
		function getPosicion() {
			return $this->posicion;
		}
		  
		function setPosicion($posicion) {
			$this->posicion = $posicion;
		}
		
		function getPrecio() {
			return $this->precio;
		}
		  
		function setPrecio($precio) {
			$this->precio = $precio;
		}		
		
		function getfecha_nacimiento(){
			return $this->fecha_nacimiento;
		}
		  
		function setfecha_nacimiento($fecha_nacimiento) {
			$this->fecha_nacimiento = $fecha_nacimiento;
		} 

	}
?>

