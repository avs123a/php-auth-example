Simple PHP Authentification Example

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

  