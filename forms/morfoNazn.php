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
$out=contentSetData($out,$Item);
return $out;
}

function morfoNazn_list($form,$mode,$id,$datatype) {
parse_str($_SERVER["REQUEST_URI"]);
$out=formGetForm($form,$mode);
$actionType_id=getActionTypeByName("Патоморфологические исследования");
	$SQL="SELECT * FROM Action AS a
	INNER JOIN ActionType AS b
	WHERE a.actionType_id = b.id
	AND a.event_id = ".$event_id."
	AND b.group_id = ".$actionType_id." LIMIT 10 ";
	$res=mysql_query($SQL) or die ("Query failed morfoNazn_list(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
			$result[]=$data;
	}

$Item["result"]=$result;
$out=contentSetData($out,$Item);
return $out;
}

function morfoReadNazn($id) {
$action=mysqlReadItem("Action",$id);
$action["action_id"]=$id;
if ($action["isUrgent"]==1) $action["isUrgent"]="on";
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
