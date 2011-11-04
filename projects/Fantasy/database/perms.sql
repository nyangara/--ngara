GRANT CONNECT  ON DATABASE "Fantasy"            TO "Fantasy";

GRANT SELECT   ON "Tipo de terreno"             TO "Fantasy";
GRANT SELECT   ON "Estadio"                     TO "Fantasy";
GRANT SELECT   ON "Equipo"                      TO "Fantasy";
GRANT SELECT   ON "Jugador"                     TO "Fantasy";
GRANT SELECT   ON "Peso"                        TO "Fantasy";
GRANT SELECT   ON "Altura"                      TO "Fantasy";
GRANT SELECT   ON "Juega"                       TO "Fantasy";
GRANT SELECT   ON "Juego"                       TO "Fantasy";

GRANT SELECT   ON "Tipo de terreno_id_seq"      TO "Fantasy";
GRANT SELECT   ON "Estadio_id_seq"              TO "Fantasy";
GRANT SELECT   ON "Equipo_id_seq"               TO "Fantasy";
GRANT SELECT   ON "Jugador_id_seq"              TO "Fantasy";
GRANT SELECT   ON "Juego_id_seq"                TO "Fantasy";

GRANT INSERT   ON "Jugador"                     TO "Fantasy";
GRANT INSERT   ON "Peso"                        TO "Fantasy";
GRANT INSERT   ON "Altura"                      TO "Fantasy";
GRANT INSERT   ON "Juega"                       TO "Fantasy";
GRANT INSERT   ON "Juego"                       TO "Fantasy";

GRANT UPDATE   ON "Jugador"                     TO "Fantasy";
GRANT UPDATE   ON "Peso"                        TO "Fantasy";
GRANT UPDATE   ON "Altura"                      TO "Fantasy";
GRANT UPDATE   ON "Juega"                       TO "Fantasy";
GRANT UPDATE   ON "Juego"                       TO "Fantasy";

GRANT UPDATE   ON "Juego_id_seq"                TO "Fantasy";
GRANT UPDATE   ON "Jugador_id_seq"              TO "Fantasy";

GRANT DELETE   ON "Jugador"                     TO "Fantasy";
GRANT DELETE   ON "Peso"                        TO "Fantasy";
GRANT DELETE   ON "Altura"                      TO "Fantasy";
GRANT DELETE   ON "Juego"                       TO "Fantasy";
GRANT DELETE   ON "Juega"                       TO "Fantasy";

GRANT TRUNCATE ON "Jugador"                     TO "Fantasy";
GRANT TRUNCATE ON "Peso"                        TO "Fantasy";
GRANT TRUNCATE ON "Altura"                      TO "Fantasy";
GRANT TRUNCATE ON "Juego"                       TO "Fantasy";
GRANT TRUNCATE ON "Juego"                       TO "Fantasy";

GRANT USAGE    ON "Juego_id_seq"                TO "Fantasy";
GRANT USAGE    ON "Jugador_id_seq"              TO "Fantasy";
