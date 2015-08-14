<?

include_once($_SERVER['DOCUMENT_ROOT']."/morfo_func.php");
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
	$person=getPersonInfo($_SESSION["user_id"]);
	$_SESSION["user_role"]=$person["userProfile_name"];
	$_SESSION["userProfile_id"]=$person["userProfile_id"];
}

function createEmptyAction($actionType_id,$event_id,$person_id="") {
	if ($person_id=="") {$person_id=$_SEESION["user_id"];}
	$Action=array();
	$Action["id"]="_new";
	$Action["actionType_id"]=$actionType_id;
	$Action["event_id"]=$event_id;
	$Action["setPerson_id"]=$Action["createPerson_id"]=$person_id;
	$Action["createDatetime"]=$Action["modifyDatetime"]=date("Y-m-d H:i:s");
	$Action["status"]=0;
	$Action["begDate"]=date("Y-m-d H:i:s");
	mysqlSaveItem("Action",$Action);
	$Action["id"]=mysql_insert_id();
	return $Action;
}

function checkActionTypeParrent($actionType_id,$name,$group_id=NULL) {
	$res=0;
	if (!is_array($name)) {$tmp=$name; $name=array(); $name[]=$tmp;}
	$actionType=mysqlReadItem("ActionType",$actionType_id);
	if ($res==0 AND in_array($actionType["name"],$name)) {$res=1;}
	if ($res==0 AND $actionType["id"]==$group_id) {$res=1;}
	if ($res==0 AND $actionType["group_id"]>"") {$res=checkActionTypeParrent($actionType["group_id"],$name,$group_id);}
	return $res;
}

function getStationarMovings($event_id) {
	$url=$_SESSION["settings"]["url_doctorroom"]."/ajax.php";
	phpQuery::ajaxAllowURL($url); 
	$res = null; $fnCallback = function($data, $status) use (&$res) { $res = $data; };
	phpQuery::ajax(array(
                                'type' => 'POST',
                                'url' => $url,
                                'data' => array(
												'get'=>'getMoving',
												'_interface'=>'doctor',
												'event_id'=>$event_id,
												'method'=>'doctorroom/getController',
												'user_id'=>$_SESSION["user_id"]
												),
                                'success' => $fnCallback,
                                'dataType' => 'data',
                                'rnd'=>rand(10000,99999),
                        ));
	return json_decode($res,true);
}

function getConstructor($group) {
	$url=$_SESSION["settings"]["url_doctorroom"]."/ajax.php";
	phpQuery::ajaxAllowURL($url); 
	$res = null; $fnCallback = function($data, $status) use (&$res) { $res = $data; };
	phpQuery::ajax(array(
                                'type' => 'POST',
                                'url' => $url,
                                'data' => array(
												'cahce'=>false,
												'valueDomain'=>$group,
												'method'=>'combobox/get_rbConstructor',
												),
                                'success' => $fnCallback,
                                'dataType' => 'data',
                                'rnd'=>rand(10000,99999),
                        ));
                        $res=json_decode($res,true);
                        $res=$res["data"];
	return $res;	
}


function getActionsHistory($event_id) {
	$url=$_SESSION["settings"]["url_doctorroom"]."/ajax.php";
	phpQuery::ajaxAllowURL($url); 
	$res = null; $fnCallback = function($data, $status) use (&$res) { $res = $data; };
	phpQuery::ajax(array(
                                'type' => 'POST',
                                'url' => $url,
                                'data' => array(
												'get'=>'getActionsHistory',
												'_interface'=>'doctor',
												'event_id'=>$event_id,
												'method'=>'doctorroom/getController',
												'user_id'=>$_SESSION["user_id"]
												),
                                'success' => $fnCallback,
                                'dataType' => 'data',
                                'rnd'=>rand(10000,99999),
                        ));
	return json_decode($res,true);
}

function getAction($action_id,$event_id=NULL) {
	if ($event_id==NULL) {$action=mysqlReadItem("Action",$action_id); $event_id=$action["event_id"];}
	$url=$_SESSION["settings"]["url_doctorroom"]."/ajax.php";
	phpQuery::ajaxAllowURL($url); 
	$res = null; $fnCallback = function($data, $status) use (&$res) { $res = $data; };
	phpQuery::ajax(array(
                                'type' => 'POST',
                                'url' => $url,
                                'data' => array(
												'get'=>'getAction',
												'actionId'=>$action_id,
												'event_id'=>$event_id,
												'method'=>'doctorroom/getController',
												'user_id'=>$_SESSION["user_id"]
												),
                                'success' => $fnCallback,
                                'dataType' => 'data',
                                'rnd'=>rand(10000,99999),
                        ));
	return json_decode($res,true);
	
}

function getActionsDiary($event_id) {
	return getByEvent('getActionsDiary',$event_id) ;
}

function getByEvent($mode,$event_id,$action_id="",$interface='doctor') {
	$url=$_SESSION["settings"]["url_doctorroom"]."/ajax.php";
	phpQuery::ajaxAllowURL($url); 
	$res = null; $fnCallback = function($data, $status) use (&$res) { $res = $data; };
	phpQuery::ajax(array(
                                'type' => 'POST',
                                'url' => $url,
                                'data' => array(
												'get'=>$mode,
												'event_id'=>$event_id,
												'actionId'=>$action_id,
												'_interface'=>$interface,
												'method'=>'doctorroom/getController',
												'user_id'=>$_SESSION["user_id"]
												),
                                'success' => $fnCallback,
                                'dataType' => 'data',
                                'rnd'=>rand(10000,99999),
                        ));
	return json_decode($res,true);	
}

function getActionTypeForm($SQL,$action_id=NULL) {
// Если передан action_id то в массив добавляются значения полей
if (substr($SQL,0,7)!="SELECT ") {
	$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, a.userProfile_id, b.id FROM ActionPropertyType as a
	INNER JOIN ActionType as b ON a.actionType_id=b.id
	WHERE b.name='$SQL'   
	ORDER BY a.idx	";
}
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
	if ($_SESSION["userProfile_id"]==$data["userProfile_id"] OR $data["userProfile_id"]==NULL) {	$array[]=$Item;}
}
mysql_free_result($result);
if ($action_id!=NULL) {
		$PropData=array(); $PropData["id"]=$action_id;
		$PropData=getActionPropertyFormData($PropData,$array);
		foreach($array as $i => $fld) {
			$array[$i]["value"]=$PropData[$fld["name"]];
			if ($fld["type"]=="JobTicket") {unset($array[$i]);}
		}
}
return $array;
}

function getRusDate($date) {
	$date=strtotime($date);
	$d=date("d",$date);
	$m=date("m",$date)*1;
	$y=date("Y",$date);
	$mon=array("","января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");
	$date="&laquo;".$d."&raquo; ".$mon[$m]." ".$y;
	return $date;
}

function setRusDate($str) {
	$str=trim($str);
	$mon=array("","января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");
	$str=explode(" ",$str);
	$str[0]=str_replace("«","",$str[0]);
	$str[0]=str_replace("»","",$str[0]);
	$str[0]=str_replace("'","",$str[0]);
	$str[0]=str_replace('"',"",$str[0]);
	$str[0]=0+$str[0];
	$str[1]=mb_strtolower($str[1],'utf-8');
	$str[1]=array_search($str[1],$mon);
	$str[2]=0+$str[2];
	$date=date("Y-m-d",strtotime($str[2]."-".$str[1]."-".$str[0]));
	return $date;
}

function dmyDate($date) {
	$date=date("d.m.y",strtotime($date));
	return $date;
}

function getActionPropertyFormData($Item,$form,$fldname="name") {
	$action_id=$Item["id"];
	if ($action_id!="_new" AND $action_id!="") {
	foreach($form as $field) {
		$prop_id=getActionPropertyTypeId($action_id,$field["id"]);
		$type=$field["type"];
		if ($type>"" AND $prop_id>"") {
			if ($type=="Constructor") {$type="String";}
			if ($type=="Text") {$type="String";}
			if ($type=="JobTicket") {$type="Job_Ticket";}
			$SQL = "SELECT value FROM ActionProperty_{$type} WHERE id = $prop_id ";
			$res=mysql_query($SQL) or die("Query failed getActionPropertyFormData() [1]: " . mysql_error());
			while($data = mysql_fetch_array($res)) {
				$Item[$field[$fldname]]=$data["value"];
			}
		}
	}
	}
	return $Item;
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
			$inp="<textarea name='$name' $add >{{".$name."}}</textarea>";
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
			foreach($enum as $key => $value) {
				$value=trim(str_replace('"',"",$value));
				if ($value=="*") $value="Все"; 
				$option.="<option value='{$key}'>$value</option>";
			}
			if ($option>"") {
				$inp="<select name='$name' $add>$option</select>"; 
			}
			break;
		default:
			$inp="<input type='$type' name='$name' $add>";
			break;
	}
	return $inp;
}

function getActionProperties($action_id,$actionType=NULL,$fldname="name") {
	// Аналог getActionPropertyFormData, но вызывается по action_id
	// Возвращает данные actionProperty указанного action
	if ($actionType_id==NULL) {
		$Action=mysqlReadItem("Action",$action_id);
		$ActionType=mysqlReadItem("ActionType",$Action["actionType_id"]);
		$form=getActionTypeForm($ActionType["name"]);
	} else {
		if (is_numeric($actionType)) {
			$actionType=mysqlReadItem("ActionType",$actionType);
			$form=getActionTypeForm($ActionType["name"]); // Если передан id
		} else {
			$form=getActionTypeForm($ActionType); // Если передано имя
		}
	}
	$Item=array(); $Item["id"]=$action_id;
	$Item=getActionPropertyFormData($Item,$form,$fldname);
	unset($Item["id"]);
return $Item;
}

function insertProperties($array,$action_id,$person_id,$actionType_id){
$action=mysqlReadItem("Action",$action_id);
if ($action=="") {
	$action["id"]="_new";
	$action["createDatetime"]=date( "Y-m-d H:i:s" );
	$action["begDate"]=date("Y-m-d H:i:s" );
	$action["modifyDatetime"]=$action["createDatatime"];
	$action["modufyPerson_id"]=$person_id;
	$action["plannedEndDate"]=date("Y-m-d",strtotime($action["plannedEndDate"]));
	$action["actionType_id"]=$actionType_id;
	$action["event_id"]=$action["event_id"];
	$error=mysqlSaveItem("Action",$action);
	$action["id"]=mysql_insert_id();
}
$actionType=mysqlReadItem("ActionType",$actionType_id); $actionType=$actiontype["name"];
$pattern=substr(actionType,0,8)."%";
$values['modifyDatetime'] = $values['createDatetime'] = '"' . date('Y-m-d H:i:s') . '"';
$values['modifyPerson_id'] = $values['createPerson_id'] = $person_id;
$values['action_id']=$action["id"];
foreach ($array as $i => $field){ 
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
  $values['type_id']=$array[$i]['type_id']; // работает через js
  if ($values['type_id']=="") $values['type_id']=$array[$i]['id']; // работает через php
	if ($values['type_id']>"") {
		  $out = array();
		   foreach ($values AS $k => $v) {
			$out[] = "{$k}={$v}";
		   }
		  $out = implode(',', $out);
		  $SQL="INSERT INTO ActionProperty SET {$out}";
		  mysql_query($SQL) or die ("Query failed 1: " . mysql_error());
	}

  $id=mysql_insert_id();
  $value=$array[$i]['value'];
  $type=$array[$i]['type']; 
	 if ($type =='JobTicket'){
		$type='Job_Ticket';
		if ( $jobticket_id>0 ) {
			$value= $jobticket_id;
			$thread_id=mysql_thread_id();
			mysql_query("UPDATE Job_Ticket SET resTimestamp={$values['modifyDatetime']} ,resConnectionid=$thread_id WHERE id={$jobticket_id}") or die("Query failed 2: " . mysql_error());
		}
	}
	if ($type>"") {
		if ($type!="Job_Ticket" OR ($type=="Job_Ticket" AND $jobticket_id>0 )) {
			if ($type=="Text") {$type="String";}
			$SQL="INSERT INTO `ActionProperty_{$type}` SET id={$id}, value='{$value}' ";
			mysql_query($SQL) or die("Query failed 3: " . mysql_error());
		}
	}
 	}
}



function updateProperties($array,$action_id,$person_id,$actionType_id){
$values['modifyDatetime']  = '"' . date('Y-m-d H:i:s') . '"';
$values['modifyPerson_id'] = $person_id;
foreach($array as $property) {
	$values['type_id']=$property['type_id']; // работает через js
	if ($values['type_id']=="") $values['type_id']=$property['id']; // работает через php
	if ($values['type_id']>"") {
		$out = array();
		foreach ($values AS $k => $v) {   $out[] = "{$k}={$v}";   }
		$out = implode(',', $out);
		$id=getActionPropertyTypeId($action_id,$values['type_id']);
		if ($id>"") {
			  $SQL="UPDATE ActionProperty SET {$out} WHERE id={$id}";
			  mysql_query($SQL) or die ("Query failed updateProperties() [1]: " . mysql_error());
			  $value=$property['value'];
			  $type=$property['type'];
			  if ($type=="Text") {$type="String";}
				checkProperties($type, $id);
				$SQL="UPDATE ActionProperty_{$type} SET value='{$value}' WHERE id={$id}";
				mysql_query($SQL) or die("Query failed updateProperties() [2]: " . mysql_error());
		}
	}
}
}

function checkProperties($type, $id) {
	// при смене в работающей базе типа property данные не обновляются
	// данная функция решает эту проблему, создавая новый property
	$SQL="SELECT * FROM ActionProperty_{$type} WHERE id={$id} LIMIT 1";
	$res=mysql_query($SQL) or die("Query failed checkProperties() [1]: " . mysql_error());
	$check=NULL;
	while($data = mysql_fetch_array($res)) {$check=$data["id"];	}
	if ($check==NULL) {
		$SQL="INSERT INTO ActionProperty_{$type} SET id={$id}";
		mysql_query($SQL) or die("Query failed checkProperties() [2]: " . mysql_error());
	}
}

function getActionPropertyTypeId($action_id,$type_id) {
$id=FALSE;
$SQL="SELECT id FROM ActionProperty WHERE action_id = $action_id AND type_id = $type_id";
$res=mysql_query($SQL) or die("Query failed getActionPropertyTypeId() [1]: " . mysql_error());
while($data = mysql_fetch_array($res)) {
		$id=$data["id"];
}	
return $id;
}

function getActionTypeByName($name,$like=FALSE) {
	$result=FALSE;
	if ($like==TRUE) {
		$SQL="SELECT id FROM ActionType WHERE name LIKE '".$name."' LIMIT 1";
	} else {
		$SQL="SELECT id FROM ActionType WHERE name = '".$name."' LIMIT 1";
	}
	$res=mysql_query($SQL);
	while($data = mysql_fetch_array($res)) {
		$result=$data["id"];
	}
	return $result;
}

function getActionTypeByCode($code) {
	$result=FALSE;
	$SQL="SELECT id FROM ActionType WHERE code = '{$code}' LIMIT 1";
	$res=mysql_query($SQL);
	while($data = mysql_fetch_array($res)) {
		$result=$data["id"];
	}
	return $result;
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
	$Client["addressReg"]=getClientAddress($client_id,0);
	$Client["addressLive"]=getClientAddress($client_id,1);
	$Client["contacts"]=getClientContacts($client_id);
	$Client["work"]=getClientWork($client_id);
	$Client["blood"]="";
	if ($event_id>0) {
		$Event=mysqlReadItem("Event",$event_id); 
		$Client["blood"]=getBloodType($Event["client_id"]);
	}
	return $Client;
}

function getClientAddress($client_id,$type=1) {
		$backtrace = debug_backtrace();
	$address=array();
	if ($type==1) {
		$SQL="SELECT getClientLocAddress({$client_id})";
	} else {
		$SQL="SELECT getClientRegAddress({$client_id})";
	}

	$res=mysql_query($SQL) or die("Query failed getActionPropertyFormData() [1]: " . mysql_error().print_rа( $backtrace, true ));
		while($data = mysql_fetch_array($res)) {
			$address=$data[0];
		}
	return $address;
}

function getClientContacts($client_id) {
	$work=array();
		$SQL="SELECT getClientContacts ( {$client_id} ) ;";
		$res=mysql_query($SQL) or die("Query failed getClientContacts(): " . mysql_error());
		while($data = mysql_fetch_array($res)) {
			$work=$data[0];
		}
	return $work;
}

function isActionPayed($action_id) {
	$work=array();
		$SQL="SELECT isActionPayed ( {$action_id} ) ;";
		$res=mysql_query($SQL) or die("Query failed getClientWork(): " . mysql_error());
		while($data = mysql_fetch_array($res)) {
			$work=$data[0];
		}
	return $work;
}

function getClientWork($client_id,$type=1) {
	$work=array();
		$SQL="SELECT getClientWork ( {$client_id} ) ;";
		$res=mysql_query($SQL) or die("Query failed getClientWork(): " . mysql_error());
		while($data = mysql_fetch_array($res)) {
			$work=$data[0];
		}
	return $work;
}

function getActionInfo($action_id) {
	$_action=jdbReadItem("Action",$action_id);
	$action=mysqlReadItem("Action",$action_id);
	$action=array_merge($_action,$action);
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
	if ($action["epicriz"]["transfusion_req"]==1) {
			$action["hemotrans"]="переливание"; $action["transfusion_req"]=1;
	} else {$action["hemotrans"]=""; $action["transfusion_req"]=0;} 
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
	$action["orgStrShort"]=$Creator["orgStrShort"];
	$action=actionAssistRead($action);
	$action["orgStrBoss"]=json_decode(getOrgStrBossName(),true)["fullName"];
	$Diag=patientGetDiagnosis($action["event_id"]);
	$action["diag"]=$Diag;
	$brigada=array(); 
	foreach($action["assist_id"] as $assist_id) {
		$assist=getPersonInfo($assist_id);
		$brigada[]=$assist["personShort"];
	}
	if ($action["assist_name"]>"") {$brigada[]=$action["assist_name"];}
	$action["brigada"]=implode(", ",$brigada);
	$begTime=strtotime($action["begDate"]." ".$action["begTime"]);
	$endTime=strtotime($action["endDate"]);
	$action["o_endTime"]=date("H:i",$endTime); // конец опреации
	$action["o_time"]= date("H:i", mktime(0, 0, ($endTime-$begTime))); // длительность операции
	$action["diagnose"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];
 	$action["tableName"]="№".$action["table"]." (".$Person["orgStrShort"].")"; 
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
	if ($action["dejur_assist"]>"") {$action["dejur"].=", ".$action["dejur_assist"];}
	$action["anest"]=$Anest["personShort"];
	$action["bloodmen"]=$Hemo["personShort"];
	$action["oper_sister"]=$OpSis["personShort"];
	$action["anest_sister"]=$AnSis["personShort"];
	$action["age"]=$Client["age"];
	$action["palata"]=getClientPalata($action["event_id"]);
	$action["payed"]=isActionPayed($action["id"]);
  $action["status"]=get_action_status($action_id,$action,$_action);
  if ($action["status"]==3) {$cnote="<li><span class='ui-red ui-bold'>Отменена:</span> ".$action["cancelNote"]."</li>";} else {$cnote="";}
	$action["tooltip"]="<ul class='inner'>
        $cnote
				<li>Пациент: {$action["client"]} ({$action["age"]} лет)</li>
				<li>Диагноз: {$action["diagnose"]}</li>
				<li>Название операции: $action[operation]</li>
				<li>Хирург: $action[person]</li>
				<li>Ассистент: $action[brigada]</li>
				<li>Группа крови: $action[blood]</li>
				<li>Дата поступления: $action[client_begDate]</li>
			</ul>";
	$action["action_id"]=$action_id;
  } else {	}
	return $action;
}

function actionAssistSave($action,$role="zavnazn") {
$assistsTable="Action_Assistant1";
$r=array(); $where="";
$r["zavnazn"]=array(1,4,5); // id в справочнике rbActionAssistantType
$r["mainsister"]=array(6,7);
$r["anest"]=array(8,9);
foreach ($r[$role] as $val) {
	if ($where=="") { 	$where.=" assistantType_id = ".$val;} else {
						$where.=" OR assistantType_id = ".$val;}
}
if ($where>"") {
		$SQL="DELETE QUICK FROM {$assistsTable} WHERE action_id = ".$action["id"]." AND (".$where.")";
} else {
		$SQL="DELETE QUICK FROM {$assistsTable} WHERE action_id = ".$action["id"];
}
$result = mysql_query($SQL) or die("Query failed: (actionAssistSave) " . mysql_error());
switch($role) {
	case "zavnazn":
		foreach($action["assist_id"] as $inx => $assist_id) {
			$data=actionAssistItem($action,"assist_id",$inx);
			mysqlSaveItem($assistsTable,$data);
		}
		$data=actionAssistItem($action,"assist_name"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"dejur_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"hemo_id"); mysqlSaveItem($assistsTable,$data);
		break;
	case "mainsister":
		$data=actionAssistItem($action,"operSister_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"sanitar"); mysqlSaveItem($assistsTable,$data);
		break;
	case "anest":
		$data=actionAssistItem($action,"an_person_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"an_sister_id"); mysqlSaveItem($assistsTable,$data);
		break;
	case "zamglav":
		foreach($action["assist_id"] as $inx => $assist_id) {
			$data=actionAssistItem($action,"assist_id",$inx);
			mysqlSaveItem($assistsTable,$data);
		}
		$data=actionAssistItem($action,"assist_name"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"dejur_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"hemo_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"operSister_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"sanitar"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"an_person_id"); mysqlSaveItem($assistsTable,$data);
		$data=actionAssistItem($action,"an_sister_id"); mysqlSaveItem($assistsTable,$data);
		break;
}
}

function actionAssistRead($action) {
$assistsTable="Action_Assistant1";
$SQL="SELECT * FROM {$assistsTable} WHERE action_id = ".$action["id"];
$res = mysql_query($SQL) or die("Query failed (actionAssistRead): " . mysql_error());
$assist=array();
while($data = mysql_fetch_array($res)) {
	if ($data["assistantType_id"]==1 AND $data["person_id"]>0) { $assist[]=$data["person_id"];}
	if ($data["assistantType_id"]==1 AND $data["freeInput"]>"") { $action["assist_name"]=$data["freeInput"];}
	if ($data["assistantType_id"]==5) {$action["dejur_id"]=$data["person_id"];}
	if ($data["assistantType_id"]==4) {$action["hemo_id"]=$data["person_id"];}
	if ($data["assistantType_id"]==6) {$action["operSister_id"]=$data["person_id"];}
	if ($data["assistantType_id"]==7) {$action["sanitar"]=$data["freeInput"];}
	if ($data["assistantType_id"]==8) {$action["an_person_id"]=$data["person_id"];}
	if ($data["assistantType_id"]==9) {$action["an_sister_id"]=$data["person_id"];}
}
$action["assist_id"]=$assist;
return $action;
}

function actionAssistItem($action,$type,$inx=0) {
	if ($type=="assist_name") 	{$tid=1;}
	if ($type=="assist_id") 	{$tid=1;}
	if ($type=="dejur_id") 		{$tid=5;}
	if ($type=="hemo_id") 		{$tid=4;}
	if ($type=="operSister_id") {$tid=6;}
	if ($type=="sanitar") 		{$tid=7;}
	if ($type=="an_person_id") 	{$tid=8;}
	if ($type=="an_sister_id") 	{$tid=9;}
	$data=array();
	$data["id"]="_new";
	$data["createDatetime"]		=date("Y-m-d H:i:s");
	$data["createPerson_id"]	=$action["modifyPerson_id"];
	$data["modifyDatetime"]		=$data["createDatetime"];
	$data["modifyPerson_id"]	=$data["createPerson_id"];
	$data["action_id"]			=$action["id"];
	$data["assistantType_id"]	=$tid;
	if ($type!="assist_name" AND $type!="sanitar") {
		if ($tid==1) {$data["person_id"]=$action[$type][$inx];} else {$data["person_id"]=$action[$type];}
	} else {
			$data["freeInput"]=$action[$type];}
	return $data;
}

function getPersonInfo($person_id) {
	$Person=mysqlReadItem("Person",$person_id);
	$Profile=mysqlReadItem("rbUserProfile",$Person["userProfile_id"]);
	$Person["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
	$Person["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
	$Person["orgStructure"]=getOrgStrName($Person["orgStructure_id"]);
	$Person["orgStrShort"]=getOrgStrName($Person["orgStructure_id"],"code");
	$Person["userProfile_code"]=$Profile["code"];
	$Person["userProfile_name"]=$Profile["name"];
	return $Person;
}

function checkAllow() {
if (!isset($_SESSION["allow"])) { $res=TRUE; } else {
	if (in_array($_SESSION["user_role"],$_SESSION["allow"])) {$res=TRUE;} else {$res=FALSE;}
}
return $res;
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
			$name["shortName"]=$data["lastname"]." ".substr($data["firstname"],0,2).". ".substr($data["patrname"],0,2).".";
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
		$stop="$year-$month-".date("t", strtotime("$year-$month"));;

$SQL="SELECT Action.id FROM Action 
	INNER JOIN ActionType ON Action.actionType_id = ActionType.id
	INNER JOIN Person ON Action.setPerson_id=Person.id
	INNER JOIN Event ON Action.event_id = Event.id
	INNER JOIN EventType ON Event.EventType_id = EventType.id
	WHERE ActionType.serviceType = 4
	AND EventType.medicalAidType_id = 3 
		AND ( Action.begDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' 
			OR (
				(Action.plannedEndDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' )
					AND 
				(Action.begDate like '1970%' OR Action.begDate IS NULL )
				) 
			)
	AND Action.deleted=0
	ORDER BY Action.status DESC ";

/*


SELECT * FROM Action as a 
  INNER JOIN ActionType as b ON a.actionType_id = b.id 
  INNER JOIN Person as c ON a.setPerson_id=c.id
  WHERE b.serviceType = 4 
  AND a.deleted = 0 
  AND ( begDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' OR (plannedEndDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' ) )
  ORDER BY status DESC ";
  */
//  AND ( begDate BETWEEN '$start' AND '$stop' OR (plannedEndDate BETWEEN '$start' AND '$stop'  AND ( begDate like '1970%' OR begDate IS NULL )) )
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		$data=array();
		while($a = mysql_fetch_array($res)) {
			$action=getActionInfo($a[0]);
			if ($action[$role]==$person_id OR ($action["isUrgent"]==1 AND $action[$role]=="") ) {
			if (date("Y",strtotime($action["begDate"]))=="1970" OR $action["begDate"] == NULL) {
					$curdate=date("d",strtotime($action["plannedEndDate"]));
			} else {	$curdate=date("d",strtotime($action["begDate"]));}
			if (!isset($data[$curdate][$action["status"]])) {$data[$curdate][$action["status"]]=1;} else {$data[$curdate][$action["status"]]++;}
			}
		}
	mysql_free_result($res);
	return json_encode($data);
}

function getOperationsByDate($month,$year,$oid="") {
		$start="$year-$month-01";
		$stop="$year-$month-".date("t", strtotime("$year-$month"));;
		if ($oid>"") {
$SQL="SELECT Action.id FROM Action 
	INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
	INNER JOIN Person ON Action.setPerson_id=Person.id
	INNER JOIN Event ON Action.event_id = Event.id
	INNER JOIN EventType ON Event.EventType_id = EventType.id
	WHERE ActionType.serviceType = 4 and Person.orgStructure_id=$oid
	AND EventType.medicalAidType_id = 3 
	AND Action.deleted = 0 
	AND ( Action.begDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' 
		OR (
			(Action.plannedEndDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' )
				AND 
			(Action.begdate like '1970%' OR Action.begDate IS NULL )
			) 
		)
  ORDER BY Action.status DESC ";
		} else {
		$SQL="SELECT Action.id FROM Action 
		INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
		INNER JOIN Event ON Action.event_id = Event.id
		INNER JOIN EventType ON Event.EventType_id = EventType.id
		WHERE ActionType.serviceType = 4
		AND EventType.medicalAidType_id = 3
		AND ( Action.begDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' 
			OR (
				(Action.plannedEndDate BETWEEN '$start 00:00:00' AND '$stop 23:59:59' )
					AND 
				(Action.begDate like '1970%' OR Action.begDate IS NULL )
				) 
			)
		ORDER BY status DESC ";
}

// 		AND ( begDate BETWEEN '$start' AND '$stop' OR (plannedEndDate BETWEEN '$start' AND '$stop'  AND ( begDate like '1970%' OR begDate IS NULL )) )


		$res = mysql_query($SQL) or die("Query failed: " . mysql_error());
		$data=array();
		while($a = mysql_fetch_array($res)) {
			$action=getActionInfo($a[0]);
			if (date("Y",strtotime($action["begDate"]))=="1970" OR $action["begDate"] == NULL) {
					$curdate=date("d",strtotime($action["plannedEndDate"]));
			} else {	$curdate=date("d",strtotime($action["begDate"]));}
			if (!isset($data[$curdate][$action["status"]])) {$data[$curdate][$action["status"]]=1;} else {$data[$curdate][$action["status"]]++;}
		
		}
	mysql_free_result($res);
	return json_encode($data);
}
 
function checkApprovedTable($date,$orgStr_id,$table) {
	$_tables=jdbReadItem("Tables",$date);
	$org=$_tables[$orgStr_id]; 
	if (isset($org[$table])) {$res=TRUE;} else {$res=FALSE;}
	if ($table==0) {$res=TRUE;} // Если это стол назначеный ст.сестрой оперблока
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
while($data = mysql_fetch_array($result)) {	$diagnoses["clinic"]=$data;}
 
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
$actionType=getActionTypeByName("терапевта (первичная)") ;
$SQL="SELECT c.name,a.value FROM ActionProperty_String as a
INNER JOIN ActionProperty as b ON a.id=b.id
INNER JOIN ActionPropertyType as c ON b.type_id=c.id
INNER JOIN Action as d ON b.action_id=d.id
INNER JOIN Event as f ON d.event_id=f.id
WHERE  d.actionType_id={$actionType} and name LIKE 'Закл%' AND event_id=$event_id";
$result = mysql_query($SQL) or die("Query failed: (get_diagnoses) " . mysql_error());
while($data = mysql_fetch_array($result)) {	$diagnoses["terapevt"]=$data;}

// Заключение анестезиолога
$data["name"]=""; $data["value"]=""; $diagnoses["anest"]=$data; 
$actionType=getActionTypeByName("анестезиолога") ;
$SQL="SELECT c.name,a.value FROM ActionProperty_String as a
INNER JOIN ActionProperty as b ON a.id=b.id
INNER JOIN ActionPropertyType as c ON b.type_id=c.id
INNER JOIN Action as d ON b.action_id=d.id
INNER JOIN Event as f ON d.event_id=f.id
WHERE  d.actionType_id=$actionType and name LIKE 'Закл%' AND event_id=$event_id";
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
	if ($Action["status"]!=2 AND $Action["status"]!=3) {
		if ($Action["status"]=="") {$Action["status"]=0;}
		if ($Action["zav_ok"]==1) $Action["status"]=4;
		if ($Action["zam_ok"]==1) {$Action["status"]=1;}
		if ($Action["isUrgent"]==1 AND ($Action["status"]!=2 AND $Action["status"]!=3) ) {$Action["status"]=1;}
	}
	return  $Action["status"];
	// status 0 - (серый) назначена
	// status 1 - (зелёный) утверждена замглавврача
	// status 2 - (синий) проведена
	// stasus 3 - (красный) отменена
	// status 4 - (жёлтый) утверждена завотдел и старшей сестрой
}

/*function actionBeforeSaveItem($Item) {
if (isset($Item["status"]) AND $Item["status"]!=2 AND $Item["status"]!=3) {
	// В базе должно быть - Статус выполнения: 0-Начато, 1-Ожидание, 2-Закончено, 3-Отменено, 4-Без результата
	
}
return $Item;
}*/


function getSpisanieItems($id) {
	$stockMotion="StockMotion";
   $array=array();
    if ($id>"") {

			$SQL="SELECT * FROM {$stockMotion}_Item
				WHERE master_id = '$id' ";
			$result = mysql_query($SQL) or die("Query failed: getSpisanieItems() " . mysql_error());	
			while($data = mysql_fetch_array($result)) {
 				$array[]=$data;
			}

		mysql_free_result($result);
    }
		return json_encode($array);
}

function getDrugs($sklad="043000069") {
if ($_SESSION["settings"]["appId"]!="msk36") {
$client=new SoapClient("http://192.168.100.47:1213/pharon/ws/MedicinePrice.1cws?wsdl",
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
} else {
	$arr=array();
	$drugs=mysqlListItems("rbDrug36"); 
	foreach($drugs["result"] as $key => $drug) {
		$item=array();
		$item["drugId"]=$drug["id"];
		$item["drugName"]=$drug["name"];
		$item["unitName"]=$drug["unit_id"];
		$Item["quantity"]=$drug["code"];
		if (substr($drug["code"],0,3)==$sklad."-") {
			$arr[]=$item;
		}
	}
}
return $arr;
}

function cmp($a, $b) {
    return strcmp($a['drugName'], $b['drugName']);
}
?>
