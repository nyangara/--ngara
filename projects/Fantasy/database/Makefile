SQL=PGOPTIONS='--client-min-messages=warning' psql
SQLOPTS=--quiet --variable=ON_ERROR_STOP=1 --pset pager=off
DATABASE=Fantasy

.PHONY: all database include language password schema types tables functions triggers load sample roles perms truncate truncate-sample drop-tables distclean

all: database include language password schema types tables functions triggers load roles perms sample

database:
	createdb -E UTF-8 '$(DATABASE)'

include:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f /usr/share/postgresql/8.4/contrib/pgcrypto.sql

language:
	createlang -d '$(DATABASE)' plpgsql

password:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f password.sql

schema:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f schema.sql

types:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f types.sql

tables:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f tables.sql

functions:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f functions.sql

triggers:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f triggers.sql

load:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f load.sql

sample:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f sample.sql

roles:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f roles.sql

perms:
	$(MAKE) -C perms all

truncate:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f truncate.sql

truncate-sample:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f truncate-sample.sql

drop-tables:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f drop-tables.sql

distclean:
	$(SQL) $(SQLOPTS)                  -f distclean.sql
