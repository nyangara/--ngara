GRANT CONNECT  ON DATABASE "TriplePlay" TO "TriplePlay";

GRANT SELECT   ON "Equipo"              TO "TriplePlay";
GRANT SELECT   ON "Estadio"             TO "TriplePlay";
GRANT SELECT   ON "Juego"               TO "TriplePlay";
GRANT SELECT   ON "Jugador"             TO "TriplePlay";
GRANT SELECT   ON "Equipo_id_seq"       TO "TriplePlay";
GRANT SELECT   ON "Estadio_id_seq"      TO "TriplePlay";
GRANT SELECT   ON "Juego_id_seq"        TO "TriplePlay";
GRANT SELECT   ON "Jugador_id_seq"      TO "TriplePlay";

GRANT INSERT   ON "Juego"               TO "TriplePlay";
GRANT INSERT   ON "Jugador"             TO "TriplePlay";

GRANT UPDATE   ON "Juego"               TO "TriplePlay";
GRANT UPDATE   ON "Jugador"             TO "TriplePlay";
GRANT UPDATE   ON "Juego_id_seq"        TO "TriplePlay";
GRANT UPDATE   ON "Jugador_id_seq"      TO "TriplePlay";

GRANT DELETE   ON "Juego"               TO "TriplePlay";
GRANT DELETE   ON "Jugador"             TO "TriplePlay";

GRANT TRUNCATE ON "Juego"               TO "TriplePlay";
GRANT TRUNCATE ON "Jugador"             TO "TriplePlay";

GRANT USAGE    ON "Juego_id_seq"        TO "TriplePlay";
GRANT USAGE    ON "Jugador_id_seq"      TO "TriplePlay";
