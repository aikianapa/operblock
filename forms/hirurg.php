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
$out=contentSetData($out,$Item);
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
		AND (begDate='$date' OR plannedEndDate='$date')
		ORDER BY Action.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$counter++; $action["counter"]=$counter;
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["begDate"]=dmyDate($action["begDate"]);
			$result[]=$action;
		}

	return $result;
}

?>
