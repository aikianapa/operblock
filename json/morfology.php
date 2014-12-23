<?
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
engineSettingsRead();
include_once($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
$mode=$_GET["mode"];
if (is_callable($mode)) {echo @$mode();} else {echo "No function: ".$mode;}
// =================================================

function morfo_nazn_submit() {
if ($_POST["isUrgent"]=="on") {$_POST["isUrgent"]=1;} else  {$_POST["isUrgent"]=0;}
if ($_POST["action_id"]!="_new" AND $_POST["action_id"]!="") {
	$Action=mysqlReadItem("Action",$_POST["action_id"]);
} else {
	if ($_POST["person_id"]=="") $_POST["person_id"]=3701;
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
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {$Action["id"]=mysql_insert_id();}
	$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
	INNER JOIN ActionType as b ON a.actionType_id=b.id
	WHERE b.id=".$_POST["actionType_id"]."
	ORDER BY a.idx	";
	$fldset=getActionTypeForm($SQL);
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {
		insertProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	} else {
		updateProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	}
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
	if ($Action["status"]<=2) {morfo_set_status($Action["parent_id"],$Action["status"]);}
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

function morfo_actions_list() {
$actionType_id=getActionTypeByName("Патоморфологические исследования");
$SQL="SELECT * FROM ActionType WHERE group_id = $actionType_id ORDER BY name ASC";
$result = mysql_query($SQL) or die("Query failed: (nazn_oper_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$Item["id"]=$data["id"];
	$Item["name"]=$data["title"];
	$array[]=$Item;	
}
mysql_free_result($result);
return json_encode($array);
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

function cancel_morfo() {
	if ($_POST["filter"]==1) {
		$action=mysqlReadItem("Action",$_POST["action_id"]);
		$_action=jdbReadItem("Action",$_POST["action_id"]);
		$action["modifyPerson_id"]=$_POST["person_id"];
		$action["modifyDatetime"]=date("Y-m-d H:i:s");
		$action["status"]=3;
		$_action["cancelNote"]=$_POST["cancelNote"];
		mysqlSaveItem("Action",$action);
		jdbSaveItem("Action",$_action); 
		return 0;
	}
}

function report_orgstr() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/morfoReport_1.php");
$date=$ndate=date("Y-m-d");
$where="";
if ($_POST["begDateR"]>"") {$date=$_POST["begDateR"]; $Item["begDate"]=$_POST["begDateR"];}
if ($_POST["endDateR"]>"") {$ndate=$_POST["endDateR"]; $Item["endDate"]=$_POST["endDateR"];}
if (isset($_POST["urgent"]) AND !isset($_POST["planed"])) { $where.=" AND isUrgent = 1 "; }
if (isset($_POST["planed"]) AND !isset($_POST["urgent"])) { $where.=" AND isUrgent = 0 "; }
if (is_array($_POST["orgStr"])) {
	$where.=" AND (";
	foreach ($_POST["orgStr"] as $orgStr) { $where.=" c.orgStructure_id = $orgStr OR"; }
	$where=substr($where,0,-3).")";
}
if (is_array($_POST["actionType_id"])) {
	$where.=" AND (";
	foreach ($_POST["actionType_id"] as $atype) { $where.=" a.actionType_id = $atype OR"; }
	$where=substr($where,0,-3).")";
}
$actionType_id=getActionTypeByName("Патоморфологические исследования");

$SQL="SELECT a.id FROM Action as a INNER JOIN ActionType as b on a.ActionType_id=b.id INNER JOIN Person as c ON a.setPerson_id=c.id
	WHERE b.group_id=$actionType_id 
	AND ( (a.begDate BETWEEN '$date' AND '$ndate 23:59:59' ) OR ( a.plannedEndDate BETWEEN '$date' AND '$ndate 23:59:59' ) )
	$where ORDER BY a.id DESC ";
		$org=array();
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["count"]=1;
			if ($action["isUrgent"]==1) {$action["isUrgent"]="urgent";} else {$action["isUrgent"]="planed";}
			if (!isset($action["problem"])) $action["problem"]="";
			$counter++; $action["counter"]=$counter;
			if (!isset($_POST["problem"])) {$result[]=$action;} else {
					if ($action["problem"]>"") {$result[]=$action;}
			}
			if (!in_array($action["orgStr_id"],$org)) {$org[$action["orgStr_id"]]["oid"]=$action["orgStr_id"]; $org[$action["orgStr_id"]]["name"]=$action["orgStructure"];}
		}
		$Item["result"]=$result;
		$Item["org"]=$org;
$out=contentSetData($out,$Item);
// Сортируем строки
foreach(pq($doc)->find("table tr.action") as $otd) {
	$oid=pq($otd)->attr("oid");
	$urg=pq($otd)->attr("urg");
	$type=pq($otd)->attr("type");
	$line=pq($doc)->find("table div.".$urg."[oid=".$oid."]")->find("tr[type=".$type."]");
	if ($line->length() AND !isset($_POST["details"])) {
		$line->find("td.count")->html( $line->find("td.count")->html() + 1 );
		pq($otd)->remove();
	} else {
		pq($doc)->find("table div.".$urg."[oid=".$oid."]")->append($otd);
	}
}

// Считаем итоги
$total_urg=0; $total_pln=0;
foreach(pq($doc)->find("table div.otd") as $otd) {
	$urgent=0; $planed=0;
	foreach(pq($otd)->find("div.urgent")->find("tr > td.count") as $urg) {
		$urgent+=pq($urg)->text();
	}
	pq($otd)->find("div.urgent")->next("tr.total")->find("td.count")->html($urgent);
	foreach(pq($otd)->find("div.planed")->find("tr > td.count") as $pln) {
		$planed+=pq($pln)->text(); 
	}
	pq($otd)->find("div.planed")->next("tr.total")->find("td.count")->html($planed);
	pq($otd)->next("tr.total")->find("td.count")->html( $urgent + $planed);
	$total_urg+=$urgent; $total_pln+=$planed;
}
pq($doc)->find("table tr.total_urg")->find("td.count")->html($total_urg);
pq($doc)->find("table tr.total_pln")->find("td.count")->html($total_pln);
pq($doc)->find("table tr.total_otd")->find("td.count")->html($total_urg+$total_pln);

// Преобразуем формат
if (!isset($_POST["details"])) {pq($doc)->find("td.details")->remove();} else {
	pq($doc)->find("tr[type]")->find("td.count")->remove();
}
return $out;
}


?>
