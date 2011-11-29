SQL=psql
SQLOPTS=--quiet
DATABASE=Fantasy

.PHONY: all user admin auth

all: user admin auth

user:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f user.sql

admin:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f admin.sql

auth:
	"$(SQL)" $(SQLOPTS) -d "$(DATABASE)" -f auth.sql
