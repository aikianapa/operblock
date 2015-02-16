<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();


function sisteranDataType() { return "mysql"; }

function sisteran_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=sisteranListItems() ;
if (isset($_COOKIE["workDate"])) {$Item["workDate"]=$_COOKIE["workDate"];} else {$Item["workDate"]=date("Y-m-d");}
$Item["person_id"]=$_SESSION["person_id"];
$out=contentSetData($out,$Item);
return $out;
}


function sisteran_spisanie($form,$mode,$id,$datatype)  {
$action=mysqlReadItem("Action",$id);
$_action=jdbReadItem("Action",$id);
$action=array_merge($action,$_action);
$actionType_id=$action["actionType_id"];
$out=formGetForm($form,$mode);
$spisanie=json_decode(getSpisanieItems($action["spisanie_an"]),true);
if ($_SESSION["settings"]["appId"]=="msk36") {$drugslist=getDrugs("an");} else {$drugslist=getDrugs("043000034");}
foreach($drugslist as $drug_id => $data) {
	$data["drug_id"]=$data["drugId"];
  foreach($spisanie as $s) { 
    if ($s["qnt"]>0 AND $s["nomenclature_id"]==$data["drugId"]) {$data["quantity"]=$s["qnt"];} 
  }
//	$data["drugquantity"]=$drug["quantity"];
	$Item["drugs"][]=$data;
}
$Item["action_id"]=$id;
$Item["drugs"]=array_sort($Item["drugs"],"drugName");
$out=contentSetData($out,$Item);
return $out;
}


function sisteranListItems() {
 // ============== Готовим список текущих пациентов
 $SETTINGS=$_SESSION['settings'];
 $result=array(); $counter=0;
 if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d");}

  $SQL="SELECT * FROM Action INNER JOIN ActionType ON Action.actionType_id = ActionType.id 
  WHERE ActionType.serviceType = 4 
	AND ( Action.begDate BETWEEN '$date 00:00:00' AND '$date 23:59:59' 
		OR (
				(Action.plannedEndDate BETWEEN '$date 00:00:00' AND '$date 23:59:59' )
					AND 
				(Action.begDate like '1970%' OR Action.begDate IS NULL )
			) 
		)
  AND Action.deleted=0
  ORDER BY Action.id DESC  ";
  $res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
  while($a = mysql_fetch_array($res)) {
   $action=getActionInfo($a[0]);
   $action["begDate"]=dmyDate($action["begDate"]);
   $counter++; $action["counter"]=$counter;
   if (!isset($_action["table"]))  $_action["table"]="";
    if ($action["an_sister_id"]==$_SESSION["person_id"] OR $_SESSION["person_id"]==6924) {
    $result[]=$action; 
	} 
  }

 return $result;
}

?>
