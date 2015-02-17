$(document).ready(function(){
$("div[data-url^='/morfoReport/list/list.htm']:hidden").remove();
$("div[data-url^='/morfoNazn/list/list.htm']:hidden").remove();
$("div[data-url^='/morfoReg/list/list.htm']:hidden").remove();
$("div[data-url^='/morfoLab/list/list.htm']:hidden").remove();
		$("a[href=#printMenu]").on("click",function(){ 
			$( document ).data( "action", $(this).parents("tr").attr("aid")); 
			$("#printMenu a[data*=print]").removeClass("ui-disabled");
			if ($(this).parents("tr").attr("payed")==0) {
				$("#printMenu a[payed=1]").addClass("ui-disabled");
			}
		});

		$("#printMenu a").on("click",function(){
			if ($(this).attr("data")>"") {
				$(this).attr("href",$(this).attr("data")+"&action="+$( document ).data( "action"));
			} else {
				$(document).data("copy_nazn",false);
				if ($(this).attr("href")=="#new") {var form="morfoNazn"; $(document).data("copy_nazn",true);}
				if ($(this).attr("href")=="#nazn") {var form="morfoNazn";}
				if ($(this).attr("href")=="#reg") {var form="morfoReg";}
				if ($(this).attr("href")=="#lab") {var form="morfoLab";}
				$.mobile.changePage( "/"+form+"/edit/"+$( document ).data("action")+".htm", { transition: "flip", changeHash: true });
			}
			$("#printMenu").popup("close");
		});
});

$(document).on("pageinit",function(){
		$( "table" ).disableSelection();

		$('input[type=datetime]').datetimepicker({
			lang:'ru', format:'Y-m-d', formatDate:'Y-m-d', timepicker:false
		});

		$("input[name=endDate]").on("change",function(){
			set_cookie("endDate",$(this).val());
			$("input[name=workDate]").trigger("change");
		});

	$("#morfoReportList").next("div#report.print-area").remove();

	var page=$("#morfoNaznList, #morfoReportList, #morfoRegList, #morfoLabList");
	page.find("input[name=status]").on("change",function(){
		var status=page.find("input[name=status]:checked").val();
		page.find("#clientlist tbody tr").each(function(){
			$(this).addClass("ui-hidden");
			if (status=="all") {$(this).removeClass("ui-hidden");}
			if (status=="on" && $(this).hasClass("status-1")) {$(this).removeClass("ui-hidden");}
			if (status=="off" && $(this).hasClass("status-2")) {$(this).removeClass("ui-hidden");} 
		});
	});
		morfoNaznSubmit();
		morfoRegSubmit();
		morfoLabSubmit();
		cancel_op_init();
});

$(document).on("pageshow",function(){
	commonFormWidgets();
});

$("#morfoNaznList, #morfoReportList, #morfoRegList, #morfoLabList").on("pageshow",function(){
	morfoStatus("#clientlist");
});


// =============== morfoReport ==============
$("#morfoReportList").on("pageinit",function(){
	morfo_get_calendar();
	morfo_reports_button();
	$("a.print_list").on("click",function(){
		var begDate=$("#morfoReportList input[name=workDate]").val();
		var endDate=$("#morfoReportList input[name=endDate]").val();
		$("#morfoReportList").next("#report").remove();
		$("#morfoReportList").after('<div id="report" class="print-area">'+$("#morfoReportList #tab-1").html()+'</div>');
		$("#morfoReportList").next("#report").find("table td b.ui-table-cell-label").remove();
		$("#morfoReportList").next("#report").find("table").removeClass("ui-responsive ui-table ui-table-reflow");
		$("#morfoReportList").next("#report").prepend("<h2>Журнал исследований c "+begDate+" по "+endDate+"</h2>");
		print("#report");
	});

	$("#clientlist").delegate("tr.status-1","click",function(){
		top.postMessage('aid='+$(this).attr("aid")+"&eid="+$(this).attr("eid"), '*'); 
	});
});

function morfo_reports_button() {
$("#morfoReportList a[href=#report]").on("click",function(){
	$("#morfoReportList").after('<div id="report" class="print-area"></div>');
	var data=$(this).parent("form").serialize();
	$.post("/json/morfology.php?mode=report_"+$(this).parent("form").attr("data-rel"),data,function(data){
		 $("#report").html(data);
		 print("#report");
	});
	return false;
});
}


function morfo_get_calendar() {
var date=$("#morfoReportList input[name=workDate]").val();
$.get("/forms/calendar.php?morfo=true&date="+date,function(data){ 
	$("#morfoReportList  #calendar").html(data); 
});
}
// ==========================================

// =============== morfoReg =================
$("#morfoRegList").on("pageinit",function(){
	$("a.print_list").on("click",function(){ print(); });
});

function morfoRegSubmit() {
	$("#morfoReg a.submit").on("click",function(){
		var formdata=$("form#morfoReg").serialize();
		$.post("/json/morfology.php?mode=morfo_reg_submit",formdata,function(data){
				setTimeout('$.mobile.back();',500);
				top.postMessage('addAction', '*');
		});

	});
}
// ==========================================

// =============== morfoLab =================
function morfoLabSubmit() {
	$("#morfoLab a.submit").on("click",function(){
		var formdata=$("form#morfoLab").serialize();
		$.post("/json/morfology.php?mode=morfo_lab_submit",formdata,function(data){
				setTimeout('$.mobile.back();',500);
				top.postMessage('addAction', '*');
		});
	});
}
// ==========================================

// =============== morfoNazn ================
$("#morfoNaznList").on("pageinit",function(){
	var tmp=document.location.search; var tmp=tmp.split('&');
	for (var key in tmp) { if (tmp[key]=="nonew=1") {$("#morfoNaznList div.ref").remove();} }
	if ($("#morfoNaznList div.ref").length) {
		$.mobile.changePage( "/morfoNazn/edit/_new.htm"+document.location.search, { transition: "none", changeHash: true });
	}
});

function morfoNaznSubmit() {
	$("#morfoNazn a.submit").on("click",function(){
		var formdata=$("form#morfoNazn").serialize();
		var aid=$("#morfoNazn input[name=action_id]").val();
		var eid=$("#morfoNazn input[name=event_id]").val();
		var cid=$("#morfoNazn input[name=client_id]").val();
		var pid=$("#morfoNazn input[name=person_id]").val();
		var atid=$("#morfoNazn input[name=actionType_id]").val();
		var ajax="/json/morfology.php?mode=morfo_nazn_submit";
		if ($(document).data("copy_nazn")==true) {var ajax="/json/morfology.php?mode=morfo_nazn_submit&copy="+$( document ).data( "action" );}
		$.post(ajax,formdata,function(data){
				top.postMessage('addAction', '*');
				$.mobile.back();
				setTimeout(" document.location.href=document.location.href; ",200);
				
		});

	});
}
// ==========================================

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
// ==========================================
