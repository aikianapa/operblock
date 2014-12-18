<div data-role="page" data-theme="a" id="morfoNaznEdit" data-ajax="false">
<div data-role="header"><h2>Назначение исследования</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<div data-role="content" >
<form id="morfoNazn">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="client_id">
<input type="hidden" name="person_id">
<input type="hidden" name="actionType_id">
<label><input type="checkbox" data-mini="true" name="isUrgent" >Экстренно</label>
<div data-role="fieldcontain"><label>Планируемая дата</label><input type="datepicker" name="plannedEndDate" required></div>
<div data-role="foreach" from="morfoNazn">
<div ><label>{{label}}</label> 
{{input}}
</div>
</div>
<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
<a href="#" class="list ui-btn ui-btn-inline ui-corner-all">Отмена</a>

</form>
</div>
</div>

<script type="text/javascript">

$(document).on("pageinit",function(){
commonFormWidgets();
morfoNaznSubmit();
});



function morfoNaznSubmit() {
	$("a.submit").on("click",function(){
		var formdata=$("form#morfoNazn").serialize();
		$.post("/json/morfology.php?mode=morfo_nazn_submit",formdata,function(data){
			console.log(data);
				//setTimeout('$.mobile.changePage( "/morfoNazn/list/list.htm", { transition: "flip", changeHash: true });',300);
		});

	});
	$("a.list").on("click",function(){
		var eid=$("form#morfoNazn input[name=event_id]").val();
		setTimeout('$.mobile.changePage( "/morfoNazn/list/list.htm?null=&event_id='+eid+'", { transition: "flip", changeHash: true });',300);
	});
}



</script>
