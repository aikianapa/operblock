<?
include_once($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();

function sisterDataType() { return "mysql"; }

function sister_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
$Item["result"]=sisterListItems();
if (isset($_COOKIE["workDate"])) {$Item["date1"]=$_COOKIE["workDate"];} else {$Item["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"") {
  $Item["date2"]=$_COOKIE["endDate"];
  $Item["endDate"]=$Item["date2"];
} else {$Item["date2"]=date("Y-m-d",strtotime($Item["date1"])+86400); }
//if ($Item["date1"]>$Item["date2"] AND $Item["date2"]>"") {$tmp=$Item["date1"]; $Item["date1"]=$Item["date2"]; $Item["date2"]=$tmp;}
$Item["workDate"]=$Item["date1"];
$Item["orgStr_id"]=$_SESSION["orgStrId"];
$Item["person_id"]=$_SESSION["person_id"];
$out=contentSetData($out,$Item);
if ($Item["endDate"]>"") {pq($out)->find("a[href=#print_menu]")->addClass("ui-hidden"); pq($out)->find("a.print_all")->removeClass("ui-hidden"); }
return $out->htmlOuter();
}

function sisterListItems() {
	// ============== Готовим список текущих пациентов
	$SETTINGS=$_SESSION['settings'];
	if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d ");}
	if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"") {$ndate=date("Y-m-d",strtotime($_COOKIE["endDate"]));} else {$ndate=date("Y-m-d",strtotime($date)+86400); }
	$oprList=json_decode(getOpRooms(),true);
	//if ($date>$ndate AND $ndate>"") {$tmp=$date; $date=$ndate; $ndate=$tmp;}
	$SQL="SELECT * FROM Action as a 
  INNER JOIN ActionType as b on a.ActionType_id=b.id
  INNER JOIN Person as c ON a.setPerson_id=c.id
  WHERE b.serviceType=4 
  AND c.orgStructure_id= $_SESSION[orgStrId]
	AND ( a.begDate BETWEEN '$date 00:00:00' AND '$ndate 23:59:59' 
		OR (
				(a.plannedEndDate BETWEEN '$date 00:00:00' AND '$ndate 23:59:59' )
					AND 
				(a.begDate like '1970%' OR a.begDate IS NULL )
			) 
		)
   ORDER BY a.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$oprooms=jdbReadItem("opRooms",$action["begDate"]);
			if ($action["table"]>"") {
				$opr=$oprooms[$action["orgid"]][$action["table"]]["oper"];
				$action["oproom"]="";
				foreach($oprList as $line) {
					if ($line["id"]==$opr) {$action["oproom"]="№ ".$line["bookkeeperCode"];}
				}
			} else {$action["oproom"]="";}
			$action["begDate"]=dmyDate($action["begDate"]);
			$counter++; $action["counter"]=$counter;
			$result[]=$action;
		}
	return $result;
}

?>
