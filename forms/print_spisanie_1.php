<div class="print_page">
<h2>СПИСАНИЕ</h2>
Ф.И.О. пациента <u>{{client}}</u><br />
№ истории болезни <u>{{externalId}}</u><br />
Отделение <u>{{orgStructure}}</u><br />
Дата {{endDate}} , Время операции {{opertime}}<br />
Название операции <u>{{operation}}</u>
<h2>ОПЕРБЛОК</h2>
<table>
<tr><th>№ п/п	</th><th>Код, торговое название</th><th>Ед. изм.</th><th>Количество</th></tr>
<div data-role="foreach" from="drugs">
<tr>
<td class="center">{{count}}</td>
<td>{{drugName}}</td>
<td class="center">{{unitName}}</td>
<td class="center">{{qnt}}</td>
</tr>
</div>
</table>
</div>

<link rel="stylesheet" href="/style.css" />
<script language="javascript">
	print();
</script>
