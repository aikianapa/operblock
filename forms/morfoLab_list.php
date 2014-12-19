<div data-role="page" data-theme="a" id="morfoLabList" data-url="/morfoLab/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Проведение исследований</h2></div>


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

		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.&nbsp;пациента</th><th>Исследование</th><th>Дата назначения</th><th>Врач</th><th>&nbsp;</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}" sid="{{spisanie_an}}">
		<td>{{externalId}}</td>
		<td>{{client}}<br />({{age}} лет)</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td>{{person}}</td>
		<td><a href="#printMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Печать</a></td>
		</tr></div>
		</tbody></table>

	<div data-role="popup" id="printMenu" data-theme="a">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#nazn" data-transition="flip">Назначение</a></li>
            <li><a href="#reg" data-transition="flip">Регистрация</a></li>
            <li><a href="#lab" data-transition="flip">Исследование</a></li>
            <li><a href="" data="/json/print_forms.php?mode=morfoNazn"  target="_blank">Печать</a></li>
        </ul>
	</div>


<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<script type="text/javascript">
	
$(document).ready(function(){
$("div[data-url^='/morfoLab/list/list.htm']:hidden").remove();
	$("a[href=#printMenu]").on("click",function(){ 
		$( document ).data( "action", $(this).parents("tr").attr("aid")); 
	});
	$("#printMenu a").on("click",function(){
		if ($(this).attr("data")>"") {
			$(this).attr("href",$(this).attr("data")+"&action="+$( document ).data( "action"));
		} else {
			if ($(this).attr("href")=="#nazn") {var form="morfoNazn";}
			if ($(this).attr("href")=="#reg") {var form="morfoReg";}
			if ($(this).attr("href")=="#lab") {var form="morfoLab";}
			
			$.mobile.changePage( "/"+form+"/edit/"+$( document ).data("action")+".htm", { transition: "flip", changeHash: true });
		}
		$("#printMenu").popup("close");
	});
});

$(document).on("pageshow",function(){
	commonFormWidgets();
});

$("#morfoLabList").on("pageshow",function(){
	morfoStatus("#clientlist");
});

$(document).on("pageinit",function(){
morfoLabSubmit();
cancel_op_init();
$( "table" ).disableSelection();

$('input[type=datetime]').datetimepicker({
	lang:'ru', format:'Y-m-d', formatDate:'Y-m-d', timepicker:false
});

	var page=$("#morfoLabList");
	page.find("input[name=status]").on("change",function(){
		var status=page.find("input[name=status]:checked").val();
		page.find("#clientlist tbody tr").each(function(){
			$(this).addClass("ui-hidden");
			if (status=="all") {$(this).removeClass("ui-hidden");}
			if (status=="on" && !$(this).hasClass("status-2")) {$(this).removeClass("ui-hidden");}
			if (status=="off" && $(this).hasClass("status-2")) {$(this).removeClass("ui-hidden");} 
		});
	});

		$("input[name=endDate]").on("change",function(){
			set_cookie("endDate",$(this).val());
			$("input[name=workDate]").trigger("change");
		});
		
});

function morfoLabSubmit() {
	$("a.submit").on("click",function(){
		var formdata=$("form#morfoLab").serialize();
		$.post("/json/morfology.php?mode=morfo_lab_submit",formdata,function(data){
				setTimeout('$.mobile.changePage( "/morfoLab/list/list.htm", { transition: "flip", changeHash: true });',300);
		});

	});
}

// форма отмены исследования

	$("#cancelOp").on("pageshow",function(){
		$("#cancelOp form")[0].reset();
	});

function cancel_op_init() {
	$("#cancelOp a.cancel_op").on("click",function(){
		if ( $("#cancelOp select[name=filter]").val()==1 && $("#cancelOp textarea[name=cancelNote]").val()>" "  ) {
			var formdata=$("#cancelOp form").serialize() ;
			$.post("/json/morfology.php?mode=cancel_morfo",formdata,function(data){
				$("#cancelOp").popup("close");
				setTimeout(function(){ $.mobile.back(); },500);
				top.postMessage('addAction', '*'); 
			});
		} else {
			$.mobile.loading( "hide" );
			return false;
		}
	});
}	

</script>

<link rel="stylesheet" href="/style.css" />

