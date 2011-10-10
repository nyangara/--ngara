DATABASE=TriplePlay

.PHONY: all create password schema load sample perm truncate truncate-sample delete distclean

all: create password schema load perm

create:
	psql             -f create.sql

schema:
	psql $(DATABASE) -f schema.sql

load:
	psql $(DATABASE) -f load.sql

sample:
	psql $(DATABASE) -f sample.sql

perm:
	psql $(DATABASE) -f perm.sql

truncate:
	psql $(DATABASE) -f truncate.sql

truncate-sample:
	psql $(DATABASE) -f truncate-sample.sql

delete:
	psql $(DATABASE) -f delete.sql

distclean:
	psql             -f distclean.sql

