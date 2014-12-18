$(document).ready(function(){
	//$("form").submit(function(event){  	event.preventDefault();	});
	datatime_picker_init();

});

$(document).on("pageinit",function(){
commonFormWidgets();
datatime_picker_init();
	
	$("a[href^=#]").on("click",function() {
		setTimeout(function(){  $.mobile.loading( "hide" ); },100);
	});
	
	$("input[name=workDate]").on("change",function(){
				$.mobile.loading( "show" ); 
				set_cookie("workDate",$(this).val());
				document.location.href=document.location.href;
	});
	actionTooltip();
	calendarInit();
});


function morfoStatus(list) {
	var actions=[];
	$(list).find("tr[aid]").each(function(i){
		actions[i]=$(this).attr("aid");
	});
	$.post("/json/morfology.php?mode=morfo_get_status",	{data: JSON.stringify(actions)},function(data){
		var data=$.parseJSON(data);
			$.each(data, function(key, value) {
					var line=$(list).find("tr[aid="+key+"]");
					line.removeClass("status-0 status-1 status-2 status-3 status-4");
					line.addClass("status-"+value);
			}); 
	});
}

function add_trigger(uid,trigger) {
$.get("/json/operlog.php?mode=add_trigger&uid="+uid+"&trigger="+trigger,function(data){
		return data;
});
}

function get_trigger(uid) {
$.get("/json/operlog.php?mode=get_trigger&uid="+uid,function(data){
		if (data!=false) {	 return data; } else {return false;}
});
}


function datatime_picker_init() {

$('input[type=datetime]').datetimepicker({
	lang:"ru",
	format:"Y-m-d h:i", 
	formatDate: "'Y-m-d H:i",
	dayOfWeekStart: 1, 
	timepicker:true
}).textinput();

$('input[type=datepicker]').datetimepicker({
		lang: "ru",
		format: "Y-m-d",
		dayOfWeekStart: 1,
		timepicker: false
}).textinput();

$('input[type=time]').datetimepicker({
	datepicker:false,
	lang:'ru',
	format:'H:i',
	step:5
}).textinput();
}

function calendarInit() {
	$("#calendar").delegate("div.day-number","click",function(){
		if ($(this).parents("div[data-role=page]").find("input[name=workDate]").length ) {
			var date=$(this).parents("div[data-role=page]").find("input[name=workDate]");
			var day=$(this).text();
			var arr=explode("-",date.val());
			arr[2]=sprintf("%02d", day); 
			date.val( implode("-",arr) );
			date.trigger("change");
		}
		
	});
}
function insert_properties(form,pid) { 
	var data=[];
	var aid=$(form).find("input[name=action_id]").val();
	var atid="";
	$(form).find("input[data-id],select[data-id],textarea[data-id]").each(function(){ 
		var item={
			value: $(this).val(),
			type_id: $(this).attr("data-id"),
			type: $(this).attr("data-type")
		}
		if ($(this).attr("data-atid")>0  && $(this).attr("data-atid")!="undefined") {
			atid=$(this).attr("data-atid");	
		}
		
		data.push(item);
	});
	if (aid>0 && atid>0 && pid>0) {
	$.post("/json/operation.php?mode=insert_properties",{
		data: JSON.stringify(data),
		action_id: aid,
		actionType_id: atid, 
		person_id: pid
		},function(data){	
	});
	} 

}

function oprooms_init(page) {
	// ============== Удаляем отменёные операции ========== //
	page.find("#common-list li.status-3").remove(); 
	// ============== Раскидываем операции по столам ======= //
	page.find("#common-list li").each(function(){
			var tid=$(this).attr("tid");
			var oid=$(this).attr("oid"); 
			var date=page.find("input[name=workDate]").val();
 			if (tid!="" && tid!="{{table}}") {page.find("div#tables").find("ul#table-"+tid+"[oid="+oid+"]").append($(this));} else { tid="";} 
		if (oid>"" && tid>"") {
			$.get("/json/operation.php?mode=check_approved_table&date="+date+"&orgStr_id="+oid+"&tid="+tid,function(data){
				// Проверяем апрув стола, если нет - удаляем //
				var data=jQuery.parseJSON(data);
				if (data==false) {
					page.find("ul#table-"+tid+"[oid="+oid+"]").parent("div.table-drop").remove(); } else {
					page.find("ul#table-"+tid+"[oid="+oid+"]").parent("div.table-drop").addClass("approved"); 
				}
 			});
		}
	}); 
  	// ============== Удаляем пустые столы ================ //
	page.find("#tables ul[tid]").each(function(){
		if (!$(this).find("li").length) {	$(this).parent("div").remove(); } 
	});
	 // ============= Удаляем контейнер начального списка ===== //
 	page.find("div.common-list").remove();
	// ============= Раскидываем столы по операционным ===== //
	page.find("#tables ul[opr]").each(function(){
		var opr=$(this).attr("opr");
		if ( opr.substr(0,1)=="{") {opr=0;} 
		page.find("#oprooms #oproom-"+opr).append($(this).parent("div"));
	});
	// ============= проверяем апрув операционных ===== //
	page.find("#oprooms ul.oproom").each(function(){
		var date=page.find("input[name=workDate]").val();
		var that=this;
		$.get("/json/operation.php?mode=check_approved_oproom&date="+date+"&oper="+$(this).attr("oid"),function(data){
			var data=jQuery.parseJSON(data);
			if (data==true) { $(that).parent("div.oproom-drop").addClass("approved"); } else {
				$(that).parent("div.oproom-drop").addClass("open"); 
			}
		});
		
	});
}

function table_sort_save(that) {
	$(that).children("li").each(function(){
      	var idx=$(this).index();
	var action=$(this).attr("aid");
	var table=$(this).parent("ul").attr("tid");
	var oid=$(this).parent("ul").attr("oid");
	if (oid==undefined) {oid=$(this).parents("div[data-role=content]").find("input[name=orgStr_id]").val();}
	if (table==undefined) {table="";}
	$.ajax({
		url: "/json/operation.php?mode=mainsister_set_table&action_id="+action+"&table="+table+"&idx="+idx+"&oid="+oid,
		async: false,
		dataType: "json"
		});
	});
}

function oproom_sort_save(that) {
	var date=$("input[name=workDate]").val(); 
	$(that).children("div").children("ul").each(function(){ 
		var oper=$(that).attr("oid");
		var idx=$(this).parent("div").index();
		var tid=$(this).attr("tid");
		var oid=$(this).attr("oid");
		if (oper==undefined) {oper="";}
		
		$.ajax({
			url: "/json/operation.php?mode=mainsister_set_oproom&date="+date+"&tid="+tid+"&oid="+oid+"&oper="+oper+"&idx="+idx,
			async: false,
			dataType: "json"
		});	
	});
}

function drag_tables_init() {
$( ".drag-zone-apps ul" ).sortable({
      connectWith: "ul.common-tables, ul[id^=table-]",
      placeholder: 'ui-state-highlight-zone',
      dropOnEmpty: true,
      opacity: 0.6, 
      scroll: false,
      cursor: 'pointer',
      revert: true,
      stop: function(event, ui) {
      	if ( $(ui.item).parents("div.approved").length>0 ) {
		return false;
	} else {
		table_sort_save($(ui.item).parent("ul.table")); 	
	}
       }
});
	  $( ".drag-zone-apps, table" ).disableSelection();
}

function drag_oprooms_init() {
    $( "#common-tables" ).sortable({
      connectWith: "#oprooms ul.oproom", 
      placeholder: 'ui-state-highlight-zone',
      dropOnEmpty: true, opacity: 0.6,  scroll: false, cursor: 'move', revert: true,
       stop: function(event, ui) { 
      	if ( $(ui.item).parents("div.approved").length>0 ) {
		return false;
	} else {
       		oproom_sort_save($(ui.item).parent("ul")); 
       	}
       	} 
    });
    
    $( "#oprooms div > ul" ).sortable({
      connectWith: "#common-tables, #oprooms ul.oproom",
      placeholder: 'ui-state-highlight-zone',
      dropOnEmpty: true, opacity: 0.6,  scroll: false, cursor: 'move', revert: true,
      stop: function(event, ui) {
      	if ( $(ui.item).parents("div.approved").length>0 ) {
		return false;
	} else {
      		oproom_sort_save($(ui.item).parent("ul"));  
      	} 
      	}
    });
    
	  $( ".drag-zone-apps, table" ).disableSelection();
}


function create_table(tid) {
		$("#tables div.add_table").before('<div class="drag-zone-apps table-drop"></div>');
		$("#tables .table-drop:last").append('<a href="#table_menu" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-icon-left">Стол №'+tid+'</a>');
		$("#tables .table-drop:last").enhanceWithin();
		$("#tables .table-drop:last").append('<ul class="ui-draggable table" id="table-'+tid+'" tid="'+tid+'"></ul><div>');
		drag_tables_init();	
}

function delete_table(tid) {
		$("ul#table-"+tid+" > li").each(function(){
			var action=$(this).attr("aid");
			$.get("/json/operation.php?mode=mainsister_set_table&action_id="+action+"&table=",function(data){
				
			});
			$("#common-list").append($(this));
		});
		$("#tables ul#table-"+tid).parents(".table-drop").remove();
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function checkRequired(form) {
var res=1;
form.find("*[required]").each(function(){
	if ($(this).val()=="") {res=0; $(this).parents("div.ui-input-text,div.ui-select").prev("label").addClass("required"); } else {
		$(this).parents("div.ui-input-text,div.ui-select").prev("label").removeClass("required");
	}
});
return res;
}

function footer_notify(text,type) {
$("div[data-role=footer] div.notify").addClass(type);
$("div[data-role=footer] div."+type).text(text);
$("div[data-role=footer] div."+type).show("blind",500);
setTimeout(function(){ $("div[data-role=footer] div."+type).hide("blind",500);	},2000);
setTimeout(function(){ 
	$("div[data-role=footer] div.notify").removeClass(type);
	$("div[data-role=footer] div.notify").html("");
},3000);
}

function actionTooltip() {
// ============== Тултип операции ===================
	$("#tables li a, #oprooms li, #clientlist tr").tooltip({  
	track: true,
	position: { my: "left+20 top", at: "right center" },
	open: function( event, ui ) {
		var tooltip=$(this).find("span.ui-hidden").html();
		$(".ui-tooltip").html(tooltip); 
		$(".ui-tooltip").addClass("ui-widget-header");
	}
	});
}
