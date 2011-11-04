SHELL := /usr/bin/env bash

.PHONY: all check-locale packages apache postgresql

all: packages check-locale apache postgresql

packages:
	apt-get install git{,-{all,doc}} postgresql{,-{contrib,client,doc,pl{perl,python}-8.4,server-dev-all}} apache2{,-{doc,utils}} libapache2-mod-php5 php{5-{cgi,cli,curl,dev,mysql,odbc,pgsql,sqlite},-{config,file,http{,-{request,upload}},net-url,db,doc}}

check-locale:
	./check-locale

apache:
	./apache

postgresql:
	sudo -u postgres createuser -EPs "$$USER"
	createdb -E UTF-8
