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
		<li><b>Status vascularis при поступлении:</b>
			<table>
			<tr><th colspan="2">Пульс справа</th><th colspan="2">Пульс слева</th></tr>
			<tr><td>Сонные:</td><td><span from="firstView@сонные справа"></span></td><td>Сонные:</td><td><span from="firstView@сонные слева"></span></td></tr>
			<tr><td>Аскилярная:</td><td><span from="firstView@аксиллярная справа"></span></td><td>Аскилярная:</td><td><span from="firstView@аксиллярная слева"></span></td></tr>
			<tr><td>Плечевая на плече:</td><td><span from="firstView@плечевая на плече справа"></span></td><td>Плечевая на плече:</td><td><span from="firstView@плечевая на плече слева"></span></td></tr>
			<tr><td>Локтевая:</td><td><span from="firstView@локтевая справа"></span></td><td>Локтевая:</td><td><span from="firstView@локтевая слева"></span></td></tr>
			<tr><td>Лучевая:</td><td><span from="firstView@лучевая справа"></span></td><td>Лучевая:</td><td><span from="firstView@лучевая слева"></span></td></tr>
			<tr><td colspan="4">Брюшная АОРТА: <span from="firstView@Брюшная АОРТА"></span></td></tr>
			<tr><th colspan="4">Артерии нижних конечностей</th></tr>
			<tr><td>Над пупартовой связкой:</td><td><span from="firstView@Над пупартовой связкой справа"></span></td><td>Над пупартовой связкой:</td><td><span from="firstView@Над пупартовой связкой слева"></span></td></tr>
			<tr><td>Под пупартовой связкой:</td><td><span from="firstView@Под пупартовой связкой справа"></span></td><td>Под пупартовой связкой:</td><td><span from="firstView@Под пупартовой связкой слева"></span></td></tr>
			<tr><td>ПоА:</td><td><span from="firstView@ПоА справа"></span></td><td>ПоА:</td><td><span from="firstView@ПоА слева"></span></td></tr>
			<tr><td>ПББА:</td><td><span from="firstView@ПББА справа"></span></td><td>ПББА:</td><td><span from="firstView@ПББА слева"></span></td></tr>
			<tr><td>ЗББА:</td><td><span from="firstView@ЗББА справа"></span></td><td>ЗББА:</td><td><span from="firstView@ЗББА слева"></span></td></tr>
			<tr><td>Положительные симптомы:</td><td><span from="firstView@Положительные симптомы справа"></span></td><td>Положительные симптомы:</td><td><span from="firstView@Положительные симптомы слева"></span></td></tr>
			</table>
		</li>
		<li><b>Status localis при поступлении:</b>
			<table>
			<tr><th colspan="2">Справа</th><th colspan="2">Слева</th></tr>
			<tr><td>Цвет:</td><td><span from="firstView@цвет справа"></span></td><td>Цвет:</td><td><span from="firstView@Цвет слева"></span></td></tr>
			<tr><td>Температура:</td><td><span from="firstView@температура справа"></span></td><td>Температура:</td><td><span from="firstView@температура слева"></span></td></tr>
			<tr><td>Чувствительность:</td><td><span from="firstView@чувствительность справа"></span></td><td>Чувствительность:</td><td><span from="firstView@чувствительность слева"></span></td></tr>
			<tr><td>Движения:</td><td><span from="firstView@движения справа"></span></td><td>Движения:</td><td><span from="firstView@движения слева"></span></td></tr>
			<tr><td>Субфасциальный отек:</td><td><span from="firstView@субфасциальный отек справа"></span></td><td>Субфасциальный отек:</td><td><span from="firstView@субфасциальный отек слева"></span></td></tr>
			<tr><td>Контрактура:</td><td><span from="firstView@контрактура справа"></span></td><td>Контрактура:</td><td><span from="firstView@контрактура слева"></span></td></tr>
			<tr><td>Трофические нарушения:</td><td><span from="firstView@трофические нарушения справа"></span></td><td>Трофические нарушения:</td><td><span from="firstView@трофические нарушения слева"></span></td></tr>
			<tr><td>Отек:</td><td><span from="firstView@отек справа"></span></td><td>Отек:</td><td><span from="firstView@отек слева"></span></td></tr>
			<tr><td>Подкожные вены:</td><td><span from="firstView@подкожные вены справа"></span></td><td>Подкожные вены:</td><td><span from="firstView@подкожные вены слева"></span></td></tr>
			</table>
		</li>
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

		<li><b>Status vascularis при выписке:</b>
			<table>
			<tr><th colspan="2">Пульс справа</th><th colspan="2">Пульс слева</th></tr>
			<tr><td>Сонные:</td><td><select name="e_stvr_son" value="{{e_stvr_son}}"></select></td><td>Сонные:</td><td><select name="e_stvl_son" value="{{e_stvl_son}}"></select></td></tr>
			<tr><td>Аскилярная:</td><td><select name="e_stvr_ask" value="{{e_stvr_ask}}"></select></td><td>Аскилярная:</td><td><select name="e_stvl_ask" value="{{e_stvl_ask}}"></select></td></tr>
			<tr><td>Плечевая на плече:</td><td><select name="e_stvr_pl" value="{{e_stvr_pl}}"></select></td><td>Плечевая на плече:</td><td><select name="e_stvl_pl" value="{{e_stvl_pl}}"></select></td></tr>
			<tr><td>Локтевая:</td><td><select name="e_stvr_lok" value="{{e_stvr_lok}}"></select></td><td>Локтевая:</td><td><select name="e_stvl_lok" value="{{e_stvl_lok}}"></select></td></tr>
			<tr><td>Лучевая:</td><td><select name="e_stvr_luch" value="{{e_stvr_luch}}"></select></td><td>Лучевая:</td><td><select name="e_stvl_luch" value="{{e_stvl_luch}}"></select></td></tr>
			<tr><td colspan="4">Брюшная АОРТА: <select name="e_stv_aorta" value="{{e_stv_aorta}}"></select></td></tr>
			<tr><th colspan="4">Артерии нижних конечностей</th></tr>
			<tr><td>Над пупартовой связкой:</td><td><select name="e_stvr_nad" value="{{e_stvr_nad}}"></select></td><td>Над пупартовой связкой:</td><td><select name="e_stvl_nad" value="{{e_stvl_nad}}"></select></td></tr>
			<tr><td>Под пупартовой связкой:</td><td><select name="e_stvr_pod" value="{{e_stvr_pod}}"></select></td><td>Под пупартовой связкой:</td><td><select name="e_stvl_pod" value="{{e_stvl_pod}}"></select></td></tr>
			<tr><td>ПоА:</td><td><select name="e_stvr_poa" value="{{e_stvr_poa}}"></select></td><td>ПоА:</td><td><select name="e_stvl_poa" value="{{e_stvl_poa}}"></select><</td></tr>
			<tr><td>ПББА:</td><td><select name="e_stvr_pbba" value="{{e_stvr_pbba}}"></select></td><td>ПББА:</td><td><select name="e_stvl_pbba" value="{{e_stvl_pbba}}"></select></td></tr>
			<tr><td>ЗББА:</td><td><select name="e_stvr_zbba" value="{{e_stvr_zbba}}"></select></td><td>ЗББА:</td><td><select name="e_stvl_zbba" value="{{e_stvl_zbba}}"></select></td></tr>
			<tr><td>Положительные симптомы:</td><td><select name="e_stvr_simp" value="{{e_stvr_simp}}"></select></td><td>Положительные симптомы:</td><td><select name="e_stvl_simp" value="{{e_stvl_simp}}"></select></td></tr>
			</table>
		</li>
		<li><b>Status localis при выписке:</b>
			<table>
			<tr><th colspan="2">Справа</th><th colspan="2">Слева</th></tr>
			<tr><td>Цвет:</td><td><select name="e_stlr_color" value="{{e_stlr_color}}"></select></td><td>Цвет:</td><td><select name="e_stll_color" value="{{e_stll_color}}"></select></td></tr>
			<tr><td>Температура:</td><td><select name="e_stlr_temp" value="{{e_stlr_temp}}"></select></td><td>Температура:</td><td><select name="e_stll_temp" value="{{e_stll_temp}}"></select></td></tr>
			<tr><td>Чувствительность:</td><td><select name="e_stlr_sens" value="{{e_stlr_sens}}"></select></td><td>Чувствительность:</td><td><select name="e_stll_sens" value="{{e_stll_sens}}"></select></td></tr>
			<tr><td>Движения:</td><td><select name="e_stlr_mov" value="{{e_stlr_mov}}"></select></td><td>Движения:</td><td><select name="e_stll_mov" value="{{e_stll_mov}}"></select></td></tr>
			<tr><td>Субфасциальный отек:</td><td><select name="e_stlr_sub" value="{{e_stlr_sub}}"></select></td><td>Субфасциальный отек:</td><td><select name="e_stll_sub" value="{{e_stll_sub}}"></select></td></tr>
			<tr><td>Контрактура:</td><td><select name="e_stlr_contr" value="{{e_stlr_contr}}"></select></td><td>Контрактура:</td><td><select name="e_stll_contr" value="{{e_stll_contr}}"></select></td></tr>
			<tr><td>Трофические нарушения:</td><td><select name="e_stlr_trof" value="{{e_stlr_trov}}"></select></td><td>Трофические нарушения:</td><td><select name="e_stll_trof" value="{{e_stll_trof}}"></select></td></tr>
			<tr><td>Отек:</td><td><select name="e_stlr_otek" value="{{e_stlr_otek}}"></select></td><td>Отек:</td><td><select name="e_stll_otek" value="{{e_stll_otek}}"></select></td></tr>
			<tr><td>Подкожные вены:</td><td><select name="e_stlr_ven" value="{{e_stlr_ven}}"></select></td><td>Подкожные вены:</td><td><select name="e_stll_ven" value="{{e_stll_ven}}"></select></td></tr>
			</table>
		</li>


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
