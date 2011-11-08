INSERT INTO "Fantasy"."Estadio" ("nombre", "ciudad", "estado", "capacidad", "tipo de terreno", "año de fundación")
VALUES
        ('Alfonso "Chico" Carrasquel'   , 'Puerto La Cruz'      , 'Anzoátegui'          , 18000,        'grama',        1234),
        ('Enzo Hernández'               , 'El Tigre'            , 'Anzoátegui'          ,  5762,        'grama',        1234),
        ('Antonio Herrera Gutiérrez'    , 'Barquisimeto'        , 'Lara'                , 20450,        'grama',        1234),
        ('José Pérez Colmenares'        , 'Maracay'             , 'Aragua'              , 15000,        'grama',        1234),
        ('José Bernardo Pérez'          , 'Valencia'            , 'Carabobo'            , 15000,        'grama',        1234),
        ('Luis Aparicio'                , 'Maracaibo'           , 'Zulia'               , 23000,        'grama',        1234),
        ('Nueva Esparta'                , 'Porlamar'            , 'Nueva Esparta'       , 16000,        'grama',        1234),
        ('Universitario'                , 'Caracas'             , 'Distrito Capital'    , 20763,        'grama',        1234),
        ('La Ceiba'                     , 'Ciudad Guayana'      , 'Bolívar'             , 30000,        'grama',        1234);

INSERT INTO "Fantasy"."Equipo" ("nombre completo", "nombre corto", "siglas", "año de fundación", "ciudad", "estado", "estadio principal")
SELECT "Datos"."nombre completo", "Datos"."nombre corto", "Datos"."siglas", "Datos"."año de fundación", "Datos"."ciudad", "Datos"."estado", "Estadio"."id"
FROM
        "Fantasy"."Estadio",
        (VALUES
                ('Águilas del Zulia'        , 'Águilas'   , 'ZUL', 1968, 'Maracaibo'     , 'Zulia'           , 'Luis Aparicio'             ),
                ('Bravos de Margarita'      , 'Bravos'    , 'MAR', 2007, 'Porlamar'      , 'Nueva Esparta'   , 'Nueva Esparta'             ),
                ('Cardenales de Lara'       , 'Cardenales', 'LAR', 1942, 'Barquisimeto'  , 'Lara'            , 'Antonio Herrera Gutiérrez' ),
                ('Caribes de Anzoátegui'    , 'Caribes'   , 'CAR', 1987, 'Puerto La Cruz', 'Anzoátegui'      , 'Alfonso "Chico" Carrasquel'),
                ('Leones del Caracas'       , 'Leones'    , 'LEO', 1952, 'Caracas'       , 'Distrito Capital', 'Universitario'             ),
                ('Navegantes del Magallanes', 'Navegantes', 'NAV', 1917, 'Valencia'      , 'Carabobo'        , 'José Bernardo Pérez'       ),
                ('Tiburones de La Guaira'   , 'Tiburones' , 'TIB', 1962, 'La Guaira'     , 'Vargas'          , 'Universitario'             ),
                ('Tigres de Aragua'         , 'Tigres'    , 'TIG', 1965, 'Maracay'       , 'Aragua'          , 'José Pérez Colmenares'     )
        ) as "Datos" ("nombre completo", "nombre corto", "siglas", "año de fundación", "ciudad", "estado", "nombre del estadio principal")
WHERE "Datos"."nombre del estadio principal" = "Estadio"."nombre";
