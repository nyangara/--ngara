CREATE OR REPLACE FUNCTION "Fantasy"."autenticar"(
        IN "username" text,
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
                "Fantasy"."Usuario"."username" = "Fantasy"."passwd"."username" AND
                "Fantasy"."passwd"."username"  = $1                            AND
                "Fantasy"."passwd"."password"  = $2
$BODY$;



-- TODO: manejar errores (parámetros nulos, usuario ya existente, etc)
CREATE OR REPLACE FUNCTION "Fantasy"."registrar"(
        IN      "parámetro: username"                   text,
        IN      "parámetro: nombre completo"            text,
        IN      "parámetro: dirección de e-mail"        text,
        IN      "parámetro: es administrador"           boolean,
        IN      "parámetro: password"                   text
) RETURNS void
        VOLATILE
        STRICT
        SECURITY DEFINER
        LANGUAGE 'plpgsql'
AS $BODY$
        BEGIN
                INSERT INTO "Fantasy"."Usuario" (
                        "username",
                        "nombre completo",
                        "dirección de e-mail",
                        "es administrador"
                ) VALUES (
                        "parámetro: username",
                        "parámetro: nombre completo",
                        "parámetro: dirección de e-mail",
                        "parámetro: es administrador"
                );

                INSERT INTO "Fantasy"."passwd"
                SELECT
                        "Fantasy"."Usuario"."username",
                        "parámetro: password"
                FROM
                        "Fantasy"."Usuario"
                WHERE
                        "username" = "parámetro: username";
        END;
$BODY$;
