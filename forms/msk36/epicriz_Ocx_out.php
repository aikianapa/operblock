<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Выписной эпикриз</h2></div>
<div data-role="content" >
<div class="copytext">
<div id="form-027u"  class="print_page">
<form method="post">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="person_id">
<p style="text-align:center;">
<b>{{OrgName}} г.Москвы<br />
{{orgStr}}<br /></p>
<hr />
<p style="text-align:center;">
{{OrgAddr}}                                                   тел. +7 {{OrgPhone}}</b>
<br />
<h2>ВЫПИСНОЙ  ЭПИКРИЗ ИЗ  ИСТОРИИ  БОЛЕЗНИ    № {{externalId}}</h2>
</p>
		<ul class="fields">
		<li><b>Фамилия, Имя, Отчество:</b> {{client}}, <b>возраст</b> {{age}}</li>
		<li><b>Дата госпитализации:</b> {{s_date1}}</li>
		<li><b>Дата выписки:</b> <input type="text" class="medium" name="endDate" value="{{s_date2}}"></li>

		<li><b>ДИАГНОЗ:</b>
			<ul class="block">
				<li><b>Диагноз при поступлении:</b><textarea name="e_diag_in">{{e_diag_in}}</textarea> </li>
			</ul>
		</li>
		<li><b>Диагноз при выписке:</b>
			<ul class="block">
				<li><b>Основное заболевание:</b><textarea name="e_diag_main" from="firstView@Основное заболевание">{{e_diag_main}}</textarea> </li>
				<li><b>Фоновые заболевания:</b><textarea name="e_diag_fon" from="firstView@Фоновые заболевания">{{e_diag_fon}}</textarea></li>
				<li><b>Осложнения основного заболевания:</b><textarea name="e_diag_comp" from="firstView@Осложнения основного заболевания:">{{e_diag_comp}}</textarea></li>
				<li><b>Сопутствующие заболевания:</b><textarea name="e_diag_satt" from="firstView@Сопутствующие заболевания:">{{e_diag_satt}}</textarea></li>
			</ul>
		</li>
		<li><b>Жалобы при поступлении:</b><textarea name="e_complaint1" from="firstView@Жалобы">{{e_complaint1}}</textarea> </li>
		<li><b>An.morbi:</b><textarea name="e_anamnez1" from="firstView@Anamnesis morbi">{{e_anamnez1}}</textarea> </li>
		<li><b>An.vitae:</b><textarea name="e_an_vitae" from="firstView@Anamnesis vitae">{{e_an_vitae}}</textarea> </li>
		<li><b>Status vascularis при поступлении:</b><textarea name="e_st_vascularis_in" >{{e_st_vascularis_in}}</textarea> </li>
		<li><b>Status localis при поступлении:</b><textarea name="e_st_localis_in">{{e_st_localis_in}}</textarea> </li>
		<li><b>Проведено:</b><textarea name="e_therapy">{{e_therapy}}</textarea> </li>
		<li><p style="text-align:center;"><b>Код стандарта:</b> <input name="e_code1" class="small"> <b>Шифр по МКБ-10:</b> <input name="e_code2" class="small"></p></li>

		<li><b>Терапия: </b>
		<ul>
		<div data-role="foreach" from="Drugs">
		<li>{{drugs}}</li>
		
		</div>
		</ul>
		<textarea name="e_drugsText">{{e_drugsText}}</textarea></li>



	<ul>

	<li><b>Инструментальные методы исследования: </b>
	<ul>
		<div data-role="foreach" from="res">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p></li>
		</div>
	</ul><textarea name="e_researchText">{{e_researchText}}</textarea></li>

	<li><b>Лабораторная диагностика: </b>
	<ul>
		<div data-role="foreach" from="lab">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p></li>
		</div>
	</ul>
	<textarea name="e_anayseText">{{e_anayseText}}</textarea></li>
	
	<li><b>Консультации: </b>
	<ul>
		<div data-role="foreach" from="cons">
			<li>{{cons}}</li>
		</div>
	</ul>
	<textarea name="e_consultText">{{e_consultText}}</textarea></li>

		<li><b>Status vascularis при выписке:</b><textarea name="e_st_vascularis_out" from="firstView@Status vascularis">{{e_st_vascularis_out}}</textarea> </li>
		<li><b>Status localis при выписке:</b><textarea name="e_st_localis_out" from="firstView@Status localis">{{e_st_localis_out}}</textarea> </li>


		<li><b>Состояние при выписке:</b> 
		<select name="e_stateOut" value="{{e_stateOut}}">
			<option>удовлетворительное</option>
			<option>относительно удовлетворительное</option>
			<option>средней тяжести</option>
			<option>ближе к тяжелому</option>
			<option>тяжелое</option>
			<option>крайне тяжелое</option>
		</select>
		<textarea name="e_stateOutText">{{e_stateOutText}}</textarea> </li>


	<li><b>Выписан{{suffix2}} с: </b>
	<select name="e_out" value="{{e_out}}">
		<option>с выздоровлением</option>
		<option>улучшением</option>
		<option>без изменения</option>
	</select>
	</li>

	<li><b>Трудоспособность: </b>
	<select name="e_Jobness" value="{{e_Jobness}}">
		<option>восстановлена полностью</option>
		<option>снижена</option>
		<option>утрачена временно</option>
		<option>стойко утрачена всвязи с данным заболеванием</option>
		<option class="add">с другими причинами</option>
	</select>
	</li>
	<li><b>Посыльный лист на МСЭК: </b>
	<select name="e_JobnessMsek" value="{{e_JobnessMsek}}">
		<option>не оформлен</option>
		<option>оформлен</option>
	</select>
	<br /><textarea name="e_JobnessText">{{e_JobnessText}}</textarea>	
	</li>

	
	<li><b>Больничный лист: </b>
	<select name="e_hospList" value="{{e_hospList}}">
		<option>не выдавался</option>
		<option>выдавался</option>
	</select>
	</li>




</ul>

<b>Рекомендации по дальнейшему ведению пациента: </b>
<ol>
<li><b>Лекарственные препараты:</b>
<textarea name="e_recom_drugs">{{e_recom_drugs}}</textarea>
</li>
<li><b>Физиолечение и ЛФК:</b>
<textarea name="e_recom_lfk">{{e_recom_lfk}}</textarea>
</li>
<li><b>Диета:</b>
<textarea name="e_recom_dieta">{{e_recom_dieta}}</textarea>
</li>
<li><b>Санаторно-курортное лечение:</b>
<textarea name="e_recom_kurort">{{e_recom_kurort}}</textarea>
</li>
<li><b>Трудовые:</b>
<textarea name="e_recom_job">{{e_recom_job}}</textarea>
</li>
<li><b>Повторная госпитализация:</b>
<textarea name="e_recom_hosp">{{e_recom_hosp}}</textarea>
</li>
<li><b>Диспансеризация и наблюдение врачами-специалистами:</b>
<textarea name="e_recom_disp">{{e_recom_disp}}</textarea>
</li>
<br/>
<textarea name="e_recom7" placeholder="Сохранять выписной эпикриз, ЭКГ. Предоставить выписку при последующих госпитализациях.">{{e_recom7}}</textarea>
</ol>

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
$("#form-027u select[multiple]").each(function(){
	$(this).css("height",$(this).find("option").length*18+"px");
});
</script>
