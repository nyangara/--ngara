CREATE TABLE "Fantasy"."Usuario" (
        "id"                            serial                          NOT NULL,
        "username"                      text                            NOT NULL,
        "nombre completo"               text                            NOT NULL,
        "género"                        "género"                            NULL,
        "fecha de nacimiento"           date                                NULL,
        "es administrador"              boolean                         NOT NULL,
        "dirección de e-mail"           text                            NOT NULL,
        "URL del avatar"                text                                NULL,

        CONSTRAINT "Usuario PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Usuario UNIQUE e-mail"
                UNIQUE ("dirección de e-mail"),

        CONSTRAINT "Usuario UNIQUE username"
                UNIQUE ("username")
);

-- No tocar nada de esta tabla.
-- Nadie debe tener permisos sobre esta tabla ni sus columnas.
-- Hacer todo a través de funciones seguras.
CREATE TABLE "Fantasy"."passwd" (
        "usuario"                       integer                         NOT NULL,
        "password"                      password                        NOT NULL,

        CONSTRAINT "passwd PRIMARY KEY"
                PRIMARY KEY ("usuario"),

        CONSTRAINT "passwd FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Liga" (
        "id"                            serial                          NOT NULL,
        "nombre"                        text                            NOT NULL,
        "creador"                       integer                         NOT NULL,
        "es pública"                    bool                            NOT NULL,

        CONSTRAINT "Liga PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Liga UNIQUE nombre, creador"
                UNIQUE ("nombre", "creador"),

        CONSTRAINT "Liga FOREIGN KEY creador REFERENCES Usuario"
                FOREIGN KEY ("creador")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Participa" (
        "usuario"                       integer                         NOT NULL,
        "liga"                          integer                         NOT NULL,

        CONSTRAINT "Participa PRIMARY KEY"
                PRIMARY KEY ("usuario", "liga"),

        CONSTRAINT "Participa FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Participa FOREIGN KEY liga REFERENCES Liga"
                FOREIGN KEY ("liga")
                REFERENCES "Fantasy"."Liga" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadio" (
        "id"                            serial                          NOT NULL,
        "nombre"                        text                            NOT NULL,
        "ciudad"                        text                                NULL,
        "estado"                        text                                NULL,
        "capacidad"                     integer                             NULL,
        "año de fundación"              integer                             NULL,
        "tipo de terreno"               "tipo de terreno"                   NULL,
        "propietario"                   text                                NULL,
        "medida del left field"         integer                             NULL,
        "medida del center field"       integer                             NULL,
        "medida del right field"        integer                             NULL,
        "descripción"                   text                                NULL,
        "URL de la foto"                text                                NULL,

        CONSTRAINT "Estadio PRIMARY KEY"
                PRIMARY KEY ("id")
);

CREATE TABLE "Fantasy"."Equipo" (
        "id"                            serial                          NOT NULL,
        "nombre completo"               text                            NOT NULL,
        "nombre corto"                  text                            NOT NULL,
        "siglas"                        char(3)                         NOT NULL,
        "año de fundación"              integer                             NULL,
        "ciudad"                        text                                NULL,
        "estado"                        text                                NULL,
        "estadio principal"             integer                         NOT NULL,
        "URL del logo"                  text                                NULL,

        CONSTRAINT "Equipo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Equipo UNIQUE nombre completo"
                UNIQUE ("nombre completo"),

        CONSTRAINT "Equipo UNIQUE nombre corto"
                UNIQUE ("nombre corto"),

        CONSTRAINT "Equipo UNIQUE siglas"
                UNIQUE ("siglas"),

        CONSTRAINT "Equipo FOREIGN KEY estadio principal REFERENCES Estadio"
                FOREIGN KEY ("estadio principal")
                REFERENCES "Fantasy"."Estadio" ("id")
                ON DELETE RESTRICT
);

CREATE TABLE "Fantasy"."Jugador" (
        "id"                            serial                          NOT NULL,
        "nombre completo"               text                            NOT NULL,
        "fecha de nacimiento"           date                                NULL,
        "lugar de procedencia"          text                                NULL,
        "URL de la foto"                text                                NULL,
        "equipo"                        integer                         NOT NULL,
        "número"                        integer                         NOT NULL,
        "posición"                      "posición"                      NOT NULL,
        "precio"                        integer                         NOT NULL,

        CONSTRAINT "Jugador PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Jugador UNIQUE (equipo, número)"
                UNIQUE ("equipo", "número"),

        CONSTRAINT "Jugador FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Roster" (
        "id"                            serial                          NOT NULL,
        "nombre"                        text                            NOT NULL,
        "usuario"                       integer                         NOT NULL,
        "liga"                          integer                         NOT NULL,
        "puntaje"                       integer                             NULL,
        "fecha de creación"             timestamp with time zone        NOT NULL,

        CONSTRAINT "Roster PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Roster UNIQUE (usuario, liga)"
                UNIQUE ("usuario", "liga"),

        CONSTRAINT "Roster FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Roster FOREIGN KEY liga REFERENCES Liga"
                FOREIGN KEY ("liga")
                REFERENCES "Fantasy"."Liga" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Contenido de roster" (
        "roster"                        integer                         NOT NULL,
        "jugador"                       integer                         NOT NULL,
        "fecha de compra"               timestamp with time zone        NOT NULL,
        "fecha de venta"                timestamp with time zone            NULL,

        CONSTRAINT "Contenido de roster PRIMARY KEY"
                PRIMARY KEY ("roster", "jugador"),

        CONSTRAINT "Contenido de roster FOREIGN KEY roster REFERENCES Roster"
                FOREIGN KEY ("roster")
                REFERENCES "Fantasy"."Roster" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Contenido de roster FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Juego" (
        "id"                            serial                          NOT NULL,
        "inicio"                        timestamp with time zone        NOT NULL,
        "equipo local"                  integer                         NOT NULL,
        "equipo visitante"              integer                         NOT NULL,
        "estadio"                       integer                         NOT NULL,
        "carreras del equipo local"     integer                             NULL,
        "carreras del equipo visitante" integer                             NULL,
        "hits del equipo local"         integer                             NULL,
        "hits del equipo visitante"     integer                             NULL,
        "errores del equipo local"      integer                             NULL,
        "errores del equipo visitante"  integer                             NULL,

        CONSTRAINT "Juego PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Juego UNIQUE (inicio, estadio)"
                UNIQUE ("inicio", "estadio"),

        CONSTRAINT "Juego FOREIGN KEY equipo local REFERENCES Equipo"
                FOREIGN KEY ("equipo local")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Juego FOREIGN KEY equipo visitante REFERENCES Equipo"
                FOREIGN KEY ("equipo visitante")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Juego FOREIGN KEY estadio REFERENCES Estadio"
                FOREIGN KEY ("estadio")
                REFERENCES "Fantasy"."Estadio" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadística de bateo" (
        "jugador"                       integer                         NOT NULL,
        "juego"                         integer                         NOT NULL,
        "carreras impulsadas"           integer                         NOT NULL,
        "carreras anotadas"             integer                         NOT NULL,
        "total de bases"                integer                         NOT NULL,
        "bases robadas"                 integer                         NOT NULL,
        "bases por bola"                integer                         NOT NULL,
        "strike outs"                   integer                         NOT NULL,
        "hits"                          integer                         NOT NULL,

        CONSTRAINT "Estadística de bateo PRIMARY KEY"
                PRIMARY KEY ("jugador", "juego"),

        CONSTRAINT "Estadística de bateo FOREIGN KEY juego REFERENCES Juego"
                FOREIGN KEY ("juego")
                REFERENCES "Fantasy"."Juego" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Estadística de bateo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadística de pitcheo" (
        "jugador"                       integer                         NOT NULL,
        "juego"                         integer                         NOT NULL,
        "entradas lanzadas"             integer                         NOT NULL,
        "juegos ganados"                integer                         NOT NULL,
        "carreras limpias"              integer                         NOT NULL,
        "imparables"                    integer                         NOT NULL,
        "bases por bola"                integer                         NOT NULL,
        "strike outs"                   integer                         NOT NULL,

        CONSTRAINT "Estadística de pitcheo PRIMARY KEY"
                PRIMARY KEY ("jugador", "juego"),

        CONSTRAINT "Estadística de pitcheo FOREIGN KEY juego REFERENCES Juego"
                FOREIGN KEY ("juego")
                REFERENCES "Fantasy"."Juego" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Estadística de pitcheo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Juega" (
        "jugador"                       integer                         NOT NULL,
        "equipo"                        integer                         NOT NULL,
        "número"                        integer                         NOT NULL,
        "inicio"                        date                            NOT NULL,
        "fin"                           date                                NULL,

        CONSTRAINT "Juega PRIMARY KEY"
                PRIMARY KEY ("jugador", "equipo", "inicio"),

        CONSTRAINT "Juega FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Juega FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Noticia" (
        "id"                            serial                          NOT NULL,
        "título"                        text                            NOT NULL,
        "contenido"                     text                            NOT NULL,
        "fecha"                         timestamp with time zone        NOT NULL,
        "URL de imagen"                 text                                NULL,
        "tags"                          text                                NULL,

        CONSTRAINT "Noticia PRIMARY KEY"
                PRIMARY KEY ("id")
);
