CREATE SCHEMA "Fantasy";

CREATE TABLE "Fantasy"."Estadio" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "ubicacion"             text                            NOT NULL,
        "propietario"           text                            NOT NULL default 'Desconocido',
        "capacidad"             integer                         NOT NULL,
        "medida_left_field"     integer                         NOT NULL default 0,
        "medida_center_field"   integer                         NOT NULL default 0,
        "medida_right_field"    integer                         NOT NULL default 0,		
        "tipo_terreno"          text                            NOT NULL,
        "fecha_fundacion"       date                            NOT NULL,
        "descripcion"           text                            NULL default 'DESCRIPCION',
        "foto"                  text                            NOT NULL default 'URL DE LA IMAGEN',

        CONSTRAINT "Estadio PRIMARY KEY"
                PRIMARY KEY ("id")
);

CREATE TABLE "Fantasy"."Equipo" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "siglas"                char(4)                         NOT NULL,
        "fecha_fundacion"       date                            NULL,
        "home"                  integer                         NOT NULL,
        "precio"                integer                         NOT NULL default 0,
        "logo"                  text                            NOT NULL default 'URL DEL LOGO',

        CONSTRAINT "Equipo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Equipo UNIQUE nombre"
                UNIQUE ("nombre"),

        CONSTRAINT "Equipo UNIQUE siglas"
                UNIQUE ("siglas"),

        CONSTRAINT "Equipo FOREIGN KEY home REFERENCES Estadio"
                FOREIGN KEY ("home")
                REFERENCES "Fantasy"."Estadio" ("id")
                ON DELETE RESTRICT
);

CREATE TABLE "Fantasy"."Jugador" (
        "id"                    serial                          NOT NULL,
        "nombres"               text                            NOT NULL,
        "apellidos"             text                            NOT NULL,
        "fecha_nacimiento"      date                                NULL,
        "posicion"              varchar(2)                      NOT NULL,
        "numero"                integer                             NULL,
        "precio"                integer                         NOT NULL default 0,
        "equipo"                integer                         NOT NULL,
        "errores"               integer                         NOT NULL default 0,
        "foto"                  text                            NOT NULL default 'URL DE FOTO DE JUGADOR',
		
        CONSTRAINT "Jugador PRIMARY KEY"
                PRIMARY KEY ("id"),
				
	CONSTRAINT "Jugador FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE RESTRICT
);

CREATE TABLE "Fantasy"."Roster" (
        "id"                    serial                          NOT NULL,
        "nombre"                text                            NOT NULL,
        "manager"               integer                         NOT NULL default 0,
        "fecha_creacion"        timestamp with time zone        NOT NULL,
        "equipo"                integer                         NULL,
        "fecha_compra_equipo"   timestamp with time zone        NULL,
        "fecha_venta_equipo"    timestamp with time zone        NULL,
        "precio_compra_equipo"  integer                         NULL,
        "equipo_activo"         boolean                         NULL,

        CONSTRAINT "Roster PRIMARY KEY"
                PRIMARY KEY ("id"),

        /*CONSTRAINT "Roster FOREIGN KEY manager REFERENCES Manager"
                FOREIGN KEY ("manager")
                REFERENCES "Fantasy"."Manager" ("usuario")
                ON DELETE CASCADE,*/

        CONSTRAINT "Roster FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE CASCADE
);

/*CREATE TABLE "Fantasy"."participa" (
       	"id"                    serial                          NOT NULL,
        "roster"                integer                         NOT NULL,
        "liga"                  integer                         NOT NULL,

	CONSTRAINT "participa PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "participa UNIQUE roster_liga"
                UNIQUE ("roster", "liga"),

        CONSTRAINT "participa FOREIGN KEY manager REFERENCES Roster"
                FOREIGN KEY ("roster")
                REFERENCES "Fantasy"."Manager" ("usuario")
                ON DELETE CASCADE,

        CONSTRAINT "participa FOREIGN KEY liga REFERENCES Liga"
                FOREIGN KEY ("liga")
                REFERENCES "Fantasy"."Liga" ("id")
                ON DELETE CASCADE
);*/

CREATE TABLE "Fantasy"."tiene" (
       	"id"                    serial                          NOT NULL,
        "roster"                integer                         NOT NULL,
        "jugador"               integer                         NOT NULL,
        "fecha_compra_jugador"  timestamp with time zone        NOT NULL,
        "fecha_venta_jugador"   timestamp with time zone        NULL,
        "precio_compra_jugador" integer                         NOT NULL,
        "jugador_activo"        boolean                         NOT NULL,
        "posicion_jugador"      varchar(2)                      NOT NULL,		

	CONSTRAINT "tiene PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "tiene UNIQUE roster_jugador"
                UNIQUE ("roster", "jugador"),

        CONSTRAINT "tiene UNIQUE roster_posicion_jugador"
                UNIQUE ("roster","posicion_jugador"),

        CONSTRAINT "tiene FOREIGN KEY roster REFERENCES Roster"
                FOREIGN KEY ("roster")
                REFERENCES "Fantasy"."Roster" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "tiene FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE		
);

CREATE TABLE "Fantasy"."Estadistica_Bateo" (
       	"id"                    serial                          NOT NULL,
        "jugador"   integer                                     NOT NULL,
        "fecha"     date                                        NOT NULL,
        "ci"        integer                                     NOT NULL,
        "ca"        integer                                     NOT NULL,
        "tb"        integer                                     NOT NULL,
        "br"        integer                                     NOT NULL,
        "bb"        integer                                     NOT NULL,
        "h"         integer                                     NULL,
        "k"         integer                                     NOT NULL,

	CONSTRAINT "Estadistica_Bateo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Estadistica_Bateo UNIQUE jugador_fecha"
                UNIQUE ("jugador", "fecha"),

        CONSTRAINT "Estadistica_Bateo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadistica_Pitcheo" (
       	"id"        serial				                        NOT NULL,
        "jugador"   integer                                     NOT NULL,
        "fecha"     date                                        NOT NULL,
        "el"        integer                                     NOT NULL,
        "cl"        integer                                     NOT NULL,
        "i"         integer                                     NOT NULL,
        "bb"        integer                                     NOT NULL,
        "k"         integer                                     NOT NULL,
        "jg"        integer                                     NOT NULL,

	CONSTRAINT "Estadistica_Pitcheo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Estadistica_Pitcheo UNIQUE jugador_fecha"
                UNIQUE ("jugador", "fecha"),

        CONSTRAINT "Estadistica_Pitcheo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);