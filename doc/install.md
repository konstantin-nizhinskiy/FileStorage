## APACHE 2.0
sudo apt-get install apache2;
sudo a2enmod rewrite;
## imagemagick
sudo apt-get install imagemagick

#PHP 7
sudo apt-get install php7.0 php7.0-dev libapache2-mod-php7.0 php7.0-mysql php7.0-pgsql php7.0-mcrypt php7.0-bz2 php7.0-cli php7.0-gd libcurl3-openssl-dev php-pear php7.0-curl php7.0-xml php7.0-zip php7.0-mbstring php-imagick;





Правим конфиги 
cd /etc/apache2/sites-available/000-default.conf
добавляем
<VirtualHost *:8010>

	ServerAdmin webmaster@localhost
	DocumentRoot /полный путь/FileStorage/web

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

<Directory "/полный путь/FileStorage/web">
    AllowOverride All
</Directory>
</VirtualHost>


sudo service apache2 restart
