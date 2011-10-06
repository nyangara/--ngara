CREATE TABLE "Estadio" (
"Id_estadio" SERIAL,
"Nombre_estadio" TEXT NOT NULL,
"Capacidad_estadio" NUMERIC NOT NULL,
"Ciudad_estadio" TEXT NOT NULL,
"Estado_estadio" TEXT NOT NULL,
"Fundación_estadio" TEXT NOT NULL,
"Tipo_terreno" TEXT NOT NULL,
CONSTRAINT "Estadio_Id_estadio_key" UNIQUE ("Id_estadio"),
CONSTRAINT "Estadio_pkey" PRIMARY KEY ("Id_estadio")
);

CREATE TABLE "Equipo" (
"Id_equipo" SERIAL,
"Nombre_equipo" TEXT NOT NULL,
cantidad_jugadores NUMERIC NOT NULL,
"Nombre_Manager" TEXT NOT NULL,
"Fecha_fundación" DATE NOT NULL,
"Ciudad_equipo" TEXT NOT NULL,
estadio_id INTEGER NOT NULL,
CONSTRAINT "Equipo_Id_equipo_key" UNIQUE ("Id_equipo"),
CONSTRAINT "Equipo_pkey" PRIMARY KEY ("Id_equipo"),
CONSTRAINT fk_equipo_estadio FOREIGN KEY (estadio_id) REFERENCES "Estadio"("Id_estadio")
);

CREATE TABLE "Jugador" (
"Id_jugador" SERIAL,
"Nombre_jugador" TEXT NOT NULL,
"Apellido_jugador" TEXT NOT NULL,
"Nro_jugador" NUMERIC NOT NULL,
"Tipo_jugador" TEXT NOT NULL,
"Posición_jugador" INTEGER NOT NULL,
"Fecha_nacimiento" DATE NOT NULL,
lugar_nacimiento TEXT NOT NULL,
peso REAL NOT NULL,
altura REAL NOT NULL,
equipo_id INTEGER NOT NULL,
CONSTRAINT pk_jugador PRIMARY KEY ("Id_jugador"),
CONSTRAINT fk_jugador_equipo FOREIGN KEY (equipo_id) REFERENCES "Equipo"("Id_equipo")
);

CREATE TABLE "Juega" (
"Id_juega" SERIAL,
"Fecha" DATE NOT NULL,
"Hora_de_inicio" time NOT NULL,
equipo1_id INTEGER,
equipo2_id INTEGER,
estadio_id INTEGER,
CONSTRAINT "Juega_pkey" PRIMARY KEY ("Id_juega"),
CONSTRAINT fk_juega_equipo1 FOREIGN KEY (equipo1_id) REFERENCES "Equipo"("Id_equipo"),
CONSTRAINT fk_juega_equipo2 FOREIGN KEY (equipo2_id) REFERENCES "Equipo"("Id_equipo"),
CONSTRAINT fk_juega_estadio FOREIGN KEY (estadio_id) REFERENCES "Estadio"("Id_estadio")
);

CREATE TABLE "Bateador" (
jugador_id INTEGER NOT NULL,
juegos_jugados INTEGER NOT NULL,
veces_al_bate INTEGER NOT NULL,
carreras_anotadas INTEGER NOT NULL,
hits INTEGER NOT NULL,
dobles INTEGER NOT NULL,
jonron INTEGER NOT NULL,
carreras_impulsadas INTEGER NOT NULL,
boleto INTEGER NOT NULL,
ponches INTEGER NOT NULL,
bases_robadas INTEGER NOT NULL,
atrapado_en_intento_de_robos INTEGER NOT NULL,
CONSTRAINT fk_bateador_jugador FOREIGN KEY (jugador_id) REFERENCES "Jugador"("Id_jugador")
);

CREATE TABLE "Manager" (
jugador_id INTEGER NOT NULL,
partidos_ganados INTEGER NOT NULL,
partidos_perdidos INTEGER NOT NULL,
porcentaje_ganados REAL NOT NULL,
mejor_actuacion INTEGER NOT NULL,
CONSTRAINT fk_manager_jugador FOREIGN KEY (jugador_id) REFERENCES "Jugador"("Id_jugador")
);

CREATE TABLE "Pitcher" (
jugador_id INTEGER NOT NULL,
"Ponches_otorgados" INTEGER NOT NULL,
"Bases_bolas_otorgadas" INTEGER NOT NULL,
partidos_comenzados INTEGER NOT NULL,
partidos_ganados INTEGER NOT NULL,
partidos_perdidos INTEGER NOT NULL,
partidos_salvados INTEGER NOT NULL,
innings_pichados INTEGER NOT NULL,
hits_recibidos INTEGER NOT NULL,
carreras_recibidas INTEGER NOT NULL,
home_runs_recibidos INTEGER NOT NULL,
efectividad REAL NOT NULL,
CONSTRAINT fk_pitcher_jugador FOREIGN KEY (jugador_id) REFERENCES "Jugador"("Id_jugador")
);

CREATE TABLE "Fielder" (
jugador_id INTEGER NOT NULL,
juegos_jugados INTEGER NOT NULL,
juegos_iniciados INTEGER NOT NULL,
entradas INTEGER NOT NULL,
total_oportunidades INTEGER NOT NULL,
putouts INTEGER NOT NULL,
asistencias INTEGER NOT NULL,
errores INTEGER NOT NULL,
doble_matanzas INTEGER NOT NULL,
porcentaje_fielding REAL NOT NULL,
valoracion_zona REAL NOT NULL,
factor_alcance REAL NOT NULL,
bolas_pasadas INTEGER NOT NULL,
bolas_robadas INTEGER NOT NULL,
atrapados_intentos_robos INTEGER NOT NULL,
average_fielder REAL NOT NULL,
CONSTRAINT fk_fielder_jugador FOREIGN KEY (jugador_id) REFERENCES "Jugador"("Id_jugador")
);

CREATE INDEX "Equipo_Id_equipo_idx" ON "Equipo"("Id_equipo");

CREATE INDEX "Estadio_Id_estadio_idx" ON "Estadio"("Id_estadio");

CREATE INDEX "Juega_Id_juega_idx" ON "Juega"("Id_juega");

CREATE INDEX "Jugador_Id_jugador_idx" ON "Jugador"("Id_jugador");

CREATE INDEX fki_bateador_jugador ON "Bateador"(jugador_id);

CREATE INDEX fki_equipo_estadio ON "Equipo"(estadio_id);

CREATE INDEX fki_fielder_jugador ON "Fielder"(jugador_id);

CREATE INDEX fki_juega_equipo1 ON "Juega"(equipo1_id);

CREATE INDEX fki_juega_equipo2 ON "Juega"(equipo2_id);

CREATE INDEX fki_juega_estadio ON "Juega"(estadio_id);

CREATE INDEX fki_jugador_equipo ON "Jugador"(equipo_id);

CREATE INDEX fki_manager_jugador ON "Manager"(jugador_id);

CREATE INDEX fki_pitcher_jugador ON "Pitcher"(jugador_id);

