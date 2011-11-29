-- El rol administrador hereda todo del usuario normal



-- Tablas de lectura y escritura (que no lo fueran ya para el usuario normal):
GRANT
        SELECT,
        INSERT,
        UPDATE,
        DELETE,
        TRUNCATE
ON
        "Fantasy"."Estadio",
        "Fantasy"."Equipo"
TO "Fantasy (administrador)";

-- Secuencias correspondientes:
GRANT
        USAGE,
        SELECT,
        UPDATE
ON SEQUENCE
        "Fantasy"."Estadio_id_seq",
        "Fantasy"."Equipo_id_seq"
TO "Fantasy (administrador)";
