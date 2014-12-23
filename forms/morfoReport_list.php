<div data-role="page" data-theme="a" id="morfoReportList" data-url="/morfoReport/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Журнал исследований</h2></div>


<div data-role="content">

<div data-role="tabs" id="tabs">
		<div data-role="navbar"><ul>
			<li><a href="#tab-1" data-ajax="false">Журнал</a></li>
			<li><a href="#tab-2" data-ajax="false">Календарь</a></li>
			<li><a href="#tab-3" data-ajax="false">Отчёты</a></li>
		</ul></div>

		<div id="tab-1" class="ui-body-d ui-content">

			<div class="filter">			
				<div>
					<div  style="display:inline;font-weight:bold;margin-left:20px; "> Рабочая дата <div style="display:inline-block">
					<input type="datepicker" data-role="date" data-mini="true" required name="workDate"></div></div>
					<div  style="display:inline;font-weight:bold;margin-left:20px; "> до <div style="display:inline-block">
					<input type="datepicker" data-role="date" data-mini="true" name="endDate" data-clear-btn="true"></div></div>
				</div>

				<fieldset data-role="controlgroup" data-type="horizontal"  style="display: inline-block;">
					<legend>Состояние:</legend>
					<input type="radio" name="status" id="status-all" value="all" checked="checked">
					<label for="status-all">Все</label>
					<input type="radio" name="status" id="status-on" value="on">
					<label for="status-on">Назначеные</label>
					<input type="radio" name="status" id="status-off" value="off">
					<label for="status-off">Выполненные</label>
				</fieldset>
				<a href="" class="print_list ui-btn ui-corner-all ui-btn-inline" target="_blank">Печать журнала</a>
			    <input id="filterTable-input" data-type="search" style="display: inline-block;">
			</div>


					<table data-role="table" data-filter="true" data-input="#filterTable-input" class="ui-responsive" id="clientlist">
					<thead><tr><th>№ ИБ</th><th>Дата исследования</th><th>Ф.И.О.&nbsp;пациента</th><th>Клинический диагноз</th><th>Паталогоанатомическое заключение</th><th>Пред.исследование</th><th>Врач патолог</th><th>&nbsp;</th></tr></thead>
					<tbody>
					<div data-role="foreach" from="result">
					<tr aid="{{action_id}}" class="status-{{status}}">
					<td>{{externalId}}</td>
					<td>{{begDate}}</td>
					<td>{{client}}<br />({{age}} лет)</td>
					<td>{{diagnose}}</td>
					<td>{{morfoResult}}</td>
					<td>{{morfoPrev}}</td>
					<td>{{person}}</td>
					<td><a href="#printMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Печать</a></td>
					</tr></div>
					</tbody></table>


				<div data-role="popup" id="printMenu" data-theme="a">
					<ul data-role="listview" data-inset="true" style="min-width:210px;">
						<li data-role="list-divider">Выберите действие</li>
						<li><a href="#nazn" data-transition="flip">Назначение</a></li>
						<li><a href="#reg" data-transition="flip">Регистрация</a></li>
						<li><a href="#lab" data-transition="flip">Исследование</a></li>
						<li><a href="" data="/json/print_forms.php?mode=morfoNazn"  target="_blank">Печать</a></li>
					</ul>
				</div>

		</div>

		<div id="tab-2" class="ui-body-d ui-content">
			<div id="calendar"></div>
		</div>

	<div id="tab-3">
	<form id="Podr" data-rel="orgstr">
		<div data-role="foreach" from="repForm">
		<div data-role="fieldcontain"><label>Период c</label><input type="datepicker"  data-mini="true" required name="begDateR"></div>
		<div data-role="fieldcontain"><label>по</label><input type="datepicker"  data-mini="true" name="endDateR"> </div>
		<div data-role="fieldcontain"><label>Исследование</label>
		<select  data-mini="true" name="actionType_id[]" multiple data-native-menu="false"><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Подразделение</label>
		<select  data-mini="true" name="orgStr[]" multiple data-native-menu="false" ><option value="">Выберите...</option></select>
		</div>
		<div data-role="fieldcontain"><label>Срочно</label><input type="checkbox"  data-mini="true" value="0" name="urgent"></div> 
		<div data-role="fieldcontain"><label>Планово</label><input type="checkbox"  data-mini="true" value="0" name="planed"></div>
		<div data-role="fieldcontain"><label>Осложнение</label><input type="checkbox"  data-mini="true" value="0" name="problem"></div>
		<div data-role="fieldcontain"><label>Детализация</label><input type="checkbox"  data-mini="true" value="0" name="details"></div>
		<a href="#report" data-role="button" data-inline="true">Построить отчёт</a>
		</div>
	</form>
	</div>
</div>
</div>

<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<script type="text/javascript" src="/forms/morfoForms.js"></script>

<link rel="stylesheet" href="/style.css" />
<style>
@media screen {
.ui-dialog-contain {max-width:90%;}
}
@media print {
#morfoReportList {display:none;}
div.print-area {display:block;}

table {width:95%; font-size:12px;}
td {border:1px #999 solid;}
tr.urgent {font-weight: bold; background:#ddd; text-align: center;}
tr.planed {font-weight: bold; background:#ddd; text-align: center;}
.total, .total_urg, .total_pln, .total_otd {font-weight: bold; background:#ccc;}
tr.oid {font-weight: bold; text-align: center;}


}
</style>
