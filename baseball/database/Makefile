all: create password schema load perm

create:
	psql -f create.sql

password:
	psql -f password.sql

schema:
	psql -f schema.sql "Baseball"

load:
	psql -f load.sql "Baseball"

sample:
	psql -f sample.sql "Baseball"

perm:
	psql -f perm.sql "Baseball"

truncate:
	psql -f truncate.sql "Baseball"

delete:
	psql -f delete.sql "Baseball"

distclean:
	psql -f distclean.sql
