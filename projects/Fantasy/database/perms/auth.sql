GRANT CONNECT ON DATABASE "Fantasy" TO "Fantasy (autenticación)";
GRANT USAGE   ON SCHEMA   "Fantasy" TO "Fantasy (autenticación)";

GRANT EXECUTE ON FUNCTION
        "Fantasy"."autenticar"(
                IN "username"                                   text,
                IN "password"                                   text
        ),
        "Fantasy"."registrar"(
                IN      "parámetro: username"                   text,
                IN      "parámetro: nombre completo"            text,
                IN      "parámetro: dirección de e-mail"        text,
                IN      "parámetro: es administrador"           boolean,
                IN      "parámetro: password"                   text
        )
TO "Fantasy (autenticación)";
