INSERT INTO "Estadio" ("nombre", "ciudad", "estado", "capacidad") VALUES
        ('Alfonso "Chico" Carrasquel'   , 'Puerto La Cruz'      , 'Anzoátegui'          , 18000),
        ('Enzo Hernández'               , 'El Tigre'            , 'Anzoátegui'          ,  5762),
        ('Antonio Herrera Gutiérrez'    , 'Barquisimeto'        , 'Lara'                , 20450),
        ('José Pérez Colmenares'        , 'Maracay'             , 'Aragua'              , 15000),
        ('José Bernardo Pérez'          , 'Valencia'            , 'Carabobo'            , 15000),
        ('Luis Aparicio'                , 'Maracaibo'           , 'Zulia'               , 23000),
        ('Nueva Esparta'                , 'Porlamar'            , 'Nueva Esparta'       , 16000),
        ('Universitario'                , 'Caracas'             , 'Distrito Capital'    , 20763),
        ('La Ceiba'                     , 'Ciudad Guayana'      , 'Bolívar'             , 30000);

INSERT INTO "Equipo" ("nombre", "año de fundación", "ciudad", "estado", "estadio principal")
SELECT "Datos"."nombre", "Datos"."año de fundación", "Datos"."ciudad", "Datos"."estado", "Estadio"."id"
FROM
        "Estadio",
        (
                VALUES
                ('Águilas del Zulia'        , 1968, 'Maracaibo'     , 'Zulia'           , 'Luis Aparicio'             ),
                ('Bravos de Margarita'      , 2007, 'Porlamar'      , 'Nueva Esparta'   , 'Nueva Esparta'             ),
                ('Cardenales de Lara'       , 1942, 'Barquisimeto'  , 'Lara'            , 'Antonio Herrera Gutiérrez' ),
                ('Caribes de Anzoátegui'    , 1987, 'Puerto La Cruz', 'Anzoátegui'      , 'Alfonso "Chico" Carrasquel'),
                ('Leones del Caracas'       , 1952, 'Caracas'       , 'Distrito Capital', 'Universitario de Caracas'  ),
                ('Navegantes del Magallanes', 1917, 'Valencia'      , 'Carabobo'        , 'José Bernardo Pérez'       ),
                ('Tiburones de La Guaira'   , 1962, 'La Guaira'     , 'Vargas'          , 'Universitario'             ),
                ('Tigres de Aragua'         , 1965, 'Maracay'       , 'Aragua'          , 'José Pérez Colmenares'     )
        ) as "Datos" ("nombre", "año de fundación", "ciudad", "estado", "nombre del estadio principal")
WHERE "Datos"."nombre del estadio principal" = "Estadio"."nombre";
