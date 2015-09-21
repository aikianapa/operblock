<?
function morfoLab_getTypes() {
$list=array();
$parrent=getActionTypeByCode('morfo_loc');
if ($parrent=="") {pq($out)->find("#morfoLab")->html("<div data-role='header'><h2>Пожалуйста, создайте тип действий с кодом morfo_loc<br />и локализации в нём!</h2></div>"); }
$SQL="SELECT * FROM ActionType WHERE group_id = '{$parrent}' ";
$res=mysql_query($SQL) or die ("Query failed morfo_loc_list(): " . mysql_error());
while($data = mysql_fetch_array($res)) {$list[]=$data;}
return $list;
}

function getMorfoActions($month,$year) { 
	// для календаря
		$start="$year-$month-01";
		$stop="$year-$month-31";
	$actionType_id=getActionTypeByName("Патоморфологические исследования");
	$SQL="SELECT * FROM Action AS a
	INNER JOIN ActionType AS b
	WHERE a.actionType_id = b.id
	AND a.deleted = 0 
	AND b.group_id = ".$actionType_id."
	AND ( (a.begDate BETWEEN '{$start}' AND '{$stop} 23:59:59' ) 
	OR 
	( a.plannedEndDate BETWEEN '{$start}' AND '{$stop} 23:59:59' ) )
	ORDER BY a.begDate DESC ";
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

function getMorfoStatus($action_id, $Naz=NULL, $Reg=NULL, $Lab=NULL) {
	if ($Naz==NULL) $Naz=mysqlReadItem("Action",$action_id);
	if ($Reg==NULL) $Reg=morfoReadRegAction($action_id);
	if ($Lab==NULL) $Lab=morfoReadLabAction1($action_id);
								$status=0;  // жёлтый (status-0) - назначено доктором 
	if (count($Reg)>5) 		{	$status=1;} // зелёный (status-1) - зарегистрирован регистратором
	if (count($Lab)>5) 		{	$status=4;} // тёмно-зелёный (status-4) - описан лаборантом	
	if ($Naz["status"]==2) 	{	$status=2;} // синий (status-2) - выполнено исследование ВрачомЛД
	if ($Naz["status"]==3) 	{	$status=3;} // красный (status-3) - отменён
	return $status;
}


function morfoReadRegAction($id) {
$actionType_id=getActionTypeByName('Регистрация биоматериала');
$Action=mysqlReadItem("Action",$id);
$SQL="SELECT * FROM Action WHERE actionType_id = $actionType_id AND parent_id = $id LIMIT 1";
$res=mysql_query($SQL) or die ("Query failed morfoReadReg(): " . mysql_error());
$Item=array();
while($data = mysql_fetch_array($res)) {	$Item=$data;	}
return $Item;
}

function morfoReadLabAction1($id) {
$actionType_id=getActionTypeByName('Исследование биоматериала');
$Action=mysqlReadItem("Action",$id);
$SQL="SELECT * FROM Action WHERE actionType_id = $actionType_id AND parent_id = $id LIMIT 1";
$res=mysql_query($SQL) or die ("Query failed morfoReadReg(): " . mysql_error());
$Item=array();
while($data = mysql_fetch_array($res)) {	$Item=$data;	}
return $Item;
}


function morfoReadNazn($id) {
$action=mysqlReadItem("Action",$id);
$event=mysqlReadItem("Event",$action["event_id"]);
$action["client_id"]=$event["client_id"];
$action["action_id"]=$id;
if ($action["isUrgent"]==1) $action["isUrgent"]="on";
$form=morfoNaznForm($action["actionType_id"]);
$action["morfoNazn"]=$form;
$action=getActionPropertyFormData($action,$form);
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


function morfoReadReg($id) {
$actionType_id=getActionTypeByName('Регистрация биоматериала');
$Action=mysqlReadItem("Action",$id);
$SQL="SELECT * FROM Action WHERE actionType_id = $actionType_id AND parent_id = $id LIMIT 1";
$res=mysql_query($SQL) or die ("Query failed morfoReadReg(): " . mysql_error());
$Item=array();
$Item["action_id"]="_new";
$Item["parent_id"]=$id;
$Item["event_id"]=$Action["event_id"];
$Item["person_id"]=$_SESSION["user_id"];
$Item["actionType_id"]=$actionType_id;
while($data = mysql_fetch_array($res)) {
	$Item=$data;
	$Item["action_id"]=$Item["id"];
	$Item["person_id"]=$_SESSION["user_id"];
}
$form=morfoRegForm();
$Item["morfoReg"]=$form;
$Item=getActionPropertyFormData($Item,$form);
return $Item;
}

function morfoRegForm() {
$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
INNER JOIN ActionType as b ON a.actionType_id=b.id
WHERE b.name='Регистрация биоматериала'   
ORDER BY a.idx	";
return  getActionTypeForm($SQL);
}


function morfoReadLabAction($id) {
$actionType_id=getActionTypeByName('Исследование биоматериала');
$Action=mysqlReadItem("Action",$id);
$actionInfo=getActionInfo($id);
$SQL="SELECT * FROM Action WHERE actionType_id = $actionType_id AND parent_id = $id LIMIT 1";
$res=mysql_query($SQL) or die ("Query failed morfoReadReg(): " . mysql_error());
$Item=array();
$Item["action_id"]="_new";
$Item["parent_id"]=$id;
$Item["event_id"]=$Action["event_id"];
$Item["actionType_id"]=$actionType_id;
while($data = mysql_fetch_array($res)) {
	$Item=$data;
	$Item["action_id"]=$Item["id"];
}
$form=getActionTypeForm('Исследование биоматериала');
$Item["morfoLab"]=$form;
$Item=getActionPropertyFormData($Item,$form);
if ($Item["action_id"]=="_new") {
	$Item["fld_0"]=$actionInfo["client"];
	$Item["fld_1"]=$actionInfo["age"];
	$Item["fld_2"]=$actionInfo["orgStr_id"];
}
$Item["person_id"]=$_SESSION["user_id"];
return $Item;
}

function getMorfoLabPerson($id) {
	$action=morfoReadLabAction($id);
	$person=getPersonInfo($action["person_id"]);
	return $person;
}

function getMorfoLabPersonId($id){
	$SQL = "SELECT person_id 
			FROM Action as a
			INNER JOIN ActionType as b on a.actiontype_id = b.id
			WHERE a.parent_id = $id and flatcode = 'labld' AND a.deleted = 0
			LIMIT 1";
	$res = mysql_query($SQL) or die ("Query failed getMorfoLabPersonId(): " . mysql_error());
	$data = mysql_fetch_array($res);
	return $data['person_id'];
}

?>
