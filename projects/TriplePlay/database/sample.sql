INSERT INTO "Jugador" ("nombre", "fecha de nacimiento", "lugar de procedencia")
VALUES
        ('Fabiana Reggio'  , '1990/01/02', 'San Antonio, Venezuela'),
        ('Krisvely Varela' , '1990/03/04', 'Caracas, Venezuela'    ),
        ('Miguel Ambrosio' , '1988/05/06', 'Caracas, Venezuela'    ),
        ('Ricardo Monascal', '1846/08/12', 'San Antonio, Venezuela');

INSERT INTO "Peso" ("jugador", "peso", "fecha")
SELECT "Jugador"."id", "Datos"."peso", to_date("Datos"."fecha", 'YYYY/MM/DD')
FROM
        "Jugador",
        (VALUES
                ('Fabiana Reggio'  ,  50.3, '2011/10/01'),
                ('Fabiana Reggio'  ,  51.0, '2011/10/02'),
                ('Fabiana Reggio'  ,  50.5, '2011/10/03'),
                ('Fabiana Reggio'  ,  49.2, '2011/10/04'),
                ('Fabiana Reggio'  ,  50.8, '2011/10/05'),
                ('Ricardo Monascal',  80.8, '2011/05/01'),
                ('Ricardo Monascal',  87.1, '2011/06/01'),
                ('Ricardo Monascal',  96.3, '2011/07/01'),
                ('Ricardo Monascal', 102.7, '2011/08/01'),
                ('Ricardo Monascal', 107.4, '2011/09/01'),
                ('Ricardo Monascal', 119.6, '2011/10/01')
        ) as "Datos" ("nombre", "peso", "fecha")
WHERE "Datos"."nombre" = "Jugador"."nombre";

INSERT INTO
        "Juega" ("jugador", "equipo", "número", "inicio", "fin")
SELECT
        "Jugador"."id",
        "Equipo"."id",
        "Datos"."número",
        to_date("Datos"."inicio", 'YYYY/MM/DD'),
        to_date("Datos"."fin"   , 'YYYY/MM/DD')
FROM
        "Jugador",
        "Equipo",
        (VALUES
                ('Fabiana Reggio'  ,  'Tigres de Aragua'         , 12, '2007/09/17', '2009/04/12'),
                ('Fabiana Reggio'  ,  'Navegantes del Magallanes', 12, '2009/09/03', NULL        ),
                ('Krisvely Varela' ,  'Navegantes del Magallanes', 34, '2007/09/17', NULL        ),
                ('Ricardo Monascal',  'Leones del Caracas'       , 12, '2003/09/22', NULL        ),
                ('Miguel Ambrosio' ,  'Navegantes del Magallanes', 45, '2005/09/19', NULL        )
        ) as "Datos" ("jugador", "equipo", "número", "inicio", "fin")
WHERE "Datos"."jugador" = "Jugador"."nombre" AND "Datos"."equipo" = "Equipo"."nombre";

INSERT INTO
        "Juego" ("inicio", "equipo local", "equipo visitante", "estadio")
SELECT
        to_timestamp("Datos"."inicio", 'YYYY/MM/DD'),
        "Equipo local"."id",
        "Equipo visitante"."id",
        "Estadio"."id"
FROM
        "Equipo" AS "Equipo local",
        "Equipo" AS "Equipo visitante",
        "Estadio",
        (VALUES
                ('Tigres de Aragua'         , 'Leones del Caracas', 'José Pérez Colmenares', '2010/11/03 06:30 PM'),
                ('Navegantes del Magallanes', 'Tigres de Aragua'  , 'José Bernardo Pérez'  , '2010/11/04 07:45 PM'),
                ('Leones del Caracas'       , 'Tigres de Aragua'  , 'Universitario'        , '2010/11/06 06:00 PM'),
                ('Navegantes del Magallanes', 'Leones del Caracas', 'José Bernardo Pérez'  , '2010/11/09 07:00 PM')
        ) as "Datos" ("equipo local", "equipo visitante", "estadio", "inicio")
WHERE
        "Datos"."equipo local"     = "Equipo local"."nombre"     AND
        "Datos"."equipo visitante" = "Equipo visitante"."nombre" AND
        "Datos"."estadio"          = "Estadio"."nombre";
