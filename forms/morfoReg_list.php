<div data-role="page" data-theme="a" id="morfoRegList" data-url="/morfoReg/list/list.htm?null=&person_id={{person_id}}" data-ajax="false">
<div data-role="header"  data-position="fixed"><h2>Регистрация биоматериала</h2></div>


<div data-role="content" >

<div class="filter">
<div>
<div  style="display:inline;font-weight:bold;margin-left:20px; "> Рабочая дата <div style="display:inline-block">
<input type="datepicker" data-role="date" data-mini="true"  required name="workDate"></div></div>

<div  style="display:inline;font-weight:bold;margin-left:20px; "> до <div style="display:inline-block">
<input type="datepicker" data-role="date" data-mini="true" name="endDate" data-clear-btn="true"></div></div>
</div>
<input type="hidden" name="person_id">


    <fieldset data-role="controlgroup" data-type="horizontal"  style="display: inline-block;">
        <legend>Состояние:</legend>
        <input type="radio" name="status" id="status-all" value="all" checked="checked">
        <label for="status-all">Все</label>
        <input type="radio" name="status" id="status-on" value="on">
        <label for="status-on">Назначеные</label>
        <input type="radio" name="status" id="status-off" value="off">
        <label for="status-off">Выполненные</label>
    </fieldset>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <fieldset data-role="controlgroup" data-type="horizontal"  style="display: inline-block;">
        <input type="radio" name="place" id="hosp-all" value="all" checked="checked">
        <label for="hosp-all">Все</label>
        <input type="radio" name="place" id="hosp-on" value="on">
        <label for="hosp-on">Стационар</label>
        <input type="radio" name="place" id="hosp-off" value="off">
        <label for="hosp-off">Амбулатория</label>
    </fieldset>
    <a href="" class="print_list ui-btn ui-corner-all ui-btn-inline" target="_blank">Печать журнала</a>
    <input id="filterTable-input" data-type="search" style="display: inline-block;">
</div>
		<table data-role="table" data-filter="true" data-input="#filterTable-input" class="ui-responsive" id="clientlist">
		<thead><tr><th>Ф.И.О.&nbsp;пациента</th><th>Контакты</th><th>Отделение</th><th>Исследование</th><th>Дата назначения</th><th>&nbsp;</th></tr></thead>
		<tbody>
		<div data-role="foreach" from="result">
		<tr aid="{{action_id}}" class="status-{{status}}" is-hosp={{isHosp}}>
		<td>{{client}}<br />({{age}} лет)</td>
		<td>{{contacts}}</td>
		<td>{{orgStrShort}}</td>
		<td>{{operation}}</td>
		<td>{{begDate}}</td>
		<td><a href="#printMenu" data-rel="popup" data-transition="slideup" class="ui-btn ui-corner-all ui-shadow ui-icon-action ui-btn-icon-notext">Печать</a></td>
		</tr></div>
		</tbody></table>

	<div data-role="popup" id="printMenu" data-theme="a">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Выберите действие</li>
            <li><a href="#new" data-transition="flip">Доп. исследование</a></li>
            <li><a href="#reg" data-transition="flip">Регистрация</a></li>
            <li><a class='print'>Печать заключения</a></li>
        </ul>
	</div>


<div data-role="footer" data-position="fixed">
<div class="notify"></div>
<h2>{{_SETTINGS_footer}}</h2>
</div>
</div>

<script type="text/javascript" src="/forms/morfoForms.js"></script>


<link rel="stylesheet" href="/style.css" />
