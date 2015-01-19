<?

include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Врач ЛД","Заведующий ЛД");

function morfoReport_list($form,$mode,$id,$datatype) {
parse_str($_SERVER["REQUEST_URI"]);
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
	AND b.group_id = ".$actionType_id."
	AND ( (a.begDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]} 23:59:59' ) 
	OR 
	( a.plannedEndDate BETWEEN '{$Item["workDate"]}' AND '{$Item["endDate"]} 23:59:59' ) )
	ORDER BY a.begDate DESC ";
	$res=mysql_query($SQL) or die ("Query failed morfoReg_list(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		$action=getActionInfo($action_id);
		$person=getMorfoLabPerson($action_id);
		$action["person"]=$person["personShort"];
		//$action["status"]=$Reg["status"];
		$SQL="SELECT a.name, a.idx, a.typeName, a.id, a.valueDomain, b.id FROM ActionPropertyType as a
			INNER JOIN ActionType as b ON a.actionType_id=b.id
			WHERE b.id=".$action["actionType_id"]."
			ORDER BY a.idx	";
		$form=getActionTypeForm($SQL);
		$action=getActionPropertyFormData($action,$form);
		$action["morfoResult"]=$action["fld_19"];
		$action["morfoPrev"]=$action["fld_1"];
		$action["begDate"]=dmyDate($action["begDate"]);
		$status=getMorfoStatus($action_id);
		if ($status>0) { $result[]=$action;	}
	}
if ($_SESSION["user_role"]=="Врач ЛД") {
	pq($out)->find("div#tab-2")->remove();
	pq($out)->find("div#tab-3")->remove();
	pq($out)->find("div[data-role=navbar]")->remove();
}
if (checkAllow()) {$Item["result"]=$result;} else {die ("Ошибка прав доступа!");}
$Item["person_id"]=$_SESSION["person_id"];
$Item["repForm"]=prepReportForm();
$out=prepReportFormSelects($out);
$out=contentSetData($out,$Item);
return $out;
}

function prepReportForm() {
$form=array();
if (isset($_COOKIE["workDate"])) {$form["date1"]=$_COOKIE["workDate"];} else {$form["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"" AND ($_COOKIE["endDate"]!=$_COOKIE["workDate"]) ) {
$form["date2"]=$_COOKIE["endDate"];
} else {$form["date2"]=date("Y-m-d",strtotime($form["date1"])); }
$form["begDateR"]=$form["date1"]; $form["endDateR"]=$form["date2"];
$res[0]=$form;
return $res;
}

function prepReportFormSelects($out) {
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_person_list&orgId=".$_SESSION["orgId"];
$persons=json_decode(file_get_contents($url),true);
foreach($persons as $key => $Person) {
	$opt="<option value=\"$Person[id]\">$Person[lastName] $Person[firstName] $Person[patrName]</option>";
	$out->find("#Hirurg select[name^=person] option:last")->after($opt);
	$out->find("#Time select[name^=person] option:last")->after($opt);
}

$url="http://".$_SERVER["HTTP_HOST"]."/json/morfology.php?mode=morfo_actions_list";
$operations=json_decode(file_get_contents($url),true);
foreach($operations as $key => $Oper) {
	$opt="<option value=\"$Oper[id]\">$Oper[name]</option>";
	$out->find("#Podr select[name^=actionType_id] option:last")->after($opt);
} 

$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_orgstr_list&orgId=".$_SESSION["orgId"];
$structures=json_decode(file_get_contents($url),true);
$Person=mysqlReadItem("Person",$_SESSION["person_id"]);
foreach($structures as $key => $OrgStr) {
	if ($OrgStr["id"]==$Person["orgStructure_id"]) {
		$opt="<option value=\"$OrgStr[id]\" selected>$OrgStr[code] ($OrgStr[name])</option>"; 
	} else {
		$opt="<option value=\"$OrgStr[id]\">$OrgStr[code] ($OrgStr[name])</option>";
	}
	$out->find("#Podr select[name^=orgStr] option:last")->after($opt);
}

return $out;
}

?>
