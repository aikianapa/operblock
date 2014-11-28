<?

function prepareSessions() {
	$_SESSION["user_id"]=$_SESSION["dr"]["person_id"];
	$_SESSION["person_id"]=$_SESSION["dr"]["person_id"];
	$_SESSION["event_id"]=$_SESSION["dr"]["event_id"];
	$Person=mysqlReadItem("Person",$_SESSION["person_id"]);
	$_SESSION["orgStrId"]=$Person["orgStructure_id"];
	$OrgStr=mysqlReadItem("OrgStructure",$_SESSION["orgStrId"]);
	$_SESSION["orgStr"]=$OrgStr["name"];
	$_SESSION["orgId"]=$OrgStr["organisation_id"];
	if ($_SESSION["orgId"]=="") {$_SESSION["orgId"]=3147;}
}

function getActionTypeForm($SQL) {
$result = mysql_query($SQL) or die("Query failed: " . mysql_error());
$array=array(); $Item="";
while($data = mysql_fetch_array($result)) {
	$Item["id"]=$data[3]; 
	$Item["aType"]=$data[5]; 
	$Item["idx"]=$data["idx"]; 
	$Item["name"]="fld_".$data["idx"];
	$Item["label"]=$data["name"];
	$Item["type"]=$data["typeName"];
	$Item["enum"]=$data["valueDomain"];
	$Item["input"]=prepInput($Item);
	$array[]=$Item;
}
mysql_free_result();
return $array;
}

function prepInput($Item) {
	$name="fld_".$Item["idx"];
	$type=$Item["type"];
	if ($Item["enum"]>"" AND $type!="JobTicket") $type="Enum";
	$add="data-type='$Item[type]' data-label='$Item[label]' data-id='$Item[id]' data-atid='$Item[aType]'";
	switch($type){
		case "String":
			$inp="<input name='$name' $add >";
			break;
		case "Text":
			$inp="<textarea name='$name' $add ></textarea>";
			break;
		case "JobTicket":
			$inp="<input type='hidden' name='$name' $add>";
			break;
		case "Date":
			$inp="<input type='datepicker' name='$name' $add >";
			break;
		case "Enum":
			$option="";
			$enum=explode('",',$Item["enum"]); 
			foreach($enum as $value) {
				$value=trim(str_replace('"',"",$value));
				if ($value=="*") $value=""; 
				$option.="<option>$value</option>";
			}
			if ($option>"") {
				$inp="<select name='$name' $add>$option</select>"; 
			}
			break;
		default:
			$inp="<input type='text' name='$name' $add>";
			break;
	}
	return $inp;
}
 
function insertProperties($array,$action_id,$person_id,$actionType_id){
$action=mysqlReadItem("Action",$action_id);
$Item["createDatetime"]=date( "Y-m-d H:i:s" );
$Item["begDate"]=date("Y-m-d H:i:s" );
$Item["modifyDatetime"]=$Item["createDatatime"];
$Item["modufyPerson_id"]=$person_id;
$Item["actionType_id"]=$actionType_id;
$pattern=substr(mysqlReadItem("ActionType",$actionType_id)["name"],0,8)."%";
$Item["event_id"]=$action["event_id"];
$action["plannedEndDate"]=date("Y-m-d",strtotime($action["plannedEndDate"]));
$error=mysqlSaveItem("Action",$Item);
$action_new=mysql_insert_id();
$values['modifyDatetime'] = $values['createDatetime'] = '"' . date('Y-m-d H:i:s') . '"';
$values['modifyPerson_id'] = $values['createPerson_id'] = $person_id;
$values['action_id']=$action_new; 
for ($i=0; $i<count($array); $i++){ 
	if ($array[$i]['type']=='JobTicket') {
		$res=mysql_query("SELECT a.id,a.datetime FROM Job_Ticket as a
					INNER JOIN Job as b ON a.master_id=b.id
					INNER JOIN rbJobType as c ON b.jobType_id=c.id
					WHERE a.resTimestamp IS NULL  AND b.date='".$action["plannedEndDate"]."' AND c.name LIKE '".$pattern."'
					ORDER BY a.datetime
					LIMIT 1") or die ("Query failed insertProperties(): " . mysql_error());
		while($data = mysql_fetch_array($res)) {
		$jobticket_id=$data["id"];
		}	
	}
  
  
  $values['type_id']=$array[$i]['type_id'];
  $out = array();
   foreach ($values AS $k => $v) {
    $out[] = "{$k}={$v}";
   }
  $out = implode(',', $out);
  mysql_query("INSERT INTO ActionProperty SET {$out}") or die ("Query failed 1: " . mysql_error());
  $trigger="http://".$_SERVER["HTTP_HOST"]."/json/operlog.php?mode=add_trigger&uid=".$person_id."&trigger=ActionProperty";
  echo file_get_contents($trigger);
  $id=mysql_insert_id();
  $value=$array[$i]['value'];
  $type=$array[$i]['type']; 
	 if ($type =='JobTicket'){
		$type='Job_Ticket';
		$value= $jobticket_id;
		$thread_id=mysql_thread_id();
		mysql_query("UPDATE Job_Ticket SET resTimestamp={$values['modifyDatetime']} ,resConnectionid=$thread_id WHERE id={$jobticket_id}") or die("Query failed 2: " . mysql_error());
	}
	$SQL="INSERT INTO `ActionProperty_{$type}` SET id={$id}, value='{$value}' ";
  mysql_query($SQL) or die("Query failed 3: " . mysql_error());
 	}
}



function updateProperties($array,$action_id,$person_id,$actionType_id){


$values['modifyDatetime']  = '"' . date('Y-m-d H:i:s') . '"';
$values['modifyPerson_id'] = $person_id;
 
for ($i=0; $i<count($array); $i++){ 
	
  
  $values['type_id']=$array[$i]['type_id'];
  $out = array();
   foreach ($values AS $k => $v) {
    $out[] = "{$k}={$v}";
   }
  $out = implode(',', $out);
  mysql_query("UPDATE ActionProperty SET {$out}") or die ("Query failed 1: " . mysql_error());
  $id=mysql_insert_id();
  $value=$array[$i]['value'];
  $type=$array[$i]['type']; 
	
	$SQL="UPDATE ActionProperty_{$type}` SET id={$id}, value='{$value}' ";
  mysql_query($SQL) or die("Query failed 4: " . mysql_error());
 	}

	
 	
}

function getZamglavName() {
	$name="";
	$res=mysql_query("
		SELECT a.id FROM Person as a
		INNER JOIN rbPost as b ON a.post_id=b.id
		WHERE b.name LIKE 'заместитель главного врача по мед%' LIMIT 1
		") or die("getZamglavName(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$person=getPersonInfo($data["id"]);
		$name=$person["personShort"];
	}
	return $name;
}

function getClientInfo($client_id,$event_id=0) {
	$Client=mysqlReadItem("Client",$client_id);
	$Client["age"]=floor((time()-strtotime($Client["birthDate"]))/31536000);
	if ($Client["sex"]==1) {$Client["sex"]="мужской";} else {$Client["sex"]="женский";} 
	$Client["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
	$Client["clientShort"]=$Client["lastName"]." ".substr($Client["firstName"],0,2).".".substr($Client["patrName"],0,2).".";
  $Client["blood"]="";
	if ($event_id>0) {
		$Event=mysqlReadItem("Event",$event_id); 
		$Client["blood"]=getBloodType($Event["client_id"]);
	}
	return $Client;
}

function getActionInfo($action_id) {
	$_action=jdbReadItem("Action",$action_id);
	$action=mysqlReadItem("Action",$action_id);
	$action=array_merge($action,$_action);
  	$operation=jdbReadItem("Operation",$action_id);
  if ($action["event_id"]>"") {
	$Creator=getPersonInfo($action["createPerson_id"]);			$action["_Creator"]=$Creator;
  	$Person	=getPersonInfo($action["person_id"]);			$action["_Person"]=$Person;
	//$Hirurg	=getPersonInfo($action["hirurg_id"]);			$action["_Hirurg"]=$Hirurg;
	$Hemoist	=getPersonInfo($action["hemo_id"]);			$action["_Hemoist"]=$Hemoist;
	$Dejur	=getPersonInfo($action["dejur_id"]);			$action["_Dejur"]=$Dejur;
	$Event	=mysqlReadItem("Event",$action["event_id"]);	$action["_Event"]=$Event;
	$Client	=getClientInfo($Event["client_id"],$action["event_id"]);	$action["_Client"]=$Client;
	$Hemo	=getPersonInfo($action["hemo_id"]); 
	$AnSis	=getPersonInfo($action["an_sister_id"]); 
	$Anest	=getPersonInfo($action["an_person_id"]); 
	$OpSis	=getPersonInfo($action["operSister_id"]);
	$ActionType=mysqlReadItem("ActionType",$action["actionType_id"]); $action["_ActionType"]=$ActionType;
	if ($action["transfusiton_req"]==1) {$action["hemotrans"]="переливание";} else {$action["hemotrans"]="";}  
	$action["actionType"]=$ActionType["title"];
	$action["operation"]=$action["specifiedName"];
	if ($action["operation"]=="") {$action["operation"]=$action["actionType"];}
	if ($operation["begTime"]>"") $action["begTime"]=$operation["begTime"];
	if (!isset($action["begTime"]) OR $action["begTime"]=="") {$action["begTime"]="--:--";}
	$action["begDate"]=date("Y-m-d",strtotime($action["begDate"]));
	$action["plannedEndDate"]=date("Y-m-d",strtotime($action["plannedEndDate"]));
	if (date("Y",strtotime($action["plannedEndDate"]))<=1970) { $action["plannedEndDate"]="не назначена"; }
	if (date("Y",strtotime($action["begDate"]))<=1970) { $action["begDate"]=$action["plannedEndDate"]; } 
	if ($_action["index"]=="") {$action["index"]=0;} 
	if (!isset($_action["spisanie_ob"])) {$action["spisanie_ob"]="";}
	if (!isset($_action["spisanie_an"])) {$action["spisanie_an"]="";}
	$action["client_begDate"]=date("Y-m-d",strtotime($Event["setDate"]));
	$action["client_birthDate"]=$Client["birthDate"];
	$action["blood"]=$Client["blood"]; 
	$action["externalId"]=$Event["externalId"];
	$action["orgStr_id"]=$Creator["orgStructure_id"];
	$action["orgStructure"]=$Creator["orgStructure"]; 
	$action["orgStrBoss"]=json_decode(getOrgStrBossName(),true)["fullName"];
	$Diag=patientGetDiagnosis($action["event_id"]);
	$brigada=""; $i=0; 
	foreach($action["assist_id"] as $assist_id) {
		$assist=getPersonInfo($assist_id);
		$brigada[$i]=$assist["personShort"];
		$i++;
	}
	$begTime=strtotime($action["begDate"]." ".$action["begTime"]);
	$endTime=strtotime($action["endDate"]);
	$action["o_endTime"]=date("H:i",$endTime); // конец опреации
	$action["o_time"]= date("H:i", mktime(0, 0, ($endTime-$begTime))); // длительность операции
	$action["brigada"]=implode(", ",$brigada);
	$action["diagnose"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"]; 
 	$action["tableName"]="№".$action["table"]." (".$Person["orgStrShort"].")"; 
	$action["narkoz"]=getNarkozByEvent($action["event_id"]);
	$action["analyse"]=getBloodAnalyse($action["event_id"]);
	if (count(explode("полож",$action["analyse"]))>1 OR count(explode("в раб",$action["analyse"]))>1) {
				$action["blood_warning"]=1;
	} else { 	$action["blood_warning"]=0;}
	$action["analisys"]=$action["analyse"];
	$action["client"]=$Client["clientShort"];
	$action["person"]=$Person["personShort"];
	$action["hemoist"]=$Hemoist["personShort"];
	$action["hirurg"]=$Hemoist["personShort"];
	$action["dejur"]=$Dejur["personShort"];
	$action["anest"]=$Anest["personShort"];
	$action["bloodmen"]=$Hemo["personShort"];
	$action["oper_sister"]=$OpSis["personShort"];
	$action["anest_sister"]=$AnSis["personShort"];
	$action["age"]=$Client["age"];
	$action["palata"]=getClientPalata($action["event_id"]);
  $action["status"]=get_action_status($action_id,$action,$_action);
  if ($action["status"]==3) {$cnote="<li><span class='ui-red ui-bold'>Отменена:</span> ".$action["cancelNote"]."</li>";} else {$cnote="";}
	$action["tooltip"]="<ul class='inner'>
        $cnote
				<li>Диагноз: $action[diagnose]</li>
				<li>Название операции: $action[operation]</li>
				<li>Хирург: $action[person]</li>
				<li>Ассистент: $action[brigada]</li>
				<li>Группа крови: $action[blood]</li>
				<li>Дата поступления: $action[client_begDate]</li>
			</ul>";
  } else {print_r($action);	}
	return $action;
}

function getPersonInfo($person_id) {
	$Person=mysqlReadItem("Person",$person_id); 
	$Person["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
	$Person["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
	$Person["orgStructure"]=getOrgStrName($Person["orgStructure_id"]);
	$Person["orgStrShort"]=getOrgStrName($Person["orgStructure_id"],"code");
	return $Person;
}

function getClientPalata($event_id) {
$SQL="SELECT a.code FROM OrgStructure_HospitalBed as a
INNER JOIN ActionProperty_HospitalBed as b ON a.id=b.value
INNER JOIN ActionProperty as c ON b.id=c.id
INNER JOIN ActionPropertyType as d ON c.type_id=d.id
INNER JOIN ActionType as e ON d.actionType_id=e.id
INNER JOIN Action as f ON c.action_id=f.id
WHERE e.name LIKE 'Движе%' AND f.event_id= $event_id";
$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$palata=$data["code"]; 
	}
mysql_free_result($res);
return $palata;
}

function getOpRooms() {
$SQL="SELECT * FROM OrgStructure
WHERE name LIKE 'Операционная%' ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		while($data = mysql_fetch_array($res)) {
			$oprooms[]=$data;
		}
	mysql_free_result($res);
	return json_encode($oprooms);
}

function getOpTables($Item,$date) {
$tables=jdbReadItem("Tables",$date);
$oprooms=jdbReadItem("opRooms",$date);
unset($oprooms["undefined"]); 
unset($oprooms["id"]); 
unset($oprooms["approve"]);
unset($tables["id"]); 
$i=0;
foreach($tables as $oid => $data) {
	foreach($tables[$oid] as $tid => $opr) {
		$table=array();
		$table["oid"]=$oid;
		$table["tid"]=$tid;
		$table["opr"]=$oprooms[$oid][$tid]["oper"];
		$table["idx"]=$oprooms[$oid][$tid]["index"];
		$table["name"]="стол № $tid<br />".getOrgStrName($oid,"code");
		$Item["optables"][]=$table; 
	}
}
$Item["optables"]=array_sort($Item["optables"],"idx");
return $Item; 
}

function getOrgStrBossName($orgStrId=171) {
	if ($orgStrId=="") {$orgStrId=$_SESSION["orgStrId"];}
	$SQL="SELECT lastname,firstname,patrname FROM Person as a
		INNER JOIN OrgStructure as b ON a.id=b.chief_id
		WHERE a.orgStructure_id= ".$orgStrId." LIMIT 1";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		while($data = mysql_fetch_array($res)) {
			$name["fullName"]=$data["lastname"]." ".$data["firstname"]." ".$data["patrname"];
		}
		return json_encode($name);
}

function getTableData($date="",$orgStr_id="",$table="") {
	if ($date=="") {$date=date("Y-m-d");}
	$data=jdbReadItem("Tables",$date);
	if ($orgStr_id>"") $data=$data[$orgStr_id];
	if ($table>"") $data=$data[$table];
	return $data;
}


function getOrgStrName($orgStr_id=171,$field="") {
	if ($orgStr_id>"") {
	$SQL="SELECT * FROM OrgStructure WHERE id=$orgStr_id";
	$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		if ($field=="") {$name=$data["name"];} else {
			$name=$data[$field];
		}
		
	}
	} else {$name="";} 
	return $name;
}

function getNarkozByEvent($event_id) {
$SQL="SELECT a.value FROM ActionProperty_String as a
INNER JOIN ActionProperty as b ON a.id=b.id
INNER JOIN ActionPropertyType as c ON b.type_id=c.id
INNER JOIN Action as d ON b.action_id=d.id
WHERE event_id=$event_id AND d.actionType_id=10058 AND name LIKE '%пособие'";
$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
$item="";
while($data = mysql_fetch_array($res)) {$item=$data["value"];}
return $item;
}

function getBloodAnalyse($event_id) {
if ($event_id>0) {
$SQL="SELECT c.name, a.value FROM ActionProperty_String as a
INNER JOIN ActionProperty as b ON a.id=b.id
INNER JOIN ActionPropertyType as c ON b.type_id=c.id
INNER JOIN Action as d ON b.action_id=d.id
WHERE event_id=$event_id AND d.actionType_id=9025"; 
$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
$item=""; $fields=array("HCV", "HbsAg", "Ф-50", "RW");
while($data = mysql_fetch_array($res)) {
	if (in_array($data[0],$fields)) {
		$item[$data[0]]=$data[0].": ".$data[1];
	}
}
$item=implode($item,"<br />");
return $item; 
}
}

function getBloodType($client_id) {
$SQL="SELECT b.name FROM Client as a
INNER JOIN rbBloodType as b ON a.bloodType_id=b.id
WHERE a.id=$client_id";
$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
$item="";
while($data = mysql_fetch_array($res)) {$item=$data["name"];}
return $item;
}

function getOperationsByPerson($month,$year,$person_id,$role="person_id") {
		$start="$year-$month-01";
		$stop="$year-$month-31";
$SQL="SELECT * FROM Action as a 
  INNER JOIN ActionType as b ON a.actionType_id = b.id 
  INNER JOIN Person as c ON a.setPerson_id=c.id
  WHERE b.serviceType = 4 
  AND ( begDate BETWEEN '$start' AND '$stop' OR (plannedEndDate BETWEEN '$start' AND '$stop'  AND ( begDate like '1970%' OR begDate IS NULL )) )
  ORDER BY status DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		$data=array();
		while($a = mysql_fetch_array($res)) {
			$action=getActionInfo($a[0]);
			if ($action[$role]==$person_id) {
			if (date("Y",strtotime($action["begDate"]))=="1970" OR $action["begDate"] == NULL) {
					$curdate=date("d",strtotime($action["plannedEndDate"]));
			} else {	$curdate=date("d",strtotime($action["begDate"]));}
			if (!isset($data[$curdate][$action["status"]])) {$data[$curdate][$action["status"]]=1;} else {$data[$curdate][$action["status"]]++;}
			}
		}
	return json_encode($data);
}

function getOperationsByDate($month,$year,$oid="") {
		$start="$year-$month-01";
		$stop="$year-$month-31";
		if ($oid>"") {
$SQL="SELECT * FROM Action as a 
  INNER JOIN ActionType as b ON a.actionType_id = b.id 
  INNER JOIN Person as c ON a.setPerson_id=c.id
  WHERE b.serviceType = 4 and c.orgStructure_id=$oid
  AND ( begDate BETWEEN '$start' AND '$stop' OR (plannedEndDate BETWEEN '$start' AND '$stop'  AND ( begDate like '1970%' OR begDate IS NULL )) )
  ORDER BY status DESC ";
		} else {
		$SQL="SELECT * FROM Action INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
		WHERE ActionType.serviceType = 4 
		AND ( begDate BETWEEN '$start' AND '$stop' OR (plannedEndDate BETWEEN '$start' AND '$stop'  AND ( begDate like '1970%' OR begDate IS NULL )) )
		ORDER BY status DESC ";
}
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		$data=array();
		while($action = mysql_fetch_array($res)) {
			if (date("Y",strtotime($action["begDate"]))=="1970" OR $action["begDate"] == NULL) {
					$curdate=date("d",strtotime($action["plannedEndDate"]));
			} else {	$curdate=date("d",strtotime($action["begDate"]));}
			if (!isset($data[$curdate][$action["status"]])) {$data[$curdate][$action["status"]]=1;} else {$data[$curdate][$action["status"]]++;}
		
		}
	return json_encode($data);
}
 
function checkApprovedTable($date,$orgStr_id,$table) {
	$_tables=jdbReadItem("Tables",$date);
	$org=$_tables[$orgStr_id]; 
	if (isset($org[$table])) {$res=TRUE;} else {$res=FALSE;}
	return $res; 
}

function checkApprovedOproom($date,$opr) {
	$oprooms=jdbReadItem("opRooms",$date);
	$approved=$oprooms["approve"];
	if (isset($approved[$opr])) {$res=TRUE;} else {$res=FALSE;}
	return $res; 
}

function ServiceSpecDrug($id) {
$SQL="SELECT * FROM rbServiceSpecification_Drug WHERE drug_id = '$id' LIMIT 1";
$SQL = mysql_query($SQL) or die("Query failed: functions.php:ServiceSpecDrug()" . mysql_error());
$res=false;
while($data = mysql_fetch_array($SQL)) {$res=$data;}
return $res;
}

function patientGetDiagnosis($event_id) {
$diagnoses=array();
//Клинический
$data["DiagName"]=""; $data["MKB"]=""; $diagnoses["clinic"]=$data;
$SQL="
SELECT b.MKB,a.DiagName FROM MKB as a
INNER JOIN Diagnosis as b ON a.DiagID=b.MKB
INNER JOIN Diagnostic as c ON b.id=c.diagnosis_id
INNER JOIN rbDiagnosisType as d ON c.diagnosisType_id=d.id
WHERE event_id=$event_id AND d.name LIKE 'клин%'";
$result = mysql_query($SQL) or die("Query failed: (get_diagnoses) " . mysql_error());
while($data = mysql_fetch_array($result)) {	$diagnoses["clinic"]=$data; print_r($data);}
 
//Основной
$data["DiagName"]=""; $data["MKB"]=""; $diagnoses["main"]=$data;
$SQL="SELECT b.MKB,a.DiagName FROM MKB as a
INNER JOIN Diagnosis as b ON a.DiagID=b.MKB
INNER JOIN Diagnostic as c ON b.id=c.diagnosis_id
INNER JOIN rbDiagnosisType as d ON c.diagnosisType_id=d.id
WHERE event_id=$event_id AND d.name LIKE 'осно%'";
$result = mysql_query($SQL) or die("Query failed: (get_diagnoses) " . mysql_error());
while($data = mysql_fetch_array($result)) {	$diagnoses["main"]=$data;}

//Сопутствующий
$data["DiagName"]=""; $data["MKB"]=""; $diagnoses["satt"]=$data; 
$SQL="SELECT b.MKB,a.DiagName FROM MKB as a
INNER JOIN Diagnosis as b ON a.DiagID=b.MKB
INNER JOIN Diagnostic as c ON b.id=c.diagnosis_id
INNER JOIN rbDiagnosisType as d ON c.diagnosisType_id=d.id
WHERE event_id=$event_id AND d.name LIKE 'сопут%'";
$result = mysql_query($SQL) or die("Query failed: (get_diagnoses) " . mysql_error());
while($data = mysql_fetch_array($result)) {	$diagnoses["satt"]=$data;}

// Заключение терапевта
$data["name"]=""; $data["value"]=""; $diagnoses["terapevt"]=$data; 
$SQL="SELECT c.name,a.value FROM ActionProperty_String as a
INNER JOIN ActionProperty as b ON a.id=b.id
INNER JOIN ActionPropertyType as c ON b.type_id=c.id
INNER JOIN Action as d ON b.action_id=d.id
INNER JOIN Event as f ON d.event_id=f.id
WHERE  d.actionType_id=9860 and name LIKE 'Закл%' AND event_id=$event_id";
$result = mysql_query($SQL) or die("Query failed: (get_diagnoses) " . mysql_error());
while($data = mysql_fetch_array($result)) {	$diagnoses["terapevt"]=$data;}

// Заключение анестезиолога
$data["name"]=""; $data["value"]=""; $diagnoses["anest"]=$data; 
$SQL="SELECT c.name,a.value FROM ActionProperty_String as a
INNER JOIN ActionProperty as b ON a.id=b.id
INNER JOIN ActionPropertyType as c ON b.type_id=c.id
INNER JOIN Action as d ON b.action_id=d.id
INNER JOIN Event as f ON d.event_id=f.id
WHERE  d.actionType_id=10058 and name LIKE 'Закл%' AND event_id=$event_id";
$result = mysql_query($SQL) or die("Query failed: (get_diagnoses) " . mysql_error());
while($data = mysql_fetch_array($result)) {	$diagnoses["anest"]=$data;}
return $diagnoses; 
}

function sqlVars($SQL,$VARS) {
foreach($VARS as $key => $val) {$SQL=str_replace('{$'.$key.'}',$val,$SQL);}
return $SQL;
}

function prepareTables($tables=4) {
	$t=array();
	for($i=1; $i<=$tables; $i++) {
		$table=array();
		$table["id"]=$i;
		$table["name"]="Стол №".$i;
		$t[]=$table;
	}
	return $t;
}

function drugReadItem($form,$id) {
			$Item=FALSE;
			$result = mysql_query ("SELECT * FROM $form WHERE code = '$id' LIMIT 1;");
			if ($result) { $Item=mysql_fetch_array($result); mysql_free_result($result);}
			return $Item;
}

function get_action_status($action_id="", $action="", $_action="") {
	if ($action_id=="") {$action_id=$_GET["action_id"];}
	if ($action=="") {$action=mysqlReadItem("Action",$action_id);}
	if ($_action=="") {$_action=jdbReadItem("Action",$action_id);}
	$Action=array_merge($action,$_action);
	if ($Action["status"]!=3) {
		if ($Action["status"]=="") {$Action["status"]=0;}
		if ($Action["zam_ok"]==1) {$Action["status"]=1;} else {$Action["status"]=0;}
		if ($Action["zav_ok"]==1 AND $Action["status"]==0) $Action["status"]=4;
		if (date("Y",strtotime($Action["endDate"]))>1970 ) {$Action["status"]=2;}
		if ($Action["isUrgent"]==1 AND ($Action["status"]!=2 AND $Action["status"]!=3) ) {$Action["status"]=1;}
	}
	return  $Action["status"];
	// status 0 - (серый) назначена
	// status 1 - (зелёный) утверждена замглавврача
	// status 2 - (синий) проведена
	// stasus 3 - (красный) отменена
	// status 4 - (жёлтый) утверждена завотдел и старшей сестрой
	
}

function getSpisanieItems($id) {
  
   $array=array();
    if ($id>"") {

			$SQL="SELECT * FROM StockMotion_Item
				WHERE master_id = '$id' ";
			$result = mysql_query($SQL) or die("Query failed: (get_spisanie_nomenclature) " . mysql_error());	
			while($data = mysql_fetch_array($result)) {
 				$array[]=$data;
			}

		mysql_free_result($result);
    }
		return json_encode($array);
}

function getDrugs($sklad="005000070") {
$client=new SoapClient("http://192.168.100.12:1213/pharon/ws/MedicinePrice.1cws?wsdl",
            array(
                'login'=> samson,'password'=> dbcnfvtl
            ));
$date=date('Y-m-d H:i:s');
$medic=$client->getMedic(array('CodeStr'=>$sklad,'Date'=>$date))->return;
$array=explode("\n",$medic);

for ($i=0;$i<count($array);$i++){
		$arr[$i]=explode("_|_",$array[$i]);
}

$a=count($arr);
$b=count($arr[0]);

for ($x = 0;$x < $a;$x++){
	if (!$arr[$x][11]){
		$arr[$x][11]=$arr[$x][8];
	}
$arr[$x]['drugId']="".$arr[$x][0];
$arr[$x]['drugName']=$arr[$x][5];
$arr[$x]['unitName']=$arr[$x][11];

	for ($y = 0;$y < $b;$y++){
	unset($arr[$x][$y]);
	}
}

usort($arr, "cmp");

return $arr;
}

function cmp($a, $b) {
    return strcmp($a['drugName'], $b['drugName']);
}
?>
