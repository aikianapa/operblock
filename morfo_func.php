<?
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

function getMorfoStatus($action_id) {
	$Naz=mysqlReadItem("Action",$action_id);
	$Reg=morfoReadReg($action_id);
	$Lab=morfoReadLabAction($action_id);
									$status=0;  // жёлтый (status-0) - назначено доктором 
	if ($Reg["status"]==1) {		$status=1;} // зелёный (status-1) - зарегистрирован регистратором
	if ($Naz["status"]==2) {		$status=2;} // синий (status-2) - выполнено исследование ВрачомЛД
	if ($Naz["status"]==3) {		$status=3;} // красный (status-3) - отменён
	if ($Lab["status"]==2) {		$status=4;} // тёмно-зелёный (status-4) - описан лаборантом	
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

?>
