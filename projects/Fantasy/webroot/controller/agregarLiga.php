<?php
        if (array_key_exists('insert', $_POST) && $_POST['insert']) {
                $query = <<<'EOD'
                        INSERT INTO "Jugador" (
                                "nombre",
                                "fecha de nacimiento",
                                "lugar de procedencia"
                        ) VALUES (
                                $1,
                                $2,
                                $3
                        )
EOD;

                $result = pg_prepare($dbconn, "jugador", $query) or die('pg_prepare: ' . pg_last_error());
                $result = pg_execute($dbconn, "jugador", array($_POST['n'], $_POST['f'], $_POST['l'])) or die('pg_execute: ' . pg_last_error());

                pg_free_result($result);
        }

        pg_close($dbconn);
?>
