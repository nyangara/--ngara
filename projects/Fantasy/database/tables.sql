CREATE TABLE "Fantasy"."Usuario" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "nombre completo"       text                            NOT NULL,
        "género"                "género"                            NULL,
        "fecha de nacimiento"   date                                NULL,
        "es administrador"      bool                            NOT NULL,

        CONSTRAINT "Usuario PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Usuario UNIQUE nombre"
                UNIQUE ("nombre")
);

CREATE TABLE "Fantasy"."passwd" (
        "usuario"               integer                         NOT NULL,
        "password"              password                        NOT NULL,

        CONSTRAINT "passwd PRIMARY KEY"
                PRIMARY KEY ("usuario"),

        CONSTRAINT "passwd FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE RESTRICT
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
        "fecha de nacimiento"   date                            NOT NULL,
        "lugar de procedencia"  text                            NOT NULL,

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
