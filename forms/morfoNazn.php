<?
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");


function morfoNazn_edit($form,$mode,$id,$datatype) {
$out=formGetForm($form,$mode);
if ($id!="_new" AND $id!="") {
	$Item=morfoReadNazn($id);
	$Item["morfoNazn"]=morfoNaznForm($Item["actionType_id"]);
} else {
	$Item=morfoNewNazn();
	$Item["morfoNazn"]=morfoNaznForm();
}
if ($Item["person_id"]=="") {$Item["person_id"]=$_SESSION["user_id"];}
$out=contentSetData($out,$Item);
return $out;
}

function morfoNazn_list($form,$mode,$id,$datatype) {
parse_str($_SERVER["REQUEST_URI"]);
$SETTINGS=$_SESSION['settings'];
if (isset($_COOKIE["workDate"])) {$Item["date1"]=$_COOKIE["workDate"];} else {$Item["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"") {
  $Item["date2"]=$_COOKIE["endDate"];
} else {$Item["date2"]=date("Y-m-d",strtotime($Item["date1"])+86400); }
$Item["workDate"]=$Item["date1"];
$Item["endDate"]=$Item["date2"];
$out=formGetForm($form,$mode);
$actionType_id=getActionTypeByName("Патоморфологические исследования");
	$SQL="SELECT a.id FROM Action AS a
	INNER JOIN ActionType AS b
	WHERE a.actionType_id = b.id
	AND a.event_id = ".$event_id."
	AND b.group_id = ".$actionType_id."
	AND ( (a.begDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]}' ) 
	OR 
	( a.plannedEndDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]}' ) )
	ORDER BY a.begDate DESC LIMIT 10 ";
	$res=mysql_query($SQL) or die ("Query failed morfoNazn_list(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
			$result[]=getActionInfo($data["id"]);
	}
	$Item["result"]=$result;
	$path_ref=parse_url($_SERVER["HTTP_REFERER"]); $path_ref=$path_ref["path"];
	$path_uri=parse_url($_SERVER["SCRIPT_URI"]); $path_uri=$path_uri["path"]; 
	if ($path_ref!=$path_uri) {
		pq($out)->find("div[data-role=content]")->prepend("<div class='ref ui-hidden'>1</div>");
	}
$out=contentSetData($out,$Item);
return $out;
}

function morfoReadNazn($id) {
$action=mysqlReadItem("Action",$id);
$action["action_id"]=$id;
if ($action["isUrgent"]==1) $action["isUrgent"]="on";
$form=morfoNaznForm($action["actionType_id"]);
$action["morfoNazn"]=$form;
$action=getActionPropertyFormData($action,$form);
return $action;
}

function morfoNaznForm($atid="") {
if ($atid=="") parse_str($_SERVER["REQUEST_URI"]);
$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
INNER JOIN ActionType as b ON a.actionType_id=b.id
WHERE b.id=$atid    
ORDER BY a.idx	";
return  getActionTypeForm($SQL);
}

function morfoNewNazn() {
	parse_str($_SERVER["REQUEST_URI"]);
	$Item["action_id"]="_new";
	$Item["event_id"]=$event_id;
	$Item["person_id"]=$person_id;
	$Item["client_id"]=$client_id;
	$Item["actionType_id"]=$atid;
	return $Item;
}

?>
