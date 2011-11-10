CREATE TABLE "Fantasy"."Usuario" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "nombre completo"       text                            NOT NULL,
        "género"                "género"                            NULL,
        "fecha de nacimiento"   date                                NULL,

        CONSTRAINT "Usuario PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Usuario UNIQUE nombre"
                UNIQUE ("nombre")
);

CREATE TABLE "Fantasy"."Manager" (
        "id"               integer                         NOT NULL,

        CONSTRAINT "Manager PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Manager FOREIGN KEY id REFERENCES Usuario"
                FOREIGN KEY ("id")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Administrador" (
        "usuario"               integer                         NOT NULL,

        CONSTRAINT "Administrador PRIMARY KEY"
                PRIMARY KEY ("usuario"),

        CONSTRAINT "Administrador FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE
);

-- No tocar nada de esta tabla.
-- Nadie debe tener permisos sobre esta tabla ni sus columnas.
-- Hacer todo a través de funciones seguras.
CREATE TABLE "Fantasy"."passwd" (
        "usuario"               integer                         NOT NULL,
        "password"              password                        NOT NULL,

        CONSTRAINT "passwd PRIMARY KEY"
                PRIMARY KEY ("usuario"),

        CONSTRAINT "passwd FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Liga" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "creador"               integer                         NOT NULL,
        "es pública"            bool                            NOT NULL,

        CONSTRAINT "Liga PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Liga FOREIGN KEY creador REFERENCES Manager"
                FOREIGN KEY ("creador")
                REFERENCES "Fantasy"."Manager" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Participa" (
        "manager"               integer                         NOT NULL,
        "liga"                  integer                         NOT NULL,

        CONSTRAINT "Participa PRIMARY KEY"
                PRIMARY KEY ("manager", "liga"),

        CONSTRAINT "Participa FOREIGN KEY manager REFERENCES Manager"
                FOREIGN KEY ("manager")
                REFERENCES "Fantasy"."Manager" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Participa FOREIGN KEY liga REFERENCES Liga"
                FOREIGN KEY ("liga")
                REFERENCES "Fantasy"."Liga" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadio" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "ciudad"                text                            NOT NULL,
        "estado"                text                            NOT NULL,
        "capacidad"             integer                         NOT NULL,
        "tipo de terreno"       "tipo de terreno"               NOT NULL,
        "año de fundación"      integer                         NOT NULL,

        CONSTRAINT "Estadio PRIMARY KEY"
                PRIMARY KEY ("id")
);

CREATE TABLE "Fantasy"."Equipo" (
        "id"                    serial                          NOT NULL,
        "nombre completo"       text                            NOT NULL,
        "nombre corto"          text                            NOT NULL,
        "siglas"                char(3)                         NOT NULL,
        "año de fundación"      integer                         NOT NULL,
        "ciudad"                text                            NOT NULL,
        "estado"                text                            NOT NULL,
        "estadio principal"     integer                         NOT NULL,

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
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "fecha de nacimiento"   date                                NULL,
        "lugar de procedencia"  text                                NULL,

        CONSTRAINT "Jugador PRIMARY KEY"
                PRIMARY KEY ("id")
);

CREATE TABLE "Fantasy"."Peso" (
        "jugador"               integer                         NOT NULL,
        "peso"                  real                            NOT NULL,
        "fecha"                 date                            NOT NULL,

        CONSTRAINT "Peso PRIMARY KEY"
                PRIMARY KEY ("jugador", "fecha"),

        CONSTRAINT "Juega FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Altura" (
        "jugador"               integer                         NOT NULL,
        "altura"                real                            NOT NULL,
        "fecha"                 date                            NOT NULL,

        CONSTRAINT "Altura PRIMARY KEY"
                PRIMARY KEY ("jugador", "fecha"),

        CONSTRAINT "Juega FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Roster" (
        "id"                    serial                          NOT NULL,
        "manager"               integer                         NOT NULL,
        "liga"                  integer                         NOT NULL,
        "nombre"                text                                NULL,
        "puntos"                integer                             NULL,
        "fecha de creación"     timestamp with time zone        NOT NULL,

        CONSTRAINT "Roster PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Roster UNIQUE (manager, liga)"
                UNIQUE ("manager", "liga"),

        CONSTRAINT "Roster FOREIGN KEY manager REFERENCES Manager"
                FOREIGN KEY ("manager")
                REFERENCES "Fantasy"."Manager" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Roster FOREIGN KEY liga REFERENCES Liga"
                FOREIGN KEY ("liga")
                REFERENCES "Fantasy"."Liga" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Contenido de roster" (
        "roster"                integer                         NOT NULL,
        "jugador"               integer                         NOT NULL,
        "fecha de compra"       timestamp with time zone        NOT NULL,
        "fecha de venta"        timestamp with time zone            NULL,

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

CREATE TABLE "Fantasy"."Estadística de bateo" (
        "jugador"   integer                                     NOT NULL,
        "fecha"     date                                        NOT NULL,
        "ci"        integer                                     NOT NULL,
        "ca"        integer                                     NOT NULL,
        "tb"        integer                                     NOT NULL,
        "br"        integer                                     NOT NULL,
        "bb"        integer                                     NOT NULL,
        "k"         integer                                     NOT NULL,
        "e"         integer                                     NOT NULL,

        CONSTRAINT "Estadística de bateo PRIMARY KEY"
                PRIMARY KEY ("jugador", "fecha"),

        CONSTRAINT "Estadística de bateo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadística de pitcheo" (
        "jugador"   integer                                     NOT NULL,
        "fecha"     date                                        NOT NULL,
        "sl"        integer                                     NOT NULL,
        "cl"        integer                                     NOT NULL,
        "i"         integer                                     NOT NULL,
        "bb"        integer                                     NOT NULL,
        "k"         integer                                     NOT NULL,
        "jg"        integer                                     NOT NULL,

        CONSTRAINT "Estadística de pitcheo PRIMARY KEY"
                PRIMARY KEY ("jugador", "fecha"),

        CONSTRAINT "Estadística de pitcheo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Juega" (
        "jugador"               integer                         NOT NULL,
        "equipo"                integer                         NOT NULL,
        "número"                integer                         NOT NULL,
        "inicio"                date                            NOT NULL,
        "fin"                   date                                NULL,

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

CREATE TABLE "Fantasy"."Juego" (
        "id"                    serial                          NOT NULL,
        "inicio"                timestamp with time zone        NOT NULL,
        "equipo local"          integer                         NOT NULL,
        "equipo visitante"      integer                         NOT NULL,
        "estadio"               integer                         NOT NULL,

        CONSTRAINT "Juego PRIMARY KEY"
                PRIMARY KEY ("id"),

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
