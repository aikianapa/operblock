<div data-role="page" data-theme="a" id="hirurgList" data-url="/hirurg/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Хирург. Проведение операции.</h2></div>
<div data-role="content" >
<a href="" class="uniprint ui-hidden" target="_blank">Печать</a> 
<div data-role="fieldcontain"><label>Рабочая дата</label><input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div>
		<h2>Список назначеных операций</h2>
		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.</th><th>Операция</th><th>Дата операции</th><th>Диагноз</th><th>Врач</th><th>Палата</th><th></th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}">
		<td>{{externalId}}</td>
		<td>{{client}} ({{age}} лет)</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td>{{diagnose}}</td>
		<td>{{person}}</td>
		<td>{{palata}}</td>
		<td><a href="#hirurgMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Меню</a></td>
		</tr></div>
		</tbody></table>
<div data-role="popup" id="hirurgMenu">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#operation">Редактировать</a></li>
            <li><a href="" data="/json/print_forms.php?mode=protocol" class="print" target="_blank">Печать протокола</a></li>
        </ul>
</div>
</div>

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<div data-role="include" src="/forms/hirurg_operation.php"></div> 

<script type="text/javascript">
$(document).ready(function(){ 
$("div[data-url^='/hirurg/list/list.htm']:hidden").remove();
operation_list_action();
}); 

$(document).on("pageinit",function(){
		$( "table" ).disableSelection();	

		 
});

function hirurg_form_show(aid) {
	$("#hirurgOperation").find("form")[0].reset();
	$("#hirurgOperation").find("input[name=action_id]").val(aid);
	// ============ Читаем данные в форму ==========
	$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+aid,function(data){
			var data = JSON.parse(data);
			if (data.operation!=null) {
			$.each(data.operation, function(key, value) {
					$("#hirurgOperation [name="+key+"]").val(value);
					$("#hirurgOperation [multiple][name^="+key+"]").val(value);
			});
			}
			$("#hirurgOperation").find("select").trigger("change");
	});
	// =======================================
	setTimeout('$.mobile.changePage( "#hirurgOperation", { transition: "slideup", changeHash: true });',300);
}

function hirurg_operation_submit() {
	if (checkRequired($( "#hirurgOperation form#operation"))) {
	var formdata=$("#hirurgOperation form#operation").serialize() ;
	$.post("/json/operation.php?mode=hirurg_oper_submit",formdata,function(data){
		var data=$.parseJSON(data);
		if (data.error==0) {
			footer_notify("Операция завершена","success");
			$.mobile.back();
			setTimeout(function(){document.location.href=document.location.href;},500);
		}
	});
	} else { 
		footer_notify("Не заполнены обязательные поля","error");
		return false;
	} 
}

function operation_list_action() {

		$("#clientlist tbody tr").on("dblclick",function(){
			hirurg_form_show($(this).attr("aid"));
		});
		
		$("#hirurgOperation .submit").on("click",function(){
				return hirurg_operation_submit();
		});
	
	$("a[href=#hirurgMenu]").on("click",function(){ 
		var aid= $(this).parents("tr").attr("aid");
		$("#hirurgOperation").data( "action",aid); 
		$("#hirurgMenu a.print").attr("href",$("#hirurgList a.print").attr("data")+"&action="+aid); 
	});
	
	
	$("#hirurgMenu a").on("click",function(){
			$("#hirurgMenu").popup("close");
			var href=$(this).attr("href");
			if (href=="#operation") { 
				hirurg_form_show($("#hirurgOperation").data( "action")); 
				return false; 
			} 
		
	});
}


</script>

<link rel="stylesheet" href="/style.css" />
<style>
#sisterobSpis {width:100%;}
#sisterobSpis form {padding:10px; }
</style>
