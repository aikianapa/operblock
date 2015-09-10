<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Предоперационный эпикриз</h2></div>
<div data-role="content" >
<div class="copytext">
<div id="form-027u"  class="print_page">
<form method="post">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="person_id">
<p style="text-align:center; font-size:14pt;">
<b><b class='header'>{{OrgName}}</b><br />
{{orgStr}}<br /></p>
<hr />
<p style="text-align:center;">
{{OrgAddr}}                                                   тел. +7 {{OrgPhone}}</b>
<br />
<h2 style="font-size:14pt;">ПРЕДОПЕРАЦИОННЫЙ ЭПИКРИЗ <div style="font-size:10px;">от <input style="width: 160px;font-size: 10pt;" class="small" type="text" name="s_date2" value="{{s_date2}}"> </div></h2>
</p>

<ul class="fields">
		<li><b>Фамилия, Имя, Отчество:</b> {{client}}, <b>возраст</b> {{age}} лет    И/Б {{externalId}}</li>
		<li> <b>Адрес</b>: <input type="text" class="medium" name="e_client_adress" value="{{e_client_adress}}"> </li>
		<li class="">
		<ul>
		<li> <b>Находился(-лась) на стационарном лечении</b> с {{s_date1}} 	по <input type="text" class="medium" name="endDate" value="{{s_date2}}">.  {{dateDiff}} </li>
		<li> <b>Наименование отделения:</b> {{orgStr}}
		<li><b><h2>Диагноз при поступлении</h2></b>
			<ul class="block">
				<li><b class="bottom-bord">Клинический диагноз:</b><textarea name="e_diag_clin_in" from="firstZavView@Клинический диагноз">{{e_diag_clin_in}}</textarea></li>
				<li><b class="bottom-bord">Основное заболевание:</b><textarea name="e_diag_main_in" from="firstZavView@Основное заболевание">{{e_diag_main_in}}</textarea></li>
				<li><b class="bottom-bord">Фоновые заболевания:</b><textarea name="e_diag_fon_in" from="firstZavView@Фоновые заболевания">{{e_diag_fon_in}}</textarea></li>
				<li><b class="bottom-bord">Осложнения основного заболевания:</b><textarea name="e_diag_comp_in" from="firstZavView@Осложнения основного заболевания:">{{e_diag_comp_in}}</textarea></li>
				<li><b class="bottom-bord">Сопутствующие заболевания:</b><textarea name="e_diag_satt_in" from="firstZavView@Сопутствующие заболевания:">{{e_diag_satt_in}}</textarea></li>
			</ul>
		</li>

		<li>Согласие пациента получено:
			<select multiple="multiple" name="e_sogl_patient[]"  >
					<option>Да</option>
					<option>Нет</option>
					<option>Либо решение об операции принято консилиумом врачей</option>
			</select>
		</li>
		<li>Показания к операции:
			<textarea name="e_pokaz_oper">{{e_pokaz_oper}}</textarea>
		</li>
		<li>Планируемое оперативное вмешательство:
			<textarea name="e_plan_oper_vmesh">{{e_plan_oper_vmesh}}</textarea>
		</li>
		<li>Группа крови и резус фактор:
			<textarea name="e_diag_grup_krovi" from="krovAnaliz@Группа крови ABO">{{e_diag_grup_krovi}}</textarea>
		</li>
		<li>Аллергический анамнез:
			<textarea name="e_al_anamnez" from="firstZavView@Аллергический анамнез">{{e_al_anamnez}}</textarea>
		</li>
		<li>Премедикация:
			<textarea name="e_premedication">{{e_premedication}}</textarea>
		</li>
		<li>Профилактика:
			<textarea name="e_profilactica">{{e_profilactica}}</textarea>
		</li>
		<li>Комментарий:
			<textarea name="e_commentarii">{{e_commentarii}}</textarea>
		</li>

</ul>
<h2>Результаты диагностических исследований</h2>
<ul class='container'>

	<li><b><h3>Результаты инструментальных методов исследований: </h3></b>
	<ul>
		<div data-role="foreach" from="res">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p>
			</li>
		</div>
	</ul><textarea name="e_researchText">{{e_researchText}}</textarea></li>

	<li><b><h3>Результаты клинико-лабораторных методов исследований:</h3></b>
	<ul class='lab-test'>
		<div data-role="foreach" from="lab">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p>
			</li>
		</div>
	</ul>
	<textarea name="e_anayseText">{{e_anayseText}}</textarea></li>
	


<br>
<br>
<span class="docDate">{{docDate}}</span><br />
Лечащий врач _________________ /{{person}}/<br>
<br />
Зав. отделением _________________ /{{orgStrBoss}}/<br>
</form>
</div>

</div>
</div>
</div>

<script language="javascript">
console.log($('#form-027u .container li'));
$("#form-027u select[multiple]").each(function(){
	$(this).css("height",$(this).find("option").length*18+"px");
});


$(document).on("click","#form-027u button[name=nevr-toggle-in]",function(e) {
	e.preventDefault();
	if(e.handled !== true) {
		e.handled = true;
		console.log($(this).parent().parent().parent());
		$(this).parent().parent().parent().find('ul[name=nevr-status-in]').slideToggle( "fast" );
	  	if ($(this).html() == 'Показать') {
	  		$(this).html('Скрыть');
	  	} else {
	  		$(this).html('Показать');
	  	}
  	}
});

$(document).ready(function(){

	if ($('span[name=status_vascularis_in]').text() != '1') {
		$('li.status_vascularis_in').hide();
	}
	if ($('span[name=status_localis_in]').text() != '1') {
		$('li.status_localis_in').hide();
	}
	if ($('span[name=status_vascularis_out]').text() != '1') {
		$('li.status_vascularis_out').hide();
	}
	if ($('span[name=status_localis_out]').text() != '1') {
		$('li.status_localis_out').hide();
	}
});

</script>
