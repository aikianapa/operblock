<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Посмертный эпикриз</h2></div>
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
<h2 style="font-size:14pt;">ПОСМЕТРНЫЙ ЭПИКРИЗ <div style="font-size:10px;">от <input style="width: 160px;font-size: 10pt;" class="small" type="text" name="s_date2" value="{{s_date2}}"> </div></h2>
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
				<li><b class="bottom-bord">Основное заболевание:</b><textarea name="e_diag_main_in" from="firstDiagView@Основное заболевание">{{e_diag_main_in}}</textarea></li>
				<li><b class="bottom-bord">Фоновые заболевания:</b><textarea name="e_diag_fon_in" from="firstDiagView@Фоновые заболевания">{{e_diag_fon_in}}</textarea></li>
				<li><b class="bottom-bord">Осложнения основного заболевания:</b><textarea name="e_diag_comp_in" from="firstDiagView@Осложнения основного заболевания:">{{e_diag_comp_in}}</textarea></li>
				<li><b class="bottom-bord">Сопутствующие заболевания:</b><textarea name="e_diag_satt_in" from="firstDiagView@Сопутствующие заболевания:">{{e_diag_satt_in}}</textarea></li>
			</ul>
		</li>

		<li><p style="text-align:center;"><b>Код стандарта:</b> <input name="e_code1" class="small"> <b>Шифр по МКБ-10:</b> <input name="e_code2" class="small"></p></li>
		</li>


		<h2>Состояние при поступлении</h2>
		<ul class='bottom-bord'>
			<li><b>Жалобы при поступлении:</b><textarea name="e_complaint1" from="firstZavView@Жалобы">{{e_complaint1}}</textarea> </li>
			<li><b>An.morbi:</b><textarea name="e_anamnez1" from="firstZavView@Anamnesis morbi">{{e_anamnez1}}</textarea> </li>
			<li><b>An.vitae:</b><textarea name="e_an_vitae" from="firstZavView@Anamnesis vitae">{{e_an_vitae}}</textarea> </li>
			<li><b>Аллергологический анамнез:</b><textarea name="e_al_anamnez" from="firstZavView@Аллергологический анамнез">{{e_al_anamnez}}</textarea> </li>
			<li>
				<h3><b>Status praesens</b></h3> 
				<ul class="container nob">
					<li>
						<b>Общее состояние</b> 
						<select multiple="multiple" name="e_diag_sost_out[]"  from="firstZavView@Status praesens: Общее состояние:" >
							<option>удовлетворительное</option>
							<option>средней тяжести</option>
							<option>тяжелое</option>
							<option>крайне тяжелое</option>
						</select>
						<input name="e_diag_sost_out_text" value="">
					</li>
					<li><b>Сознание</b> <textarea class="medium" name="e_diag_mind_out" from="firstZavView@Сознание">{{e_diag_mind_out}}</textarea></li>
					<li><b>Кожные покровы и видимые слизистые:</b> <textarea class="medium" name="e_diag_skin_out" from="firstZavView@Кожные покровы и видимые слизистые">{{e_diag_skin_out}}</textarea></li>
					<li><b>Отёки:</b>
						<textarea class="medium" name="e_diag_edema_out" from="firstZavView@Отёки">{{e_diag_edema_out}}</textarea>
					</li>
				</ul>
			</li> 


			<li>
				<b><h3>Органы дыхания</h3></b>
				<ul class="container nob">
					<li>
						<b>Форма грудной клетки</b>
						<select multiple="multiple" name='e_diag_formgrkl_out[]' value='{{e_diag_formgrkl_out}}' from="firstZavView@Форма грудной клетки">
							<option>коническая</option>
							<option>астеническая,</option>
							<option>гиперстеническая</option>
							<option>рахитная</option>
							<option>кифоз</option>
							<option>лордоз</option>
							<option>сколиоз</option>
							<option>симметрична</option>
							<option>асимметрична</option>
						</select>
						<input name="e_diag_formgrkl_out_text" value="">
					</li>
					<li>
						<b>Участвует в акте дыхания</b>
						<select multiple="multiple" name='e_diag_uchakdh_out[]' value='{{e_diag_uchakdh_out}}' from="firstZavView@Участвует в акте дыхания">
							<option>равномерно</option>
							<option>нет</option>
						</select>
						<input name="e_diag_uchakdh_out_text" value="">
					</li>
					<li>
						<b>Дыхание</b>
						<select multiple="multiple" name='e_diag_dihan_out[]' value='{{e_diag_dihan_out}}' from="firstZavView@Аускультативно: Дыхание" >
							<option>везикулярное</option>
							<option>жесткое</option>
							<option>бронхиальное</option>
							<option>проводится во все отделы легких</option>
							<option>ослаблено в нижних отделах справа</option>
							<option>ослаблено в нижних отделах слева</option>
							<option>ослаблено в нижних отделах с обеих сторон</option>
							<option>ослаблено в верхних отделах</option>
						</select>
						<input name="e_diag_dihan_out_text" value="">
					</li>
					<li>
						<b>Хрипы:</b>
						<select multiple="multiple"  name='e_diag_hrip_out[]' value='{{e_diag_hrip_out}}' from="firstZavView@Хрипы">
							<option>есть</option>
							<option>нет</option>
							<option>влажные звонкие мелкопузырчатые</option>
							<option>влажные звонкие среднепузырчатые</option>
							<option>влажные звонкие крупнопузырчатые</option>
							<option>влажные незвонкие мелкопузырчатые</option>
							<option>влажные незвонкие среднепузырчатые</option>
							<option>влажные незвонкие крупнопузырчатые</option>
							<option>сухие свистящие</option>
							<option>сухие жужжащие</option>
							<option>в верхних отделах легких</option>
							<option>в средних отделах легких</option>
							<option>в нижних отделах легких</option>
							<option>рассеянные</option>
							<option>справа</option>
							<option>слева</option>
							<option>с обеих сторон</option>
						</select>
						<input name="e_diag_hrip_out_text" value="">
					</li>

				</ul>
			</li>

			<li>
				<b><h3>Органы кровообращения</h3></b>
				<ul class="container nob">
					
				<li>
					<b>Область сердца</b>
					<select multiple="multiple"  name='e_diag_oblserd_out[]' value='{{e_diag_oblserd_out}}' from="firstZavView@Область сердца">
						<option>не изменена</option>
						<option>расширена</option>
					</select>
					<input name="e_diag_oblserd_out_text" value="">
				</li>
				<li>
					<b>Границы сердца:</b>
					<select multiple="multiple"  name='e_diag_granserd_out[]' value='{{e_diag_granserd_out}}' from="firstZavView@Границы сердца">
						<option>не расширены</option>
						<option>расширены</option>
						<option>относительно тупости сердца расширены</option>
						<option>правая + см.</option>
						<option>левая + см.</option>
						<option>абсолютной тупости сердца</option>
						<option>верх</option>
						<option>верхняя</option>
					</select>
					<input name="e_diag_granserd_out_text" value="">
				</li>
				<li>
					<b>Тоны сердца</b>
					<select multiple="multiple"  name='e_diag_tonserd_out[]' value='{{e_diag_tonserd_out}}' from="firstZavView@Тоны сердца">
						<option>ясные</option>
						<option>приглушенные</option>
						<option>глухие</option>
						<option>ритмичные</option>
						<option>аритмичные</option>
						<option>акцент II тона</option>
						<option>на аорте</option>
						<option>на легочной артерии</option>
					</select>
					<input name="e_diag_tonserd_out_text" value="">
				</li>
				<li>
					<b>Шумы:</b>
					<select multiple="multiple"  name='e_diag_shumi_out[]' value='{{e_diag_shumi_out}}' from="firstZavView@Шумы">
						<option>есть</option>
						<option>нет</option>
					</select>
					<input name="e_diag_shumi_out_text" value="">
				</li>
				<li>
					<b>Пульсация на периферических артериях:</b>
					<select multiple="multiple"  name='e_diag_pulsnaperar_out[]' value='{{e_diag_pulsnaperar_out}}' from="firstZavView@Пульсация на периферических артериях">
						<option>есть</option>
						<option>нет</option>
					</select>
					<input name="e_diag_pulsnaperar_out_text" value="">
				</li>
				<li><b>ЧСС:</b> <textarea class="medium" name="e_diag_chss_out" from="firstZavView@ЧСС">{{e_diag_chss_out}}</textarea></li>
				<li><b>PS:
				</b> <textarea class="medium" name="e_diag_ps_out" from="firstZavView@PS">{{e_diag_ps_out}}</textarea>в минуту</li>
				<li><b>АД систолическое
				</b> <textarea class="medium" name="e_diag_adsist_out" from="firstZavView@АД систолическое">{{e_diag_adsist_out}}</textarea> мм. рт.ст.</li>
				<li><b>АД диастолическое
				</b> <textarea class="medium" name="e_diag_addist_out" from="firstZavView@АД диастолическое">{{e_diag_addist_out}}</textarea> мм. рт.ст.</li>			

				</ul>



			</li>
			<li>
				<b><h3>Органы пищеварения</h3></b>
				<ul class="container nob">
					<li>
						<b>Живот</b>
						<select multiple="multiple" name='e_diag_belly_out[]' value='{{e_diag_belly_out}}' from="firstZavView@Живот">
							<option>мягкий</option>
							<option>безболезненный</option>
							<option>обычной формы</option>
							<option>симметричный</option>
							<option>вздут</option>
							<option>увеличен в объеме за счет подкожно-жировой клетчатки</option>
							<option>увеличен в объеме за счет асцита</option>
							<option>участвует в акте дыхания</option>
						</select>
						<input name="e_diag_belly_out_text" value="">
					</li>
					<li>
						<b>Язык</b>
						<select multiple="multiple"  name='e_diag_yazikpish_out[]' value='{{e_diag_yazikpish_out}}' from="firstZavView@Язык">
							<option>чистый</option>
							<option>обложен налетом</option>
							<option>сухой</option>
							<option>влажный</option>
						</select>
						<input name="e_diag_yazikpish_out_text" value="">
					</li>
					<li>
						<b>Печень:</b>
						<select multiple="multiple"  name='e_diag_liver_out[]' value='{{e_diag_liver_out}}' from="firstZavView@Печень">
							<option>у края реберной дуги, по среднеключичной линии справа</option>
							<option>с острым краем</option>
							<option>бугристая</option>
							<option>при пальпации безболезненная</option>
							<option>болезненная при пальпации</option>
							<option>увеличена за счет</option>
							<option>правой доли печени</option>
							<option>левой доли печени</option>
							<option>размер по Курлову см. х см.</option>
							<option>плотная на ощупь</option>
							<option>мягкий</option>
							<option>закруглен</option>
						</select>
						<input name="e_diag_liver_out_text" value="">
					</li>
					<li>
						<b>Симптом поколачивания по поясничной области:</b>
						<select multiple="multiple" name='e_diag_simp_pok_poys_obl_out[]' value='{{e_diag_simp_pok_poys_obl_out}}' from="firstZavView@ОСимптом поколачивания по поясничной области">
							<option>отрицательный с обеих сторон</option>
							<option>положительный справа</option>
							<option>положительный слева</option>
						</select>
						<input name="e_diag_simp_pok_poys_obl_out_text" value="">
					</li>

				</ul>
			</li>

<!-- 			<li>
				<b><h3>Органы мочевыделения</h3></b>
				<ul class="container nob">
					<li>
						<b>Область почек:</b>
						<select multiple="multiple" name='e_diag_obl_pochk_out[]' value='{{e_diag_obl_pochk_out}}' from="firstZavView@Область почек">
							<option>изменена</option>
							<option>не изменена</option>
						</select>
						<input name="e_diag_obl_pochk_out_text" value="">
					</li>
					<li>
						<b>Симптом поколачивания по поясничной области:</b>
						<select multiple="multiple" name='e_diag_simp_pok_poys_obl_out[]' value='{{e_diag_simp_pok_poys_obl_out}}' from="firstZavView@ОСимптом поколачивания по поясничной области">
							<option>отрицательный с обеих сторон</option>
							<option>положительный справа</option>
							<option>положительный слева</option>
						</select>
						<input name="e_diag_simp_pok_poys_obl_out_text" value="">
					</li>
					<li>
						<b>Мочеиспускание:</b>
						<select multiple="multiple" name='e_diag_mocheisp_out[]' value='{{e_diag_mocheisp_out}}' from="firstZavView@Мочеиспускание">
							<option>дизурии нет</option>
							<option>затруднено</option>
							<option>учащенное</option>
							<option>анурия</option>
							<option>никтурия</option>
						</select>
						<input name="e_diag_mocheisp_out_text" value="">
					</li>
				</ul>

			</li> -->

			<li>
				<b><h3>Неврологический и психический статус <button name="nevr-toggle-in">Скрыть</button></h3></b>
				<ul class="container nob" name='nevr-status-in'>
					<li>
						<b>Уровень сознания:</b>
						<select multiple="multiple"  name="e_diag_soznur_out[]" value="{{e_diag_soznur_out}}" multiple="multiple" from="firstZavView@Уровень сознания">
							<option>в сознании – 15 б</option>
							<option>заторможенность</option>
							<option>оглушенность 13-14 б</option>
							<option>сопор 9-12 б</option>
							<option>кома 4-8б</option>
							<option>спутанность</option>
							<option>мед.седация</option>
						</select>
						<input name="e_diag_soznur_out_text" value="">
					</li>
					<li><b>ШКГ: 
					</b> <textarea class="medium" name="e_diag_shkg_out" from="firstZavView@ШКГ">{{e_diag_shkg_out}}</textarea></li>
					<li><b>NIHSS: 
					</b> <textarea class="medium" name="e_diag_nihss_out" from="firstZavView@NIHSS">{{e_diag_nihss_out}}</textarea></li>
					<li><b>Ривермид: 
					</b> <textarea class="medium" name="e_diag_rivermid_out" from="firstZavView@Ривермид">{{e_diag_rivermid_out}}</textarea></li>
					<li><b>Ранкин: 
					</b> <textarea class="medium" name="e_diag_rankin_out" from="firstZavView@Ранкин">{{e_diag_rankin_out}}</textarea></li>


					<li>
						<b>Речевому контакту:</b>
						<select multiple="multiple"  name="e_diag_rechkont_out[]" value="{{e_diag_rechkont_out}}" from="firstZavView@Речевому контакту">
							<option>доступен</option>
							<option>недоступен из-за речевых нарушений</option>
							<option>контакту недоступен по тяжести состояния</option>
						</select>
						<input name="e_diag_rechkont_out_text" value="">
					</li>
					<li>
						<b>Простые инструкции:</b>
						<select multiple="multiple"  name="e_diag_prostinsrt_out[]" value="{{e_diag_prostinsrt_out}}" from="firstZavView@Простые инструкции">
							<option>выполняет</option>
							<option>выполняет частично</option>
							<option>не выполняет</option>
						</select>
						<input name="e_diag_prostinsrt_out_text" value="">
					</li>
					<li>
						<b>Речь:</b>
						<select multiple="multiple"  name="e_diag_rech_out[]" value="{{e_diag_rech_out}}" from="firstZavView@Речь">
							<option>не нарушена</option>
							<option>моторная</option>
							<option>грубая</option>
							<option>дизартрия</option>
							<option>афазия</option>
							<option>мутизм</option>
							<option>осутствует</option>
							<option>сенсорная</option>
							<option>тотальная</option>
							<option>сенсо-моторная</option>
							<option>сохранена</option>
							<option>легкая</option>
						</select>
						<input name="e_diag_rech_out_text" value="">
					</li>
					<li>
						<b>Реакция на осмотр:</b>
						<select multiple="multiple"  name="e_diag_reaktnaosm_out[]" value="{{e_diag_reaktnaosm_out}}" from="firstZavView@Реакция на осмотр">
							<option>сохранена</option>
							<option>адекватная</option>
							<option>вялая</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_reaktnaosm_out_text" value="">
					</li>
					<li>
						<b>Изменения психики:</b>
						<select multiple="multiple"  name="e_diag_izmpsyh_out[]" value="{{e_diag_izmpsyh_out}}" from="firstZavView@Изменения психики">
							<option>эмоционально лабилен</option>
							<option>эмоционально лабильна</option>
							<option>фиксирована на жалобах</option>
							<option>фиксирован на жалобах</option>
							<option>неконтактен</option>
							<option>контактен</option>
							<option>неконтактна</option>
							<option>контактна</option>
							<option>неадекватен</option>
							<option>адекватен</option>
							<option>адекватна</option>
							<option>неадекватна</option>
							<option>ориентирован</option>
							<option>ориентирована</option>
							<option>дезориентирован</option>
							<option>дезориентирована</option>
							<option>во времени</option>
							<option>собственной личности</option>
							<option>спокоен</option>
							<option>спокойна</option>
							<option>возбужден</option>
							<option>возбуждена</option>
							<option>агрессивен</option>
							<option>агрессивна</option>
							<option>понимает обращенную речь</option>
							<option>не понимает обращенную речь</option>
							<option>речь память нарушена</option>
							<option>речь память не нарушена</option>
							<option>контактен</option>
							<option>адекватен</option>
							<option>ориентирован в пространстве</option>
							<option>времени</option>
							<option>собственной личности</option>
							<option>спокоен</option>
							<option>понимает обращенную речь</option>
							<option>речь</option>
							<option>память не нарушена</option>
							<option>ясное</option>
							<option>контактна</option>
							<option>адекватна</option>
							<option>ориентирована в пространстве</option>
							<option>времени</option>
							<option>собственной личности</option>
							<option>спокойна</option>
							<option>понимает обращенную речь</option>
							<option>речь, память не нарушена</option>
							<option>психомоторное возбуждение</option>
							<option>бред</option>
							<option>галлюцинации есть</option>
							<option>галлюцинации - нет</option>
							<option>критика сохранена</option>
							<option>критика снижена</option>
							<option>оценить не представляется возможным</option>
						</select>
						<input name="e_diag_izmpsyh_out_text" value="">
					</li>
					<li>
						<b>Когнитивные функции:</b>
						<select multiple="multiple"  name="e_diag_cognfun_out[]" value="{{e_diag_cognfun_out}}" from="firstZavView@Когнитивные функции">
							<option>сохранены</option>
							<option>снижены</option>
							<option>оценить не представляется возможным</option>
						</select>
						<input name="e_diag_cognfun_out_text" value="">
					</li>
					<li>
						<b>Менингеальный синдром:</b>
						<select multiple="multiple"  name="e_diag_miningalsynd_out[]" value="{{e_diag_miningalsynd_out}}" from="firstZavView@Менингеальный синдром">
							<option>нет</option>
							<option>есть</option>
							<option>Кернига</option>
							<option>Бехтерева</option>
							<option>Гийена</option>
							<option>Лессажа</option>
							<option>ригидность мышц затылка</option>
							<option>Брудзинского средний</option>
							<option>Брудзинского нижний</option>
							<option>Брудзинского верхний</option>
						</select>
						<input name="e_diag_miningalsynd_out_text" value="">
					</li>
					<li>
						<b>Общемозговые симптомы:</b>
						<select multiple="multiple"  name="e_diag_obshemozg_out[]" value="{{e_diag_obshemozg_out}}" from="firstZavView@Общемозговые симптомы">
							<option>тошнота</option>
							<option>рвота</option>
							<option>головная боль</option>
							<option>головокружение системное</option>
							<option>головокружение несистемное</option>
							<option>головокружение позиционное</option>
							<option>есть</option>
							<option>нет</option>
						</select>
						<input name="e_diag_obshemozg_out_text" value="">
					</li>
					<li><b>Черепно-мозговые нервы: 
					</b> <textarea class="medium" name="e_diag_chemone_out" from="firstZavView@Черепно-мозговые нервы">{{e_diag_chemone_out}}</textarea></li>
					<li>
						<b>Обоняние:</b>
						<select multiple="multiple"  name="e_diag_obon_out[]" value="{{e_diag_obon_out}}" from="firstZavView@Обоняние">
							<option>не нарушено</option>
							<option>аномсия</option>
							<option>гипосмия</option>
							<option>гиперосмия</option>
							<option>не исследовалось</option>
						</select>
						<input name="e_diag_obon_out_text" value="">
					</li>
					<li>
						<b>Острота зрения:</b>
						<select multiple="multiple"  name="e_diag_ostrzren_out[]" value="{{e_diag_ostrzren_out}}" from="firstZavView@Острота зрения"> 
							<option>не нарушена</option>
							<option>нарушена</option>
							<option>не исследована</option>
							<option>снижена</option>
						</select>
						<input name="e_diag_ostrzren_out_text" value="">
					</li>
					<li>
						<b>Поля зрения:</b>
						<select multiple="multiple" name="e_diag_polezren_out[]" value="{{e_diag_polezren_out}}" from="firstZavView@Поля зрения">
							<option>выпадения контрольным путем не выявлено</option>
							<option>выпадения контрольным путем выявлено</option>
							<option>проверить невозможно</option>
						</select>
						<input name="e_diag_polezren_out_text" value="">
					</li>
					<li>
						<b>Гемианопсия:</b>
						<select multiple="multiple"  name="e_diag_gepoksia_out[]" value="{{e_diag_gepoksia_out}}" from="firstZavView@Гемианопсия">
							<option>гетеронимная</option>
							<option>слева</option>
							<option>справа</option>
							<option>гомонимная</option>
							<option>биназальная</option>
							<option>битемпоральная</option>
							<option>контрольным путем не выявлено</option>
							<option>проверить невозможно</option>
							<option>гемианопсия</option>
						</select>
						<input name="e_diag_gepoksia_out_text" value="">
					</li>
					<li><b>Цветоощущение:
					</b> <textarea class="medium" name="e_diag_cvetoosh_out" from="firstZavView@Цветоощущение">{{e_diag_cvetoosh_out}}</textarea></li>
					<li><b>Глазное дно:
					</b> <textarea class="medium" name="e_diag_glazyabl_out" from="firstZavView@Глазное дно">{{e_diag_glazyabl_out}}</textarea></li>
					<li><b>Зрачки: 
					</b> <textarea class="medium" name="e_diag_zrachki_out" from="firstZavView@Зрачки">{{e_diag_zrachki_out}}</textarea></li>
					<li>
						<b>Фотореакция:</b>
						<select multiple="multiple"  name="e_diag_fotoreact_out[]" value="{{e_diag_fotoreact_out}}" from="firstZavView@Фотореакция">
							<option>сохранена</option>
							<option>снижена</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_fotoreact_out_text" value="">
					</li>
					<li>
						<b>Нистагм:</b>
						<select multiple="multiple"  name="e_diag_nistagm_out[]" value="{{e_diag_nistagm_out}}" from="firstZavView@Нистагм">
							<option>отсутствует</option>
							<option>мелкоразмашистый</option>
							<option>среднеразмашистый</option>
							<option>крупноразмашистый</option>
							<option>горизонтальный</option>
							<option>вертикальный</option>
							<option>ротаторный</option>
							<option>влево</option>
							<option>вправо</option>
						</select>
						<input name="e_diag_nistagm_out_text" value="">
					</li>
					<li>
						<b>Глазодвигательные нарушения:</b>
						<select multiple="multiple"  name="e_diag_glazovidnar_out[]" value="{{e_diag_glazovidnar_out}}" from="firstZavView@Глазодвигательные нарушения">
							<option>в полном объеме</option>
							<option>нистагм</option>
							<option>диплопия</option>
							<option>окулоцефалический рефлекс</option>
							<option>окуловестибулярный рефлекса</option>
							<option>за ориентиром не следит</option>
							<option>не доводит глазные яблоки</option>
							<option>вправо</option>
							<option>влево</option>
							<option>вверх</option>
							<option>вниз</option>
							<option>установка взора</option>
							<option>парез взора</option>
						</select>
						<input name="e_diag_glazovidnar_out_text" value="">
					</li>
					<li>
						<b>Экзофтальм:</b>
						<select multiple="multiple"  name="e_diag_ekzoftalm_out[]" value="{{e_diag_ekzoftalm_out}}" from="firstZavView@Экзофтальм">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_ekzoftalm_out_text" value="">
					</li>
					<li>
						<b>Энофтальм:</b>
						<select multiple="multiple"  name="e_diag_enoftalm_out[]" value="{{e_diag_enoftalm_out}}" from="firstZavView@Энофтальм">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_enoftalm_out_text" value="">
					</li>
					<li>
						<b>Птоз:</b>
						<select multiple="multiple"  name="e_diag_ptoz_out[]" value="{{e_diag_ptoz_out}}" from="firstZavView@Птоз">
							<option>есть</option>
							<option>нет</option>
							<option>справа</option>
							<option>слева</option>
							<option>с 2х сторон</option>
						</select>
						<input name="e_diag_ptoz_out_text" value="">
					</li>
					<li>
						<b>Диплопия:</b>
						<select multiple="multiple"  name="e_diag_diplonia_out[]" value="{{e_diag_diplonia_out}}" from="firstZavView@Диплопия">
							<option>нет</option>
							<option>при взгляде</option>
							<option>вправо</option>
							<option>влево</option>
							<option>вниз</option>
							<option>вверх</option>
							<option>прямо</option>
						</select>
						<input name="e_diag_diplonia_out_text" value="">
					</li>
					<li>
						<b>Движение нижней челюстью, жевательные мышцы:</b>
						<select multiple="multiple"  name="e_diag_dvizhnizhnche_out[]" value="{{e_diag_dvizhnizhnche_out}}" from="firstZavView@Движение нижней челюстью, жевательные мышцы">
							<option>не изменены</option>
							<option>изменены</option>
						</select>
						<input name="e_diag_dvizhnizhnche_out_text" value="">
					</li>
					<li>
						<b>Роговичный, конъюнктивальный рефлекс:</b>
						<select multiple="multiple"  name="e_diag_rogovichkon_out[]" value="{{e_diag_rogovichkon_out}}" from="firstZavView@Роговичный, конъюнктивальный рефлекс">
							<option>живой</option>
							<option>вялый</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_rogovichkon_out_text" value="">
					</li>
					<li>
						<b>Чувствительность на лице:</b>
						<select multiple="multiple"  name="e_diag_chuvsctnalic_out[]" value="{{e_diag_chuvsctnalic_out}}" from="firstZavView@Чувствительность на лице">
							<option>не изменена</option>
							<option>безболезненны</option>
							<option>гиперестезия</option>
							<option>гипестезия</option>
							<option>слева</option>
							<option>справа</option>
							<option>по зонам Зельдера</option>
							<option>по ветвям тройничного нерва</option>
							<option>триггерные точки</option>
							<option>болезненны</option>
						</select>
						<input name="e_diag_chuvsctnalic_out_text" value="">
					</li>
					<li>
						<b>Лицо:</b>
						<select multiple="multiple"  name="e_diag_lico_out[]" value="{{e_diag_lico_out}}" from="firstZavView@Лицо">
							<option>симметрично</option>
							<option>асимметрично</option>
							<option>за счет сглаженности правой носогубной складки</option>
							<option>за счет сглаженности левой носогубной складки</option>
							<option>за счет опущения правого угла рта, за счет опущения левого угла рта</option>
							<option>симптом паруса</option>
						</select>
						<input name="e_diag_lico_out_text" value="">
					</li>
					<li>
						<b>Лагофтальм:</b>
						<select multiple="multiple"  name="e_diag_lagoftalm_out[]" value="{{e_diag_lagoftalm_out}}" from="firstZavView@Лагофтальм">
							<option>есть</option>
							<option>нет</option>
							<option>справа</option>
							<option>слева</option>
						</select>
						<input name="e_diag_lagoftalm_out_text" value="">
					</li>
					<li>
						<b>Мимические пробы:</b>
						<select multiple="multiple"  name="e_diag_mimiprob_out[]" value="{{e_diag_mimiprob_out}}" from="firstZavView@Мимические пробы">
							<option>выполняет</option>
							<option>прозопарез</option>
							<option>справа</option>
							<option>слева</option>
							<option>с двух сторон</option>
							<option>нет</option>
							<option>выполняет пропорционально</option>
							<option>не выполняет</option>
							<option>определяется слабость</option>
							<option>жевательной мышцы</option>
							<option>круговой мышцы рта</option>
							<option>круговой мышцы глаза</option>
							<option>щечной мышцы</option>
						</select>
						<input name="e_diag_mimiprob_out_text" value="">
					</li>
					<li>
						<b>Гиперакузия:</b>
						<select multiple="multiple"  name="e_diag_giperakuz_out[]" value="{{e_diag_giperakuz_out}}" from="firstZavView@Гиперакузия">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_giperakuz_out_text" value="">
					</li>
					<li>
						<b>Сухость глаз:</b>
						<select multiple="multiple"  name="e_diag_suhglaz_out[]" value="{{e_diag_suhglaz_out}}" from="firstZavView@Сухость глаз">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_suhglaz_out_text" value="">
					</li>
					<li>
						<b>Слюноотделение:</b>
						<select multiple="multiple"  name="e_diag_slunotd_out[]" value="{{e_diag_slunotd_out}}" from="firstZavView@Слюноотделение">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_slunotd_out_text" value="">
					</li>
					<li>
						<b>Слух:</b>
						<select multiple="multiple"  name="e_diag_sluh_out[]" value="{{e_diag_sluh_out}}" from="firstZavView@Слух">
							<option>сохранен</option>
							<option>ориентировочно снижен</option>
							<option>AS</option>
							<option>AD</option>
							<option>AU</option>
						</select>
						<input name="e_diag_sluh_out_text" value="">
					</li>
					<li>
						<b>Парез мягкого неба:</b>
						<select multiple="multiple"  name="e_diag_parezmyagneba_out[]" value="{{e_diag_parezmyagneba_out}}" from="firstZavView@Парез мягкого неба">
							<option>есть</option>
							<option>нет</option>
							<option>слева</option>
							<option>справа</option>
						</select>
						<input name="e_diag_parezmyagneba_out_text" value="">
					</li>
					<li>
						<b>Глоточный рефлекс:</b>
						<select multiple="multiple"  name="e_diag_glotreflex_out[]" value="{{e_diag_glotreflex_out}}" from="firstZavView@Глоточный рефлекс">
							<option>сохранен</option>
							<option>дисфагия</option>
							<option>дисфония</option>
						</select>
						<input name="e_diag_glotreflex_out_text" value="">
					</li>
					<li>
						<b>Вкусовой анализатор:</b>
						<select multiple="multiple"  name="e_diag_vkusovoianalizator_out[]" value="{{e_diag_vkusovoianalizator_out}}" from="firstZavView@Вкусовой анализатор">
							<option>ощущение соленого</option>
							<option>ощущение сладкого</option>
							<option>ощущение кислого</option>
							<option>есть</option>
							<option>нет</option>
						</select>
						<input name="e_diag_vkusovoianalizator_out_text" value="">
					</li>
					<li>
						<b>Положение головы и поднимание плеч:</b>
						<select multiple="multiple"  name="e_diag_polozhgolov_out[]" value="{{e_diag_polozhgolov_out}}" from="firstZavView@Положение головы и поднимание плеч">
							<option>не нарушено</option>
							<option>насильственный поворот влево</option>
							<option>насильственный поворот вправо</option>
						</select>
						<input name="e_diag_polozhgolov_out_text" value="">
					</li>
					<li>
						<b>Язык:</b>
						<select multiple="multiple"  name="e_diag_yaziknerv_out[]" value="{{e_diag_yaziknerv_out}}" from="firstZavView@Язык">
							<option>по средней линии</option>
							<option>девиирует вправо</option>
							<option>девиирует влево</option>
							<option>в полости рта легко</option>
						</select>
						<input name="e_diag_yaziknerv_out_text" value="">
					</li>
					<li>
						<b>Прикус языка:</b>
						<select multiple="multiple"  name="e_diag_prikus_out[]" value="{{e_diag_prikus_out}}" from="firstZavView@Прикус языка">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_prikus_out_text" value="">
					</li>
					<li>
						<b>Фибриллярные подергивания:</b>
						<select multiple="multiple"  name="e_diag_fibrpod_out[]" value="{{e_diag_fibrpod_ou}}" from="firstZavView@Фибриллярные подергивания">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_fibrpod_out_text" value="">
					</li>
					<li><b>Двигательная сфера:  
					</b> <textarea class="medium" name="e_diag_dvigsph_out" from="firstZavView@Двигательная сфера">{{e_diag_dvigsph_out}}</textarea></li>
					<li>
						<b>Положение тела:</b>
						<select multiple="multiple"  name="e_diag_poloztela_out[]" value="{{e_diag_poloztela_out}}" from="firstZavView@Положение тела">
							<option>вынужденная поза</option>
							<option>декортикационная ригидность</option>
							<option>децеребрационная ригидность</option>
							<option>защитные движения</option>
							<option>синкинезии</option>
							<option>стереотипные движения</option>
							<option>есть</option>
							<option>нет</option>
							<option>не изменено</option>
						</select>
						<input name="e_diag_poloztela_out_text" value="">
					</li>
					<li>
						<b>Непроизвольные движения:</b>
						<select multiple="multiple"  name="e_diag_neprdviz_out[]" value="{{e_diag_neprdviz_out}}" from="firstZavView@Непроизвольные движения">
							<option>есть</option>
							<option>нет</option>
							<option>орофасциальная дискинезия</option>
							<option>тики</option>
							<option>хорея</option>
							<option>дистония</option>
							<option>атетоз</option>
						</select>
						<input name="e_diag_neprdviz_out_text" value="">
					</li>
					<li>
						<b>Мышечная масса:</b>
						<select multiple="multiple"  name="e_diag_musmass_out[]" value="{{e_diag_musmass_out}}" from="firstZavView@Мышечная масса">
							<option>норма</option>
							<option>атрофия</option>
							<option>гипертрофия</option>
							<option>гипотрофия</option>
						</select>
						<input name="e_diag_musmass_out_text" value="">
					</li>
					<li>
						<b>Мышечный тонус:</b>
						<select multiple="multiple"  name="e_diag_masstonus_out[]" value="{{e_diag_masstonus_out[]}}" from="firstZavView@Мышечный тонус">
							<option>в руках существенно</option>
							<option>&gt;</option>
							<option>S</option>
							<option>существенно не изменен</option>
							<option>в ногах существенно</option>
							<option>по спастическому типу</option>
							<option>по пластическому типу</option>
							<option>не изменен</option>
							<option>повышен</option>
							<option>высокий</option>
							<option>снижен</option>
							<option>низкий</option>
							<option>D</option>
							<option>&lt;</option>
							<option>=</option>
						</select>
						<input name="e_diag_masstonus_out_text" value="">
					</li>
					<li>
						<b>Мышечная сила:</b>
						<select multiple="multiple"  name="e_diag_masssil_out[]" value="{{e_diag_masssil_out}}" from="firstZavView@Мышечная сила">
							<option>монопарез</option>
							<option>моноплегия</option>
							<option>плегия</option>
							<option>верхний</option>
							<option>нижний</option>
							<option>верхняя</option>
							<option>гемипарез</option>
							<option>нижняя</option>
							<option>в пробе Барре хуже удерживает</option>
							<option>правые конечности</option>
							<option>левые конечности</option>
							<option>верхнюю конечность</option>
							<option>нижнюю конечность</option>
							<option>параплегия</option>
							<option>парапарез</option>
							<option>тетраплегия</option>
							<option>тетрапарез</option>
							<option>рука</option>
							<option>нога</option>
							<option>слева</option>
							<option>справа</option>
							<option>гемиплегия</option>
						</select>
						<input name="e_diag_masssil_out_text" value="">
					</li>
					<li><b>Координаторная сфера: 
					</b> <textarea class="medium" name="e_diag_coordsph_out" from="firstZavView@Координаторная сфера">{{e_diag_coordsph_out}}</textarea></li>
					<li>
						<b>Координация движений:</b>
						<select multiple="multiple"  name="e_diag_koorddiz_out[]" value="{{e_diag_koorddiz_out}}" from="firstZavView@Координация движений">
							<option>нарушено</option>
							<option>не нарушено</option>
							<option>нет</option>
							<option>выполнение точных движений</option>
							<option>выполнение альтернирующих движений</option>
						</select>
						<input name="e_diag_koorddiz_out_text" value="">
					</li>
					<li>
						<b>Походка:</b>
						<select multiple="multiple"  name="e_diag_pohodka_out[]" value="{{e_diag_pohodka_out}}" from="firstZavView@Походка">
							<option>спастическая</option>
							<option>степпаж</option>
							<option>сенсорная атаксия</option>
							<option>мозжечковая атаксия</option>
							<option>паркинсоническая</option>
							<option>не изменена</option>
						</select>
						<input name="e_diag_pohodka_out_text" value="">
					</li>
					<li>
						<b>Застывание в определенных позах:</b>
						<select multiple="multiple"  name="e_diag_zast_out[]" value="{{e_diag_zast_out}}" from="firstZavView@Застывание в определенных позах">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_zast_out_text" value="">
					</li>
					<li>
						<b>Координаторные пробы:</b>
						<select multiple="multiple"  name="e_diag_koordprob_out[]" value="{{e_diag_koordprob_out}}" from="firstZavView@Координаторные пробы">
							<option>справа</option>
							<option>удовлетворительно</option>
							<option>неуверенно</option>
							<option>с промахиванием</option>
							<option>с интенцией</option>
							<option>с атаксией</option>
							<option>не выполняет</option>
							<option>слева</option>
							<option>с двух сторон</option>
							<option>оценить невозможно из-за гемипареза</option>
							<option>оценить невозможно по тяжести состояния</option>
							<option>пальценосовая проба</option>
							<option>пяточно-коленная проба</option>
							<option>с мимопопаданием</option>
							<option>дисдиадохокинез</option>
							<option>дисметрия</option>
						</select>
						<input name="e_diag_koordprob_out_text" value="">
					</li>
					<li>
						<b>Статическое равновесие:</b>
						<select multiple="multiple"  name="e_diag_statravn_out[]" value="{{e_diag_statravn_ou}}" from="firstZavView@Статическое равновесие">
							<option>в позе Ромберга</option>
							<option>в усложненной позе Ромберга</option>
							<option>асинергия Бабинского</option>
							<option>пошатывание</option>
							<option>падает</option>
							<option>устойчив</option>
							<option>устойчива</option>
							<option>неустойчив</option>
							<option>неустойчива</option>
							<option>отклоняется</option>
							<option>вправо</option>
							<option>влево</option>
							<option>вперед, назад, не проверялся, не проверялась</option>
						</select>
						<input name="e_diag_statravn_out_text" value="">
					</li>
					<li>
						<b>Атаксия:</b>
						<select multiple="multiple"  name="e_diag_staksia_out[]" value="{{e_diag_staksia_out}}" from="firstZavView@Атаксия">
							<option>статическая</option>
							<option>динамическая</option>
							<option>стато-локомоторная</option>
							<option>стато-динамическая</option>
							<option>в Ромберга-пошатывание</option>
							<option>не исследовалась</option>
							<option>не выявлена</option>
						</select>
						<input name="e_diag_staksia_out_text" value="">
					</li>
					<li>
						<b>Нарушения чувствительности:</b>
						<select multiple="multiple"  name="e_diag_narushchuvs_out[]" value="{{e_diag_narushchuvs_out}}" from="firstZavView@Нарушения чувствительности">
							<option>не предъявляет</option>
							<option>гемигипестезия справа</option>
							<option>гемигипестезия слева</option>
							<option>на уколы хуже реагирует справа</option>
							<option>на уколы хуже реагирует слева</option>
							<option>оценить не представляется возможным</option>
							<option>по периферическому типу</option>
							<option>по полиневритическому типу</option>
							<option>полиестезия</option>
							<option>дизестезия</option>
							<option>парестезии</option>
							<option>гиперпатия</option>
							<option>аллохейрия</option>
							<option>по сегментарному типу</option>
							<option>изменена</option>
						</select>
						<input name="e_diag_narushchuvs_out_text" value="">
					</li>
					<li>
						<b>Болевая чувствительность:</b>
						<select multiple="multiple"  name="e_diag_bolchuvst_out[]" value="{{e_diag_bolchuvst_out}}" from="firstZavView@Болевая чувствительность">
							<option>аналгезия</option>
							<option>гипералгезия</option>
							<option>гипалгезия</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_bolchuvst_out_text" value="">
					</li>
					<li>
						<b>Температурная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_tempchuvst_out[]" value="{{e_diag_tempchuvst_out}}" from="firstZavView@Температурная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>терманестезия</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_tempchuvst_out_text" value="">
					</li>
					<li>
						<b>Тактильная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_tempchuvst_out[]" value="{{e_diag_tempchuvst_out}}" from="firstZavView@Тактильная чувствительность">
							<option>анестезия</option>
							<option>гиперестезия</option>
							<option>гипестезия</option>
						</select>
						<input name="e_diag_tempchuvst_out_text" value="">
					</li>
					<li>
						<b>Вибрационная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_vibrchuvst_out[]" value="{{e_diag_vibrchuvst_out[]}}" from="firstZavView@Вибрационная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_vibrchuvst_out_text" value="">
					</li>
					<li>
						<b>Проприоцептивная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_propchucst_out[]" value="{{e_diag_propchucst_out}}" from="firstZavView@Проприоцептивная чувствительность"> 
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_propchucst_out_text" value="">
					</li>
					<li>
						<b>Дискриминационная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_discrchuvst_out[]" value="{{e_diag_discrchuvst_out}}" from="firstZavView@Дискриминационная чувствительность">
							<option>стереогноз</option>
							<option>чувство локализации</option>
							<option>феномен угасания</option>
							<option>графестезия</option>
							<option>дискриминационная чувствительность</option>
							<option>другие виды</option>
							<option>нарушена</option>
							<option>нарушен</option>
							<option>не нарушена</option>
							<option>не нарушен</option>
							<option>не исследовалась</option>
						</select>
						<input name="e_diag_discrchuvst_out_text" value="">
					</li>
					<li><b>Рефлекторная сфера: 
					</b> <textarea class="medium" name="e_diag_reflsph_out" from="firstZavView@Рефлекторная сфера">{{e_diag_reflsph_out}}</textarea></li>
					<li>
						<b>Поверхностные кожные рефлексы:</b>
						<select multiple="multiple"  name="e_diag_porverhkozref_out[]" value="{{e_diag_porverhkozref_out}}" from="firstZavView@Поверхностные кожные рефлексы">
							<option>брюшные Th10-Th11-Th12 (верхний, средний, нижний),</option>
							<option>отсутствуют</option>
							<option>вызывается</option>
							<option>D</option>
							<option>S</option>
							<option>=</option>
							<option>&lt;</option>
							<option>&gt;</option>
							<option>кремастерный L1-L2</option>
							<option>анальный S1-S2</option>
							<option>подошвенный L5-S1</option>
							<option>средней живости</option>
							<option>живые</option>
							<option>оживлены</option>
							<option>снижены</option>
							<option>низкие</option>
						</select>
					<input name="e_diag_porverhkozref_out_text" value="">
					</li>
					<li>
						<b>Сухожильные и периостальные рефлексы:</b>
						<select multiple="multiple"  name="e_diag_syhozhilirepref_out[]" value="{{e_diag_syhozhilirepref_out}}" from="firstZavView@Сухожильные и периостальные рефлексы">
							<option>рефлекс</option>
							<option>мандибулярный</option>
							<option>костно-абдоминальный</option>
							<option>Майера</option>
							<option>Лери</option>
							<option>с рук</option>
							<option>с ног</option>
							<option>средней живости</option>
							<option>живые</option>
							<option>оживлены</option>
							<option>снижены</option>
							<option>с сухожилия 2-хглавой мышцы плеча С5-С6</option>
							<option>отсутствуют</option>
							<option>вызывается</option>
							<option>D</option>
							<option>S</option>
							<option>=</option>
							<option>&lt;</option>
							<option>&gt;</option>
							<option>с сухожилия 3-хглавой мышцы плеча С6-С7</option>
							<option>лучезапястный С5-С6</option>
							<option>коленный L2-L3-L4</option>
							<option>ахиллов S1</option>
							<option>пястно-лучевой</option>
							<option>лопаточно-плечевой</option>
							<option>надбровный</option>
							<option>низкие</option>
						</select>
						<input name="e_diag_syhozhilirepref_out_text" value="">
					</li>
					<li>
						<b>Клонусы:</b>
						<select multiple="multiple"  name="e_diag_klonusi_out[]" value="{{e_diag_klonusi_out}}" from="firstZavView@Клонусы">
							<option>стопы</option>
							<option>коленной чашечки</option>
							<option>кисти</option>
							<option>есть</option>
							<option>нет</option>
							<option>длительность</option>
							<option>надколенника</option>
						</select>
						<input name="e_diag_klonusi_out_text" value="">
					</li>
					<li>
						<b>Тремор:</b>
						<select multiple="multiple"  name="e_diag_tremor_out[]" value="{{e_diag_tremor_out}}" from="firstZavView@Тремор">
							<option>есть</option>
							<option>нет</option>
							<option>в руках</option>
							<option>в ногах</option>
							<option>губ</option>
							<option>подбородка</option>
							<option>головы</option>
							<option>туловища</option>
							<option>асимметричный</option>
							<option>симметричный</option>
							<option>порхающий</option>
							<option>тремор покоя</option>
							<option>интенционный</option>
							<option>постуральный</option>
							<option>по типу "счета монет"</option>
							<option>справа</option>
							<option>слева</option>
							<option>с двух сторон</option>
						</select>
						<input name="e_diag_tremor_out_text" value="">
					</li>
					<li>
						<b>Патологические кистевые знаки:</b>
						<select multiple="multiple"  name="e_diag_patologkistznak_out[]" value="{{e_diag_patologkistznak_out}}" from="firstZavView@Патологические кистевые знаки">
							<option>справа</option>
							<option>слева</option>
							<option>с двух сторон</option>
							<option>отсутствуют</option>
							<option>Якобсона-Ляска</option>
							<option>Жуковского</option>
							<option>Бехтерева</option>
							<option>Россолимо</option>
						</select>
						<input name="e_diag_patologkistznak_out_text" value="">
					</li>
					<li>
						<b>Патологические стопные знаки:</b>
						<select multiple="multiple"  name="e_diag_patologstopznak_out[]" value="{{e_diag_patologstopznak_out}}" from="firstZavView@Патологические стопные знаки">
							<option>Бабинского</option>
							<option>Бехтерева-Менделя I</option>
							<option>Бехтерева II</option>
							<option>Жуковского-Корнилова</option>
							<option>Пуссепа</option>
							<option>Оппенгейма</option>
							<option>Россолимо</option>
							<option>справа</option>
							<option>слева</option>
							<option>отсутствуют</option>
							<option>с двух сторон</option>
							<option>Гордона</option>
							<option>Шеффера</option>
						</select>
						<input name="e_diag_patologstopznak_out_text" value="">
					</li>
					<li>
						<b>Вертебральный статус:</b>
						<select multiple="multiple"  name="e_diag_vertstat_out[]" value="{{e_diag_vertstat_out}}" from="firstZavView@Вертебральный статус">
							<option>паравертебральные точки при пальпации</option>
							<option>в проекции всех отделов позвоночника</option>
							<option>точки Вале</option>
							<option>мышечный дефанс</option>
							<option>перкуссия остистых отростков</option>
							<option>натяжение прямых мыщц поясницы</option>
							<option>нагрузка по оси позвоночника</option>
							<option>болезненна</option>
							<option>безболезненна</option>
							<option>поясничный лордоз</option>
							<option>шейный лордоз</option>
							<option>болезненны</option>
							<option>грудной кифоз</option>
							<option>сглажен</option>
							<option>сохранен</option>
							<option>усилен</option>
							<option>сколиоз</option>
							<option>ограничения движений корпусом</option>
							<option>вперед</option>
							<option>назад</option>
							<option>вправо</option>
							<option>влево</option>
							<option>умеренно</option>
							<option>слабо</option>
							<option>безболезненны</option>
							<option>в проекции</option>
							<option>шейного отдела позвоночника</option>
							<option>грудного отдела позвоночника</option>
							<option>пояснично-крестцового отдела позвоночника</option>
						</select>
						<input name="e_diag_vertstat_out_text" value="">
					</li>
					<li>
						<b>Симптомы натяжения:</b>
						<select multiple="multiple"  name="e_diag_simptomnatyz_out[]" value="{{e_diag_simptomnatyz_out}}" from="firstZavView@Симптомы натяжения">
							<option>Ласега</option>
							<option>есть</option>
							<option>Мацкевича</option>
							<option>Вассермана</option>
							<option>справа</option>
							<option>слева</option>
							<option>с двух сторон</option>
							<option>отсутствуют</option>
							<option>градусов</option>
							<option>нет</option>
						</select>
						<input name="e_diag_simptomnatyz_out_text" value="">
					</li>
					<li>
						<b>Симптомы орального автоматизма:</b>
						<select multiple="multiple"  name="e_diag_symptomoralavt_out[]" value="{{e_diag_symptomoralavt_out}}" from="firstZavView@Симптомы орального автоматизма">
							<option>хоботковый</option>
							<option>назо-лабиальный</option>
							<option>сосательный</option>
							<option>ладонно-подбородочный Маринеску-Радовичи</option>
							<option>дистанс-оральный Карчикяна</option>
							<option>есть</option>
							<option>нет</option>
						</select>
						<input name="e_diag_symptomoralavt_out_text" value="">
					</li>
					<li>
						<b>Симптомы повышенной нервно-мышечной возбудимости:</b>
						<select multiple="multiple"  name="e_diag_spnmv_out[]" value="{{e_diag_spnmv_out}}" from="firstZavView@Симптомы повышенной нервно-мышечной возбудимости">
							<option>есть</option>
							<option>нет</option>
							<option>Труссо</option>
							<option>Хвостека</option>
						</select>
						<input name="e_diag_spnmv_out_text" value="">
					</li>
					<li>
						<b>Письмо и чтение:</b>
						<select multiple="multiple"  name="e_diag_pismoichten_out[]" value="{{e_diag_pismoichten_out}}" from="firstZavView@Письмо и чтение">
							<option>нарушено</option>
							<option>не нарушено</option>
							<option>ценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_pismoichten_out_text" value="">
					</li>
					<li>
						<b>Апраксия:</b>
						<select multiple="multiple"  name="e_diag_apraksia_out[]" value="{{e_diag_apraksia_out}}" from="firstZavView@Апраксия">
							<option>есть</option>
							<option>нет</option>
							<option>оценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_apraksia_out_text" value="">
					</li>
					<li>
						<b>Агнозия:</b>
						<select multiple="multiple"  name="e_diag_agnosia_out[]" value="{{e_diag_agnosia_out}}" from="firstZavView@Агнозия">
							<option>есть</option>
							<option>нет</option>
							<option>оценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_agnosia_out_text" value="">
					</li>
					<li>
						<b>Вегетативная нервная система:</b>
						<select multiple="multiple"  name="e_diag_vegnervnsys_out[]" value="{{e_diag_vegnervnsys_out}}" from="firstZavView@Вегетативная нервная система">
							<option>симптом Горнера</option>
							<option>потоотделение</option>
							<option>отсутствуют</option>
							<option>сохранено</option>
							<option>гипергидроз ладоней и стоп</option>
							<option>красный</option>
							<option>белый</option>
							<option>дермографизм</option>
							<option>трофические изменения кожи</option>
							<option>оволосение</option>
							<option>ортостатические пробы</option>
							<option>симпаталгии положительны</option>
							<option>симпаталгии отрицательны</option>
							<option>справа</option>
							<option>слева</option>
						</select>
						<input name="e_diag_vegnervnsys_out_text" value="">
					</li>

<!-- 					<li>
						<b><h3>Status vascularis:</h3></b>
						<textarea name="e_diag_statusvasc_out" from="firstZavView@Status vascularis">{{e_diag_statusvasc_out}}</textarea>
					</li>
					<li>
						<b><h3>Status localis:</h3></b>
						<textarea name="e_diag_statuslocalis_out" from="firstZavView@Status localis">{{e_diag_statuslocalis_out}}</textarea>
					</li> -->
				</ul>
					<li class="status_vascularis_out"><b><h3>Status vascularis при переводе:</h3></b>
						<span style="display:none;" name="status_vascularis_out" from='firstZavView@status_vascularis_out'></span>
						<table class="status">
						<tr><th colspan="2">Пульс справа</th><th colspan="2">Пульс слева</th></tr>
						<tr><td>Сонные:</td><td><input name="e_sv_sonsprav_out" from="firstZavView@сонные справа"></input></td><td>Сонные:</td><td><input name="e_sv_sonslev_out" from="firstZavView@сонные слева"></input></td></tr>
						<tr><td>Аскилярная:</td><td><input name="e_sv_aksilarspar_out" from="firstZavView@аксиллярная справа"></input></td><td>Аскилярная:</td><td><input name="e_sv_aksilslev_out" from="firstZavView@аксиллярная слева"></input></td></tr>
						<tr><td>Плечевая на плече:</td><td><input name="e_sv_plecnaplecspar_out" from="firstZavView@плечевая на плече справа"></input></td><td>Плечевая на плече:</td><td><input name="e_sv_plechnaplechslev_n" from="firstZavView@плечевая на плече слева"></input></td></tr>
						<tr><td>Локтевая:</td><td><input name="e_sv_loktspav_out" from="firstZavView@локтевая справа"></input></td><td>Локтевая:</td><td><input name="e_sv_loktslev_out" from="firstZavView@локтевая слева"></input></td></tr>
						<tr><td>Лучевая:</td><td><input name="e_sv_luchspav_out" from="firstZavView@лучевая справа"></input></td><td>Лучевая:</td><td><input name="e_sv_luchslev_out" from="firstZavView@лучевая слева"></input></td></tr>
						<tr><td colspan="4">Брюшная АОРТА: <input name="e_sv_brushaorta_out" from="firstZavView@Брюшная АОРТА"></input></td></tr>
						<tr><th colspan="4">Артерии нижних конечностей</th></tr>
						<tr><td>Над пупартовой связкой:</td><td><input name="e_sv_nadpupartsvyazspav_out" from="firstZavView@Над пупартовой связкой справа"></input></td><td>Над пупартовой связкой:</td><td><input name="e_sv_nadpupartsvyazslev_out" from="firstZavView@Над пупартовой связкой слева"></input></td></tr>
						<tr><td>Под пупартовой связкой:</td><td><input name="e_sv_podpupartsvyazspav_out" from="firstZavView@Под пупартовой связкой справа"></input></td><td>Под пупартовой связкой:</td><td><input name="e_sv_podpupartsvyazslev_out" from="firstZavView@Под пупартовой связкой слева"></input></td></tr>
						<tr><td>ПоА:</td><td><input name="e_sv_poasprav_out" from="firstZavView@ПоА справа"></input></td><td>ПоА:</td><td><input name="e_sv_poaslev_out" from="firstZavView@ПоА слева"></input></td></tr>
						<tr><td>ПББА:</td><td><input name="e_sv_pbbasprav_out" from="firstZavView@ПББА справа"></input></td><td>ПББА:</td><td><input name="e_sv_pbbaslev_out" from="firstZavView@ПББА слева"></input></td></tr>
						<tr><td>ЗББА:</td><td><input name="e_sv_zbbaspav_out" from="firstZavView@ЗББА справа"></input></td><td>ЗББА:</td><td><input name="e_sv_zbbaslev_out" from="firstZavView@ЗББА слева"></input></td></tr>
						<tr><td>Положительные симптомы:</td><td><input name="e_sv_polozhsimpspav_out" from="firstZavView@Положительные симптомы справа"></input></td><td>Положительные симптомы:</td><td><input name="e_sv_polozhsimpslev_out" from="firstZavView@Положительные симптомы слева"></input></td></tr>
						</table>
					</li>
					<li class="status_localis_out"><b><h3>Status localis при переводе:</h3></b>
						<span style="display:none;" name="status_localis_out" from='firstZavView@status_localis_out'></span>
						<table class="status">
						<tr><th colspan="2">Справа</th><th colspan="2">Слева</th></tr>
						<tr><td>Цвет:</td><td><input name="e_si_cvetspav_out" from="firstZavView@цвет справа"></input></td><td>Цвет:</td><td><input name="e_si_cvetsleva_out" from="firstZavView@Цвет слева"></input></td></tr>
						<tr><td>Температура:</td><td><input name="e_si_tempsprav_out" from="firstZavView@температура справа"></input></td><td>Температура:</td><td><input name="e_si_tempslev_out" from="firstZavView@температура слева"></input></td></tr>
						<tr><td>Чувствительность:</td><td><input name="e_si_chuvstsprav_out" from="firstZavView@чувствительность справа"></input></td><td>Чувствительность:</td><td><input name="e_si_chuvstslev_out" from="firstZavView@чувствительность слева"></input></td></tr>
						<tr><td>Движения:</td><td><input name="e_si_dvizspav_out" from="firstZavView@движения справа"></input></td><td>Движения:</td><td><input name="e_si_dvizslev_out" from="firstZavView@движения слева"></input></td></tr>
						<tr><td>Субфасциальный отек:</td><td><input name="e_si_subfcalnoteksprav_out" from="firstZavView@субфасциальный отек справа"></input></td><td>Субфасциальный отек:</td><td><input name="e_si_subfcalnotekslev_out" from="firstZavView@субфасциальный отек слева"></input></td></tr>
						<tr><td>Контрактура:</td><td><input name="e_si_contracturasprav_out" from="firstZavView@контрактура справа"></input></td><td>Контрактура:</td><td><input name="e_si_contracturaslev_out" from="firstView@контрактура слева"></input></td></tr>
						<tr><td>Трофические нарушения:</td><td><input name="e_si_trofnarsrav_out" from="firstZavView@трофические нарушения справа"></input></td><td>Трофические нарушения:</td><td><input name="e_si_trofnarslev_out" from="firstZavView@трофические нарушения слева"></input></td></tr>
						<tr><td>Отек:</td><td><input name="e_si_oteksprav_out" from="firstZavView@отек справа"></input></td><td>Отек:</td><td><input name="e_si_otekslev_out" from="firstZavView@отек слева"></input></td></tr>
						<tr><td>Подкожные вены:</td><td><input name="e_si_podkozhvensrav_out" from="firstZavView@подкожные вены справа"></input></td><td>Подкожные вены:</td><td><input name="e_si_podkozhvenslev_out" from="firstZavView@подкожные вены слева"></input></td></tr>
						</table>
					</li>
			</li>
		</ul>
</ul>
<h2>Течение заболевания</h2>
<ul>
	<textarea class="medium" name="e_techenie_zabolevania" >{{e_techenie_zabolevania}}</textarea>
</ul>
<h2>Результаты диагностических исследований</h2>
<ul class='container'>

	<li><b><h3>Результаты инструментальных методов исследований </h3></b>
	<ul>
		<div data-role="foreach" from="res">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p>
			</li>
		</div>
	</ul><textarea name="e_researchText">{{e_researchText}}</textarea></li>

	<li><b><h3>Результаты клинико-лабораторных методов исследований</h3></b>
	<ul class='lab-test'>
		<div data-role="foreach" from="lab">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p>
			</li>
		</div>
	</ul>
	<textarea name="e_anayseText">{{e_anayseText}}</textarea></li>
	
	<li class='bottomtop-bord'>
		<p><b>RW:</b><textarea name="e_RW">{{e_RW}}</textarea></p>
		<p><b>Рентгенография органов грудной клетки:</b><textarea name="e_rendgetnographia_organov_grudnoy_kletki">{{e_rendgetnographia_organov_grudnoy_kletki}}</textarea></p>
	</li>
	<li><b><h3>Консультации специалистов </h3></b>
	<ul>
		<div data-role="foreach" from="cons">
			<li>{{cons}}</li>
		</div>
	</ul>
	<textarea name="e_consultText">{{e_consultText}}</textarea></li>
</ul>
<h2><b>Труп направляется на секцию с заключительным диагнозом </b></h2>
<ul class="block">
	<li><b class="bottom-bord">Основное заболевание:</b><textarea name="e_diag_main_in" from="firstZavView@Основное заболевание">{{e_diag_main_in}}</textarea></li>
	<li><b class="bottom-bord">Фоновые заболевания:</b><textarea name="e_diag_fon_in" from="firstZavView@Фоновые заболевания">{{e_diag_fon_in}}</textarea></li>
	<li><b class="bottom-bord">Осложнения основного заболевания:</b><textarea name="e_diag_comp_in" from="firstZavView@Осложнения основного заболевания:">{{e_diag_comp_in}}</textarea></li>
	<li><b class="bottom-bord">Сопутствующие заболевания:</b><textarea name="e_diag_satt_in" from="firstZavView@Сопутствующие заболевания:">{{e_diag_satt_in}}</textarea></li>
</ul>
<br>
<br>
<span class="docDate">{{docDate}}</span><br /><br />
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
