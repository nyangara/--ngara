INSERT INTO "Fantasy"."Jugador" ("nombre completo", "fecha de nacimiento", "lugar de procedencia")
VALUES
        ('Fabiana Reggio'  , '1990/01/02', 'San Antonio, Venezuela'),
        ('Krisvely Varela' , '1990/03/04', 'Caracas, Venezuela'    ),
        ('Miguel Ambrosio' , '1988/05/06', 'Caracas, Venezuela'    ),
        ('Ricardo Monascal', '1846/08/12', 'San Antonio, Venezuela');



INSERT INTO "Fantasy"."Juega" ("jugador", "equipo", "número", "inicio", "fin")
SELECT
        "Fantasy"."Jugador"."id",
        "Fantasy"."Equipo"."id",
        "Datos"."número",
        to_date("Datos"."inicio", 'YYYY/MM/DD'),
        to_date("Datos"."fin"   , 'YYYY/MM/DD')
FROM
        "Fantasy"."Jugador",
        "Fantasy"."Equipo",
        (VALUES
                ('Fabiana Reggio'  ,  'Tigres de Aragua'         , 12, '2007/09/17', '2009/04/12'),
                ('Fabiana Reggio'  ,  'Navegantes del Magallanes', 12, '2009/09/03', NULL        ),
                ('Krisvely Varela' ,  'Navegantes del Magallanes', 34, '2007/09/17', NULL        ),
                ('Ricardo Monascal',  'Leones del Caracas'       , 12, '2003/09/22', NULL        ),
                ('Miguel Ambrosio' ,  'Navegantes del Magallanes', 45, '2005/09/19', NULL        )
        ) as "Datos" ("jugador", "equipo", "número", "inicio", "fin")
WHERE "Datos"."jugador" = "Fantasy"."Jugador"."nombre completo" AND "Datos"."equipo" = "Fantasy"."Equipo"."nombre completo";



INSERT INTO "Fantasy"."Juego" ("inicio", "equipo local", "equipo visitante", "estadio")
SELECT
        to_timestamp("Datos"."inicio", 'YYYY/MM/DD HH12:MI AM'),
        "Equipo local"."id",
        "Equipo visitante"."id",
        "Estadio"."id"
FROM
        "Fantasy"."Equipo" AS "Equipo local",
        "Fantasy"."Equipo" AS "Equipo visitante",
        "Fantasy"."Estadio",
        (VALUES
                ('Tigres de Aragua'         , 'Leones del Caracas', 'José Pérez Colmenares', '2010/11/03 06:30 PM'),
                ('Navegantes del Magallanes', 'Tigres de Aragua'  , 'José Bernardo Pérez'  , '2010/11/04 07:45 PM'),
                ('Leones del Caracas'       , 'Tigres de Aragua'  , 'Universitario'        , '2010/11/06 06:00 PM'),
                ('Navegantes del Magallanes', 'Leones del Caracas', 'José Bernardo Pérez'  , '2010/11/09 07:00 PM')
        ) as "Datos" ("equipo local", "equipo visitante", "estadio", "inicio")
WHERE
        "Datos"."equipo local"     = "Equipo local"."nombre completo"     AND
        "Datos"."equipo visitante" = "Equipo visitante"."nombre completo" AND
        "Datos"."estadio"          = "Fantasy"."Estadio"."nombre";



INSERT INTO "Fantasy"."Noticia" ("fecha", "URL de imagen", "título", "contenido")
VALUES
        (to_timestamp('2011/11/02', 'YYYY/MM/DD'), './noti1.jpg' , 'Titular Noticia 1', 'Ut tristique, erat ut ornare pretium, nisl lectus consectetur dui, commodo aliquam neque nunc eu ipsum. Praesent iaculis ante velit. Maecenas eget vestibulum ipsum. Pellentesque a turpis ipsum. Sed quis mi turpis. In nec imperdiet orci. Cras euismod facilisis nunc, ultrices aliquam libero pulvinar vel. Duis magna justo, tempus quis hendrerit ut, congue vitae ipsum. Quisque rutrum pretium augue, eu placerat velit suscipit at. Suspendisse accumsan commodo erat eget placerat. Sed eget pharetra dolor. Curabitur porta lorem quis turpis fringilla ullamcorper. Phasellus faucibus lacinia magna, sit amet bibendum purus semper imperdiet. Sed hendrerit adipiscing neque, eget feugiat arcu auctor sed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;'),
        (to_timestamp('2011/11/02', 'YYYY/MM/DD'), './noti2.jpg' , 'Titular Noticia 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium dolor ac dolor ullamcorper sed scelerisque est aliquet. Nulla varius cursus odio non mattis. Phasellus bibendum porttitor massa, quis tristique dui interdum sit amet. Vestibulum nec turpis id ligula commodo tempor at eget magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur molestie mattis libero, in ultricies metus varius eu. Curabitur pulvinar ipsum ut nunc pellentesque nec vehicula arcu gravida. Donec at volutpat mi. Suspendisse vitae massa metus, in iaculis nisi. Vestibulum accumsan sapien in sapien mattis iaculis. Quisque faucibus lobortis enim, eget rutrum nisl imperdiet ac.'),
        (to_timestamp('2011/11/03', 'YYYY/MM/DD'), './noti2.jpg' , 'Titular Noticia 3', 'Aenean magna sem, congue et convallis ac, porttitor ac diam. Etiam gravida vulputate metus, non sollicitudin odio commodo ac. Nullam pulvinar dapibus iaculis. Vivamus non enim eros. Suspendisse tincidunt metus vel libero dictum sit amet dignissim lectus dapibus. Quisque aliquam feugiat risus, et pharetra lacus vestibulum a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In vulputate felis sit amet odio posuere ac cursus dolor blandit.'),
        (to_timestamp('2011/11/10', 'YYYY/MM/DD'), './noti3.jpg' , 'Titular Noticia 4', 'Morbi adipiscing eleifend arcu ac sodales. Donec vulputate fermentum elementum. Sed vehicula, ipsum sit amet sollicitudin vestibulum, erat ipsum fringilla enim, nec venenatis arcu velit eget velit. Duis sed tortor tortor. Etiam aliquam, lorem et iaculis elementum, metus nulla posuere urna, sit amet porta urna quam semper massa. Nunc convallis, purus mollis interdum auctor, tortor odio lacinia felis, ut suscipit metus mauris eu lorem. Duis pulvinar enim sit amet felis pretium fringilla. Aliquam erat volutpat. Ut dui dui, aliquam non ultrices sit amet, ultrices at elit. Phasellus ultrices fermentum interdum. Donec sit amet iaculis nibh. Donec dictum lectus vel tortor malesuada laoreet. Vestibulum suscipit felis ut felis iaculis iaculis accumsan metus viverra. Morbi egestas volutpat nunc a ullamcorper. Mauris non ipsum sem.<br/>Quisque pellentesque sagittis pretium. Duis quam nulla, aliquet et tincidunt sit amet, fermentum ut mi. Integer egestas elementum lacus ac lobortis. Donec vel justo eget leo convallis malesuada. Fusce venenatis imperdiet lacus, eu convallis tellus feugiat quis. Pellentesque sapien est, posuere in vehicula ut, egestas quis erat. Aenean neque mi, bibendum id tincidunt sit amet, scelerisque ut turpis. Fusce id nisi non felis luctus sollicitudin id ac enim.<br/>Pellentesque hendrerit risus ut sapien pretium tempus. Donec auctor semper consequat. Sed dolor felis, commodo ut elementum consequat, gravida eget odio. Morbi porttitor molestie egestas. Fusce aliquam fringilla purus, sed hendrerit ligula suscipit eget. Cras quis tortor augue. Sed tincidunt mi a leo sollicitudin blandit ut varius nunc. Suspendisse convallis ullamcorper enim, in posuere enim scelerisque quis. Sed ac ligula eget eros accumsan adipiscing. Nulla placerat iaculis lectus, ut blandit nisi porttitor vitae.');
