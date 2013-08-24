SHELL 			:= /bin/bash
CMD				:= sudo lxc-attach -n sessility --

CONTAINERADDR	= $$($(CMD) /sbin/ifconfig|grep inet|head -1|sed 's/\:/ /'|awk '{print $$3}')
CONTAINERDEPS 	:= wordpress mysql-server
HOSTDEPS 		:= phpunit
WPCONFIG 		:= /etc/wordpress/config-$(CONTAINERADDR).php
DBUSER 			= $$(sudo lxc-attach -n sessility -- sudo cat $(WPCONFIG) |egrep "DB_USER'" | egrep -o ",\ .+'\)"|sed "s/, '//"|sed "s/')//")
DBPASS 			= $$(sudo lxc-attach -n sessility -- sudo cat $(WPCONFIG) |egrep "DB_PASSWORD'" | egrep -o ",\ .+'\)"|sed "s/, '//"|sed "s/')//")
PLUGINPATH 		= `pwd`/Plugin/SEO
HOSTPLUGINDEST	= /var/lib/lxc/sessility/rootfs/usr/share/wordpress/wp-content/plugins/sessility-seo
PLUGINDEST		= /usr/share/wordpress/wp-content/plugins/sessility-seo

bootstrap: hostdeps create start containerupdate containerupgrade containerdeps wordpress

hostdeps:
	sudo apt-get --force-yes --yes install lxc
create:
	sudo lxc-create -n sessility -t ubuntu -- -r precise -a i386 -b $$USER
start:
	sudo lxc-start -dn sessility && echo "Waiting for sessility to start..." && sleep 5
stop:
	sudo lxc-stop -n sessility
destroy:
	sudo lxc-destroy -n sessility

containerupdate:
	$(CMD) sudo apt-get update
containerupgrade:
	$(CMD) sudo apt-get --force-yes --yes upgrade
containerdeps:
	$(CMD) sudo apt-get --force-yes --yes install $(CONTAINERDEPS)

clean-running-container: remove-wpconfig
clean: stop destroy

remove-wpconfig:
	-sudo rm $(WPCONFIG)

wordpress: remove-wpconfig

	-$(CMD) sudo bash /usr/share/doc/wordpress/examples/setup-mysql -n wordpress $(CONTAINERADDR)

	# create vhost config
	$(CMD) sudo touch /etc/apache2/sites-available/sessility
	$(CMD) sudo bash -c "echo 'NameVirtualHost *:80' > /etc/apache2/sites-available/sessility"
	$(CMD) sudo bash -c "echo '<VirtualHost *:80>' >> /etc/apache2/sites-available/sessility"
	$(CMD) sudo bash -c "echo 'VirtualDocumentRoot /usr/share/wordpress/' >> /etc/apache2/sites-available/sessility"
	$(CMD) sudo bash -c "echo 'Options All' >> /etc/apache2/sites-available/sessility"
	$(CMD) sudo bash -c "echo '</VirtualHost>' >> /etc/apache2/sites-available/sessility"

	# make apache behave
	$(CMD) sudo a2enmod rewrite
	$(CMD) sudo a2enmod vhost_alias
	$(CMD) sudo a2dissite default
	$(CMD) sudo a2ensite sessility
	$(CMD) sudo /etc/init.d/apache2 restart

	# set perms
	$(CMD) sudo chown -R root:www-data /usr/share/wordpress

	echo "Allright, go to http://$(CONTAINERADDR)/wp-admin/install.php to set up wordpress"
	echo "To install plugin, do make install-plugin. You'll have to activate the plugin yourself through the admin interface"

remove-plugin:
	$(CMD) umount $(PLUGINDEST)
	$(CMD) rm -rf $(PLUGINDEST)


install-plugin:
	-$(CMD) sudo mkdir $(PLUGINDEST)
	$(CMD) mount --bind $(PLUGINPATH) $(PLUGINDEST)/
	$(CMD) sudo chown -R root:www-data $(PLUGINDEST)

print-container-ip:
	sudo lxc-attach -n sessility -- echo $(CONTAINERADDR)

print-container-install-url:
	echo "http://"`sudo lxc-attach -n sessility -- echo $(CONTAINERADDR)`"/wp-admin/install.php"

print-container-url:
	echo "http://"`sudo lxc-attach -n sessility -- echo $(CONTAINERADDR)`"/"

test:
	./test

.PHONY: test clean
