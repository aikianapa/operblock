<?
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
prepareSessions();

function patientDataType() { return "mysql"; }

function patientFields() {
	$fields=mysqlReadDict("patient");
	return $fields;
}

// Подготовка формы для Эпикриза
function patientEpicrizForm() {
$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
INNER JOIN ActionType as b ON a.actionType_id=b.id
WHERE b.name LIKE '%предоперационный эпикриз%'
ORDER BY a.idx	
";
return  getActionTypeForm($SQL);
}

// Подготовка формы для Гистологии
function patientHistoForm() {
$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
INNER JOIN ActionType as b ON a.actionType_id=b.id
WHERE b.flatCode='gist' AND a.name NOT LIKE 'Результаты%'  
AND a.name NOT LIKE '№%'  
AND a.name NOT LIKE 'Морфоло%'
AND a.name NOT LIKE 'Особ%'
ORDER BY a.idx	";
return  getActionTypeForm($SQL);
}

function patientImunoForm() {
$SQL="SELECT  a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
INNER JOIN ActionType as b ON a.actionType_id=b.id
WHERE b.flatCode='immunogist' AND a.name NOT LIKE 'Результаты%'  
AND a.name NOT LIKE '№%'  
AND a.name NOT LIKE 'Морфоло%'
AND a.name NOT LIKE 'Особ%'
ORDER BY a.idx	";
return  getActionTypeForm($SQL);
}


function patientCitologyForm() {
	$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
INNER JOIN ActionType as b ON a.actionType_id=b.id
WHERE b.flatCode='cito'  AND a.name  NOT LIKE '№%'
AND a.name  NOT LIKE 'Результ%'
ORDER BY a.idx	";
return  getActionTypeForm($SQL);
}


function patient_histo($form,$mode,$id,$datatype) {
	$out=patient_nazn($form,$mode,$id,$datatype);
	return $out;
}

// Подготовка данных для формы patient_nazn.php
function patient_nazn($form,$mode,$id,$datatype) {
	
	$Item["eventId"]=$_SESSION["event_id"];
	$out=formGetForm($form,$mode);
	$Client=mysqlReadItem("Client",$id);
	$Event=mysqlReadItem("Event",$Item["eventId"]);
	$Person=mysqlReadItem("Person",$Event["execPerson_id"]);
// =================
	$Client["externalId"]=$Event["externalId"];
	$Client["eventId"]=$Item["eventId"];
	$Client["diagnosis"]=implode(" ",patientGetDiagnosis($Client["eventId"]));
	$Client["birthDate"]=date("d-m-Y",strtotime($Client["birthDate"]." 00:00:00"));
// =================
	$Item["personId"]=$_SESSION["person_id"];
	$Item["clientId"]=$id;
	$Item["orgStrId"]=$Person["orgStructure_id"];
	$Item["orgStrName"]=$_SESSION["orgStr"];
	// Ищем в ActionType id оперблока
	// Ищем Action по оперблоку
$SQL="SELECT * FROM Action as a
 INNER JOIN ActionType as b on a.ActionType_id=b.id
 WHERE b.serviceType=4 AND a.event_id = $Item[eventId] 
 AND a.deleted=0
 ORDER BY a.id DESC  ";
	$result = mysql_query($SQL) or die("Query failed: " . mysql_error());
	while($data = mysql_fetch_array($result)) {
		$actionType=mysqlReadItem("ActionType",$data["actionType_id"]);
		if ($actionType["serviceType"]=4) {
			$data["id"]=$data[0];
			$data=getActionInfo($data[0]);
			$data["personFull"]=$data["_Person"]["person"];
			if (!isset($data["cancelNote"])) {$data["cancelNote"]="";}
			/*
			if ($data["begDate"]==NULL AND date("Y",strtotime($data["plannedEndDate"]))>"0000") {$data["begDate"]=$data["plannedEndDate"];}
			if ($data["begDate"]==NULL OR date("Y",strtotime($data["begDate"]))=="1970") {$data["begDate"]="Не назначена";} else {
				$data["begDate"]=date("d-m-Y",strtotime($data["begDate"]));
			}
			$data["actionType"]=$actionType["title"];
			$data["person"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
			$data["personFull"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];

			$Hirurg=mysqlReadItem("Person",$data["person_id"]);
			$data["hirurg"]=$Hirurg["lastName"]." ".substr($Hirurg["firstName"],0,2).".".substr($Hirurg["patrName"],0,2).".";
			$data["hirurgFull"]=$Hirurg["lastName"]." ".$Hirurg["firstName"]." ".$Hirurg["patrName"];

			$data["begDate"]=dmyDate($data["begDate"]);
			$data["status"]=get_action_status($data["id"],$data);
			*/
			$Item["operations"][]=$data;
		}
	}
	$Item["client"][0]=$Client;
	$Item["formEpicriz"]=patientEpicrizForm();
	$Item["formHisto"]=patientHistoForm();
	$Item["formCito"]=patientCitologyForm();
	$Item["formImuno"]=patientImunoForm();
	$out=contentSetData($out,$Item);
return $out;
}


// Подготовка данных для формы patient_list.php
function patientMysqlListItems() {
    $tSQL = "SELECT id FROM `ActionType` WHERE `name`='Температурный лист' AND deleted!=1; ";
	$tSQL = mysql_query($tSQL) or die("Query failed: " . mysql_error());
	while($data = mysql_fetch_array($tSQL)) {
		$temperatureActionType=$data["id"];
	}
	$SETTINGS=$_SESSION['settings'];
	$SQL=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/sql/getPresentPatients.sql");
// ======================= переменные для SQL =============================
	$date = date("Y-m-d ");
	$VARS["temperatureActionType"]=$temperatureActionType;
	$VARS["today"] = $date;
	$VARS["morning"]=$date.'07:00:00';
    	$VARS["evening"]= $date.'16:00:00';
	$VARS["orgStructure_id"]=$SETTINGS["orgStructure"];
	$VARS["sortBy"]="lastName";
	$VARS["sortOrder"]="";
// ========================================================================
	$SQL=sqlVars($SQL,$VARS);
	$result = mysql_query($SQL) or die("Query failed: " . mysql_error());
	$array=array();
	while($Item = mysql_fetch_array($result)) {
		$Event=mysqlReadItem("Event",$Item["eventId"]);
		$Item["diagnosis"]=implode(" ",patientGetDiagnosis($Item["eventId"]));
		if ($Event["execPerson_id"]==$_SESSION["user_id"]) {
		$Item["age"]=floor((time()-strtotime($Item["birthDate"]))/31536000);
		$Item["client_id"]=$Event["client_id"];
		$Item["begDate"]=date('d-m-Y',strtotime($Item["begDate"]));
		$array[]=$Item;
		$_SESSION["opbl_externalId"][$Item["client_id"]]=$Item["externalId"];
		$_SESSION["opbl_eventId"][$Item["client_id"]]=$Item["eventId"];
		$_SESSION["opbl_clientId"][$Item["client_id"]]=$Item["clientId"];  
		}
	}
	return $array;
}



?>
