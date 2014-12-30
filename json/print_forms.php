<?
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
engineSettingsRead();
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
$mode=$_GET["mode"];
if (is_callable($mode)) {$rep=@$mode();}
$rep=ereg_replace("{{.*}}","",$rep);
echo $rep;

function report_orgstr() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/$_GET[mode].php");
$date=$ndate=date("Y-m-d");
$where="";
if ($_POST["begDate"]>"") {$date=$_POST["begDate"]; $Item["begDate"]=$_POST["begDate"];}
if ($_POST["endDate"]>"") {$ndate=$_POST["endDate"]; $Item["endDate"]=$_POST["endDate"];}
if (isset($_POST["urgent"]) AND !isset($_POST["planed"])) { $where.=" AND isUrgent = 1 "; }
if (isset($_POST["planed"]) AND !isset($_POST["urgent"])) { $where.=" AND isUrgent = 0 "; }
if (is_array($_POST["orgStr"])) {
	$where.=" AND (";
	foreach ($_POST["orgStr"] as $orgStr) { $where.=" c.orgStructure_id = $orgStr OR"; }
	$where=substr($where,0,-3).")";
}
if (is_array($_POST["actionType_id"])) {
	$where.=" AND (";
	foreach ($_POST["actionType_id"] as $atype) { $where.=" a.actionType_id = $atype OR"; }
	$where=substr($where,0,-3).")";
}
$SQL="SELECT a.id FROM Action as a INNER JOIN ActionType as b on a.ActionType_id=b.id INNER JOIN Person as c ON a.setPerson_id=c.id
	WHERE b.serviceType=4 
	AND ( (a.begDate BETWEEN '$date' AND '$ndate' ) OR ( a.plannedEndDate BETWEEN '$date' AND '$ndate' ) )
	$where ORDER BY a.id DESC ";

   //echo $SQL;
		$org=array();
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["count"]=1;
			if ($action["isUrgent"]==1) {$action["isUrgent"]="urgent";} else {$action["isUrgent"]="planed";}
			if (!isset($action["problem"])) $action["problem"]="";
			$counter++; $action["counter"]=$counter;
			if (!isset($_POST["problem"])) {$result[]=$action;} else {
					if ($action["problem"]>"") {$result[]=$action;}
			}
			if (!in_array($action["orgStr_id"],$org)) {$org[$action["orgStr_id"]]["oid"]=$action["orgStr_id"]; $org[$action["orgStr_id"]]["name"]=$action["orgStructure"];}
		}
		$Item["result"]=$result;
		$Item["org"]=$org;
$out=contentSetData($out,$Item);
// Сортируем строки
foreach(pq($doc)->find("table tr.action") as $otd) {
	$oid=pq($otd)->attr("oid");
	$urg=pq($otd)->attr("urg");
	$type=pq($otd)->attr("type");
	$line=pq($doc)->find("table div.".$urg."[oid=".$oid."]")->find("tr[type=".$type."]");
	if ($line->length() AND !isset($_POST["details"])) {
		$line->find("td.count")->html( $line->find("td.count")->html() + 1 );
		pq($otd)->remove();
	} else {
		pq($doc)->find("table div.".$urg."[oid=".$oid."]")->append($otd);
	}
}

// Считаем итоги
$total_urg=0; $total_pln=0;
foreach(pq($doc)->find("table div.otd") as $otd) {
	$urgent=0; $planed=0;
	foreach(pq($otd)->find("div.urgent")->find("tr > td.count") as $urg) {
		$urgent+=pq($urg)->text();
	}
	pq($otd)->find("div.urgent")->next("tr.total")->find("td.count")->html($urgent);
	foreach(pq($otd)->find("div.planed")->find("tr > td.count") as $pln) {
		$planed+=pq($pln)->text(); 
	}
	pq($otd)->find("div.planed")->next("tr.total")->find("td.count")->html($planed);
	pq($otd)->next("tr.total")->find("td.count")->html( $urgent + $planed);
	$total_urg+=$urgent; $total_pln+=$planed;
}
pq($doc)->find("table tr.total_urg")->find("td.count")->html($total_urg);
pq($doc)->find("table tr.total_pln")->find("td.count")->html($total_pln);
pq($doc)->find("table tr.total_otd")->find("td.count")->html($total_urg+$total_pln);

// Преобразуем формат
if (!isset($_POST["details"])) {pq($doc)->find("td.details")->remove();} else {
	pq($doc)->find("tr[type]")->find("td.count")->remove();
}
return $out;
}

function report_hirurg() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/$_GET[mode].php");
$date=$ndate=date("Y-m-d");
$where="";
if ($_POST["begDate"]>"") {$date=$_POST["begDate"]; $Item["begDate"]=$_POST["begDate"];}
if ($_POST["endDate"]>"") {$ndate=$_POST["endDate"]; $Item["endDate"]=$_POST["endDate"];}
if (isset($_POST["urgent"]) AND !isset($_POST["planed"])) { $where.=" AND isUrgent = 1 "; }
if (isset($_POST["planed"]) AND !isset($_POST["urgent"])) { $where.=" AND isUrgent = 0 "; }
if (is_array($_POST["person"])) {
	$where.=" AND (";
	foreach ($_POST["person"] as $person) { $where.=" a.person_id = $person OR"; }
	$where=substr($where,0,-3).")";
}
if (is_array($_POST["actionType_id"])) {
	$where.=" AND (";
	foreach ($_POST["actionType_id"] as $atype) { $where.=" a.actionType_id = $atype OR"; }
	$where=substr($where,0,-3).")";
}

$SQL="SELECT a.id FROM Action as a INNER JOIN ActionType as b on a.ActionType_id=b.id 
	WHERE b.serviceType=4 
	AND ( (a.begDate BETWEEN '$date' AND '$ndate' ) OR ( a.plannedEndDate BETWEEN '$date' AND '$ndate' ) )
	$where ORDER BY a.id DESC ";

		$org=array();
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["count"]=1;
			if ($action["isUrgent"]==1) {$action["isUrgent"]="urgent";} else {$action["isUrgent"]="planed";}
			if (!isset($action["problem"])) $action["problem"]="";
			$counter++; $action["counter"]=$counter;
			if (!isset($_POST["problem"])) {$result[]=$action;} else {
					if ($action["problem"]>"") {$result[]=$action;}
			}
			$Person=getPersonInfo($action["person_id"]);
			if (!in_array($action["person_id"],$org)) {$org[$action["person_id"]]["oid"]=$action["person_id"]; $org[$action["person_id"]]["name"]=$Person["person"];}
		}
		$Item["result"]=$result;
		$Item["org"]=$org;
$out=contentSetData($out,$Item);
// Сортируем строки
foreach(pq($doc)->find("table tr.action") as $otd) {
	$oid=pq($otd)->attr("oid");
	$urg=pq($otd)->attr("urg");
	$type=pq($otd)->attr("type");
	$line=pq($doc)->find("table div.".$urg."[oid=".$oid."]")->find("tr[type=".$type."]");
	if ($line->length() AND !isset($_POST["details"])) {
		$line->find("td.count")->html( $line->find("td.count")->html() + 1 );
		pq($otd)->remove();
	} else {
		pq($doc)->find("table div.".$urg."[oid=".$oid."]")->append($otd);
	}
}

// Считаем итоги
$total_urg=0; $total_pln=0;
foreach(pq($doc)->find("table div.otd") as $otd) {
	$urgent=0; $planed=0;
	foreach(pq($otd)->find("div.urgent")->find("tr > td.count") as $urg) {
		$urgent+=pq($urg)->text();
	}
	pq($otd)->find("div.urgent")->next("tr.total")->find("td.count")->html($urgent);
	foreach(pq($otd)->find("div.planed")->find("tr > td.count") as $pln) {
		$planed+=pq($pln)->text(); 
	}
	pq($otd)->find("div.planed")->next("tr.total")->find("td.count")->html($planed);
	pq($otd)->next("tr.total")->find("td.count")->html( $urgent + $planed);
	$total_urg+=$urgent; $total_pln+=$planed;
}
pq($doc)->find("table tr.total_urg")->find("td.count")->html($total_urg);
pq($doc)->find("table tr.total_pln")->find("td.count")->html($total_pln);
pq($doc)->find("table tr.total_otd")->find("td.count")->html($total_urg+$total_pln);

// Преобразуем формат
if (!isset($_POST["details"])) {pq($doc)->find("td.details")->remove();} else {
	pq($doc)->find("tr[type]")->find("td.count")->remove();
	pq($doc)->find("tr[type]")->find("td.person")->remove();
}
return $out;
}

function report_time() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/$_GET[mode].php");
$date=$ndate=date("Y-m-d");
$where="";
if ($_POST["begDate"]>"") {$date=$_POST["begDate"]; $Item["begDate"]=$_POST["begDate"];}
if ($_POST["endDate"]>"") {$ndate=$_POST["endDate"]; $Item["endDate"]=$_POST["endDate"];}
if (isset($_POST["urgent"]) AND !isset($_POST["planed"])) { $where.=" AND isUrgent = 1 "; }
if (isset($_POST["planed"]) AND !isset($_POST["urgent"])) { $where.=" AND isUrgent = 0 "; }
if (is_array($_POST["orgStr"])) {
	$where.=" AND (";
	foreach ($_POST["orgStr"] as $orgStr) { $where.=" c.orgStructure_id = $orgStr OR"; }
	$where=substr($where,0,-3).")";
}
if (is_array($_POST["actionType_id"])) {
	$where.=" AND (";
	foreach ($_POST["actionType_id"] as $atype) { $where.=" a.actionType_id = $atype OR"; }
	$where=substr($where,0,-3).")";
}
$SQL="SELECT a.id FROM Action as a INNER JOIN ActionType as b on a.ActionType_id=b.id 
	WHERE b.serviceType=4 
  AND a.status = 2
	AND ( a.begDate BETWEEN '$date' AND '$ndate' )
	$where ORDER BY a.id DESC ";

   //echo $SQL;
		$org=array();
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
      $_action=jdbReadItem("Action",$action["id"]);
			$action["count"]=1;
			if ($action["isUrgent"]==1) {$action["isUrgent"]="urgent";} else {$action["isUrgent"]="planed";}
			if (!isset($action["problem"])) $action["problem"]="";
      $t_filter=1;
      if ($_POST["begTime"]>"" AND $action["o_time"]<$_POST["begTime"]) {$t_filter=0;}
      if ($_POST["endTime"]>"" AND $action["o_time"]>$_POST["endTime"]) {$t_filter=0;}
			$counter++; $action["counter"]=$counter;
      if ($t_filter==1) {
			if (!isset($_POST["problem"])) {$result[]=$action;} else {
					if ($action["problem"]>"") {$result[]=$action;}
			}
      }
			if (!in_array($action["orgStr_id"],$org)) {$org[$action["orgStr_id"]]["oid"]=$action["orgStr_id"]; $org[$action["orgStr_id"]]["name"]=$action["orgStructure"];}
		}
		$Item["result"]=$result;
		$Item["org"]=$org;
$out=contentSetData($out,$Item);
// Сортируем строки
foreach(pq($doc)->find("table tr.action") as $otd) {
	$oid=pq($otd)->attr("oid");
	$urg=pq($otd)->attr("urg");
	$type=pq($otd)->attr("type");
	$line=pq($doc)->find("table div.".$urg."[oid=".$oid."]")->find("tr[type=".$type."]");
//	if ($line->length() AND !isset($_POST["details"])) {
//		$line->find("td.count")->html( $line->find("td.count")->html() + 1 );
//		pq($otd)->remove();
//	} else {
		pq($doc)->find("table div.".$urg."[oid=".$oid."]")->append($otd);
//	}
}

// Считаем итоги
$total_urg=0; $total_pln=0;
foreach(pq($doc)->find("table div.otd") as $otd) {
	$urgent=0; $planed=0;
	foreach(pq($otd)->find("div.urgent")->find("tr > td.count") as $urg) {
		$urgent+=pq($urg)->text();
	}
	pq($otd)->find("div.urgent")->next("tr.total")->find("td.count")->html($urgent);
	foreach(pq($otd)->find("div.planed")->find("tr > td.count") as $pln) {
		$planed+=pq($pln)->text(); 
	}
	pq($otd)->find("div.planed")->next("tr.total")->find("td.count")->html($planed);
	pq($otd)->next("tr.total")->find("td.count")->html( $urgent + $planed);
	$total_urg+=$urgent; $total_pln+=$planed;
}
pq($doc)->find("table tr.total_urg")->find("td.count")->html($total_urg);
pq($doc)->find("table tr.total_pln")->find("td.count")->html($total_pln);
pq($doc)->find("table tr.total_otd")->find("td.count")->html($total_urg+$total_pln);

// Преобразуем формат
//if (!isset($_POST["details"])) {pq($doc)->find("td.details")->remove();} else {
	pq($doc)->find("tr[type]")->find("td.count")->remove();
//}
return $out;
}


function spisanie_2() {
	return spisanie_1();
}
function spisanie_1() {
	$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
	$_action=jdbReadItem("Action",$_GET["action"]);
	$action=mysqlReadItem("Action",$_GET["action"]);
  $role=$_GET["role"]; if ($role=="") {$role="ob";}
	$Action=array_merge($action,$_action);
	$ActionType=mysqlReadItem("ActionType",$Action["actionType_id"]);
	$Event=mysqlReadItem("Event",$Action["event_id"]);
	$Client=mysqlReadItem("Client",$Event["client_id"]);
	$Action["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
	$Action["externalId"]=$Event["externalId"];
	$Action["operation"]=$ActionType["title"];
	$Action["opertime"]=date("H:i:s",strtotime($Action["endDate"])-strtotime($Action["begDate"]));
	$Spisanie=mysqlReadItem("StockMotion",$Action["spisanie_$role"]);
  $spisanie=json_decode(getSpisanieItems($Action["spisanie_$role"]),true);
	$SQL="SELECT * FROM StockMotion_Item
    WHERE master_id = ".$Spisanie["id"];
  if ($role=="ob") {$drugslist=getDrugs();} else {$drugslist=getDrugs("043000046");}
	$result = mysql_query($SQL) or die("Query failed: (spisanie_1()) " . mysql_error());
	$count=0; $Action["totalPrice"]=0;
	foreach($spisanie as $drugs) {
      $drug_id=druglistSearchId($drugslist,$drugs["nomenclature_id"]);
			$count++; $drugs["count"]=$count;
			//$rbDrug=drugReadItem("rbDrug",$drugs["nomenclature_id"]);
			//$rbServ=ServiceSpecDrug($rbDrug["code"]) ;
			//$drugs["price"]=number_format($rbServ["price"], 2, '.', '');
			$Action["totalPrice"]+=$drugs["price"];
      
			$drugs["drugName"]=$drugslist[$drug_id]["drugName"];
			$drugs["unitName"]=$drugslist[$drug_id]["unitName"];
      if ($drugs["qnt"]!=0) {	$Action["drugs"][]=$drugs; }
      
	}
  mysql_free_result($result);
	$out=contentSetData($out,$Action);
  if ($role=="an") pq($out)->find("h2:eq(1)")->html("Анестезия");
	return $out->htmlOuter();
}

function druglistSearchId($drugslist,$nomenclature_id) {
$res="";
foreach($drugslist as $key => $data) {
  if ($data["drugId"]==$nomenclature_id) {$res=$key;}
}
return $res;
};

function protocol() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$action=getActionInfo($_GET["action"]);
$Operation=jdbReadItem("Operation",$_GET["action"]);
if ($Operation["result"]==0) {$Operation["result"]="смерть";} else {$Operation["result"]="выписка";} 
foreach($Operation as $key => $val) {
	$action["o_$key"]=$val;
}
$begTime=strtotime($action["begDate"]." ".$action["o_begTime"]);
$endTime=strtotime($action["o_endDate"]);
$action["o_endTime"]=date("H:i",$endTime); 
$action["o_time"]= date("H:i", mktime(0, 0, ($endTime-$begTime)));
$action["o_protocol"]=nl2br($action["o_protocol"]);
$out=contentSetData($out,$action);
return $out->htmlOuter();
}

function histology() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$_action=jdbReadItem("Action",$_GET["action"]);
$action=mysqlReadItem("Action",$_GET["action"]);
$action=array_merge($action,$_action);
$action["docDate"]=date("Y-m-d ");
$ActionType=mysqlReadItem("ActionType",$action["actionType_id"]);
$Event=mysqlReadItem("Event",$action["event_id"]);
$Client=mysqlReadItem("Client",$Event["client_id"]);
$Person=mysqlReadItem("Person",$action["setPerson_id"]);
$Diag=file_get_contents("http://".$_SERVER['HTTP_HOST']."/json/operation.php?mode=get_diagnoses&event_id=".$action["event_id"]); 
$Diag=json_decode($Diag,true);
$action["diagnose"]=$Diag["clinic"]["MKB"]." ".$Diag["clinic"]["DiagName"];
if ($action["diagnose"]==" ") {$action["diagnose"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];}
$action["age"]=floor((time()-strtotime($Client["birthDate"]))/31536000);
$action["sex"]=$Client["sex"]; 	
if ($action["sex"]==1) {$action["sex"]="мужской";} else {$action["sex"]="женский";} 
$action["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
$action["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
$action["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
if ($action["transfusiton_req"]==1) {$action["transfusiton_req"]="требуется";} else {$action["transfusiton_req"]="не требуется";}
$action["externalId"]=$Event["externalId"];
$action["doc_date"]=currentDocDate();
$action["operation"]=$ActionType["title"];
$action["orgStructure"]=getOrgStrName($Person["orgStructure_id"]); 
$action["orgStrBoss"]=json_decode(getOrgStrBossName(),true)["fullName"];
foreach ($action["histology"] as $key => $data) {
	$data=nl2br($data);
	$action[$key]=$data;
}
$out=contentSetData($out,$action);
if ($action["fld_1"]>"") {
	$out->find("span#first")->remove();
} else { $out->find("span#second")->remove(); }
return $out->htmlOuter();
}

function imuno() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$_action=jdbReadItem("Action",$_GET["action"]);
$action=mysqlReadItem("Action",$_GET["action"]);
$action=array_merge($action,$_action);
$action["docDate"]=date("Y-m-d ");
$ActionType=mysqlReadItem("ActionType",$action["actionType_id"]);
$Event=mysqlReadItem("Event",$action["event_id"]);
$Client=mysqlReadItem("Client",$Event["client_id"]);
$Person=mysqlReadItem("Person",$action["setPerson_id"]);
$Diag=file_get_contents("http://".$_SERVER['HTTP_HOST']."/json/operation.php?mode=get_diagnoses&event_id=".$action["event_id"]); 
$Diag=json_decode($Diag,true);
$action["diagnose"]=$Diag["clinic"]["MKB"]." ".$Diag["clinic"]["DiagName"];
if ($action["diagnose"]==" ") {$action["diagnose"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];}
$action["age"]=floor((time()-strtotime($Client["birthDate"]))/31536000);
$action["sex"]=$Client["sex"]; 	
if ($action["sex"]==1) {$action["sex"]="мужской";} else {$action["sex"]="женский";} 
$action["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
$action["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
$action["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
if ($action["transfusiton_req"]==1) {$action["transfusiton_req"]="требуется";} else {$action["transfusiton_req"]="не требуется";}
$action["externalId"]=$Event["externalId"];
$action["doc_date"]=currentDocDate();
$action["operation"]=$ActionType["title"];
$action["orgStructure"]=getOrgStrName($Person["orgStructure_id"]); 
$action["orgStrBoss"]=json_decode(getOrgStrBossName(),true)["fullName"];
foreach ($action["imuno"] as $key => $data) {
	$data=nl2br($data);
	$action[$key]=$data;
}
$out=contentSetData($out,$action);
if ($action["fld_1"]>"") {
	$out->find("span#first")->remove();
} else { $out->find("span#second")->remove(); }
return $out->htmlOuter();
}


function citology() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$_action=jdbReadItem("Action",$_GET["action"]);
$action=mysqlReadItem("Action",$_GET["action"]);
$action=array_merge($action,$_action);
$action["docDate"]=date("Y-m-d ");
$ActionType=mysqlReadItem("ActionType",$action["actionType_id"]);
$Event=mysqlReadItem("Event",$action["event_id"]);
$Client=mysqlReadItem("Client",$Event["client_id"]);
$Person=mysqlReadItem("Person",$action["setPerson_id"]);
$Diag=file_get_contents("http://".$_SERVER['HTTP_HOST']."/json/operation.php?mode=get_diagnoses&event_id=".$action["event_id"]); 
$Diag=json_decode($Diag,true);
$action["diagnose"]=$Diag["clinic"]["MKB"]." ".$Diag["clinic"]["DiagName"];
if ($action["diagnose"]==" ") {$action["diagnose"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];}
$action["age"]=floor((time()-strtotime($Client["birthDate"]))/31536000);
$action["sex"]=$Client["sex"]; 	
if ($action["sex"]==1) {$action["sex"]="мужской";} else {$action["sex"]="женский";} 
$action["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
$action["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
$action["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
if ($action["transfusiton_req"]==1) {$action["transfusiton_req"]="требуется";} else {$action["transfusiton_req"]="не требуется";}
$action["externalId"]=$Event["externalId"];
$action["doc_date"]=currentDocDate();
$action["operation"]=$ActionType["title"];
$action["orgStructure"]=getOrgStrName($Person["orgStructure_id"]); 
$action["orgStrBoss"]=json_decode(getOrgStrBossName(),true)["fullName"];
foreach ($action["citology"] as $key => $data) {
	$data=nl2br($data);
	$action[$key]=$data;
}
if ($action["fld_4"]<" ") {	$action["fld_4"]=$action["orgStructure"];}
$out=contentSetData($out,$action);
if ($action["fld_1"]>"")	  {$out->find("span#first")->remove();
				} else {$out->find("span#second")->remove(); } 
return $out->htmlOuter();
}


function sister() {
	$_SESSION["orgStrId"]=$_GET["sid"]; 
	$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
	if (isset($_GET["date"])) {$date=date("Y-m-d",strtotime($_GET["date"]));} else {	$date = date("Y-m-d");	}
	if ($_GET["enddate"]>"") {$ndate=date("Y-m-d",strtotime($_GET["enddate"]));} else {$ndate=date("Y-m-d",strtotime($date)+86400);}
	$Item["date"]=$date." - ".$ndate;
	$Item["name"]=getOrgStrName($_GET["sid"]);
	if ($_GET["var"]==2) { $ndate=$date; $Item["date"]=$date;}
	if ($_GET["var"]==3) { $date=$ndate; $Item["date"]=$date;}
	$counter=1;
	$SQL="SELECT * FROM Action as a 
  INNER JOIN ActionType as b on a.ActionType_id=b.id
  INNER JOIN Person as c ON a.setPerson_id=c.id
  WHERE b.serviceType=4 
  AND c.orgStructure_id= $_SESSION[orgStrId]
 AND ( (a.begDate BETWEEN '$date' AND '$ndate' ) 
  OR 
  ( a.plannedEndDate BETWEEN '$date' AND '$ndate' ) )
   ORDER BY a.id DESC ";
		$res = mysql_query($SQL) or die("Query failed: " . mysql_error()); 
		while($a = mysql_fetch_array($res)) {
			$action["id"]=$a[0];
			$action=getActionInfo($action["id"]);
			$action["counter"]=$counter; 
			if ($_GET["filter"]>"") {
				if ($action["status"]==$_GET["filter"]) {$result[]=$action; $counter++;}
			} else { $result[]=$action; $counter++;} 
		}
	$result=array_sort($result,"index");
	$Item["result"]=$result;
	$out=contentSetData($out,$Item); 
	return $out->htmlOuter();
} 

function opertable() {
	$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
	$data=array(); $notes=array(); $count=1; $nCount=1;
	foreach($_GET["aid"] as $key => $action_id) {
		$action=getActionInfo($action_id);
		$action["count"]=$count;
		$Client=$action["_Client"]; 
		$data["otdelenie"]=mysqlReadItem("OrgStructure",$_GET["orgStr_id"])["name"]; 
		$data["doc_date"]=date('d.m.Y',strtotime($_GET["date"]));
		$data["oper_sister"]=$action["oper_sister"]; 
		$data["anest"]=$action["anest"];
		if ($action["note"]>"") { 
			$notes[$nCount]["count"]=$nCount; 
			$notes[$nCount]["client"]=$Client["lastName"]." ".substr($Client["firstName"],0,2).".".substr($Client["patrName"],0,2).".";
			$notes[$nCount]["note"]=$action["note"];
			$nCount++;
		}
		$data["actions"][]=$action;
		$count++;
	}
	$data["actions"]=array_sort($data["actions"],"index");
	$data["table"]=$_GET["tid"];
	$data["orgStrBoss"]=json_decode(getOrgStrBossName($_GET["orgStr_id"]),true)["fullName"]; 
	$data["notes"]=$notes;
	$data["zamglav"]=getZamglavName();
	$out=contentSetData($out,$data);
	foreach(pq($out)->find("span.person") as $pers) {
		if (preg_match("{{.*}}", pq($pers)->html()) OR pq($pers)->text()==" ..") {
			pq($pers)->parent("div")->addclass("ui-hidden");
		}
	}
	return $out->htmlOuter();
}

function oproom() {
	$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
	$data=array(); $notes=array(); $count=1; $nCount=1;
	foreach($_GET["aid"] as $key => $action_id) {
		$action=getActionInfo($action_id);
		$action["count"]=$count;
		$ActionType=mysqlReadItem("ActionType",$action["actionType_id"]);
		$Event=mysqlReadItem("Event",$action["event_id"]);
		$Client=$action["_Client"];
		$brigada=""; $i=0;
		foreach($action["assist_id"] as $assist_id) {
			$assist=mysqlReadItem("Person",$assist_id);
			$brigada[$i]=$assist["lastName"]." ".substr($assist["firstName"],0,2).".".substr($assist["patrName"],0,2).".";;
			$i++;
		}
		$action["brigada"]=implode("<br />",$brigada);
		if ($action["assist_name"]>"") $brigada[]=$action["assist_name"];
		if (!isset($action["hemotrans"])) {$action["hemotrans"]="";}
		$action["dejurny"]=$action["dejur"];
		$action["table"]=$action["tableName"];
		$data["otdelenie"]=mysqlReadItem("OrgStructure",$_GET["orgStr_id"])["name"];
		$data["actions"][]=$action;
		$data["doc_date"]=currentDocDate($_GET["date"]); 
		$data["table"]=$action["table"];
		if ($action["note"]>"") {
			$notes[$nCount]["count"]=$nCount; 
			$notes[$nCount]["client"]=$Client["lastName"]." ".substr($Client["firstName"],0,2).".".substr($Client["patrName"],0,2).".";
			$notes[$nCount]["note"]=$action["note"];
			$nCount++;
		}
		$count++;
	}
	if (isset($_GET["orgStr_id"])) $data["orgStrBoss"]=json_decode(getOrgStrBossName($_GET["orgStr_id"]),true)["fullName"];
	$data["oper_sister"]=$action["oper_sister"];
	$data["anest"]=$action["anest"];
	$data["anest_sister"]=$action["anest_sister"];
	$data["notes"]=$notes;
	$data["oper"]=$_GET["oper"];
	$out=contentSetData($out,$data);
	foreach(pq($out)->find("span.person") as $pers) {
		if (preg_match("{{.*}}", pq($pers)->html()) OR pq($pers)->text()==" ..") {
			pq($pers)->parent("div")->addclass("ui-hidden");
		}
	}
	return $out->htmlOuter();
}

function morfoNazn() {
include_once($_SERVER['DOCUMENT_ROOT']."/forms/morfoNazn.php");
$_action=mysqlReadItem("Action",$_GET["action"]);
$action=getActionInfo($_GET["action"]);
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$form=morfoNaznForm($action["actionType_id"]);
$action=getActionPropertyFormData($action,$form);
$action["sex"]=$action["_Client"]["sex"];
$action["actionTypeName"]=$action["_ActionType"]["name"];
$action["docDate"]=currentDocDate();
$out=contentSetData($out,$action);
if ($action["fld_1"]>"") {
	$out->find("span#first")->remove();
} else { $out->find("span#second")->remove(); }
$Lab=morfoReadLabAction($action["id"]);
if ($Lab["status"]==2 AND $Lab["fld_12"]>"") {
	$action["number"]=$Lab["fld_12"];
} else {
	$out->find("div.result")->remove();
	$out->find("b.number")->remove();
}
$out=contentSetData($out,$action);
return $out->htmlOuter();
}

function morfoReg() {
include_once($_SERVER['DOCUMENT_ROOT']."/forms/morfoReg.php");
$_action=mysqlReadItem("Action",$_GET["action"]);
$action=getActionInfo($_GET["action"]);
$person=getPersonInfo($action["setPerson_id"]);
$action["person"]=$person["personShort"];
$actionType_id=getActionTypeByName("Регистрация биоматериала");
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$form=morfoRegForm($actionType_id);
$Reg=morfoReadReg($action["id"]);
$Reg=getActionPropertyFormData($Reg,$form);
foreach($Reg as $key => $val) {$action[$key]=$val;}
foreach($form as $key => $val) {
	$field=array();
	$field["label"]=$val["label"];
	$field["value"]=$action[$val["name"]];
	$action["fields"][]=$field;
}
$action["sex"]=$action["_Client"]["sex"];
$action["actionTypeName"]=$action["_ActionType"]["name"];
$action["docDate"]=currentDocDate();
$out=contentSetData($out,$action);
if ($action["fld_1"]>"") {
	$out->find("span#first")->remove();
} else { $out->find("span#second")->remove(); }
if ($_action["status"]==2) {

} else {
	$out->find("div.result")->remove();
}
return $out->htmlOuter();
}


function epicriz() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$_action=jdbReadItem("Action",$_GET["action"]);
$action=mysqlReadItem("Action",$_GET["action"]);
$Action=array_merge($action,$_action);
$ActionType=mysqlReadItem("ActionType",$Action["actionType_id"]);
$Event=mysqlReadItem("Event",$Action["event_id"]);
$Client=mysqlReadItem("Client",$Event["client_id"]);
$Person=mysqlReadItem("Person",$Action["setPerson_id"]);
$Item["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
$Action["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
$Action["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
if ($Action["transfusiton_req"]==1) {$Action["transfusiton_req"]="требуется";} else {$Action["transfusiton_req"]="не требуется";}
$Action["externalId"]=$Event["externalId"];
$Action["doc_date"]=currentDocDate();
$Action["operation"]=$ActionType["title"];
$Action["orgStrBoss"]=json_decode(getOrgStrBossName($Person[orgStructure_id]),true)["fullName"];
foreach($_action["epicriz"] as $key => $val) {$Action[$key]=$val; }
foreach ($Action as $key => $data) {
	$data=nl2br($data);
	$Action[$key]=$data;
}
$out=contentSetData($out,$Action);
return $out->htmlOuter();
}

function invasion() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$Action=mysqlReadItem("Action",$_GET["action"]);
$ActionType=mysqlReadItem("ActionType",$Action["actionType_id"]);
$Event=mysqlReadItem("Event",$Action["event_id"]);
$Client=mysqlReadItem("Client",$Event["client_id"]);
$Person=mysqlReadItem("Person",$Action["person_id"]);
$Item["client"]=$Client["lastName"]." ".$Client["firstName"]." ".$Client["patrName"];
$Item["person"]=$Person["lastName"]." ".$Person["firstName"]." ".$Person["patrName"];
$Item["personShort"]=$Person["lastName"]." ".substr($Person["firstName"],0,2).".".substr($Person["patrName"],0,2).".";
$Item["doc_date"]=currentDocDate();
$Item["operation"]=$ActionType["title"];
$out=contentSetData($out,$Item);
return $out->htmlOuter();
}

function hemotrans() {
$out=file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/print_$_GET[mode].php");
$Item=getActionInfo($_GET["action"]);
$out=contentSetData($out,$Item);
return $out->htmlOuter();
}



function currentDocDate($date="") {
if ($date>"") {$date=strtotime($date);} else {$date=time();}
$month_arr = array( 1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря' );
$day   = date( 'j',$date );
$month = $month_arr[ date( 'n',$date ) ];
$year  = date( 'Y',$date);
$true_date = "$day $month $year ";
return $true_date;
}

?>
