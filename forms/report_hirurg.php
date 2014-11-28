<div class="print_page">
<h3>Отчёт по хирургам<br> с {{begDate}} по {{endDate}}</h3>
<table>
<div data-role="foreach" from="result">
<tr oid="{{person_id}}" class="action" urg="{{isUrgent}}" type="{{actionType_id}}">
<td>{{actionType}}</td>
<td class="count">{{count}}</td>
<td class="details">{{externalId}}</td>
<td class="details person">{{person}}</td>
<td class="details">{{problem}}</td>
</tr>
</div>
<div data-role="foreach" from="org">
<tr oid="{{oid}}" class="oid"><td colspan="4">{{name}}</td></tr>
<div oid="{{oid}}" class="otd">
<tr oid="{{oid}}" class="urgent"><td colspan="4">Срочно</td></tr>
<div oid="{{oid}}" class="urgent"></div>
<tr class="total"><td>Итого срочно</td><td class="count" colspan="3">0</td></tr>
<tr oid="{{oid}}" class="planed"><td colspan="4">Планово</td></tr>
<div oid="{{oid}}" class="planed"></div>
<tr class="total"><td>Итого планово</td><td class="count" colspan="3">0</td></tr>
</div>
<tr class="total"><td>Итого по хирургу - {{name}}</td><td class="count" colspan="3">0</td></tr>
</div>
<tr><td colspan="4">&nbsp;</td></tr>
<tr class="total_urg"><td>Итого срочно по всем хирургам</td><td class="count" colspan="3">0</td></tr>
<tr class="total_pln"><td>Итого планово по всем хирургам</td><td class="count" colspan="3">0</td></tr>
<tr class="total_otd"><td>Итого по всем хирургам</td><td class="count" colspan="3">0</td></tr>
</table>
</div>
<link rel="stylesheet" href="/style.css" />
<style>
table {width:95%;}
tr.oid {background:#ccc;}
tr.urgent {font-weight: bold; background:#ddd; text-align: center;}
tr.planed {font-weight: bold; background:#ddd; text-align: center;}
.total, .total_urg, .total_pln, .total_otd {font-weight: bold; background:#ccc;}
tr.oid {font-weight: bold; text-align: center;}
</style>
<script language="javascript">
	print();
</script> 
