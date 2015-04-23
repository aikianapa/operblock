<?
$start=time();
session_start();
parse_str($_SERVER["REQUEST_URI"],$tmp);
if (isset($tmp["person_id"])) {parse_str($_SERVER["REQUEST_URI"],$_SESSION["dr"]);}
$path=$_SERVER['DOCUMENT_ROOT'];
$url="http://".$_SERVER['HTTP_HOST'];
include_once("$path/engine/engine.php");
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
$name="DoctorRoom: Выписной эпикриз";
$aType=getActionTypeByName($name);
$SQL="SELECT COUNT(*) FROM `Action` WHERE actionType_id = {$aType} ";
	$res=mysql_query($SQL) or die ("Query failed getEpicrizOut(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		echo $name.": ".$data[0];
	}
?>
