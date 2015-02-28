<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Выписной эпикриз</h2></div>
<div data-role="content" >
<div class="copytext">
<div id="form-027u"  class="print_page">
<form method="post">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="person_id">
<p style="text-align:center;"><b>ГБУЗ "Городская клиническая больница №36" ДЗ г.Москвы<br />
Отделение АВТОЗАПОЛНЕНИЕ ИЗ ИБ<br />
г. Москва, ул. Фортунатовская, д.1                                                   тел. +7 (499) 369-34-75</b></p>
<br>
<h2>ВЫПИСНОЙ  ЭПИКРИЗ<br />
ИЗ  ИСТОРИИ  БОЛЕЗНИ    № {{externalId}}</h2>
<br />

		<ol class="fields">
		<li><b>Пациент:</b> <u>{{client}}</u></li>
		<li><b>Возраст:</b> <u>полных лет - {{age}}, дата рождения - {{bDate}}</u></li>
		<li><b>Место работы:</b> <u>{{work}}</u></li>
		<li><b>Адрес:</b> <u>{{address}}</u></li>
		<li><b>Дата поступления <u>{{s_date1}}</u></li>
		<li><b>Находил{{suffix1}} на стационарном лечении в ГБУЗ "Городская клиническая больница №36" ДЗ г.Москвы с <u>{{s_date1}}</u> по <u>{{s_date2}}</u> 
		<u><textarea name="e_stationar">{{e_stationar}}</textarea></u>
		</li>
		<li><b>Диагноз при выписке:</b>
			<ul>
				<li><b>Основной:</b> <u>{{diag_main}}</u> </li>
				<li><b>Фон:</b> <u>{{diag_tera}}</u></li>
				<li><b>Сопутствующий:</b> <u>{{diag_satt}}</u></li>
			</ul>
		</li>
		<li><b>Жалобы при поступлении:</b><br><u><textarea name="e_complaint1">{{e_complaint1}}</textarea></u> </li>
		<li><b>Жалобы при осмотре в н\о:</b><br><u><textarea name="e_complaint2">{{e_complaint2}}</textarea></u> </li>
		<li><b>Анамнез заболевания:</b><br><u><textarea name="e_anamnez1">{{e_anamnez1}}</textarea></u> </li>
		<li><b>Анамнез жизни:</b><br><u><textarea name="e_anamnez2">{{e_anamnez2}}</textarea></u> </li>
		<li><b>Аллергоанамнез:</b><br><u><textarea name="e_anamnez3">{{e_anamnez3}}</textarea></u> </li>
		<li><b>Эпид.анамнез:</b><br><u><textarea name="e_anamnez4">{{e_anamnez4}}</textarea></u> </li>
		<li><b>Находился на больничном листе в течение последних 12 месяцев:</b><br><u><textarea name="e_blist12">{{e_blist12}}</textarea></u> </li>
		<li><b>Состояние при поступлении:</b><br><u><textarea name="e_stateIn">{{e_stateIn}}</textarea></u> </li>
		<li><b>При выписке:</b> 
		<select name="e_stateOut" value="{{e_stateOut}}">
			<option>удовлетворительное</option>
			<option>относительно удовлетворительное</option>
			<option>средней тяжести</option>
			<option>ближе к тяжелому</option>
			<option>тяжелое</option>
			<option>крайне тяжелое</option>
		</select>
		<br><u><textarea name="e_stateOutText">{{e_stateOutText}}</textarea></u> </li>
		<li><b>Тяжесть состояния обусловлена:</b>
		<select name="e_hardState" value="{{e_hardState}}">
			<option>основным заболеванием</option>
			<option>сопутствующей соматической патологией</option>
		</select>
		<br><u><textarea name="e_hardStateText">{{e_hardStateText}}</textarea></u> </li>
		<li><b>Телосложение:</b>
		<select name="e_bodyType" value="{{e_bodyType}}">
			<option>нормостеническое</option>
			<option>гиперстеническое</option>
			<option>астеническое</option>
		</select></li>
		<li><b>Периферические отеки:</b>
		<select name="e_perEdema" value="{{e_perEdema}}">
			<option>отсутствуют</option>
			<option class="add">пастозность</option>
			<option class="add">отёки</option>
		</select>
		<br><u><textarea name="e_perEdemaText">{{e_perEdemaText}}</textarea></u> </li>

		<li><b>Кожные  покровы:</b> 
		<select name="e_skin1" value="{{e_skin1}}">
		<option>обычной окраски</option><option>бледные</option></option>цианоз</option>
		</select>,&nbsp;                            
		<select name="e_skin2" value="{{e_skin2}}">
		<option>сухие</option><option>влажные</option>
		</select>,&nbsp;                            
		<select name="e_skin3" value="{{e_skin3}}">
		<option>трофические нарушения отсутствуют</option><option class="add">трофические нарушения</option>
		</select>	&nbsp;
		<br><u><textarea name="e_skinText">{{e_skinText}}</textarea></u> </li>
		<li><b>St.locales:</b><br><u><textarea name="e_stLocales">{{e_stLocales}}</textarea></u> </li>
		<li><b>Pulm.:</b><br>
					<b>Дыхание:</b>
					<select name="e_pulm1" value="{{e_pulm1}}">
					<option>везикулярное</option><option>с жестковатым оттенком</option></option>жесткое</option>
					</select>,&nbsp;                            
					<select name="e_pulm2" value="{{e_pulm2}}">
					<option>проводится во все отделы</option><option class="add">ослабленное</option>
					</select>
			<ul>
				<li><b>ЧДД:</b> <input name="e_pulmFreq" class="small"> в 1 мин.</li>
				<li><b>Хрипы:</b> 
					<select name="e_pulmHrip1" value="{{e_pulmHrip1}}">
					<option>да</option><option>нет</option>
					</select>
					<select name="e_pulmHrip2" value="{{e_pulmHrip2}}">
					<option>сухие</option><option class="add">влажные</option>
					</select>
				</li>
			</ul>
			<textarea name="e_pulm">{{e_pulm}}</textarea></u> </li>
		<li><b>Cor:</b><br>
			<ul>
			<li><b>ЧСС:</b> <input name="e_corFreq" class="small"> в 1 мин.</li>
			<li><b>АД:</b> <input name="e_corPress" class="small"> мм.рт.ст.</li>
			<li><b>Тоны сердца:</b> 
				<select name="e_corTone" value="{{e_corTone}}">
				<option>ясные</option><option>приглушенные</option><option>глухие</option>
				</select>
			</li>
			<li><b>Ритм:</b> 
				<select name="e_corRitm" value="{{e_corRitm}}">
				<option>правильный</option><option>неправильный</option>
				</select>
			</li>

			</ul>
		</li>	

		<li><b>Живот при пальпации:</b> 
		<select name="e_belly1" value="{{e_belly1}}">
		<option>мягкий</option><option class="add">напряжён</option>
		</select>,&nbsp; 
		<select name="e_belly2" value="{{e_belly2}}">
		<option>безболезненный</option><option class="add">болезненный</option>
		</select>
		</li>
			
		<li><b>Перистальтика:</b> 
		<select name="e_prest" value="{{e_prest}}">
		<option>выслушивается</option><option>не выслушивается</option>
		</select>
		</li>
		
		<li><b>Тазовые функции:</b> 
		<select name="e_taz" value="{{e_taz}}">
		<option>контролирует</option><option>частично контролирует</option><option>не контролирует</option>
		</select>
		</li>

		<li><b>Мочеиспускание:</b>
		<select name="e_urine" value="{{e_urine}}">
			<option>самостоятельно</option>
			<option>по катетору</option>
		</select> Моча <input name="e_urineColor" class="small"> цвета
		<br><u><textarea name="e_perEdemaText">{{e_perEdemaText}}</textarea></u> </li>
		
		<li><b>Дизурические явления:</b> 
		<select name="e_dizur" value="{{e_dizur}}">
		<option>нет</option><option class="add">да</option>
		</select>
		</li>
		
		<li><b>Неврологический статус на момент осмотра:</b><br>
		<ul>
		<li>
		<b>Уровень сознания:</b>
		<select name="e_nevrMind" value="{{e_nevrMind}}">
		<option>в сознании</option>
		<option>оглушение</option>
		<option>сопор</option>
		<option>кома</option>
		<option>уровень сознания меняющийся</option>
		<option>спутанность</option>
		<option>мед.седация</option>
		</select></li>
		<li>
		<b>ШКГ:</b> <input name="e_nervShkg" class="small"> б.&nbsp;
		<b>NIHSS:</b> <input name="e_nervNihss" class="small"> б.&nbsp;
		<b>Ранкин:</b> <input name="e_nervRankin" class="small"> б.&nbsp;
		</li>
		<li>
		<b>Речевому контакту: </b>
		<select name="e_nervContact" value="{{e_nervContact}}">
		<option>доступен</option>
		<option>контакт затруднен из-за речевых нарушений</option>
		<option>контакту недоступен по тяжести состояния</option>
		</select>		
		</li>
		<li>
		<b>Простые инструкции: </b>
		<select name="e_nervSimple" value="{{e_nervSimple}}">
			<option>выполняет</option>
			<option>частично</option>
			<option>не выполняет</option>
		</select>
		</li>
		<li><b>Речь:</b>
		<select name="e_nervTalk" value="{{e_nervTalk}}">
			<option>не нарушена</option>
			<option>дизартрия</option>
			<option class="add">афазия</option>
			<option>мутизм</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Ориентирован{{suffix2}}: </b>
		<select name="e_nervOrient" value="{{e_nervOrient}}">
			<option>в месте, времени, собственной личности</option>
			<option>на вопросы отвечает правильно</option>
			<option>достоверно оценить затруднительно</option>
		</select>
		</li>
		<li><b>Реакция на осмотр: </b>
		<select name="e_nervReaction" value="{{e_nervReaction}}">
			<option>сохранена</option>
			<option>вялая</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Изменение психики: </b>
		<select name="e_nervPsih" value="{{e_nervPsih}}">
			<option>психотических расстройств нет</option>
			<option class="add">есть</option>
		</select>
		</li>
		<li><b>Когнитивные функции: </b>
		<select name="e_nervCogn" value="{{e_nervCogn}}">
			<option>сохранены</option>
			<option>снижены</option>
		</select>
		</li>
		<li><b>Критика: </b>
		<select name="e_nervCritic" value="{{e_nervCritic}}">
			<option>сохранена</option>
			<option>снижена</option>
			<option>отсутствует</option>
		</select>
		</li>
		<li><b>Критика: </b>
		<select name="e_nervBrain" value="{{e_nervBrain}}">
			<option>нет</option>
			<option>головная боль</option>
			<option>головокружение</option>
			<option>тошнота</option>
			<option>рвота</option>
		</select>
		</li>
		<li><b>Менингеальный  синдром: </b>
		<select name="e_nervMening" value="{{e_nervMening}}">
			<option>нет</option>
			<option class="add">есть</option>
		</select>
		</li>
		</ul>
		</li>
		<li>
		<b>ЧМН:</b><ul>

		<li><b>Обоняние: </b>
		<select name="e_cmnObon" value="{{e_cmnObon}}">
			<option>сохранено</option>
			<option>снижено</option>
			<option>не исследовалось</option>
			<option class="add">иное</option>
		</select></li>

		<li><b>Предметное зрение: </b>
		<select name="e_cmnZrenie" value="{{e_cmnZrenie}}">
			<option>сохранено</option>
			<option>снижено OD</option>
			<option>снижено OS</option>
			<option>снижено OU</option>
			<option>не исследовалось</option>
			<option class="add">иное</option>
		</select></li>

		<li><b>Выпадение полей зрения: </b>
		<select name="e_cmnPole" value="{{e_cmnPole}}">	
			<option>контрольным путем не выявлено</option>
			<option>проверить невозможно</option>
			<option>гемианопсия гетеронимная справа</option>
			<option>гемианопсия гетеронимная слева</option>
			<option>гемианопсия гомонимная биназальная</option>
			<option>гемианопсия гомонимная битемпоральная</option>
			<option class="add">иное</option>
		</select></li>

		<li><b>Зрачки OD: </b><input name="e_cmnZrachki" class="small"></li>
		<li><b>Глазные щели: </b><input name="e_cmnSchel" class="small"></li>
		<li><b>Фотореакция: </b>
		<select name="e_cmnFoto" value="{{e_cmnFoto}}">	
		<option>сохранена</option>
		<option>снижена</option>
		<option>отсутствует</option>
		</select></li>

		<li><b>Движения глазных яблок: </b>
		<select multiple="multiple" name="e_cmnApple[]">	
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
		<select multiple="multiple" name="e_cmnNistagm[]">
		<option>мелкоразмашистый</option>
		<option>среднеразмашистый</option>
		<option>крупноразмашистый</option>
		<option>горизонтальный</option>
		<option>вертикальный</option>
		<option>ротаторный</option>
		</select></li>
		
		<li><b>Диплопия: </b>
		<select multiple="multiple" name="e_cmnDiplop[]">
		<option>отрицает</option>
		<option>по горизонтали</option>
		<option>по вертикали</option>
		<option>при взгляде вправо</option>
		<option>при взгляде влево</option>
		<option>при взгляде вверх</option>
		<option>при взгляде вниз</option>
		</select></li>

		<li><b>Слух: </b>
		<select multiple="multiple" name="e_cmnSluh[]">
		<option>сохранен</option>
		<option>ориентировочно снижен AS</option>
		<option>ориентировочно снижен AD</option>
		<option>ориентировочно снижен AU</option>
		<option class="add">иное</option>
		</select></li>
		
		<li><b>Лицо: </b>
		<select multiple="multiple" name="e_cmnFace[]">
		<option>симметрично</option>
		<option>асимметрично за счет сглаженности правой носогубной складки</option>
		<option>асимметрично за счет сглаженности левой носогубной складки</option>
		<option>асимметрично за счет опущения правого угла рта</option>
		<option>асимметрично за счет опущения левого угла рта</option>
		</select></li>

		<li><b>Язык: </b>
		<select name="e_cmnTongue" value="{{e_cmnTongue}}">
		<option>по средней линии</option>
		<option>девиирует вправо</option>
		<option>девиирует влево</option>
		<option>в полости рта</option>
		</select></li>
		
		<li><b>Бульбарные нарушения:</b>
		<select name="e_cmnBulb" value="{{e_cmnBulb}}">
		<option>нет</option>
		<option class="add">есть</option>
		</select>
		<u><textarea name="e_cmnBulbText">{{e_cmnBulbText}}</textarea></u>
		</li>
		
		<li><b>Мышечный тонус: </b><br>
		<b>В руках</b> 
		<select name="e_cmnMuscHands" value="{{e_cmnMuscHands}}">
		<option>существенно не изменен</option>
		<option>повышен</option>
		<option>высокий</option>
		<option>снижен</option>
		<option class="add">низкий</option>
		</select>
		<br>
		<b>В ногах</b> 
		<select name="e_cmnMuscLegs" value="{{e_cmnMuscLegs}}">
		<option>существенно не изменен</option>
		<option>повышен</option>
		<option>высокий</option>
		<option>снижен</option>
		<option class="add">низкий</option>
		</select>
		</li>
		
		<li><b>Двигательные  нарушения: </b>
		<select name="e_cmnMotion" value="{{e_cmnMotion}}">
			<option>явных парезов, параличей не выявлено</option>
			<option class="add">гемипарез</option>
			<option class="add">монопарез</option>
			<option class="add">парапарез</option>
		</select></li>
		
		<li><b>Сухожильные и периостальные рефлексы: </b><br>
		На руках 
		<select name="e_cmnReflHands" value="{{e_cmnReflHands}}">
			<option>средней живости</option>
			<option>живые</option>
			<option>оживлены</option>
			<option>вызываются</option>
			<option>снижены</option>
			<option>низкие</option>
			<option>отсутствуют</option>
		</select><br>
		На ногах 
		<select name="e_cmnReflLegs" value="{{e_cmnReflLegs}}">
			<option>средней живости</option>
			<option>живые</option>
			<option>оживлены</option>
			<option>вызываются</option>
			<option>снижены</option>
			<option>низкие</option>
			<option>отсутствуют</option>
		</select>
		</li>
		
		<li><b>Патологические кистевые знаки: </b>
		<select name="e_cmnPatHands" value="{{e_cmnPatHands}}">
			<option>отсутствуют</option>
			<option>справа</option>
			<option>слева</option>
		</select></li>

		<li><b>Патологические стопные знаки: </b>
		<select name="e_cmnPatFoots" value="{{e_cmnPatFoots}}">
			<option>отсутствуют</option>
			<option>справа</option>
			<option>слева</option>
		</select></li>
		
		<li><b>Симптомы орального автоматизма: </b>
		<select name="e_cmnOralAuto" value="{{e_cmnOralAuto}}">
			<option>отсутствуют</option>
			<option class="add">Есть</option>
		</select>
		<br><u><textarea name="e_cmnOralAutoText">{{e_cmnOralAutoText}}</textarea></u>
		</li>
		
		<li><b>Брюшные рефлексы: </b>
		<select name="e_cmnReflBelly" value="{{e_cmnReflBelly}}">
			<option>вызываются</option>
			<option>снижены</option>
			<option>отсутствуют</option>
		</select></li>
		
		</ul></li>
		
		<li><b>Координаторная сфера: </b><br>
		<ul>
		<li><b>Пальценосовая проба:</b><br>
		<b>Справа: </b>
		<select multiple="multiple" name="e_coorFingerR" value="{{e_coorFingerR}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>не выполняет</option>
		</select>&nbsp;
		<b>Слева: </b>
		<select multiple="multiple" name="e_coorFingerL" value="{{e_coorFingerL}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>не выполняет</option>
		</select>
		</li>
		<li><b>Пяточно-коленная проба: </b><br>
		<b>Справа: </b>
		<select multiple="multiple" name="e_coorFootR" value="{{e_coorFootR}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>не выполняет</option>
		</select>&nbsp;
		<b>Слева: </b>
		<select multiple="multiple" name="e_coorFootL" value="{{e_coorFootL}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>не выполняет</option>
		</select>
		</li>
		<li><b>Нарушения  чувствительности: </b>
		<select name="e_coorSens" value="{{e_coorSens}}">
			<option>не предъявляет</option>
			<option>гемигипестезия справа/слева</option>
			<option>на уколы хуже реагирует справа/слева</option>
			<option class="add">иное</option>
		</select>
		</li>
		<li><b>Дополнительная информация: </b>
		<br><u><textarea name="e_moreText">{{e_moreText}}</textarea></u>
		</li>
		</ul></li>
	
<!--		<div data-role="foreach" from="fields">
		<li>
			<a href='#del' class='del_fld'>Уд.</a>
			<input data-role="none" name="fld[]" value="{{fld}}">
			<u><textarea name="val[]">{{val}}</textarea></u>
		</li>
		</div>
-->
		</ol>

<p align="center"><b><br>
Проводилось лечение в соответствии со стандартами оказания стационарной медицинской помощи<br>
(Код  стандарта    	АВТО    Шифр  по  МКБ   АВТО ОСНОВНОЙ ДС).
</b></p>
<ol>
	<li><b>Препараты: </b><u><textarea name="e_drugsText">{{e_drugsText}}</textarea></u></li>
	<li><b>Проведенное обследование: </b><u><textarea name="e_anayseText">{{e_anayseText}}</textarea></u></li>
	<li><b>Проведенное обследование: </b><u><textarea name="e_anayseText">{{e_anayseText}}</textarea></u></li>
	<li><b>Консультации: </b><u><textarea name="e_consultText">{{e_consultText}}</textarea></u></li>
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
</ol>

<b>Рекомендации: </b>


<ol>
<li><u>Диспансерное наблюдение врачами-специалистами по месту жительства в поликлинике: <textarea name="e_recom1">{{e_recom1}}</textarea></u></li>
<li><u>Диета: <textarea name="e_recom2" placeholder="С ограничением легкоусвояемых углеводов, животных жиров и соли. Питьевой режим.">{{e_recom2}}</textarea></u></li>
<li><u>Контроль АД и ЧСС постоянно. <textarea name="e_recom3" placeholder="При подъеме АД свыше 170-180\90-100 мм рт.ст. – каптоприл 25 мг под язык или нифедипин 10 мг с последующим контролем АД.">{{e_recom3}}</textarea></u></li>
<li><u>Продолжить приём следующих препаратов: <textarea name="e_recom4">{{e_recom4}}</textarea></u></li>
<li><u>Курсовой прием сосудистых, нейротрофических препаратов, антигипоксантов: <textarea name="e_recom5">{{e_recom5}}</textarea></u></li>
<li><u>Консультация в ОКДО ГКБ №36 <textarea placeholder="через __ месяцев с целью коррекции лечения при необходимости." name="e_recom6">{{e_recom6}}</textarea></u></li>
<li><u>Дополнительная информация: <textarea name="e_recom7">{{e_recom7}}</textarea></u></li>
</li>

</ol-->

<br>
<br>
{{docDate}}г.<br />
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

<link rel="stylesheet" href="/style.css" />
<style>
@media screen {
#form-027u * {font-size:14px;}
#form-027u input {width:95%; padding: 3px; text-decoration:underline; font-style: italic;}
#form-027u input.small {width:100px;}
#form-027u input.addinf {width:200px; display:none;}
#form-027u textarea {width:95%; resize:none; text-decoration:underline; font-style: italic; padding: 3px;}
#form-027u textarea.current, #form-027u input.current {border: 1px solid #000;}
#form-027u select[multiple] {overflow: hidden; background: transparent; border:0px;}
#form-027u select[multiple] option {padding-left: 20px; padding-right: 20px;}
#form-027u select[multiple] option[set] {background-color:#ADD8E6 !important; border-left: 10px #008000 solid;}
#form-027u u {font-style: italic;}
#form-027u ul {list-style: none;}
#form-027u .text {line-height:32px; }
#form-027u .text .remark {position:absolute; width:100%; margin-top: 22px; text-align:center; font-size:70%;}
#form-027u table {border:0; border-top:1px #000 solid; border-bottom:1px #000 solid; clear:both; width: 100%; }
#form-027u table td {text-align:center; vertical-align:top;}
#form-027u table td:first-child {border-right:1px #000 solid;}
#form-027u table tr:first-child td:first-child {border-bottom:1px #000 solid;}
#form-027u h2 {text-align:center; font-size:18px;}
#form-027u h2 * {font-size:18px;}
#form-027u a.del_fld {position:absolute; margin-left: -25px; margin-top: 30px;;}
#form-027u select[multiple] {display:block; height: auto;}
}

@media print {
body {display:none;}
#form-027u * {font-size:14px; }
#form-027u input {width:99%; text-decoration:underline; font-style: italic; border:0; color: #000;}
#form-027u input[name=toOrg] {border-bottom: 1px #000 solid; text-align:center;}
#form-027u input.small {width:100px;}
#form-027u input.addinf {width:auto; height:auto; display:none;}
#form-027u textarea {width:99%; resize:none; text-decoration:underline; font-style: italic; border:0; display:none;}
#form-027u select {border:0; -webkit-appearance: none; text-decoration:underline; font-style: italic; color: #000;}
#form-027u select[multiple] {display:none;}
#form-027u u {font-style: italic;}
#form-027u ul {list-style: none;}
#form-027u .text {line-height:32px; }
#form-027u .text .remark {position:absolute; width:100%; margin-top: 15px; text-align:center; font-size:70%;}
#form-027u table {border:0; border-top:1px #000 solid; border-bottom:1px #000 solid; clear:both; width: 100%; }
#form-027u table td {text-align:center; vertical-align:top;}
#form-027u table td:first-child {border-right:1px #000 solid;}
#form-027u table tr:first-child td:first-child {border-bottom:1px #000 solid;}
#form-027u h2 {text-align:center; font-size:18px;}
#form-027u h2 * {font-size:18px;}
#form-027u a.del_fld {display:none;}
#form-027u span {text-decoration:underline; font-style: italic;}
}
</style>
