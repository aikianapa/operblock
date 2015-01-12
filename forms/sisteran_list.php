<div data-role="page" data-theme="a" id="sisteranList" data-url="/sisteran/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Анестезиологическая сестра</h2></div>


<div data-role="content" >
<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			  <li><a href="#tab-1" data-ajax="false" class="ui-btn-active">Назначенные операции</a></li>
			   <li><a href="#tab-3" data-ajax="false">Календарь</a></li>
		</ul></div>

		<div id="tab-1" class="ui-body-d ui-content">
		<div data-role="fieldcontain"><label>Рабочая дата</label><input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div>
		<input type="hidden" name="person_id">
		
    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="display: inline-block;">
        <legend>Состояние:</legend>
        <input type="radio" name="status" id="status-all" value="all" checked="checked">
        <label for="status-all">Все операции</label>
        <input type="radio" name="status" id="status-on" value="on">
        <label for="status-on">Назначеные</label>
        <input type="radio" name="status" id="status-off" value="off">
        <label for="status-off">Выполненные</label>
    </fieldset>

    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="display: inline-block;">
        <legend>Списание:</legend>
        <input type="radio" name="spisan" id="spisan-all" value="all" checked="checked">
        <label for="spisan-all">Все операции</label>
        <input type="radio" name="spisan" id="spisan-on" value="on">
        <label for="spisan-on">Произведено</label>
        <input type="radio" name="spisan" id="spisan-off" value="off">
        <label for="spisan-off">Не произведено</label>
    </fieldset>
		
		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.</th><th>Операция</th><th>Дата операции</th><th>Диагноз</th><th>Врач</th><th>Палата</th><th>&nbsp;</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}" sid="{{spisanie_an}}">
		<td>{{externalId}}</td>
		<td>{{client}} ({{age}} лет)</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td>{{diagnose}}</td>
		<td>{{person}}</td>
		<td>{{palata}}</td>
		<td><a href="#printMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Печать</a></td>
		</tr></div>
		</tbody></table>


	<div data-role="popup" id="printMenu" data-theme="a">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="" data="/json/print_forms.php?mode=spisanie_1&role=an"  target="_blank">Списание (без цен)</a></li>
            <!--li><a href="/json/print_forms.php?mode=spisanie_2"  target="_blank" >Списание (с ценами)</a></li-->
        </ul>
	</div>
	</div>
	<div id="tab-3" class="ui-body-d ui-content">
	<div data-role="header"><h3>Операционный календарь</h3></div>
		<div id="calendar"></div>
	</div>

</div>

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
$("div[data-url^='/sisteran/list/list.htm']:hidden").remove();
sisteran_get_calendar();
});


$(document).on("pageinit",function(){
$( "table" ).disableSelection();

$('input[type=datetime]').datetimepicker({
	lang:'ru', format:'Y-m-d', formatDate:'Y-m-d', timepicker:false
});

	$("a[href=#printMenu]").on("click",function(){ 
    $( document ).data( "action", $(this).parents("tr").attr("aid")); 
    var sid = $(this).parents("tr").attr("sid");
		if (sid=="") {
			$("#printMenu a").parents("li").addClass("ui-disabled"); 
		} else {
			$("#printMenu a").parents("li").removeClass("ui-disabled");  
		}
  });
	$("#printMenu a").on("click",function(){
		$(this).attr("href",$(this).attr("data")+"&action="+$( document ).data( "action"));
	});
	
		var page=$("#sisteranList");
		page.find("#sisteranSpis").dialog();
		zaved_nazn_submit();
		page.find("#clientlist tbody tr, #tables ul li").on("dblclick",function(){
       if ($(this).hasClass("status-1") || $(this).hasClass("status-2")  || $(this).hasClass("status-4") ) {
      if ($(this).hasClass("sid")) {
				footer_notify("Списание уже было произведено","error");
			} else {
				$.mobile.loading( "show",{
				text: 'Подождите, идёт доступ к базе данных 1С.',
				textVisible: true
				} ); 
				var aid=$(this).attr("aid");
				document.location.href="/sisteran/spisanie/"+aid+".htm";
			}
      } else {
        footer_notify("Только для завершённых операций!","error");
      }
		});
		
	page.find("#clientlist tbody tr").each(function(){
			var sid=$(this).attr("sid");
			if (sid>0) {$(this).addClass("sid");}
	});

	page.find("input[name=spisan],input[name=status]").on("change",function(){
		var spisan=page.find("input[name=spisan]:checked").val();
		var status=page.find("input[name=status]:checked").val();
		page.find("#clientlist tbody tr").each(function(){
			$(this).addClass("ui-hidden");
			$(this).addClass("ui-hidden-1");
			console.log("spisan:"+spisan+" status:"+status);
			if (spisan=="all" && status=="all" ) {$(this).removeClass("ui-hidden");}
			if (spisan=="on" && $(this).hasClass("sid")) {$(this).removeClass("ui-hidden");}
			if (spisan=="off" && !$(this).hasClass("sid")) {$(this).removeClass("ui-hidden");}
			if (status=="all" && status=="all" ) {$(this).removeClass("ui-hidden-1");}
			if (status=="on" && !$(this).hasClass("status-2")) {$(this).removeClass("ui-hidden-1");}
			if (status=="off" && $(this).hasClass("status-2")) {$(this).removeClass("ui-hidden-1");} 
		});
	});

		
});

function sisteran_get_calendar() {
var person_id=$("#SisteranList input[name=person_id]").val();
var workDate=$("#SisteranList input[name=workDate]").val();
$.get("/forms/calendar.php?sisteran_id="+person_id+"&date="+workDate,function(data){ 
	$("#SisteranList  #calendar").html(data);
	var head1=$("#tab-3 h3").html();
	var head2=$("#calendar h2:first-child").html();
	$("#calendar h2:first-child").remove();
	$("#tab-3 h3").html(head1+" ("+head2+")");
});
}

function zaved_nazn_submit() {
$( "#sisteranSpis form a.submit" ).on( "click", function(  ) {
	if (checkRequired($( "#sisteranSpis form"))) {
	var formdata=$("#sisteranSpis form").serialize() ;
	$.post("/json/operation.php?mode=sisteranSpis_oper_submit",formdata,function(data){
//		var data=jQuery.parseJSON(data);
//		if (data.error==0) {
//			$("#patientNazn #patient_epicriz_form input[name=action_id]").val(data.id);
//			$("#patientNazn #operation").popup("close");
		footer_notify("Операция назначена","success");
		setTimeout(function(){ $("a.cancel").trigger("click"); },1000);
		
//		}
	});
	} else { 
		footer_notify("Не заполнены обязательные поля","error");	
	} 
});
}



</script>

<link rel="stylesheet" href="/style.css" />
<style>
#sisteranSpis {width:100%;}
#sisteranSpis form {padding:10px; }
#sisteranList tr.sid {border-left:3px #b30000 solid;}
</style>
