<?
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
prepareSessions();

function reports_list($form,$mode,$id,$datatype)  {
$Item=array();
$out=formGetForm($form,$mode);
if (isset($_COOKIE["workDate"])) {$Item["workDate"]=$_COOKIE["workDate"];} else {$Item["workDate"]=date("Y-m-d");}
$Item["begDate"]=$Item["workDate"];
$Item["endDate"]=$Item["workDate"];
$Item["person_id"]=$_SESSION["person_id"];
$Item["orgStr_id"]=$_SESSION["orgStrId"];
$out=contentSetData($out,$Item);
$out=setSelects($out);
return $out;
}

function setSelects($out) {
$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_person_list&orgId=".$_SESSION["orgId"];
$persons=json_decode(file_get_contents($url),true);
foreach($persons as $key => $Person) {
	$opt="<option value=\"$Person[id]\">$Person[lastName] $Person[firstName] $Person[patrName]</option>";
	$out->find("#Hirurg select[name^=person] option:last")->after($opt);
	$out->find("#Time select[name^=person] option:last")->after($opt);
}

$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_oper_list&orgId=".$_SESSION["orgId"];
$operations=json_decode(file_get_contents($url),true);
foreach($operations as $key => $Oper) {
	$opt="<option value=\"$Oper[id]\">$Oper[name]</option>";
	$out->find("#Podr select[name^=actionType_id] option:last")->after($opt);
	$out->find("#Hirurg select[name^=actionType_id] option:last")->after($opt);
	$out->find("#Time select[name^=actionType_id] option:last")->after($opt);
} 

$url="http://".$_SERVER["HTTP_HOST"]."/json/operation.php?mode=nazn_orgstr_list&orgId=".$_SESSION["orgId"];
$structures=json_decode(file_get_contents($url),true);
foreach($structures as $key => $OrgStr) {
	$opt="<option value=\"$OrgStr[id]\">$OrgStr[code] ($OrgStr[name])</option>";
	$out->find("#Podr select[name^=orgStr] option:last")->after($opt);
} 

return $out;
}
?>
