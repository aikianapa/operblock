<?
include_once($_SERVER["DOCUMENT_ROOT"]."/functions.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
prepareSessions();
$orgStrId=$_SESSION["orgStrId"];
$orgId=$_SESSION["orgId"];

function zavedanDataType() { return "mysql"; }

function zavedan_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=zavedanListItems() ;
$Item["person_id"]=$_SESSION["person_id"];
$Item["orgStr_id"]=$_SESSION["orgStrId"];
if (isset($_COOKIE["workDate"])) {$Item["workDate"]=$_COOKIE["workDate"];} else {$Item["workDate"]=date("Y-m-d");}
$Item=getOpTables($Item,$Item["workDate"]);
$Item["oprooms"]=getOpRooms();
$out=contentSetData($out,$Item);
$out=setSelects($out);
return $out;
}

function setSelects($out) {
global $orgStrId;
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_sisteran_list&orgStrId=$orgStrId";
$sisteran=json_decode(file_get_contents($url),true);
foreach($sisteran as $key => $sister) {
	$opt="<option value=\"$sister[0]\">$sister[lastName] $sister[firstName] $sister[patrName]</option>";
	$out->find("select[name^=an_sister_id] option:last")->after($opt);
}
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_anest_list&orgStrId=$orgStrId";
$persons=json_decode(file_get_contents($url),true);
foreach($persons as $key => $person) {
	$opt="<option value=\"$person[id]\">$person[lastName] $person[firstName] $person[patrName]</option>";
	$out->find("select[name=an_person_id] option:last")->after($opt);
}

return $out;
}

function zavedanListItems() {
	// ============== Готовим список текущих пациентов
	$SETTINGS=$_SESSION['settings'];

if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}
$SQL="SELECT Action.id FROM Action INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
	WHERE ActionType.serviceType = 4
	AND (begDate='$date' OR plannedEndDate = '$date')
	ORDER BY Action.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$counter++; $action["counter"]=$counter;
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);			
			if ($action["orgid"]=="") { $action["orgid"]=$action["orgStr_id"]; }
			$result[]=$action;
		}
		mysql_free_result($res);
		$result=array_sort($result, "index");
	return $result;
}

?>
