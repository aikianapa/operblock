<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Врач");
function epicrizOut_edit($form,$mode,$id,$datatype) {

	$event=mysqlReadItem("Event",$id);

	$eventStart = strtotime($event['createDatetime']);
	$uploadData = strtotime('2015-08-18');
	if ($eventStart < $uploadData ) {
		return epicrizOut_edit_old($form,$mode,$id,$datatype);
	}

	print_r($event);
	parse_str($_SERVER["REQUEST_URI"]);
	$tpl=array();
	$tpl[]=array(array("КО (ОНК) РСЦ","2 КО РСЦ"),"Cord",$type);
	$tpl[]=array(array("1 НО ОНМК РСЦ"),"Nevr",$type);
	$tpl[]=array(array("ОСХ РСЦ"),"Ocx",$type);
	$tpl[]=array(array("ОАР ОНМК"),"Oar",$type);
	$_SESSION["epic_tpl"]=$tpl;
	$_SESSION["epic_type"]=$type;
	switch($type) {
		case "out":		$name="DoctorRoom: Выписной эпикриз"; $docType="ВЫПИСНОЙ"; break;
		case "etap":	$name="DoctorRoom: Этапный эпикриз"; $docType="ЭТАПНЫЙ"; break;
		case "move":	$name="DoctorRoom: Переводной эпикриз"; $docType="ПЕРЕВОДНОЙ"; break;
		case "dead":	$name="DoctorRoom: Посмертный эпикриз"; $docType="ПОСМЕРТНЫЙ"; break;
		default:		$name="DoctorRoom: Выписной эпикриз"; $docType="ВЫПИСНОЙ"; break;
	}
	$_SESSION["epic_atid"]=getActionTypeByName($name);
	if ($id!="_new" AND $id!="" AND $_SESSION["epic_atid"]>"") {
	// print_r('actionout');
	$action=getEpicrizOut($id);
	// print_r($action);
	if (isset($action["id"])) {
		// $Item=array_merge($Item,$action);
		foreach($action["epic_out"] as $key => $val) {
			if (substr($key,0,2)=="e_") {
				$Item[$key]=$val;
			} 
		}
		$Item["fields"]=$action["epic_out"];
		$Item["action_id"]=$action["id"];
	} else {
		$field=array();
		$Item["action_id"]="_new";
		$field[0]["val"]=""; $field[0]["fld"]="Полный диагноз, сопутствующее осложнение";
		$field[1]["val"]=""; $field[1]["fld"]="Краткий анамнез, диагностические исследования, течение болезни";
		$field[2]["val"]=""; $field[2]["fld"]="Лечебные и трудовые рекомендации";
		$Item["fields"]=$field;
	}

if ($_SESSION["settings"]["appId"]=="msk36") {
	$flds=array("e_pulm_in","e_pulmFreq_in","e_corTone_in","e_corFreq","e_corPress_in","a_date1","a_date2","s_date1","s_date2");
	foreach($flds as $key =>$fld) {if (!isset($Item[$fld])) {$Item[$fld]="";}}
	$Item["Drugs"]=drugsPrepare(json_decode(file_get_contents($getAssignList_url."assignlist/data?event_id=".$id),true));
	$statMoving=getStationarMovings($id);
	$Item["moving"]=$statMoving["data"]["moving"];
	$Item["lab"]=epicLabPrep($id,"Лабораторные исследования");
	$Item["res"]=epicLabPrep($id,"Инструментальная диагностика");
	$Item["cons"]=epicConsPrep($id);
}
}	

	$json_query_SQL="SELECT * FROM Action AS a 
	INNER JOIN JsonData as jd on jd.id = concat('Action@',a.id)
	WHERE a.actionType_id = 26618 
	AND a.deleted = 0 
	AND a.event_id = ".$id." 
	LIMIT 1";
	// $res=mysql_query($SQL) or die ("Query failed getEpicrizOut(): " . mysql_error());

$event=mysqlReadItem("Event",$id);
	$Item["execPerson_id"]=$event["execPerson_id"];
	// $Diag=patientGetDiagnosis($id);
	$person=getPersonInfo($person_id);
	$doctor=getPersonInfo($event["execPerson_id"]);
	$client=getClientInfo($event["client_id"]);
	$organisation=mysqlReadItem("Organisation",$person["org_id"]);
	$orgstructure=mysqlReadItem("OrgStructure",$doctor["orgStructure_id"]);
	$Item["dateShort"]=date("d.m.y");
	if (empty($orgstructure)) {

		$orgStrId_query = "SELECT ap_os.value
                                    FROM Action AS current
                                    INNER JOIN ActionProperty AS ap ON (ap.action_id = current.id)
                                    INNER JOIN ActionPropertyType AS apt ON (apt.id = ap.type_id AND name='Отделение пребывания')
                                    INNER JOIN ActionProperty_OrgStructure AS ap_os ON (ap_os.id = ap.id)
                                    INNER JOIN Event as ev on current.event_id = ev.id
                                  
                                    where ap.deleted=0 and ev.id = {$id} ORDER BY current.id DESC LIMIT 1";

		$result = mysql_query($orgStrId_query) or die ("Query failed epicrizOut.php: " . mysql_error());
		$orgStr_id = mysql_result($result, 0);
		$orgstructure=mysqlReadItem("OrgStructure",$orgStr_id);
		echo 'doctor1
		 '. $orgStr_id;
	}
	$Item["OrgStrCode"]=$orgstructure["code"];
	$Item["externalId"]=$event["externalId"];
	$Item["OrgName"]=$organisation["title"];
	$Item["OrgAddr"]=$organisation["Address"];
	$Item["OrgPhone"]=$organisation["phone"];
	$Item["event_id"]=$id;
	$Item["org"]=$organisation["shortName"];
	$Item["orgStr"]=$person["orgStructure"];
	$Item["person"]=$person["personShort"];
	$Item["person_id"]=$person_id;
	$Item["person"]=$person["personShort"];
	$Item["doctor_id"]=$event["execPerson_id"];
	$Item["doctor"]=$person["doctorShort"];
	$Item["client"]=$client["client"];
	$Item["bDate"]=getRusDate($client["birthDate"])."г.";
	$Item["address"]=$client["addressLive"];
	$Item["work"]=$client["work"];
	$Item["setDate"]=date("m.d.Y 00:00:00",strtotime($event["setDate"]));
	$Item["docType"]=$docType;
	$Item["diag_main"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];
	$Item['client_adress'] = $client['addressLive'];
	//	$Item["diag_satt"]=$Diag["satt"]["MKB"]." ".$Diag["satt"]["DiagName"];
	//	$Item["diag_tera"]=$Diag["terapevt"]["MKB"]." ".$Diag["terapevt"]["DiagName"];
	if ($client["sex"]=="мужской") {$Item["suffix1"]="ся";$Item["suffix2"]="";$Item["suffix3"]="";} else {$Item["suffix1"]="ась";$Item["suffix2"]="а";$Item["suffix3"]="ка";}
	$Item["age"]=$client["age"];

	$Item["s_date1"]=getRusDate($event["setDate"])."г.";
	if ($action["endDate"]>"") {
		$Item["s_date2"]=getRusDate($action["endDate"])."г.";
	} else {
		$Item["s_date2"]=getRusDate(date("Y-m-d"))."г.";
		$Item["endDate"]=date("d.m.Y");
	}
		$Item["docDate"]=$Item["s_date2"];
	$Item["orgStrBoss"]=getPersonInfo($orgstructure["chief_id"]); $Item["orgStrBoss"]=$Item["orgStrBoss"]["personShort"];
// $Item["e_diag_in"] = print_r($action, true);
	
	
			if ($_SESSION["settings"]["appId"]=="msk36") {
			// =========================================================	
			// ========= привязываем шаблоны к кодам отделений =========	
			// =========================================================
				foreach($tpl as $key => $arr) {

					if (in_array($Item["OrgStrCode"],$arr[0])) {
						if (false) {
							$path = $_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz_".$arr[1]."_".$arr[2].".php";
						} else {
							$path = $_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz_Cord1.php";
						}
						$out=phpQuery::newDocumentFile($path);
					}
				}

			// ========= по-умолчанию простой эпикриз =========	
			if ($out=="") {$out=phpQuery::newDocumentFile($_SERVER['DOCUMENT_ROOT']."/forms/epicrizOut_edit.php");}
			pq($out)->append("<style>".file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz.css")."</style>");
			if ($_SESSION["epic_atid"]=="") { 
				pq($out)->find("form")->html("Необходимо создать ActionType - {$name}"); 
			}
			} else {
				$out=formGetForm($form,$mode);
			}
				
// 	print_r('I wanna crack the code');
// print_r($Item);
	// print_r(fields_msk36($id,$Item["OrgStrCode"]));

	if ($_SESSION["settings"]["appId"]=="msk36") {
		if ($Item["action_id"]=="_new") {
			$Item=array_merge($Item,fields_msk36($id,$Item["OrgStrCode"]));

		} else {
			$Item=array_merge(fields_msk36($id,$Item["OrgStrCode"]),$Item);
		}
	}
$Item['RW'] = $Item['firstView']['RW'];
$Item['rendgetnographia_organov_grudnoy_kletki'] = $Item['firstView']['Рентгенография органов грудной клетки'];
// $Item["e_diag_in"]=print_r($Item, true);
pq($out)->find("form")->prepend("<input type='hidden' name='actionType_id' value='{$_SESSION["epic_atid"]}'>");

$i=0; foreach(pq($out)->find("[name=e_recom_sel] option") as $recom) {
	if (pq($recom)->html()==$Item["e_recom_sel"]) {
		pq($out)->find(".recom_tab > li:eq({$i}) textarea")->attr("name","e_recom_text");
	}
	$i++;
}

foreach(pq($out)->find("input,select,textarea") as $inp) {
	if (!isset($Item[pq($inp)->attr("name")])) {$Item[pq($inp)->attr("name")]="";} else {
		if (pq($inp)->is("textarea")) {pq($inp)->html($Item[pq($inp)->attr("name")]);}
	}
}

foreach(pq($out)->find("select option.add") as $add) {
	$add_name=pq($add)->parent("select")->attr("name")."_add";
	if (!pq($add)->parent("select")->next("input.addinf")->length()) {
		pq($add)->parent("select")->after("<input name='{$add_name}' class='addinf'>");
	}
}
$out=contentSetData($out,$Item);
foreach($out->find("select option") as $opt) {
	// устанавливаем option в соответствии с select.value
	if (pq($opt)->parent("select")->attr("value")==pq($opt)->text()) {pq($opt)->attr("selected","selected");}
}

foreach($out->find("select[multiple] option") as $opt) {
	// устанавливаем option для multiple select
	$selname=pq($opt)->parent("select")->attr("name");$selname=substr($selname,0,-2);

	if (in_array(strtolower(pq($opt)->text()),array_map('mb_strtolower', $Item[$selname]))) {pq($opt)->attr("set","set");}
}


foreach(pq($out)->find("textarea[placeholder]") as $inp) {
	// устанавливаем знечение placeholder для пустых текстов
	if (pq($inp)->html()=="") {	pq($inp)->html(pq($inp)->attr("placeholder")); }
}

if ($mode=="print") {
	pq($out)->html(pq($out)->find("#form-027u"));
	pq($out)->append("<style>".file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz_droom.css")."</style>");
	pq($out)->find("input[type=hidden]")->remove();
	foreach(pq($out)->find("textarea") as $inc) {
		pq($inc)->after("".pq($inc)->html()."");
		pq($inc)->remove();
	}
	foreach(pq($out)->find("input,select") as $inc) {
		pq($inc)->after("".pq($inc)->attr("value")."");
		pq($inc)->remove();

	}
}

$out=ereg_replace("/{{.*}}/", "", $out->htmlOuter());
return $out;
}

function getEpicrizOut($event_id) {
	$actionType_id=$_SESSION["epic_atid"];
	$SQL="SELECT * FROM Action AS a 
	WHERE a.actionType_id = ".$actionType_id." 
	AND a.deleted = 0 
	AND a.event_id = ".$event_id." 
	LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed getEpicrizOut(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action=getActionInfo($data[0]);
	}
	return $action;
}

function drugsPrepare($data) {
	$array=array();
	foreach($data as $key => $line) {
		$line=$line["cell"];
		if ($line[3]!="отменено") {
		$cpx=count(explode(";",$line[7]));
		if ($line[9]==$line[10]) {$date=$line[9];} else {$date=$line[9]." - ".$line[10];}
		$date="<b>$date</b>";
		if ($cpx>1) {
			$complex=array();
			$name=explode(";",$line[5]);
			$qnt=explode(";",$line[6]);
			$unit=explode(";",$line[7]);
			//$complex[]=$date." ".$line[3];
			$complex[]="";
			foreach($name as $key => $drug) {
				//$complex[]=$drug." (".$qnt[$key]." ".$unit[$key]." ".$line[8].")" ;
				$complex[]=$drug;
			}
			$array[]["drugs"]=implode("<br>",$complex);
		} else {
			//$array[]["drugs"]=$date." ".$line[3]."<br>".$line[5]." (".$line[6]." ".$line[7]." ".$line[8].")";
			$array[]["drugs"]=$line[5];
		}
		}
	}
	return $array;
}

function fields_msk36($event_id,$orgstr="") {
	// print_r($event_id);
	$tpl="";
	foreach($_SESSION["epic_tpl"] as $key => $arr) {
		if (in_array($orgstr,$arr[0])) {	$tpl=$arr[1];	}
	}
	
	$event=mysqlReadItem("Event",$event_id);
	$Diag=patientGetDiagnosis($event_id);
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON (a.event_id = e.id and a.person_id = e.execPerson_id)
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	# AND (a.setPerson_id = e.execPerson_id OR a.person_id = e.execPerson_id )
	AND a.deleted = 0 
	AND a.status = 2 
	AND t.name LIKE '%осмотр%'
	ORDER BY endDate ASC LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed fields_msk36(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		$first_osmotr=getActionProperties($data[0],"");
	}
	$action_in=getActionDataIn($event_id); // Осмотр в приёмном отделении
	// print_r($action_in);
	// $first_osmotr1=getAction($action_id);
	// $first_osmotr1=$first_osmotr1["data"]["fields"];
	$firstView = getAction($action_id);
	$firstView = $firstView["data"]["fields"];
	print_r('firstView1');
	print_r($firstView);

	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON (a.event_id = e.id and a.person_id = e.execPerson_id)
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	# AND (a.setPerson_id = e.execPerson_id OR a.person_id = e.execPerson_id )
	AND a.deleted = 0 
	AND a.status = 2 
	AND t.name LIKE '%осмотр%' 
	ORDER BY endDate DESC LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed fields_msk36(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		$last_osmotr=getActionProperties($data[0],"");
	}
	$action_in=getActionDataIn($event_id); // Осмотр в приёмном отделении
	// print_r($action_in);
	// $first_osmotr1=getAction($action_id);
	// $first_osmotr1=$first_osmotr1["data"]["fields"];
	$lastView = getAction($action_id);
	$lastView = $lastView["data"]["fields"];


	$event=mysqlReadItem("Event",$event_id);
	$Diag=patientGetDiagnosis($event_id);
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON (a.event_id = e.id)
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	# AND (a.setPerson_id = e.execPerson_id OR a.person_id = e.execPerson_id )
	AND a.deleted = 0 
	AND a.status = 2 
	AND t.name LIKE '%осмотр%'
	ORDER BY endDate ASC LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed fields_msk36(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		$first_diag_view=getActionProperties($data[0],"");
	}
	$action_in=getActionDataIn($event_id); // Осмотр в приёмном отделении
	$firstDiagView = getAction($action_id);
	$firstDiagView = $firstView["data"]["fields"];




	// print_r($action_id);
	$f=array(); // $f[""]="";
	$docs=array();
	


	$docs["FirstOsmotr"]=$first_osmotr1;
	$docs["DiaryLast"]=$DiaryLast;
	$docs["diaryLast"]=$DiaryLast;
	$docs["firstView"]=$firstView;
	$docs["secondView"]=$secondView;
	$docs["lastView"]=$lastView;
	$docs['firstDiagView'] = $firstDiagView;
	// print_r('fsdfsd');
	getTemplateValues($docs);
	return $f;
}

function op_add($name,$values=array()) {
	if (!is_array($name)) {$name=array($name);}
	foreach($name as $n => $fld) {
		foreach($values as $key => $val) {
			pq($out)->find("[name=".$fld."]")->append("<option class='add'>{$val}</option>");
		}
	}
}

function getTemplateValues($docs=array()) {
	foreach(pq($out)->find("[from]") as $inc) {
		$from=array(); $from=explode("@",pq($inc)->attr("from"));
		foreach($docs[$from[0]] as $fld => $data) {
			// нормализуем поля (удаляем пробелы, двоеточия)
			$docs[$from[0]][fldname($fld)]=$docs[$from[0]][$fld];
		}
		$fld=fldname($from[1],$docs[$from[0]]);
		if (isset($docs[$from[0]]) AND $fld>"") {
	// ============ SELECT ==============
			if (pq($inc)->is("select")) {
			pq($inc)->attr("value",$docs[$from[0]][$fld]["value"]);
				if (pq($inc)->attr("multiple")=="multiple") {
					$multi=true;
					$val=explode(",",pq($inc)->attr("value")); 
					foreach($val as $k => $v) {
						$val[$k]=trim($v);
					}
				} else {
					$multi=false;
					$val=array(); $val[0]=pq($inc)->attr("value");
				}
				foreach(pq($inc)->find("option") as $opt) {
					$collective_output = '';
					foreach($val as $k => $v) {
						if (mb_strtolower(pq($opt)->text(), 'UTF-8') == mb_strtolower($v,'UTF-8') AND $multi==true) {
							pq($opt)->attr("set","set");
						} 
						if (pq($opt)->text()==$v AND $multi==false) {pq($opt)->attr("selected","selected");}
					}
					
				}
			}
			
	// ============ INPUT ==============
			if (pq($inc)->is("input")) {pq($inc)->attr("value",$docs[$from[0]][$fld]["value"]);}
	// ============ TEXTAREA ==============
			if (pq($inc)->is("textarea")) {pq($inc)->html($docs[$from[0]][$fld]["value"]);}
	// ============ SPAN ==============
			if (pq($inc)->is("span")) {pq($inc)->html($docs[$from[0]][$fld]["value"]);}
		}
	}
}

function fldname($name,$doc=NULL) {
	$name=str_replace(":","",$name);
	$name=str_replace("  "," ",$name);
	$name=str_replace("  "," ",$name); // так нада!
	$name=trim($name);
	if (is_array($doc) && $name>" ")	{
		foreach($doc as $key => $test) {
			if (preg_match("/{$name}/iU", $key)) {$name=$key;}
		}
	}
	return $name;
}

function getFirstView($event_id,$name,$person_id="") {
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON a.event_id = e.id
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	AND a.deleted = 0 AND a.status = 2 AND t.name LIKE '%{$name}%' 
	ORDER BY endDate LIMIT 1";
	if ($_SESSION["tmp_limit"]>"") {$SQL=str_replace("LIMIT 1",$_SESSION["tmp_limit"],$SQL); $_SESSION["tmp_limit"]="";}
	// print_r($SQL);
	
	$action_id=""; $res=mysql_query($SQL) or die ("Query failed getActionDataIn(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		// print_r($data);
	}
	$action=getAction($action_id);
	$form=getActionTypeForm($action["data"]["name"]);
	$action=$action["data"]["fields"];
	// getConstructorData($action,$form);

	return $action;
}

/*function getConstructorData($action,$form) {
	foreach($form as $key => $fld) {
		print_r($fld);
		if ($fld["type"]=="Constructor") {$action[$fld["label"]]["enum"]=$fld["enum"];}
	}
	print_r($action); die;
	return $action;
}
*/

function getActionDataIn($event_id) {
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON a.event_id = e.id
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	AND a.deleted = 0 AND a.status = 2 AND t.name LIKE '%осмотр%' AND t.name LIKE '%в приемном%'
	ORDER BY endDate LIMIT 1";
	// print_r($SQL);
	$action_id=""; $res=mysql_query($SQL) or die ("Query failed getActionDataIn(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
	}
	$action=getAction($action_id);
	// print_r($action);
	$action=$action["data"]["fields"];
	return $action;
}

function getDiaryLast($event_id,$name="Дневниковая запись врача - Невролога") {
	$atype=getActionTypeByName($name);
	$action_id=""; $action=array();
	$SQL="SELECT id FROM Action 
	WHERE event_id = {$event_id} AND actionType_id = {$atype}  
	AND deleted = 0  AND status = 2
	ORDER BY id DESC LIMIT 1	";
	$res=mysql_query($SQL) or die ("Query failed morfoLab(): " . mysql_error());
	while($data = mysql_fetch_array($res)) { $action_id=$data["id"]; }
	if ($action_id>"") {
		$action=getAction($action_id); $action=$action["data"];
	}
	return $action;
}

function getDiaryList($event_id,$name) {
	$atype=getActionTypeByName($name);
	$action_id=""; $action=array();
	$SQL="SELECT id FROM Action 
	WHERE event_id = {$event_id} AND actionType_id = {$atype}  
	AND deleted = 0  AND status = 2
	ORDER BY id";
	$res=mysql_query($SQL) or die ("Query failed morfoLab(): " . mysql_error());
	while($data = mysql_fetch_array($res)) { 
		$data=getAction($data["id"]); $action[]=$data["data"];
	}
	return $action;
}


function getTextFromAction($action,$from,$to=NULL) {
	$text=array();
	if (!is_array($from) AND $to==NULL) {$from=array($from);}
	if (!is_array($from) AND !$to==NULL) {
		$arr=array(); $flag=false;
		foreach($action as $key => $line) {
			if ($key==$from) {$flag=true;}
			if ($flag==true) {$arr[]=$key;}
			if ($key==$to) {$flag=false;}
		}
	} else {$arr=$from;}
	foreach($arr as $key => $fld) {
		$name=fldname($fld);
		$action[$fld]["value"]=str_replace('\\',"/",$action[$fld]['value']);
		if ($action[$fld]["value"]>"") {$text[]="{$name}: {$action[$fld]["value"]}";}
	}
	$text=trim("\r\n".implode(", ",$text));
	if (!is_array($from)) {$text=str_replace(fldname($from).": ","",$text);}
	return $text;
}

function field_multi($value) {
	$arr=explode(" ",$value);
	$ret=array();
	foreach($arr as $key => $line) {
		$line=explode("=",$line);
		$line[0]=trim($line[0]); $line[1]=trim($line[1]);
		$line[0]=str_replace(":","",$line[0]);
		if ($line[1]>"") $ret[]="<b>{$line[0]}:</b> {$line[1]}";
	}
	return implode($ret,", ");
}

function epicLabPrep($event_id,$aType) {
	$actionHistory=getActionsHistory($event_id);
	$labHistory=$actionHistory["data"][1];
	$res=array();
	$present=array();
	$exclude=array("1","Дата Назначения","Номерок","Направлен","Показания к исследованию","Дата и время Выполнения");
/*
	foreach($labHistory as $key => $labline) {
		foreach($labline as $key =>$line) {		if ($line["status"]==2) {
			if (!in_array($line["name"],$present)) {
				$present[]=$line["name"];
				$action=getAction($line["actionId"],$event_id); 
				$actionType_id=$action["data"]["actionType_id"];
				if (checkActionTypeParrent($actionType_id,$name)) {
					$time=date("d/m/Y h:i",strtotime($action["data"]["endDate"]));
					$action=$action["data"]["fields"];
					$info=array();
					$info[]="<b>Дата выполнения:</b> {$time}";
					foreach($action as $key => $val) {
						if (!in_array($key,$exclude) AND $val>"") {
							if (substr($key,-1)==":") {$name=$key;} else {$name=$key.":";}
							if (is_array($val)) {$value=$val["value"];} else {$value=$val;}
							$info[]="<b>{$name}</b> {$value}";
						}
					}
					$res[]["lab"]="<b>".$line["name"]."</b><br>".implode(", ",$info);
				}
			}
		}}
	}
*/
	foreach($labHistory as $key => $labline) {
		foreach($labline as $key =>$line) {		if ($line["status"]==2) {
//			if (!in_array($line["name"],$present)) {
				$present[]=$line["name"];
				$action=getAction($line["actionId"],$event_id); 
				$actionType_id=$action["data"]["actionType_id"];
				if (checkActionTypeParrent($actionType_id,$aType)) {
					$time=date("d/m/Y H:i",strtotime($action["data"]["endDate"]));
					$action=$action["data"]["fields"];
					$doc=phpQuery::newDocument("<table></table>");
					pq($doc)->find("table")->prepend("<tr><th colspan='2'>{$time} {$line["name"]}</th><th>Норма</th><th>Ед.изм.</th></tr>");
					foreach($action as $key => $val) {
						if (!in_array($key,$exclude) AND $val>"") {
							if (!($aType == "Инструментальная диагностика" and $key == "Описание:" and !preg_match('/эхо-кг/iu', $line['name'])) ) {
								if (substr($key,-1)==":") {$name=$key;} else {$name=$key.":";}
								if (is_array($val)) {
									$value=htmlspecialchars($val["value"]); 
									$unit=$val["unit"];
									$norm=$val["norm"];
								} else {$value=$val; $unit="";}
								$info[]="<b>{$name}</b> {$value}";
								pq($doc)->find("table")->append("<tr><td>{$name}</td><td>{$value}</td><td>{$norm}</td><td>{$unit}</td></tr>");
							}
						}
					}
					if ($aType!="Лабораторные исследования") {
						foreach(pq($doc)->find("table")->find("tr") as $tab) {
							pq($tab)->find("td:eq(2),td:eq(3)")->remove();
							pq($tab)->find("th:eq(1),th:eq(2)")->remove();
						}
					}
					$res[]["lab"]=pq($doc)->htmlOuter();
				}
//			}
		}}
	}
	return $res;
}

function epicConsPrep($event_id) {
	$actionDiary=getActionsDiary($event_id);
	$actionDiary=$actionDiary["data"];
	$res=array();
	$exclude=array("Дневниковая запись врача","обход заведующего отделением");
	$excludefld=array("Дата Назначения","Дата консультации","Дата и время Выполнения");
	foreach($actionDiary as $key => $line) {
		if (!in_array($line["name"],$exclude)) {
			$action=getAction($line["actionId"],$event_id); $action=$action["data"];
			if (isset($action["fields"]["Дата консультации"])) {
				$info=array();
				foreach($action["fields"] as $key => $val) {
					$val=$val["value"]; 
					$key = str_replace(':', '', $key);
					if ($key == 'Заключение') {
						if (!in_array($key,$excludefld) AND $val>"") {$info[]="<b>$key</b>: $val";}
					}
				}
				$res[]["cons"]="<b>".$line["name"]."</b><br>".implode(", ",$info);
			}
		}
	}
	return $res;
}
function epicrizOut_edit_old($form,$mode,$id,$datatype) {
	parse_str($_SERVER["REQUEST_URI"]);
	$tpl=array();
	$tpl[]=array(array("КО (ОНК) РСЦ","2 КО РСЦ"),"Cord",$type);
	$tpl[]=array(array("1 НО ОНМК РСЦ"),"Nevr",$type);
	$tpl[]=array(array("ОСХ РСЦ"),"Ocx",$type);
	$tpl[]=array(array("ОАР ОНМК"),"Oar",$type);
	$_SESSION["epic_tpl"]=$tpl;
	$_SESSION["epic_type"]=$type;
	switch($type) {
		case "out":		$name="DoctorRoom: Выписной эпикриз"; $docType="ВЫПИСНОЙ"; break;
		case "etap":	$name="DoctorRoom: Этапный эпикриз"; $docType="ЭТАПНЫЙ"; break;
		case "move":	$name="DoctorRoom: Переводной эпикриз"; $docType="ПЕРЕВОДНОЙ"; break;
		case "dead":	$name="DoctorRoom: Посмертный эпикриз"; $docType="ПОСМЕРТНЫЙ"; break;
		default:		$name="DoctorRoom: Выписной эпикриз"; $docType="ВЫПИСНОЙ"; break;
	}
	$_SESSION["epic_atid"]=getActionTypeByName($name);
	echo 'ooz'.$id.'  '.$_SESSION["epic_type"].'ooz';
if ($id!="_new" AND $id!="" AND $_SESSION["epic_atid"]>"") {
	// print_r('actionout');
	$action=getEpicrizOut($id);
	// print_r($action);
	if (isset($action["id"])) {
		// $Item=array_merge($Item,$action);
		foreach($action["epic_out"] as $key => $val) {
			if (substr($key,0,2)=="e_") {
				$Item[$key]=$val;
			} 
		}
		$Item["fields"]=$action["epic_out"];
		$Item["action_id"]=$action["id"];
	} else {
		$field=array();
		$Item["action_id"]="_new";
		$field[0]["val"]=""; $field[0]["fld"]="Полный диагноз, сопутствующее осложнение";
		$field[1]["val"]=""; $field[1]["fld"]="Краткий анамнез, диагностические исследования, течение болезни";
		$field[2]["val"]=""; $field[2]["fld"]="Лечебные и трудовые рекомендации";
		$Item["fields"]=$field;
	}

if ($_SESSION["settings"]["appId"]=="msk36") {
	$flds=array("e_pulm_in","e_pulmFreq_in","e_corTone_in","e_corFreq","e_corPress_in","a_date1","a_date2","s_date1","s_date2");
	foreach($flds as $key =>$fld) {if (!isset($Item[$fld])) {$Item[$fld]="";}}
	$Item["Drugs"]=drugsPrepare(json_decode(file_get_contents($getAssignList_url."assignlist/data?event_id=".$id),true));
	$statMoving=getStationarMovings($id);
	$Item["moving"]=$statMoving["data"]["moving"];
	$Item["lab"]=epicLabPrep($id,"Лабораторные исследования");
	$Item["res"]=epicLabPrep($id,"Инструментальная диагностика");
	$Item["cons"]=epicConsPrep($id);
}
}	

	$json_query_SQL="SELECT * FROM Action AS a 
	INNER JOIN JsonData as jd on jd.id = concat('Action@',a.id)
	WHERE a.actionType_id = 26618 
	AND a.deleted = 0 
	AND a.event_id = ".$id." 
	LIMIT 1";
	// $res=mysql_query($SQL) or die ("Query failed getEpicrizOut(): " . mysql_error());

$event=mysqlReadItem("Event",$id);
	$Item["execPerson_id"]=$event["execPerson_id"];
	// $Diag=patientGetDiagnosis($id);
	$person=getPersonInfo($person_id);
	$doctor=getPersonInfo($event["execPerson_id"]);
	$client=getClientInfo($event["client_id"]);
	$organisation=mysqlReadItem("Organisation",$person["org_id"]);
	$orgstructure=mysqlReadItem("OrgStructure",$doctor["orgStructure_id"]);
	echo 'orgst';
		print_r($id);
	$Item["dateShort"]=date("d.m.y");
	if (empty($orgstructure)) {

		$orgStrId_query = "SELECT ap_os.value
                                    FROM Action AS current
                                    INNER JOIN ActionProperty AS ap ON (ap.action_id = current.id)
                                    INNER JOIN ActionPropertyType AS apt ON (apt.id = ap.type_id AND name='Отделение пребывания')
                                    INNER JOIN ActionProperty_OrgStructure AS ap_os ON (ap_os.id = ap.id)
                                    INNER JOIN Event as ev on current.event_id = ev.id
                                  
                                    where ap.deleted=0 and ev.id = {$id} ORDER BY current.id DESC LIMIT 1";

		$result = mysql_query($orgStrId_query) or die ("Query failed epicrizOut.php: " . mysql_error());
		$orgStr_id = mysql_result($result, 0);
		$orgstructure=mysqlReadItem("OrgStructure",$orgStr_id);
		echo 'doctor1
		 '. $orgStr_id;
	}
	$Item["OrgStrCode"]=$orgstructure["code"];
	$Item["externalId"]=$event["externalId"];
	$Item["OrgName"]=$organisation["title"];
	$Item["OrgAddr"]=$organisation["Address"];
	$Item["OrgPhone"]=$organisation["phone"];
	$Item["event_id"]=$id;
	$Item["org"]=$organisation["shortName"];
	$Item["orgStr"]=$person["orgStructure"];
	$Item["person"]=$person["personShort"];
	$Item["person_id"]=$person_id;
	$Item["person"]=$person["personShort"];
	$Item["doctor_id"]=$event["execPerson_id"];
	$Item["doctor"]=$person["doctorShort"];
	$Item["client"]=$client["client"];
	$Item["bDate"]=getRusDate($client["birthDate"])."г.";
	$Item["address"]=$client["addressLive"];
	$Item["work"]=$client["work"];
	$Item["setDate"]=date("m.d.Y 00:00:00",strtotime($event["setDate"]));
	$Item["docType"]=$docType;
	$Item["diag_main"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];
	//	$Item["diag_satt"]=$Diag["satt"]["MKB"]." ".$Diag["satt"]["DiagName"];
	//	$Item["diag_tera"]=$Diag["terapevt"]["MKB"]." ".$Diag["terapevt"]["DiagName"];
	if ($client["sex"]=="мужской") {$Item["suffix1"]="ся";$Item["suffix2"]="";$Item["suffix3"]="";} else {$Item["suffix1"]="ась";$Item["suffix2"]="а";$Item["suffix3"]="ка";}
	$Item["age"]=$client["age"];

	$Item["s_date1"]=getRusDate($event["setDate"])."г.";
	if ($action["endDate"]>"") {
		$Item["s_date2"]=getRusDate($action["endDate"])."г.";
	} else {
		$Item["s_date2"]=getRusDate(date("Y-m-d"))."г.";
		$Item["endDate"]=date("d.m.Y");
	}
		$Item["docDate"]=$Item["s_date2"];
	$Item["orgStrBoss"]=getPersonInfo($orgstructure["chief_id"]); $Item["orgStrBoss"]=$Item["orgStrBoss"]["personShort"];
// $Item["e_diag_in"] = print_r($action, true);
	
	
			if ($_SESSION["settings"]["appId"]=="msk36") {
			// =========================================================	
			// ========= привязываем шаблоны к кодам отделений =========	
			// =========================================================
				foreach($tpl as $key => $arr) {
					echo 'lol1
					';
					echo print_r($Item, true).'
					';

					if (in_array($Item["OrgStrCode"],$arr[0])) {
						echo $key . ' =>' . print_r($arr, true) . ' been found';
						$path = $_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz_".$arr[1]."_".$arr[2].".php";
						$out=phpQuery::newDocumentFile($path);
					}
				}
			// ========= по-умолчанию простой эпикриз =========	
			if ($out=="") {$out=phpQuery::newDocumentFile($_SERVER['DOCUMENT_ROOT']."/forms/epicrizOut_edit.php");}
			pq($out)->append("<style>".file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz.css")."</style>");
			if ($_SESSION["epic_atid"]=="") { 
				pq($out)->find("form")->html("Необходимо создать ActionType - {$name}"); 
			}
			} else {
				$out=formGetForm($form,$mode);
			}
				
// 	print_r('I wanna crack the code');
// print_r($Item);
	// print_r(fields_msk36($id,$Item["OrgStrCode"]));

	if ($_SESSION["settings"]["appId"]=="msk36") {
		if ($Item["action_id"]=="_new") {
			$Item=array_merge($Item,fields_msk36($id,$Item["OrgStrCode"]));

		} else {
			$Item=array_merge(fields_msk36($id,$Item["OrgStrCode"]),$Item);
		}
	}
// $Item["e_diag_in"]=print_r($Item, true);
pq($out)->find("form")->prepend("<input type='hidden' name='actionType_id' value='{$_SESSION["epic_atid"]}'>");

$i=0; foreach(pq($out)->find("[name=e_recom_sel] option") as $recom) {
	if (pq($recom)->html()==$Item["e_recom_sel"]) {
		pq($out)->find(".recom_tab > li:eq({$i}) textarea")->attr("name","e_recom_text");
	}
	$i++;
}

foreach(pq($out)->find("input,select,textarea") as $inp) {
	if (!isset($Item[pq($inp)->attr("name")])) {$Item[pq($inp)->attr("name")]="";} else {
		if (pq($inp)->is("textarea")) {pq($inp)->html($Item[pq($inp)->attr("name")]);}
	}
}

foreach(pq($out)->find("select option.add") as $add) {
	$add_name=pq($add)->parent("select")->attr("name")."_add";
	if (!pq($add)->parent("select")->next("input.addinf")->length()) {
		pq($add)->parent("select")->after("<input name='{$add_name}' class='addinf'>");
	}
}
$out=contentSetData($out,$Item);

foreach($out->find("select option") as $opt) {
	// устанавливаем option в соответствии с select.value
	if (pq($opt)->parent("select")->attr("value")==pq($opt)->text()) {pq($opt)->attr("selected","selected");}
}
foreach($out->find("select[multiple] option") as $opt) {
	// устанавливаем option для multiple select
	$selname=pq($opt)->parent("select")->attr("name"); $selname=substr($selname,0,-2);
	if (in_array(pq($opt)->text(),$Item[$selname])) {pq($opt)->attr("set","set");}
}
foreach(pq($out)->find("textarea[placeholder]") as $inp) {
	// устанавливаем знечение placeholder для пустых текстов
	if (pq($inp)->html()=="") {	pq($inp)->html(pq($inp)->attr("placeholder")); }
}

if ($mode=="print") {
	pq($out)->html(pq($out)->find("#form-027u"));
	pq($out)->append("<style>".file_get_contents($_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz_droom.css")."</style>");
	pq($out)->find("input[type=hidden]")->remove();
	foreach(pq($out)->find("textarea") as $inc) {
		pq($inc)->after("".pq($inc)->html()."");
		pq($inc)->remove();
	}
	foreach(pq($out)->find("input,select") as $inc) {
		pq($inc)->after("".pq($inc)->attr("value")."");
		pq($inc)->remove();

	}
}
$out=ereg_replace("{{.*}}", "", $out->htmlOuter());
return $out;
}
?>