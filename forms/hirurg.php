<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();

function hirurgDataType() { return "mysql"; }

function hirurg_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=hirurgListItems() ;
if (isset($_COOKIE["workDate"])) {$Item["workDate"]=$_COOKIE["workDate"];} else {$Item["workDate"]=date("Y-m-d");}
$Item["person_id"]=$_SESSION["person_id"];
$aType='Протокол операции';
$form=getActionTypeForm($aType);
$Item["actionType_id"]=getActionTypeByName($aType);
$Item["person_id"]=$_SESSION["person_id"];
$Item["protocol"]=$form;
$out=contentSetData($out,$Item);
$out->find("#operation [name=fld_0]")->attr("type","time");
$out->find("#operation [name=fld_1]")->attr("type","datetime")->attr("required","required");
$out->find("#operation [name=fld_6]")->attr("required","required");
$out->find("#operation [name=fld_8]")->attr("required","required");
return $out;
}

function hirurgListItems() {
	// ============== Готовим список текущих пациентов
	$SETTINGS=$_SESSION['settings'];
// ======================= переменные для SQL =============================
	if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}

		$SQL="SELECT * FROM Action INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
		WHERE ActionType.serviceType = 4 
		AND Action.person_id = $_SESSION[person_id]
		AND (Action.status = 1 OR Action.status = 2)
		AND ( Action.begDate BETWEEN '$date 00:00:00' AND '$date 23:59:59' OR (Action.plannedEndDate BETWEEN '$date 00:00:00' AND '$date 23:00:59'  ) )
		AND Action.deleted=0
		ORDER BY Action.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$counter++; $action["counter"]=$counter;
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["ready"]=oper_ready_check($action);
			$action["begDate"]=dmyDate($action["begDate"]);
			if ($action["specifiedName"]>"") {$action["operation"]=$action["specifiedName"];}
			$result[]=$action;
		}

	return $result;
}

function oper_ready_check($action) {
	$res=FALSE;
		$action=getOpTables($action,$action["begDate"]);
		foreach($action["optables"] as $key => $data) {
			if ($action["table"]==$data["tid"] && $data["opr"]>"" && $data["oid"]==$action["orgStr_id"]) {$res=TRUE;}
		}
	return $res;
}

?>
