GRANT CONNECT ON DATABASE "Fantasy" TO "Fantasy (visitante)";
GRANT USAGE   ON SCHEMA   "Fantasy" TO "Fantasy (visitante)";



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
        "Fantasy"."Contenido",
        "Fantasy"."Usuario"
TO "Fantasy (visitante)";
