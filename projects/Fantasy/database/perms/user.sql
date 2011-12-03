GRANT CONNECT ON DATABASE "Fantasy" TO "Fantasy (usuario normal)";
GRANT USAGE   ON SCHEMA   "Fantasy" TO "Fantasy (usuario normal)";



-- Tablas de solo lectura:
GRANT
        SELECT
ON
        "Fantasy"."Estadio",
        "Fantasy"."Equipo",
        "Fantasy"."Jugador",
        "Fantasy"."Juego",
        "Fantasy"."Estadística de bateo",
        "Fantasy"."Estadística de pitcheo",
        "Fantasy"."Contenido"
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
        "Fantasy"."Usuario tiene jugador",
        "Fantasy"."Usuario tiene lanzadores"
TO "Fantasy (usuario normal)";

-- Secuencias correspondientes:
GRANT
        USAGE,
        SELECT,
        UPDATE
ON SEQUENCE
        "Fantasy"."Liga_id_seq"
TO "Fantasy (usuario normal)";
