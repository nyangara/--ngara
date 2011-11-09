GRANT SELECT ON "Noticia" TO PUBLIC;
INSERT INTO "Noticia" ("urlimg", "titulo", "contenido","fecha")
VALUES
        ('./noti1.jpg'  , 'Titular Noticia 1', 'Este es el contenido de la noticia 1 y estamos probando que funcionen los links a otras paginas <a href="www.usb.ve">usb</a>','2011-11-02'),
        ('./noti2.jpg' , 'Titular Noticia 2', 'Bueno como que si funciono.. esta es la otra noticia.','2011-11-02'),
        ('./noti2.jpg' , 'Titular Noticia 4', 'El objetivo de esta noticia es chequear que tanto las noticias largas como el ordenamiento por fechas de los articulos esta funcionando coorrectamente.. Como no escribi suficiente a continuacion llenare este contenido de basura.. Comienza aaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbb ccccccccc ddddddddddddd eeeeeeeeeeeee ffffffffffffffff gggggggggggggggggggg hhhhhhhhhhhhhhhhhhhhhhh iiiiiiiiiiiiiiiiiiiiiiiiiiiiii jjjjjjjjjjjjjjjjjjjjjj kkkkkkkkkkkkkkkkkkkkkkk llllllllllllllllll mmmmmmmmmmmmmmmmmmmmmmmm nnnnnnnnnnnnnnnnn oooooooooooooooo ppppppppppp qqqqqqqqqqqqq rrrrrrrrr ssssssssssss tuvwxyz','2011-11-03'),
        ('./noti3.jpg' , 'Titular Noticia 3', 'Solo 8 personas de 40 pasaron el parcial de la teoria D:','2011-11-02');
