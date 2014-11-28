<?
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
engineSettingsRead();
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
include($_SERVER['DOCUMENT_ROOT']."/functions.php");
$mode=$_GET["mode"];
if (is_callable($mode)) {echo @$mode();}

function add_trigger() {
if ($_GET["uid"]>"") {
	$name=$_SERVER['DOCUMENT_ROOT']."/contents/logs/".$_GET["uid"].".json";
	if (is_file($name)) {$log=json_decode(file_get_contents($name),true);} else {$log=array();}
	$line=array();
	$line["time"]=time();
	$line["user"]=$_GET["uid"];
	$line["trigger"]=$_GET["trigger"];
	$log[]=$line;
	file_put_contents($name,json_encode($log));
	return true;
} else { return false;}
}

function get_trigger() {
if ($_GET["uid"]>"") {
	$name=$_SERVER['DOCUMENT_ROOT']."/contents/logs/".$_GET["uid"].".json";
	return file_get_contents($name);
} else { return false;}
}

function del_trigger() {
if ($_GET["uid"]>"") {
	$name=$_SERVER['DOCUMENT_ROOT']."/contents/logs/".$_GET["uid"].".json";\
	$log=array();
	file_put_contents($name,json_encode($log));
	return true;
} else { return false;}
}

?>
