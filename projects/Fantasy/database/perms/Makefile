SQL=PGOPTIONS='--client-min-messages=warning' psql
SQLOPTS=--quiet
DATABASE=Fantasy

.PHONY: all user admin auth

all: guest user admin auth

guest:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f guest.sql

user:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f user.sql

admin:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f admin.sql

auth:
	$(SQL) $(SQLOPTS) -d '$(DATABASE)' -f auth.sql
