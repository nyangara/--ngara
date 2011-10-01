GRANT CONNECT  ON DATABASE "Baseball" TO "Baseball";

GRANT SELECT   ON "Equipo"            TO "Baseball";
GRANT SELECT   ON "Estadio"           TO "Baseball";
GRANT SELECT   ON "Juego"             TO "Baseball";
GRANT SELECT   ON "Jugador"           TO "Baseball";
GRANT SELECT   ON "Equipo_id_seq"     TO "Baseball";
GRANT SELECT   ON "Estadio_id_seq"    TO "Baseball";
GRANT SELECT   ON "Juego_id_seq"      TO "Baseball";
GRANT SELECT   ON "Jugador_id_seq"    TO "Baseball";

GRANT INSERT   ON "Juego"             TO "Baseball";
GRANT INSERT   ON "Jugador"           TO "Baseball";

GRANT UPDATE   ON "Juego"             TO "Baseball";
GRANT UPDATE   ON "Jugador"           TO "Baseball";
GRANT UPDATE   ON "Juego_id_seq"      TO "Baseball";
GRANT UPDATE   ON "Jugador_id_seq"    TO "Baseball";

GRANT DELETE   ON "Juego"             TO "Baseball";
GRANT DELETE   ON "Jugador"           TO "Baseball";

GRANT TRUNCATE ON "Juego"             TO "Baseball";
GRANT TRUNCATE ON "Jugador"           TO "Baseball";

GRANT USAGE    ON "Juego_id_seq"      TO "Baseball";
GRANT USAGE    ON "Jugador_id_seq"    TO "Baseball";
