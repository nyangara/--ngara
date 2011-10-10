CREATE TABLE "Tipo de terreno" (
        "id"                    SERIAL                          NOT NULL,
        "nombre"                text                            NOT NULL,

        CONSTRAINT "Tipo de terreno PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Tipo de terreno UNIQUE nombre"
                UNIQUE ("nombre")
);

CREATE TABLE "Estadio" (
        "id"                    SERIAL                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "ciudad"                text                            NOT NULL,
        "estado"                text                            NOT NULL,
        "capacidad"             integer                         NOT NULL,
        "tipo de terreno"       integer                         NOT NULL,
        "año de fundación"      integer                         NOT NULL,

        CONSTRAINT "Estadio PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Estadio FOREIGN KEY tipo de terreno REFERENCES Tipo de terreno"
                FOREIGN KEY ("tipo de terreno")
                REFERENCES "Tipo de terreno" ("id")
);

CREATE TABLE "Equipo" (
        "id"                    SERIAL                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "año de fundación"      integer                         NOT NULL,
        "ciudad"                text                            NOT NULL,
        "estado"                text                            NOT NULL,
        "estadio principal"     integer                         NOT NULL,

        CONSTRAINT "Equipo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Equipo UNIQUE nombre"
                UNIQUE ("nombre"),

        CONSTRAINT "Equipo FOREIGN KEY estadio principal REFERENCES Estadio"
                FOREIGN KEY ("estadio principal")
                REFERENCES "Estadio" ("id")
);

CREATE TABLE "Jugador" (
        "id"                    SERIAL                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "fecha de nacimiento"   date                            NOT NULL,
        "lugar de procedencia"  text                            NOT NULL,

        CONSTRAINT "Jugador PRIMARY KEY"
                PRIMARY KEY ("id")
);

CREATE TABLE "Peso" (
        "jugador"               integer                         NOT NULL,
        "peso"                  real                            NOT NULL,
        "fecha"                 date                            NOT NULL,

        CONSTRAINT "Peso PRIMARY KEY"
                PRIMARY KEY ("jugador", "fecha")
);

CREATE TABLE "Altura" (
        "jugador"               integer                         NOT NULL,
        "altura"                real                            NOT NULL,
        "fecha"                 date                            NOT NULL,

        CONSTRAINT "Altura PRIMARY KEY"
                PRIMARY KEY ("jugador", "fecha")
);

CREATE TABLE "Juega" (
        "jugador"               integer                         NOT NULL,
        "equipo"                integer                         NOT NULL,
        "número"                integer                         NOT NULL,
        "inicio"                date                            NOT NULL,
        "fin"                   date                                NULL,

        CONSTRAINT "Juega PRIMARY KEY"
                PRIMARY KEY ("jugador", "equipo", "inicio"),

        CONSTRAINT "Juega FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Jugador" ("id"),

        CONSTRAINT "Juega FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Equipo" ("id")
);

CREATE TABLE "Juego" (
        "id"                    SERIAL                          NOT NULL,
        "inicio"                timestamp with time zone        NOT NULL,
        "equipo local"          integer                         NOT NULL,
        "equipo visitante"      integer                         NOT NULL,
        "estadio"               integer                         NOT NULL,

        CONSTRAINT "Juego PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Juego FOREIGN KEY equipo local REFERENCES Equipo"
                FOREIGN KEY ("equipo local")
                REFERENCES "Equipo" ("id"),

        CONSTRAINT "Juego FOREIGN KEY equipo visitante REFERENCES Equipo"
                FOREIGN KEY ("equipo visitante")
                REFERENCES "Equipo" ("id"),

        CONSTRAINT "Juego FOREIGN KEY estadio REFERENCES Estadio"
                FOREIGN KEY ("estadio")
                REFERENCES "Estadio" ("id")
);
