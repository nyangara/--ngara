<?php
	
	class Estadistica_Pitcheo {
		//att de la Clase
		private $el; // Entradas Lanzadas
		private $cl; // Carreras Limpias
		private $i;  // Imparables
		private $bb; // Bases por Bola
		private $k;  // Ponches
		private $jg; // Juegos Ganados
		private $e;  // Errores
		
		//Clave
		private $fecha;     //Fecha del Partido
		private $jugador; //Jugador de la estadistica
		
		public function __construct($el,$cl,$i,$bb,$k,$jg,$e,$fecha,$jugador){
			$this->el = $el;
			$this->cl = $cl;
			$this->i  = $i;
			$this->bb = $bb;
			$this->k  = $k;
			$this->jg = $jg;
			$this->e  = $e;
			$this->fecha      = $fecha;
			$this->jugador  = $jugador;
			
		}
		
		public function ReFill($el,$cl,$i,$bb,$k,$jg,$e){
			$this->el = $el;
			$this->cl = $cl;
			$this->i  = $i;
			$this->bb = $bb;
			$this->k  = $k;
			$this->jg = $jg;
			$this->e  = $e;
		}
		
		public function getArregloDescriptor()
		{
			$res[0] = 'Fecha';
			$res[1] = 'Entradas Lanzadas';
			$res[2] = 'Carreras Limpias';
			$res[3] = 'Imparables';
			$res[4] = 'Base por Bola';
			$res[5] = 'Ponches';
			$res[6] = 'Juegos Ganados';
			$res[7] = 'Errores';
			
			return $res;
		
		}
		
		public function getArregloEstadisticas()
		{
			$res[0] = $this->fecha;
			$res[1] = $this->el;
			$res[2] = $this->cl;
			$res[3] = $this->i;
			$res[4] = $this->bb;
			$res[5] = $this->k;
			$res[6] = $this->jg;
			$res[7] = $this->e;
			
			return $res;
		
		}		
		
		public function getNombreTabla()
		{
			return "Estadistica_Pitcheo";
		}
		
		public function getOrdenInsert()
		{
			$res[0] = "jugador";
			$res[1] = "fecha";
			$res[2] = "el";
			$res[3] = "cl";
			$res[4] = "i";
			$res[5] = "bb";
			$res[6] = "k";
			$res[7] = "jg";
			$res[8] = "e";
			
			return $res;
		}		
		
		public function getfecha(){
			return $this->fecha;
		}
		
		public function setfecha($fecha){
			$this->fecha = $fecha;
		}		

		public function getjugador(){
			return $this->jugador;
		}
		
		public function setjugador($jugador){
			$this->jugador = $jugador;
		}				
		
		public function getel(){
			return $this->el;
		}
		
		public function setel($el){
			$this->el = $el;
		}		
		
		public function getcl(){
			return $this->cl;
		}
		
		public function setcl($c){
			$this->cl = $cl;
		}		

		public function geti(){
			return $this->i;
		}
		
		public function seti($i){
			$this->i = $i;
		}		

		public function getbb(){
			return $this->bb;
		}
		
		public function setbb($bb){
			$this->bb = $bb;
		}		

		public function getk(){
			return $this->k;
		}
		
		public function setk($k){
			$this->k = $k;
		}		

		public function getjg(){
			return $this->jg;
		}
		
		public function setjg($jg){
			$this->jg = $jg;
		}				
		
		public function gete(){
			return $this->e;
		}
		
		public function sete($e){
			$this->e = $e;
		}			
		
	}

?>