SQL=psql
SQLOPTS=--quiet
USERNAME=TriplePlay
DATABASE=TriplePlay

.PHONY: all create password schema load sample perm truncate truncate-sample delete distclean

all: create password schema load perm

create:
	createuser -SDR "$(USERNAME)"
	createdb -E UTF-8 "$(DATABASE)"

schema:
	$(SQL) $(SQLOPTS) $(DATABASE) -f schema.sql

load:
	$(SQL) $(SQLOPTS) $(DATABASE) -f load.sql

sample:
	$(SQL) $(SQLOPTS) $(DATABASE) -f sample.sql

perm:
	$(SQL) $(SQLOPTS) $(DATABASE) -f perm.sql

truncate:
	$(SQL) $(SQLOPTS) $(DATABASE) -f truncate.sql

truncate-sample:
	$(SQL) $(SQLOPTS) $(DATABASE) -f truncate-sample.sql

delete:
	$(SQL) $(SQLOPTS) $(DATABASE) -f delete.sql

distclean:
	$(SQL) $(SQLOPTS)             -f distclean.sql

