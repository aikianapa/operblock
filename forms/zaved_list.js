$(document).ready(function(){
$("div[data-url^='/zaved/list/list.htm']:hidden").remove(); 
$("#zavnazn input[name=person_id]").val("");
zavedMenu_init();	
zaved_get_calendar();
action_table_event();
zavtable_defaults();
zavtable_submit();
zaved_nazn_submit();
});

$(document).on("pageinit",function(){

drag_tables_init();	

});

$("#zavedList").on("pageinit",function(){
tables_init();
add_table_event();	
});

$("#zavnazn").on("pageinit",function(){
	 zavnazn_defaults(); 
});

function hirurg_form_show(aid) { 
	$("#hirurgOperation").find("form")[0].reset();
	$("#hirurgOperation").find("input[name=id]").val(aid);
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
	$("#hirurgOperation form").find("input[type=time],input[type=datetime]").datetimepicker('destroy').attr("type","text"); 
	$("#hirurgOperation form").find("input,select,textarea").prop("readonly",true);
	$("#hirurgOperation form").find(".ui-select").prop("disabled",true);
	$("#hirurgOperation form a.submit").remove(); 
	$("#hirurgOperation").enhanceWithin();
	// =======================================
	setTimeout('$.mobile.changePage( "#hirurgOperation", { transition: "slideup", changeHash: true });',300);
}

function zavedMenu_init() {
	$("a[href=#zavedMenu]").on("click",function(){
		var aid=$(this).parents("tr").attr("aid");
		var sid=$(this).parents("tr").attr("sid");
		$("#zavedList").data("aid",aid);
		if (!$(this).parents("tr").hasClass("status-2")) {
			$("#zavedMenu a.protocol").parents("li").addClass("ui-disabled"); 
		} else {
			$("#zavedMenu a.protocol").parents("li").removeClass("ui-disabled");  
		}
		$("#zavedMenu a.protocol").attr("href","/json/print_forms.php?mode=protocol&action="+aid);  
	});
//=======================================================	
	$("#zavedMenu li a[href=#nazn]").on("click",function(){
		var aid=$("#zavedList").data("aid");
		$("#zavedList #clientlist tr[aid="+aid+"]").trigger("dblclick");
		$("#zavedMenu").popup("close");
	});
//=======================================================
	$("#zavedMenu li a.protocol").on("click",function(){
			$("#zavedMenu").popup("close"); 
	});
	$("#zavedMenu li a[href=#protocol]").on("click",function(){
      			var aid=$("#zavedList").data("aid");
			hirurg_form_show(aid);
	});
}

function tables_init() {
		var page=$("#zavedList");
		var date=$("#zavedList input[name=workDate]").val();
		var orgStr_id=$("#zavedList input[name=orgStr_id]").val();
		page.find("#zavnazn").dialog();
		
		page.find("#clientlist tbody tr, #tables ul li").on("dblclick",function(){
			if (!$(this).parents("div").hasClass("approved")) {
				$("#zavnazn form")[0].reset();
				var aid=$(this).attr("aid");
				$("#clientlist").data("aid",aid);
				$("#zavnazn input[name=action_id]").val(aid);
				page.find("#zavnazn input[name=action_id]").val(aid);
				$.mobile.changePage( "#zavnazn", { transition: "slideup" });
				zavnazn_defaults();
			}
		});
	
	page.find("#common-list li.status-3").remove(); 
		
	page.find("#common-list li").each(function(){
			var tid=$(this).attr("tid");
			var aid=$(this).attr("aid");
			//$(this).attr("title",$("#clientlist tr[aid="+aid+"] td:first span").html());
			if (tid!="" && tid!="{{table}}") {
        $("ul#table-"+tid).append($(this));
        if (!page.find("#tables ul#table-"+tid).length) {
          if (tid>0 && isNumber(tid)) {create_table(tid);}
        }
			
        $.get("/json/operation.php?mode=check_approved_table&date="+date+"&orgStr_id="+orgStr_id+"&tid="+tid,function(data){
          var data=jQuery.parseJSON(data);
          if (data==true) {$("#tables").find("ul#table-"+tid).parents("div.table-drop").addClass("approved"); }
 			});
      } 
	});
  
}

function add_table_event() {
$("#new_table_num").popup();

$("#tables").delegate("div.add_table","click",function() {
	var tables=$("#tables").find("ul[tid]").length+1;
	for (i=1; i<=tables; i++) {
		if (!$("#tables").find("ul[tid="+i+"]").length) {	var tid=i; i=tables+1; } 
	}
	create_table(tid);
});
}

function zaved_get_calendar() {
var orgStr_id=$("#zavedList input[name=orgStr_id]").val();
var workDate=$("#zavedList input[name=workDate]").val();
$.get("/forms/calendar.php?oid="+orgStr_id+"&date="+workDate,function(data){ 
	$("#zavedList  #calendar").html(data); 
});
}

function action_table_event() {
$(document).delegate("a[href=#table_menu]","click",function() {
		var tid=$(this).parents(".table-drop").find("ul").attr("tid");
		if  ($("#tables").find("div.approved ul[tid="+tid+"]").length ) { 
			$("#table_menu a.ui-icon-delete").addClass("ui-disabled"); 
			$("#table_menu a.ui-icon-check").addClass("ui-disabled"); 
		} else {
			$("#table_menu a.ui-icon-delete").removeClass("ui-disabled"); 
			$("#table_menu a.ui-icon-check").removeClass("ui-disabled"); 
		}
		if ($("#tables ul[tid="+tid+"]").parent("div").hasClass("approved")) {
			$("#table_menu li a.lock").text("Разблокировать");
		} else {
			$("#table_menu li a.lock").text("Заблокировать"); 
		}
		$("#table_menu").data("tid",tid);
		$("#zavtable input[name=table]").val(tid);
		$("#zavtable input[name=date]").val($("#zavedList input[name=workDate]").val())
		$("#table_menu").popup("open");
		zavtable_defaults();

});
		$("#table_menu a[href=#delete]").on("click",function(){
			var tid=$("#table_menu").data("tid");
			delete_table(tid);
		});

		$("#table_menu a.lock").on("click",function(){
			var tid=$("#table_menu").data("tid");
			var that=$("#tables ul[tid="+tid+"]").parent("div");
			if (that.hasClass("approved")) {that.removeClass("approved");} else {	that.addClass("approved"); }
			$("#opMenu").popup("close");
		});

		$("#table_menu a[href=#zavtable]").on("click",function(){
			$("#table_menu").popup("close");
			var appId=$("#zavedlist input#appId").val();
			if (appId=="msk36") {$( "#zavtable form a.submit" ).trigger( "click"); return false;}
		});

		$("#table_menu a.print").on("click",function(){
			var tid=$("#table_menu").data("tid");
			var date=$("#zavedList input[name=workDate]").val();
			var orgStr_id=$("#zavedList input[name=orgStr_id]").val();
			var actions="";
			$("#tables ul[tid="+tid+"] > li").each(function() {
				actions=actions+"&aid[]="+$(this).attr("aid");
			}); 
			var link="/json/print_forms.php?mode=opertable&tid="+tid+"&date="+date+"&orgStr_id="+orgStr_id+actions ;
			$(this).attr("href",link);
		});


};

function zavtable_defaults() {
	var page=$("#zavtable");
	var date=page.find("input[name=workDate]").val();
	var orgStr_id=page.find("input[name=orgStr_id]").val();
	var tid=page.find("input[name=table]").val();
	page.find("form")[0].reset();
	page.find("input[name=workDate]").val(date);
	page.find("input[name=orgStr_id]").val(orgStr_id);
	page.find("input[name=table]").val(tid);
	page.enhanceWithin();
	page.find("[multiple]").selectmenu("destroy");
	page.find("[multiple]").selectmenu(); 
	$.get("/json/operation.php?mode=get_table_data&date="+date+"&orgStr_id="+orgStr_id+"&tid="+tid,function(data){
		var data=jQuery.parseJSON(data);
    if (data!=null) {
				$.each(data, function(key, value) {
					$("#zavtable [name="+key+"]").val(value);
					$("#zavtable [multiple][name^="+key+"]").val(value);
				});
				$("#zavtable select").trigger("change");
     }
	});
}

function zavnazn_defaults() {
	var action_id=$("#clientlist").data("aid");
	$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				$.each(data, function(key, value) {
						$("#zavnazn [name="+key+"]").val(value);
						$("#zavnazn [multiple][name^="+key+"]").val(value); 
				});
				$("#zavnazn input[name=begDate]").val($("#zavedList input[name=workDate]").val());
//				$("#zavnazn [multiple]").selectmenu("destroy");
				$("#zavnazn").enhanceWithin();
				$("#zavnazn select").trigger("change");
	});	
}

function check_operations() {
	var tid=$("#zavtable form input[name=table]").val();
	var actions=""; 
	var formdata=$("#zavtable form").serialize() ;
	$("#tables ul[tid="+tid+"] li").each(function() {
		var aid=$(this).attr("aid");
		if (actions>"") {actions=actions+","+aid;} else {actions=aid;}
	}); 
	send={};
	send.data=formdata;
	send.actions=actions;
	$.post("/json/operation.php?mode=zavtable_check_operation",send,function(data){
		
	});
	return false;
}

function add_table_event() {
$("#tables").delegate("div.add_table","click",function() {
	var tables=$("#tables").find("ul[tid]").length+1;
	for (i=1; i<=tables; i++) {
		if (!$("#tables").find("ul[tid="+i+"]").length) {	var tid=i; i=tables+1; } 
	}
	create_table(tid);
});
}

function zaved_nazn_submit() {
$( "#zavnazn form a.submit" ).unbind("click").on( "click", function(  ) {
	$.mobile.loading( "show" );
	setTimeout(function(){  $.mobile.loading( "show" ); },200);
	if (checkRequired($( "#zavnazn form.nazn"))) {
	var formdata=$("#zavnazn form.nazn").serialize() ;
	$.post("/json/operation.php?mode=zavnazn_oper_submit",formdata,function(data){
		footer_notify("Операция назначена","success");
		setTimeout(function(){  document.location.href=$("#zavedList").attr("data-url"); },1000);
	});
	} else { 
		footer_notify("Не заполнены обязательные поля","error");
		return false;
	} 
});
}

function zavtable_submit() {
$( "#zavtable form a.submit" ).on( "click", function(  ) {
		if (checkRequired($( "#zavtable form:visible"))) {
		var formdata=$("#zavtable form").serialize() ;
		$.post("/json/operation.php?mode=zavtable_submit",formdata,function(data){
			var tid=$("#zavtable form input[name=table]").val();
			$("#tables").find("ul#table-"+tid).parents("div.table-drop").addClass("approved"); 
			if ($("#zavtable form:visible").length) {
				footer_notify("Операционный стол утверждён","success");
				zavtable_copytable();
				$.mobile.back();
				setTimeout(function(){document.location.href=document.location.href;},500);
			}
		});
		} else { 
			footer_notify("Не заполнены обязательные поля","error");
			return false;
		} 

});
}

function zavtable_copytable() {
	var tid=$("#zavtable form input[name=table]").val();
	var date=$("#zavedList input[name=workDate]").val();
	var actions="";
	var formdata=$("#zavtable form").serialize() ;
	$("#tables ul#table-"+tid+" li[aid]").each(function() {
		actions=actions+"&aid[]="+$(this).attr("aid");
	}); 
	$.post("/json/operation.php?mode=zavtable_copytable&workDate="+date+actions,formdata,function(data){
		
	});
}
