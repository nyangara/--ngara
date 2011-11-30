CREATE TYPE "tipo de terreno" AS ENUM (
        'tierra',
        'grama',
        'grama artificial'
);

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

CREATE TYPE "género" AS ENUM (
        'masculino',
        'femenino',
        'otro'
);
