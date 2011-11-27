CREATE OR REPLACE FUNCTION "Fantasy"."autenticar"(
        IN "nombre de usuario" text,
        IN "password" text
) RETURNS integer
        STABLE
        STRICT
        SECURITY DEFINER
        LANGUAGE SQL
AS $BODY$
        SELECT
                "Fantasy"."Usuario"."id"
        FROM
                "Fantasy"."Usuario",
                "Fantasy"."passwd"
        WHERE
                "Fantasy"."Usuario"."nombre"  = $1                           AND
                "Fantasy"."Usuario"."id"      = "Fantasy"."passwd"."usuario" AND
                "Fantasy"."passwd"."password" = $2
$BODY$;



-- TODO: manejar errores (parámetros nulos, usuario ya existente, etc)
CREATE OR REPLACE FUNCTION "Fantasy"."registrar"(
        IN      "parámetro: username"           text,
        IN      "parámetro: nombre completo"    text,
        IN      "parámetro: password"           text,
        IN      "parámetro: es administrador"   boolean
) RETURNS void
        VOLATILE
        STRICT
        SECURITY DEFINER
        LANGUAGE 'plpgsql'
AS $BODY$
        BEGIN
                INSERT INTO "Fantasy"."Usuario" (
                        "nombre",
                        "nombre completo",
                        "es administrador"
                ) VALUES (
                        "parámetro: nombre",
                        "parámetro: nombre completo",
                        "parámetro: es administrador"
                );

                INSERT INTO "Fantasy"."passwd"
                SELECT
                        "Fantasy"."Usuario"."username",
                        "parámetro: password"
                FROM
                        "Fantasy"."Usuario"
                WHERE
                        "nombre" = "parámetro: nombre";
        END;
$BODY$;
