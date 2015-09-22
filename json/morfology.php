<?

// Статусы морфологии
// 0 - назначено лечащим врачём
// 1 - зарегистрировано регистратором
// 2 - завершено
// 3 - отмена исследования
// 4 - описано лаборантом
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
engineSettingsRead();
include_once($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
parse_str($_SERVER["REQUEST_URI"],$tmp);
if (isset($tmp["person_id"])) {parse_str($_SERVER["REQUEST_URI"],$_SESSION["dr"]);}
prepareSessions();
//$_SESSION["allow"]=array("Врач","Регистратор ЛД","Врач ЛД","Заведующий ЛД");
//if (!checkAllow()) {die ("Ошибка прав доступа!");}
$mode=$_GET["mode"];
if (is_callable($mode)) {echo @$mode();} else {echo "No function: ".$mode;}
// =================================================

function test($action_id) {
	$out=getActionProperties($action_id);
	return $out;
}

function get_morfo_num($year=NULL) {
	$res = [];
	$parentAction = [];
	if ($year==NULL) {$year=date('Y');}

	$actionId = $_GET["parent_id"];
	$parentAction = mysqlReadItem('Action',$actionId);
	$tissueId = $parentAction['takenTissueJournal_id'];
	if (isset($tissueId)){
		$tissue = [];
		$tissue = mysqlReadItem('TakenTissueJournal',$tissueId);
		$res["count"] = $tissue['externalId'];
	}
	else $res["count"] = recountTissueExternalId(5);
	$res["units"]=0;
	
	$form=getActionTypeForm('Регистрация биоматериала');
	foreach($form as $key => $line) {
		if ($line["label"]=="Количество кусочков") {
			$type_id=$line["id"];
			$type=$line["type"];
		}
	}
	$SQL="SELECT SUM(s.value) FROM ActionProperty as 
	a INNER JOIN ActionProperty_".$type." as s ON a.id=s.id 
	WHERE a.type_id = ".$type_id." ";
	$result=mysql_query($SQL) or die ("Query failed getMorfoNum() [2]: " . mysql_error());
	while($data = mysql_fetch_array($result)) {$res["units"]=$data[0];}
	return json_encode($res);
}


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
	$Action["begDate"]=$Action["plannedEndDate"]=date("Y-m-d H:i:s");
}
if ($_GET["copy"]>0) {
		$parent_id=$_GET["copy"];
		$Action["id"]=$_POST["action_id"]="_new";
		$Action["actionType_id"]=$_POST["actionType_id"];
		$Action["setPerson_id"]=$_POST["setPerson_id"]=$_POST["person_id"];
		$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
		$Action["begDate"]=date("Y-m-d H:i:s");
		$Action["cancelNote"]="";
		$Action["status"]=0;
} 

	if ($_POST["fld_19"]>"") {$Action["status"]=2;} 
	$Action["isUrgent"]=$_POST["isUrgent"];
	$Action["plannedEndDate"]=date("Y-m-d H:i:s",strtotime($_POST["plannedEndDate"]));
	$Action["modifyPerson_id"]=$_POST["person_id"];
	mysqlSaveItem("Action",$Action);
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {$Action["id"]=mysql_insert_id();}
	$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
	INNER JOIN ActionType as b ON a.actionType_id=b.id
	WHERE b.id=".$Action["actionType_id"]."
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
if ($_GET["copy"]>0) {
// ========== Копируем регистрацию и описание ===========
	$parent_id=$_GET["copy"];
	$reg=getActionTypeByName('Регистрация биоматериала');
	$SQL="SELECT id FROM Action WHERE actionType_id = {$reg} AND parent_id = {$parent_id} ";
	$result=mysql_query($SQL) or die ("Query failed morfo_nazn_submit() [copy reg]: " . mysql_error());
	$reg_id=false; while($data = mysql_fetch_array($result)) {$reg_id=$data["id"];}
	if ($reg_id) {
		$Reg=mysqlReadItem("Action",$reg_id);
		$Reg["id"]="_new";
		$Reg["parent_id"]=$Action["id"];
		$Reg["createDatetime"]=$Reg["modifyDatetime"]=date("Y-m-d H:i:s");
		$Reg["begDate"]=$Action["plannedEndDate"]=date("Y-m-d H:i:s");
		mysqlSaveItem("Action",$Reg); $newReg_id=mysql_insert_id();
		$RegProp=getActionTypeForm('Регистрация биоматериала',$reg_id); 
		insertProperties($RegProp,$newReg_id,$_POST["setPerson_id"],$reg);
	} else {$Reg=NULL;}
	
	$lab=getActionTypeByName('Исследование биоматериала');
	$SQL="SELECT id FROM Action WHERE actionType_id = {$lab} AND parent_id = {$parent_id} ";
	$result=mysql_query($SQL) or die ("Query failed morfo_nazn_submit() [copy lab]: " . mysql_error());
	$lab_id=false; while($data = mysql_fetch_array($result)) {$lab_id=$data["id"];}
	if ($lab_id) {
		$Lab=mysqlReadItem("Action",$lab_id);
		$Lab["id"]="_new";
		$Lab["parent_id"]=$Action["id"];
		$Lab["createDatetime"]=$Reg["modifyDatetime"]=date("Y-m-d H:i:s");
		$Lab["begDate"]=$Action["plannedEndDate"]=date("Y-m-d H:i:s");
		mysqlSaveItem("Action",$Lab); $newLab_id=mysql_insert_id();
		$LabProp=getActionTypeForm('Исследование биоматериала',$lab_id); 
		insertProperties($LabProp,$newLab_id,$_POST["setPerson_id"],$lab);
	} else {$Lab=NULL;}
	$Action["status"]=getMorfoStatus($action_id,$Action,$Reg,$Lab);
	mysqlSaveItem("Action",$Action); // Ещё раз сохраняем с изменившимися статусами
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
		$Action["person_id"]=$_POST["person_id"];
		$Action["createPerson_id"]=$Action["modifyPerson_id"]=$_POST["person_id"];
		$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
		$Action["begDate"]=date("Y-m-d H:i:s");
		$Action["status"]=0;
	}
	
	$Action["status"]=$_POST["status"];
	//if ($Action["status"]<=2) {morfo_set_status($Action["parent_id"],$Action["status"]);}
	$fldset=getActionTypeForm('Регистрация биоматериала');
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	mysqlSaveItem("Action",$Action);
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {
		$Action["id"]=mysql_insert_id();
		insertProperties($fldset,$Action["id"],$Action["person_id"],$Action["actionType_id"]);
	} else {
		updateProperties($fldset,$Action["id"],$Action["person_id"],$Action["actionType_id"]);
	}
	morfo_set_status($Action["parent_id"],getMorfoStatus($Action["parent_id"]));
	$Action["assist_id"]=$_POST["assist_id"];
	$Action["id"]= $Action["parent_id"];
	actionAssistSave($Action,'morfoReg');

	$tissueNumber = $_POST['fld_0'];
	$numbers = explode('/',$tissueNumber);
	$lowNumber = $numbers[2];
	$event = mysqlReadItem("Event",$_POST['event_id']);
	$tissueId = saveTakenTissueRecord($lowNumber,$event["client_id"],$Action["person_id"],5);
	$parentAction= [];
	$parentAction['id'] = $Action['parent_id'];
	$parentAction['takenTissueJournal_id'] = $tissueId;
	mysqlSaveItem('Action',$parentAction); 
	$parentActionType = getActionTypeByActionId($parentAction['id']);
	$parentPersonId = $Action['person_id'];
	setProperty($Action['parent_id'],'№ исследования',$lowNumber,$parentActionType,$parentPersonId);
 
}

function morfo_lab_submit() {
	if ($_POST["action_id"]!="_new" AND $_POST["action_id"]!="") {
		$Action=mysqlReadItem("Action",$_POST["action_id"]);
	} else {
		$Action["id"]=$_POST["id"]=$_POST["action_id"];
		$Action["actionType_id"]=$_POST["actionType_id"];
		$Action["event_id"]=$_POST["event_id"];
		$Action["parent_id"]=$_POST["parent_id"];
		$Action["person_id"]=$_POST["person_id"];
		$Action["createPerson_id"]=$Action["modifyPerson_id"]=$_POST["person_id"];
		$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
		$Action["begDate"]=date("Y-m-d H:i:s");
		$Action["status"]=1;
	}
	$Action["status"]=$_POST["status"];
	if ($Action["person_id"]=="" && $_SESSION["user_role"]=="Врач ЛД") {$Action["person_id"]=$_SESSION["user_id"];}
//	if ($Action["status"]==2) {morfo_set_status($Action["parent_id"],1);} else {
//		morfo_set_status($Action["parent_id"],$Action["status"]);

	$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, a.userProfile_id, b.id FROM ActionPropertyType as a
	INNER JOIN ActionType as b ON a.actionType_id=b.id
	WHERE b.id='{$_POST["actionType_id"]}'   
	ORDER BY a.idx	";
	$fldset=getActionTypeForm($SQL);
	//$fldset=getActionTypeForm('Исследование биоматериала');
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	mysqlSaveItem("Action",$Action);
	if ($_POST["action_id"]=="_new" OR $_POST["action_id"]=="") {
		$Action["id"]=mysql_insert_id();
		insertProperties($fldset,$Action["id"],$Action["person_id"],$Action["actionType_id"]);
	} else {
		updateProperties($fldset,$Action["id"],$Action["person_id"],$Action["actionType_id"]);
	}
	morfo_set_status($Action["parent_id"],getMorfoStatus($Action["parent_id"]));
}

function morfo_set_status($parent_id,$status=0) {
	$reg=getActionTypeByName('Регистрация биоматериала');
	$lab=getActionTypeByName('Исследование биоматериала');
	$SQL="UPDATE Action SET status={$status}, modifyDatetime = '".date("Y-m-d H:i:s")."' WHERE id = {$parent_id} ";
	mysql_query($SQL) or die ("Query failed morfo_set_status() [1]: " . mysql_error());
	$SQL="UPDATE Action SET status={$status}, modifyDatetime = '".date("Y-m-d H:i:s")."' WHERE parent_id = {$parent_id} AND ( actionType_id = {$reg} OR actionType_id = {$lab} )";
	mysql_query($SQL) or die ("Query failed morfo_set_status() [2]: " . mysql_error());
}

function get_lab_form() {
$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, a.userProfile_id, b.id FROM ActionPropertyType as a
	INNER JOIN ActionType as b ON a.actionType_id=b.id
	WHERE b.id='{$_GET["atid"]}'   
	ORDER BY a.idx	";
	$fields=getActionTypeForm($SQL,$_GET["aid"]);
	$Item["id"]=$_GET["aid"];
	$form=phpQuery::newDocument("");
	foreach($fields as $key => $fld) {
		pq($form)->append("<div><label>{$fld["label"]}</label>{$fld["input"]}</div>");
		pq($form)->find("div:last")->find("input,select")->attr("value",$fld["value"]);
		pq($form)->find("div:last")->find("textarea")->html($fld["value"]);
	}
	return pq($form)->htmlOuter();
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
		$action["status"]=getMorfoStatus($aid);
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

function recountTissueExternalId($tissueType){
	$SQL = "SELECT COUNT(id) as cnt
			FROM pato.TakenTissueJournal
			WHERE tissueType_id = $tissueType";
	$result = mysql_query($SQL) or die ("Query failed recountTissueExternalId() [2]: " . mysql_error());
	$data = mysql_fetch_array($result);
	$existCountValue = $data['cnt'];
	$existCountValue += 1;
	return $existCountValue;

}
function saveTakenTissueRecord($externalId,$client_id,$personId,$tissueType){
	$dateToday = date("Y-m-d H:i:s");
	$SQL = "INSERT INTO TakenTissueJournal(createDatetime,createPerson_id,client_id,tissueType_id,externalId,number,datetimeTaken,execPerson_id,status)
	VALUES('$dateToday',$personId,$client_id,$tissueType,$externalId,$externalId,'$dateToday',$personId,3)";
	mysql_query($SQL) or die ("Query failed saveTakenTissueRecord() [2]: " . mysql_error());
	$tissueId = mysql_insert_id();
	return $tissueId;
}

?>
