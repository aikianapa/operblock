<div data-role="page" data-theme="a" id="morfoRegList" data-url="/morfoReg/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Регистрация биоматериала</h2></div>


<div data-role="content" >

<div>
<div  style="display:inline;font-weight:bold;margin-left:20px; "> Рабочая дата <div style="display:inline-block">
<input type="datepicker" data-role="date" data-mini="true"  required name="workDate"></div></div>

<div  style="display:inline;font-weight:bold;margin-left:20px; "> до <div style="display:inline-block">
<input type="datepicker" data-role="date" data-mini="true" name="endDate" data-clear-btn="true"></div></div>
</div>
<input type="hidden" name="person_id">


    <fieldset data-role="controlgroup" data-type="horizontal"  style="display: inline-block;">
        <legend>Состояние:</legend>
        <input type="radio" name="status" id="status-all" value="all" checked="checked">
        <label for="status-all">Все</label>
        <input type="radio" name="status" id="status-on" value="on">
        <label for="status-on">Назначеные</label>
        <input type="radio" name="status" id="status-off" value="off">
        <label for="status-off">Выполненные</label>
    </fieldset>
    <input id="filterTable-input" data-type="search" style="display: inline-block;">
		<table data-role="table" data-filter="true" data-input="#filterTable-input" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.&nbsp;пациента</th><th>Отделение</th><th>Исследование</th><th>Дата назначения</th><th>Врач</th><th>&nbsp;</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}" sid="{{spisanie_an}}">
		<td>{{externalId}}</td>
		<td>{{client}}<br />({{age}} лет)</td>
		<td>{{orgStrShort}}</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td>{{person}}</td>
		<td><a href="#printMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Печать</a></td>
		</tr></div>
		</tbody></table>

	<div data-role="popup" id="printMenu" data-theme="a">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="" data-transition="flip">Регистрация</a></li>
            <li><a href="" data="/json/print_forms.php?mode="  target="_blank">Печать</a></li>
        </ul>
	</div>


<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<script type="text/javascript">
	
$(document).ready(function(){
$("div[data-url^='/morfoReg/list/list.htm']:hidden").remove();
});

$(document).on("pageshow",function(){
	commonFormWidgets();
});

$("#morfoRegList").on("pageshow",function(){
	morfoStatus("#clientlist");
});

$(document).on("pageinit",function(){
morfoRegSubmit();
$( "table" ).disableSelection();

$('input[type=datetime]').datetimepicker({
	lang:'ru', format:'Y-m-d', formatDate:'Y-m-d', timepicker:false
});

		$("input[name=endDate]").on("change",function(){
			set_cookie("endDate",$(this).val());
			$("input[name=workDate]").trigger("change");
		});

	$("a[href=#printMenu]").on("click",function(){ 
    $( document ).data( "action", $(this).parents("tr").attr("aid")); 
    var sid = $(this).parents("tr").attr("sid");
		if (sid=="") {
//			$("#printMenu a").parents("li").addClass("ui-disabled"); 
		} else {
//			$("#printMenu a").parents("li").removeClass("ui-disabled");  
		}
  });
	$("#printMenu a").on("click",function(){
		if ($(this).attr("data")>"") {
			$(this).attr("href",$(this).attr("data")+"&action="+$( document ).data( "action"));
		} else {
			$(this).attr("href","/morfoReg/edit/"+$( document ).data("action")+".htm");
		}
	});
	
	var page=$("#morfoRegList");
	page.find("input[name=status]").on("change",function(){
		var status=page.find("input[name=status]:checked").val();
		page.find("#clientlist tbody tr").each(function(){
			$(this).addClass("ui-hidden");
			if (status=="all") {$(this).removeClass("ui-hidden");}
			if (status=="on" && !$(this).hasClass("status-2")) {$(this).removeClass("ui-hidden");}
			if (status=="off" && $(this).hasClass("status-2")) {$(this).removeClass("ui-hidden");} 
		});
	});

		
});


function morfoRegSubmit() {
	$("a.submit").on("click",function(){
		var formdata=$("form#morfoReg").serialize();
		$.post("/json/morfology.php?mode=morfo_reg_submit",formdata,function(data){
				setTimeout('$.mobile.changePage( "/morfoReg/list/list.htm", { transition: "flip", changeHash: true });',300);
		});

	});
	$("a.list").on("click",function(){
		var eid=$("form#morfoReg input[name=event_id]").val();
		setTimeout('$.mobile.changePage( "/morfoReg/list/list.htm", { transition: "flip", changeHash: true });',300);
	});
}



</script>

<link rel="stylesheet" href="/style.css" />

