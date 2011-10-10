PROJECT=TriplePlay
HTTPD_ROOT=/var/www

.PHONY: all install symlink uninstall password

all:

install:
	cp -R webroot "$(HTTPD_ROOT)/$(PROJECT)"

symlink:
	ln -s "$$PWD"/webroot "$(HTTPD_ROOT)/$(PROJECT)"

uninstall:
	rm -rf "$(HTTPD_ROOT)/$(PROJECT)"

password:
	./password
