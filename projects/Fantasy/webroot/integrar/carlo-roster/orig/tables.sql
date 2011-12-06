CREATE SCHEMA "Fantasy";

CREATE TABLE "Fantasy"."Usuario" (
        "id"                    serial                          NOT NULL,
		"username"              text                            NOT NULL,
		"password"              text                            NOT NULL,
		
		CONSTRAINT "Usuario PRIMARY KEY"
                PRIMARY KEY ("id"),

		CONSTRAINT "Usuario UNIQUE username"
                UNIQUE ("username")				
);

CREATE TABLE "Fantasy"."Perfil_Usuario" (
        "id"                    serial                          NOT NULL,
		"nombres"               text                            NOT NULL,
		"apellidos"             text                            NOT NULL,
		"email"                 text                            NOT NULL,
		"avatar"                text                            NOT NULL,
		"usuario"               integer                         NOT NULL,
		
		CONSTRAINT "Perfil_Usuario PRIMARY KEY"
                PRIMARY KEY ("id"),
		
		CONSTRAINT "Perfil_Usuario UNIQUE usuario"
                UNIQUE ("usuario"),

        CONSTRAINT "Perfil_Usuario FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE RESTRICT
);

CREATE TABLE "Fantasy"."Manager" (
        "id"                    serial                          NOT NULL,
		"creditos"              integer                         NOT NULL DEFAULT 0,
		"puntaje"               integer                         NOT NULL DEFAULT 0,
		"usuario"               integer                         NOT NULL,
		
		CONSTRAINT "Manager PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Manager FOREIGN KEY usuario REFERENCES Usuario"
                FOREIGN KEY ("usuario")
                REFERENCES "Fantasy"."Usuario" ("id")
                ON DELETE RESTRICT		
);

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
        "posicion"              varchar(2)                      NOT NULL,
        "precio"                integer                         NOT NULL default 0,
        "equipo"                integer                         NOT NULL,
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
        "manager"               integer                         NOT NULL,
        "fecha_creacion"        timestamp with time zone        NOT NULL,

        CONSTRAINT "Roster PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Roster FOREIGN KEY manager REFERENCES Manager"
                FOREIGN KEY ("manager")
                REFERENCES "Fantasy"."Manager" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Roster_Equipo" (
        "id"                    serial                          NOT NULL,
        "roster"                integer                         NOT NULL,
        "equipo"                integer                         NULL,
        "fecha_compra_equipo"   timestamp with time zone        NULL,
        "fecha_venta_equipo"    timestamp with time zone        NULL,
        "precio_compra_equipo"  integer                         NULL,
        "equipo_activo"         boolean                         NULL,

        CONSTRAINT "Roster_Equipo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Roster_Equipo FOREIGN KEY roster REFERENCES Roster"
                FOREIGN KEY ("roster")
                REFERENCES "Fantasy"."Roster" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Roster_Equipo FOREIGN KEY equipo REFERENCES Equipo"
                FOREIGN KEY ("equipo")
                REFERENCES "Fantasy"."Equipo" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Roster_Jugador" (
       	"id"                    serial                          NOT NULL,
        "roster"                integer                         NOT NULL,
        "jugador"               integer                         NOT NULL,
        "fecha_compra_jugador"  timestamp with time zone        NOT NULL,
        "fecha_venta_jugador"   timestamp with time zone        NULL,
        "precio_compra_jugador" integer                         NOT NULL,
        "jugador_activo"        boolean                         NOT NULL,
        "posicion_jugador"      varchar(2)                      NOT NULL,		

	CONSTRAINT "Roster_Jugador PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Roster_Jugador FOREIGN KEY roster REFERENCES Roster"
                FOREIGN KEY ("roster")
                REFERENCES "Fantasy"."Roster" ("id")
                ON DELETE CASCADE,

        CONSTRAINT "Roster_Jugador FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Estadistica_Bateo" (
       	"id"        serial                                      NOT NULL,
        "jugador"   integer                                     NOT NULL,
        "fecha"     date                                        NOT NULL,
        "ci"        integer                                     NOT NULL,
        "ca"        integer                                     NOT NULL,
        "tb"        integer                                     NOT NULL,
        "br"        integer                                     NOT NULL,
        "bb"        integer                                     NOT NULL,
        "h"         integer                                     NULL,
        "h2"        integer                                     NULL,
        "h3"        integer                                     NULL,
        "hr"        integer                                     NULL,
        "vb"        integer                                     NULL,
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
       	"id"        serial				        NOT NULL,
        "jugador"   integer                                     NOT NULL,
        "fecha"     date                                        NOT NULL,
        "el"        integer                                     NOT NULL,
        "cl"        integer                                     NOT NULL,
        "i"         integer                                     NOT NULL,
        "bb"        integer                                     NOT NULL,
        "k"         integer                                     NOT NULL,
        "jg"        integer                                     NOT NULL,
        "errores"   integer                                     NOT NULL default 0,		

	CONSTRAINT "Estadistica_Pitcheo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Estadistica_Pitcheo UNIQUE jugador_fecha"
                UNIQUE ("jugador", "fecha"),

        CONSTRAINT "Estadistica_Pitcheo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
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

CREATE TABLE "Fantasy"."Historial_Bateo" (
       	"id"        serial				        NOT NULL,
        "jugador"   integer                                     NOT NULL,
        "anio"      integer                                     NOT NULL,
        "vb"        integer                                     NOT NULL,
        "h"         integer                                     NOT NULL,

	CONSTRAINT "Historial_Bateo PRIMARY KEY"
                PRIMARY KEY ("id"),

        CONSTRAINT "Historial_Bateo UNIQUE jugador_anio"
                UNIQUE ("jugador", "anio"),

        CONSTRAINT "Historial_Bateo FOREIGN KEY jugador REFERENCES Jugador"
                FOREIGN KEY ("jugador")
                REFERENCES "Fantasy"."Jugador" ("id")
                ON DELETE CASCADE
);

CREATE TABLE "Fantasy"."Contenidos" (
        "id"                            serial                          NOT NULL,
        "titulo"                        text                            NOT NULL,
        "contenidoC"                    text                            NOT NULL,
        "fecha"                         timestamp with time zone        NOT NULL,
        "urlimg"	                    text                            NOT NULL,
        "tipoC"							text							NOT NULL,
        "tags"							text							NOT NULL,

        CONSTRAINT "Contenidos PRIMARY KEY"
                PRIMARY KEY ("id")
);

