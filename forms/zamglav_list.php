<div data-role="page" data-theme="a" id="zamglavList" data-url="/zamglav/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="content" >
<div data-role="fieldcontain">
		<label>Рабочая дата</label><input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div> 
<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			<li><a href="#tab-3" data-ajax="false"  class="ui-btn-active">Операционные</a></li>
			<li><a href="#tab-1" data-ajax="false">Назначеные операции</a></li>
			<li><a href="#tab-2" data-ajax="false">Операционный календарь</a></li>
		</ul></div>

		<div id="tab-1" class="ui-body-d ui-content">
		<div data-role="header"><a href="#zamglavMenu" data-rel="popup" class="ui-btn ui-btn-inline ui-icon-bars ui-btn-icon-left ui-corner-all">Меню</a><h2>Список назначеных операций</h2></div>
		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>Утв.</th><th>№ ИБ</th><th>Ф.И.О.</th><th>Операция</th><th>Дата операции</th><th>Диагноз</th><th>Врач</th><th>Палата</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}">
		<td><input type="checkbox" value="off"></td>
		<td>{{externalId}}</td>
		<td>{{client}}<br />({{age}} лет)</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td>{{diagnose}}</td>
		<td>{{person}}</td>
		<td>{{palata}}</td>
		</tr></div>
		</tbody></table>
	</div>


<div id="tab-2" class="ui-body-d ui-content">
<div data-role="header"><h2>Операционный календарь: </h2></div>
<div id="calendar"></div>
</div>

<div id="tab-3" class="ui-body-d ui-content">
<div data-role="include" src="/forms/oprooms_tab.php"></div>
</div>

<div data-role="popup" id="oproomMenu">
	<ul data-role="listview">
	<li><a href="" class="approve" target="_blank">Утвердить операции</a></li> 
	<li><a href="#" class="print" target="_blank">Печать списка операций</a></li>
	</ul>
</div>

<div data-role="popup" id="zamglavMenu"> 
	<ul data-role="listview">
	<li><a href="" class="approve" target="_blank">Утвердить отмеченные</a></li> 
	<li><a href="#" class="print" target="_blank">Печать списка операций</a></li>
	</ul>
</div>

</div>
</div>

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<!-- Форма назначений для Замглавврача  ==================
=========================================== -->
<div id="zamglav" data-theme="a" data-role="page"  data-ajax="true" > 
<div data-role="header"><h2>Назначения</h2></div>
<div data-role="content">
<table data-role="table" class="ui-responsive" id="client">
</table>
<form id="nazn">
<div class="ui-widget">
<input type="hidden" name="action_id">

<div data-role="fieldcontain"><label>Подтвердить операцию</label>
    <select id="flip-select-second" name="zam_ok" data-role="flipswitch">
        <option value="0">Нет</option>
        <option value="1">Да</option>
    </select>
</div>

<div data-role="fieldcontain">
<label>Дата</label><input type="datepicker" data-role="date" data-inline="true" required name="begDate"></div>
<div data-role="fieldcontain">

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
<div data-role="fieldcontain"><label>Операционная медсестра</label>
<select name="operSister_id" data-native-menu="true" required><option value="">Выберите...</option></select>
</div>

<div data-role="fieldcontain"><label>Санитарка</label>
<input type="text" data-role="date" data-inline="true" required name="sanitar"></div>
 

<div data-role="fieldcontain"><label>Анестезиолог</label>
<select name="an_person_id" data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Анестезиологическая сестра</label>
<select name="an_sister_id"  data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Анестезиологическое пособие</label>
<textarea name="an_posobie"></textarea></div>


<div data-role="fieldcontain"><label>Примечание</label><textarea name="note"></textarea></div>
<a href="#" data-rel="back" class="cancel ui-btn ui-btn-inline ui-corner-all">Вернуться</a>
<a href="#" data-rel="back" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
<a href="#cancelOp" class="ui-btn ui-btn-inline ui-corner-all" style="float:right;" data-rel="popup">Отменить операцию</a>
</div>
</div>
</form>
</div>
<div data-role="include" src="/forms/cancel_operation.php"></div> 
<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>


<!-- ======================================== -->

<script type="text/javascript" src="/forms/zamglav_list.js"></script> 

<link rel="stylesheet" href="/style.css" />
<style>
#zamglav {width:100%;}
#zamglav form {padding:10px; }

</style>
