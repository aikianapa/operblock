<div data-role="popup" data-theme="a" id="cancelOp" datatransition="flip" data-ajax="false">
<div data-role="header"><h2>Отмена операции</h2><a href="#" data-rel="back" class="ui-btn ui-btn-inline ui-btn-icon-notext ui-icon-delete ui-btn-right ui-corner-all">Back</a></div>

<div data-role="content" >
<form>
<input type="hidden" name="person_id">
<input type="hidden" name="action_id">
<div class="filter">
Отменить операцию: 
    <select id="filter" name="filter" data-role="flipswitch" data-inline="true" >
        <option selected="" value="0">Нет</option> 
        <option value="1">Да</option>
    </select> 
</div>
<div data-role="fieldcontain"><label>Причина</label><textarea name="cancelNote" required></textarea></div> 
<a href="" data-ajax="false" data-rel="back" class="cancel_op ui-btn ui-corner-all">Отменить операцию</a>
</form>
</div>

</div>

<script language="javascript">
	$(document).on("pageshow",function(){
		$("#cancelOp form")[0].reset();
	});
	$(document).ready(function(){
		cancel_op_init();
	});

function cancel_op_init() {
	$("#cancelOp a.cancel_op").on("click",function(){
		if ( $("#cancelOp select[name=filter]").val()==1 && $("#cancelOp textarea[name=cancelNote]").val()>" "  ) {
			var formdata=$("#cancelOp form").serialize() ;
			$.post("/json/operation.php?mode=cancel_operation",formdata,function(data){
			setTimeout(function(){
				$("#cancelOp").popup("close");
				document.location.href=$("div[data-role=page][data-ajax=false]").attr("data-url");
			},500); 
			});
		} else {
			$.mobile.loading( "hide" ); 
			return false;
		}
	});
}	

</script>
