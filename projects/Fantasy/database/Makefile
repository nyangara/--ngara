SQL=psql
SQLOPTS=--quiet
DATABASE=Fantasy

.PHONY: all database include language password types schema tables functions triggers load sample users perms truncate truncate-sample drop-tables distclean

all: database include language password types schema tables functions triggers load users perms

database:
	createdb -E UTF-8 "$(DATABASE)"

include:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f /usr/share/postgresql/8.4/contrib/pgcrypto.sql

language:
	createlang -d "$(DATABASE)" plpgsql

password:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f password.sql

types:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f types.sql

schema:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f schema.sql

tables:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f tables.sql

functions:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f functions.sql

triggers:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f triggers.sql

load:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f load.sql

sample:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f sample.sql

users:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f users.sql

perms:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f perms.sql

truncate:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f truncate.sql

truncate-sample:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f truncate-sample.sql

drop-tables:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f drop-tables.sql

distclean:
	"$(SQL)" $(SQLOPTS)               -f distclean.sql
