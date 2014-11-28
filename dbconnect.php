<?php
engineSettingsRead();

$settings=$_SESSION["settings"];
$Work['dbname']=$settings["dbname"];
$Work['dbhost']=$settings["dbhost"];
$Work['dbuser']=$settings["dbuser"];
$Work['dbpass']=$settings["dbpass"];
$db_conn=mysql_connect($Work[dbhost],$Work[dbuser],$Work[dbpass]);
$db=mysql_select_db($Work[dbname], $db_conn);
mysql_query("SET NAMES utf8");
mysql_query("SET collation_connection=utf8_general_ci");
mysql_query("SET collation_server=utf8_general_ci");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_server=utf8"); 


$SQL="CREATE TABLE IF NOT EXISTS `JsonData` (
  `id` varchar(255) NOT NULL,
  `json` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
mysql_query($SQL);
?>
