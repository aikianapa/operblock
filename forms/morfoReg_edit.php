<div data-role="page" data-theme="a" id="morfoRegEdit" data-ajax="false">
<div data-role="header"><h2>Регистрация биоматериала</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<div data-role="content" >
<form id="morfoReg">
<input type="hidden" name="action_id">
<input type="hidden" name="parent_id">
<input type="hidden" name="person_id">
<input type="hidden" name="event_id">
<input type="hidden" name="actionType_id">
<div data-role="foreach" from="morfoReg">
<div ><label>{{label}}</label> 
{{input}}
</div>
</div>
<input type="hidden" name="status" value="1">
<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
<a href="#" data-rel="back" class="list ui-btn ui-btn-inline ui-corner-all">Отмена</a>

</form>
</div>
</div>


