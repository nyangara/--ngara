CREATE DOMAIN password AS text;



CREATE FUNCTION password_leq(password, text) RETURNS bool AS
$BODY$
        SELECT crypt($2, $1) = $1::text;
$BODY$
LANGUAGE sql
IMMUTABLE;

CREATE OPERATOR = (
        LEFTARG   = password,
        RIGHTARG  = text,
        NEGATOR   = <>,
        PROCEDURE = password_leq
);



CREATE FUNCTION password_lne(password, text) RETURNS bool AS
$BODY$
        SELECT crypt($2, $1) <> $1::text;
$BODY$
LANGUAGE sql
IMMUTABLE;

CREATE OPERATOR <> (
        LEFTARG   = password,
        RIGHTARG  = text,
        NEGATOR   = =,
        PROCEDURE = password_lne
);



CREATE FUNCTION password_req(text, password) RETURNS bool AS
$BODY$
        SELECT crypt($1, $2) = $2::text;
$BODY$
LANGUAGE sql
IMMUTABLE;

CREATE OPERATOR = (
        LEFTARG   = text,
        RIGHTARG  = password,
        NEGATOR   = <>,
        PROCEDURE = password_req
);



CREATE FUNCTION password_rne(text, password) RETURNS bool AS
$BODY$
        SELECT crypt($1, $2) <> $2::text;
$BODY$
LANGUAGE sql
IMMUTABLE;

CREATE OPERATOR <> (
        LEFTARG = text,
        RIGHTARG = password,
        NEGATOR = =,
        PROCEDURE = password_rne
);



CREATE FUNCTION password_beq(left_pw password, right_pw password) RETURNS bool AS
$BODY$
        DECLARE
        left_crypted bool;
        right_crypted bool;
        BEGIN
                left_crypted  := (substr(left_pw , 1, 3) = '$2a$');
                right_crypted := (substr(right_pw, 1, 3) = '$2a$');
                IF (left_crypted) AND (NOT right_crypted) THEN
                        RETURN crypt(right_pw, left_pw)::text = left_pw::text;
                END IF;
                IF (NOT left_crypted) AND (right_crypted) THEN
                        RETURN crypt(left_pw, right_pw)::text = right_pw::text;
                END IF;
                RETURN left_pw::text = right_pw::text;
        END;
$BODY$
LANGUAGE plpgsql
IMMUTABLE;

CREATE OPERATOR = (
        LEFTARG   = password,
        RIGHTARG  = password,
        NEGATOR   = <>,
        PROCEDURE = password_beq
);



CREATE FUNCTION password_bne(password, password) RETURNS bool AS
$BODY$
        SELECT NOT password_beq($1, $2);
$BODY$
LANGUAGE sql
IMMUTABLE;

CREATE OPERATOR <> (
        LEFTARG   = password,
        RIGHTARG  = password,
        NEGATOR   = =,
        PROCEDURE = password_bne
);
