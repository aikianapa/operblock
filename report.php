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
echo $aType;
?>
