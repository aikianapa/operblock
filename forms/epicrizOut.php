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

if ($id!="_new" AND $id!="") {
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
	$Item["Drugs"]=drugsPrepare(json_decode(file_get_contents($getAssignList_url."assignlist/data?event_id=".$id),true));
	$statMoving=getStationarMovings($id);
	$Item["moving"]=$statMoving["data"]["moving"];
	$Item["lab"]=epicLabPrep($id,"Лабораторные исследования");
	$Item["res"]=epicLabPrep($id,"Инструментальная диагностика");
	$Item["cons"]=epicConsPrep($id);
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
	$Item["docDate"]=getRusDate(date("d-m-Y"))."г.";
	$Item["address"]=$client["addressLive"];
	$Item["work"]=$client["work"];
//	$Item["diag_main"]=$Diag["main"]["MKB"]." ".$Diag["main"]["DiagName"];
//	$Item["diag_satt"]=$Diag["satt"]["MKB"]." ".$Diag["satt"]["DiagName"];
//	$Item["diag_tera"]=$Diag["terapevt"]["MKB"]." ".$Diag["terapevt"]["DiagName"];
	if ($client["sex"]=="мужской") {$Item["suffix1"]="ся";$Item["suffix2"]="";$Item["suffix3"]="";} else {$Item["suffix1"]="ась";$Item["suffix2"]="а";$Item["suffix3"]="ка";}
	$Item["age"]=$client["age"];
	$Item["a_date1"]=$Item["a_date2"]=$Item["s_date1"]=$Item["s_date2"]="";
	$Item["s_date1"]=getRusDate($event["setDate"])."г.";
	if ($event["execDate"]>"") {
		$Item["s_date2"]=getRusDate($event["execDate"])."г.";
	} else {
		$Item["s_date2"]=getRusDate(date("Y-m-d"))."г.";
	}
	$Item["orgStrBoss"]=json_decode(getOrgStrBossName(),true); $Item["orgStrBoss"]=$Item["orgStrBoss"]["shortName"];
	if ($_SESSION["settings"]["appId"]=="msk36") {
		if ($Item["action_id"]=="_new") {
			$Item=array_merge($Item,fields_msk36($id,$Item["OrgStrCode"]));
		} else {
			$Item=array_merge(fields_msk36($id,$Item["OrgStrCode"]),$Item);
		}
	}
}
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
// =========================================================
} else {$out=formGetForm($form,$mode);}

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
$out=ereg_replace("{{.*}}", "", $out->htmlOuter());
return $out;
}

function getEpicrizOut($event_id) {
	$action=array();
	$actionType_id=getActionTypeByName("DoctorRoom: Выписной эпикриз");
	if($actionType_id=="") { echo "Необходимо создать ActionType 'DoctorRoom: Выписной эпикриз'"; } else {
	$SQL="SELECT * FROM Action AS a 
	WHERE a.actionType_id = ".$actionType_id." 
	AND a.deleted = 0 
	AND a.event_id = ".$event_id." 
	LIMIT 1";
	$res=mysql_query($SQL) or die ("Query failed getEpicrizOut(): " . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action=getActionInfo($data[0]);
	}
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
			$complex[]=$date." ".$line[3];
			foreach($name as $key => $drug) {
				//$complex[]=$drug." (".$qnt[$key]." ".$unit[$key]." ".$line[8].")" ;
				$complex[]=$drug;
			}
			$array[]["drugs"]=implode("<br>",$complex);
		} else {
			//$array[]["drugs"]=$date." ".$line[3]."<br>".$line[5]." (".$line[6]." ".$line[7]." ".$line[8].")";
			$array[]["drugs"]=$date." ".$line[3]." ".$line[5];
		}
		}
	}
	return $array;
}

function fields_msk36($event_id,$orgstr="") {
	$tpl="";
	foreach($_SESSION["epic_tpl"] as $key => $arr) {
		if (in_array($orgstr,$arr[1])) {	$tpl=$arr[2];	}
	}
	
	$event=mysqlReadItem("Event",$event_id);
	$Diag=patientGetDiagnosis($event_id);
	$SQL="SELECT a.* FROM Action AS a
	INNER JOIN  Event AS e ON a.event_id = e.id
	INNER JOIN  ActionType AS t ON t.id = a.actionType_id
	WHERE e.id = {$event_id} 
	AND (a.setPerson_id = e.execPerson_id OR a.person_id = e.execPerson_id )
	AND a.deleted = 0 
	AND t.name LIKE '%осмотр%' LIMIT 1 ";

	$res=mysql_query($SQL) or die ("Query failed fields_msk36(): [1]" . mysql_error());
	while($data = mysql_fetch_array($res)) {
		$action_id=$data[0];
		$first_osmotr=getActionProperties($data[0],"");
	}
	$first_osmotr1=getAction($action_id);
	$first_osmotr1=$first_osmotr1["data"]["fields"];
	$f=array(); // $f[""]="";
	switch($tpl) {
		case "Cord":
		// =========== Кордиология ===========
			$f["e_complaint1"]=$first_osmotr1["Жалобы при поступлении:"]["value"];
			$f["e_complaint2"]="";
			$f["e_anamnez1"]=$first_osmotr1["Anamnesis morbi"]["value"];
			$f["e_anamnez2"]=$first_osmotr["fld_11"];
			$f["e_anamnez3"]=$first_osmotr1["Аллергологический анамнез:"]["value"];
			$f["e_anamnez4"]=$first_osmotr["fld_26"];
			$f["e_stateIn"]=$first_osmotr1["Состояние"]["value"];
			$f["e_diag_main"]=$first_osmotr1["Основной:"]["value"];
			$f["e_diag_fon"]=$first_osmotr1["Фон:"]["value"];
			$f["e_diag_comp"]=$first_osmotr1["Осложнения:"]["value"];
			$f["e_diag_satt"]=$first_osmotr1["Сопутствующий:"]["value"];
			$f["e_pulm_in"]=$first_osmotr1["Дыхание через нос"]["value"];
			$f["e_pulmFreq_in"]=$first_osmotr1["ЧДД"]["value"];
			$f["e_corTone_in"]=$first_osmotr1["Тоны сердца"]["value"];
			$f["e_corPress_in"]=$first_osmotr1["АД"]["value"];
			$f["e_corFreq_in"]=field_multi($first_osmotr1["ЧСС , Пульс, Дефицит пульса"]["value"]);
			break;
		case "Nevr":
		print_r($first_osmotr1);
		// =========== Неврология ============
			$f["e_complaint1"]=$first_osmotr1["Жалобы при поступлении:"]["value"];
			$f["e_complaint2"]="";
			$f["e_anamnez1"]=$first_osmotr1["Анамнез заболевания:"]["value"];
			$f["e_anamnez2"]=$first_osmotr1["Анамнез жизни:"]["value"];
			$f["e_anamnez3"]=$first_osmotr1["Аллергоанамнез:"]["value"];
			$f["e_anamnez4"]=$first_osmotr1["Эпид. анамнез:"]["value"];
			$f["e_blist12"]=$first_osmotr1["Находился на больничном листе в течение последних 12 месяцев:"]["value"];
			$f["e_stateIn"]=$first_osmotr1["Состояние при поступлении:"]["value"];
			//===========
			$f["e_diag_main"]=$first_osmotr1["Основной:"]["value"];
			$f["e_diag_fon"]=$first_osmotr1["Фон:"]["value"];
			$f["e_diag_comp"]=$first_osmotr1["Осложнения:"]["value"];
			$f["e_diag_satt"]=$first_osmotr1["Сопутствующий:"]["value"];
			//===========
			$f["e_diag_main"]=$Diag["main"]["DiagName"];
			$f["e_diag_satt"]=$Diag["satt"]["DiagName"];

			break;
	}
	return $f;
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

function epicLabPrep($event_id,$name) {
	$actionHistory=getActionsHistory($event_id);
	$labHistory=$actionHistory["data"][1];
	$res=array();
	$present=array();
	$exclude=array("1","Дата Назначения","Номерок","Направлен","Описание:","Дата и время Выполнения");
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
