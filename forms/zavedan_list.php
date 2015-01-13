<div data-role="page" data-theme="a" id="zavedanList" data-url="/zavedan/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Заведующий отделением "Анестезиологии и реанимации"</h2></div>


<div data-role="content" >
<div data-role="fieldcontain">
		<label>Рабочая дата</label><input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div> 

<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			<li><a href="#tab-3" data-ajax="false"  class="ui-btn-active">Операционные</a></li>
			  <li><a href="#tab-1" data-ajax="false">Назначеные операции</a></li>
			  <li><a href="#tab-2" data-ajax="false">Операционный календарь</a></li>
		</ul></div>
		<div id="tab-1" class="ui-body-d ui-content">	

		<h2>Список назначеных операций</h2>
		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.</th><th>Операция</th><th>Дата операции</th><th>Диагноз</th><th>Врач</th><th>Палата</th><th>&nbsp;</tr></thead>
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
    <td><a href="#zavedanMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Меню</a></td>
		</tr></div>
		</tbody></table>
<div data-role="popup" id="zavedanMenu">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#nazn">Редактировать назначение</a></li>
            <li><a href="#spis">Редактировать списание</a></li>
            <li><a href="#" data="/json/print_forms.php?mode=spisanie_1&role=an" class="print" target="_blank">Печать списания</a></li>
        </ul>
</div>
	</div>


<div id="tab-2" class="ui-body-d ui-content">
<h2>Операционный календарь</h2>
<div id="calendar"></div>
</div>

<div id="tab-3" class="ui-body-d ui-content">
<div data-role="include" src="/forms/oprooms_tab.php"></div>
</div>

<div data-role="popup" id="oproomMenu">
	<ul data-role="listview">
	<li><a href="" class="approve" target="_blank">Назначение персонала</a></li> 
	<li><a href="#" class="print" target="_blank">Печать списка операций</a></li>
	</ul>
</div>

</div>

</div>
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>

</div>




<!-- Форма назначений для Зав. Анастезии  ==================
=========================================== -->
<div id="zavedanNazn" data-theme="a" data-role="page"  data-ajax="true" >
<div data-role="header"><h2>Назначения</h2></div>
<div data-role="content">
<table data-role="table" class="ui-responsive" id="client">
</table>
<form>
<div class="ui-widget">
<input type="hidden" name="action_id">
<input type="hidden" name="oper_id">
<div data-role="header" class="oproomName ui-state-highlight-zone"><h2></h2></div> 
<div data-role="fieldcontain"><label>Анестезиолог</label>
<select name="an_person_id" data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Анестезиологическая сестра</label>
<select name="an_sister_id"  data-native-menu="true"><option value="">Выберите...</option></select>
</div>

<a href="#" data-rel="back" class="cancel ui-btn ui-btn-inline ui-corner-all">Вернуться</a>
<a href="#" data-rel="back" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</div>
</form>
</div>
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>

<div data-role="include" src="/forms/sisteran_spisanie.php"></div> 

<!-- ======================================== -->



<script type="text/javascript">
$(document).ready(function(){
		$("div[data-url^='/zavedan/list/list.htm']:hidden").remove();
		$("#oprooms").hide();
		oprooms_init($("#zavedanList"));
		$("#zavedanList #tables").remove();
		oproomMenu_init();
    zavedanMenu_init();
		zavedan_nazn_submit();
		setTimeout(function(){  
			$("#oprooms > div.open").remove(); 
			$("#oprooms").show("fade");  
		},200);
});

$("#zavedanNazn").on("pageshow",function(){
			var action_id=$("#zavedanNazn input[name=action_id]").val();
			var oper_id=$("#zavedanNazn input[name=oper_id]").val();
			if (oper_id>"") {
				var oproom=$("#oprooms ul#oproom-"+oper_id).prev("a[href=#oproomMenu]").html(); 
				$("#zavedanNazn a[href=#cancelOp]").hide();
				$("#zavedanNazn .oproomName h2").html(oproom);
				$("#zavedanNazn .oproomName").show();
			} 
			if (action_id>"") {
				$("#zavedanNazn a[href=#cancelOp]").show();
				$("#zavedanNazn .oproomName").hide(); 
			} 
			if (action_id=="" && oper_id=="") {
				$("#zavedanNazn").hide();
				$.mobile.loading( "show" );
				document.location.href=$("#zavedanList").attr("data-url");
			}
			var details=$("#zavedanList #clientlist").html(); 
			$("#zavedanNazn table#client").hide().html(details);
			$("#zavedanNazn table#client tbody tr[aid!="+action_id+"]").remove();
			$("#zavedanNazn table#client").show();
			if (action_id=="") {
				action_id=$("#oprooms ul#oproom-"+oper_id+"  ul[tid]:first li:first").attr("aid");
				$("#zavedanNazn table#client").remove();
			}  
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				$("#zavedanNazn form")[0].reset();
				$.each(data, function(key, value) {
						$("#zavedanNazn [name="+key+"]").val(value);
						$("#zavedanNazn [multiple][name^="+key+"]").val(value);
				});
				$("#zavedanNazn input[name=oper_id]").val(oper_id);
//				$("#zavedanNazn input[name=person_id]").val($("#zavedanList input[name=person_id]").val());
// 				$("#zavedanNazn input[name=begDate]").val($("#zavedanList input[name=workDate]").val());
				$("#zavedanNazn select").trigger("change"); 	
			});
});


$(document).on("pageinit",function(){
	
		var page=$("#zavedanList");
		page.find("#zavedanNazn").dialog();
		zavedan_get_calendar()
		$("#clientlist tbody tr, #tables ul li").on("dblclick",function(){
				if (!$(this).parents(".approved").length) {
				var aid=$(this).attr("aid");
				$("#zavedanNazn form")[0].reset();
				$("#zavedanNazn input[name=action_id]").val(aid);
				$("#zavedanNazn input[name=action_id]").val(aid);
				$.mobile.changePage( "#zavedanNazn", { role: "page" } );
			}
		});
		
    page.find("#clientlist tbody tr").each(function(){
			var sid=$(this).attr("sid");
			if (sid>0) {$(this).addClass("sid");}
    });
    
	$("a[href=#opMenu]").addClass("ui-no-events"); 
	
});

function zavedanMenu_init() {
	$("a[href=#zavedanMenu]").on("click",function(){
		var aid=$(this).parents("tr").attr("aid");
		var sid=$(this).parents("tr").attr("sid");
		$("#zavedanList").data("aid",aid);
		if (sid=="") {
			$("#zavedanMenu a[href=#spis]").parents("li").addClass("ui-disabled");
      $("#zavedanMenu a.print").parents("li").addClass("ui-disabled");      
		} else {
			$("#zavedanMenu a[href=#spis]").parents("li").removeClass("ui-disabled");
      $("#zavedanMenu a.print").parents("li").removeClass("ui-disabled");
		}
	});
//=======================================================	
	$("#zavedanMenu li a[href=#nazn]").on("click",function(){
		var aid=$("#zavedanList").data("aid");
		$("#zavedanList #clientlist tr[aid="+aid+"]").trigger("dblclick");
	});
//=======================================================	
  $("#zavedanMenu a.print").on("click",function(){
		$(this).attr("href",$(this).attr("data")+"&action="+$("#zavedanList").data("aid"));
	});
//=======================================================	
	$("#zavedanMenu li a[href=#spis]").on("click",function(){
      			var aid=$("#zavedanList").data("aid");
      			setTimeout(function(){
			$.mobile.loading( "show",{ 
				text: 'Подождите, идёт доступ к базе данных 1С.',
				textVisible: true
			});
			},500); 
			$("#sisteranSpis").remove();
      $.mobile.changePage( "/sisteran/spisanie/"+aid+".htm", { transition: "slideup", changeHash: false });
	});
}

function zavedan_get_calendar() {
$.get("/forms/calendar.php",function(data){ 
	$("#zavedanList  #calendar").html(data); 
});
}

function zavedan_nazn_submit() {
$( "#zavedanNazn form a.submit" ).on( "click", function(  ) {
	var oid=$("#zavedanNazn input[name=oper_id]").val();
	if (checkRequired($( "#zavedanNazn form"))) {
	var formdata=$("#zavedanNazn form").serialize() ;
	if ( oid>"" ) {
		$("#oprooms ul#oproom-"+oid).find("ul[tid] > li").each(function() { 
			formdata=formdata+"&aid[]="+$(this).attr("aid");
		});
		$.post("/json/operation.php?mode=zavedan_oproom_submit",formdata,function(data){ 
			footer_notify("Данные сохранены","success");
		});
	} else {
		$.post("/json/operation.php?mode=zavnazn_oper_submit",formdata,function(data){
			footer_notify("Бригада назначена","success");
		});
	}
	} else { 
		footer_notify("Не заполнены обязательные поля","error");	
	} 
});
}

function oproomMenu_init() {
	var menu=$("#zavedanList #oproomMenu");
 	$("#oprooms a[href=#oproomMenu]").on("click",function(){
 		$("#oproomMenu").data("oid",$(this).next("ul").attr("oid"));
 	});

	$("#oproomMenu li a.print").on("click",function(){
		var date=$("#zavedanList input[name=workDate]").val();
		var oid=$("#oproomMenu").data("oid");
		var actions="";
		$("ul#oproom-"+oid+" li[aid]").each(function() { 
			actions=actions+"&aid[]="+$(this).attr("aid");
		}); 
		var link="/json/print_forms.php?mode=oproom&date="+date+"&orgStr_id="+oid+actions ;
		$(this).attr("href",link);
		$("#oproomMenu").popup("close"); 
	});

	$("#oproomMenu a.approve").on("click",function(){
				var oid=$("#oproomMenu").data("oid");
				
				$("#zavedanNazn form")[0].reset();
				$("#zavedanNazn input[name=action_id]").val(""); 
				$("#zavedanNazn input[name=oper_id]").val(oid); 
// 				$("#zavedanNazn input[name=person_id]").val($("#zavedanList input[name=person_id]").val()); 
				$.mobile.changePage( "#zavedanNazn", { transition: "slideup", changeHash: true });
	});
}

</script>

<link rel="stylesheet" href="/style.css" />
<style>
#zavedanNazn {width:100%;}
#zavedanNazn form {padding:10px; }
</style>
