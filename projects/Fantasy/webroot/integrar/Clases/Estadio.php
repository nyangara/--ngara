<?php

	class Estadio {
		//att de Estadio
		private $id;
		private $nombre;
		private $ubicacion;
		private $propietario;
		private $medida_left_field;
		private $medida_center_field;
		private $medida_right_field;
		private $tipo_terreno;
		private $fecha_fundacion;
		
		function __construct($nombre,$ubicacion,$propietario,$medida_left_field,$medida_center_field,$medida_right_field,$tipo_terreno,$fecha_fundacion,$id=-1){
			$this->id = $id;
			$this->nombre = $nombre;
			$this->ubicacion = $ubicacion;
			$this->propietario = $propietario;
			$this->medida_left_field = $medida_left_field;
			$this->medida_center_field = $medida_center_field;
			$this->medida_right_field = $medida_right_field;
			$this->tipo_terreno = $tipo_terreno;
			$this->fecha_fundacion = $fecha_fundacion; 
		}
		
		function getId(){
			return $this->id;
		}
		  
		function setId($id){
			$this->id = $id;			
		}

		function getnombre(){
			return $this->nombre;
		}
		  
		function setnombre($nombre){
			$this->nombre = $nombre;			
		}

		function getubicacion(){
			return $this->ubicacion;
		}
		  
		function setubicacion($ubicacion){
			$this->ubicacion = $ubicacion;			
		}

		function getpropietario(){
			return $this->propietario;
		}
		  
		function setpropietario($propietario){
			$this->propietario = $propietario;			
		}

		function getmedida_left_field(){
			return $this->medida_left_field;
		}
		  
		function setmedida_left_field($medida_left_field){
			$this->medida_left_field = $medida_left_field;			
		}		
	
		function getmedida_center_field(){
			return $this->medida_center_field;
		}
		  
		function setmedida_center_field($medida_center_field){
			$this->medida_center_field = $medida_center_field;			
		}

		function getmedida_right_field(){
			return $this->medida_right_field;
		}
		  
		function setmedida_right_field($medida_right_field){
			$this->medida_right_field = $medida_right_field;			
		}
		
		function gettipo_terreno(){
			return $this->tipo_terreno;
		}
		  
		function settipo_terreno($tipo_terreno){
			$this->tipo_terreno = $tipo_terreno;			
		}

		function getfecha_fundacion(){
			return $this->fecha_fundacion;
		}
		  
		function setfecha_fundacion($fecha_fundacion){
			$this->fecha_fundacion = $fecha_fundacion;			
		}

	}
	

?>

