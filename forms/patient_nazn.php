<div data-role="page" data-theme="a" id="patientNazn" data-ajax="false">
<input type="hidden" id="eventId" value="{{eventId}}">
<input type="hidden" id="personId" value="{{personId}}">
<input type="hidden" id="clientId" value="{{clientId}}">
<input type="hidden" id="orgStrId" value="{{orgStrId}}">
<input type="hidden" id="orgStrName" value="{{orgStrId}}">
<div data-role="panel" id="patient-panel" data-theme="a" data-position-fixed="true" data-display="push" data-dismissible="false" data-swipe-close="false" >
<a href="/patient/list/list.htm" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-bars" data-ajax="false">К списку пациентов</a>
	<div data-role="foreach" from="client">
	<div data-role="header"><h2>ИБ № {{externalId}}</h2></div>
	<p>
	{{lastName}}<br />
	{{firstName}}<br />
	{{patrName}}<br />
	{{birthDate}}<br />
	</p>
	<div data-role="header"><h2>Диагноз</h2></div>
	<p>{{diagnosis}}</p>

</div>
</div>

<div data-role="header"  data-position="fixed"><h2>Назначение операции</h2></div>

<div data-role="content">
<a href="" class="uniprint ui-hidden" target="_blank">Печать</a> 
<a href="#operation" data-rel="popup" data-position-to="window" class="new ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left " data-transition="pop">Назначить операцию</a>
<!-- Список операций -->

<table data-role="table" class="ui-responsive" id="operlist">
<thead><tr><th>Дата проведения</th><th>Наименование операции</th><th>Хирург</th><th>&nbsp;</th></tr></thead>
<tbody>
<div data-role="foreach" from="operations"><tr class="status-{{status}}" aid="{{id}}" title="{{cancelNote}}">
<td>{{begDate}}</td>
<td style="width:50%;"><p>{{specifiedName}}</p></td>
<td title="{{personFull}}">{{person}}</td>
<td><a href="#vrachMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Печать</a></td>
</tr></div>
</tbody></table>

<!-- менюдействий в списке операций врача-->
<div data-role="popup" id="vrachMenu" data-theme="b">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#operation">Редактировать назначение</a></li>
            <li><a href="#epicriz" data="/json/print_forms.php?mode=epicriz" data-rel="popup">Предоперационный эпикриз</a></li>
            <li><a href="" data="/json/print_forms.php?mode=invasion" class="print"  target="_blank" >Согласие на инвазию</a></li>
            <li><a href="" data="/json/print_forms.php?mode=hemotrans" class="print" target="_blank">Согласие на переливание</a></li>
            <li><a href="#histo" data="/json/print_forms.php?mode=histology" data-rel="popup">Направление на гистологию</a></li>
            <li><a href="#cito" data="/json/print_forms.php?mode=citology" data-rel="popup">Направление на цитологию</a></li>
            <li><a href="#imuno" data="/json/print_forms.php?mode=imuno" data-rel="popup">Направление на имуногистохимию</a></li>
        </ul>
</div>

<!-- Назначение операции -->

<div data-theme="a" class="ui-corner-all" id="operation" data-role="popup" data-dismissible="false" data-ajax="false">
<div data-role="header"><h2>Назначение операции пациенту</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<form id="patient_nazn_form">
<input type="hidden" name="orgStrId" value="{{orgStrId}}">
<input type="hidden" name="event_id" value="{{eventId}}">
<input type="hidden" name="setPerson_id" value="{{personId}}">
<input type="hidden" name="createPerson_id" value="{{personId}}">
<input type="hidden" name="status" value="0">
<input type="hidden" id="appId" value="{{_SETTINGS_appId}}">
<label><input type="checkbox" data-mini="true" name="isUrgent" >Экстренно</label>
<div data-role="fieldcontain"><label>Планируемая дата</label><input type="datepicker" name="plannedEndDate" required></div>
<div data-role="fieldcontain"><label>Наименование операции</label><input type="text" name="specifiedName" required></div>
<div data-role="fieldcontain"><label>Тип операции</label>
<select name="actionType_id" required><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Хирург</label>
<select name="person_id" value="{{personId}}" required><option value="">Выберите...</option></select>
</div>

<div data-role="fieldcontain"><label>Примечание</label><textarea name="note"></textarea></div>
<a href="#" data-rel="popup" class="submit ui-btn ui-btn-inline ui-corner-all">Назначить</a>
<a href="#" data-rel="back" class="ui-btn ui-btn-inline ui-corner-all">Отмена</a>
</form>

</div>

<!-- Предоперационный эпикриз -->

<div data-theme="a" class="ui-corner-all" id="epicriz" data-role="popup" data-dismissible="false">
<div data-role="header"><h2>Предоперационный эпикриз</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<form id="patient_epicriz_form">
<input type="hidden" name="action_id">
<div data-role="foreach" from="formEpicriz">
<div><label>{{label}}</label> 
{{input}}
</div>
</div>

<div><label>Необходимость переливания крови</label>
  <select name="transfusion_req" data-native-menu="false">
    <option value="1">Гемотрансфузия планируется</option>
    <option value="0">Гемотрансфузия не планируется</option>
  </select>  
</div>

<a href="#" data-rel="back" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</form>
</div>


<!-- Направление на гистологию -->

<div data-theme="a" class="ui-corner-all" id="histo" data-role="popup" data-dismissible="false">
<div data-role="header"><h2>Направление на гистологию</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<form id="patient_histo_form">
<input type="hidden" name="action_id">
<div data-role="foreach" from="formHisto">
<div><label>{{label}}</label>
{{input}}
</div>
</div>

<a href="#" data-rel="back" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</form>
</div>

<!-- Направление на цитологию  -->

<div data-theme="a" class="ui-corner-all" id="cito" data-role="popup" data-dismissible="false">
<div data-role="header"><h2>Направление на цитологию</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<form id="patient_cito_form">
<input type="hidden" name="action_id">
<div data-role="foreach" from="formCito">
<div ><label>{{label}}</label> 
{{input}}
</div>
</div>
<a href="#" data-rel="back" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</form>
</div>

<!-- Направление на имуногистохимию  -->

<div data-theme="a" class="ui-corner-all" id="imuno" data-role="popup" data-dismissible="false">
<div data-role="header"><h2>Направление на имуногистохимию</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<form id="patient_imuno_form">
<input type="hidden" name="action_id">
<div data-role="foreach" from="formImuno">
<div ><label>{{label}}</label> 
{{input}}
</div>
</div>
<a href="#" data-rel="back" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</form>
</div>

</div>
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>

<script language="javascript">
$(document).on("pageinit",function(){
	commonFormWidgets();
	patient_nazn();
	patient_nazn_submit();
	operation_list_action();
	$("body").data("trigger","update");
});
 

function patient_nazn() {
//$("#patient-panel").panel("open");

$('input[type=datetime]').datetimepicker({
	lang:'ru', format:'Y-m-d', formatDate:'Y-m-d', timepicker:false
});

$("form input[data-type=JobTicket]").prev("label").parent("div").hide();

$(window).on("resize",function(){
var panel_w=$("#patient-panel").width();
var page_w=$("#patientNazn").width();
var cont_w=page_w-panel_w;
$("#patientNazn div[data-role=content]").width(cont_w);
$("#patientNazn #operation").css("width",page_w-40);
$("#patientNazn #epicriz").css("width",page_w-40);
$("#patientNazn #histo").css("width",page_w-40);
$("#patientNazn #cito").css("width",page_w-40);
$("#patientNazn #imuno").css("width",page_w-40);
$("#patientNazn #histo").popup();
});
$(window).trigger("resize");

$("#patientNazn [name=actionType_id]").on("change",function() {
	if ($("#patientNazn [name=specifiedName]").val()<=" ") {
		$("#patientNazn [name=specifiedName]").val( $(this).find("option[value="+$(this).val()+"]").html() );
	}
});

var orgStrId=$("#patientNazn input[name=orgStrId]").val();
var eventId=$("#patientNazn input[name=event_id]").val();
var personId=$("#patientNazn input[name=setPerson_id]").val();
var clientId=$("#patientNazn input[name=clientId]").val();

$("#patientNazn #epicriz form a.submit[data-rel=back]").on("click",function(){
	var formdata=$("#patient_epicriz_form").serialize() ;
	insert_properties("#patient_epicriz_form",$("#patientNazn input#personId").val());
	$.post("/json/operation.php?mode=epicriz_submit",formdata,function(data){
			top.postMessage('addAction', '*');
			$.mobile.silentScroll(0)
			setTimeout(function(){  window.open($("#patientNazn a.uniprint").attr("href"),"_blank"); },300);  
	});
});

$("#patientNazn #histo form a.submit[data-rel=back]").on("click",function(){
	var formdata=$("#patient_histo_form").serialize() ;
	insert_properties("#patient_histo_form",$("#patientNazn input#personId").val());
	$.post("/json/operation.php?mode=histology_submit",formdata,function(data){
			top.postMessage('addAction', '*');
			$.mobile.silentScroll(0)
			setTimeout(function(){  window.open($("#patientNazn a.uniprint").attr("href"),"_blank"); },300);  
	});
});
 
$("#patientNazn #cito form a.submit[data-rel=back]").on("click",function(){
	var formdata=$("#patient_cito_form").serialize();
	insert_properties("#patient_cito_form",$("#patientNazn input#personId").val());
	$.post("/json/operation.php?mode=citology_submit",formdata,function(data){
			top.postMessage('addAction', '*');
			$.mobile.silentScroll(0)
			setTimeout(function(){  window.open($("#patientNazn a.uniprint").attr("href"),"_blank"); },300);  
	});
});

$("#patientNazn #imuno form a.submit[data-rel=back]").on("click",function(){
	var formdata=$("#patient_imuno_form").serialize();
	insert_properties("#patient_imuno_form",$("#patientNazn input#personId").val());
	$.post("/json/operation.php?mode=imuno_submit",formdata,function(data){
			top.postMessage('addAction', '*');
			$.mobile.silentScroll(0)
			setTimeout(function(){  window.open($("#patientNazn a.uniprint").attr("href"),"_blank"); },300);  
	});
});

// Получаем список хирургов на отделении
$.get("/json/operation.php?mode=nazn_hirurg_list&orgStrId="+orgStrId,function(data){
	var data=jQuery.parseJSON(data);
	$(data).each(function(){
		$("#patient_nazn_form select[name=person_id] option:last").after("<option value='"+this.id+"'>"+this.lastName+" "+this.firstName+" "+this.patrName+"</option>");
	});
	$("#patient_nazn_form select[name=person_id]").find("option[value="+personId+"]").attr("selected",true);
	$("#patient_nazn_form select[name=person_id]").trigger("change");
});

// Получаем список операций, выполняемых отделением
$.get("/json/operation.php?mode=nazn_oper_list&orgStrId="+orgStrId,function(data){
	var data=jQuery.parseJSON(data);
	$(data).each(function(){
		if ($("#patient_nazn_form input#appId").val()=="msk36") {
			$("#patient_nazn_form select[name=actionType_id] option:last").after("<option value='"+this["id"]+"'>"+this["code"]+"   - "+this["name"]+"</option>");
		}	else {
			$("#patient_nazn_form select[name=actionType_id] option:last").after("<option value='"+this["id"]+"'>"+this["name"]+"</option>");
		}
	});
});
}

function patient_nazn_submit() {
$( "#patient_nazn_form a.submit" ).on( "click", function(  ) {
	if (checkRequired($( "#patient_nazn_form"))) {
	var formdata=$("#patient_nazn_form").serialize() ;
	$.post("/json/operation.php?mode=nazn_oper_submit",formdata,function(data){
		var data=$.parseJSON(data);
		if (data.error==0) {
			top.postMessage('addAction', '*');
			$("#patientNazn #patient_epicriz_form input[name=action_id]").val(data.id);
			$("#patientNazn #operation").popup("close");
			footer_notify("Операция назначена","success");
			setTimeout(function(){ 
				document.location.href = document.location.href;
			//	epicriz_defaults(); 
			//	$("#patientNazn #epicriz").popup("open"); 
			},300);
		}
	});
	} else { 
//		$("#patientNazn #operation").popup("close");
		footer_notify("Не заполнены обязательные поля","error");	
	} 
});
}

$("#patientNazn [name=isUrgent]").on("change",function(){
	if ( $(this).val()!=1) {$(this).val(1);} else { $(this).val(0);	}
});


$("#patientNazn #epicriz").on("popupafteropen",function(){ popup_data(this,"epicriz","epicriz"); });
$("#patientNazn #histo").on("popupafteropen",function(){ popup_data(this,"histo","histology"); });
$("#patientNazn #cito").on("popupafteropen",function(){ popup_data(this,"citology","citology"); });
$("#patientNazn #imuno").on("popupafteropen",function(){ popup_data(this,"imuno","imuno"); }); 

function popup_data(that,name,dataname) {
	var action_id=$( "#patientNazn" ).data( "action");
//	if (dataname=="undefined") {var dataname=name;}
	if (action_id>"") {
			$(that).find("form input[name=action_id]").val(action_id); 
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				formdata=data[dataname]; var res=false;
				$.each(formdata, function(key, value) { if (!value.is_numeric  && value>"" ) {res=true;} }); // если все пустые, то остаются значения default
				if (res==true) {
				$(that).find("form")[0].reset();  
				$.each(formdata, function(key, value) {
						$(that).find("form [name="+key+"]").val(value);
						$(that).find("form [multiple][name^="+key+"]").val(value);
						if ($(that).find("form [name^="+key+"]").is("select")) {
							$(that).find("form [name^="+key+"]").trigger("change");
						}
				});
				} 
			});
	} 
}

$("#patientNazn a.new[href=#operation]").on("click",function(){ 	$( "#patientNazn" ).data( "action","");	});

$("#patientNazn #operation").on("popupafterclose",function(){
	$( "#patientNazn" ).data( "action","");
	$(this).find("form input[name=id]").remove(); 
});

$("#patientNazn #operation").on("popupafteropen",function(){
	var action_id=$( "#patientNazn" ).data( "action");
	$(this).find("form")[0].reset();  
	if (action_id>"") {
			$(this).find("form").prepend("<input type='hidden' name='id'>");
			$(this).find("form input[name=id]").val(action_id);
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				$.each(data, function(key, value) {
						$("#operation [name="+key+"]").val(value);
						$("#operation [multiple][name^="+key+"]").val(value);
				});
				commonFormWidgets(); 
				$("#operation select").trigger("change");
				if ($("#operation input[name=isUrgent]").val()==1) {
					$("#operation input[name=isUrgent]").prop( "checked", true ).checkboxradio( "refresh" );
				}
				
	});
	}
	
});

function epicriz_defaults() {
			var event_id=$("#patientNazn input#eventId").val();
			$.get("/json/operation.php?mode=get_diagnoses&event_id="+event_id,function(data){
				var data = JSON.parse(data);
				$("#patient_epicriz_form [name=fld_0]").parent("div").parent("div").hide();
				$("#patient_epicriz_form [name=fld_0]").val(data["clinic"]["MKB"]+" "+data["clinic"]["DiagName"]);
				$("#patient_epicriz_form [name=fld_1]").val(data["main"]["MKB"]+" "+data["main"]["DiagName"]);
				$("#patient_epicriz_form [name=fld_2]").val(data["satt"]["MKB"]+" "+data["satt"]["DiagName"]);
				$("#patient_epicriz_form [name=fld_7]").val(data["terapevt"]["value"]); 
				$("#patient_epicriz_form [name=fld_8]").val(data["anest"]["value"]);
				$("#patient_epicriz_form").enhanceWithin(); 
			});		
}; 

function histo_defaults() {
			var event_id=$("#patientNazn input#eventId").val();
			$.get("/json/operation.php?mode=get_diagnoses&event_id="+event_id,function(data){
				var data = JSON.parse(data);
				$("#patient_histo_form [name=fld_5]").val(data["clinic"]["MKB"]+" "+data["clinic"]["DiagName"]);
				$("#patient_histo_form").enhanceWithin(); 
			});		
}; 

function imuno_defaults() {
			var event_id=$("#patientNazn input#eventId").val();
			$.get("/json/operation.php?mode=get_diagnoses&event_id="+event_id,function(data){
				var data = JSON.parse(data);
				$("#patient_imuno_form [name=fld_3]").val(data["clinic"]["MKB"]+" "+data["clinic"]["DiagName"]);
				$("#patient_imuno_form").enhanceWithin(); 
			});		
}; 

function operation_list_action() {
	$("a[href=#vrachMenu]").on("click",function(){ $( "#patientNazn" ).data( "action", $(this).parents("tr").attr("aid")); });
	$("#vrachMenu a").on("click",function(){
			$("#vrachMenu").popup("close");
			var href=$(this).attr("href");
			if (href=="#operation") {
				setTimeout(function(){ $("#patientNazn #operation").popup("open"); },500);
				return false;
			}
			if (href=="#epicriz" ) {
				$("#patient_epicriz_form")[0].reset();
				epicriz_defaults();
				$("#patientNazn a.uniprint").attr("href",$(this).attr("data")+"&action="+$( "#patientNazn" ).data( "action")); 
				setTimeout(function(){ $("#patientNazn #epicriz").popup("open"); },500);
			} 
			
			if (href=="#histo" ) {
				$("#patient_histo_form")[0].reset();
				histo_defaults();
				$("#patientNazn a.uniprint").attr("href",$(this).attr("data")+"&action="+$( "#patientNazn" ).data( "action")); 
				setTimeout(function(){ $("#patientNazn #histo").popup("open"); },500);
			} 
			if (href=="#cito" ) {
				$("#patient_cito_form")[0].reset();
				histo_defaults();
				$("#patientNazn a.uniprint").attr("href",$(this).attr("data")+"&action="+$( "#patientNazn" ).data( "action")); 
				setTimeout(function(){ $("#patientNazn #cito").popup("open"); },500);
			} 
			if (href=="#imuno" ) {
				$("#patient_imuno_form")[0].reset();
				imuno_defaults();
				$("#patientNazn a.uniprint").attr("href",$(this).attr("data")+"&action="+$( "#patientNazn" ).data( "action")); 
				setTimeout(function(){ $("#patientNazn #imuno").popup("open"); },500);
			} 
			if ($(this).hasClass("print")) {
				$(this).attr("href",$(this).attr("data")+"&action="+$( "#patientNazn" ).data( "action"));				
			}
	});

	
}

</script>
<link rel="stylesheet" href="/style.css" />
<style>
#patientNazn #operlist {width: 98%;}
#patientNazn #operation form {padding:10px;}
#patientNazn #operation {width:800px;}
#epicriz, #histo, #cito {width:800px;}
#patientNazn form {padding:10px;}
</style>
