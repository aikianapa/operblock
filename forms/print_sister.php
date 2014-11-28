<div class="print_page">
<h2>Список операций отделения<br />
на {{date}}</h2>
<p class="center">"{{name}}"</p>
<table>
<thead><tr><th>№ п/п</th><th>Дата операции</th><th>ФИО,<br />Возраст,<br />№ ИБ,<br />гр.крови<br />Дата поступления</th><th>Анализы  крови на  анти-HCV,<br />анти-HBsAg, Ф-50, RW</th><th>Диагноз</th><th>Операция</th><th>Хирург</th><th>Палата</th></tr></thead>
<tbody>
<div data-role="foreach" from="result">
<tr class="status-{{status}}" date="{{begDate}}">
<td>{{counter}}</td>
<td>{{begDate}}</td>
<td>{{client}},<br >возраст: {{age}},<br />ИБ №{{externalId}}<br />{{blood}}<br />{{client_begDate}}<</td>
<td>{{analisys}}</td>
<td>{{diagnose}}</td>
<td>{{specifiedName}}</td>
<td>{{hirurg}}</td>
<td>{{palata}}</td>
</tr></div>
</tbody></table>
</div>
<link rel="stylesheet" href="/style.css" />
<script language="javascript">
	print();
</script>
