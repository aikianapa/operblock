<?

include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Врач","Регистратор ЛД","Врач ЛД","Заведующий ЛД","Лаборант ЛД");

function morfoNazn_edit($form,$mode,$id,$datatype) {
$out=formGetForm($form,$mode);
if ($id!="_new" AND $id!="") {
	$Item=morfoReadNazn($id);
	$Item["morfoNazn"]=morfoNaznForm($Item["actionType_id"]);
	$Diag=patientGetDiagnosis($Item["event_id"]);
	$Item["fld_3"]=$Diag["clinic"]["DiagName"];
	$Item["amount"]=1;
} else {
	$Item=morfoNewNazn();
	$Item["morfoNazn"]=morfoNaznForm();
}

if ($Item["person_id"]=="") {$Item["person_id"]=$_SESSION["user_id"];}
if (checkAllow()) {$out=contentSetData($out,$Item);} else {die ("Ошибка прав доступа!");}
$role=$_SESSION["user_role"];
if ($role!="Врач ЛД" && $role!="Заведующий ЛД") {
 pq($out)->find("a[href=#cancelOp]")->remove();
 pq($out)->find("div[data-role=include]")->remove();
 pq($out)->find("textarea")->parent("div")->remove(); // удаляем поле Результатов исследования
 pq($out)->find("input[name=fld_17]")->parent("div")->remove();
}
if ($role=="Лаборант ЛД") {
	pq($out)->find("textarea,input,select")->attr("readonly","readonly");
	pq($out)->find("select")->attr("disabled","disabled");
	pq($out)->find("a.submit")->remove();
}
return $out;
}

function morfoNazn_list($form,$mode,$id,$datatype) {
parse_str($_SERVER["REQUEST_URI"]);
if (isset($person_id)) {$_SESSION["user_id"]=$_SESSION["person_id"]=$person_id;}
$SETTINGS=$_SESSION['settings'];
if (isset($_COOKIE["workDate"])) {$Item["date1"]=$_COOKIE["workDate"];} else {$Item["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"" AND ($_COOKIE["endDate"]!=$_COOKIE["workDate"]) ) {
  $Item["date2"]=$_COOKIE["endDate"];
} else {$Item["date2"]=date("Y-m-d",strtotime($Item["date1"])); }
$Item["workDate"]=$Item["date1"]; $Item["endDate"]=$Item["date2"];
$out=formGetForm($form,$mode);
$actionType_id=getActionTypeByName("Патоморфологические исследования");
	$SQL="SELECT a.id FROM Action AS a
	INNER JOIN ActionType AS b
	WHERE a.actionType_id = b.id
	AND a.deleted = 0
	AND a.event_id = ".$event_id."
	AND b.group_id = ".$actionType_id."
	AND ( (a.begDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]} 23:59:59' ) 
	OR 
	( a.plannedEndDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]} 23:59:59' ) )
	ORDER BY a.begDate DESC ";
	$res=mysql_query($SQL) or die ("Query failed morfoNazn_list(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
			$action=getActionInfo($data["id"]);
			$action["begDate"]=dmyDate($action["begDate"]);
			$action["status"]=getMorfoStatus($action["id"]); 
			$result[]=$action;
	}
	if (checkAllow()) {$Item["result"]=$result;} else {die ("Ошибка прав доступа!");}
	$path_ref=parse_url($_SERVER["HTTP_REFERER"]); $path_ref=$path_ref["path"];
	$path_uri=parse_url($_SERVER["REQUEST_URI"]); $path_uri=$path_uri["path"]; 
	if ($path_ref!=$path_uri) {
		pq($out)->find("div[data-role=content]")->prepend("<div class='ref ui-hidden'>1</div>");
	}
$Item["person_id"]=$_SESSION["person_id"];
$out=contentSetData($out,$Item);
return $out;
}

function morfoNewNazn() {
	parse_str($_SERVER["REQUEST_URI"]);
	$Item["action_id"]="_new";
	$Item["event_id"]=$event_id;
	$Item["person_id"]=$person_id;
	$Item["client_id"]=$client_id;
	$Item["actionType_id"]=$atid;
	$Item["fld_19"]="";
	return $Item;
}

?>
