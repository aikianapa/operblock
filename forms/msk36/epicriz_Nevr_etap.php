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
<b>{{dateShort}}<br />
{{OrgName}} г.Москвы<br />
{{orgStr}}<br />
<br />
<h2>ЭТАПНЫЙ  ЭПИКРИЗ ИЗ  ИСТОРИИ  БОЛЕЗНИ № {{externalId}}</h2>
<br />
<p>Пациент{{suffix3}} <b>{{client}}, {{age}} лет,</b> поступил{{suffix2}} в 36 ГКБ {{s_date1}} по СМП с направительным диагнозом: 
<textarea name="e_diag_in">{{e_diag_in}}</textarea>
</p>
<ul>
		<li><b>Жалобы при поступлении:</b> <textarea name="e_complaint1">{{e_complaint1}}</textarea> </li>
		<li><b>Анамнез заболевания:</b> <textarea name="e_anamnez1">{{e_anamnez1}}</textarea> </li>
		<li><b>Анамнез жизни:</b> <textarea name="e_anamnez2">{{e_anamnez2}}</textarea> </li>
		<li><b>Аллергоанамнез:</b> <textarea name="e_anamnez3">{{e_anamnez3}}</textarea> </li>
		<li><b>Эпид.анамнез:</b> <textarea name="e_anamnez4">{{e_anamnez4}}</textarea> </li>
</ul>		
		
<ul>
	<li><b>Проведено обследование: </b>
	<ul>
		<div data-role="foreach" from="res">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p></li>
		</div>
	</ul>
	</li>

	<li><b>Консультации: </b>
	<ul>
		<div data-role="foreach" from="cons">
			<li>{{cons}}</li>
		</div>
	</ul>
	<textarea name="e_consultText">{{e_consultText}}</textarea></li>
</ul>		
<ul>
		<li><b>Состояние при поступлении:</b> <textarea name="e_stateIn">{{e_stateIn}}</textarea> </li>

		<li><b>На фоне проводимой терапии:</b>
			<ul>
			<li><b>Телосложение:</b>
			<select multiple="multiple" from="DiaryLast@Телосложение:" name="e_bodyType" value="{{e_bodyType}}">
				<option>нормостеническое</option>
				<option>гиперстеническое</option>
				<option>астеническое</option>
			</select></li>
			<li><b>Периферические отеки:</b>
			<select name="e_perEdema" from="DiaryLast@Переферические отеки:" value="{{e_perEdema}}">
				<option>отсутствуют</option>
				<option class="add">пастозность</option>
				<option class="add">отёки</option>
				<option class="add noprint">иное</option>
			</select>
			<br><textarea name="e_perEdemaText">{{e_perEdemaText}}</textarea> </li>

			<li><b>Кожные  покровы:</b> 
			<select name="e_skin1" multiple="multiple" from="DiaryLast@Кожные    покровы"	value="{{e_skin1}}">
				<option>розовые</option><option>бледно - розовые</option><option>бледные</option>
				<option>цианоз</option><option>сухие</option><option>влажные</option>
				<option>трофические нарушения отсутствуют</option><option>обычной окраски и влажности</option>
				<option>свежих следов травм на голове и туловище не выявлено</option>
			</select>
			<textarea name="e_skinText">{{e_skinText}}</textarea></li>
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
			<select multiple="multiple" from="DiaryLast@Живот при пальпации" name="e_belly1" value="{{e_belly1}}">
			<option>мягкий</option><option class="add">напряжён</option>
			<option>без динамики</option><option>безболезненный во всех отделах</option>
			<option>безболезненный</option><option>болезненный</option>
			</select>,&nbsp; <input class="middle" name="e_belly2" value="{{e_belly2}}">
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
			</ul>
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
		<select from="DiaryLast@Речь:" name="e_nervTalk" multiple="multiple" value="{{e_nervTalk}}">
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
		<select from="DiaryLast@Выпадение полей зрения: Гемианопсия:" name="e_cmnPole" value="{{e_cmnPole}}">	
			<option>контрольным путем не выявлено</option>
			<option>проверить невозможно</option>
			<option>гемианопсия гетеронимная справа</option>
			<option>гемианопсия гетеронимная слева</option>
			<option>гемианопсия гомонимная биназальная</option>
			<option>гемианопсия гомонимная битемпоральная</option>
			<option class="add">иное:</option>
		</select></li>

		<li><b>Зрачки: </b><input from="DiaryLast@Зрачки" name="e_cmnZrachki" class="small"></li>
		<li><b>Глазные щели: </b><input from="DiaryLast@Глазные щели" name="e_cmnSchel" class="small"></li>
		<li><b>Фотореакция: </b>
		<select from="DiaryLast@Фотореакция" name="e_cmnFoto" value="{{e_cmnFoto}}">	
		<option>сохранена</option>
		<option>снижена</option>
		<option>отсутствует</option>
		</select></li>

		<li><b>Движения глазных яблок: </b>
		<select multiple="multiple" from="DiaryLast@Движения глазных яблок:" name="e_cmnApple[]">	
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
		<select multiple="multiple" from="DiaryLast@Нистагм:" name="e_cmnNistagm[]">
		<option>отсутствует</option>
		<option>мелкоразмашистый</option>
		<option>среднеразмашистый</option>
		<option>крупноразмашистый</option>
		<option>горизонтальный</option>
		<option>вертикальный</option>
		<option>ротаторный</option>
		</select></li>
		
		<li><b>Диплопия: </b>
		<select multiple="multiple" from="DiaryLast@Диплопия:" name="e_cmnDiplop[]">
		<option>отрицает</option>
		<option>по горизонтали</option>
		<option>по вертикали</option>
		<option>при взгляде вправо</option>
		<option>при взгляде влево</option>
		<option>при взгляде вверх</option>
		<option>при взгляде вниз</option>
		</select></li>

		<li><b>Слух: </b>
		<select multiple="multiple" from="DiaryLast@Слух:" name="e_cmnSluh[]">
		<option>сохранен</option>
		<option>ориентировочно снижен AS</option>
		<option>ориентировочно снижен AD</option>
		<option>ориентировочно снижен AU</option>
		<option class="add">иное:</option>
		</select></li>
		
		<li><b>Лицо: </b>
		<select multiple="multiple" from="DiaryLast@Лицо:" name="e_cmnFace[]">
		<option>симметрично</option>
		<option>асимметрично за счет сглаженности правой носогубной складки</option>
		<option>асимметрично за счет сглаженности левой носогубной складки</option>
		<option>асимметрично за счет опущения правого угла рта</option>
		<option>асимметрично за счет опущения левого угла рта</option>
		</select></li>

		<li><b>Язык: </b>
		<select multiple="multiple" from="DiaryLast@Язык:" name="e_cmnTongue" value="{{e_cmnTongue}}">
		<option>по средней линии</option>
		<option>девиирует вправо</option>
		<option>девиирует влево</option>
		<option>в полости рта</option>
		<option>легко</option>
		</select></li>
		
		<li><b>Бульбарные нарушения:</b>
		<select name="e_cmnBulb" from="DiaryLast@Бульбарные нарушения:" value="{{e_cmnBulb}}">
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
		
		<li><b>Двигательные нарушения: </b>
		<select name="e_cmnMotion" from="DiaryLast@Двигательные нарушения:" value="{{e_cmnMotion}}">
			<option>явных парезов, параличей не выявлено</option>
			<option class="add">гемипарез</option>
			<option class="add">монопарез</option>
			<option class="add">парапарез</option>
			<option class="add">тетрапарез</option>
		</select></li>
		
		<li><b>Сухожильные и периостальные рефлексы: </b>
		<b>На руках</b> 
		<select name="e_cmnReflHands" from="DiaryLast@Сухожильные и периостальные рефлексы: На руках:" value="{{e_cmnReflHands}}">
			<option>средней живости</option>
			<option>живые</option>
			<option>оживлены</option>
			<option>вызываются</option>
			<option>снижены</option>
			<option>низкие</option>
			<option>отсутствуют</option>
			<option class="add">&nbsp;</option>
		</select>
		<b>На ногах</b> 
		<select name="e_cmnReflLegs" from="DiaryLast@Сухожильные и периостальные рефлексы: На ногах" value="{{e_cmnReflLegs}}">
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
		<select name="e_cmnPatHands"  from="DiaryLast@Патологические кистевые знаки:" value="{{e_cmnPatHands}}">
			<option>отсутствуют</option>
			<option>с двух сторон</option>
			<option>справа</option>
			<option>слева</option>
		</select></li>

		<li><b>Патологические стопные знаки: </b>
		<select multiple="multiple" from="DiaryLast@Патологические стопные знаки:" name="e_cmnPatFoots" value="{{e_cmnPatFoots}}">
			<option>Бабинского</option><option>Оппенгейма</option><option>Россолимо</option>
			<option>отсутствуют</option>
			<option>с двух сторон</option>
			<option>справа</option>
			<option>слева</option>
		</select></li>
		
		<li><b>Симптомы орального автоматизма: </b>
		<select name="e_cmnOralAuto" from="DiaryLast@Симптомы орального автоматизма:" value="{{e_cmnOralAuto}}">
			<option>отсутствуют</option>
			<option class="add">Есть</option>
		</select>
		<textarea name="e_cmnOralAutoText">{{e_cmnOralAutoText}}</textarea>
		</li>
		
		<li><b>Брюшные рефлексы: </b>
		<select multiple="multiple" from="DiaryLast@Брюшные рефлексы" name="e_cmnReflBelly" value="{{e_cmnReflBelly}}">
			<option>средней живости</option>
			<option>D</option><option>S</option><option>&lt;</option><option>&gt;</option><option>=</option>
			<option>живые</option>
			<option>оживлены</option>
			<option>вызываются</option>
			<option>снижены</option>
			<option>низкие</option>
			<option>отсутствуют</option>
		</select></li>
		
		</ul></li>
		
		<li><b>Координаторная сфера: </b>
		<ul>
		<li><b>Пальценосовая проба:</b>
		<b>Справа: </b>
		<select multiple="multiple" name="e_coorFingerR" value="{{e_coorFingerR}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>оценить невозможно из-за гемипареза</option>
			<option>оценить невозможно по тяжести состояния</option>
			<option>не выполняет</option>
		</select>&nbsp;
		<b>Слева: </b>
		<select multiple="multiple" name="e_coorFingerL" value="{{e_coorFingerL}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>оценить невозможно из-за гемипареза</option>
			<option>оценить невозможно по тяжести состояния</option>
			<option>не выполняет</option>
		</select>
		</li>
		<li><b>Пяточно-коленная проба: </b>
		<b>Справа: </b>
		<select multiple="multiple" name="e_coorFootR" value="{{e_coorFootR}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>оценить невозможно из-за гемипареза</option>
			<option>оценить невозможно по тяжести состояния</option>
			<option>не выполняет</option>
		</select>&nbsp;
		<b>Слева: </b>
		<select multiple="multiple" name="e_coorFootL" value="{{e_coorFootL}}">
			<option>удовлетворительно</option>
			<option>неуверенно</option>
			<option>с промахиванием</option>
			<option>с интенцией</option>
			<option>с атаксией</option>
			<option>оценить невозможно из-за гемипареза</option>
			<option>оценить невозможно по тяжести состояния</option>
			<option>не выполняет</option>
		</select>&nbsp;
		<b>В позе Ромберга: </b>
		<select multiple="multiple" from="DiaryLast@В позе Ромберга" name="e_coorRomberg" value="{{e_coorRomberg}}">
			<option>устойчив</option>
			<option>не устойчив</option>
			<option>пошатывается</option>
			<option class="add">иное: </option>
		</select>
		</li>
		<li><b>Нарушения  чувствительности: </b>
		<select multiple="multiple" from="DiaryLast@Нарушения чувствительность:" name="e_coorSens" value="{{e_coorSens}}">
			<option>не предъявляет</option>
			<option>гемигипестезия справа</option>
			<option>гемигипестезия слева</option>
			<option>на уколы хуже реагирует справа</option>
			<option>на уколы хуже реагирует слева</option>
			<option class="add noprint">иное:</option>
		</select>
		</li>
		<li><b>Дополнительная информация: </b>
		<textarea from="DiaryLast@Дополнительная информация:" name="e_moreText">{{e_moreText}}</textarea>
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

<ul>
	<li><b>Заключение: </b>
	<textarea name="e_etapText" >{{e_etapText}}</textarea></li>
	
	<li><ul>
			<li><b>Диагноз:</b><textarea name="e_diag_out">{{e_diag_out}}</textarea> </li>
			<li><b>Основное заболевание:</b><textarea name="e_diag_main">{{e_diag_main}}</textarea> </li>
			<li><b>Фоновые заболевания:</b><textarea name="e_diag_fon">{{e_diag_fon}}</textarea></li>
			<li><b>Осложнения основного заболевания:</b><textarea name="e_diag_comp">{{e_diag_comp}}</textarea></li>
			<li><b>Сопутствующие заболевания:</b><textarea name="e_diag_satt">{{e_diag_satt}}</textarea></li>
		</ul>
	</li>
</ul>

<p> Терапия и обследование согласно МЭС . Лечение переносит удовлетворительно. </p>

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
