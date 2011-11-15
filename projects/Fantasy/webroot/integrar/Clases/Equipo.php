<?php
	class Equipo {
	//att de Equipo
		private $id=0;
		private $nombre;
		private $siglas;		
		private $fecha_fundacion;
		private $home; //Foranea a estadio		
		
		private $LJugadores; //Lista de Jugadores que Juegan en el Equipo
		
		//Funcion Constructora de la clase
		function __construct($nombre,$siglas,$fecha_fundacion,$home,$id=-1){ 
			$this->id = $id;
			$this->siglas = $siglas;
			$this->home = $home;
			$this->nombre = $nombre;
			$this->fecha_fundacion = $fecha_fundacion;
			$this->LJugadores = new ArrayObject();
		}
		
		// Funcion Insertar Jugador
		function insertJ($Jugador){
			$this->LJugadores->append($Jugador);
		}
		
		//Devuelve true si elimina al jugador, false en caso contrario
		function deleteJ($Jugador){	
			$Cont_J = $this->LJugadores->count();
			for($i=0;i<$Cont_J;$i++)
				if(	$this->LJugadores->offsetGet($i) == $Jugador){
					$this->LJugadores->offsetUnset($i);
					return true;
					}
			return false;
		}
		
		//Devuelve un Iterador con todos los jugadores del equipo
		function getIteratorJ()
		{
			if(isset($this->LJugadores))
				return $this->LJugadores->getIterator();
		}
		
		//Destructor para eliminar la instancia de Equipo
	   	function __destruct(){
		
			if(isset($this->LJugadores))
				$Cont_J = $this->LJugadores->count();
			else
				$Cont_J = -1;
			
			for($i=$Cont_J-1;0<=$i;$i--)
				$this->LJugadores->offsetUnset($i);
		
		}
		
		
		function getId(){
			return $this->id;
		}
		
		function setId($id){
			$this->id = $id;
		}

		function getSiglas(){
			return $this->siglas;
		}

		function setSiglas($siglas){
			$this->siglas = $siglas;
		}

		function gethome(){
			return $this->home;
		}

		function sethome($home){
			$this->home = $home;
		}

		function getFecha_fundacion(){
			return $this->fecha_fundacion;
		}
		
		function setFecha_fundacion($fecha_fundacion){
			$this->fecha_fundacion = $fecha_fundacion;
		}
		
		function getnombre(){
			return $this->nombre;
		}

		function setnombre($nombre){
			$this->nombre = $nombre;
		}

	}
?>
