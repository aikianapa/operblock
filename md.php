
<?
include_once("./engine/functions.php");
engineSettingsRead();

$settings=$_SESSION["settings"];
$Work['dbname']=$settings["max"];
$Work['dbhost']=$settings["localhost"];
$Work['dbuser']=$settings["root"];
$Work['dbpass']=$settings["accept"];
$db_conn=mysql_connect($Work[dbhost],$Work[dbuser],$Work[dbpass]);
$db=mysql_select_db($Work[dbname], $db_conn);
mysql_query("SET character_set_results=cp1251");
//mysql_query("charset cp1251");
$test=mysqlListItems("metabase");
chmod('./contents',0777);
echo substr(sprintf('%o', fileperms('./contents')), -4);
echo file_put_contents("./contents/metabase.json",json_encode($test));
?>
</html>
