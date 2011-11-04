CREATE OR REPLACE FUNCTION "TRIGGER BEFORE INSERT OR UPDATE ON passwd"() RETURNS TRIGGER AS
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
BEFORE INSERT OR UPDATE ON "passwd"
FOR EACH ROW EXECUTE PROCEDURE "TRIGGER BEFORE INSERT OR UPDATE ON passwd"();
