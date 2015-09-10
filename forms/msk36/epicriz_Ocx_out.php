<script src="/js/jquery.selection.js"></script>
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
				<li><b>Диагноз при поступлении:</b><textarea name="e_diag_in">{{client}}</textarea> </li>
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
		<li><b>An.morbi:</b><textarea name="e_an_morbi" from="firstView@Anamnesis morbi">{{e_an_morbi}}</textarea> </li>
		<li><b>An.vitae:</b><textarea name="e_an_vitae">{{e_an_vitae}}</textarea> </li>
		<li><b>Status vascularis при поступлении:</b>
			<table >
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
		<li><p style="text-align:center;">
			<b>Код стандарта:</b> <input from="firstView@Код стандарта:" name="e_code1" class="small"> 
			<b>Шифр по МКБ-10:</b> <input from="firstView@Шифр по МКБ-10:" name="e_code2" class="small"></p></li>

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
			<tr><td colspan="4">Брюшная АОРТА: <textarea name="e_stv_aorta">{{e_stv_aorta}}</textarea></td></tr>
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
	

	
	<li><b>Больничный лист: </b>
	<select name="e_hospList" value="{{e_hospList}}">
		<option>не выдавался</option>
		<option>выдавался</option>
	</select>
	</li>




</ul>

<b>Рекомендации по дальнейшему ведению пациента: </b>
<select class="noprint recom_sel" name="e_recom_sel">
<option>Рекомендации (вены оперированные)</option>
<option>Рекомендации (вены язва)</option>
<option>Рекомендации (восход тр-т неоперированнаый)</option>
<option>Рекомендации (восход тр-т)</option>
<option>Рекомендации (консервативное лечение)</option>
<option>Рекомендации (Лимфостаз, ПТБ.)</option>
<option>Рекомендации (ОАСНК без стентирования)</option>
<option>Рекомендации (ОАСНК после БПШ)</option>
<option>Рекомендации (ОАСНК с язвой)</option>
<option>Рекомендации (ОАСНК стентированные)</option>
<option>Рекомендации (Сонные оперированные)</option>
<option>Рекомендации (Сонные после стентирования)</option>
<option>Рекомендации (ТГВ)</option>
<option>Рекомендации (Эмболия)</option>
</select>

<ul class="recom_tab">
	<li>
		<textarea name="1">
1. Наблюдение хирурга, терапевта по месту жительства.
2. Флеботоники (детралекс по 1т-2р/день или флебодиа 600 - 1р/день) курсами по 2 мес. 2раза в год.
3. Антиагрегантная терапия (Кардиомагнил 75мг или Тромбо-АСС 100мг в сутки) 1-2 мес.
4. Анальгетики (Найз 100мг. 2 раза в день или Мовалис 7, 5 мг. 1 раз в день и т.д.) 5-7 дней после еды.
5. Местное лечение (гепариновая мазь, долобене-гель 2-3 раза/день) в течении 2-х недель в области гематом.
6. Эластичное бинтование нижних конечностей 1 мес., затем компрессионный трикотаж 2-го класса компрессии 2 мес.
7. Послеоперационные швы обрабатывать р-ром бриллянтовым зелены 5-7 дней, не мочить.
8. Снять швы на 8-е сутки после операции.
9. Ограничение статических нагрузок 1 мес.
Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="2">
1. Наблюдение и лечение у хирурга, терапевта по месту жительства.
2. Флеботоники (детралекс, троксивазин, антистакс по 1т-2раза/день, флебодиа 600 - 1р/день) курсами по 2 мес. 2раза в год.
3. Антиагрегантная терапия (Кардиомагнил 75мг., Тромбо-АСС 100мг в сутки) длительно.
4. Анальгетики при болях (Найз 100мг. 2 раза в день, Мовалис 7, 5 мг. 1 раз в день и т.д.).
5. Пентоксифилин ( Вазонит ретард 600мг.-1т.-2 раза в день или Трентал 1т-3раза в день) курсами по 2 мес. 2 раза в год чередуя с ангиопротекторами (Актовегин по 1т.-3р/день) по 2 мес. 2 раза в год.
6. Энзимные препараты (Вобэнзим по 4др.-3раза в день 2 недели, затем по 2др-3р/день 2 недели).
7. Витамины: Аскорутин 1т.-3р/день 1 мес.
8. Сулодексид (Вессел дуэ ф 1 таб 2 раза в день 2 месяца)
9. Перевязки ежедневно (примочки с р-м “Бетадин”) длительно.
10. Эластичное бинтование н/к или компрессионный трикотаж 2-3 класса компрессии.
11. ФТЛ курсами ( пневмомассаж, ГБО)
Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="3">
1. Наблюдение хирурга, терапевта по месту жительства.
2. Флеботоники (детралекс по 1т-2раза/день или флебодиа 600 - 1р/день) курсами по 2 мес. 2раза в год.
3. Антиагрегантная терапия (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) длительно.
4. Анальгетики (Найз 100мг. 2 раза в день или Мовалис 7, 5 мг. 1 раз в день и т.д.) 5-7 дней.
5. Местное лечение (Лиотон гель 1-2 раза/день, долобене-гель 3-4 раза/день) в течение 2-х недель.
6. Эластичное бинтование нижних конечностей компрессионный трикотаж 2-го класса компрессии.
7. Плановое оперативное лечение.
Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="4">
1. Наблюдение хирурга, терапевта, гинеколога по месту жительства.
2. Флеботоники (детралекс по 1т-2раза/день или флебодиа 600 - 1р/день) курсами по 2 мес. 2раза в год.
3. Антиагрегантная терапия (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) длительно.
4. Анальгетики (Найз 100мг. 2 раза в день или Мовалис 7, 5 мг. 1 раз в день и т.д.) 5-7 дней.
5. Местное лечение (Лиотон гель 1-2 раза/день, долобене-гель 3-4 раза/день) в течение 2-х недель.
6. Рану обрабатывать бриллянтовым зеленным 2 раза/день 5-7 дней, не мочить.
7. Эластичное бинтование нижних конечностей компрессионный трикотаж 2-го класса компрессии.
Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="5">
1. Трентал 10,0+400мл. физ.р-ра, + в конце капельницы в резинку 10,0 мл. актовегина
2. 7-10 капельниц
3. ГБО, магнитотерапия.
		</textarea>
	</li>
	<li>
		<textarea name="6">
1. Наблюдение хирурга, терапевта, кардиолога по месту жительства.
2. Флеботоники (детралекс по 1т-2раза/день или флебодиа 600 - 1р/день) курсами по 2 мес. 2раза в год.
3. Антиагрегантная терапия (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) длительно.
4. Эластичное бинтование нижних конечностей или компрессионный трикотаж 2-го класса компрессии.
5. Местное лечение (гепариновая мазь, троксивазин гель, Лиотон гель 1-2 раза/день) курсами при обострениях.
6. ФТЛ курсами (пневмомассаж).
7. Назначения кардиолога.
Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="7">
1. Ежедневная дозированная ходьба.
2. Отказ от курения.
3. Диета с ограничением соли, животных жиров и углеводов.
4. Избегать переохлаждения н/к.
5. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
	-Клопидогрель (Плавикс 75мг или Зилт 75 мг ) по 3 мес.2 раза в год.
6. Статины (липримар или аторис) 10-20 мг. 1р/день под контролем липидного спектра и ферментов крови.
7. Пентоксифилин ( Вазонит ретард 600мг.-1т.-2 раза в день или Трентал 1т-3раза в день) курсами по 2 мес. 2 раза в год чередуя с ангиопротекторами (Актовегин по 1т.-3р/день) по 2 мес. 2 раза в год.
8. Миотропные спазмолитики (галидор 100мг.-2р/день) курсами по 2 мес. 2 раза в год.
9. Послеоперационную рану обрабатывать р-ром бриллянтовым зеленым 7 дней, не мочить.
10. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
11. Наблюдение у хирурга, терапевта по месту жительства
		</textarea>
	</li>
	<li>
		<textarea name="8">
1. Ежедневная дозированная ходьба.
2. Отказ от курения.
3. Диета с ограничением соли, животных жиров и углеводов.
4. Избегать переохлаждения н/к.
5. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
	-Клопидогрель (Плавикс 75мг или Зилт 75 мг ) 3 мес.
6. Статины (липримар или аторис) 10-20 мг. 1р/день под контролем липидного спектра и ферментов крови длительно.
7. Пентоксифилин ( Вазонит ретард 600мг.-1т.-2 раза в день или Трентал 1т-3раза в день) курсами по 2 мес. 2 раза в год чередуя с ангиопротекторами (Актовегин по 1т.-3р/день) по 2 мес. 2 раза в год.
8. Флеботоники (детралекс по 1т-2раза/день или флебодиа 600 - 1р/день) 2 мес.
9. Энзимные препараты (Вобэнзим по 4др.-3раза в день 2 недели, затем по 2др-3р/день 2 недели).
10. Анальгетики (Найз 100мг. 2 раза в день или Мовалис 7, 5 мг. 1 раз в день и т.д.) 5-7 дней после еды.
11. Лиотон гель 2-3 раза/день в области отека голени и бедра.
12. Послеоперационную рану обрабатывать р-ром бриллянтовым зеленым 7 дней, не мочить.
13. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
14. Наблюдение у хирурга, терапевта по месту жительства
		</textarea>
	</li>
	<li>
		<textarea name="9">
1. Ежедневная дозированная ходьба.
2. Отказ от курения.
3. Диета с ограничением соли, животных жиров и углеводов.
4. Избегать переохлаждения н/к.
5. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
	-Клопидогрель (Плавикс 75мг или Зилт 75 мг ) 6 месяцев.
6. Статины (липримар или аторис) 20 мг. 1р/день под контролем липидного спектра и ферментов крови.
7. Пентоксифилин (Вазонит ретард 600мг.-1т.-2 раза в день или Трентал 1т-3раза в день) курсами по 2 мес. 2 раза в год чередуя с ангиопротекторами (Актовегин по 1т.-3р/день) по 2 мес. 2 раза в год.
8. Миотропные спазмолитики (галидор 100мг.-2р/день) курсами по 2 мес. 2 раза в год.
9. Назначения кардиолога под контролем артериального давления крови и ЧСС ежедневно: амлодипин 5 мг н/ночь, конкор 2,5 мг. 2р/день.
10. Энзимные препараты (Вобэнзим 2др-3р/день 2 недели).
11. Флеботоники (детралекс по 1т-2раза/день или флебодиа 600 - 1р/день) курсами по 2 мес.
12. Перевязки с бетадином ежедневно.
13. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
14. Наблюдение у хирурга, терапевта по месту жительства
		</textarea>
	</li>
	<li>
		<textarea name="10">
1. Ежедневная дозированная ходьба.
2. Отказ от курения.
3. Диета с ограничением соли, животных жиров и углеводов.
4. Избегать переохлаждения н/к.
5. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
	-Клопидогрель (Плавикс 75мг или Зилт 75 мг ) 6 месяцев.
6. Статины (липримар или аторис) 10-20 мг. 1р/день под контролем липидного спектра и ферментов крови.
7. Пентоксифилин ( Вазонит ретард 600мг.-1т.-2 раза в день или Трентал 1т-3раза в день) курсами по 2 мес. 2 раза в год чередуя с ангиопротекторами (Актовегин по 1т.-3р/день) по 2 мес. 2 раза в год.
8. Миотропные спазмолитики (галидор 100мг.-2р/день) курсами по 2 мес. 2 раза в год.
9. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
10. Консервативная сосудистая терапия 2 раза в год.
11. Наблюдение у хирурга, терапевта по месту жительства
		</textarea>
	</li>
	<li>
		<textarea name="11">
1. Наблюдение хирурга, кардиолога, невролога по месту жительства.
2. Диета с ограничением соли, животных жиров и углеводов.
3. Контроль артериального давления ежедневно.
4. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
5. Статины (липримар или аторис) 10-20 мг. 1р/день под контролем липидного спектра и ферментов крови.
6. Ангиопротекторы (Актовегин по 1т.-2р/день; Танакан 1т-3раза в день, Мексидол 1т -2раза) курсами по 2 мес. 2 раза в год.
7. Послеоперационную рану обрабатывать р-ром бриллянтовым зеленым 7 дней, не мочить.
8. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="12">
1. Наблюдение хирурга, кардиолога, невролога по месту жительства.
2. Отказ от курения.
3. Диета с ограничением соли, животных жиров и углеводов.
4. Контроль артериального давления ежедневно.
5. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
	-Клопидогрель (Плавикс 75мг. или Зилт 75 мг или Плогрель75 мг) 6 месяцев.
6. Статины (липримар или крестор или торвакард или аторис) 10-20 мг. 1р/день под контролем липидного спектра и ферментов крови.
7. Ангиопротекторы (Актовегин по 1т.-2р/день; Танакан 1т-3раза в день, Мексидол 1т -2раза) курсами по 2 мес. 2 раза в год.
8. УЗДС БЦА не реже 1 раза в год.
9. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="13">
1. Наблюдение хирурга, терапевта по месту жительства.
2. Антикоагулянтная терапия ксарелто 20 мг.1раз/день или прадакса 110мг.-2р/день длительно.
3. Флеботоники (детралекс 1т-2р/день или флебодиа 600 - 1р/день) курсами по 2 мес. 2раза в год.
4. Анальгетики при болях (Найз 100мг. 2 раза в день, Милоксикам 7,5 мг., Мовалис 7, 5 мг. 1 раз в день и т.д.) не более 7 дней после еды.
5. Эластичное бинтование н/к или компрессионный трикотаж 2-го класса компрессии.
6. Местное лечение (гепариновая мазь, троксивазин гель, Лиотон гель 1-2 раза/день).
Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
		</textarea>
	</li>
	<li>
		<textarea name="14">
1. Ежедневная дозированная ходьба.
2. Диета с ограничением соли, животных жиров и углеводов.
3. Избегать переохлаждения н/к.
4. Антиагрегантная терапия:
	-Ацетилсалициловая кислота (Кардиомагнил 75мг. или Тромбо-АСС 100мг в сутки) постоянно.
	-Клопидогрель (Плавикс 75мг или Зилт 75 мг или Плагриль 75 мг) длительно.
5. Статины (липримар или торвакард) 20 мг. 1р/день под контролем липидного спектра и ферментов крови.
6. Пентоксифилин ( Вазонит ретард 600мг.-1т.-2 раза в день или Трентал 1т-3раза в день) курсами 2 мес.
7. Ангиопротекторы (Актовегин по 1т.-3р/день) по 2 мес.
8. Назначения кардиолога: бисопролол 5 мг.-1/4 т.утром; энап 5 мг.-2р/день; верошпирон 25 мг.утром натощак под контролем АД, ЧСС, ЭКГ.
9. Любой препарат может быть заменен в пределах фармакологической группы согласно спискам льготных лекарств.
10. Наблюдение у хирурга, терапевта по месту жительства
		</textarea>
	</li>
</ul>
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

<script>
$("#form-027u .recom_tab > li").hide();
$("#form-027u select[multiple]").each(function(){
	$(this).css("height",$(this).find("option").length*18+"px");
});
$(document).delegate(".recom_sel","change",function(){
	$("#form-027u .recom_tab > li").hide();
	$("#form-027u .recom_tab > li textarea").removeAttr("name");
	$("#form-027u .recom_tab > li:eq("+$(this).find("option:selected").index()+")").show();
	$("#form-027u .recom_tab > li:eq("+$(this).find("option:selected").index()+")").find("textarea").attr("name","e_recom_text").trigger("keyup");
});
$("#form-027u .recom_sel").trigger("change");
</script>
