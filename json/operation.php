<?
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
engineSettingsRead();
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
include($_SERVER['DOCUMENT_ROOT']."/functions.php");
$mode=$_GET["mode"];
if (is_callable($mode)) {echo @$mode();}

// =================================================

// function get_action_status() - в functions.php

function getSessId() {
	return json_encode(session_id());
}


function nazn_sisteran_list() {
$orgId=$_GET["orgId"];
$SQL="SELECT * FROM Person as a
INNER JOIN rbUserProfile as b ON a.userProfile_id=b.id
WHERE b.code='anestezsister_ob' ";
$result = mysql_query($SQL) or die("Query failed: (nazn_sister_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
 $array[]=$data;
}
mysql_free_result($result);
return json_encode($array);
}

function insert_properties() {
	$data=json_decode($_POST["data"],1);
	insertProperties($data,$_POST["action_id"],$_POST["person_id"],$_POST["actionType_id"]);
}

function get_diagnoses() {
$event_id=$_GET["event_id"];
$diagnoses=patientGetDiagnosis($event_id);
return json_encode($diagnoses);
}

function get_table_data() {
	$date=$_GET["date"];
	$orgStr_id=$_GET["orgStr_id"];
	$tid=$_GET["tid"];
	$data=getTableData($date,$orgStr_id,$tid);
	return json_encode($data);
}

function sisteran_spisanie_submit() {
 return sisterob_spisanie_submit();
}

function sisterob_spisanie_submit() {
		$stockMotion="StockMotion";
		$action_id = $_POST["action_id"];
		$person_id = $_POST["person_id"];
		//$dateTime = $_POST["dateTime"];
		$drugs=$_POST["drugs"];
		$_action=jdbReadItem("Action",$action_id);
		$action=mysqlReadItem("Action",$action_id);
		$_action["id"]=$action_id;
    if ($_GET["mode"]=="sisterob_spisanie_submit") {$role="ob";}
	if ($_GET["mode"]=="sisteran_spisanie_submit") {$role="an"; }
		$dateTime=$action["begDate"];
		$Item=array();	
		$Item["id"]="";
		$Item["createDatetime"]=date("Y-m-d h:i:s");
		$Item["createPerson_id"]=$person_id;
    if ($_action["spisanie_$role"]>"") {$Item=mysqlReadItem($stockMotion,$_action["spisanie_$role"]);}
  
		$Item["modifyDatetime"]=date("Y-m-d h:i:s");
		$Item["modifyPerson_id"]=$person_id;
		$Item["dateTime"]=date("Y-m-d h:i:s",strtotime($dateTime));
		$Item["number"]=NULL;
		$Item["type"]=1	;
		$Item["action_id"]=$action_id;
		$error=mysqlSaveItem($stockMotion,$Item);
		$ins_id=mysql_insert_id();
		if ($ins_id>"") $_action["spisanie_$role"]=$ins_id;
		if ($role=="ob" AND $_action["operSister_id"]=="") {$_action["operSister_id"]=$person_id;}
		if ($role=="an" AND $_action["an_sister_id"]=="") {$_action["an_sister_id"]=$person_id;}
		jdbSaveItem("Action",$_action);
		$SQL="DELETE QUICK FROM {$stockMotion}_Item WHERE master_id = ".$_action["spisanie_$role"];
		$result = mysql_query($SQL) or die("Query failed: (sisterob_spisanie_submit - DELETE) " . mysql_error());
		foreach($drugs as $key => $data) {
			$Drugs=array();
			$Drugs["master_id"]=$_action["spisanie_$role"];
			$Drugs["nomenclature_id"]="".$key;
			$Drugs["qnt"]=$data;
			$Drugs["event_id"]=$action["event_id"];
			if ($Drugs["qnt"]>0) {	mysqlSaveItem("{$stockMotion}_Item",$Drugs); }
		}
		if ($error=="" OR $error==0) {
			$error=0;
		}
		$res["error"]=$error;
		mysql_free_result($result);
		return json_encode($res);
}
 
function zavnazn_get_data() {
	$action=getActionInfo($_GET["action_id"]);
	$_operation["operation"]=jdbReadItem("Operation",$_GET["action_id"]);
	$res=array_merge($action,$_operation);
	return json_encode($res);
}

function get_operation_protocol() {
	$item=array();
	$action_id=$_GET["action_id"];
	$aType='Протокол операции';
	$form=getActionTypeForm($aType);
	$aType_id=getActionTypeByName($aType);
	$SQL="SELECT id FROM Action WHERE actionType_id = ".$aType_id." AND parent_id = ".$action_id." LIMIT 1";
	$result = mysql_query($SQL) or die("Query failed: (hirurg_oper_submit) " . mysql_error());
	$action_id="_new";	while($data = mysql_fetch_array($result)) {	$action_id=$data["id"];	}
	if ($action_id=="_new") {
		// Если Action не существует, пытаемся прочитать данные в JsonData
		$item=jdbReadItem("Operation",$_GET["action_id"]);		
	} else {
		$form=getActionTypeForm('Протокол операции');
		$item["id"]=$action_id;
		$item=getActionPropertyFormData($item,$form);
	}
	return json_encode($item);
}


function mainsister_set_table() {
	$_action=jdbReadItem("Action",$_GET["action_id"]);
	$action=mysqlReadItem("Action",$_GET["action_id"]);
	$_action["id"]=$_GET["action_id"];
	$_action["table"]=$_GET["table"];
	$_action["index"]=$_GET["idx"];
	$_action["orgid"]=$_GET["oid"]; // Если операция перенесена на стол не своего отделения
	$action["status"]=get_action_status($_GET["action_id"],$action,$_action);
	jdbSaveItem("Action",$_action);
	mysqlSaveItem("Action",$action);
}

function mainsister_set_oproom() {
	$date=$_GET["date"];
	$oper=$_GET["oper"];
	$oid=$_GET["oid"];
	$tid=$_GET["tid"];
	$index=$_GET["idx"];
	$oprooms=jdbReadItem("opRooms",$_GET["date"]);
	$oprooms["id"]=$date;
	$oprooms[$oid][$tid]=array();
	$oprooms[$oid][$tid]["index"]=$index;
	$oprooms[$oid][$tid]["oper"]=$oper;
	if ($oper=="") { unset ($oprooms[$oid][$tid]); } 
	jdbSaveItem("opRooms",$oprooms);
}


function mainsister_get_oproom() {
	$date=$_GET["date"];
	$oprooms=jdbReadItem("opRooms",$_GET["date"]);
	unset($oprooms["id"]);
	return json_encode($oprooms);
}

function mainsis_oproom_submit() {
	$actions=$_POST["aid"];
	$oper=$_POST["oper_id"];
	$date=$_POST["begDate"];
	mainsis_oproom_aprove($date,$oper);
	if ($_SESSION["settings"]["appId"]!="msk36") {
		unset($_POST["aid"]);
		unset($_POST["oper_id"]);
		unset($_POST["person_id"]);
		foreach($actions as $action_id) {
			$_POST["action_id"]=$action_id;	
			zavnazn_oper_submit();
		}
	}
}

function mainsis_oproom_aprove($date,$oper,$res=TRUE) {
	$oprooms=jdbReadItem("opRooms",$date);
	if ($res==TRUE) {
		$oprooms["approve"][$oper]=TRUE;	
	} else {
		unset($oprooms["approve"][$oper]);
	}
	jdbSaveItem("opRooms",$oprooms);
}

function mainsister_oper_submit() {
	unset($_POST["oper_id"]);
	unset($_POST["person_id"]);
	zavnazn_oper_submit();
}

function zavedan_oproom_submit() {
	$actions=$_POST["aid"];
	unset($_POST["aid"]);
	unset($_POST["oper_id"]);
	unset($_POST["person_id"]);
	foreach($actions as $action_id) {
		$_POST["action_id"]=$action_id;	
		zavnazn_oper_submit();
	}
}

function epicriz_out_submit() {
	
if ($_POST["action_id"]=="_new") {
	$action=array(); $_action=array();
	$action["id"]=$_POST["action_id"];
	$action["id"]=$_POST["id"]=$_POST["action_id"];
	$action["actionType_id"]=$_POST["actionType_id"];
	$action["event_id"]=$_POST["event_id"];
	$action["setPerson_id"]=$_POST["setPerson_id"]=$_POST["person_id"];
	$action["createPerson_id"]=$action["modifyPerson_id"]=$_POST["person_id"];
	$action["createDatetime"]=$action["modifyDatetime"]=date("Y-m-d H:i:s");
	$action["begDate"]=date("Y-m-d H:i:s");
	mysqlSaveItem("Action",$action);
	$action["id"]=mysql_insert_id();
} else {
	$action=mysqlReadItem("Action",$_POST["action_id"]);
	$_action=jdbReadItem("Action",$_POST["action_id"]);
}
$action["endDate"]=setRusDate($_POST["endDate"]);
$action["status"]=2;
$epic=array();
foreach($_POST["fld"] as $key => $val) {
	$epic[$key]["fld"]=$val;
	$epic[$key]["val"]=$_POST["val"][$key];
}

foreach($_POST as $key => $val) {
	if (substr($key,0,2)=="e_") {$epic[$key]=$_POST[$key];}
}


$_action["toOrg"]=$_POST["toOrg"];
$_action["id"]=$action["id"];
$_action["epic_out"]=$epic;
mysqlSaveItem("Action",$action);
jdbSaveItem("Action",$_action);
}

function epicriz_submit() { popup_submit("epicriz"); }
function histology_submit() {popup_submit("histology");}
function citology_submit() { popup_submit("citology"); }
function imuno_submit() { popup_submit("imuno"); }
function popup_submit($name) {
	$_action=jdbReadItem("Action",$_POST["action_id"]);
	if (!isset($_action["id"])) {$_action["id"]=$_POST["action_id"];}
	unset($_POST["action_id"]);
	foreach($_POST as $key => $val) {$_action[$name][$key]=$val;}
	jdbSaveItem("Action",$_action);	
}

function zavnazn_oper_submit() {
// Подтверждение назначения на операцию завотделением
$action=mysqlReadItem("Action",$_POST["action_id"]);
$_action=jdbReadItem("Action",$_POST["action_id"]);
$_action["id"]=$_POST["action_id"];
if (date("Y",strtotime($_POST["begDate"]))>"1970") {$action["plannedEndDate"]=NULL;}
$action["modifyDatetime"]=date("Y-m-d H:i:s");
if (isset($_POST["begDate"])) {$action["begDate"]=date("Y-m-d 00:00:00",strtotime($_POST["begDate"]));}
if (isset($_SESSION["user_id"])) {$action["modifyPerson_id"]=$_SESSION["user_id"];}
if (isset($_POST["note"])) {$action["note"]=$_POST["note"];}
if (isset($_POST["isUrgent"])) {$action["isUrgent"]=$_POST["isUrgent"]; } 
if (isset($_POST["modifyPerson_id"])) {$action["modifyPerson_id"]=$_POST["modifyPperson_id"];}
if (isset($_POST["assist_name"])) {$_action["assist_name"]=$_POST["assist_name"];}
if (isset($_POST["assist_id"])) {$_action["assist_id"]=$_POST["assist_id"]; $role="zavnazn";}
if (isset($_POST["hemo_id"])) {$_action["hemo_id"]=$_POST["hemo_id"];}
if (isset($_POST["person_id"])) {$action["person_id"]=$_POST["person_id"];}
if (isset($_POST["dejur_id"])) {$_action["dejur_id"]=$_POST["dejur_id"];}
if (isset($_POST["dejur_assist"])) {$_action["dejur_assist"]=$_POST["dejur_assist"];}
if (isset($_POST["an_person_id"])) {$_action["an_person_id"]=$_POST["an_person_id"]; $role="anest";}
if (isset($_POST["an_sister_id"])) {$_action["an_sister_id"]=$_POST["an_sister_id"];}
if (isset($_POST["an_posobie"])) {$_action["an_posobie"]=$_POST["an_posobie"];}
if (isset($_POST["operSister_id"])) {$_action["operSister_id"]=$_POST["operSister_id"]; $role="mainsister";}
if (isset($_POST["sanitar"])) {$_action["sanitar"]=$_POST["sanitar"];}
if (isset($_POST["zam_ok"])) {$_action["zam_ok"]=$_POST["zam_ok"];}
if (isset($_POST["assist_id"])) {$_action["zav_ok"]=1;}
if (isset($_POST["operSister_id"])) {$_action["sis_ok"]=1;}
if (isset($_POST["begTime"])) {$_action["begTime"]=$_POST["begTime"];}
if (!isset($_action["index"])) {$_action["index"]=0;}
$action["status"]=get_action_status($_POST["action_id"],$action,$_action);
mysqlSaveItem("Action",$action);
jdbSaveItem("Action",$_action);
$action=array_merge($action,$_action);
if (isset($_POST["assist_id"]) AND isset($_POST["an_person_id"])) {$role="zamglav";}
actionAssistSave($action,$role);
$res=0;
return json_encode($res);
}

function zamglav_multi_approve() {
	$date=$_POST["date"];
	$aid=$_POST["aid"];
	foreach($aid as $action_id) {
		$_POST=array();
		$_POST["action_id"]=$action_id;
		$_POST["begDate"]=$date;
		$_POST["zam_ok"]=1;
		$_POST["status"]=1;
		zavnazn_oper_submit();
	}
}

function check_approved_table() {
	$res=checkApprovedTable($_GET["date"],$_GET["orgStr_id"],$_GET["tid"]);
	return  json_encode($res);
}

function check_approved_oproom() {
	$res=checkApprovedOproom($_GET["date"],$_GET["oper"]);
	return  json_encode($res);
}

function zavtable_check_operation() {
	$multiflds=array("person_id","hemo_id","assist_id","assist_name","dejur_id","note");
	$data=$_POST["data"];
	$acts_id=explode($_POST["actions"],",");
	$res=array();
	foreach($acts_id as $k => $action_id) {
		$action=mysqlReadItem("Action",$action_id);
		$_action=jdbReadItem("Action",$action_id);
		$action=array_merge($action,$_action);
		foreach($multiflds as $key => $val) {
			if (isset($action[$val]) AND $action[$val]!=$data["val"]) {
				$res[$action_id]=$action_id;
				$res[$action_id][$val]["from"]=$action[$val];
				$res[$action_id][$val]["to"]=$data[$val]; 
			}
		}		
	}
	return json_encode($res);
	
}

function zavtable_copytable() {
	$_POST["begDate"]=$_POST["workDate"];
	foreach($_GET["aid"] as $key => $action_id) {
		$_POST["action_id"]=$action_id;
		 zavnazn_oper_submit();
	}
}

function zavtable_submit() { 
	$Item=jdbReadItem("Tables",$_POST["workDate"]);
	$Item["id"]=$_POST["workDate"];
	$fld=array("person_id","hemo_id","assist_id","assist_name","dejur_id","note");
	// РАБОТАЕТ
	$data=array();
	foreach($fld as $key => $val) {$data[$val]=$_POST[$val]; 	}
	$Item[$_POST["orgStr_id"]][$_POST["table"]]=$data;
	$error=jdbSaveItem("Tables",$Item);
	if ($error=="") {$error=0;}
	$res["error"]=$error;
	return json_encode($res);
}

function mainsister_add_table() {
	$oid=$_GET["oid"];
	$tid=$_GET["tid"];
	$date=$_GET["date"];
	$Item=jdbReadItem("Tables",$date);
	$Item[$oid][$tid]="1";
	$error=jdbSaveItem("Tables",$Item);
	if ($error=="") {$error=0;}
	$res["error"]=$error;
	return json_encode($res);

}
 
function nazn_oper_submit() {
// Запись нового назначения на операцию
$Item=$_POST;
$Item["createDatetime"]=date( "Y-m-d H:i:s" );
$Item["plannedEndDate"]=date("Y-m-d H:i:s", strtotime($Item["plannedEndDate"]));
$Item["modifyDatetime"]=$Item["createDatatime"];
$Item["modufyPerson_id"]=$Item["createPerson_id"];
if ($Item["isUrgent"]=="on" OR $Item["isUrgent"]=="1") {	$Item["isUrgent"]=1; } else {$Item["isUrgent"]=0;	}

$error=mysqlSaveItem("Action",$Item);
$res["id"]=mysql_insert_id();
if ($error=="") {$error=0;}
$res["error"]=$error;
return json_encode($res);
}

function hirurg_oper_submit() {
$_POST["id"]=$_POST["action_id"];
$Item=$_POST;
unset($_POST["action_id"]);
//$error=jdbSaveItem("Operation",$Item); 
//if ($error=="") {$error=0; }
	$Parent=mysqlReadItem("Action",$Item["action_id"]);
	$Parent["status"]=2;
	$Parent["endDate"]=$Item["endDate"];
	$Parent["modufyPerson_id"]=$_POST["person_id"];
	$error=mysqlSaveItem("Action",$Parent);
	
	

// Ищем Action
$SQL="SELECT id FROM Action WHERE actionType_id = ".$_POST["actionType_id"]." AND parent_id = ".$Parent["id"]." LIMIT 1";
$result = mysql_query($SQL) or die("Query failed: (hirurg_oper_submit) " . mysql_error());
$action_id="_new";	while($data = mysql_fetch_array($result)) {	$action_id=$data["id"];	}
	
	
	if ($action_id!="_new") {
		$Action=mysqlReadItem("Action",$action_id);
	} else {
		$Action["id"]=$action_id;
		$Action["actionType_id"]=$_POST["actionType_id"];
		$Action["event_id"]=$Parent["event_id"];
		$Action["parent_id"]=$Parent["id"];
		$Action["setPerson_id"]=$_POST["person_id"];
		$Action["createPerson_id"]=$Action["modifyPerson_id"]=$_POST["person_id"];
		$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
		$Action["begDate"]=date("Y-m-d H:i:s");
		$Action["status"]=2;
	}
	$fldset=getActionTypeForm('Протокол операции');
	foreach($fldset as $i => $fld) {
		$fldset[$i]["value"]=$_POST[$fld["name"]];
		if ($fld["type"]=="JobTicket") {unset($fldset[$i]);}
	}
	mysqlSaveItem("Action",$Action);
	if ($action_id=="_new") {
		$Action["id"]=mysql_insert_id();
		insertProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	} else {
		updateProperties($fldset,$Action["id"],$Action["setPerson_id"],$Action["actionType_id"]);
	}
	
$res["error"]=$error;
return json_encode($res);
}

function cancel_operation() {
	$action["modifyDatetime"]=date("Y-m-d H:i:s");
	$action["modufyPerson_id"]=$_POST["person_id"];
	$action=mysqlReadItem("Action",$_POST["action_id"]);
	$_action=jdbReadItem("Action",$_POST["action_id"]);
	$action["status"]=3;
	$_action["cancelNote"]=$_POST["cancelNote"];
	mysqlSaveItem("Action",$action);
	jdbSaveItem("Action",$_action); 
	return 0;
}

function nazn_oper_list() {
$orgStrId=$_GET["orgStrId"];
$SQL="SELECT * FROM ActionType  
  WHERE ActionType.serviceType = 4  AND class=2
  ORDER BY code ASC";
$result = mysql_query($SQL) or die("Query failed: (nazn_oper_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
 $Item["id"]=$data["id"];
 $Item["code"]=$data["code"];
 $Item["name"]=$data["name"];
 $array[]=$Item;
}
mysql_free_result($result);
return json_encode($array);
}

function nazn_person_list() {
$orgStrId=$_GET["orgStrId"];
$SQL="SELECT a.* FROM Person as a 
INNER JOIN OrgStructure as b ON a.orgStructure_id=b.id
INNER JOIN rbSpeciality as c ON a.speciality_id=c.id
WHERE b.name LIKE '%хирург%' and c.name NOT LIKE '%сестр%' AND retired=0
OR (a.lastname='Ильин' AND a.firstname='Николай' AND a.patrname='Дмитриевич')
OR (a.lastname='Пискунов' AND a.firstname='Евгений' AND a.patrname='Александрович')
OR (a.lastname='Новиков' AND a.firstname='Сергей' AND a.patrname='Николаевич')
OR (a.lastname='Гиршович' AND a.firstname='Михаил' AND a.patrname='Маркович')
OR (a.lastname='Силков' AND a.firstname='Вячеслав' AND a.patrname='Борисович')
OR (a.lastname='Готовчикова' AND a.firstname='Мария' AND a.patrname='Юрьевна') 
OR (a.lastname='Ткаченко' AND a.firstname='Олег' AND a.patrname='Борисович')
OR (a.lastname='Сенчуров' AND a.firstname='Евгений' AND a.patrname='Михайлович')
OR (a.lastname='Розенгард' AND a.firstname='Сергей' AND a.patrname='Аркадьевич')
ORDER BY lastname";
$result = mysql_query($SQL) or die("Query failed: (nazn_person_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$array[]=$data;
}
mysql_free_result($result);
return json_encode($array);
}

function nazn_hirurg_list() {
$orgStrId=$_GET["orgStrId"];

$SQL="SELECT a.* FROM Person as a 
INNER JOIN OrgStructure as b ON a.orgStructure_id=b.id
INNER JOIN rbSpeciality as c ON a.speciality_id=c.id
WHERE b.name LIKE '%хирург%' and c.name NOT LIKE '%сестр%' AND retired=0 
OR (a.lastname='Ильин' AND a.firstname='Николай' AND a.patrname='Дмитриевич')
OR (a.lastname='Пискунов' AND a.firstname='Евгений' AND a.patrname='Александрович')
OR (a.lastname='Новиков' AND a.firstname='Сергей' AND a.patrname='Николаевич')
OR (a.lastname='Гиршович' AND a.firstname='Михаил' AND a.patrname='Маркович')
OR (a.lastname='Силков' AND a.firstname='Вячеслав' AND a.patrname='Борисович')
OR (a.lastname='Готовчикова' AND a.firstname='Мария' AND a.patrname='Юрьевна')
OR (a.lastname='Ткаченко' AND a.firstname='Олег' AND a.patrname='Борисович')
OR (a.lastname='Сенчуров' AND a.firstname='Евгений' AND a.patrname='Михайлович')
OR (a.lastname='Розенгард' AND a.firstname='Сергей' AND a.patrname='Аркадьевич')
ORDER BY lastname";

$result = mysql_query($SQL) or die("Query failed: (nazn_hirurg_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$array[]=$data;
}
mysql_free_result($result);
return json_encode($array);
}

function nazn_sister_list() {
$orgId=$_GET["orgId"];
$SQL="SELECT * FROM rbSpeciality INNER JOIN Person ON Person.speciality_id = rbSpeciality.id 
	WHERE Person.deleted = 0 
	AND Person.org_id = '$orgId' 
	AND ( rbSpeciality.name LIKE '%сестр%' )  
	ORDER BY Person.lastName ASC";
$result = mysql_query($SQL) or die("Query failed: (nazn_sister_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$array[]=$data;
}
mysql_free_result($result);
return json_encode($array);
}

function nazn_sisterop_list() {
$orgId=$_GET["orgId"];
$SQL="SELECT * FROM Person as a
INNER JOIN rbUserProfile as b ON a.userProfile_id=b.id
WHERE b.code='sisterob' ";
$result = mysql_query($SQL) or die("Query failed: (nazn_sisterop_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$array[]=$data;
}
mysql_free_result($result);
return json_encode($array);
}

function nazn_assist_list() {
$orgId=$_GET["orgId"];
$SQL="SELECT * FROM Person as a
INNER JOIN OrgStructure as b ON a.orgStructure_id=b.id
WHERE b.hasHospitalBeds=1 AND a.speciality_id IS NOT NULL AND a.retired=0";
$result = mysql_query($SQL) or die("Query failed: (nazn_assist_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$array[]=$data;
	
}
mysql_free_result($result);
return json_encode($array);
}

function nazn_anest_list() {
$orgId=$_GET["orgId"];
$SQL="SELECT a.* FROM Person as a 
INNER JOIN OrgStructure as b ON a.orgStructure_id=b.id
INNER JOIN rbSpeciality as c ON a.speciality_id=c.id
WHERE b.name LIKE '%анестез%' and c.name NOT LIKE '%сестр%' AND retired=0 
ORDER BY lastname";
$result = mysql_query($SQL) or die("Query failed: (nazn_assist_list) " . mysql_error());
$array=array();
while($data = mysql_fetch_array($result)) {
	$array[]=$data;
	
}
mysql_free_result($result);
return json_encode($array);
}
?>
