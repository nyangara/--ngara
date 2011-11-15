<?php
	
	class Estadistica_Bateo {
		//att de la tbase
		private $ca; // Carreras Anotadas
		private $tb; // Total de Bases
		private $ci; // Carreras impulsadas
		private $bb; // Base por Bola
		private $br; // Bases Robadas
		private $k;  // Ponches
		private $e;  // Errores
		
		//tbave
		private $fecha;     //Fecha dca Partcido
		private $jugador; //Jugador de la estadcistcica
		
		public function __construct($ca,$tb,$ci,$bb,$br,$k,$e,$fecha,$jugador){
			$this->ca = $ca;
			$this->tb = $tb;
			$this->ci  = $ci;
			$this->bb = $bb;
			$this->br  = $br;
			$this->k = $k;
			$this->e  = $e;
			$this->fecha      = $fecha;
			$this->jugador  = $jugador;
			
		}
		
		public function ReFill($ca,$tb,$ci,$bb,$br,$k,$e){
			$this->ca = $ca;
			$this->tb = $tb;
			$this->ci  = $ci;
			$this->bb = $bb;
			$this->br  = $br;
			$this->k = $k;
			$this->e  = $e;
		}
		
		public function getArregloDescriptor()
		{
			$res[0] = 'Fecha';
			$res[1] = 'Carreras Anotadas';
			$res[2] = 'Total de Bases';
			$res[3] = 'Carreras impulsadas';
			$res[4] = 'Base por Bola';
			$res[5] = 'Bases Robadas';
			$res[6] = 'Ponches';
			$res[7] = 'Errores';
			
			return $res;
		
		}
		
		public function getArregloEstadisticas()
		{
			$res[0] = $this->fecha;
			$res[1] = $this->ca;
			$res[2] = $this->tb;
			$res[3] = $this->ci;
			$res[4] = $this->bb;
			$res[5] = $this->br;
			$res[6] = $this->k;
			$res[7] = $this->e;
			
			return $res;
		
		}
		
		public function getNombreTabla()
		{
			return "Estadistica_Bateo";
		}
		
		public function getOrdenInsert()
		{
			$res[0] = "jugador";
			$res[1] = "fecha";
			$res[2] = "ca";
			$res[3] = "tb";
			$res[4] = "ci";
			$res[5] = "bb";
			$res[6] = "br";
			$res[7] = "k";
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
		
		public function getca(){
			return $this->ca;
		}
		public function setca($ca){
			$this->ca = $ca;
		}		
		
		public function gettb(){
			return $this->tb;
		}
		public function settb($tb){
			$this->tb = $tb;
		}		

		public function getci(){
			return $this->ci;
		}
		public function setci($ci){
			$this->ci = $ci;
		}		

		public function getbb(){
			return $this->bb;
		}
		public function setbb($bb){
			$this->bb = $bb;
		}		

		public function getbr(){
			return $this->br;
		}
		public function setbr($br){
			$this->br = $br;
		}		

		public function getk(){
			return $this->k;
		}
		public function setk($k){
			$this->k = $k;
		}				
		
		public function gete(){
			return $this->e;
		}
		public function sete($e){
			$this->e = $e;
		}			
		
	}

?>