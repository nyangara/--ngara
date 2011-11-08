-- Usuario "Fantasy (autenticación)"
GRANT CONNECT ON DATABASE "Fantasy" TO "Fantasy (autenticación)";
GRANT USAGE   ON SCHEMA   "Fantasy" TO "Fantasy (autenticación)";

GRANT EXECUTE ON FUNCTION
        "Fantasy"."autenticar"(IN "nombre de usuario" text, IN "password" text)
TO "Fantasy (autenticación)";



-- Usuario "Fantasy (usuario normal)"
GRANT CONNECT ON DATABASE "Fantasy" TO "Fantasy (usuario normal)";
GRANT USAGE   ON SCHEMA   "Fantasy" TO "Fantasy (usuario normal)";

-- Tablas de solo lectura:
GRANT
        SELECT
ON
        "Fantasy"."Usuario",
        "Fantasy"."Estadio",
        "Fantasy"."Equipo"
TO "Fantasy (usuario normal)";

-- Secuencias de tablas de solo lectura:
GRANT
        SELECT
ON SEQUENCE
        "Fantasy"."Usuario_id_seq",
        "Fantasy"."Estadio_id_seq",
        "Fantasy"."Equipo_id_seq"
TO "Fantasy (usuario normal)";

-- Tablas de lectura y escritura:
GRANT
        SELECT,
        INSERT,
        UPDATE,
        DELETE,
        TRUNCATE
ON
        "Fantasy"."Jugador",
        "Fantasy"."Peso",
        "Fantasy"."Altura",
        "Fantasy"."Juega",
        "Fantasy"."Juego"
TO "Fantasy (usuario normal)";

-- Secuencias de tablas de lectura y escritura:
GRANT
        USAGE,
        SELECT,
        UPDATE
ON SEQUENCE
        "Fantasy"."Juego_id_seq",
        "Fantasy"."Jugador_id_seq"
TO "Fantasy (usuario normal)";



-- Usuario "Fantasy (administrador)"
-- TODO
-- recuerda que el admin hereda todo del normal
