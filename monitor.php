<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="5" />
</head>
<?

$Work['dbname']="s11";
$Work['dbhost']="localhost:13306";
$Work['dbuser']="dbuser";
$Work['dbpass']="dbpassword";
$db_conn=mysql_connect($Work["dbhost"],$Work["dbuser"],$Work["dbpass"]);
$db=mysql_select_db($Work["dbname"], $db_conn);
mysql_query("SET collation_connection=utf8_general_ci");
mysql_query("SET collation_server=utf8_general_ci");
//mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_server=utf8"); 

$SQL="select 

 DISTINCT
CONCAT(c.lastName, ' ', c.firstName, ' ', c.patrName) AS 'name',
time(a.begDate) AS 'inTime',
kemdostavlen.value AS 'delivery',
diagnaprav.value AS 'diagnaprav',
mesto.value AS 'mesto',
obsled.value AS 'obsled',
diagpriem.value AS 'diagpriem',
status.color AS 'color',
status.code AS 'status',
TIMEdiff(time(NOW()),time(a.begDate)) AS 'longTime'

FROM Event e
INNER JOIN Client AS c
ON e.client_id = c.id
INNER JOIN Action a
ON a.event_id = e.id
INNER JOIN ActionType at
ON a.actionType_id = at.id
INNER JOIN ActionPropertyType apt
ON apt.actionType_id = at.id
INNER JOIN ActionProperty ap
ON ap.action_id = a.id AND ap.type_id = apt.id
LEFT OUTER JOIN ActionProperty_String AS kemdostavlen
ON kemdostavlen.id = ap.id AND apt.name LIKE 'Кем доставлен'
LEFT OUTER JOIN ActionProperty_String AS diagnaprav
ON diagnaprav.id = ap.id AND apt.name LIKE 'Диагноз направителя'
LEFT OUTER JOIN ActionProperty_String AS diagpriem
ON diagpriem.id = ap.id AND apt.name LIKE 'Диагноз приемного отделения'
LEFT OUTER JOIN ActionProperty_String AS mesto 
ON mesto.id = ap.id AND apt.name LIKE 'Место нахождения в ПО'
LEFT OUTER JOIN ActionProperty_String AS obsled
ON obsled.id = ap.id AND apt.name LIKE 'Обследование в ПП'
LEFT OUTER JOIN Client_StatusObservation AS clstatus
ON clstatus.master_id = c.id
LEFT OUTER JOIN rbStatusObservationClientType AS status
ON clstatus.statusObservationType_id = status.id
LEFT OUTER JOIN ActionProperty_OrgStructure AS podr
ON podr.id = ap.id AND apt.name LIKE 'Направлен в отделение'

WHERE at.flatCode LIKE 'received' AND a.endDate IS NULL AND podr.value IS NULL
ORDER BY longTime DESC";

$result = mysql_query($SQL) or die("Query failed: " . mysql_error());
$array=array();
$out="<table border=1><thead><tr>
<th>№ п/п</th>
<th>ФИО пациента</th>
<th>Время обращения</th>
<th>Кем доставлен</th>
<th>Диагноз направления</th>
<th>Место нахождения<br> пациента в ПО</th>
<th>Обследование в ПП</th>
<th>Диагноз приемного отделения</th>
<th>Время нахождения в ПО</th>
</tr></thead><tbody>";
$i=1;
while($data = mysql_fetch_array($result)) {
	$out.="<tr style='background:{$data["color"]};'>";
	$out.="<td class='center'>".$i."</td>";
	$out.="<td>{$data["name"]}</td>";
	$out.="<td class='center'>{$data["inTime"]}</td>";
	$out.="<td>{$data["delivery"]}</td>";
	$out.="<td>{$data["diagnaprav"]}</td>";
	$out.="<td>{$data["mesto"]}</td>";
	$out.="<td>{$data["obsled"]}</td>";
	$out.="<td>{$data["diagpriem"]}</td>";
	$out.="<td class='center'>{$data["longTime"]}</td>";
	$array[]=$data;
	$out.="</tr>";
	$i++;
}
$out.="</tbody></table>";
mysql_free_result($result);
print $out;


function mysqlReadItem($form,$id) {
$Item=FALSE;
$result = mysql_query ("SELECT * FROM $form WHERE id = '$id' LIMIT 1;");
if ($result) { $Item=mysql_fetch_array($result); mysql_free_result($result);}
return $Item;
}
?>
<style>
* {font-size:14px;}
table {border:2px #444 solid; border-spacing:0;}
td,th {border:1px #444 solid; margin:0; padding:3px;}
td.center {text-align: center;}
</style>
</html>
