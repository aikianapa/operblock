<? 
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Регистратор ЛД","Врач ЛД","Заведующий ЛД");

function morfoReg_list($form,$mode,$id,$datatype) {
parse_str($_SERVER["REQUEST_URI"]);
if (isset($_COOKIE["workDate"])) {$Item["date1"]=$_COOKIE["workDate"];} else {$Item["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"" AND ($_COOKIE["endDate"]!=$_COOKIE["workDate"]) ) {
  $Item["date2"]=$_COOKIE["endDate"];
} else {$Item["date2"]=date("Y-m-d",strtotime($Item["date1"])); }
$Item["workDate"]=$Item["date1"];
$Item["endDate"]=$Item["date2"];
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
	ORDER BY a.begDate DESC";
	$res=mysql_query($SQL) or die ("Query failed morfoReg_list(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action=getActionInfo($data[0]);
		$Reg=morfoReadReg($action["id"]);
		$action["status"]=$Reg["status"];
		$action["begDate"]=dmyDate($action["begDate"]);
		$action["contacts"]=$action["_Client"]["contacts"];
		$result[]=$action;
	}
$Item["person_id"]=$_SESSION["person_id"];
if (checkAllow()) {$Item["result"]=$result;} else {die ("Ошибка прав доступа!");}
$out=contentSetData($out,$Item);
return $out;
}

function morfoReg_edit($form,$mode,$id,$datatype) {
$out=formGetForm($form,$mode);
$Item=morfoReadReg($id);
if ($Item["status"]>1) {
	pq($out)->find("select[name=status]")->prev("label")->remove();
	pq($out)->find("select[name=status]")->remove();
} else {
	pq($out)->find("a.submit")->before("&nbsp;");
}
$out=contentSetData($out,$Item);
return $out;
}

?>
 
