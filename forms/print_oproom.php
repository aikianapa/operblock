<div class="print_page">
<h2>Список операций: {{oper}}</h2>
<p class="right">Дата {{doc_date}}г.</p>

<table border="1">
<tr>
<th>№ п/п</th>
<th>Стол №</th>
<th>ФИО, Дата рождения (возраст), № ИБ,  Дата поступления в  стационар</th>
<th>Анализы  крови на  анти-HCV, анти-HBsAg, Ф-50, RW</th>
<th>Диагноз</th>
<th>Операция</th>
<th>Хирург + Операцион-ная бригада </th>
<th>Группа крови, Переливание планируется</th>
<th>Наркоз</th>
<th>Дежурный по операционной</th>
<th>Ответственный  за  переливание  крови</th>
</tr>
<div data-role="foreach" from="actions">
<tr>
<td class="center">{{count}}</td>
<td>{{table}}</td>
<td>{{client}}<br />({{age}} лет)<br />ИБ № {{externalId}}<br />{{client_begDate}}</td>
<td class="center">{{analyse}}</td>
<td class="center">{{diagnose}}</td>
<td class="center">{{operation}}</td>
<td class="center"><b>{{person}}</b><br />{{brigada}}</td>
<td class="center">{{blood}}<br />{{hemotrans}}</td>
<td class="center">{{narkoz}}</td>
<td class="center">{{dejurny}}</td>
<td class="center">{{bloodmen}}</td>
</tr>
</div>
</table>

<div><br />Операционная медсестра __________________ /<span class="person">{{oper_sister}}</span>/</div>
<div><br />Санитарка __________________ /<span class="person">{{sanitar}}</span>/</div>
<div><br />Анестезиологическая медсестра __________________ /<span class="person">{{anest_sister}}</span>/</div>
<div><br />Анестезиолог __________________ /<span class="person">{{anest}}</span>/</div>
<br />
<br />Комментарии: <br />
<div data-role="foreach" from="notes">
	<p><b>{{count}}) Для операции пациента {{client}} понадобится:</b> {{note}}<br /></p>
</div>
</div>
<link rel="stylesheet" href="/style.css" />
<script language="javascript">
	print();
</script>
