SQL=psql
SQLOPTS=--quiet
DATABASE=Fantasy

.PHONY: all database include language password users tables triggers load sample perms truncate truncate-sample drop-tables distclean

all: database include language password users tables triggers load sample perms

database:
	createdb -E UTF-8 "$(DATABASE)"

include:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f /usr/share/postgresql/8.4/contrib/pgcrypto.sql

language:
	createlang -d "$(DATABASE)" plpgsql

password:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f password.sql

users:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f users.sql

tables:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f tables.sql

triggers:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f triggers.sql

load:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f load.sql

sample:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f sample.sql

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
