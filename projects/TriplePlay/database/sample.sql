INSERT INTO "Jugador" ("nombre", "fecha de nacimiento", "lugar de procedencia")
VALUES
        ('Fabiana Reggio'  , '1990/01/02', 'San Antonio, Venezuela'),
        ('Krisvely Varela' , '1990/03/04', 'Caracas, Venezuela'    ),
        ('Miguel Ambrosio' , '1988/05/06', 'Caracas, Venezuela'    ),
        ('Ricardo Monascal', '1846/08/12', 'San Antonio, Venezuela');

INSERT INTO "Peso" ("jugador", "peso", "fecha")
SELECT "Jugador"."id", "Datos"."peso", "Datos"."fecha"
FROM
        "Jugador",
        (VALUES
                ('Fabiana Reggio'  ,  50.3, to_date('2011/10/01', 'YYYY/MM/DD')),
                ('Fabiana Reggio'  ,  51.0, to_date('2011/10/02', 'YYYY/MM/DD')),
                ('Fabiana Reggio'  ,  50.5, to_date('2011/10/03', 'YYYY/MM/DD')),
                ('Fabiana Reggio'  ,  49.2, to_date('2011/10/04', 'YYYY/MM/DD')),
                ('Fabiana Reggio'  ,  50.8, to_date('2011/10/05', 'YYYY/MM/DD')),
                ('Ricardo Monascal',  80.8, to_date('2011/05/01', 'YYYY/MM/DD')),
                ('Ricardo Monascal',  87.1, to_date('2011/06/01', 'YYYY/MM/DD')),
                ('Ricardo Monascal',  96.3, to_date('2011/07/01', 'YYYY/MM/DD')),
                ('Ricardo Monascal', 102.7, to_date('2011/08/01', 'YYYY/MM/DD')),
                ('Ricardo Monascal', 107.4, to_date('2011/09/01', 'YYYY/MM/DD')),
                ('Ricardo Monascal', 119.6, to_date('2011/10/01', 'YYYY/MM/DD'))
        ) as "Datos" ("nombre", "peso", "fecha")
WHERE "Datos"."nombre" = "Jugador"."nombre";

INSERT INTO "Juega" ("jugador", "equipo", "número", "inicio", "fin")
SELECT "Jugador"."id", "Equipo"."id", "Datos"."número", "Datos"."inicio", "Datos"."fin"
FROM
        "Jugador",
        "Equipo",
        (VALUES
                ('Fabiana Reggio'  ,  'Tigres de Aragua'         , 12, to_date('2007/09/17', 'YYYY/MM/DD'), to_date('2009/04/12', 'YYYY/MM/DD')),
                ('Fabiana Reggio'  ,  'Navegantes del Magallanes', 12, to_date('2009/09/03', 'YYYY/MM/DD'), NULL                               ),
                ('Krisvely Varela' ,  'Navegantes del Magallanes', 34, to_date('2007/09/17', 'YYYY/MM/DD'), NULL                               ),
                ('Ricardo Monascal',  'Leones del Caracas'       , 12, to_date('2003/09/22', 'YYYY/MM/DD'), NULL                               ),
                ('Miguel Ambrosio' ,  'Navegantes del Magallanes', 45, to_date('2005/09/19', 'YYYY/MM/DD'), NULL                               )
        ) as "Datos" ("jugador", "equipo", "número", "inicio", "fin")
WHERE "Datos"."jugador" = "Jugador"."nombre" AND "Datos"."equipo" = "Equipo"."nombre";

INSERT INTO "Juego" ("inicio", "equipo local", "equipo visitante", "estadio")
SELECT "Datos"."inicio", "Equipo local"."id", "Equipo visitante"."id", "Estadio"."id"
FROM
        "Equipo" AS "Equipo local",
        "Equipo" AS "Equipo visitante",
        "Estadio",
        (VALUES
                ('Tigres de Aragua'         , 'Leones del Caracas', 'José Pérez Colmenares', to_timestamp('2010/11/03 06:30 PM', 'YYYY/MM/DD HH12:MI AM')),
                ('Navegantes del Magallanes', 'Tigres de Aragua'  , 'José Bernardo Pérez'  , to_timestamp('2010/11/04 07:45 PM', 'YYYY/MM/DD HH12:MI AM')),
                ('Leones del Caracas'       , 'Tigres de Aragua'  , 'Universitario'        , to_timestamp('2010/11/06 06:00 PM', 'YYYY/MM/DD HH12:MI AM')),
                ('Navegantes del Magallanes', 'Leones del Caracas', 'José Bernardo Pérez'  , to_timestamp('2010/11/09 07:00 PM', 'YYYY/MM/DD HH12:MI AM'))
        ) as "Datos" ("equipo local", "equipo visitante", "estadio", "inicio")
WHERE
        "Datos"."equipo local"     = "Equipo local"."nombre"     AND
        "Datos"."equipo visitante" = "Equipo visitante"."nombre" AND
        "Datos"."estadio"          = "Estadio"."nombre";
