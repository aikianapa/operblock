<div data-role="page" data-theme="a" id="morfoLabEdit" data-ajax="false">
<div data-role="header"><h2>Проведение исследования</h2>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a></div>
<div data-role="content" >
	<div style="width:20%; clear:none; display:inline-block; vertical-align:top;">
		<button class='add-morfo-loc ui-btn ui-corner-all ui-btn-icon-left ui-icon-plus'>Локализация</button>
		<ul data-role="listview" data-inset="true" class="loc-list ui-hidden"></ul>
		<ul data-role="listview" data-inset="true" class="loc-ready"></ul>
	</div>
	<div style="width:78%; clear:right; display:inline-block; vertical-align:top;">
		<form id="morfoLab">
		<input type="hidden" name="action_id">
		<input type="hidden" name="parent_id">
		<input type="hidden" name="person_id">
		<input type="hidden" name="event_id">
		<input type="hidden" name="actionType_id">
		<div class="actionProperty">
			<div data-role="header"><h2>Пожалуйста, укажите локализацию!</h2></div>
		</div>

		<input type="hidden" name="status" value="2">
		<div class="actionButtons ui-hidden">
		&nbsp;
		<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
		<a href="#" data-rel="back" class="ui-btn ui-btn-inline ui-corner-all">Отмена</a>
		</div>
		</form>
	</div>
</div>

</div>

