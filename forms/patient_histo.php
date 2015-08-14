
<!-- Направление на гистологию -->

<div data-role="page" data-theme="a" id="histo" >
<div data-role="header"><h2>Направление на гистологию</h2></div>
<div data-role="content">
<a href="#" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<form id="patient_histo_form">
<input type="hidden" name="action_id">
<div data-role="foreach" from="formHisto">
<div><label>{{label}}</label>
{{input}}
</div>
</div>
<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</form>
</div>


<script language="javascript">
$(document).ready(function(){
	$("div[data-url^='/patient/histo/']:hidden").remove(); 
});
$(document).on("pageinit",function(){
	commonFormWidgets();
	popup_data(this,"histo","histology");
});

function popup_data(that,name,dataname) {
	var action_id=$( "#patientNazn" ).data( "action");
	if (dataname=="undefined") {var dataname=name;}
	$(that).find("form")[0].reset();  
	if (action_id>"") {
			$(that).find("form input[name=action_id]").val(action_id); 
			$.get("/json/operation.php?mode=zavnazn_get_data&action_id="+action_id,function(data){
				var data = JSON.parse(data);
				data=data[dataname]; 
				$.each(data, function(key, value) {
						$(that).find("form [name="+key+"]").val(value);
						$(that).find("form [multiple][name^="+key+"]").val(value);
						if ($(that).find("form [name^="+key+"]").is("select")) {
							$(that).find("form [name^="+key+"]").trigger("change");
						}
				});
			});
	} 
}
</script>
