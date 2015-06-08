<?
include_once($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();

function sisterDataType() { return "mysql"; }

function sister_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
if (isset($_COOKIE["workDate"])) {$Item["date1"]=$_COOKIE["workDate"];} else {$Item["date1"]=date("Y-m-d ");}
if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"") {
  $Item["date2"]=$_COOKIE["endDate"];
  $Item["endDate"]=$Item["date2"];
} else {$Item["date2"]=date("Y-m-d",strtotime($Item["date1"])); }

$Item["result"]=sisterListDays($Item["date1"],$Item["date2"]);
$Item["result1"]=sisterListItems();
$Item["workDate"]=$Item["date1"];
$Item["orgStr_id"]=$_SESSION["orgStrId"];
$Item["person_id"]=$_SESSION["person_id"];
$out=contentSetData($out,$Item);
// ========= Создаём операционные и столы ==========
foreach($Item["result"] as $k1 => $line) {
	$tables=phpQuery::newDocument("");
	$optab=array(); $optab=getOpTables($optab,$line["date"]); $optab=$optab["optables"];
	foreach($line["opr"] as $k2 => $val) {
		foreach($val as $k3 => $oper) {
			$orgStrName=getOrgStrName($oper);
			pq($tables)->append("<div opr='$oper' class='ui-body-d ui-content' data-role='content'><div data-role='header'><h2>{$orgStrName}</h2></div></div>");
			foreach($optab as $k4 => $table) {
				$tid=$table["tid"]; $opr=$table["opr"];	$oid=$table["oid"];	$name=str_replace("<br />"," - ",$table["name"]);
				if ($opr==$oper) {
					pq($tables)->find("div[opr={$oper}]")->append("<div data-role='content' oid='{$oid}' tid='{$tid}'><div data-role='header' class='ui-corner-top'><h3>{$name}</h3></div></div>");
				}
			}
		}
	}
	pq($out)->find("#".$line["date"])->append(pq($tables)->htmlOuter());
	pq($out)->find("#".$line["date"])->append("<div oid='free' class='ui-body-d ui-content' data-role='content'><div data-role='header'><h2>Не распределены</h2></div></div>");
}

// ========= Разносим операции по операционным и столам =========
foreach(pq($out)->find("#clientlist tbody tr") as $line) {
	$date=pq($line)->attr("date");
	$tid=pq($line)->attr("tid");
	$oid=pq($line)->attr("oid");
	if (!is_numeric($tid)) {pq($line)->attr("tid","");}
	if (!is_numeric($oid)) {pq($line)->attr("oid","");}
	$orgstr=pq($line)->attr("orgstr");
//	if (!is_numeric($oid) AND $orgstr==$_SESSION["orgStrId"]) {$oid=$orgstr;}
	$div=pq($out)->find("#".$date)->find("div[oid={$oid}][tid={$tid}]");
	if (pq($div)->find("table")->length()==0) {
		pq($div)->append("<table data-role='table' class='ui-responsive'><thead></thead><tbody></tbody></table>");
		pq($div)->find("table thead")->append(pq($out)->find("#clientlist thead")->html());
	}
	if ($oid==$_SESSION["orgStrId"] OR  is_numeric($oid))  {
		pq($div)->find("table tbody")->append($line);
	}
	if (!is_numeric($oid) AND $orgstr==$_SESSION["orgStrId"]) {
		$free=pq($out)->find("#".$date)->find("div[oid=free]");
		if (pq($free)->find("table")->length()==0) {
			pq($free)->append("<table data-role='table' class='ui-responsive'><thead></thead><tbody></tbody></table>");
			pq($free)->find("table thead")->append(pq($out)->find("#clientlist thead")->html());
		}
		pq($free)->find("table tbody")->append($line);
	}
}
pq($out)->find("#clientlist")->remove();

foreach(pq($out)->find("div[tid!=".$_SESSION["orgStrId"]."]") as $div) {
	if (pq($div)->find("tr[orgstr=".$_SESSION["orgStrId"]."]")->length()==0) {pq($div)->remove();}
}


// ========= удаляем пустые столы =========
foreach(pq($out)->find("div[oid][tid],div[oid=free]") as $line) {
	if (pq($line)->find("div[data-role=header]")->next("table")->find("tbody tr")->length()==0) {pq($line)->remove();}
}
// ========= удаляем пустые операционные =========
foreach(pq($out)->find("div[opr]") as $line) {
	if (pq($line)->find("div[data-role=header]")->next("div[oid][tid]")->length()==0) {pq($line)->remove();}
}
// ========= удаляем пустые дни =========
foreach(pq($out)->find("div.day") as $line) {
	if (pq($line)->find("div[data-role=header]")->next("div")->length()==0) {pq($line)->remove();}
}

foreach(pq($out)->find("table tbody") as $table) {
	$i=0;
	foreach(pq($table)->find("tr") as $tr) {
		$i++; pq($tr)->find("td:first")->html($i);
	}
}



if ($Item["endDate"]>"") {pq($out)->find("a[href=#print_menu]")->addClass("ui-hidden"); pq($out)->find("a.print_all")->removeClass("ui-hidden"); }
return $out->htmlOuter();
}

function sisterListDays($date1,$date2) {
	$list=array();
	for ($i=strtotime($date1); $i<=strtotime($date2); $i=$i+86400) {
		$day=array();
		$day["date"]=date("Y-m-d",$i);
		$day["day"]=dmyDate(date("Y-m-d",$i));
		$day["opr"]=sisterListOprooms(date("Y-m-d",$i));
		$list[]=$day;
	}
	return $list;
}

function sisterListOprooms($day) {
		$oprooms=jdbReadItem("opRooms",$day);
		$opr=array();
		foreach($oprooms["approve"] as $key => $val) {
			if ($val==1 AND is_numeric($key)) {	$opr["opr"][]=$key; }
		}
	return $opr;
}	
	
function sisterListItems() {	
		$SETTINGS=$_SESSION['settings'];
	if (isset($_COOKIE["workDate"])) {$date=$_COOKIE["workDate"];} else {$date=date("Y-m-d ");}
	if (isset($_COOKIE["endDate"]) AND $_COOKIE["endDate"]>"") {$ndate=date("Y-m-d",strtotime($_COOKIE["endDate"]));} else {$ndate=date("Y-m-d"); }
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

	$SQL="SELECT * FROM Action as a 
  INNER JOIN ActionType as b on a.ActionType_id=b.id
  INNER JOIN Person as c ON a.setPerson_id=c.id
  WHERE b.serviceType=4 
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
			$action["begDate"]=$action["begDate"];
			$counter++; $action["counter"]=$counter;
			$result[]=$action;
		}
	return $result;
}

?>
