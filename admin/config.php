<?php
//DATA BASE 
//define("PATH",$_SERVER['DOCUMENT_ROOT'].);
define("DBDRIVER", "mysql");
define("DBHOST", "127.0.0.1");
define("DBNAME", "constructora");
define("DBUSER", "root");
define("DBPASS", "");
define("DBPORT", "3306");//3306 -> MYSQL
$uploads['archivo'] = array("application/gzip","application/zip");
$uploads['fotografia'] = array("image/jpeg", "image/jpg", "image/gif", "image/png");

?>