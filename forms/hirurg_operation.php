<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Хирург. Проведение операции.</h2></div>
<div data-role="content" >
<form id="operation">
	<input type="hidden" name="action_id" >
	<input type="hidden" name="person_id" >
	<input type="hidden" name="orgStrId" >
	<input type="hidden" name="actionType_id" >

<select name="operType_id" id="operType" required data-native-menu="false" data-filter="true" data-input='#operType-filter' >
	<option value="">Выберите тип опреации...</option>
</select>
<div><label>Наименование операции</label>
<textarea name="specifiedName"></textarea>
</div>
	
<div data-role="foreach" from="protocol">
<div ><label>{{label}}</label> 
{{input}}
</div>
</div>	

	<a href="#" class="submit ui-btn ui-btn-inline ui-btn-icon-left ui-icon-check ui-corner-all">Сохранить</a>
	<a href="#" data-rel="back" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-back  ui-corner-all">Выйти</a>
	<a href="#cancelOp" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-delete ui-corner-all" style="float:right;" data-rel="popup">Отменить операцию</a>
	</form>
	<div data-role="include" src="/forms/cancel_operation.php"></div>
</div>

</div>
<style>
.ui-dialog-contain {max-width:99%;}
</style>
