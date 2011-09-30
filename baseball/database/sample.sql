INSERT INTO "Jugador" ("nombre", "equipo", "número")
SELECT "Datos"."nombre", "Datos"."número", "Equipo"."id"
FROM
        "Equipo",
        (
                VALUES
                ('Fabiana Reggio'       ,  12, 'Tigres de Aragua'                ),
                ('Krisvely Varela'      ,  34, 'Navegantes del Magallanes'       ),
                ('Ricardo Monascal'     ,  12, 'Leones del Caracas'              ),
                ('Miguel Ambrosio'      ,  45, 'Navegantes del Magallanes'       )
        ) as "Datos" ("nombre", "número", "nombre del equipo")
WHERE "Datos"."nombre del equipo" = "Equipo"."id"
