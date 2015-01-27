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

return $out;
} 

function zavedListItems() {
	$result=array(); $counter=0;
	if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}
		$SQL="SELECT * FROM Action as a
      INNER JOIN ActionType as b ON a.actionType_id=b.id
      INNER JOIN Person as c ON a.setPerson_id=c.id
      WHERE b.serviceType = 4 
      AND c.orgStructure_id = '{$_SESSION['orgStrId']}'
      AND ( a.begDate='{$date}' OR a.plannedEndDate='{$date}' )
	  AND a.deleted=0
      ORDER BY a.id DESC ";
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
