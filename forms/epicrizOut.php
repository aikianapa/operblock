<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();
$_SESSION["allow"]=array("Врач");
function epicrizOut_edit($form,$mode,$id,$datatype) {
	parse_str($_SERVER["REQUEST_URI"]);
	$tpl=array();
	$tpl[]=array(array("КО (ОНК) РСЦ","2 КО РСЦ"),"Cord",$type);
	$tpl[]=array(array("1 НО ОНМК РСЦ"),"Nevr",$type);
	$_SESSION["epic_tpl"]=$tpl;
	switch($type) {
		case "out":		$name="DoctorRoom: Выписной эпикриз"; break;
		case "etap":	$name="DoctorRoom: Этапный эпикриз"; break;
		case "move":	$name="DoctorRoom: Переводной эпикриз"; break;
		default:		$name="DoctorRoom: Выписной эпикриз"; break;
	}
	$_SESSION["epic_atid"]=getActionTypeByName($name);
if ($id!="_new" AND $id!="" AND $_SESSION["epic_atid"]>"") {
	$action=getEpicrizOut($id);
	if (isset($action["id"])) {
		$Item=array_merge($Item,$action);
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
$event=mysqlReadItem("Event",$id);
	$Item["execPerson_id"]=$event["execPerson_id"];
//	$Diag=patientGetDiagnosis($id);
	$person=getPersonInfo($person_id);
	$doctor=getPersonInfo($event["execPerson_id"]);
	$client=getClientInfo($event["client_id"]);
	$organisation=mysqlReadItem("Organisation",$person["org_id"]);
	$orgstructure=mysqlReadItem("OrgStructure",$doctor["orgStructure_id"]);
	$Item["dateShort"]=date("d.m.y");
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
//	$Item["diag_main"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];
//	$Item["diag_satt"]=$Diag["satt"]["MKB"]." ".$Diag["satt"]["DiagName"];
//	$Item["diag_tera"]=$Diag["terapevt"]["MKB"]." ".$Diag["terapevt"]["DiagName"];
	if ($client["sex"]=="мужской") {$Item["suffix1"]="ся";$Item["suffix2"]="";$Item["suffix3"]="";} else {$Item["suffix1"]="ась";$Item["suffix2"]="а";$Item["suffix3"]="ка";}
	$Item["age"]=$client["age"];

	$Item["s_date1"]=getRusDate($event["setDate"])."г.";
	if ($action["endDate"]>"") {
		$Item["s_date2"]=getRusDate($action["endDate"])."г.";
	} else {
		$Item["s_date2"]=getRusDate(date("Y-m-d"))."г.";
	}
		$Item["docDate"]=$Item["s_date2"];
	$Item["orgStrBoss"]=getPersonInfo($orgstructure["chief_id"]); $Item["orgStrBoss"]=$Item["orgStrBoss"]["personShort"];
	
	
	
			if ($_SESSION["settings"]["appId"]=="msk36") {
			// =========================================================	
			// ========= привязываем шаблоны к кодам отделений =========	
			// =========================================================
				foreach($tpl as $key => $arr) {
					if (in_array($Item["OrgStrCode"],$arr[0])) {
						$out=phpQuery::newDocumentFile($_SERVER['DOCUMENT_ROOT']."/forms/msk36/epicriz_".$arr[1]."_".$arr[2].".php");
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
				
				
	
	if ($_SESSION["settings"]["appId"]=="msk36") {
		if ($Item["action_id"]=="_new") {
			$Item=array_merge($Item,fields_msk36($id,$Item["OrgStrCode"]));
		} else {
			$Item=array_merge(fields_msk36($id,$Item["OrgStrCode"]),$Item);
		}
	}


pq($out)->find("form")->prepend("<input type='hidden' name='actionType_id' value='{$_SESSION["epic_atid"]}'>");

foreach(pq($out)->find("input,select,textarea") as $inp) {
	if (!isset($Item[pq($inp)->attr("name")])) {$Item[pq($inp)->attr("name")]="";}
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
	$tpl="";
	foreach($_SESSION["epic_tpl"] as $key => $arr) {
		if (in_array($orgstr,$arr[0])) {	$tpl=$arr[1];	}
	}
	
	$event=mysqlReadItem("Event",$event_id);
	$Diag=patientGetDiagnosis($event_id);
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON a.event_id = e.id
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	AND (a.setPerson_id = e.execPerson_id OR a.person_id = e.execPerson_id )
	AND a.deleted = 0 
	AND t.name LIKE '%осмотр%' 
	ORDER BY endDate LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed fields_msk36(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		$first_osmotr=getActionProperties($data[0],"");
	}
	$action_in=getActionDataIn($event_id);
	$first_osmotr1=getAction($action_id);
	$first_osmotr1=$first_osmotr1["data"]["fields"];
	$f=array(); // $f[""]="";
	switch($tpl) {
		case "Cord":
		// =========== Кордиология ===========
			$f["e_complaint1"]=$first_osmotr1["Жалобы при поступлении:"]["value"];
			$f["e_complaint2"]="";
			$f["e_code1"]=$first_osmotr1["МЭС:"]["value"];
			$f["e_anamnez1"]=$first_osmotr1["Anamnesis morbi"]["value"];
			$f["e_anamnez2"]=$first_osmotr["fld_11"];
			$f["e_anamnez3"]=$first_osmotr1["Аллергологический анамнез:"]["value"];
			$f["e_anamnez4"]=$first_osmotr["fld_26"];
			$f["e_stateIn"]=$first_osmotr1["Состояние"]["value"];
			$f["e_diag_in"]=$action_in["Основной:"]["value"];
			$f["e_diag_out"]=$Diag["main"]["DiagName"];
			$f["e_diag_main"]=$first_osmotr1["Основной:"]["value"];
			$f["e_diag_fon"]=$first_osmotr1["Фон:"]["value"];
			$f["e_diag_comp"]=$first_osmotr1["Осложнения:"]["value"];
			$f["e_diag_satt"]=$first_osmotr1["Сопутствующий:"]["value"];
			$f["e_pulm_in"]=$first_osmotr1["Дыхание через нос"]["value"];
			$f["e_pulmFreq_in"]=$first_osmotr1["ЧДД"]["value"];
			$f["e_corTone_in"]=$first_osmotr1["Тоны сердца"]["value"];
			$f["e_corPress_in"]=$first_osmotr1["АД"]["value"];
			$f["e_corFreq_in"]=field_multi($first_osmotr1["ЧСС , Пульс, Дефицит пульса"]["value"]);
			$f["e_liverText_in"]=$first_osmotr1["Печень"]["value"];
			$f["e_bellyText_in"]=$first_osmotr1["Живот"]["value"];
			break;
		case "Nevr":
		// =========== Неврология
		
			$f["e_complaint1"]=$action_in["Жалобы при поступлении:"]["value"];
			$f["e_complaint2"]=$first_osmotr1["Жалобы при осмотре в н\о:"]["value"];
			$f["e_code1"]=$first_osmotr1["МЭС:"]["value"];
			$f["e_anamnez1"]=$first_osmotr1["Анамнез заболевания:"]["value"];
			$f["e_anamnez2"]=$first_osmotr1["Анамнез жизни:"]["value"];
				$f["e_anamnez2"].=getTextFromAction($first_osmotr1,"Гипертоническая болезнь:","Травмы:");
				$f["e_anamnez2"].=getTextFromAction($first_osmotr1,"Другие заболевания:");
				$f["e_anamnez2"].=getTextFromAction($first_osmotr1,"Постоянно принимает препараты:");
			$f["e_anamnez3"]=$first_osmotr1["Аллергоанамнез:"]["value"];
			$f["e_anamnez4"]=$first_osmotr1["Эпид. анамнез:"]["value"];
			$f["e_blist12"]=$first_osmotr1["Находился на больничном листе в течение последних 12 месяцев:"]["value"];
			$f["e_stateIn"]=getTextFromAction($first_osmotr1,"Состояние при поступлении:","Диагноз:");
			$f["e_stateIn"]=explode(", Диагноз:",$f["e_stateIn"]); $f["e_stateIn"]=$f["e_stateIn"][0];
			$f["e_stateNo"]=$first_osmotr1["Состояние при осмотре в н\о:"]["value"];
			
			$DiaryLast=getDiaryLast($event_id); $DiaryLast=$DiaryLast["fields"];
			$f["e_stateOut"]=$DiaryLast["Состояние при осмотре:"]["value"];
			//===========
			$f["e_diag_in"]=$action_in["Основной:"]["value"];
			$f["e_diag_main"]=$first_osmotr1["Основной:"]["value"];
			$f["e_diag_fon"]=$first_osmotr1["Фон:"]["value"];
			$f["e_diag_comp"]=$first_osmotr1["Осложнения:"]["value"];
			$f["e_diag_satt"]=$first_osmotr1["Сопутствующий:"]["value"];
			//===========
			$f["work"]=$first_osmotr1["Место работы:"]["value"];
			$f["address"]=$first_osmotr1["Адрес:"]["value"];
			$docs=array();
			$docs["FirstOsmotr"]=$first_osmotr1;
			$docs["DiaryLast"]=$DiaryLast;
			getTemplateValues($docs);
			break;
	}
	return $f;
}

function getTemplateValues($docs=array()) {
	foreach(pq($out)->find("[from]") as $inc) {
		$from=array(); $from=explode("@",pq($inc)->attr("from"));
		if (isset($docs[$from[0]]) AND $from[1]>"") {
	// ============ SELECT ==============
			if (pq($inc)->is("select")) {
			pq($inc)->attr("value",$docs[$from[0]][$from[1]]["value"]);
				if (pq($inc)->attr("multiple")=="multiple") {
					$multi=true;
					$val=explode(",",pq($inc)->attr("value")); foreach($val as $k => $v) {$val[$k]=trim($v);}
				} else {
					$multi=false;
					$val=array(); $val[0]=pq($inc)->attr("value");
				}
				foreach(pq($inc)->find("option") as $opt) {
					foreach($val as $k => $v) {
						if (pq($opt)->text()==$v AND $multi==true) {pq($opt)->attr("set","set");}
						if (pq($opt)->text()==$v AND $multi==false) {pq($opt)->attr("selected","selected");}
					}
				}
			}
			
	// ============ INPUT ==============
			if (pq($inc)->is("input")) {pq($inc)->attr("value",$docs[$from[0]][$from[1]]["value"]);}
	// ============ TEXTAREA ==============
			if (pq($inc)->is("textarea")) {pq($inc)->html($docs[$from[0]][$from[1]]["value"]);}
		}
	}
}

function getActionDataIn($event_id) {
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON a.event_id = e.id
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	AND a.deleted = 0 
	AND t.name LIKE '%осмотр%' 
	AND t.name LIKE '%в приемном%' 
	ORDER BY endDate LIMIT 1";
	$action_id=""; $res=mysql_query($SQL) or die ("Query failed getActionDataIn(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
	}
	$action=getAction($action_id);
	$action=$action["data"]["fields"];
	return $action;
}

function getDiaryLast($event_id) {
	$atype=getActionTypeByName("Дневниковая запись врача - Невролога");
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
		$name=str_replace(":","",$fld);
		if ($action[$fld]["value"]>"") {$text[]="{$name}: {$action[$fld]["value"]}";}
	}
	return "\r\n".implode(", ",$text);
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
					$time=date("d/m/Y h:i",strtotime($action["data"]["endDate"]));
					$action=$action["data"]["fields"];
					$doc=phpQuery::newDocument("<table></table>");
					pq($doc)->find("table")->prepend("<tr><th colspan='2'>{$time} {$line["name"]}</th><th>Норма</th><th>Ед.изм.</th></tr>");
					foreach($action as $key => $val) {
						if (!in_array($key,$exclude) AND $val>"") {
							if (substr($key,-1)==":") {$name=$key;} else {$name=$key.":";}
							if (is_array($val)) {
								$value=$val["value"]; 
								$unit=$val["unit"];
								$norm=$val["norm"];
							} else {$value=$val; $unit="";}
							$info[]="<b>{$name}</b> {$value}";
							pq($doc)->find("table")->append("<tr><td>{$name}</td><td>{$value}</td><td>{$norm}</td><td>{$unit}</td></tr>");
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
	$excludefld=array("Дата Назначения","Дата консультации");
	foreach($actionDiary as $key => $line) {
		if (!in_array($line["name"],$exclude)) {
			$action=getAction($line["actionId"],$event_id); $action=$action["data"];
			if (isset($action["fields"]["Дата консультации"])) {
				$info=array();
				foreach($action["fields"] as $key => $val) {
					if (!in_array($key,$excludefld) AND $val>"") {$info[]="<b>$key</b>: $val";}
				}
				$res[]["cons"]="<b>".$line["name"]."</b><br>".implode(", ",$info);
			}
		}
	}
	return $res;
}

?>
