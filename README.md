Simple PHP Authentification Example

Directory structure:
	- api
		api.php   -  file with functions (register, check unique, login/logout, ... );
	- config
		db.php    -   file with database connection settings ( host, user, password, database);
	- vendor(after composer installing) - folder for dependencies installed via composer;
	- src  -  folder for main files
		cabinet.php
		login.php
		login.html
		logout.php
		signup.php
		signup_procedure.php
		
	- root directory:
		.htaccess - routing rule

		
Requirements:
- PHP >= 7.1
- MariaDB >= 10.1


Installing:
- clone this repository
- composer install
- change database settings in \config\db.php
- create database and execute sql queries from test12.sql file

  IF YOU WANT TO RUN SITE NOT FROM DOMAIN ROOT:
- configure server virtual host similar to httpd-example.conf file
  or examples: https://httpd.apache.org/docs/2.4/vhosts/examples.html
  
  
  
  Notes :
- Configuration is dependent on server features, OS type ...
- If you run this website on server environment that using special variables ( %hostdir% , ...)
  like OpenServer, virtual hosts will not working.

  