CREATE TABLE "Estadio" (
        "id"                    SERIAL                  NOT NULL,
        "nombre"                text                    NOT NULL,
        "ciudad"                text                    NOT NULL,
        "estado"                text                    NOT NULL,
        "capacidad"             integer                 NOT NULL,

        CONSTRAINT "Estadio PRIMARY KEY"
                PRIMARY KEY ("id")
);

CREATE TABLE "Equipo" (
        "id"                    SERIAL                  NOT NULL,
        "nombre"                varchar                 NOT NULL,
        "año de fundación"      integer                 NOT NULL,
        "ciudad"                text                    NOT NULL,
        "estado"                text                    NOT NULL,
        "estadio principal"     integer                 NOT NULL,

        CONSTRAINT "Equipo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Equipo UNIQUE nombre"
                UNIQUE ("nombre"),

        CONSTRAINT "Equipo FOREIGN KEY estadio principal REFERENCES Estadio"
                FOREIGN KEY ("estadio principal")
                REFERENCES "Estadio" ("id")
);

CREATE TABLE "Jugador" (
        "id"                    SERIAL                  NOT NULL,
        "nombre"                text                    NOT NULL,
        "equipo"                integer                 NOT NULL,
        "número"                integer                 NOT NULL,

        CONSTRAINT "Jugador PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Jugador FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Equipo" ("id")
);

CREATE TABLE "Juego" (
        "id"                    SERIAL                  NOT NULL,
        "fecha"                 date                    NOT NULL,
        "hora de inicio"        time with time zone     NOT NULL,
        "equipo local"          integer                 NOT NULL,
        "equipo visitante"      integer                 NOT NULL,
        "estadio"               integer                 NOT NULL,

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
