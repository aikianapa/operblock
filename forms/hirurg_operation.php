<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Хирург. Проведение операции.</h2></div>
<div data-role="content" >
	<form id="operation">
	<input type="hidden" name="action_id" >
	<div data-role="fieldcontain"><label>Время начала операции</label><input type="time" name="begTime"  ></div>
	<div data-role="fieldcontain"><label>Время окончания операции</label><input type="datetime" required name="endDate" ></div>
	<div data-role="fieldcontain"><label>Кровопотеря</label><input type="text" name="blooding"  ></div>
	<div data-role="fieldcontain"><label>Диагноз после операции</label><input type="text" name="diagnoz" ></div>
	<div data-role="fieldcontain"><label>Осложнения во время операции</label><input type="text" name="problems"  ></div>
	<div data-role="fieldcontain"><label>Осложнения после операции</label><input type="text" name="problemsAfter"  ></div>
	<div data-role="fieldcontain"><label>Исход операции</label>
	<select 	name="result" data-mini="true" data-native-menu="false" required>
		<option value="1" selected>Выписка</option>
		<option value="0">Смерть</option>
    </select>
	</div>
	<div data-role="fieldcontain"><label>Препарат</label><input type="text" name="drugs" ></div>
	<div data-role="fieldcontain"><label>Протокол операции</label><textarea name="protocol" ></textarea></div>
	
	<a href="#" class="submit ui-btn ui-btn-inline ui-btn-icon-left ui-icon-check ui-corner-all">Сохранить</a>
	<a href="#" data-rel="back" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-back  ui-corner-all">Выйти</a>
	<a href="#cancelOp" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-delete ui-corner-all" style="float:right;" data-rel="popup">Отменить операцию</a>
	</form>
	<div data-role="include" src="/forms/cancel_operation.php"></div>
</div>
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>
</div>
