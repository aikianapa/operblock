<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();

function mainsisterDataType() { return "mysql"; }

function mainsister_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=mainsisterListItems() ;
if (isset($_COOKIE["workDate"])) {$Item["workDate"]=$_COOKIE["workDate"];} else {$Item["workDate"]=date("Y-m-d");}
$Item["person_id"]=$_SESSION["person_id"];
$Item["orgStr_id"]=$_SESSION["orgStrId"];
$Item=getOpTables($Item,$Item["workDate"]);
$Item["oprooms"]=getOpRooms();
$out=contentSetData($out,$Item);
$out=setSelects($out);
return $out;
}

function setSelects($out) {
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_sisterop_list&orgId=".$_SESSION["orgId"];
$_hirurg=json_decode(file_get_contents($url),true);
foreach($_hirurg as $key => $Sister) {
	$opt="<option value=\"$Sister[0]\">$Sister[lastName] $Sister[firstName] $Sister[patrName]</option>";
	$out->find("select[name=operSister_id] option:last")->after($opt);
} 
return $out;
}

function mainsisterListItems() {
if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}
$SQL="SELECT Action.id FROM Action INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
	WHERE ActionType.serviceType = 4
	AND (begDate='$date' OR plannedEndDate = '$date')
	ORDER BY Action.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["begDate"]=dmyDate($action["begDate"]);
			if ($action["orgid"]=="") { $action["orgid"]=$action["orgStr_id"]; }
			$result[]=$action;
		}
		mysql_free_result($res);
		$result=array_sort($result, "index");
	return $result;
}



?>
