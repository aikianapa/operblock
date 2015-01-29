$(document).ready(function(){
$("div[data-url^='/mainsister/list/list.htm']:hidden").remove();	
mainsisterNazn_submit() ;
button_oprooms_init();
mainsisMenu_init();	
		$("#mainsisterNazn").on("pageshow",function(){
			var action_id=$("#mainsisterNazn input[name=action_id]").val();
			var oper_id=$("#mainsisterNazn input[name=oper_id]").val();
			if (oper_id>"") {
				$("#mainsisterNazn a[href=#cancelOp]").hide();
				$("#mainsisterNazn input[name=begTime]").parents("div.ui-field-contain").hide();
			} 
			if (action_id>"") {
				$("#mainsisterNazn a[href=#cancelOp]").show();
				$("#mainsisterNazn input[name=begTime]").parents("div.ui-field-contain").show();
			} 
			if (action_id=="" && oper_id=="") {
				$("#mainsisterNazn").hide();
				$.mobile.loading( "show" );
				document.location.href=$("#mainsisterList").attr("data-url");
			}
			if (action_id=="") {action_id=$("#oprooms ul#oproom-"+oper_id+"  ul[tid]:first li:first").attr("aid");} 
			var details=$("#mainsisterList #clientlist").html(); 
			$("#mainsisterNazn table#client").hide().html(details);
			$("#mainsisterNazn table#client tbody tr[aid!="+action_id+"]").remove();
			$("#mainsisterNazn table#client").show();
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				$("#mainsisterNazn").find("input,select,textinput").val("");
				$.each(data, function(key, value) {
						$("#mainsisterNazn [name="+key+"]").val(value);
						$("#mainsisterNazn [multiple][name^="+key+"]").val(value);
				});
				$("#mainsisterNazn input[name=oper_id]").val(oper_id);
				$("#mainsisterNazn input[name=person_id]").val($("#mainsisterList input[name=person_id]").val());
				$("#mainsisterNazn input[name=begDate]").val($("#mainsisterList input[name=workDate]").val());
				$("#mainsisterNazn select").trigger("change"); 	
			});
		});
});

$(document).on("pageinit",function(){
		drag_tables_init();
		drag_oprooms_init();
		var page=$("#mainsisterList");
		var date=$("#mainsisterList input[name=workDate]").val();
		var orgStr_id=$("#mainsisterList input[name=orgStr_id]").val();
		page.find( "#clientlist" ).disableSelection();
		mainsister_get_calendar();
		
			
		page.find("#clientlist tbody tr, #tables ul li").unbind("dblclick").on("dblclick",function(){
			if (!$(this).parents("div").hasClass("approved")) {
				$("#mainsisterNazn form")[0].reset();
				var aid=$(this).attr("aid");
				$("#mainsisterNazn input[name=action_id]").val(aid);
				$.mobile.changePage( "#mainsisterNazn", { transition: "slideup", changeHash: true });
			}	
		});
    
    page.find("#clientlist tbody tr").each(function(){
			var sid=$(this).attr("sid");
			if (sid>0) {$(this).addClass("sid");}
			if ($(this).hasClass("status-0")) {$(this).remove();}
    });
    
		oprooms_init(page);
  $( ".drag-zone-apps, #tab-2 > *" ).disableSelection(); 
});

function mainsisMenu_init() {
	$("a[href=#mainsisMenu]").unbind("click").on("click",function(){
		var aid=$(this).parents("tr").attr("aid");
		var sid=$(this).parents("tr").attr("sid");
		$("#mainsisterList").data("aid",aid);
		if (sid=="") {
			$("#mainsisMenu a[href=#spis]").parents("li").addClass("ui-disabled");
      $("#mainsisMenu a.print").parents("li").addClass("ui-disabled");      
		} else {
			$("#mainsisMenu a[href=#spis]").parents("li").removeClass("ui-disabled");  
      $("#mainsisMenu a.print").parents("li").removeClass("ui-disabled");  
		}
	});
//=======================================================	
	$("#mainsisMenu li a[href=#nazn]").unbind("click").on("click",function(){
		var aid=$("#mainsisterList").data("aid");
		$("#mainsisterList #clientlist tr[aid="+aid+"]").trigger("dblclick");
	});
  $("#mainsisMenu a.print").unbind("click").on("click",function(){
		$(this).attr("href",$(this).attr("data")+"&action="+$("#mainsisterList").data("aid"));
	});
//=======================================================	
	$("#mainsisMenu li a[href=#spis]").unbind("click").on("click",function(){
      			var aid=$("#mainsisterList").data("aid");
      			setTimeout(function(){
			$.mobile.loading( "show",{ 
				text: 'Подождите, идёт доступ к базе данных.',
				textVisible: true
			});
			},500); 
			$("#sisterobSpis").remove();
      $.mobile.changePage( "/sisterob/spisanie/"+aid+".htm", { transition: "slideup", changeHash: false });
			//document.location.href="/sisterob/spisanie/"+aid+".htm";
	});
}

function mainsister_get_calendar() {
var date=$("#mainsisterList input[name=workDate]").val();
$.get("/forms/calendar.php?date="+date,function(data){ 
	$("#mainsisterList  #calendar").html(data); 
});
} 

function button_oprooms_init() {
	$("a[href=#opMenu]").unbind("click").on("click",function(){
		var oid=$(this).next("ul").attr("oid");
		var tid=$(this).next("ul").attr("tid");
		var opr=$(this).next("ul").attr("opr");
		$("#mainsisterList").data("table",$(this).parent("div.table-drop"));
		$("#mainsisterList").data("oid",oid);
		$("#mainsisterList").data("tid",tid);
		$("#mainsisterList").data("opr",opr);
		if ($("#mainsisterList ul[tid="+tid+"][oid="+oid+"]").parent("div").hasClass("approved")) {
			$("#opMenu li a.lock").text("Разблокировать");
		} else {
			$("#opMenu li a.lock").text("Заблокировать");
		}
	});
	$("#opMenu li a.oper").unbind("click").on("click",function(){
		var date=$("#mainsisterList input[name=workDate]").val(); 
		var oper=$(this).attr("oper");
		var oid=$("#mainsisterList").data("oid");
		var tid=$("#mainsisterList").data("tid");
		$("#oprooms ul#oproom-"+oper).append($("#mainsisterList").data("table"));
		$.get("/json/operation.php?mode=mainsister_set_oproom&date="+date+"&tid="+tid+"&oid="+oid+"&oper="+oper,function(data){ });
		$("#opMenu").popup("close"); 
	});
	
	$("#opMenu li a.lock").unbind("click").on("click",function(){
		var oid=$("#mainsisterList").data("oid");
		var tid=$("#mainsisterList").data("tid");
		var opr=$("#mainsisterList").data("opr");
		var that=$("#mainsisterList ul.table[tid="+tid+"][oid="+oid+"][opr="+opr+"]").parent("div");
		if (that.hasClass("approved")) {that.removeClass("approved");} else {	that.addClass("approved"); }
		$("#opMenu").popup("close");
	});
	
	
	$("#opMenu li a.print").unbind("click").on("click",function(){
		var date=$("#mainsisterList input[name=workDate]").val();
		var oid=$("#mainsisterList").data("oid");
		var tid=$("#mainsisterList").data("tid");
		var actions="";
		$("ul[tid="+tid+"][oid="+oid+"] > li").each(function() { 
			actions=actions+"&aid[]="+$(this).attr("aid");
		}); 
		var link="/json/print_forms.php?mode=opertable&tid="+tid+"&date="+date+"&orgStr_id="+oid+actions ;
		$(this).attr("href",link);
		$("#opMenu").popup("close"); 
	});

	$("a[href=#oproomMenu]").unbind("click").on("click",function(){
		$("#oproomMenu").data("oid",$(this).next("ul").attr("oid"));
		$("#oproomMenu").data("oper",$(this).text());
		var oid=$("#oproomMenu").data("oid");
		if ($("#mainsisterList ul.oproom[oid="+oid+"]").parent("div").hasClass("approved")) {
			$("#oproomMenu li a.lock").text("Разблокировать");
		} else {
			$("#oproomMenu li a.lock").text("Заблокировать");
		}
	});

	$("#oproomMenu li a.lock").unbind("click").on("click",function(){
		var oid=$("#oproomMenu").data("oid");
		var that=$("#mainsisterList ul.oproom[oid="+oid+"]").parent("div");
		if (that.hasClass("approved")) {that.removeClass("approved");} else {	that.addClass("approved"); }
		$("#oproomMenu").popup("close");
	});

	$("#oproomMenu li a.print").unbind("click").on("click",function(){
		var date=$("#mainsisterList input[name=workDate]").val();
		var pid=$("#mainsisterList input[name=person_id]").val();
		var oid=$("#oproomMenu").data("oid");
		var oper=$("#oproomMenu").data("oper"); 
		var actions="";
		$("#oprooms ul#oproom-"+oid).find("ul[tid] > li").each(function() { 
			actions=actions+"&aid[]="+$(this).attr("aid");
		}); 
		var link="/json/print_forms.php?mode=oproom&date="+date+"&oper="+oper+actions ;
		$(this).attr("href",link);
		$("#oproomMenu").popup("close"); 
	});
	
	$("#oproomMenu li a.approve").unbind("click").on("click",function(){
				$("#mainsisterNazn form")[0].reset();
				$("#mainsisterNazn input[name=action_id]").val(""); 
				$("#mainsisterNazn input[name=oper_id]").val($("#oproomMenu").data("oid")); 
				$("#mainsisterNazn input[name=person_id]").val($("#mainsisterList input[name=person_id]").val()); 
				$.mobile.changePage( "#mainsisterNazn", { transition: "slideup", changeHash: true });
				
	});
	
	
}

function mainsisterNazn_submit() {
		$( "#mainsisterNazn form a.submit" ).unbind("click").on( "click", function(  ) {
			var oid=$("#mainsisterNazn input[name=oper_id]").val();
			if (checkRequired($( "#mainsisterNazn form.nazn"))) {
			var formdata=$("#mainsisterNazn form").serialize() ;
			$.mobile.back();
			if ( oid>"" ) {
				$("#oprooms ul#oproom-"+oid).find("ul[tid] > li").each(function() { 
					formdata=formdata+"&aid[]="+$(this).attr("aid");
				});
				$.post("/json/operation.php?mode=mainsis_oproom_submit",formdata,function(data){ 
					footer_notify("Данные сохранены","success");
					setTimeout(function(){document.location.href=document.location.href;},1000);
				});
			} else {
				$.post("/json/operation.php?mode=mainsister_oper_submit",formdata,function(data){ 
					footer_notify("Данные сохранены","success");
					setTimeout(function(){document.location.href=document.location.href;},1000);
				});
			}
			} else { 
				footer_notify("Не заполнены обязательные поля","error");
				return false;
			} 
		});
}

