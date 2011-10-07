CREATE TABLE "Jugador" (
        "Tipo_jugador" TEXT NOT NULL,
        "Posición_jugador" INTEGER NOT NULL,
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
