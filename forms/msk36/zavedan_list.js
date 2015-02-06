$(document).ready(function(){
$("div[data-url^='/zavedan/list/list.htm']:hidden").remove();	
zavedanNazn_submit() ;
button_oprooms_init();
mainsisMenu_init();	
		$("#zavedanNazn").on("pageshow",function(){
			var action_id=$("#zavedanNazn input[name=action_id]").val();
			var oper_id=$("#zavedanNazn input[name=oper_id]").val();
			if (oper_id>"") {
				$("#zavedanNazn a[href=#cancelOp]").hide();
				$("#zavedanNazn input[name=begTime]").parents("div.ui-field-contain").hide();
			} 
			if (action_id>"") {
				$("#zavedanNazn a[href=#cancelOp]").show();
				$("#zavedanNazn input[name=begTime]").parents("div.ui-field-contain").show();
			} 
			if (action_id=="" && oper_id=="") {
				$("#zavedanNazn").hide();
				$.mobile.loading( "show" );
				document.location.href=$("#zavedanList").attr("data-url");
			}
			if (action_id=="") {action_id=$("#oprooms ul#oproom-"+oper_id+"  ul[tid]:first li:first").attr("aid");} 
			var details=$("#zavedanList #clientlist").html(); 
			$("#zavedanNazn table#client").hide().html(details);
			$("#zavedanNazn table#client tbody tr[aid!="+action_id+"]").remove();
			$("#zavedanNazn table#client").show();
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				$("#zavedanNazn").find("input,select,textinput").val("");
				$.each(data, function(key, value) {
						$("#zavedanNazn [name="+key+"]").val(value);
						$("#zavedanNazn [multiple][name^="+key+"]").val(value);
				});
				$("#zavedanNazn input[name=oper_id]").val(oper_id);
				$("#zavedanNazn input[name=person_id]").val($("#zavedanList input[name=person_id]").val());
				$("#zavedanNazn input[name=begDate]").val($("#zavedanList input[name=workDate]").val());
				$("#zavedanNazn select").trigger("change"); 	
			});
		});
});

$(document).on("pageinit",function(){
		drag_tables_init();
		drag_oprooms_init();
		var page=$("#zavedanList");
		var date=$("#zavedanList input[name=workDate]").val();
		var orgStr_id=$("#zavedanList input[name=orgStr_id]").val();
		page.find( "#clientlist" ).disableSelection();
		zavedan_get_calendar();
		
			
		page.find("#clientlist tbody tr, #tables ul li").unbind("dblclick").on("dblclick",function(){
			if (!$(this).parents("div").hasClass("approved")) {
				$("#zavedanNazn form")[0].reset();
				var aid=$(this).attr("aid");
				$("#zavedanNazn input[name=action_id]").val(aid);
				$.mobile.changePage( "#zavedanNazn", { transition: "slideup", changeHash: true });
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
		$("#zavedanList").data("aid",aid);
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
		var aid=$("#zavedanList").data("aid");
		$("#zavedanList #clientlist tr[aid="+aid+"]").trigger("dblclick");
	});
  $("#mainsisMenu a.print").unbind("click").on("click",function(){
		$(this).attr("href",$(this).attr("data")+"&action="+$("#zavedanList").data("aid"));
	});
//=======================================================	
	$("#mainsisMenu li a[href=#spis]").unbind("click").on("click",function(){
      			var aid=$("#zavedanList").data("aid");
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

function zavedan_get_calendar() {
var date=$("#zavedanList input[name=workDate]").val();
$.get("/forms/calendar.php?date="+date,function(data){ 
	$("#zavedanList  #calendar").html(data); 
});
} 

function button_oprooms_init() {
	$("a[href=#opMenu]").unbind("click").on("click",function(){
		var oid=$(this).next("ul").attr("oid");
		var tid=$(this).next("ul").attr("tid");
		var opr=$(this).next("ul").attr("opr");
		$("#zavedanList").data("table",$(this).parent("div.table-drop"));
		$("#zavedanList").data("oid",oid);
		$("#zavedanList").data("tid",tid);
		$("#zavedanList").data("opr",opr);
		if ($("#zavedanList ul[tid="+tid+"][oid="+oid+"]").parent("div").hasClass("approved")) {
			$("#opMenu li a.lock").text("Разблокировать");
		} else {
			$("#opMenu li a.lock").text("Заблокировать");
		}
	});
	$("#opMenu li a.oper").unbind("click").on("click",function(){
		var date=$("#zavedanList input[name=workDate]").val(); 
		var oper=$(this).attr("oper");
		var oid=$("#zavedanList").data("oid");
		var tid=$("#zavedanList").data("tid");
		$("#oprooms ul#oproom-"+oper).append($("#zavedanList").data("table"));
		$.get("/json/operation.php?mode=zavedan_set_oproom&date="+date+"&tid="+tid+"&oid="+oid+"&oper="+oper,function(data){ });
		$("#opMenu").popup("close"); 
	});
	
	$("#opMenu li a.lock").unbind("click").on("click",function(){
		var oid=$("#zavedanList").data("oid");
		var tid=$("#zavedanList").data("tid");
		var opr=$("#zavedanList").data("opr");
		var that=$("#zavedanList ul.table[tid="+tid+"][oid="+oid+"][opr="+opr+"]").parent("div");
		if (that.hasClass("approved")) {that.removeClass("approved");} else {	that.addClass("approved"); }
		$("#opMenu").popup("close");
	});
	
	
	$("#opMenu li a.print").unbind("click").on("click",function(){
		var date=$("#zavedanList input[name=workDate]").val();
		var oid=$("#zavedanList").data("oid");
		var tid=$("#zavedanList").data("tid");
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
		if ($("#zavedanList ul.oproom[oid="+oid+"]").parent("div").hasClass("approved")) {
			$("#oproomMenu li a.lock").text("Разблокировать");
		} else {
			$("#oproomMenu li a.lock").text("Заблокировать");
		}
	});

	$("#oproomMenu li a.lock").unbind("click").on("click",function(){
		var oid=$("#oproomMenu").data("oid");
		var that=$("#zavedanList ul.oproom[oid="+oid+"]").parent("div");
		if (that.hasClass("approved")) {that.removeClass("approved");} else {	that.addClass("approved"); }
		$("#oproomMenu").popup("close");
	});

	$("#oproomMenu li a.print").unbind("click").on("click",function(){
		var date=$("#zavedanList input[name=workDate]").val();
		var pid=$("#zavedanList input[name=person_id]").val();
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
		
		if ($("#zavedanlist input#appId").val()=="msk36") {
			$( "#zavedanNazn form a.submit" ).trigger( "click"); 
			$("#oproomMenu").popup("close"); 
		} else {
				$("#zavedanNazn form")[0].reset();
				$("#zavedanNazn input[name=action_id]").val(""); 
				$("#zavedanNazn input[name=oper_id]").val($("#oproomMenu").data("oid")); 
				$("#zavedanNazn input[name=person_id]").val($("#zavedanList input[name=person_id]").val()); 
				$.mobile.changePage( "#zavedanNazn", { transition: "slideup", changeHash: true });
		}
		return false;
	});
	
	
}

function zavedanNazn_submit() {
		$( "#zavedanNazn form a.submit" ).unbind("click").on( "click", function(  ) {
			var appId = $("#zavedanlist input#appId").val();
			if (appId=="msk36" && $("#zavedanNazn form:visible").length==0) {
				var oid=$("#oproomMenu").data("oid");
				var workDate=$("#zavedanList input[name=workDate]").val();
				var formdata="&oper_id="+oid+"&begDate="+workDate;
				$("#oprooms ul#oproom-"+oid).find("ul[tid] > li").each(function() { 
						formdata=formdata+"&aid[]="+$(this).attr("aid");
				});
				$.post("/json/operation.php?mode=mainsis_oproom_submit",formdata,function(data){ 
					$("#oprooms ul#oproom-"+oid).parent("div.oproom-drop").removeClass("open").addClass("approved");
					//footer_notify("Данные сохранены","success");
				});
				
			} else {
					var workDate=$("#zavedanList input[name=workDate]").val();
					if (checkRequired($( "#zavedanNazn form.nazn:visible"))) {
					var formdata=$("#zavedanNazn form").serialize() ;
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
						$.post("/json/operation.php?mode=zavnazn_oper_submit",formdata,function(data){ 
							footer_notify("Данные сохранены","success");
							setTimeout(function(){document.location.href=document.location.href;},1000);
						});
					}
					} else { 
						footer_notify("Не заполнены обязательные поля","error");
						return false;
					}
			}

		});
}

