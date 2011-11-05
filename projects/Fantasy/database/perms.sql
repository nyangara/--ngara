GRANT CONNECT  ON DATABASE "Fantasy"            TO "Fantasy (usuario normal)";

GRANT SELECT   ON "Tipo de terreno"             TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Estadio"                     TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Equipo"                      TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Jugador"                     TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Peso"                        TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Altura"                      TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Juega"                       TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Juego"                       TO "Fantasy (usuario normal)";

GRANT SELECT   ON "Tipo de terreno_id_seq"      TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Estadio_id_seq"              TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Equipo_id_seq"               TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Jugador_id_seq"              TO "Fantasy (usuario normal)";
GRANT SELECT   ON "Juego_id_seq"                TO "Fantasy (usuario normal)";

GRANT INSERT   ON "Jugador"                     TO "Fantasy (usuario normal)";
GRANT INSERT   ON "Peso"                        TO "Fantasy (usuario normal)";
GRANT INSERT   ON "Altura"                      TO "Fantasy (usuario normal)";
GRANT INSERT   ON "Juega"                       TO "Fantasy (usuario normal)";
GRANT INSERT   ON "Juego"                       TO "Fantasy (usuario normal)";

GRANT UPDATE   ON "Jugador"                     TO "Fantasy (usuario normal)";
GRANT UPDATE   ON "Peso"                        TO "Fantasy (usuario normal)";
GRANT UPDATE   ON "Altura"                      TO "Fantasy (usuario normal)";
GRANT UPDATE   ON "Juega"                       TO "Fantasy (usuario normal)";
GRANT UPDATE   ON "Juego"                       TO "Fantasy (usuario normal)";

GRANT UPDATE   ON "Juego_id_seq"                TO "Fantasy (usuario normal)";
GRANT UPDATE   ON "Jugador_id_seq"              TO "Fantasy (usuario normal)";

GRANT DELETE   ON "Jugador"                     TO "Fantasy (usuario normal)";
GRANT DELETE   ON "Peso"                        TO "Fantasy (usuario normal)";
GRANT DELETE   ON "Altura"                      TO "Fantasy (usuario normal)";
GRANT DELETE   ON "Juego"                       TO "Fantasy (usuario normal)";
GRANT DELETE   ON "Juega"                       TO "Fantasy (usuario normal)";

GRANT TRUNCATE ON "Jugador"                     TO "Fantasy (usuario normal)";
GRANT TRUNCATE ON "Peso"                        TO "Fantasy (usuario normal)";
GRANT TRUNCATE ON "Altura"                      TO "Fantasy (usuario normal)";
GRANT TRUNCATE ON "Juego"                       TO "Fantasy (usuario normal)";
GRANT TRUNCATE ON "Juego"                       TO "Fantasy (usuario normal)";

GRANT USAGE    ON "Juego_id_seq"                TO "Fantasy (usuario normal)";
GRANT USAGE    ON "Jugador_id_seq"              TO "Fantasy (usuario normal)";
