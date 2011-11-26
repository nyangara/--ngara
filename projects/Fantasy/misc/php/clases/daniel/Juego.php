<?php
include('Database.php');

define('JUEGO_NO_COMENZADO', '0');
define('JUEGO_COMENZADO'   , '1');
define('JUEGO_TERMINADO'   , '2');

class Juego {
        private $id;
        private $nombre;
        private $status;

        public function __construct($args) {
                $arg0 = $args[0];
                $arg1 = $args[1];
                $arg2 = $args[2];
                $arg3 = $args[3];

                $this->nombre = $arg1 . ' vs. ' . $arg2;
                $this->status = JUEGO_NO_COMENZADO;

                $database = Database::getInstance();

                $table = '"Fantasy"."Juego"';

                $columns = array('"inicio"', '"equipo local"', '"equipo visitante"', '"estadio"');

                $values = <<<EOD
                        SELECT
                                to_timestamp(Data."inicio", 'YYYY/MM/DD HH12:MI AM'),
                                Equipo_local.id,
                                Equipo_visitante.id,
                                Estadio.id
                        FROM
                                "Fantasy"."Equipo" AS Equipo_local,
                                "Fantasy"."Equipo" AS Equipo_visitante,
                                "Fantasy"."Estadio" AS Estadio,
                                (VALUES ('$arg0', '$arg1', '$arg2', '$arg3')) AS Data ("inicio", "equipo_local", "equipo_visitante", "estadio")
                        WHERE
                                Data.equipo_local = Equipo_local."nombre corto" AND
                                Data.equipo_visitante = Equipo_visitante."nombre corto" AND
                                Data.estadio = Estadio.nombre;
EOD;

                $output = $database->insert($table, $columns, $values) or die('(!) Error: ' . pg_last_error());
                header('Location: calendario.php');

/*
                $ids = $database->select('id', '"Fantasy"."Juego"', NULL);
                $this->id = $ids[count($ids, 0) - 1];
*/
        }
}

?>
