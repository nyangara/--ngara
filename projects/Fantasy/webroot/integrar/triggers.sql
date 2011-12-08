-- Con esto se crea el lenguaje procedural si no fue ya creado
CREATE PROCEDURAL LANGUAGE plpgsql;

-- Función para el trigger de bateo
CREATE OR REPLACE FUNCTION sumar_puntos_bateo() RETURNS TRIGGER AS $sumar_puntos_bateo$
  DECLARE
  BEGIN

    IF (TG_OP = 'INSERT') THEN
        
        UPDATE "Fantasy"."Manager" SET puntaje = puntaje + NEW.ci + NEW.ca + NEW.tb + NEW.br + NEW.bb - NEW.k WHERE id IN (SELECT r2.manager FROM "Fantasy"."Roster_Jugador" r1, "Fantasy"."Roster" r2 WHERE NEW.jugador = r1.jugador AND (r1.jugador_activo OR NEW.fecha < r1.fecha_venta_jugador) AND r1.roster = r2.id);
        RETURN NEW;

    ELSEIF (TG_OP = 'UPDATE') THEN

        UPDATE "Fantasy"."Manager" SET puntaje = puntaje + NEW.ci - OLD.ci + NEW.ca - OLD.ca + NEW.tb - OLD.tb + NEW.br - OLD.br + NEW.bb - OLD.bb - (NEW.k - OLD.k) WHERE id IN (SELECT r2.manager FROM "Fantasy"."Roster_Jugador" r1, "Fantasy"."Roster" r2 WHERE NEW.jugador = r1.jugador AND (r1.jugador_activo OR NEW.fecha < r1.fecha_venta_jugador) AND r1.roster = r2.id);
        RETURN NEW;

    ELSEIF (TG_OP = 'DELETE') THEN

        UPDATE "Fantasy"."Manager" SET puntaje = puntaje - OLD.ci - OLD.ca - OLD.tb - OLD.br - OLD.bb + OLD.k WHERE id IN (SELECT r2.manager FROM "Fantasy"."Roster_Jugador" r1, "Fantasy"."Roster" r2 WHERE OLD.jugador = r1.jugador AND (r1.jugador_activo OR OLD.fecha < r1.fecha_venta_jugador) AND r1.roster = r2.id);
        RETURN OLD;
    
    END IF;

  END;
$sumar_puntos_bateo$ LANGUAGE plpgsql;

-- Declaración del trigger de bateo
CREATE TRIGGER sumar_puntos_bateo AFTER INSERT OR UPDATE OR DELETE
    ON "Fantasy"."Estadistica_Bateo" FOR EACH ROW 
    EXECUTE PROCEDURE sumar_puntos_bateo();

-- Función para el trigger de pitcheo
CREATE OR REPLACE FUNCTION sumar_puntos_pitcheo() RETURNS TRIGGER AS $sumar_puntos_pitcheo$
  DECLARE
  BEGIN

    IF (TG_OP = 'INSERT') THEN
        
        UPDATE "Fantasy"."Manager" SET puntaje = puntaje + 3*NEW.el - 3*NEW.cl - NEW.i - NEW.bb + NEW.k + 5*NEW.jg - NEW.errores WHERE id IN (SELECT r2.manager FROM "Fantasy"."Jugador" j, "Fantasy"."Roster_Equipo" r1, "Fantasy"."Roster" r2 WHERE NEW.jugador = j.id AND j.equipo = r1.equipo AND (r1.equipo_activo OR NEW.fecha < r1.fecha_venta_equipo) AND r1.roster = r2.id);
        RETURN NEW;

    ELSEIF (TG_OP = 'UPDATE') THEN

        UPDATE "Fantasy"."Manager" SET puntaje = puntaje + 3*(NEW.el - OLD.el) - 3*(NEW.cl - OLD.cl) - (NEW.i - OLD.i) - (NEW.bb - OLD.bb) + (NEW.k - OLD.k) + 5*(NEW.jg - OLD.jg) - (NEW.errores - OLD.errores) WHERE id IN (SELECT r2.manager FROM "Fantasy"."Jugador" j, "Fantasy"."Roster_Equipo" r1, "Fantasy"."Roster" r2 WHERE NEW.jugador = j.id AND j.equipo = r1.equipo AND (r1.equipo_activo OR NEW.fecha < r1.fecha_venta_equipo) AND r1.roster = r2.id);
        RETURN NEW;

    ELSEIF (TG_OP = 'DELETE') THEN

        UPDATE "Fantasy"."Manager" SET puntaje = puntaje - 3*OLD.el + 3*OLD.cl + OLD.i + OLD.bb - OLD.k - 5*OLD.jg + OLD.errores WHERE id IN (SELECT r2.manager FROM "Fantasy"."Jugador" j, "Fantasy"."Roster_Equipo" r1, "Fantasy"."Roster" r2 WHERE OLD.jugador = j.id AND j.equipo = r1.equipo AND (r1.equipo_activo OR OLD.fecha < r1.fecha_venta_equipo) AND r1.roster = r2.id);
        RETURN OLD;
    
    END IF;

  END;
$sumar_puntos_pitcheo$ LANGUAGE plpgsql;

-- Declaración del trigger de pitcheo
CREATE TRIGGER sumar_puntos_pitcheo AFTER INSERT OR UPDATE OR DELETE
    ON "Fantasy"."Estadistica_Pitcheo" FOR EACH ROW 
    EXECUTE PROCEDURE sumar_puntos_pitcheo();

-- Para probar
INSERT INTO "Fantasy"."Estadio" (nombre, ubicacion, propietario, capacidad, tipo_terreno, fecha_fundacion) VALUES ('Anni','Anni', 'Anni', 10000, 'Tierra', '1984-11-29');

INSERT INTO "Fantasy"."Equipo" (nombre, siglas, home, precio) VALUES ('Leones', 'LCR', 1, 10000);

INSERT INTO "Fantasy"."Jugador" (nombres, posicion, precio, equipo) VALUES ('Jose', 'BD', 10000, 1);

INSERT INTO "Fantasy"."Usuario" (username, password) VALUES ('Hey', 'hasjansjkan');

INSERT INTO "Fantasy"."Manager" (usuario) VALUES (1);

INSERT INTO "Fantasy"."Roster" (nombre, manager, fecha_creacion) VALUES ('Daniel', 2, '2001-11-29');

INSERT INTO "Fantasy"."Roster_Jugador" (roster, jugador, fecha_compra_jugador, precio_compra_jugador, jugador_activo, posicion_jugador) VALUES (1, 3, '2009-11-29', 10000, TRUE, 'BD');

INSERT INTO "Fantasy"."Estadistica_Bateo" (jugador, fecha, ci, ca, tb, br, bb, k) VALUES (3, '1994-11-29', 1, 1, 2, 0, 0, 1);

INSERT INTO "Fantasy"."Roster_Equipo" (roster, equipo, fecha_compra_equipo, precio_compra_equipo, equipo_activo) VALUES (1, 1, '2009-11-29', 10000, TRUE);
INSERT INTO "Fantasy"."Estadistica_Pitcheo" (jugador, fecha, el, cl, i, bb, k, jg) VALUES (3, '1994-11-29', 1, 1, 2, 0, 0, 1);
