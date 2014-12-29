<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Врач");

function epicrizOut_edit($form,$mode,$id,$datatype) {
$out=formGetForm($form,$mode);
parse_str($_SERVER["REQUEST_URI"]);
if ($id!="_new" AND $id!="") {
	$action=getEpicrizOut($id);
	if (isset($action["id"])) {
		$Item=$action;
		$Item["fields"]=$action["epic_out"];
		$Item["action_id"]=$action["id"];
	} else {
		$field=array();
		$Item["action_id"]="_new";
		$field[0]["val"]=""; $field[0]["fld"]="Полный диагноз, сопутствующее осложнение";
		$field[1]["val"]=""; $field[1]["fld"]="Краткий анамнез, диагностические исследования, течение болезни";
		$field[2]["val"]=""; $field[2]["fld"]="Лечебные и трудовые рекомендации";
		$Item["fields"]=$field;
	}

print_r($Item["fields"]);
	
	$event=mysqlReadItem("Event",$id);
	$person=getPersonInfo($person_id);
	$client=getClientInfo($event["client_id"]);
	$organisation=mysqlReadItem("Organisation",$person["org_id"]);
	$Item["event_id"]=$id;
	$Item["org"]=$organisation["shortName"];
	$Item["orgStr"]=$person["orgStructure"];
	$Item["person"]=$person["personShort"];
	$Item["person_id"]=$person_id;
	$Item["client"]=$client["client"];
	$Item["bDate"]=getRusDate($client["birthDate"])."г.";
	$Item["docDate"]=getRusDate(date("d-m-Y"))."г.";
	$Item["address"]=$client["addressLive"];
	$Item["work"]=$client["work"];
	
	$Item["a_date1"]=$Item["a_date2"]=$Item["s_date1"]=$Item["s_date2"]="";
	$Item["s_date1"]=getRusDate($event["setDate"])."г.";
	if ($event["execDate"]>"") $Item["s_date2"]=getRusDate($event["execDate"])."г.";
	
}
$out=contentSetData($out,$Item);
return $out;
}

function getEpicrizOut($event_id) {
	$action=array();
	$actionType_id=getActionTypeByName("DoctorRoom: Выписной эпикриз");
	if($actionType_id=="") { echo "Необходимо создать ActionType 'DoctorRoom: Выписной эпикриз'"; } else {
	$SQL="SELECT * FROM Action AS a 
	WHERE a.actionType_id = ".$actionType_id." 
	AND a.deleted = 0 
	AND a.event_id = ".$event_id." 
	LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed getEpicrizOut(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action=getActionInfo($data[0]);
	}
	}
	return $action;
}

?>
