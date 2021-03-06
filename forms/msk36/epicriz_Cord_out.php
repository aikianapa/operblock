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
<h2>{{docType}} ЭПИКРИЗ ИЗ  ИСТОРИИ  БОЛЕЗНИ    № {{externalId}}</h2>
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
				<li><b>Основное заболевание:</b><textarea name="e_diag_main" from="firstView@Основное заболевание">{{e_diag_main}}</textarea></li>
				<li><b>Фоновые заболевания:</b><textarea name="e_diag_fon" from="firstView@Фоновые заболевания">{{e_diag_fon}}</textarea></li>
				<li><b>Осложнения основного заболевания:</b><textarea name="e_diag_comp" from="firstView@Осложнения основного заболевания:">{{e_diag_comp}}</textarea></li>
				<li><b>Сопутствующие заболевания:</b><textarea name="e_diag_satt" from="firstView@Сопутствующие заболевания:">{{e_diag_satt}}</textarea></li>
			</ul>
		</li>
		<li><p style="text-align:center;"><b>Код стандарта:</b> <input name="e_code1" class="small"> <b>Шифр по МКБ-10:</b> <input name="e_code2" class="small"></p></li>
		<li><b>Жалобы при поступлении:</b><textarea name="e_complaint1" from="firstView@Жалобы">{{e_complaint1}}</textarea> </li>
		<li><b>An.morbi:</b><textarea name="e_anamnez1" from="firstView@Anamnesis morbi">{{e_anamnez1}}</textarea> </li>
		<li><b>An.vitae:</b><textarea name="e_an_vitae" from="firstView@Anamnesis vitae">{{e_an_vitae}}</textarea> </li>
		<li><b>Состояние при поступлении:</b><textarea name="e_stateIn">{{e_stateIn}}</textarea></li>
		
		<li>
			<ul class="inline">
				<li><b>Дыхание:</b> <input class="medium" name="e_pulm_in" from="firstView@Дыхание через нос"></li>
				<li><b>ЧДД:</b> <input class="medium" name="e_pulmFreq_in" from="firstView@ЧДД"> в 1 мин.</li>
				<li><br /><b>Сердце:</b></li>
				<li><b>Тоны сердца:</b> <input class="medium" name="e_corTone_in" from="firstView@Тоны"></li>
				<li><b>ЧСС: </b> <input class="medium" name="e_corFreq_in" from="firstView@ЧСС"> в 1 мин.</li>
				<li><b>АД:</b> <input class="medium" name="e_corPress_in" from="firstView@АД"> мм.рт.ст.</li>
			</ul>
		</li>	
		<li><b>Печень:</b> <textarea type="text" name="e_liverText_in" from="firstView@Печень:">{{e_liverText_in}}</textarea></li>
		<li><b>Живот:</b> <textarea type="text" name="e_bellyText_in" from="firstView@Живот:">{{e_bellyText_in}}</textarea></li>
		<li><b>Течение заболевания в стационаре:</b><textarea name="e_stationar">{{e_stationar}}</textarea> </li>
		<li><b>Терапия: </b>
		<ul>
		<div data-role="foreach" from="Drugs">
		<li>{{drugs}}</li>
		
		</div>
		</ul>
		<textarea name="e_drugsText">{{e_drugsText}}</textarea></li>
		
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

		<li>
			<ul class="inline">
				<li><b>Дыхание:</b> 
						<select name="e_pulm1" multiple="multiple" from="firstView@Аускультативно: Дыхание" :value="{{e_pulm1}}">
						<option>везикулярное</option>
						<option>жесткое</option>
						<option>ослабленное</option>
						<option>проводится во все отделы</option>
						<option>хрипов нет</option>
						<option>не проводится</option>
						<option>в задне-нижних отделах слева</option>
						<option>в задне-нижних отделах справа</option>
						<option>с жестким оттенком</option>
						<option>проводится во все отделы</option>
						</select>
				</li>
				<li><b>ЧДД:</b> <input from="firstView@ЧДД" name="e_pulmFreq" class="small"> в 1 мин.</li>
				<li><textarea  name="e_pulm">{{e_pulm}}</textarea></li>
			<li><br /><b>Сердце:</b></li>
			<li><b>Тоны сердца:</b> 
				<select name="e_corTone" multiple="multiple"  value="{{e_corTone}}">
				<option>чистые</option>
				<option>ясные</option>
				<option>приглушенные</option>
				<option>глухие</option>
				<option>ритмичные</option>
				<option>аритмичные</option>
				<option>акцент II тона</option>
				<option>на аорте</option>
				<option>на лёгочной артерии</option>
				</select>
			</li>
			<li><b>ЧСС:</b> <input name="e_corFreq" class="small"> в 1 мин.</li>
			<li><b>АД:</b> <input name="e_corPress" class="small"> мм.рт.ст.</li>
			</ul>
		</li>	
		<li><b>Печень:</b><textarea name="e_liverText">{{e_liverText}}</textarea></li>
		

		<li><b>Живот:</b>
		<select name="e_belly1" multiple="multiple" value="{{e_belly1}}">
		<option>мягкий</option>
		<option>болезненный</option>
		<option>безболезненный</option>
		</select>
		</li>
			
		<li><b>Отёки:</b>
			<textarea name="e_otekText">{{e_otekText}}</textarea>
		</li>
	
<!--		<div data-role="foreach" from="fields">
		<li>
			<a href='#del' class='del_fld'>Уд.</a>
			<input data-role="none" name="fld[]" value="{{fld}}">
			<textarea name="val[]">{{val}}</textarea>
		</li>
		</div>
-->
		</ul>

<ul>

	<li><b>Инструментальные методы исследования: </b>
	<ul>
		<div data-role="foreach" from="res">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p>
			</li>
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

<textarea name="e_therapy_text">
Пациент пролечен по ВМП-ОМС. -талон № 
Профиль ВМП-сердечно–сосудистая хирургия
Код вида ВМП–14.00.21.001
Наименование вида ВМП:  коронарнаяреваскуляризация миокарда с применением ангиопластики в сочетание со стентирование при ишемической болезни сердца. 
Код диагноза по МКБ -10:I21.1
Модель пациента: ИБС, со стентированием 1-3 коронарный артерий

Метод лечения:баллоннаявазодилятация с установкой стента в сосуд-сосуды. 
ВМП выполнено, койко-дней - 10
</textarea>

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
<p>Все препараты могут быть заменены на аналогичные в пределах одной фармакологической группы с соответствующей коррекцией принимаемой дозы под наблюдением врачей-специалистов.</p>
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
