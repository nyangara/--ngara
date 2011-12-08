CREATE TYPE "tipo de terreno" AS ENUM (
        'tierra',
        'grama',
        'grama artificial'
);

/*
CREATE TYPE "posición" AS ENUM (
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
CREATE TYPE "posición" AS ENUM (
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

CREATE TYPE "género" AS ENUM (
        'masculino',
        'femenino',
        'otro'
);

CREATE TYPE "estado de juego" AS ENUM (
        'pautado',
        'ocurrido'
);

CREATE TYPE "tipo de contenido" AS ENUM (
        'noticia',
        'regla',
        'pregunta frecuente',
        'información'
);
