<div id="sisteranSpis" data-theme="a" data-role="page"  data-ajax="false" >
<div data-role="header"><h1>Списание расходных материалов (Анестезиологическая медсестра)</h1></div>
<div data-role="content">
<table data-role="table" class="ui-responsive" id="client">
</table>
<form>
<input type="hidden" name="action_id">
<input type="hidden" name="person_id">
<div class="ui-widget">
		<!--div data-role="fieldcontain"><label>Дата</label><input type="datepicker" name="dateTime" required></div-->
 		<div data-role="fieldcontain"><label>Поиск</label><input id="filterTable-input" data-type="search"></div>
		<table data-role="table" class="ui-responsive" id="druglist" data-filter="true" data-input="#filterTable-input">
		<thead><tr><th>№</th><th>Наименование</th><th>Количество</th><th>Ед.</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="drugs">
		<tr did="{{drug_id}}">
		<td class="counter"></td>
		<td>{{drugName}}</td>
		<td><input type="number" data-inline="true" name="drugs[{{drug_id}}]" value="{{quantity}}" ></td>
		<td>{{unitName}}</td>
		</tr>
		</div>
		</tbody></table>
</div>
</form>
</div>
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
&nbsp;<a href="#" data-rel="back" class="cancel ui-btn ui-btn-inline ui-corner-all">Вернуться</a>
<a href="" class="submit ui-btn ui-btn-inline ui-corner-all">Списать расходные материалы</a>
</div>
</div>


<script language="javascript">
$(document).ready(function(){
	
});
$(document).on("pageinit",function(){
	$("#sisteranSpis .submit").on("click",function() { return sisteran_submit(); });
	$("#druglist td.counter").each(function(i){ $(this).html(i+1); });
	  $( "table" ).disableSelection();
});

function sisteran_submit() {
	if (checkRequired($( "#sisteranSpis form"))) {
	var formdata=$("#sisteranSpis form").serialize() ;
	$.mobile.loading( "show",{
		text: 'Подождите, идёт выполнение списания.',
		textVisible: true
	} ); 
	$.post("/json/operation.php?mode=sisteran_spisanie_submit",formdata,function(data){
		var data=$.parseJSON(data);
		if (data.error==0) {
			footer_notify("Списание завершено","success");
			setTimeout(function(){ $("a.cancel").trigger("click"); },1000);
		} else 
			footer_notify("Списание выполнено с ошибками","error");
		
	});
	} else { 
		footer_notify("Не заполнены обязательные поля","error");
		return false;
	} 
}
</script>


<style>
tr  {border-bottom: 1px solid #dddddd;}
tr:hover {background: #dddddd; cursor: pointer;}
</style>
