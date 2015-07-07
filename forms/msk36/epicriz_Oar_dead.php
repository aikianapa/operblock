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
		<li><b>Дата перевода:  <input type="text" class="medium datepicker" name="endDate" value="{{endDate}}"></li>
		<li><b>ДИАГНОЗ:</b>
			<ul class="block">
				<li><b>Основное заболевание:</b><br><textarea autofocus from="firstView@Основное заболевание:" name="e_diag_main">{{e_diag_main}}</textarea> </li>
				<li><b>Фоновые заболевания:</b><br><textarea from="firstView@Фоновые заболевания:" name="e_diag_fon">{{e_diag_fon}}</textarea></li>
				<li><b>Осложнения основного заболевания:</b><br><textarea from="firstView@Осложнения основного заболевания:" name="e_diag_comp">{{e_diag_comp}}</textarea></li>
				<li><b>Сопутствующие заболевания:</b><br><textarea from="firstView@Сопутствующие заболевания:" name="e_diag_satt">{{e_diag_satt}}</textarea></li>
			</ul>
		</li>
		<li><b>Анамнез заболевания:</b> <textarea from="firstView@Anamnesis morbi:" name="e_an_morbi">{{e_an_morbi}}</textarea> </li>
		<li><b>Анамнез жизни:</b> <textarea from="firstView@Anamnesis vitae:" name="e_an_vitae">{{e_an_vitae}}</textarea> </li>
		<li><b>Жалобы при поступлении:</b> <textarea  from="firstView@Жалобы при поступлении:" name="e_complaint1">{{e_complaint1}}</textarea> </li>
		<li><b>Тяжесть состояния обусловлена:</b>
		<select name="e_hardState" value="{{e_hardState}}">
			<option>&nbsp;</option>
			<option>основным заболеванием</option>
			<option>сопутствующей соматической патологией</option>
		</select>
		<br><textarea name="e_hardStateText">{{e_hardStateText}}</textarea> </li>
		<li><b>Телосложение:</b>
		<select multiple="multiple" from="firstView@Телосложение:" name="e_bodyType" value="{{e_bodyType}}">
			<option>нормостеническое</option>
			<option>гиперстеническое</option>
			<option>астеническое</option>
		</select></li>
		<li><b>Периферические отеки:</b>
		<br><textarea from="firstView@Переферические отеки:" name="e_perEdemaText">{{e_perEdemaText}}</textarea> </li>

		<li><b>Кожные  покровы:</b> 
		<select name="e_skin1" multiple="multiple" from="firstView@Кожные покровы"	value="{{e_skin1}}">
			<option>розовые</option><option>бледно - розовые</option><option>бледные</option>
			<option>цианоз</option><option>сухие</option><option>влажные</option>
			<option>трофические нарушения отсутствуют</option><option>обычной окраски и влажности</option>
			<option>свежих следов травм на голове и туловище не выявлено</option>
		</select>
		<textarea name="e_skinText">{{e_skinText}}</textarea></li>
		<li><b>Pulm.:</b>
				<b>Дыхание:</b>
				<select name="e_pulm1" from="firstView@Pulm.Дыхание :" value="{{e_pulm1}}">
					<option>везикулярное</option><option>с жестковатым оттенком</option></option>жесткое</option>
					<option>проводится во все отделы</option><option class="add">ослабленное</option>
				</select>,&nbsp;                            
			<ul class="inline">
				<li><b>ЧДД:</b> <input from="firstView@ЧДД" name="e_pulmFreq" class="small"> в 1 мин.</li>
				<li><b>Хрипы:</b> 
					<select from="firstView@Хрипы:" name="e_pulmHrip1" value="{{e_pulmHrip1}}">
					<option>да</option><option>нет</option>
					</select>
					<select name="e_pulmHrip2" value="{{e_pulmHrip2}}">
					<option>&nbsp;</option><option>сухие</option><option class="add">влажные</option>
					</select>
				</li>
			</ul>
			<textarea name="e_pulm">{{e_pulm}}</textarea> </li>
		<li><b>Гемодинамика:</b> 
			<ul class="inline">
			<li><b>ЧСС:</b> <input from="firstView@Cor. ЧСС:" name="e_corFreq" class="small"> в 1 мин.</li>
			<li><b>АД:</b> <input from="firstView@АД:" name="e_corPress" class="small"> мм.рт.ст.</li>
			<li><b>Тоны сердца:</b> 
				<select from="firstView@Тоны сердца" name="e_corTone" value="{{e_corTone}}">
				<option>ясные</option><option>приглушенные</option><option>глухие</option><option class="add noprint">прочее</option>
				</select>
			</li>
			<li><b>Ритм:</b> 
				<select from="firstView@Ритм" name="e_corRitm" value="{{e_corRitm}}">
				<option>правильный</option><option>неправильный</option>
				</select>
			</li>

			</ul>
		</li>	

		<li><b>Живот при пальпации:</b> 
		<select multiple="multiple" from="firstView@Живот при пальпации" name="e_belly1" value="{{e_belly1}}">
		<option>мягкий</option><option class="add">напряжён</option>
		<option>без динамики</option><option>безболезненный во всех отделах</option>
		<option>безболезненный</option><option>болезненный</option>
		</select>,&nbsp; <input class="middle" name="e_belly2" value="{{e_belly2}}">
		</li>
			
		<li><b>Перистальтика:</b> 
		<select name="e_prest" from="firstView@Перистальтика" value="{{e_prest}}">
		<option>выслушивается</option><option>не выслушивается</option>
		</select>
		</li>
		
		<li><b>Тазовые функции:</b> 
		<select name="e_taz" from="firstView@Тазовые функции" value="{{e_taz}}">
		<option>контролирует</option><option>частично контролирует</option><option>не контролирует</option>
		</select>
		</li>

		<li><b>Мочеиспускание:</b>
		<select name="e_urine" from="firstView@Мочеиспускание" value="{{e_urine}}">
			<option>самостоятельно</option>
			<option>по катетеру</option>
		</select> Моча <input from="firstView@моча цвет" name="e_urineColor" class="small"> цвета
		<br><textarea name="e_perEdemaText">{{e_perEdemaText}}</textarea> </li>
		
		
		<li><b>Неврологический статус:</b>
		<ul>
		<li>
		<b>Уровень сознания:</b>
		<select from="firstView@Уровень сознания:" name="e_nevrMind" value="{{e_nevrMind}}">
		<option>в сознании</option>
		<option>оглушение</option>
		<option>сопор</option>
		<option>кома</option>
		<option>уровень сознания меняющийся</option>
		<option>спутанность</option>
		<option>мед.седация</option>
		</select></li>
		<li>
		<b>ШКГ:</b> <input from="firstView@ШКГ" name="e_nervShkg" class="small">
		</li>
		<li>
		<b>Речевому контакту: </b>
		<select from="firstView@Речевому контакту" name="e_nervContact" value="{{e_nervContact}}">
		<option>доступен</option>
		<option>контакт затруднен из-за речевых нарушений</option>
		<option>контакту недоступен по тяжести состояния</option>
		</select>		
		</li>
		<li>
		<b>Простые инструкции: </b>
		<select from="firstView@Простые инструкции" name="e_nervSimple" value="{{e_nervSimple}}">
			<option>выполняет</option>
			<option>частично</option>
			<option>частично выполняет</option>
			<option>не выполняет</option>
		</select>
		</li>
		<li><b>Речь:</b>
		<select from="firstView@Речь:" name="e_nervTalk" multiple="multiple" value="{{e_nervTalk}}">
			<option>не нарушена</option>
			<option>дизартрия</option>
			<option>афазия</option>
			<option>мутизм</option>
			<option>отсутствует</option>
			<option>сенсорная</option>
			<option>тотальная</option>
			<option>сенсо-моторная</option>
			<option>сохранена</option>
			<option>лёгкая</option>
		</select>
		</li>
		<li><b>Ориентирован{{suffix2}}: </b>
		<select name="e_nervOrient" value="{{e_nervOrient}}">
			<option>в месте, времени, собственной личности</option>
			<option>на вопросы отвечает правильно</option>
			<option>достоверно оценить затруднительно</option>
			<option class="add">иное:</option>
		</select>
		</li>
		<li><b>Реакция на осмотр: </b>
		<select from="firstView@Реакция на осмотр:" name="e_nervReaction" value="{{e_nervReaction}}">
			<option>сохранена</option>
			<option>вялая</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Изменение психики: </b>
		<select from="firstView@Изменения психики: психических расстройств:" name="e_nervPsih" value="{{e_nervPsih}}">
			<option>психотических расстройств нет</option>
			<option class="add">есть</option>
			<option>эмоционально лабильна</option>
			<option>оценить на момент осмотра затруднительно</option>
		</select>
		</li>
		<li><b>Когнитивные функции: </b>
		<select from="firstView@Когнитивные функции:" name="e_nervCogn" value="{{e_nervCogn}}">
			<option>сохранены</option>
			<option>снижены</option>
		</select>
		</li>
		<li><b>Критика: </b>
		<select from="firstView@Критика:" name="e_nervCritic" value="{{e_nervCritic}}">
			<option>сохранена</option>
			<option>снижена</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Общемозговая симптоматика: </b>
		<select from="firstView@Общемозговая симптоматика:" name="e_nervBrain" value="{{e_nervBrain}}">
			<option>нет</option>
			<option>головная боль</option>
			<option>головокружение</option>
			<option>тошнота</option>
			<option>рвота</option>
		</select>
		</li>
		<li><b>Менингеальный синдром: </b>
		<select from="firstView@Менингеальный синдром:" name="e_nervMening" value="{{e_nervMening}}">
			<option>нет</option>
			<option class="add">есть</option>
		</select>
		</li>
		</ul>
		</li>
		<li>
		<b>ЧМН:</b><ul>

		<li><b>Обоняние: </b>
		<select from="firstView@Обоняние" name="e_cmnObon" value="{{e_cmnObon}}">
			<option>сохранено</option>
			<option>снижено</option>
			<option>не исследовалось</option>
			<option class="add">иное:</option>
		</select></li>

		<li><b>Предметное зрение: </b>
		<select from="firstView@Предметное зрение" name="e_cmnZrenie" value="{{e_cmnZrenie}}">
			<option>сохранено</option>
			<option>снижено OD</option>
			<option>снижено OS</option>
			<option>снижено OU</option>
			<option>не исследовалось</option>
			<option class="add">иное:</option>
		</select></li>

		<li><b>Выпадение полей зрения: </b>
		<select from="firstView@Выпадение полей зрения: Гемианопсия:" name="e_cmnPole" value="{{e_cmnPole}}">	
			<option>контрольным путем не выявлено</option>
			<option>проверить невозможно</option>
			<option>гемианопсия гетеронимная справа</option>
			<option>гемианопсия гетеронимная слева</option>
			<option>гемианопсия гомонимная биназальная</option>
			<option>гемианопсия гомонимная битемпоральная</option>
			<option class="add">иное:</option>
		</select></li>

		<li><b>Зрачки: </b><input from="firstView@Зрачки" name="e_cmnZrachki" class="small"></li>
		<li><b>Глазные щели: </b><input from="firstView@Глазные щели" name="e_cmnSchel" class="small"></li>
		<li><b>Фотореакция: </b>
		<select from="firstView@Фотореакция" name="e_cmnFoto" value="{{e_cmnFoto}}">	
		<option>сохранена</option>
		<option>снижена</option>
		<option>отсутствует</option>
		</select></li>

		<li><b>Движения глазных яблок: </b>
		<select multiple="multiple" from="firstView@Движения глазных яблок:" name="e_cmnApple[]">	
		<option>в полном объеме</option>
		<option>за ориентиром не следит</option>
		<option>не доводит глазные яблоки вправо</option>
		<option>не доводит глазные яблоки влево</option>
		<option>не доводит глазные яблоки вверх</option>
		<option>не доводит глазные яблоки вниз</option>
		<option>установка взора вправо</option>
		<option>установка взора влево</option>
		<option>парез взора вправо</option>
		<option>парез взора влево</option>
		</select></li>
		
		<li><b>Нистагм: </b>
		<select multiple="multiple" from="firstView@Нистагм:" name="e_cmnNistagm[]">
		<option>отсутствует</option>
		<option>мелкоразмашистый</option>
		<option>среднеразмашистый</option>
		<option>крупноразмашистый</option>
		<option>горизонтальный</option>
		<option>вертикальный</option>
		<option>ротаторный</option>
		</select></li>
		
		<li><b>Диплопия: </b>
		<select multiple="multiple" from="firstView@Диплопия:" name="e_cmnDiplop[]">
		<option>отрицает</option>
		<option>по горизонтали</option>
		<option>по вертикали</option>
		<option>при взгляде вправо</option>
		<option>при взгляде влево</option>
		<option>при взгляде вверх</option>
		<option>при взгляде вниз</option>
		</select></li>

		<li><b>Слух: </b>
		<select multiple="multiple" from="firstView@Слух:" name="e_cmnSluh[]">
		<option>сохранен</option>
		<option>ориентировочно снижен AS</option>
		<option>ориентировочно снижен AD</option>
		<option>ориентировочно снижен AU</option>
		<option class="add">иное:</option>
		</select></li>
		
		<li><b>Лицо: </b>
		<select multiple="multiple" from="firstView@Лицо:" name="e_cmnFace[]">
		<option>симметрично</option>
		<option>асимметрично за счет сглаженности правой носогубной складки</option>
		<option>асимметрично за счет сглаженности левой носогубной складки</option>
		<option>асимметрично за счет опущения правого угла рта</option>
		<option>асимметрично за счет опущения левого угла рта</option>
		</select></li>

		<li><b>Язык: </b>
		<select multiple="multiple" from="firstView@Язык:" name="e_cmnTongue" value="{{e_cmnTongue}}">
		<option>по средней линии</option>
		<option>девиирует вправо</option>
		<option>девиирует влево</option>
		<option>в полости рта</option>
		<option>легко</option>
		</select></li>
		
		<li><b>Бульбарные нарушения:</b>
		<select name="e_cmnBulb" from="firstView@Бульбарные нарушения:" value="{{e_cmnBulb}}">
		<option>нет</option>
		<option class="add">есть</option>
		</select>
		<textarea name="e_cmnBulbText">{{e_cmnBulbText}}</textarea>
		</li>
		
		<li><b>Мышечный тонус: </b>
		<b>В руках</b> 
		<select name="e_cmnMuscHands" value="{{e_cmnMuscHands}}">
		<option>существенно не изменен</option>
		<option>повышен</option>
		<option>высокий</option>
		<option>снижен</option>
		<option class="add">низкий</option>
		<option class="add">иное:</option>
		</select>
		<br>
		<b>В ногах</b> 
		<select name="e_cmnMuscLegs" value="{{e_cmnMuscLegs}}">
		<option>существенно не изменен</option>
		<option>повышен</option>
		<option>высокий</option>
		<option>снижен</option>
		<option class="add">низкий</option>
		<option class="add">иное:</option>
		</select>
		</li>
		
		<li><b>Сухожильные и периостальные рефлексы: </b><br>
		<b>На руках</b> 
		<select name="e_cmnReflHands" from="firstView@Сухожильные и периостальные рефлексы: На руках:" value="{{e_cmnReflHands}}">
			<option>средней живости</option>
			<option>живые</option>
			<option>оживлены</option>
			<option>вызываются</option>
			<option>снижены</option>
			<option>низкие</option>
			<option>отсутствуют</option>
			<option class="add">&nbsp;</option>
		</select><br>

		<b>На ногах</b> 
		<select name="e_cmnReflLegs" from="firstView@Сухожильные и периостальные рефлексы: На ногах" value="{{e_cmnReflLegs}}">
			<option>средней живости</option>
			<option>живые</option>
			<option>оживлены</option>
			<option>вызываются</option>
			<option>снижены</option>
			<option>низкие</option>
			<option>отсутствуют</option>
			<option class="add">&nbsp;</option>
		</select>
		</li>
		
		<li><b>Патологические кистевые знаки: </b>
		<select name="e_cmnPatHands"  from="firstView@Патологические кистевые знаки:" value="{{e_cmnPatHands}}">
			<option>отсутствуют</option>
			<option>с двух сторон</option>
			<option>справа</option>
			<option>слева</option>
		</select></li>

		<li><b>Патологические стопные знаки: </b>
		<select multiple="multiple" from="firstView@Патологические стопные знаки:" name="e_cmnPatFoots" value="{{e_cmnPatFoots}}">
			<option>Бабинского</option><option>Оппенгейма</option><option>Россолимо</option>
			<option>отсутствуют</option>
			<option>с двух сторон</option>
			<option>справа</option>
			<option>слева</option>
		</select></li>

		<li><b>Атаксия: </b>
		<textarea name="e_cmnAtaxy" >{{e_cmnAtaxy}}</textarea>
		</li>

		<li><b>Нарушение чувствительности: </b>
		<select multiple="multiple" from="firstView@Нарушения чувствительность:" name="e_cmnPatFoots" value="{{e_cmnPatFoots}}">
			<option>не предъявляет</option>
			<option>гемигипестезия справа</option>
			<option>гемигипестезия слева</option>
			<option>на уколы хуже реагирует справа</option>
			<option>на уколы хуже реагирует слева</option>
			<option>оценить не представилось возможности</option>
		</select></li>



		<li><b>Симптомы орального автоматизма: </b>
		<select name="e_cmnOralAuto" from="firstView@Симптомы орального автоматизма:" value="{{e_cmnOralAuto}}">
			<option>отсутствуют</option>
			<option class="add">Есть</option>
		</select>
		<br><textarea name="e_cmnOralAutoText">{{e_cmnOralAutoText}}</textarea>
		</li>
		
	
		</ul></li>
		

		</ul>

<ul>
	
	<li><b>Инструментальные методы исследования: </b>
	<textarea name="e_researchText">{{e_researchText}}</textarea>
	</li>

	<li><b>Лабораторная диагностика: </b>
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

	<li><b>Переводится в отделение: </b>
	<li><textarea name="e_outText">{{e_outText}}</textarea></li>
	</li>
</ul>




<b>Рекомендовано: </b>
<ul>
<li><textarea name="e_recom1">{{e_recom1}}</textarea></li>
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
$("#epic_window").delegate(".datepicker","mouseenter",function(){$(".datepicker").datepick();});
$("#form-027u select[multiple]").each(function(){
	$(this).css("height",$(this).find("option").length*18+"px");
	$("input[name=endDate]").on("change",function(){
		$("#form-027u span.docDate").html($(this).val());
	});
});
</script>
