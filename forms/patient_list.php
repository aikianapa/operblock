<div data-role="page" data-theme="a" id="patientList" data-url="/patient/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">

<div data-role="header"  data-position="fixed">
<h2><a href="/hirurg/list/list.htm" data-ajax="false" class="ui-btn ui-btn-left ui-corner-all">Проведение операции</a>Список пациентов</h2>
<div data-role="fieldcontain" style="padding-left:10px;padding-right:10px;">
<label>Поиск: </label>
<input id="patientSearch" data-type="search"  />
</div>
</div>

<div data-role="content">
<table data-role="table" class="ui-responsive" id="clientlist">
<thead><tr><th>№ ИБ</th><th>Ф.И.О.</th><th>Возраст</th><th>Дата поступления</th><th>Диагноз</th><th>Палата</th><th>t° утро</th><th>t° вечер</th></tr></thead>
<tbody>
<div data-role="foreach" from="result"><tr>
<td><a href="/patient/nazn/{{client_id}}.htm" data-ajax="false">{{externalId}}</a></td>
<td>{{lastName}} {{firstName}} {{patrName}}</td>
<td>{{age}}</td>
<td>{{begDate}}</td>
<td>{{diagnosis}}</td>
<td>{{palata}}</td>
<td>{{temperatureMorning}}</td>
<td>{{temperatureEvening}}</td>

</tr></div>
</tbody></table>
</div>

<div data-role="footer" data-position="fixed"><h2>{{_SETTINGS_footer}}</h2></div>

</div>


<script type="text/javascript">
$(document).ready(function(){
$("div[data-url='/patient/list/list.htm']:hidden").remove();	
});
</script>

<link rel="stylesheet" href="/style.css" />
<style>
#clientlist tr {border-bottom: 1px solid #dddddd;}
#clientlist tr:hover {background: #dddddd; cursor: pointer;}

</style>
