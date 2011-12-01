INSERT INTO "Fantasy"."Estadio" (
        "nombre",
        "ciudad",
        "estado",
        "capacidad",
        "año de fundación",
        "tipo de terreno",
        "medida del left field",
        "medida del center field",
        "medida del right field",
        "URL de la foto",
        "descripción"
) VALUES
        ('Alfonso "Chico" Carrasquel'      , 'Puerto La Cruz', 'Anzoátegui'      , 18000, 1991, 'grama artificial', NULL, NULL, NULL, NULL               , NULL),
        ('Antonio Herrera Gutiérrez'       , 'Barquisimeto'  , 'Lara'            , 22000, 1969, 'grama'           , NULL, NULL, NULL, NULL               , NULL),
        ('Bachiller Julio Hernández Molina', 'Araure'        , 'Portuguesa'      , 12000, 1967, 'grama'           ,  333,  383,  333, NULL               , NULL),
        ('Enzo Hernández'                  , 'El Tigre'      , 'Anzoátegui'      ,  5762, 2006, 'grama artificial',  330,  405,  330, NULL               , NULL),
        ('José Bernardo Pérez'             , 'Valencia'      , 'Carabobo'        , 15000, 1955, 'grama'           , NULL, NULL, NULL, 'JoseBernardo.jpg' , NULL),
        ('José Pérez Colmenares'           , 'Maracay'       , 'Aragua'          , 12647, 1965, 'grama'           ,  348,  384,  348, NULL               , NULL),
        ('La Ceiba'                        , 'Ciudad Guayana', 'Bolívar'         , 30000, 1998, 'grama'           , NULL, NULL, NULL, NULL               , NULL),
        ('Luis Aparicio "El Grande"'       , 'Maracaibo'     , 'Zulia'           , 23900, 1963, 'grama'           , NULL, NULL, NULL, NULL               , NULL),
        ('Metropolitano de San Cristóbal'  , 'San Cristóbal' , 'Táchira'         , 22000, 2005, 'grama'           , NULL, NULL, NULL, NULL               , NULL),
        ('Nueva Esparta'                   , 'Porlamar'      , 'Nueva Esparta'   , 16100, 1990, 'grama'           , NULL, NULL, NULL, NULL               , NULL),
        ('Universitario'                   , 'Caracas'       , 'Distrito Capital', 23700, 1951, 'grama'           ,  347,  385,  347, 'Universitario.jpg', NULL);

INSERT INTO "Fantasy"."Equipo" (
        "nombre completo",
        "nombre corto",
        "siglas",
        "año de fundación",
        "ciudad",
        "estado",
        "estadio principal",
        "URL del logo"
) SELECT
        "Datos"."nombre completo",
        "Datos"."nombre corto",
        "Datos"."siglas",
        "Datos"."año de fundación",
        "Datos"."ciudad",
        "Datos"."estado",
        "Estadio"."id",
        "Datos"."URL del logo"
FROM
        "Fantasy"."Estadio",
        (VALUES
                ('Águilas del Zulia'        , 'Águilas'   , 'ZUL', 1968, 'Maracaibo'     , 'Zulia'           , 'Luis Aparicio "El Grande"' , 'aguilas.jpg'),
                ('Bravos de Margarita'      , 'Bravos'    , 'MAR', 2007, 'Porlamar'      , 'Nueva Esparta'   , 'Nueva Esparta'             , NULL),
                ('Cardenales de Lara'       , 'Cardenales', 'LAR', 1942, 'Barquisimeto'  , 'Lara'            , 'Antonio Herrera Gutiérrez' , NULL),
                ('Caribes de Anzoátegui'    , 'Caribes'   , 'CAR', 1987, 'Puerto La Cruz', 'Anzoátegui'      , 'Alfonso "Chico" Carrasquel', NULL),
                ('Leones del Caracas'       , 'Leones'    , 'LEO', 1952, 'Caracas'       , 'Distrito Capital', 'Universitario'             , 'leones.jpg'),
                ('Navegantes del Magallanes', 'Navegantes', 'NAV', 1917, 'Valencia'      , 'Carabobo'        , 'José Bernardo Pérez'       , 'magallanes.jpg'),
                ('Tiburones de La Guaira'   , 'Tiburones' , 'TIB', 1962, 'La Guaira'     , 'Vargas'          , 'Universitario'             , 'tiburones.jpg'),
                ('Tigres de Aragua'         , 'Tigres'    , 'TIG', 1965, 'Maracay'       , 'Aragua'          , 'José Pérez Colmenares'     , NULL)
        ) as "Datos" ("nombre completo", "nombre corto", "siglas", "año de fundación", "ciudad", "estado", "nombre del estadio principal", "URL del logo")
WHERE "Datos"."nombre del estadio principal" = "Estadio"."nombre";
