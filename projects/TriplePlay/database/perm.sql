GRANT CONNECT  ON DATABASE "TriplePlay"         TO "TriplePlay";

GRANT SELECT   ON "Equipo"                      TO "TriplePlay";
GRANT SELECT   ON "Estadio"                     TO "TriplePlay";
GRANT SELECT   ON "Juega"                       TO "TriplePlay";
GRANT SELECT   ON "Juego"                       TO "TriplePlay";
GRANT SELECT   ON "Jugador"                     TO "TriplePlay";
GRANT SELECT   ON "Tipo de terreno"             TO "TriplePlay";
GRANT SELECT   ON "Altura"                      TO "TriplePlay";
GRANT SELECT   ON "Peso"                        TO "TriplePlay";

GRANT SELECT   ON "Equipo_id_seq"               TO "TriplePlay";
GRANT SELECT   ON "Estadio_id_seq"              TO "TriplePlay";
GRANT SELECT   ON "Juego_id_seq"                TO "TriplePlay";
GRANT SELECT   ON "Jugador_id_seq"              TO "TriplePlay";
GRANT SELECT   ON "Tipo de terreno_id_seq"      TO "TriplePlay";

GRANT INSERT   ON "Juega"                       TO "TriplePlay";
GRANT INSERT   ON "Juego"                       TO "TriplePlay";
GRANT INSERT   ON "Jugador"                     TO "TriplePlay";
GRANT INSERT   ON "Altura"                      TO "TriplePlay";
GRANT INSERT   ON "Peso"                        TO "TriplePlay";

GRANT UPDATE   ON "Juega"                       TO "TriplePlay";
GRANT UPDATE   ON "Juego"                       TO "TriplePlay";
GRANT UPDATE   ON "Jugador"                     TO "TriplePlay";
GRANT UPDATE   ON "Altura"                      TO "TriplePlay";
GRANT UPDATE   ON "Peso"                        TO "TriplePlay";

GRANT UPDATE   ON "Juego_id_seq"                TO "TriplePlay";
GRANT UPDATE   ON "Jugador_id_seq"              TO "TriplePlay";

GRANT DELETE   ON "Juego"                       TO "TriplePlay";
GRANT DELETE   ON "Jugador"                     TO "TriplePlay";
GRANT DELETE   ON "Altura"                      TO "TriplePlay";
GRANT DELETE   ON "Peso"                        TO "TriplePlay";

GRANT TRUNCATE ON "Juego"                       TO "TriplePlay";
GRANT TRUNCATE ON "Jugador"                     TO "TriplePlay";
GRANT TRUNCATE ON "Altura"                      TO "TriplePlay";
GRANT TRUNCATE ON "Peso"                        TO "TriplePlay";

GRANT USAGE    ON "Juego_id_seq"                TO "TriplePlay";
GRANT USAGE    ON "Jugador_id_seq"              TO "TriplePlay";
