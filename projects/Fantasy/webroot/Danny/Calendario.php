<?php

include("Database.php");

class Calendario {
  
  private $fecha;
  private $juegos;
  
  public function __construct() {
    $database = Database::getInstance();

    $columns = array('juego.inicio', 'equipo1."nombre corto" AS "equipo local"', 'equipo2."nombre corto" AS "equipo visitante"', 'estadio."nombre" AS "estadio"');
    
  $table = <<<'EOD'
"Fantasy"."Juego" AS juego
JOIN "Fantasy"."Equipo" AS equipo1 ON juego."equipo local" = equipo1.id
JOIN "Fantasy"."Equipo" AS equipo2 ON juego."equipo visitante" = equipo2.id
JOIN "Fantasy"."Estadio" AS estadio ON juego."estadio" = estadio.id
EOD;

    $this->juegos = $database->select($columns, $table, NULL);
  }
     
  function getFecha() {
    return $this->fecha;
  }
  
  function setFecha($fecha) {
    $this->fecha = $fecha;
  }
  
  function getJuegos() {
    return $this->juegos;
  }
  
  function setJuegos($juegos) {
    $this->juegos = $juegos;
  }

}

?> 
