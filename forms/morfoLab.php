<?
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
if ($_SESSION["user_id"]=="") {$_SESSION["person_id"]=$_SESSION["user_id"]=$Item["person_id"]=3701;}

function morfoLab_list($form,$mode,$id,$datatype) {
$SETTINGS=$_SESSION['settings'];
if (isset($_COOKIE["workDate"])) {$Item["date1"]=$_COOKIE["workDate"];} else {$Item["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"" AND ($_COOKIE["endDate"]!=$_COOKIE["workDate"]) ) {
  $Item["date2"]=$_COOKIE["endDate"];
} else {$Item["date2"]=date("Y-m-d",strtotime($Item["date1"])); }
$Item["workDate"]=$Item["date1"];
$Item["endDate"]=$Item["date2"];
parse_str($_SERVER["REQUEST_URI"]);
$out=formGetForm($form,$mode);
$actionType_id=getActionTypeByName("Патоморфологические исследования");
	$SQL="SELECT * FROM Action AS a
	INNER JOIN ActionType AS b
	WHERE a.actionType_id = b.id
	AND a.deleted = 0 
	AND b.group_id = ".$actionType_id."
	AND ( (a.begDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]} 23:59:59' ) 
	OR 
	( a.plannedEndDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]} 23:59:59' ) )
	ORDER BY a.begDate DESC ";
	$res=mysql_query($SQL) or die ("Query failed morfoLab_list(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action=getActionInfo($data[0]);
		$Reg=morfoReadRegAction($action["id"]);
		if ($Reg["status"]>=1) {
			$action["status"]=$Reg["status"];
			$result[]=$action;
		}
	}

$Item["result"]=$result;
$out=contentSetData($out,$Item);
return $out;
}

function morfoLab_edit($form,$mode,$id,$datatype) {
$out=formGetForm($form,$mode);
$Item=morfoReadLab($id);
$out=contentSetData($out,$Item);
return $out;
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

function morfoReadLab($id) {
$actionType_id=getActionTypeByName('Исследование');
$Action=mysqlReadItem("Action",$id);
$actionInfo=getActionInfo($id);
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
$form=getActionTypeForm('Исследование');
$Item["morfoLab"]=$form;
$Item=getActionPropertyFormData($Item,$form);
if ($Item["action_id"]=="_new") {
	$Item["fld_0"]=$actionInfo["client"];
	$Item["fld_1"]=$actionInfo["age"];
	$Item["fld_2"]=$actionInfo["orgStr_id"];
}
return $Item;
}

?>
