SHELL := /usr/bin/env bash
SQL=PGOPTIONS='--client-min-messages=warning' psql
SQLOPTS=--quiet --variable=ON_ERROR_STOP=1 --pset pager=off

.PHONY: all check-locale packages apache postgresql

all: packages check-locale apache postgresql

packages:
	sudo apt-get install git{,-{all,doc}} postgresql{,-{contrib,client,doc,pl{perl,python}-8.4,server-dev-all}} apache2{,-{doc,utils}} libapache2-mod-php5 php{5-{cgi,cli,curl,dev,mysql,odbc,pgsql,sqlite},-{config,file,http{,-{request,upload}},net-url,db,doc}}

check-locale:
	./check-locale

apache:
	sudo ./apache

postgresql:
	sudo -u postgres createuser -EPs "$$USER"
	createdb -E UTF-8
	printf "REVOKE ALL PRIVILEGES ON DATABASE %s FROM PUBLIC;" template0 template1 postgres "$$USER" | $(SQL) $(SQLOPTS) -f -
	$(SQL) $(SQLOPTS) -c "REVOKE ALL PRIVILEGES ON SCHEMA public FROM PUBLIC;"
