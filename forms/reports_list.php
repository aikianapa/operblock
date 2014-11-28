<div data-role="page" id="Reports" data-url="/reports/list/list.htm?null=&person_id={{person_id}}">
<div data-role="header"><h2>Отчёты по опреблоку</h2></div>
<div data-role="content">
<a href="/mainsister/list/list.htm?null=&person_id={{person_id}}" data-ajax="false" data-mini="true" class="ui-btn">Перейти к операциям</a>
<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			  <li><a href="#tab-1" data-ajax="false" class="ui-btn-active">По подразделениям</a></li>
			  <li><a href="#tab-2" data-ajax="false">По хирургу</a></li>
			  <li><a href="#tab-3" data-ajax="false">По длительности</a></li>
		</ul></div>
	<div id="tab-1">
	<form id="Podr" data-rel="orgstr">
		<div data-role="fieldcontain"><label>Период c</label><input type="datepicker"  data-mini="true" required name="begDate"></div>
		<div data-role="fieldcontain"><label>по</label><input type="datepicker"  data-mini="true" name="endDate"> </div>
		<div data-role="fieldcontain"><label>Тип операции</label>
		<select  data-mini="true" name="actionType_id[]" multiple data-native-menu="false"><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Подразделение</label>
		<select  data-mini="true" name="orgStr[]" multiple data-native-menu="false" ><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Срочно</label><input type="checkbox"  data-mini="true" value="0" name="urgent"></div> 
		<div data-role="fieldcontain"><label>Планово</label><input type="checkbox"  data-mini="true" value="0" name="planed"></div>
		<div data-role="fieldcontain"><label>Осложнение</label><input type="checkbox"  data-mini="true" value="0" name="problem"></div>
		<div data-role="fieldcontain"><label>Детализация</label><input type="checkbox"  data-mini="true" value="0" name="details"></div>
		<a href="#report" data-role="button" data-inline="true">Построить отчёт</a>
	</form>
	</div>
	<div id="tab-2">
	<form id="Hirurg" data-rel="hirurg">
		<div data-role="fieldcontain"><label>Период c</label><input type="datepicker"  data-mini="true" required name="begDate"></div>
		<div data-role="fieldcontain"><label>по</label><input type="datepicker"  data-mini="true" name="endDate"> </div>
		<div data-role="fieldcontain"><label>Ф.И.О. хирурга</label>
		<select  data-mini="true" name="person[]" multiple data-native-menu="false" ><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Тип операции</label>
		<select  data-mini="true" name="actionType_id[]" multiple data-native-menu="false"><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Срочно</label><input type="checkbox"  data-mini="true" value="0" name="urgent"></div> 
		<div data-role="fieldcontain"><label>Планово</label><input type="checkbox"  data-mini="true" value="0" name="planed"></div>
		<div data-role="fieldcontain"><label>Осложнение</label><input type="checkbox"  data-mini="true" value="0" name="problem"></div>
		<div data-role="fieldcontain"><label>Детализация</label><input type="checkbox"  data-mini="true" value="0" name="details"></div>			<a href="#report" data-role="button" data-inline="true">Построить отчёт</a>
	</form>
	</div>
	<div id="tab-3">
	<form id="Time"  data-rel="time"> 
		<div data-role="fieldcontain"><label>Период c</label><input type="datepicker"  data-mini="true" required name="begDate"></div>
		<div data-role="fieldcontain"><label>по</label><input type="datepicker"  data-mini="true" name="endDate"> </div>
		<div data-role="fieldcontain"><label>Длительность от</label><input type="time"  data-mini="true" required name="begTime"></div> 
		<div data-role="fieldcontain"><label>до</label><input type="time"  data-mini="true" name="endTime"> </div>
		<div data-role="fieldcontain"><label>Ф.И.О. хирурга</label>
		<select  data-mini="true" name="person[]" multiple data-native-menu="false" ><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Тип операции</label>
		<select  data-mini="true" name="actionType_id[]" multiple data-native-menu="false" ><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Срочно</label><input type="checkbox"  data-mini="true" value="0" name="urgent"></div> 
		<div data-role="fieldcontain"><label>Планово</label><input type="checkbox"  data-mini="true" value="0" name="planed"></div>
		<div data-role="fieldcontain"><label>Осложнение</label><input type="checkbox"  data-mini="true" value="0" name="problem"></div>
		<a href="#report" data-role="button" data-inline="true">Построить отчёт</a>
	</form>
	</div>
	</div>
</div>
<div id="report"></div>
</div>
<style>
.ui-dialog-contain {max-width:90%;}
@media print
{
	#Reports div[data-role] { display: none; }
   	#Reports #report { display: block; }
}
</style>

<script language="javascript">
$(document).ready(function(){
$("div[data-url^='/reports/list/list.htm']:hidden").remove();
});
$("a[href=#report]").on("click",function(){
	var data=$(this).parent("form").serialize();
	$.post("/json/print_forms.php?mode=report_"+$(this).parent("form").attr("data-rel"),data,function(data){
		 $("#report").html(data);
	});
});
</script>
