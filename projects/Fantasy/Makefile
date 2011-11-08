PROJECT=Fantasy
HTTPD_ROOT=/var/www

.PHONY: all setup install copy symlink uninstall password clean distclean

all: setup password

setup:
	$(MAKE) -C database distclean all

install: symlink

copy:
	cp -R webroot "$(HTTPD_ROOT)/$(PROJECT)"

symlink:
	ln -s "$$PWD"/webroot "$(HTTPD_ROOT)/$(PROJECT)"

uninstall:
	rm -rf "$(HTTPD_ROOT)/$(PROJECT)"

password:
	./scripts/password

clean:
	rm -f webroot/password-auth.php webroot/password-user.php webroot/password-admin.php

distclean: clean
