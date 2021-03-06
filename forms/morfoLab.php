<?

include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Врач ЛД","Заведующий ЛД","Лаборант ЛД");

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
	$SQL="SELECT *,
		(SELECT IF(aid.id IN ('1', '2', '3', '7'),1,0)
		 FROM Event as e
		 INNER JOIN EventType as et ON e.eventType_id = et.id
		 INNER JOIN rbMedicalAidType as aid ON et.medicalAidType_id = aid.id
		 WHERE e.id = a.event_id
		 LIMIT 1) as isHosp 
	FROM Action AS a
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
			$action["status"]=getMorfoStatus($action["id"]); 
			$action["begDate"]=dmyDate($action["begDate"]);
			$action["isHosp"] = $data['isHosp'];
			$result[]=$action;
	}
$Item["person_id"]=$_SESSION["person_id"];
if (checkAllow()) {$Item["result"]=$result;} else {die ("Ошибка прав доступа!");}
$out=contentSetData($out,$Item);
return $out;
}

function morfoLab_edit($form,$mode,$id,$datatype) {
$out=formGetForm($form,$mode);
foreach(morfoLab_getTypes() as $key => $atype) {
	$SQL="SELECT * FROM Action 
	WHERE actionType_id = {$atype["id"]}
	AND parent_id = {$id} ";
	$res=mysql_query($SQL) or die ("Query failed morfoLab_edit(): " . mysql_error());
	$action="";
	while($data = mysql_fetch_array($res)) {
		$action=$data;
		pq($out)->find("ul.loc-ready")->append("<li><a href='#' value='{$atype["id"]}' item='{$action["id"]}'>{$atype["name"]}</a></li>");
	}
	if ($action=="") {pq($out)->find("ul.loc-list")->append("<li><a href='#' value='{$atype["id"]}' item='_new'>{$atype["name"]}</a></li>");}
}
$Item=morfoReadLabAction($id);
$Reg=morfoReadReg($id);

$num=explode("/",$Reg["fld_0"]);
$Item["fld_12"]=$num[2];
$out=contentSetData($out,$Item);
$out->find("input[name=fld_0]")->attr("type","hidden")->prev("label")->remove();
$out->find("input[name=fld_1]")->attr("type","hidden")->prev("label")->remove();
$out->find("input[name=fld_2]")->attr("type","hidden")->prev("label")->remove();
return $out;
}

?>
