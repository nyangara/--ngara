<?php
        require_once("Equipo.php");
        require_once("Jugador.php");
        require_once("Database.php");

        class EquipoFachada {
                public function insertEquipo(Equipo $equipo) {
                        $database = Database::getInstance();
                        $link = $database->connect();
                        $query = <<<'EOD'
                                INSERT INTO "Fantasy"."Equipo" (
                                        "nombre completo",
                                        "nombre corto",
                                        "siglas",
                                        "año de fundación",
                                        "ciudad",
                                        "estado",
                                        "estadio principal",
                                ) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)
EOD

                        $result = $database->prepare($q, 'insertEquipo');
                        $result = $database->execute('insertEquipo', array(
                                $equipo->get_nombre_completo()
                                $equipo->get_nombre_corto()
                                $equipo->get_siglas()
                                $equipo->get_Fecha_fundacion()
                        
                        ));


                        $database->disconnect($link);
                }

                /*
                 * Funcion que modifica una fila de la tabla Equipo con el Equipo que se esta pasando por parametro
                 */
                public function updateEquipo(Equipo $Eq)
                {
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = "UPDATE \"Fantasy\".\"Equipo\" SET
                        siglas='".$Eq->getSiglas()."',home='".$Eq->gethome()."',nombre='".$Eq->getnombre()."',fecha_fundacion='".$Eq->getFecha_fundacion()."'
                        WHERE id='".$Eq->getId()."'";

                        $result = $database->query($q);


                        $database->disconnect($link);
                }

                public function removeEquipo(Equipo $Eq){
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = 'DELETE FROM  "Fantasy"."Equipo" WHERE id='.$Eq->getId();
                        $result = $database->query($q);

                        $database->disconnect($link);
                }

                public function getTagsEquipo()
                {
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = "SELECT nombre FROM \"Fantasy\".\"Equipo\"";
                        $result = $database->query($q);

                        $Equipos = new ArrayObject();
                        while($row = $database->fetch($result))
                                $Equipos->append($row['nombre']);

                        $database->disconnect($link);
                        return $Equipos->getArrayCopy();
                }

                /*
                 * Funcion que obtiene la instancia de un Equipo cuyo id sea
                 * igual al parametro $id.
                 */
                public function getEquipo($id){
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = 'SELECT * FROM "Fantasy"."Equipo" WHERE id='.$id;
                        $result = $database->query($q);

                        $row = $database->fetch($result);
                        $Equipo = new Equipo($row['nombre'],$row['siglas'],$row['fecha_fundacion'],$row['home'],$row['id']);

                        $q = 'SELECT * FROM "Fantasy"."Jugador" WHERE Equipo = '.$Equipo->getId();
                        $result = $database->query($q);
                        while($row = $database->fetch($result))
                                $Equipo->insertJ(new Jugador($row['nombres'],$row['apellidos'],$row['fecha_nacimiento'],$row['posicion'],$row['numero'],$row['precio'],$row['equipo'],$row['id']));


                        $database->disconnect($link);
                        return $Equipo;
                }

                /*
                 * Funcion que devuelve todos los equipos registrados en la base de datos en un ArrayObject .
                 */
                public function getAllequipo(){
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = "SELECT * FROM \"Fantasy\".\"Equipo\"";
                        $result = $database->query($q);

                        $Equipos = new ArrayObject();
                        while($row = $database->fetch($result))
                                $Equipos->append(new Equipo($row['nombre'],$row['siglas'],$row['fecha_fundacion'],$row['home'],$row['id']));

                        $cou = $Equipos->count();


                        for($i=0 ; $i<$cou ; $i++)
                        {
                                $Tmp = $Equipos->offsetGet($i);

                                $q = 'SELECT * FROM  "Fantasy"."Jugador" WHERE Equipo = '.$Tmp->getId();

                                $result = $database->query($q);
                                while($row = $database->fetch($result))
                                        $Tmp->insertJ(new Jugador($row['nombres'],$row['apellidos'],$row['fecha_nacimiento'],$row['posicion'],$row['numero'],$row['precio'],$row['equipo'],$row['id']));
                        }


                        $database->disconnect($link);
                        return $Equipos;
                }

                public function getEquipos(){
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = "SELECT * FROM \"Fantasy\".\"Equipo\"";
                        $result = $database->query($q);

                        $Equipos = new ArrayObject();
                        while($row = $database->fetch($result))
                                $Equipos->append(new Equipo($row['nombre'],$row['siglas'],$row['fecha_fundacion'],$row['home'],$row['id']));

                        $database->disconnect($link);
                        return $Equipos->getArrayCopy();
                }

                public function getidEquipo($nombre)
                {
                        $database = Database::getInstance();
                        $link = $database->connect();

                        $q = 'SELECT id FROM  "Fantasy"."Equipo" WHERE nombre = \''.$nombre.'\'';


                        $result = $database->query($q);
                        $row = $database->fetch($result);

                        $database->disconnect($link);

                        return $row['id'];
                }
        }
?>
