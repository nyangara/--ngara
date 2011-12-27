CREATE TYPE "Fantasy"."tipo de terreno" AS ENUM (
        'tierra',
        'grama',
        'grama artificial'
);

/*
CREATE TYPE "Fantasy"."posición" AS ENUM (
        'pitcher',
        'catcher',
        'primera base',
        'segunda base',
        'tercera base',
        'campo corto',
        'jardinero izquierdo',
        'jardinero central',
        'jardinero derecho'
);
*/
CREATE TYPE "Fantasy"."posición" AS ENUM (
        'P',
        'C',
        '1B',
        '2B',
        '3B',
        'SS',
        'LF',
        'CF',
        'RF'
);

CREATE TYPE "Fantasy"."género" AS ENUM (
        'masculino',
        'femenino',
        'otro'
);

CREATE TYPE "Fantasy"."estado de juego" AS ENUM (
        'pautado',
        'ocurrido'
);

CREATE TYPE "Fantasy"."tipo de contenido" AS ENUM (
        'noticia',
        'regla',
        'pregunta frecuente',
        'información'
);
