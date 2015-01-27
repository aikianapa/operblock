<?
include_once($_SERVER["DOCUMENT_ROOT"]."/functions.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
prepareSessions();
$orgStrId=$_SESSION["orgStrId"];
$orgId=$_SESSION["orgId"];


function zamglavDataType() { return "mysql"; }

function zamglav_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=zamglavListItems() ;
$Item["tables"]=prepareTables(5);
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
global $orgStrId, $orgId;
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_person_list&orgStrId=".$_SESSION["orgStrId"];
$persons=json_decode(file_get_contents($url),true);
foreach($persons as $key => $Person) {
	$opt="<option value=\"$Person[id]\">$Person[lastName] $Person[firstName] $Person[patrName]</option>";
	$out->find("select[name=person_id] option:last")->after($opt);
	$out->find("select[name=dejur_id] option:last")->after($opt);
	$out->find("select[name=hemo_id] option:last")->after($opt);
	$out->find("select[name^=assist_id] option:last")->after($opt);
	$out->find("select[name=an_person_id] option:last")->after($opt);
}

//=====
// Операционная сестра
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_sisterop_list&orgId=".$_SESSION["orgId"];
$list=json_decode(file_get_contents($url),true);
foreach($list as $key => $person) {
	$opt="<option value=\"$person[0]\">$person[lastName] $person[firstName] $person[patrName]</option>";
	$out->find("select[name=operSister_id] option:last")->after($opt);
} 
// Анестезиолог
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_anest_list&orgStrId=$orgStrId";
$list=json_decode(file_get_contents($url),true);
foreach($list as $key => $person) {
	$opt="<option value=\"$person[id]\">$person[lastName] $person[firstName] $person[patrName]</option>";
	$out->find("select[name=an_person_id] option:last")->after($opt);
}
// Анестезиологическая сестра
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_sisteran_list&orgStrId=$orgStrId";
$list=json_decode(file_get_contents($url),true);
foreach($list as $key => $person) {
	$opt="<option value=\"$person[0]\">$person[lastName] $person[firstName] $person[patrName]</option>";
	$out->find("select[name^=an_sister_id] option:last")->after($opt);
}
//=====
return $out;
}

function zamglavListItems() {
	$SETTINGS=$_SESSION['settings'];
	$result=array(); $counter=0;
if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}
$SQL="SELECT * FROM Action INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
	WHERE ActionType.serviceType = 4
	AND (begDate = '$date' OR plannedEndDate = '$date')
	AND Action.deleted=0
	ORDER BY Action.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($action = mysql_fetch_array($res)) {
			$counter++; $action["counter"]=$counter;
			$action["id"]=$action[0];
			$action=getActionInfo($action["id"]);
			if ($action["orgid"]=="") { $action["orgid"]=$action["orgStr_id"]; }
			$tooltip="<ul class='inner'>
				<li>Диагноз: $action[diagnose]</li>
				<li>Название операции: $action[operation]</li>
				<li>Хирург: $action[hirurg]</li>
				<li>Ассистент:$action[brigada]</li>
				<li>Группа крови:$action[blood]</li>
				<li>Дата поступления:$action[client_begDate]</li>
			</ul>";
			if (!isset($_action["table"]))  $_action["table"]="";
			$action["begDate"]=dmyDate($action["begDate"]);
			$result[]=$action;
		}
		mysql_free_result($res);
		$result=array_sort($result, "index");
	return $result;
}

?>
