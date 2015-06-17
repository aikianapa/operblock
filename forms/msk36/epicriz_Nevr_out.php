<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Выписной эпикриз</h2></div>
<div data-role="content" >
<div class="copytext">
<div id="form-027u"  class="print_page">
<form method="post">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="person_id">
<p style="text-align:center;"><b>{{OrgName}} г.Москвы<br />
{{orgStr}}<br />
{{OrgAddr}}                                                    тел. +7 {{OrgPhone}}</b></p>
<br>
<h2>{{docType}} ЭПИКРИЗ ИЗ  ИСТОРИИ  БОЛЕЗНИ    № {{externalId}}</h2>
<br />
		<ul class="fields">
		<li><b>Пациент:</b> {{client}}</li>
		<li><b>Возраст:</b> полных лет - {{age}}, дата рождения - {{bDate}}</li>
		<li><b>Адрес:</b> {{address}}</li>
		<li><b>Находил{{suffix1}} на стационарном лечении в ГБУЗ "Городская клиническая больница №36" ДЗ г.Москвы с {{s_date1}} по 
		<input type="text" class="medium" name="endDate" value="{{s_date2}}"></b>
		<ul>
			<div data-role="foreach" from="moving">
			<li>{{31}} - {{14}}</li>
			</div>
		</ul>
		<textarea name="e_stationar">{{e_stationar}}</textarea>
		</li>
		<li><b>Место работы:</b> <span from="secondView@Трудовой анамнез:" ></span></li>
		<li><b>Дата поступления {{s_date1}}</li>
		<li><b>ДИАГНОЗ:</b>
			<ul class="block">
				<li><b>Диагноз при поступлении:</b><br><textarea from="firstView@Диагноз предварительный:" name="e_diag_in">{{e_diag_in}}</textarea> </li>
				<li><b>Основное заболевание:</b><br><textarea from="secondView@Диагноз: Основное заболевание:" name="e_diag_main">{{e_diag_main}}</textarea> </li>
				<li><b>Фоновые заболевания:</b><br><textarea from="secondView@Фоновые заболевания:" name="e_diag_fon">{{e_diag_fon}}</textarea></li>
				<li><b>Осложнения основного заболевания:</b><br><textarea from="secondView@Осложнения основного заболевания:" name="e_diag_comp">{{e_diag_comp}}</textarea></li>
				<li><b>Сопутствующие заболевания:</b><br><textarea from="secondView@Сопутствующие заболевания:" name="e_diag_satt">{{e_diag_satt}}</textarea></li>
				<li><b>Диагноз при выписке:</b><br><textarea name="e_diag_out">{{e_diag_out}}</textarea> </li>
			</ul>
		</li>
		<li><b>Анамнез заболевания:</b> <textarea from="firstView@Anamnesis morbi:" name="e_an_morbi">{{e_an_morbi}}</textarea> </li>
		<li><b>Анамнез жизни:</b> <textarea from="firstView@Anamnesis vitae:" name="e_an_vitae">{{e_an_vitae}}</textarea> </li>
		<li><b>Аллергоанамнез:</b> <textarea from="firstView@Аллергоанамнез:" name="e_an_alerg">{{e_an_alerg}}</textarea> </li>
		<li><b>Эпид.анамнез:</b> <textarea from="firstView@Эпид. анамнез:" name="e_an_epid">{{e_an_epid}}</textarea> </li>
		<li><b>Жалобы при поступлении:</b> <textarea from="firstView@Жалобы при поступлении:" name="e_complaint1">{{e_complaint1}}</textarea> </li>
		<li><b>Состояние при поступлении:</b> <textarea from="firstView@Состояние при поступлении:" name="e_stateIn">{{e_stateIn}}</textarea> </li>
		<li><b>Жалобы при осмотре в н\о:</b> <textarea from="secondView@Жалобы:" name="e_complaint2">{{e_complaint2}}</textarea> </li>
		<li><b>Состояние при осмотре в н\о:</b> <textarea from="secondView@Status praesens: Общее состояние:" name="e_stateNo">{{e_stateNo}}</textarea> </li>
		<li><b>Находился на больничном листе в течение последних 12 месяцев:</b> <textarea from="secondView@Страховой анамнез: Находился на больничном листе в течении последних 12-мес:" name="e_blist12">{{e_blist12}}</textarea> </li>
		<li><b>Состояние при выписке:</b> 
			<textarea name="e_stateOut" value="{{e_stateOut}}" from="DiaryLast@Состояние при осмотре:"></textarea>
		</li>
		<li><b>Тяжесть состояния обусловлена:</b>
			<textarea name="e_hardState" from="DiaryLast@Тяжесть состояния обусловлена" value="{{e_hardState}}"></textarea>
		</li>
		<li><b>Телосложение:</b>
			<textarea multiple="multiple" from="DiaryLast@Телосложение:" name="e_bodyType" value="{{e_bodyType}}"></textarea>
		</li>
		<li><b>Периферические отеки:</b>
			<textarea name="e_perEdema" from="DiaryLast@Периферические отеки:" value="{{e_perEdema}}"></textarea>
		</li>
		<li><b>Кожные  покровы:</b> 
			<textarea name="e_skin1" multiple="multiple" from="DiaryLast@Кожные покровы"	value="{{e_skin1}}"></textarea>
		</li>
		<li><b>St.locales:</b><br><textarea from="DiaryLast@St. locales :" name="e_stLocales">{{e_stLocales}}</textarea> </li>
		<li><b>Pulm.:</b>
				<b>Дыхание:</b>
				<select name="e_pulm1" from="DiaryLast@Pulm.:Дыхание :" value="{{e_pulm1}}">
					<option>везикулярное</option><option>с жестковатым оттенком</option></option>жесткое</option>
					<option>проводится во все отделы</option><option class="add">ослабленное</option>
				</select>,&nbsp;                            
			<ul class="inline">
				<li><b>ЧДД:</b> <input from="DiaryLast@ЧДД" name="e_pulmFreq" class="small"> в 1 мин.</li>
				<li><b>Хрипы:</b> 
					<select from="DiaryLast@Хрипы:" name="e_pulmHrip1" value="{{e_pulmHrip1}}">
					<option>да</option><option>нет</option>
					</select>
					<select name="e_pulmHrip2" value="{{e_pulmHrip2}}">
					<option>&nbsp;</option><option>сухие</option><option class="add">влажные</option>
					</select>
				</li>
			</ul>
			<textarea name="e_pulm">{{e_pulm}}</textarea> </li>
		<li><b>Cor:</b> 
			<ul class="inline">
			<li><b>ЧСС:</b> <input from="DiaryLast@Cor. ЧСС" name="e_corFreq" class="small"> в 1 мин.</li>
			<li><b>АД:</b> <input from="DiaryLast@АД" name="e_corPress" class="small"> мм.рт.ст.</li>
			<li><b>Тоны сердца:</b> 
				<select from="DiaryLast@Тоны сердца" name="e_corTone" value="{{e_corTone}}">
				<option>ясные</option><option>приглушенные</option><option>глухие</option><option class="add noprint">прочее</option>
				</select>
			</li>
			<li><b>Ритм:</b> 
				<select from="DiaryLast@Ритм" name="e_corRitm" value="{{e_corRitm}}">
				<option>правильный</option><option>неправильный</option>
				</select>
			</li>

			</ul>
		</li>	

		<li><b>Живот при пальпации:</b> 
			<textarea from="DiaryLast@Живот при пальпации" name="e_belly1" value="{{e_belly1}}"></textarea>
		</li>
			
		<li><b>Перистальтика:</b> 
		<select name="e_prest" from="DiaryLast@Перистальтика" value="{{e_prest}}">
		<option>выслушивается</option><option>не выслушивается</option>
		</select>
		</li>
		
		<li><b>Тазовые функции:</b> 
		<select name="e_taz" from="DiaryLast@Тазовые функции" value="{{e_taz}}">
		<option>контролирует</option><option>частично контролирует</option><option>не контролирует</option>
		</select>
		</li>

		<li><b>Мочеиспускание:</b>
		<select name="e_urine" from="DiaryLast@Мочеиспускание" value="{{e_urine}}">
			<option>самостоятельно</option>
			<option>по катетеру</option>
		</select> Моча <input from="DiaryLast@моча цвет" name="e_urineColor" class="small"> цвета
		<br><textarea name="e_perEdemaText">{{e_perEdemaText}}</textarea> </li>
		
		<li><b>Дизурические явления:</b> 
		<select name="e_dizur" from="DiaryLast@Дизурические явления:" value="{{e_dizur}}">
		<option>нет</option><option class="add">да</option>
		</select>
		</li>
		
		<li><b>Неврологический статус на момент осмотра:</b>
		<ul>
		<li>
		<b>Уровень сознания:</b>
		<select from="DiaryLast@Уровень сознания:" name="e_nevrMind" value="{{e_nevrMind}}">
		<option>в сознании</option>
		<option>оглушение</option>
		<option>сопор</option>
		<option>кома</option>
		<option>уровень сознания меняющийся</option>
		<option>спутанность</option>
		<option>мед.седация</option>
		</select></li>
		<li>
		<b>ШКГ:</b> <input from="DiaryLast@ШКГ" name="e_nervShkg" class="small"> б.&nbsp;
		<b>NIHSS:</b> <input name="e_nervNihss" class="small"> б.&nbsp;
		<b>Ранкин:</b> <input name="e_nervRankin" class="small"> б.&nbsp;
		<b>Ривермет:</b> <input name="e_nervRiverted" class="small"> б.&nbsp;
		</li>
		<li>
		<b>Речевому контакту: </b>
		<select from="DiaryLast@Речевому контакту" name="e_nervContact" value="{{e_nervContact}}">
		<option>доступен</option>
		<option>контакт затруднен из-за речевых нарушений</option>
		<option>контакту недоступен по тяжести состояния</option>
		</select>		
		</li>
		<li>
		<b>Простые инструкции: </b>
		<select from="DiaryLast@Простые инструкции" name="e_nervSimple" value="{{e_nervSimple}}">
			<option>выполняет</option>
			<option>частично</option>
			<option>частично выполняет</option>
			<option>не выполняет</option>
		</select>
		</li>
		<li><b>Речь:</b>
			<textarea from="DiaryLast@Речь:" name="e_nervTalk" multiple="multiple" value="{{e_nervTalk}}"></textarea>
		</li>
		<li><b>Ориентирован{{suffix2}}: </b>
			<textarea  from="DiaryLast@Ориетирован:"  name="e_nervOrient" value="{{e_nervOrient}}"></textarea>
		</li>
		<li><b>Реакция на осмотр: </b>
		<select from="DiaryLast@Реакция на осмотр:" name="e_nervReaction" value="{{e_nervReaction}}">
			<option>сохранена</option>
			<option>вялая</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Изменение психики: </b>
		<select from="DiaryLast@Изменение психики:" name="e_nervPsih" value="{{e_nervPsih}}">
			<option>психотических расстройств нет</option>
			<option class="add">есть</option>
			<option>эмоционально лабильна</option>
			<option>оценить на момент осмотра затруднительно</option>
		</select>
		</li>
		<li><b>Когнитивные функции: </b>
		<select from="DiaryLast@Когнитивные функции:" name="e_nervCogn" value="{{e_nervCogn}}">
			<option>сохранены</option>
			<option>снижены</option>
		</select>
		</li>
		<li><b>Критика: </b>
		<select from="DiaryLast@Критика:" name="e_nervCritic" value="{{e_nervCritic}}">
			<option>сохранена</option>
			<option>снижена</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Общемозговая симптоматика: </b>
		<select from="DiaryLast@Общемозговая симптоматика:" name="e_nervBrain" value="{{e_nervBrain}}">
			<option>нет</option>
			<option>головная боль</option>
			<option>головокружение</option>
			<option>тошнота</option>
			<option>рвота</option>
		</select>
		</li>
		<li><b>Менингеальный синдром: </b>
		<select from="DiaryLast@Менингеальный синдром:" name="e_nervMening" value="{{e_nervMening}}">
			<option>нет</option>
			<option class="add">есть</option>
		</select>
		</li>
		</ul>
		</li>
		<li>
		<b>ЧМН:</b><ul>

		<li><b>Обоняние: </b>
		<select from="DiaryLast@Обоняние" name="e_cmnObon" value="{{e_cmnObon}}">
			<option>сохранено</option>
			<option>снижено</option>
			<option>не исследовалось</option>
			<option class="add">иное:</option>
		</select></li>

		<li><b>Предметное зрение: </b>
		<select from="DiaryLast@Предметное зрение" name="e_cmnZrenie" value="{{e_cmnZrenie}}">
			<option>сохранено</option>
			<option>снижено OD</option>
			<option>снижено OS</option>
			<option>снижено OU</option>
			<option>не исследовалось</option>
			<option class="add">иное:</option>
		</select></li>

		<li><b>Выпадение полей зрения: </b>
		<textarea from="DiaryLast@Выпадение полей зрения: Гемианопсия:" name="e_cmnPole" value="{{e_cmnPole}}">	
		</textarea></li>

		<li><b>Зрачки: </b><input from="DiaryLast@Зрачки" name="e_cmnZrachki" class="small"></li>
		<li><b>Глазные щели: </b><input from="DiaryLast@Глазные щели" name="e_cmnSchel" class="small"></li>
		<li><b>Фотореакция: </b>
		<select from="DiaryLast@Фотореакция" name="e_cmnFoto" value="{{e_cmnFoto}}">	
		<option>сохранена</option>
		<option>снижена</option>
		<option>отсутствует</option>
		</select></li>

		<li><b>Движения глазных яблок: </b>
		<textarea multiple="multiple" from="DiaryLast@Движения глазных яблок:" name="e_cmnApple[]">	
		</textarea></li>
		
		<li><b>Нистагм: </b>
		<textarea multiple="multiple" from="DiaryLast@Нистагм:" name="e_cmnNistagm[]">
		</textarea></li>
		
		<li><b>Диплопия: </b>
		<textarea multiple="multiple" from="DiaryLast@Диплопия:" name="e_cmnDiplop[]">
		</textarea></li>

		<li><b>Слух: </b>
		<textarea multiple="multiple" from="DiaryLast@Слух:" name="e_cmnSluh[]">
		</textarea></li>
		
		<li><b>Лицо: </b>
		<textarea from="DiaryLast@Лицо:" name="e_cmnFace">{{e_cmnFace}}</textarea></li>

		<li><b>Язык: </b>
		<textarea multiple="multiple" from="DiaryLast@Язык:" name="e_cmnTongue" value="{{e_cmnTongue}}">
		</textarea></li>
		
		<li><b>Бульбарные нарушения:</b>
		<select name="e_cmnBulb" from="DiaryLast@Бульбарные нарушения:" value="{{e_cmnBulb}}">
		<option>нет</option>
		<option class="add">есть</option>
		</select>
		<textarea name="e_cmnBulbText">{{e_cmnBulbText}}</textarea>
		</li>
		
		<li><b>Мышечный тонус: </b>
		<textarea from="DiaryLast@Мышечный тонус:" name="e_cmnMuscHands" value="{{e_cmnMuscHands}}"></textarea>
		</li>
		
		<li><b>Двигательные нарушения: </b>
		<textarea name="e_cmnMotion" from="DiaryLast@Двигательные нарушения:" value="{{e_cmnMotion}}">
		</textarea></li>
		
		<li><b>Сухожильные и периостальные рефлексы на руках: </b><br>
		<textarea name="e_cmnReflHands" from="DiaryLast@Сухожильные и периостальные рефлексы: На руках:" value="{{e_cmnReflHands}}">
		</textarea><li>

		<b>Сухожильные и периостальные рефлексы на ногах</b> 
		<textarea name="e_cmnReflLegs" from="DiaryLast@Сухожильные и периостальные рефлексы: На ногах" value="{{e_cmnReflLegs}}">
		</textarea>
		</li>
		
		<li><b>Патологические кистевые знаки: </b>
		<textarea name="e_cmnPatHands"  from="DiaryLast@Патологические кистевые знаки:" value="{{e_cmnPatHands}}">
		</textarea></li>

		<li><b>Патологические стопные знаки: </b>
		<textarea multiple="multiple" from="DiaryLast@Патологические стопные знаки:" name="e_cmnPatFoots" value="{{e_cmnPatFoots}}">
		</textarea></li>
		
		<li><b>Симптомы орального автоматизма: </b>
		<select name="e_cmnOralAuto" from="DiaryLast@Симптомы орального автоматизма:" value="{{e_cmnOralAuto}}">
			<option>отсутствуют</option>
			<option class="add">Есть</option>
		</select>
		<br><textarea name="e_cmnOralAutoText">{{e_cmnOralAutoText}}</textarea>
		</li>
		
		<li><b>Брюшные рефлексы: </b>
		<textarea multiple="multiple" from="DiaryLast@Брюшные рефлексы" name="e_cmnReflBelly" value="{{e_cmnReflBelly}}">
		</textarea></li>
		
		</ul></li>
		
		<li><b>Координаторная сфера: </b><br>
		<ul>
		<li><b>Пальценосовая проба:</b><br>
		<textarea from="DiaryLast@Координаторная сфера: Пальценосовая проба :" multiple="multiple" name="e_coorFinger" value="{{e_coorFinger}}"></textarea>
		</li>
		<li><b>Пяточно-коленная проба: </b>
			<textarea from="DiaryLast@Пяточно - коленная проба:"  multiple="multiple" name="e_coorFoot" value="{{e_coorFoot}}"></textarea>
		<li>
		<li><b>В позе Ромберга: </b>
			<textarea multiple="multiple" from="DiaryLast@В позе Ромберга" name="e_coorRomberg" value="{{e_coorRomberg}}"></textarea>
		</li>
		<li><b>Нарушения  чувствительности: </b>
		<textarea multiple="multiple" from="DiaryLast@Нарушения чувствительность:" name="e_coorSens" value="{{e_coorSens}}">
		</textarea>
		</li>
		<li><b>Дополнительная информация: </b>
		<br><textarea from="DiaryLast@Дополнительная информация:" name="e_moreText">{{e_moreText}}</textarea>
		</li>
		</ul></li>
	
<!--		<div data-role="foreach" from="fields">
		<li>
			<a href='#del' class='del_fld'>Уд.</a>
			<input data-role="none" name="fld[]" value="{{fld}}">
			<textarea name="val[]">{{val}}</textarea>
		</li>
		</div>
-->
		</ul>

<p align="center"><b><br>
Проводилось лечение в соответствии со стандартами оказания стационарной медицинской помощи<br>
</b></p>
<ul>
	<li><p style="text-align:center;"><b>Код стандарта:</b> <input name="e_code1" class="small"> <b>Шифр по МКБ-10:</b> <input name="e_code2" class="small"></p></li>
	<li><b>Препараты: </b>
	<ul>
	<div data-role="foreach" from="Drugs">
	<li>{{drugs}}</li>
	
	</div>
	</ul>
	<textarea name="e_drugsText">{{e_drugsText}}</textarea></li>
	
	<li><b>Инструментальные методы исследования: </b>
	<ul>
		<div data-role="foreach" from="res">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p></li>
		</div>
	</ul>
	<textarea name="e_resText">{{e_resText}}</textarea></li>
	</li>

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
	
	<li><b>Выписан{{suffix2}}: </b>
	<select name="e_out" value="{{e_out}}">
	<option>с выздоровлением</option>
	<option>с улучшением</option>
	<option>без перемен</option>
	<option>с ухудшением</option>
	<option>по собственному желанию</option>
	<option>за нарушение больничного режима</option>
	<option>переведен в другое учреждение</option>
	</select>
	</li>
	<li><b>Больничный лист: </b>
	<select name="e_hospList" value="{{e_hospList}}">
		<option>не выдавался</option>
		<option>выдавался</option>
	</select>
	</li>
</ul>

<b>Рекомендации: </b>


<ul>
<li>Диспансерное наблюдение врачами-специалистами по месту жительства в поликлинике: <textarea name="e_recom1">{{e_recom1}}</textarea></li>
<li>Диета: <textarea name="e_recom2" placeholder="С ограничением легкоусвояемых углеводов, животных жиров и соли. Питьевой режим.">{{e_recom2}}</textarea></li>
<li>Контроль АД и ЧСС постоянно. <textarea name="e_recom3" placeholder="При подъеме АД свыше 170-180\90-100 мм рт.ст. – каптоприл 25 мг под язык или нифедипин 10 мг с последующим контролем АД.">{{e_recom3}}</textarea></li>
<li>Продолжить приём следующих препаратов: <textarea name="e_recom4">{{e_recom4}}</textarea></li>
<li>Курсовой прием сосудистых, нейротрофических препаратов, антигипоксантов: <textarea name="e_recom5">{{e_recom5}}</textarea></li>
<li>Консультация в ОКДО ГКБ №36 <textarea placeholder="через __ месяцев с целью коррекции лечения при необходимости." name="e_recom6">{{e_recom6}}</textarea></li>
<li>Дополнительная информация: <textarea name="e_recom7">{{e_recom7}}</textarea></li>
</li>

</ul>
<p>Все препараты могут быть заменены на аналогичные в пределах одной фармакологической группы с соответствующей коррекцией принимаемой дозы под наблюдением врачей-специалистов.</p>

<br>
<br>
<span class="docDate">{{docDate}}г.</span><br />
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
	$("input[name=endDate]").on("change",function(){
		$("#form-027u span.docDate").html($(this).val());
	});
});
</script>
