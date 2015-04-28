<div data-role="page" data-theme="a" id="morfoNaznEdit" data-ajax="false">
<div data-role="header"><h2>Назначение исследования</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<div data-role="content" >
<form id="morfoNazn">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="client_id">
<input type="hidden" name="person_id">
<input type="hidden" name="actionType_id">
<label><input type="checkbox" data-mini="true" name="isUrgent" >Экстренно</label>
<div data-role="fieldcontain"><label>Планируемая дата</label><input type="datepicker" name="plannedEndDate" required></div>
<div data-role="fieldcontain"><label>Количество</label><input type="number" name="amount" min="1" required></div>
<div data-role="foreach" from="morfoNazn">
<div ><label>{{label}}</label> 
{{input}}
</div>
</div>
<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
<a href="#"  data-rel="back" class="list ui-btn ui-btn-inline ui-corner-all">Отмена</a>
<a href="#cancelOp" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-delete ui-corner-all" style="float:right;" data-rel="popup">Отменить исследование</a>
</form>
</div>
<div data-role="include" src="/forms/cancel_morfo.php"></div> 
</div>

