$(document).ready(function(){
		$("div[data-url^='/zamglav/list/list.htm']:hidden").remove();
		zamglav_nazn_submit(); 
		zamglav_multi_approve();
		oproomMenu_init();
		$("#zamglavList #tables").remove();
		var page=$("#zamglavList");
		page.find("#clientlist tbody tr, #tables ul li").on("dblclick",function(){
			if (!$(this).parents("div").hasClass("approved")) {
				$("#zamglav form")[0].reset();
				var aid=$(this).attr("aid");
				$("#zamglav input[name=action_id]").val(aid);
				$("#zamglav [name=person_id]").removeAttr("value");
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+aid,function(data){
				var data = JSON.parse(data); 
				$.each(data, function(key, value) {
						$("#zamglav [name="+key+"]").val(value);
						$("#zamglav [multiple][name^="+key+"]").val(value);
				});
				if (data.status!=0) {$("#zamglav select[name=zam_ok]").parent("div").parent("div").hide();} else {$("#zamglav select[name=zam_ok]").parent("div").parent("div").show();}
				$("#zamglav [multiple]").selectmenu(); 
				$("#zamglav [multiple]").selectmenu( "destroy" ); 
				$("#zamglav [multiple]").selectmenu(); 

				$("#zamglav select").trigger("change"); 
			});
				$.mobile.changePage( "#zamglav", { transition: "slideup", changeHash: true }); 
			}	
		});
		page.find(".nazn-btn").on("click",function(){
			$(this).parents("tr").trigger("dblclick");
		});		
});

$("#zamglav").on("pageshow",function(){
	var action_id=$("#zamglav input[name=action_id]").val();
	if ($("#zamglav input[name=action_id]").val()=="") {
		$("#zamglav").hide();
		$.mobile.loading( "show" );
		$.mobile.changePage( "#zamglavList", { changeHash: true }); 
	}
	var details=$("#zamglavList #clientlist").html();
	$("#zamglav table#client").hide().html(details);
	$("#zamglav table#client tbody tr[aid!="+action_id+"]").remove();
	$("#zamglav table#client").show();

});


$(document).on("pageinit",function(){
		var page=$("#zamglavList"); 
		zamglav_get_calendar();
		oprooms_init(page);
});


function oproomMenu_init() {
	var menu=$("#zamglavList #oproomMenu");
 	$("#oprooms a[href=#oproomMenu]").on("click",function(){
 		$("#oproomMenu").data("oid",$(this).next("ul").attr("oid"));
 	});
 	$("#oproomMenu li a.approve").on("click",function(){
 		$("#oproomMenu").popup("close"); 
 		var oid=$("#oproomMenu").data("oid");
 		$("#oprooms").find("ul[opr="+oid+"] li").each(function(){
 			var aid=$(this).attr("aid");
 			$("#clientlist tr[aid="+aid+"]").find("input[type=checkbox]").trigger("click").val("on"); 
 		});
 		$("#zamglavMenu a.approve").trigger("click");
 	});
	$("#oproomMenu li a.print").on("click",function(){
		var date=$("#zamglavList input[name=workDate]").val();
		var oid=$("#oproomMenu").data("oid");
		var actions="";
		$("ul#oproom-"+oid+" li[aid]").each(function() { 
			actions=actions+"&aid[]="+$(this).attr("aid");
		}); 
		var link="/json/print_forms.php?mode=oproom&date="+date+"&orgStr_id="+oid+actions ;
		$(this).attr("href",link);
		$("#oproomMenu").popup("close"); 
	});
 }

function zamglav_nazn_submit() {
$( "#zamglav form#nazn a.submit" ).on( "click", function(  ) {
	if (checkRequired($( "#zamglav form#nazn"))) {
	var formdata=$("#zamglav form#nazn").serialize() ;
	$.post("/json/operation.php?mode=zavnazn_oper_submit",formdata,function(data){
		footer_notify("Операция подтверждена","success");
//		}
	});
	} else { 
		footer_notify("Не заполнены обязательные поля","error");	
	} 
});
}

function zamglav_get_calendar() {
var date=$("#zamglavList  input[name=workDate]").val();
$.get("/forms/calendar.php?date="+date,function(data){
	var calendar=$("#zamglavList  #calendar")
	calendar.html(data);
	var head=calendar.find("h2:first"); 
	calendar.prev("div[data-role=header]").find("h2").html("Операционный календарь: "+head.html());
	head.remove();
});
}

function zamglav_multi_approve() {
	$("#zamglavMenu a.approve").on("click",function(){
		$.mobile.loading( "show" );
		var actions="&date="+$("#zamglavList input[name=workDate]").val();
		$("#zamglavList #clientlist tbody tr").each(function(){
			if ($(this).find("input").val()=="on") {
				actions=actions+"&aid[]="+$(this).attr("aid");
				var aid=$(this).attr("aid");
				$("#zamglavList #clientlist tbody tr[aid="+aid+"]").removeAttr("class").addClass("status-1");
				$("#zamglavList #oprooms li[aid="+aid+"]").removeAttr("class").addClass("status-1");
				$("#clientlist tr[aid="+aid+"]").find("input[type=checkbox]").trigger("click").val("on"); 
			} 
		});
		$.post("/json/operation.php?mode=zamglav_multi_approve",actions,function(data){ 
			zamglav_get_calendar(); 
			footer_notify("Операция подтверждена","success"); 
			setTimeout(function(){  $.mobile.loading( "hide" ); },100);
		});
	});
	
	$("#zamglavList #clientlist tbody tr input[type=checkbox]").on("change",function(){
 		if ($(this).attr("data-cacheval")=="false") {$(this).val("on");} else {$(this).val("off");}  
	}); 
}

function zamglav_oproom_submit() {
	
}
