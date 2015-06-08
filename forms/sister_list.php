<div data-role="page" data-theme="a" id="sisterList" data-url="/sister/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Медсестра по отделению</h2></div>


<div data-role="content" >

<input type="hidden" name="orgStr_id">
<input type="hidden" name="person_id">

<a href="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-bars ui-btn-icon-left ui-btn-b ui-hidden print_all" target="_blank" data="1">Печать...</a>
<a href="#print_menu" data-rel="popup" class="print ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-bars ui-btn-icon-left ui-btn-b" data-transition="pop">Печать...</a>
<!--div data-role="popup" id="print_menu" data-theme="none">
	<ul data-role="listview" data-inset="true" style="min-width:210px;">
		<li data-role="list-divider">Печать</li>
		<li><a href="" target="_blank" data="1">На два дня</a></li>
		<li><a href="" target="_blank" data="2">На сегодня</a></li>
		<li><a href="" target="_blank" data="3">На завтра</a></li>
	</ul>
</div-->

<div class="filter">
Статус
    <select id="filter" name="filter" data-inline="true" data-native-menu="false">
        <option value="" data-placeholder="true">Выберите</option> 
        <option value="">Все</option> 
        <option value="0">Назначена</option>
        <option value="4">Утверждена отд.</option>
        <option value="1">Утверждена зам.</option>
        <option value="2">Проведена</option>
        <option value="3">Отменена</option>
    </select>
    
</div>
<div  style="display:inline;font-weight:bold;margin-left:20px; "> Рабочая дата <div style="display:inline-block">
<input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div></div>

<div  style="display:inline;font-weight:bold;margin-left:20px; "> до <div style="display:inline-block">
<input type="datepicker" data-role="date" data-inline="true" name="endDate" data-clear-btn="true"></div></div>

<div id="reportBody">

<div data-role="foreach" from="result">
<div id="{{date}}" class='day'>
	<div data-role="header"><h2>{{day}}</h2></div>
</div>
</div>


<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			  <li><a href="#tab-1" data-ajax="false" class="ui-btn-active">Операции на сегодня {{date1}}</a></li>
			  <li><a href="#tab-2" data-ajax="false">Операции на завтра <span class="nextday">{{date2}}</span></a></li>
		</ul></div>

<div id="tab-1" class="ui-body-d ui-content">
<table data-role="table" class="ui-responsive" id="clientlist">
<thead><tr><th>№ п/п</th><th>Пациент,<br />Гр.крови<br />Дата пост.</th><th>Палата</th><th>Анализы  крови на  анти-HCV,<br />анти-HBsAg, Ф-50, RW</th>
<th>Диагноз</th><th>Операция</th><th>Хирург</th></tr></thead>
<tbody>
<div data-role="foreach" from="result1">
<tr class="status-{{status}}" date="{{begDate}}" tid='{{table}}' oid='{{orgid}}' orgStr='{{orgStr_id}}'>
<td>{{counter}}</td>
<td>{{client}},<br >возраст: {{age}},<br />ИБ №{{externalId}}<br />{{blood}}<br />{{client_begDate}}</td>
<td>{{palata}}</td>
<td>{{analisys}}</td>
<td>{{diagnose}}</td>
<td>{{specifiedName}}</td>
<td>{{person}}</td>
</tr></div>
</tbody></table>
</div>

<div id="tab-2" class="ui-body-d ui-content">
<table data-role="table" class="ui-responsive" id="clientlist1">
<thead></thead>
<tbody></tbody>
</table>
</div>
</div>
</div>
</div>




<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>

<div id="report"></div>

<script language="javascript">
	$(document).on("pageinit",function(){
		var nday=$("#sisterList span.nextday").html();
		if ($("#sisterList input[name=endDate]").val()>"") {$("#sisterList .ui-navbar").hide();}
		$("#sisterList #tab-2 table thead").html($("#sisterList #tab-1 table thead").html());
		$("#sisterList #tab-2 table tbody").append("");
		$("#sisterList #tab-1 table tbody tr").each(function(i){
			if ($(this).attr("date")==nday)	{$("#sisterList #tab-2 table tbody").append($(this));}
		});
		$("#sisterList #tab-1 table tbody tr").each(function(i){ 	$(this).find("td:first").html(i+1);});
		$("#sisterList #tab-2 table tbody tr").each(function(i){	$(this).find("td:first").html(i+1); });
		
		$("#sisterList #filter").on("change",function(){
			if ($(this).val()>"") {
				$("#sisterList tbody tr").hide();
				$("#sisterList tbody tr.status-"+$(this).val()).show();
			} else {$("#sisterList tbody tr").show();};
			after_filter_check();
		});

	
		$(".print, #print_menu ul li a, a.print_all").on("click",function(){
			print_report();
			/*
			var sid=$("#sisterList input[name=orgStr_id]").val();
			var ftr=$("#sisterList [name=filter]").val();
			var date=$("#sisterList [name=workDate]").val();
			var enddate=$("#sisterList [name=endDate]").val();
			var link="/json/print_forms.php?mode=sister&sid="+sid+"&date="+date+"&enddate="+enddate+"&filter="+ftr+"&var="+$(this).attr("data");
			$("#print_menu").popup("close");
			$(this).attr("href",link);
			*/
		});


		$("#sisterList input[name=endDate]").on("change",function(){
			set_cookie("endDate",$(this).val());
			$("#sisterList input[name=workDate]").trigger("change");
		});
		
	});

function after_filter_check() {
	$("table").show();
	$("div[tid]").show();
	$("div[opr]").show();
	$("div.day").show();
	$("table").each(function(){
		if ($(this).find("tbody").find("tr:visible").length==0) {$(this).hide();}
	});
	$("div.day,div[opr],div[tid],div[oid=free]").each(function(){
		if ($(this).find("table:visible").length==0) {$(this).hide();}
	});
	
	
}

function print_report() {
	$("#report").html($("#reportBody").html());
	
	print("#reportBody");
}
</script>
<link rel="stylesheet" href="/style.css" />
<style>
@media screen {
.filter {display:inline; width: 250px; font-weight: bold;} 
#report {display:none;}
}

@media print {
#sisterList {display:none;}
#reportBody {display:block;}
div {background-color: #fff;}
div.day {border: 2px #555 solid; padding:5px; margin-bottom:20px;}
div.day div.ui-header {background: #ccc; color: #000;}
div.day > div.ui-header:first-child {background: #333; color: #fff;}
div[data-role=content] {padding:3px; margin-bottom:10px;}
div[data-role=content][opr] {border:1px solid #ccc;}
}
</style>
