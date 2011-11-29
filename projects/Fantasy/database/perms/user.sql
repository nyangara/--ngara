GRANT CONNECT ON DATABASE "Fantasy" TO "Fantasy (usuario normal)";
GRANT USAGE   ON SCHEMA   "Fantasy" TO "Fantasy (usuario normal)";



-- Tablas de solo lectura:
GRANT
        SELECT
ON
        "Fantasy"."Usuario",
        "Fantasy"."Estadio",
        "Fantasy"."Equipo",
        "Fantasy"."Jugador",
        "Fantasy"."Juego",
        "Fantasy"."Estadística de bateo",
        "Fantasy"."Estadística de pitcheo",
        "Fantasy"."Juega",
        "Fantasy"."Noticia"
TO "Fantasy (usuario normal)";



-- Tablas de lectura y actualización:
GRANT
        SELECT,
        UPDATE
ON
        "Fantasy"."Usuario"
TO "Fantasy (usuario normal)";




-- Tablas de lectura y escritura:
GRANT
        SELECT,
        INSERT,
        UPDATE,
        DELETE,
        TRUNCATE
ON
        "Fantasy"."Liga",
        "Fantasy"."Participa",
        "Fantasy"."Roster",
        "Fantasy"."Contenido de roster"
TO "Fantasy (usuario normal)";

-- Secuencias correspondientes:
GRANT
        USAGE,
        SELECT,
        UPDATE
ON SEQUENCE
        "Fantasy"."Liga_id_seq",
        "Fantasy"."Roster_id_seq"
TO "Fantasy (usuario normal)";
