<?
include_once($_SERVER["DOCUMENT_ROOT"]."/functions.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
prepareSessions();

function zavedDataType() { return "mysql"; }

function zaved_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=zavedListItems() ;
$Item["person_id"]=$_SESSION["person_id"];
if (isset($_COOKIE["workDate"])) {$Item["workDate"]=$_COOKIE["workDate"];} else {$Item["workDate"]=date("Y-m-d");}
$Item["tables"]=prepareTables(4);
$Item["orgStr_id"]=$_SESSION["orgStrId"];
$out->find("#zavedList")->prepend("<input id='appId' type='hidden' value='".$_SESSION["settings"]["appId"]."' />");
$out=contentSetData($out,$Item);
$out=setSelects($out);
return $out;
}


function setSelects($out) {
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_hirurg_list&orgStrId=".$_SESSION["orgStrId"];
$_hirurg=json_decode(file_get_contents($url));
foreach($_hirurg as $key => $Hirurg) {
	$opt="<option value=\"$Hirurg->id\">$Hirurg->lastName $Hirurg->firstName $Hirurg->patrName</option>";
	// данные для формы утверждения операции // 
	$out->find("#zavnazn select[name=person_id] option:last")->after($opt);
	$out->find("#zavnazn  select[name=dejur_id] option:last")->after($opt);
	$out->find("#zavnazn select[name=hemo_id] option:last")->after($opt);
	$out->find("#zavnazn select[name^=assist_id] option:last")->after($opt);
	// ==================
	$out->find("#zavtable select[name=person_id] option:last")->after($opt);
	$out->find("#zavtable select[name=dejur_id] option:last")->after($opt);
	$out->find("#zavtable select[name=hemo_id] option:last")->after($opt);
	$out->find("#zavtable select[name^=assist_id] option:last")->after($opt); 
}

if ($_SESSION["settings"]["appId"]=="msk36") {
		$out->find("#zavnazn select[name=dejur_id]")->parent("div")->remove();
		$out->find("#zavtable select[name=dejur_id]")->parent("div")->remove();
}

return $out;
} 

function zavedListItems() {
	$result=array(); $counter=0;
	if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}
		$SQL="SELECT * FROM Action 
      INNER JOIN ActionType ON Action.actionType_id=ActionType.id
      INNER JOIN Person ON Action.setPerson_id=Person.id
      WHERE ActionType.serviceType = 4 
      AND Person.orgStructure_id = '{$_SESSION['orgStrId']}'
	AND ( Action.begDate BETWEEN '$date 00:00:00' AND '$date 23:59:59' 
		OR (
				(Action.plannedEndDate BETWEEN '$date 00:00:00' AND '$date 23:59:59' )
					AND 
				(Action.begDate like '1970%' OR Action.begDate IS NULL )
			) 
		)
	  AND Action.deleted=0
      ORDER BY Action.id DESC ";
      //$SQL="DELETE QUICK FROM Action WHERE id = 2028904 ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action=getActionInfo($a[0]);
			if ($action["orgid"]=="") { $action["orgid"]=$action["orgStr_id"]; }
			$action["begDate"]=dmyDate($action["begDate"]);
			$result[]=$action;
		}
		mysql_free_result($res);
		$result=array_sort($result, "index");
	return $result;
}

?>
