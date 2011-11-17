CREATE OR REPLACE FUNCTION "Fantasy"."TRIGGER BEFORE INSERT OR UPDATE ON passwd"() RETURNS TRIGGER AS
$BODY$
        DECLARE
        BEGIN
                IF substr(NEW."password", 1, 4) <> '$2a$' THEN
                        NEW."password" := crypt(NEW."password", gen_salt('bf'));
                END IF;
                RETURN NEW;
        END;
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER "TRIGGER BEFORE INSERT OR UPDATE ON passwd"
BEFORE INSERT OR UPDATE ON "Fantasy"."passwd"
FOR EACH ROW EXECUTE PROCEDURE "Fantasy"."TRIGGER BEFORE INSERT OR UPDATE ON passwd"();
