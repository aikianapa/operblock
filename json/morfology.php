<?
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
engineSettingsRead();
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
include($_SERVER['DOCUMENT_ROOT']."/functions.php");
$mode=$_GET["mode"];
if (is_callable($mode)) {echo @$mode();}

// =================================================

function morfo_nazn_submit() {
if ($_POST["isUrgent"]=="on") {$_POST["isUrgent"]=1;} else  {$_POST["isUrgent"]=0;}
if ($_POST["action_id"]!="_new" AND $_POST["action_id"]!="") {
	$Action=mysqlReadItem("Action",$_POST["action_id"]);
} else {
	$Action=array();
	$Action["id"]=$_POST["id"]=$_POST["action_id"];
	$Action["actionType_id"]=$_POST["actionType_id"];
	$Action["event_id"]=$_POST["event_id"];
	$Action["setPerson_id"]=$_POST["setPerson_id"]=$_POST["person_id"];
	$Action["createPerson_id"]=$Action["modifyPerson_id"]=$_POST["person_id"];
	$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
	$Action["status"]=0;
	$Action["begDate"]=date("Y-m-d H:i:s");
}
	$Action["isUrgent"]=$_POST["isUrgent"];
	$Action["plannedEndDate"]=date("Y-m-d H:i:s",strtotime($_POST["plannedEndDate"]));
	mysqlSaveItem("Action",$Action);
	if ($_POST["id"]=="_new" OR $_POST["id"]=="") {$Action["id"]=mysql_insert_id();}
	$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
	INNER JOIN ActionType as b ON a.actionType_id=b.id
	WHERE b.id=".$_POST["actionType_id"]."
	ORDER BY a.idx	";
	$fldset=getActionTypeForm($SQL);
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	insertProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
}

function morfo_reg_submit() {
	if ($_POST["action_id"]!="_new" AND $_POST["action_id"]!="") {
		$Action=mysqlReadItem("Action",$_POST["action_id"]);
	} else {
		$Action["id"]=$_POST["id"]=$_POST["action_id"];
		$Action["actionType_id"]=$_POST["actionType_id"];
		$Action["event_id"]=$_POST["event_id"];
		$Action["parent_id"]=$_POST["parent_id"];
		$Action["setPerson_id"]=$_POST["person_id"];
		$Action["createPerson_id"]=$Action["modifyPerson_id"]=$_POST["person_id"];
		$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
		$Action["begDate"]=date("Y-m-d H:i:s");
		$Action["status"]=0;
	}
	$Action["status"]=$_POST["status"];
	$fldset=getActionTypeForm('Регистрация биоматериала');
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	mysqlSaveItem("Action",$Action);
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {
		$Action["id"]=mysql_insert_id();
		insertProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	} else {
		updateProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	}
}

function morfo_lab_submit() {
	if ($_POST["action_id"]!="_new" AND $_POST["action_id"]!="") {
		$Action=mysqlReadItem("Action",$_POST["action_id"]);
	} else {
		$Action["id"]=$_POST["id"]=$_POST["action_id"];
		$Action["actionType_id"]=$_POST["actionType_id"];
		$Action["event_id"]=$_POST["event_id"];
		$Action["parent_id"]=$_POST["parent_id"];
		$Action["setPerson_id"]=$_POST["person_id"];
		$Action["createPerson_id"]=$Action["modifyPerson_id"]=$_POST["person_id"];
		$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
		$Action["begDate"]=date("Y-m-d H:i:s");
		$Action["status"]=0;
	}
	$Action["status"]=$_POST["status"];
	if ($Action["status"]==2) {morfo_set_status($Action["parent_id"],2);} else {
		morfo_set_status($Action["parent_id"],$Action["status"]);
	}
	$fldset=getActionTypeForm('Исследование');
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	mysqlSaveItem("Action",$Action);
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {
		$Action["id"]=mysql_insert_id();
		insertProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	} else {
		updateProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	}
}

function morfo_set_status($parent_id,$status=0) {
	$reg=getActionTypeByName('Регистрация биоматериала');
	$lab=getActionTypeByName('Исследование');
	$SQL="UPDATE Action SET status={$status}, modifyDatetime = '".date("Y-m-d H:i:s")."' WHERE id = {$parent_id} ";
	mysql_query($SQL) or die ("Query failed morfo_set_status() [1]: " . mysql_error());
	$SQL="UPDATE Action SET status={$status}, modifyDatetime = '".date("Y-m-d H:i:s")."' WHERE parent_id = {$parent_id} AND ( actionType_id = {$reg} OR actionType_id = {$lab} )";
	mysql_query($SQL) or die ("Query failed morfo_set_status() [2]: " . mysql_error());
}

function morfo_get_status() {
	$data=json_decode($_POST["data"],TRUE);
	$res=array();
	foreach($data as $aid) {
		$action=mysqlReadItem("Action",$aid);
		$res[$aid]=$action["status"];
	}
	return json_encode($res);
}

?>
