<div data-role="page" data-theme="a" id="zavedList" data-url="/zaved/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="content" >
<div data-role="fieldcontain"><label>Рабочая дата</label>
<input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div>
<input type="hidden" name="orgStr_id">
<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			  <li><a href="#tab-1" data-ajax="false" class="ui-btn-active">Назначеные операции</a></li>
			  <li><a href="#tab-2" data-ajax="false">Распределение по столам</a></li>
			   <li><a href="#tab-3" data-ajax="false">Календарь</a></li>
		</ul></div>


		<div id="tab-1" class="ui-body-d ui-content">
		<div data-role="header"><h2>Список назначеных операций</h2></div> 
		
		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.</th><th>Операция</th><th>Дата операции</th><th>Диагноз</th><th>Врач</th><th>Палата</th><th>&nbsp;</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}" title="{{action_id}}">
		<td>{{externalId}}<span class="ui-hidden">{{tooltip}}</span></td>
		<td>{{client}}<br />({{age}} лет)</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td>{{diagnose}}</td>
		<td>{{person}}</td>
		<td>{{palata}}</td>
		<td><a href="#zavedMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Меню</a></td>
		</tr></div>
		</tbody></table>
<div data-role="popup" id="zavedMenu">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#nazn">Назначение</a></li>
            <li><a href="#" class="protocol" target="_blank">Протокол</a></li>
        </ul>
</div>
		</div>


<div id="tab-2" class="ui-body-d ui-content">
<div data-role="header"><h2>Распределение пациентов по столам</h2></div>
<div id="tables">
	<div class="drag-zone-apps common-list">
		<ul class="ui-draggable " id="common-list">
		<div data-role="foreach" from="result">
		<li tid='{{table}}' class="status-{{status}}" aid="{{id}}" ><a href="#" title="{{id}}"><span class="ui-hidden">{{tooltip}}</span>Пациент: {{client}}<br />Хирург: {{person}}</a>
    	<div class="warn">
			<div class="time">{{begTime}}</div>
			<div class="blood-warn-{{blood_warning}} ui-red">!</div>
			<div class="urgent-warn-{{isUrgent}} ui-red">Э</div>
			</div>
    </li>
		</div>
		</ul>
	</div>
	
	
	<div data-role="foreach" from="tables">
		<div class="drag-zone-apps table-drop">
		<a href="#table_menu" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-icon-left">{{name}}</a>
		<ul class="ui-draggable table" id="table-{{id}}" tid="{{id}}">
		</ul>
		</div>
	</div>
	<div class="add_table drag-zone-apps ui-corner-all ui-btn ui-btn-inline ui-icon-plus ui-btn-icon-top">
		Добавить стол
	</div>
</div>
<div data-role="popup" id="table_menu">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#lock" class="lock ui-icon-lock">Разблокировать</a></li>
            <li><a href="" target="_blank" class="ui-icon-bars print">Печать</a></li>
            <li><a href="#zavtable" class="ui-icon-check">Утвердить стол</a></li>
            <li><a href="#delete" class="ui-icon-delete">Удалить стол</a></li> 
        </ul>
</div>
</div>

<div id="tab-3" class="ui-body-d ui-content">
<div data-role="header"><h3>Операционный календарь</h3></div>
	<div id="calendar"></div>
</div>


</div>




<div data-role="popup" id="new_table_num">
<div data-role="header">
<a href="" class="submit ui-btn ui-btn-inline ui-corner-all ui-icon-delete">Создать</a>
<h3>Номер</h3>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
</div>
<form>
<input name="new_table_num" type="text" data-inline="true">
</form>
</div>

</div>

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<div data-role="include" src="/forms/hirurg_operation.php"></div> 

<!-- Форма назначений для Заведующего  ==================
=========================================== -->
<div id="zavnazn" data-theme="a" data-role="page"  data-ajax="true" >
<div data-role="header"><h2>Назначения</h2></div>
<div data-role="content">
<table data-role="table" class="ui-responsive" id="client">
</table>
<form class="nazn">
<div class="ui-widget">
<input type="hidden" name="action_id">
<textarea style="display:none" name="cancelNote"></textarea>
<div data-role="fieldcontain">
<label>Дата</label><input type="datepicker" data-role="date" data-inline="true" required name="begDate"></div>
 <div data-role="fieldcontain"><label>Хирург</label>
<select name="person_id" data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Ответственный за переливание крови</label>
<select name="hemo_id"  data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Ассистенты</label>
<select name="assist_id[]" multiple="multiple"  data-native-menu="false" ><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Ассистенты (доп.)</label>
<input name="assist_name"></div>

<div data-role="fieldcontain"><label>Дежурный по оперблоку</label>
<select name="dejur_id"   data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Примечание</label><textarea name="note"></textarea></div>
<a href="#" class="submit ui-btn ui-btn-inline ui-btn-icon-left ui-icon-check ui-corner-all">Сохранить</a>
<a href="#" data-rel="back" class="cancel ui-btn ui-btn-inline ui-btn-icon-left ui-icon-back ui-corner-all">Вернуться</a>
<a href="#cancelOp" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-delete ui-corner-all" style="float:right;" data-rel="popup">Отменить операцию</a>

</div>
</form>
</div>

<div data-role="include" src="/forms/cancel_operation.php"></div> 

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>

<!-- ======================================== -->


<!-- Форма утверждения операционного стола ===============
=========================================== -->
<div id="zavtable" data-theme="a" data-role="page"  data-ajax="true" >
<div data-role="header"><h2>Утверждение операционного стола</h2></div>
<div data-role="content">

<form> 
<input type="hidden" name="id">
<input type="hidden" name="orgStr_id">
<input type="hidden" name="action_id">
<input type="hidden" name="table">
<input type="hidden" name="workDate"> 
<div data-role="fieldcontain">

<div data-role="fieldcontain"><label>Ответственный за переливание крови</label>
<select name="hemo_id" data-native-menu="true" required><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Ассистенты</label>
<select name="assist_id[]" multiple="multiple"  required data-native-menu="false" ><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Ассистенты (доп.)</label>
<input name="assist_name"></div>

<div data-role="fieldcontain"><label>Дежурный по оперблоку</label>
<select name="dejur_id"   data-native-menu="true" required><option value="">Выберите...</option></select>
</div>

<a href="#" data-rel="back" class="cancel ui-btn ui-btn-inline ui-corner-all">Вернуться</a>
<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
</div>

</form>
</div>
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>


<!-- ======================================== -->
 <script type="text/javascript" src="/forms/zaved_list.js"></script>

<link rel="stylesheet" href="/style.css" />
<style>
#zavnazn {width:100%;}
#zavnazn form {padding:10px; }
#new_table_num {width:300px;}
#new_table_num form {padding: 10px;}
</style>
