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
		foreach($action["epic_out"] as $key => $val) {$Item[$key]=$val;}
		$Item["action_id"]=$action["id"];
	} else {
		$Item["action_id"]="_new";
		$Item["fld_6"]=$Item["fld_7"]=$Item["fld_8"]="";
	}
	
	$event=mysqlReadItem("Event",$id);
	$person=getPersonInfo($person_id);
	$client=getClientInfo($event["client_id"]);
	$organisation=mysqlReadItem("Organisation",$person["org_id"]);
	$Item["event_id"]=$id;
	$Item["org"]=$organisation["shortName"];
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
