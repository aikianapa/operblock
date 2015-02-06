<div data-role="page" data-theme="a" id="zavedanList" data-url="/zavedan/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="content" >
<div data-role="fieldcontain"><label>Рабочая дата</label><input type="datepicker" data-role="date" data-inline="true" required name="workDate"></div>
<input type="hidden" name="orgStr_id">
<input type="hidden" name="person_id">
<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			<li><a href="#tab-2" data-ajax="false" class="ui-btn-active">Подтверждение операционных списков</a></li>
			<li><a href="#tab-1" data-ajax="false">Список операций</a></li>
			<li><a href="#tab-3" data-ajax="false">Календарь</a></li>
		</ul></div>

		<div id="tab-1" class="ui-body-d ui-content">
		<h2>Список назначеных операций</h2>
		<table data-role="table" class="ui-responsive" id="clientlist">
		<thead><tr><th>№ ИБ</th><th>Ф.И.О.</th><th>Возраст</th><th>Дата операции</th><th>Операция</th><th>Врач</th><th>Палата</th><th>&nbsp;</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}"  sid="{{spisanie_ob}}" date="{{begDate}}">
		<td>{{externalId}}</td>
		<td>{{client}}</td>
		<td>{{age}}</td>
		<td>{{begDate}}</td>
		<td>{{specifiedName}}</td>
		<td>{{person}}</td>
		<td>{{palata}}</td>
		<td><a href="#mainsisMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Меню</a></td>
		</tr></div>
		</tbody></table>
<div data-role="popup" id="mainsisMenu">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#nazn">Редактировать назначение</a></li>
            <li><a href="#spis">Редактировать списание</a></li>
            <li><a href="#" data="/json/print_forms.php?mode=spisanie_1" class="print" target="_blank">Печать списания</a></li>
        </ul>
</div>
		</div>
 

<div id="tab-2" class="ui-body-d ui-content">
<div data-role="header"><h3>Подтверждение операционных списков</h3></div> 
<div data-role="include" src="/forms/oprooms_tab.php"></div>

<div data-role="popup" id="opMenu"> 
	<ul data-role="listview">
	<li><a href="#" class="ui-icon-lock lock">Блокировка</a></li>
	<li><a href="#" class="ui-icon-bars print" target="_blank">Печать</a></li>
	<li data-role="list-divider">Перенести в:</li>
	<div data-role="foreach" from="oprooms">
		<li><a href="#" class="oper" oper="{{id}}">{{name}}</a></li>
	</div>
	</ul>
</div>

<div data-role="popup" id="oproomMenu"> 
	<ul data-role="listview">
	<li data-role="list-divider">Меню операционной</li>
	<li><a href="#" class="ui-icon-lock lock">Блокировка</a></li>
	<li><a href="#" class="approve" target="_blank">Утвердить операционную</a></li>
	<li><a href="#" class="print" target="_blank">Печать списка операций</a></li>
	</ul>
</div>


</div>

<div id="tab-3" class="ui-body-d ui-content">
<div data-role="header"><h3>Операционный календарь</h3></div>
	<div id="calendar"></div>
</div>

</div>
</div>


<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>


<!-- Форма назначений для Старшей сестры оперблока  ==================
=========================================== -->
<div id="zavedanNazn" data-theme="a" data-role="page"  data-ajax="true" >
<div data-role="header"><h2>Назначения</h2></div>
<div data-role="content">
<table data-role="table" class="ui-responsive" id="client">
</table>
<form class="nazn">
<div class="ui-widget">
<input type="hidden" name="action_id">
<input type="hidden" name="oper_id">
<div data-role="fieldcontain">
<label>Дата</label><input type="datepicker"  data-inline="true" required name="begDate"></div>

<div data-role="fieldcontain">
<label>Время</label><input type="time"  data-inline="true" name="begTime">
</div>

<div data-role="fieldcontain"><label>Анестезиолог</label>
<select name="an_person_id" data-native-menu="true"><option value="">Выберите...</option></select>
</div>
<div data-role="fieldcontain"><label>Анестезиологическая сестра</label>
<select name="an_sister_id"  data-native-menu="true"><option value="">Выберите...</option></select>
</div>



<a href="#" data-rel="back" class="cancel ui-btn ui-btn-inline ui-corner-all">Вернуться</a>
<a href="#" class="submit ui-btn ui-btn-inline ui-corner-all">Сохранить</a>
<a href="#cancelOp" class="ui-btn ui-btn-inline ui-corner-all" style="float:right;" data-rel="popup">Отменить операцию</a>
</div>
</form>
</div>

<div data-role="include" src="/forms/cancel_operation.php"></div> 
<div data-role="include" src="/forms/sisterob_spisanie.php"></div> 

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2></div>
</div>

<!-- ======================================== -->
<script type="text/javascript" src="/forms/msk36/zavedan_list.js"></script>


<link rel="stylesheet" href="/style.css" />
<style>
#common-tables {list-style: none; display: block;}  
#common-tables > div {display: inline-block; width: 165px; padding:5px; list-style: none; margin: 2px;}  
#tables div.add_table {display: none;}
#tables .table-drop .delete {display:none;}
.tables_otdel {display: inline;}
</style>
