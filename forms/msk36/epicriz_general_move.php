<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Переводной эпикриз</h2></div>
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
{{OrgAddr}}                                                  </b>
<br />
<h2 style="font-size:14pt;">ПЕРЕВОДНОЙ ЭПИКРИЗ <div style="font-size:10px;">от <input style="width: 160px;font-size: 10pt;" class="small" type="text" name="s_date2" value="{{s_date2}}"> </div></h2>
</p>

<ul class="fields">
		<li><b>Фамилия, Имя, Отчество:</b> {{client}}, <b>возраст</b> {{age}} лет    И/Б {{externalId}}</li>
		<li> <b>Адрес</b>: <input type="text" class="medium" name="e_client_adress" value="{{e_client_adress}}"> </li>
		<li class="">
		<ul>
		<li> <b>Находился(-лась) на стационарном лечении</b> с {{s_date1}} 	по <input type="text" class="medium" name="endDate" value="{{s_date2}}">.  {{dateDiff}} </li>
		<li> <b>Наименование отделения:</b> {{orgStr}}
		<li><b><h2 name="diag_pri_postup" class="section">Диагноз при поступлении</h2></b>
			<ul class="block">
				<li><b class="bottom-bord">Основное заболевание:</b><textarea name="e_diag_main_in" from="firstView@Основное заболевание">{{e_diag_main_in}}</textarea></li>
				<li><b class="bottom-bord">Фоновые заболевания:</b><textarea name="e_diag_fon_in" from="firstView@Фоновые заболевания">{{e_diag_fon_in}}</textarea></li>
				<li><b class="bottom-bord">Осложнения основного заболевания:</b><textarea name="e_diag_comp_in" from="firstView@Осложнения основного заболевания:">{{e_diag_comp_in}}</textarea></li>
				<li><b class="bottom-bord">Сопутствующие заболевания:</b><textarea name="e_diag_satt_in" from="firstView@Сопутствующие заболевания:">{{e_diag_satt_in}}</textarea></li>
			</ul>
		</li>

		<li><p style="text-align:center;"><b>Код стандарта:</b> <input name="e_code1" from="firstView@Код стандарта" class="small"> <b>Шифр по МКБ-10:</b> <input name="e_code2" from="firstView@Шифр по МКБ-10" class="small"></p></li>
		<h2 name="sost_pri_post" class="section">Состояние при поступлении</h2>
		<ul>
			<li><b>Жалобы при поступлении:</b><textarea name="e_complaint1" from="firstView@Жалобы">{{e_complaint1}}</textarea> </li>
			<li><b>An.morbi:</b><br/><textarea name="e_anamnez1" from="firstView@Anamnesis morbi">{{e_anamnez1}}</textarea> </li>
			<li><b>An.vitae:</b><br/><textarea name="e_an_vitae" from="firstView@Anamnesis vitae">{{e_an_vitae}}</textarea> </li>
			<li><b>Аллергологический анамнез:</b><br/><textarea name="e_al_anamnez" from="firstView@Аллергологический анамнез">{{e_al_anamnez}}</textarea> </li>
			<li>
				<h3><b>Status Praesesns:</b></h3> 
				<ul class="nob">
					<li>
						<b>Общее состояние</b> 
						<select multiple="multiple" name="e_diag_sost_in[]" value="{{e_diag_sost_in}}" from="firstView@Status Praesesns: Общее состояние">
							<option>Удовлетворительное</option>
							<option>Средней тяжести</option>
							<option>Тяжелое</option>
							<option>Крайне тяжелое</option>
						</select>
						<input name="e_diag_sost_in_text">
					</li>
					<li><b>Сознание</b> <textarea class="medium" name="e_diag_mind_in" from="firstView@Сознание">{{e_diag_mind_in}}</textarea></li>
					<li><b>Кожные покровы и видимые слизистые:</b> <textarea class="medium" name="e_diag_skin_in" from="firstView@Кожные покровы">{{e_diag_skin_in}}</textarea></li>
					<li><b>Отёки:</b>
						<textarea class="medium" name="e_diag_edema_in" from="firstView@Отеки">{{e_diag_edema_in}}</textarea>
					</li>
				</ul>
			</li> 
			<li>
				<b><h3 name="org_dyh_out" class="section subsection">Органы дыхания</h3></b>
				<ul class="container nob">
					<li><b>ЧДД:</b> <textarea class="medium" name="e_chdd" from="firstView@ЧДД">{{e_chdd}}</textarea></li>
					<li>
						<b>Форма грудной клетки</b>
						<select multiple="multiple" name='e_diag_formgrkl_in[]' from="firstView@Форма грудной клетки" value="{{e_diag_formgrkl_in}}">
							<option>астеническая</option>
							<option>коническая</option>
							<option>гиперстеническая</option>
							<option>рахитная</option>
							<option>кифоз</option>
							<option>лордоз</option>
							<option>сколиоз</option>
							<option>симметрична</option>
							<option>асимметрична</option>
						</select>
						<input name="e_diag_formgrkl_in_text" value="">
					</li>
					<li>
						<b>Участвует в акте дыхания</b>
						<select multiple="multiple" name='e_diag_uchakdh_in[]' value='{{e_diag_uchakdh_in}}' from="firstView@Участвует в акте дыхания">
							<option>равномерно</option>
							<option>нет</option>
						</select>
						<input name="e_diag_uchakdh_in_text" value="">
					</li>
					<li>
						<b>Дыхание</b>
						<select multiple="multiple" name='e_diag_dihan_in[]' value='{{e_diag_dihan_in}}' from="firstView@Дыхание" >
							<option>везикулярное</option>
							<option>жесткое</option>
							<option>бронхиальное</option>
							<option>проводится во все отделы легких</option>
							<option>ослабленоe в нижних отделах справа</option>
							<option>ослаблено в нижних отделах слева</option>
							<option>ослаблено в нижних отделах с обеих сторон</option>
							<option>ослаблено в верхних отделах</option>
						</select>
						<input name="e_diag_dihan_in_text" value="">
					</li>
					<li>
						<b>Хрипы:</b>
						<select multiple="multiple" name='e_diag_hrip_in[]'  value='{{e_diag_hrip_in}}' from="firstView@Хрипы">
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
						<input name="e_diag_hrip_in_text" value="">
					</li>

				</ul>
			</li>

			<li>
				<b><h3 name="org_krov_out" class="section subsection">Органы кровообращения</h3></b>
				<ul class="container nob">
					
				<li>
					<b>Область сердца</b>
					<select multiple="multiple" name='e_diag_oblserd_in[]' value='{{e_diag_oblserd_in}}' from="firstView@Область сердца">
						<option>не изменена</option>
						<option>расширена</option>
					</select>
					<input name="e_diag_oblserd_in_text" value="">
				</li>
				<li>
					<b>Границы сердца:</b>
					<select multiple="multiple" name='e_diag_granserd_in[]'  from="firstView@Границы сердца">
						<option>не расширены</option>
						<option>расширены</option>
						<option>относительно тупости сердца расширены</option>
						<option>правая + см.</option>
						<option>левая + см.</option>
						<option>абсолютной тупости сердца</option>
						<option>верх</option>
						<option>верхняя</option>
					</select>
					<input name="e_diag_granserd_in_text" value="">
				</li>
				<li>
					<b>Тоны сердца</b>
					<select multiple="multiple" name='e_diag_tonserd_in[]' value='{{e_diag_tonserd_in}}'  from="firstView@Тоны" >
						<option>ясные</option>
						<option>приглушенные</option>
						<option>глухие</option>
						<option>ритмичные</option>
						<option>аритмичные</option>
						<option>акцент II тона</option>
						<option>на аорте</option>
						<option>на легочной артерии</option>
					</select>
					<input name="e_diag_tonserd_in_text" value="">
				</li>
				<li>
					<b>Шумы:</b>
					<select multiple="multiple" name='e_diag_shumi_in[]' value='{{e_diag_shumi_in}}' from="firstView@Шумы">
						<option>есть</option>
						<option>нет</option>
					</select>
					<input name="e_diag_shumi_in_text" value="">
				</li>
				<li>
					<b>Пульсация на периферических артериях:</b>
					<select multiple="multiple" name='e_diag_pulsnaperar_in[]' value='{{e_diag_pulsnaperar_in}}' from="firstView@Пульсация на периферических артериях">
						<option>есть</option>
						<option>нет</option>
					</select>
					<input name="e_diag_pulsnaperar_in_text" value="">
				</li>
				<li><b>ЧСС:</b> <textarea class="medium" name="e_diag_chss_in" from="firstView@ЧСС">{{e_diag_chss_in}}</textarea></li>
				<li><b>Пульс:
				</b> <textarea class="medium" name="e_diag_ps_in" from="firstView@PS">{{e_diag_ps_in}}</textarea> в минуту</li>
				<li><b>АД систолическое
				</b> <textarea class="medium" name="e_diag_adsist_in" from="firstView@АД систолическое">{{e_diag_adsist_in}}</textarea> мм. рт.ст.</li>
				<li><b>АД диастолическое
				</b> <textarea class="medium" name="e_diag_addist_in" from="firstView@АД диастолическое">{{e_diag_addist_in}}</textarea> мм. рт.ст.</li>			

				</ul>

			</li>
			<li>
				<b><h3 name="org_pish_out" class="section subsection">Органы пищеварения</h3></b>
				<ul class="container nob">
					<li>
						<b>Живот</b>
						<select multiple="multiple" name='e_diag_belly_in[]' value='{{e_diag_belly_in}}' from="lastView@Живот">
							<option>мягкий</option>
							<option>безболезненный</option>
							<option>обычной формы</option>
							<option>симметричный</option>
							<option>вздут</option>
							<option>увеличен в объеме за счет подкожно-жировой клетчатки</option>
							<option>увеличен в объеме за счет асцита</option>
							<option>участвует в акте дыхания</option>
						</select>
						<input name="e_diag_belly_in_text" value="">
					</li>
					<li>
						<b>Язык</b>
						<select multiple="multiple" name='e_diag_yazikpish_in[]' value='{{e_diag_yazikpish_in}}' from="firstView@Язык">
							<option>чистый</option>
							<option>обложен налетом</option>
							<option>сухой</option>
							<option>влажный</option>
						</select>
						<input name="e_diag_yazikpish_in_text" value="">
					</li>
					<li>
						<b>Печень:</b>
						<select multiple="multiple" name='e_diag_liver_in[]' value='{{e_diag_liver_in}}' from="lastView@Печень">
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
						<input name="e_diag_liver_in_text" value="">
					</li>

				</ul>
			</li>

			<li>
				<b><h3 name="org_moch_out" class="section subsection">Органы мочевыделения</h3></b>
				<ul class="container nob">
					<li>
						<b>Область почек</b>
						<select multiple="multiple" name='e_diag_obl_pochk_in[]' value='{{e_diag_obl_pochk_in}}' from="firstView@Область почек">
							<option>изменена</option>
							<option>не изменена</option>
						</select>
						<input name="e_diag_obl_pochk_in_text" value="">
					</li>
					<li>
						<b>Симптом поколачивания по поясничной области:</b>
						<select multiple="multiple" name='e_diag_simp_pok_poys_obl_in[]' value='{{e_diag_simp_pok_poys_obl_in}}' from="firstView@ОСимптом поколачивания по поясничной области">
							<option>отрицательный с обеих сторон</option>
							<option>положительный справа</option>
							<option>положительный слева</option>
						</select>
						<input name="e_diag_simp_pok_poys_obl_in_text" value="">
					</li>
					<li>
						<b>Мочеиспускание:</b>
						<select multiple="multiple" name='e_diag_mocheisp_in[]' value='{{e_diag_mocheisp_in}}' from="firstView@Мочеиспускание">
							<option>дизурии нет</option>
							<option>затруднено</option>
							<option>учащенное</option>
							<option>анурия</option>
							<option>никтурия</option>
						</select>
						<input name="e_diag_mocheisp_in" value="">
					</li>
				</ul>

			</li>
			<li>
				<span><b><h3 name="nevr_in"class="section subsection" style=" display: inline;">Неврологический и психический статус</h3> <button name="nevr-toggle-in">Скрыть</button></b></span>
				<ul class="container nob" name='nevr-status-in'>
					<li>
						<b>Уровень сознания:</b>
						<select multiple="multiple" name="e_diag_soznur_in[]" :value="{{e_diag_soznur_in}}" multiple="multiple" from="firstView@Уровень сознания">
							<option>в сознании -15б</option>
							<option>заторможенность</option>
							<option>оглушенность 13-14 б</option>
							<option>сопор 9-12 б</option>
							<option>кома 4-8б</option>
							<option>спутанность</option>
							<option>мед.седация</option>
						</select>
					<input name="e_diag_soznur_in_text" value="">
					</li>
					<li><b>ШКГ: 
					</b> <textarea class="medium" name="e_diag_shkg_in" from="firstView@ШКГ">{{e_diag_shkg_in}}</textarea></li>
					<li><b>NIHSS: 
					</b> <textarea class="medium" name="e_diag_nihss_in" from="firstView@NIHSS">{{e_diag_nihss_in}}</textarea></li>
					<li><b>Ривермид: 
					</b> <textarea class="medium" name="e_diag_rivermid_in" from="firstView@Ривермид">{{e_diag_rivermid_in}}</textarea></li>
					<li><b>Ранкин: 
					</b> <textarea class="medium" name="e_diag_rankin_in" from="firstView@Ранкин">{{e_diag_rankin_in}}</textarea></li>
					<li>
						<b>Речевому контакту:</b>
						<select multiple="multiple" name="e_diag_rechkont_in[]" value="{{e_diag_simpokpopoobl_in}}" from="firstView@Речевому контакту">
							<option>доступен</option>
							<option>недоступен из-за речевых нарушений</option>
							<option>контакту недоступен по тяжести состояния</option>
						</select>
					<input name="e_diag_rechkont_in_text" value="">
					</li>
					<li>
						<b>Простые инструкции:</b>
						<select multiple="multiple" name="e_diag_prostinsrt_in[]" value="{{e_diag_prostinsrt}}" from="firstView@Простые инструкции">
							<option>выполняет</option>
							<option>выполняет частично</option>
							<option>не выполняет</option>
						</select>
					<input name="e_diag_prostinsrt_in_text" value="">
					</li>
					<li>
						<b>Речь:</b>
						<select multiple="multiple" name="e_diag_rech_in[]" value="{{e_diag_rech_in}}" from="firstView@Речь">
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
						<input name="e_diag_rech_in_text" value="">
					</li>
					<li>
						<b>Реакция на осмотр:</b>
						<select multiple="multiple" name="e_diag_reaktnaosm_in[]" value="{{e_diag_reaktnaosm_in}}" from="firstView@Реакция на осмотр">
							<option>сохранена</option>
							<option>адекватная</option>
							<option>вялая</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_reaktnaosm_in_text" value="">
					</li>
					<li>
						<b>Изменения психики:</b>
						<select multiple="multiple" name="e_diag_izmpsyh_in[]" value="{{e_diag_izmpsyh_in}}" from="firstView@Изменения психики">
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
						<input name="e_diag_izmpsyh_in_text" value="">
					</li>
					<li>
						<b>Когнитивные функции:</b>
						<select multiple="multiple" name="e_diag_cognfun_in[]" value="{{e_diag_cognfun_in}}" from="firstView@Когнитивные функции">
							<option>сохранены</option>
							<option>снижены</option>
							<option>оценить не представляется возможным</option>
						</select>
						<input name="e_diag_cognfun_in_text" value="">
					</li>
					<li>
						<b>Менингеальный синдром:</b>
						<select multiple="multiple" name="e_diag_miningalsynd_in[]" value="{{e_diag_miningalsynd_in}}" from="firstView@Менингеальный синдром">
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
						<input name="e_diag_miningalsynd_in_text" value="">
					</li>
					<li>
						<b>Общемозговые симптомы:</b>
						<select multiple="multiple" name="e_diag_obshemozg_in[]" value="{{e_diag_obshemozg_in}}" from="firstView@Общемозговые симптомы">
							<option>тошнота</option>
							<option>рвота</option>
							<option>головная боль</option>
							<option>головокружение системное</option>
							<option>головокружение несистемное</option>
							<option>головокружение позиционное</option>
							<option>есть</option>
							<option>нет</option>
						</select>
						<input name="e_diag_obshemozg_in_text" value="">
					</li>
					<li><b>Черепно-мозговые нервы: 
					</b> <textarea class="medium" name="e_diag_chemone_in" from="firstView@Черепно-мозговые нервы">{{e_diag_chemone_in}}</textarea></li>
					<li>
						<b>Обоняние:</b>
						<select multiple="multiple" name="e_diag_obon_in[]" value="{{e_diag_obon_in}}" from="firstView@Обоняние">
							<option>не нарушено</option>
							<option>аномсия</option>
							<option>гипосмия</option>
							<option>гиперосмия</option>
							<option>не исследовалось</option>
						</select>
						<input name="e_diag_obon_in_text" value="">
					</li>
					<li>
						<b>Острота зрения:</b>
						<select multiple="multiple" name="e_diag_ostrzren_in[]" value="{{e_diag_ostrzren_in}}" from="firstView@Острота зрения">
							<option>не нарушена</option>
							<option>нарушена</option>
							<option>не исследована</option>
							<option>снижена</option>
						</select>
						<input name="e_diag_ostrzren_in_text" value="">
					</li>
					<li>
						<b>Поля зрения:</b>
						<select multiple="multiple" name="e_diag_polezren_in[]" value="{{e_diag_ostrzren_in}}" from="firstView@Поля зрения">
							<option>выпадения контрольным путем не выявлено</option>
							<option>выпадения контрольным путем выявлено</option>
							<option>проверить невозможно</option>
						</select>
						<input name="e_diag_polezren_in_text" value="">
					</li>
					<li>
						<b>Гемианопсия:</b>
						<select multiple="multiple" name="e_diag_gepoksia_in[]" value="{{e_diag_gepoksia_in}}" from="firstView@Гемианопсия">
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
						<input name="e_diag_gepoksia_in_text" value="">
					</li>
					<li><b>Цветоощущение:
					</b> <textarea class="medium" name="e_diag_cvetoosh_in" from="firstView@Цветоощущение">{{e_diag_cvetoosh_in}}</textarea></li>
					<li><b>Глазное дно:
					</b> <textarea class="medium" name="e_diag_glazyabl_in" from="firstView@Глазное дно">{{e_diag_glazyabl_in}}</textarea></li>
					<li><b>Зрачки: 
					</b> <textarea class="medium" name="e_diag_zrachki_in" from="firstView@Зрачки">{{e_diag_zrachki_in}}</textarea></li>
					<li>
						<b>Фотореакция:</b>
						<select multiple="multiple" name="e_diag_fotoreact_in[]" value="{{e_diag_fotoreact_in}}" from="firstView@Фотореакция">
							<option>сохранена</option>
							<option>снижена</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_fotoreact_text" value="">
					</li>
					<li>
						<b>Нистагм:</b>
						<select multiple="multiple" name="e_diag_nistagm_in[]" value="{{e_diag_nistagm_in}}" from="firstView@Нистагм">
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
						<input name="e_diag_nistagm_in_text" value="">
					</li>
					<li>
						<b>Глазодвигательные нарушения:</b>
						<select multiple="multiple" name="e_diag_glazovidnar_in[]" value="{{e_diag_glazovidnar_in}}" from="firstView@Глазодвигательные нарушения">
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
						<input name="e_diag_glazovidnar_in_text" value="">
					</li>
					<li>
						<b>Экзофтальм:</b>
						<select multiple="multiple" name="e_diag_ekzoftalm_in[]" value="{{e_diag_ekzoftalm_in}}" from="firstView@Экзофтальм">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_ekzoftalm_in_text" value="">
					</li>
					<li>
						<b>Энофтальм:</b>
						<select multiple="multiple" name="e_diag_enoftalm_in[]" value="{{e_diag_enoftalm_in}}" from="firstView@Энофтальм">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_enoftalm_in_text" value="">
					</li>
					<li>
						<b>Птоз:</b>
						<select multiple="multiple" name="e_diag_ptoz_in[]" value="{{e_diag_ptoz_in}}" from="firstView@Птоз">
							<option>есть</option>
							<option>нет</option>
							<option>справа</option>
							<option>слева</option>
							<option>с 2х сторон</option>
						</select>
						<input name="e_diag_ptoz_in_text" value="">
					</li>
					<li>
						<b>Диплопия:</b>
						<select multiple="multiple" name="e_diag_diplonia_in[]" value="{{e_diag_diplonia_in}}" from="firstView@Диплопия">
							<option>нет</option>
							<option>при взгляде</option>
							<option>вправо</option>
							<option>влево</option>
							<option>вниз</option>
							<option>вверх</option>
							<option>прямо</option>
						</select>
						<input name="e_diag_diplonia_in_text" value="">
					</li>
					<li>
						<b>Движение нижней челюстью, жевательные мышцы:</b>
						<select multiple="multiple" name="e_diag_dvizhnizhnche_in[]" value="{{e_diag_dvizhnizhnche_in}}" from="firstView@Движение нижней челюстью, жевательные мышцы">
							<option>не изменены</option>
							<option>изменены</option>
						</select>
						<input name="e_diag_dvizhnizhnche_in_text" value="">
					</li>
					<li>
						<b>Роговичный, конъюнктивальный рефлекс:</b>
						<select multiple="multiple" name="e_diag_rogovichkon_in[]" value="{{e_diag_rogovichkon_in}}" from="firstView@Роговичный, конъюнктивальный рефлекс">
							<option>живой</option>
							<option>вялый</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_rogovichkon_in_text" value="">
					</li>
					<li>
						<b>Чувствительность на лице:</b>
						<select multiple="multiple" name="e_diag_chuvsctnalic_in[]" value="{{e_diag_chuvsctnalic_in}}" from="firstView@Чувствительность на лице">
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
						<input name="e_diag_chuvsctnalic_in_text" value="">
					</li>
					<li>
						<b>Лицо:</b>
						<select multiple="multiple" name="e_diag_lico_in[]" value="{{e_diag_lico_in}}" from="firstView@Лицо">
							<option>симметрично</option>
							<option>асимметрично</option>
							<option>за счет сглаженности правой носогубной складки</option>
							<option>за счет сглаженности левой носогубной складки</option>
							<option>за счет опущения правого угла рта, за счет опущения левого угла рта</option>
							<option>симптом паруса</option>
						</select>
						<input name="e_diag_lico_in_text" value="">
					</li>
					<li>
						<b>Лагофтальм:</b>
						<select multiple="multiple" name="e_diag_lagoftalm_in[]" value="{{e_diag_lagoftalm_in}}" from="firstView@Лагофтальм">
							<option>есть</option>
							<option>нет</option>
							<option>справа</option>
							<option>слева</option>
						</select>
						<input name="e_diag_lagoftalm_in_text" value="">
					</li>
					<li>
						<b>Мимические пробы:</b>
						<select multiple="multiple" name="e_diag_mimiprob_in[]" value="{{e_diag_mimiprob_in}}" from="firstView@Мимические пробы">
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
						<input name="e_diag_mimiprob_in_text" value="">
					</li>
					<li>
						<b>Гиперакузия:</b>
						<select multiple="multiple" name="e_diag_giperakuz_in[]" value="{{e_diag_giperakuz_in}}" from="firstView@Гиперакузия">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_giperakuz_in_text" value="">
					</li>
					<li>
						<b>Сухость глаз:</b>
						<select multiple="multiple" name="e_diag_suhglaz_in[]" value="{{e_diag_suhglaz_in}}" from="firstView@Сухость глаз">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_suhglaz_in_text" value="">
					</li>
					<li>
						<b>Слюноотделение:</b>
						<select multiple="multiple" name="e_diag_slunotd_in[]" value="{{e_diag_slunotd_in}}" from="firstView@Слюноотделение">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_slunotd_in_text" value="">
					</li>
					<li>
						<b>Слух:</b>
						<select multiple="multiple" name="e_diag_sluh_in[]" value="{{e_diag_sluh_in}}" from="firstView@Слух">
							<option>сохранен</option>
							<option>ориентировочно снижен</option>
							<option>AS</option>
							<option>AD</option>
							<option>AU</option>
						</select>
						<input name="e_diag_sluh_in_text" value="">
					</li>
					<li>
						<b>Парез мягкого неба:</b>
						<select multiple="multiple" name="e_diag_parezmyagneba_in[]" value="{{e_diag_parezmyagneba_in}}" from="firstView@Парез мягкого неба">
							<option>есть</option>
							<option>нет</option>
							<option>слева</option>
							<option>справа</option>
						</select>
						<input name="e_diag_parezmyagneba_in_text" value="">
					</li>
					<li>
						<b>Глоточный рефлекс:</b>
						<select multiple="multiple" name="e_diag_glotreflex_in[]" value="{{e_diag_glotreflex_in}}" from="firstView@Глоточный рефлекс">
							<option>сохранен</option>
							<option>дисфагия</option>
							<option>дисфония</option>
						</select>
						<input name="e_diag_glotreflex_in_text" value="">
					</li>
					<li>
						<b>Вкусовой анализатор:</b>
						<select multiple="multiple" name="e_diag_vkusovoianalizator_in[]" value="{{e_diag_vkusovoianalizator_in}}" from="firstView@Вкусовой анализатор">
							<option>ощущение соленого</option>
							<option>ощущение сладкого</option>
							<option>ощущение кислого</option>
							<option>есть</option>
							<option>нет</option>
						</select>
						<input name="e_diag_vkusovoianalizator_in_text" value="">
					</li>
					<li>
						<b>Положение головы и поднимание плеч:</b>
						<select multiple="multiple" name="e_diag_polozhgolov_in[]" value="{{e_diag_polozhgolov_in}}" from="firstView@Положение головы и поднимание плеч">
							<option>не нарушено</option>
							<option>насильственный поворот влево</option>
							<option>насильственный поворот вправо</option>
						</select>
						<input name="e_diag_polozhgolov_in_text" value="">
					</li>
					<li>
						<b>Язык:</b>
						<select multiple="multiple" name="e_diag_yaziknerv_in[]" value="{{e_diag_yaziknerv_in}}" from="firstView@Язык">
							<option>по средней линии</option>
							<option>девиирует вправо</option>
							<option>девиирует влево</option>
							<option>в полости рта легко</option>
						</select>
						<input name="e_diag_yaziknerv_in_text" value="">
					</li>
					<li>
						<b>Прикус языка:</b>
						<select multiple="multiple" name="e_diag_prikus_in[]" value="{{e_diag_prikus_in}}" from="firstView@Прикус языка">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_prikus_in_text" value="">
					</li>
					<li>
						<b>Фибриллярные подергивания:</b>
						<select multiple="multiple" name="e_diag_fibrpod_in[]" value="{{e_diag_fibrpod_in}}" from="firstView@Фибриллярные подергивания">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_fibrpod_in_text" value="">
					</li>
					<li><b>Двигательная сфера:  
					</b> <textarea class="medium" name="e_diag_dvigsph_in" from="firstView@Двигательная сфера">{{e_diag_dvigsph_in}}</textarea></li>
					<li>
						<b>Положение тела:</b>
						<select multiple="multiple" name="e_diag_poloztela_in[]" value="{{e_diag_poloztela_in}}" from="firstView@Положение тела">
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
						<input name="e_diag_poloztela_in_text" value="">
					</li>
					<li>
						<b>Непроизвольные движения:</b>
						<select multiple="multiple" name="e_diag_neprdviz_in[]" value="{{e_diag_neprdviz_in}}" from="firstView@Непроизвольные движения">
							<option>есть</option>
							<option>нет</option>
							<option>орофасциальная дискинезия</option>
							<option>тики</option>
							<option>хорея</option>
							<option>дистония</option>
							<option>атетоз</option>
						</select>
						<input name="e_diag_neprdviz_in_text" value="">
					</li>
					<li>
						<b>Мышечная масса:</b>
						<select multiple="multiple" name="e_diag_musmass_in[]" value="{{e_diag_musmass_in}}" from="firstView@Мышечная масса">
							<option>норма</option>
							<option>атрофия</option>
							<option>гипертрофия</option>
							<option>гипотрофия</option>
						</select>
						<input name="e_diag_musmass_in_text" value="">
					</li>
					<li>
						<b>Мышечный тонус:</b>
						<select multiple="multiple" name="e_diag_masstonus_in[]" value="{{e_diag_masstonus_in}}" from="firstView@Мышечный тонус">
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
						<input name="e_diag_masstonus_in_text" value="">
					</li>
					<li>
						<b>Мышечная сила:</b>
						<select multiple="multiple" name="e_diag_masssil_in[]" value="{{e_diag_masssil_in}}" from="firstView@Мышечная сила">
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
						<input name="e_diag_masssil_in_text" value="">
					</li>
					<li><b>Координаторная сфера: 
					</b> <textarea class="medium" name="e_diag_coordsph_in" from="firstView@Координаторная сфера">{{e_diag_coordsph_in}}</textarea></li>
					<li>
						<b>Координация движений:</b>
						<select multiple="multiple" name="e_diag_koorddiz_in[]" value="{{e_diag_koorddiz_in}}" from="firstView@Координация движений">
							<option>нарушено</option>
							<option>не нарушено</option>
							<option>нет</option>
							<option>выполнение точных движений</option>
							<option>выполнение альтернирующих движений</option>
						</select>
						<input name="e_diag_koorddiz_in_text" value="">
					</li>
					<li>
						<b>Походка:</b>
						<select multiple="multiple" name="e_diag_pohodka_in[]" value="{{e_diag_koorddiz_in}}" from="firstView@Походка">
							<option>спастическая</option>
							<option>степпаж</option>
							<option>сенсорная атаксия</option>
							<option>мозжечковая атаксия</option>
							<option>паркинсоническая</option>
							<option>не изменена</option>
						</select>
						<input name="e_diag_pohodka_in_text" value="">
					</li>
					<li>
						<b>Застывание в определенных позах:</b>
						<select multiple="multiple" name="e_diag_zast_in[]" value="{{e_diag_zast_in}}"  multiple="multiple" from="firstView@Застывание в определенных позах">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_zast_in_text" value="">
					</li>
					<li>
						<b>Координаторные пробы:</b>
						<select multiple="multiple" name="e_diag_koordprob_in[]" value="{{e_diag_koordprob_in}}" from="firstView@Координаторные пробы">
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
						<input name="e_diag_koordprob_in_text" value="">
					</li>
					<li>
						<b>Статическое равновесие:</b>
						<select multiple="multiple" name="e_diag_statravn_in[]" value="{{e_diag_statravn_in}}" from="firstView@Статическое равновесие">
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
						<input name="e_diag_statravn_in_text" value="">
					</li>
					<li>
						<b>Атаксия:</b>
						<select multiple="multiple" name="e_diag_staksia_in[]" value="{{e_diag_staksia_in}}" from="firstView@Атаксия">
							<option>статическая</option>
							<option>динамическая</option>
							<option>стато-локомоторная</option>
							<option>стато-динамическая</option>
							<option>в Ромберга-пошатывание</option>
							<option>не исследовалась</option>
							<option>не выявлена</option>
						</select>
						<input name="e_diag_staksia_in_text" value="">
					</li>
					<li>
						<b>Нарушения чувствительности:</b>
						<select multiple="multiple" name="e_diag_narushchuvs_in[]" value="{{e_diag_narushchuvs_in}}" from="firstView@Нарушения чувствительности">
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
						<input name="e_diag_narushchuvs_in_text" value="">
					</li>
					<li>
						<b>Болевая чувствительность:</b>
						<select multiple="multiple" name="e_diag_bolchuvst_in[]" value="{{e_diag_bolchuvst_in}}" from="firstView@Болевая чувствительность">
							<option>аналгезия</option>
							<option>гипералгезия</option>
							<option>гипалгезия</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_bolchuvst_in_text" value="">
					</li>
					<li>
						<b>Температурная чувствительность:</b>
						<select multiple="multiple" name="e_diag_tempchuvst_in[]" value="{{e_diag_tempchuvst_in}}" from="firstView@Температурная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>терманестезия</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_tempchuvst_in_text" value="">
					</li>
					<li>
						<b>Тактильная чувствительность:</b>
						<select multiple="multiple" name="e_diag_tempchuvst_in[]" value="{{e_diag_tempchuvst_in}}" from="firstView@Тактильная чувствительность">
							<option>анестезия</option>
							<option>гиперестезия</option>
							<option>гипестезия</option>
						</select>
						<input name="e_diag_tempchuvst_in_text" value="">
					</li>
					<li>
						<b>Вибрационная чувствительность:</b>
						<select multiple="multiple" name="e_diag_vibrchuvst_in[]" value="{{e_diag_vibrchuvstv_in}}" from="firstView@Вибрационная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_vibrchuvst_in_text" value="">
					</li>
					<li>
						<b>Проприоцептивная чувствительность:</b>
						<select multiple="multiple" name="e_diag_propchucst_in[]" value="{{e_diag_propchucst_in}}" from="firstView@Проприоцептивная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_propchucst_in_text" value="">
					</li>
					<li>
						<b>Дискриминационная чувствительность:</b>
						<select multiple="multiple" name="e_diag_discrchuvst_in[]" value="{{e_diag_discrchuvst_in}}" from="firstView@Дискриминационная чувствительность">
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
						<input name="e_diag_discrchuvst_in_text" value="">
					</li>
					<li><b>Рефлекторная сфера: 
					</b> <textarea class="medium" name="e_diag_reflsph_in" from="firstView@Рефлекторная сфера">{{e_diag_reflsph_in}}</textarea></li>
					<li>
						<b>Поверхностные кожные рефлексы:</b>
						<select multiple="multiple" name="e_diag_porverhkozref_in[]" value="{{e_diag_porverhkozref_in}}" from="firstView@Поверхностные кожные рефлексы">
							<option>брюшные Th10-Th11-Th12 (верхний, средний, нижний)</option>
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
						<input name="e_diag_porverhkozref_in_text" value="">
					</li>
					<li>
						<b>Сухожильные и периостальные рефлексы:</b>
						<select multiple="multiple" name="e_diag_syhozhilirepref_in[]" value="{{e_diag_syhozhilirepref_in}}" from="firstView@Сухожильные и периостальные рефлексы">
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
						<input name="e_diag_syhozhilirepref_in_text" value="">
					</li>
					<li>
						<b>Клонусы:</b>
						<select multiple="multiple" name="e_diag_klonusi_in[]" value="{{e_diag_klonusi_in}}" from="firstView@Клонусы">
							<option>стопы</option>
							<option>коленной чашечки</option>
							<option>кисти</option>
							<option>есть</option>
							<option>нет</option>
							<option>длительность</option>
							<option>надколенника</option>
						</select>
						<input name="e_diag_klonusi_in_text" value="">
					</li>
					<li>
						<b>Тремор:</b>
						<select multiple="multiple" name="e_diag_tremor_in[]" value="{{e_diag_tremor_in}}" from="firstView@Тремор">
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
						<input name="e_diag_tremor_in_text" value="">
					</li>
					<li>
						<b>Патологические кистевые знаки:</b>
						<select multiple="multiple" name="e_diag_patologkistznak_in[]" value="{{e_diag_patologkistznak_in}}" from="firstView@Патологические кистевые знаки">
							<option>справа</option>
							<option>слева</option>
							<option>с двух сторон</option>
							<option>отсутствуют</option>
							<option>Якобсона-Ляска</option>
							<option>Жуковского</option>
							<option>Бехтерева</option>
							<option>Россолимо</option>
						</select>
						<input name="e_diag_patologkistznak_in_text" value="">
					</li>
					<li>
						<b>Патологические стопные знаки:</b>
						<select multiple="multiple" name="e_diag_patologstopznak_in[]" value="{{e_diag_patologstopznak_in}}" from="firstView@Патологические стопные знаки">
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
						<input name="e_diag_patologstopznak_in_text" value="">
					</li>
					<li>
						<b>Вертебральный статус:</b>
						<select multiple="multiple" name="e_diag_vertstat_in[]" value="{{e_diag_vertstat_in}}" from="firstView@Вертебральный статус">
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
						<input name="e_diag_vertstat_in_text" value="">
					</li>
					<li>
						<b>Симптомы натяжения:</b>
						<select multiple="multiple" name="e_diag_simptomnatyz_in[]" value="{{e_diag_simptomnatyz_in}}" from="firstView@Симптомы натяжения">
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
						<input name="e_diag_simptomnatyz_in_text" value="">
					</li>
					<li>
						<b>Симптомы орального автоматизма:</b>
						<select multiple="multiple" name="e_diag_symptomoralavt_in[]" value="{{e_diag_symptomoralavt_in}}" from="firstView@Симптомы орального автоматизма">
							<option>хоботковый</option>
							<option>назо-лабиальный</option>
							<option>сосательный</option>
							<option>ладонно-подбородочный Маринеску-Радовичи</option>
							<option>дистанс-оральный Карчикяна</option>
							<option>есть</option>
							<option>нет</option>
						</select>
						<input name="e_diag_symptomoralavt_in_text" value="">
					</li>
					<li>
						<b>Симптомы повышенной нервно-мышечной возбудимости:</b>
						<select multiple="multiple" name="e_diag_spnmv_in[]" value="{{e_diag_spnmv_in}}" from="firstView@Симптомы повышенной нервно-мышечной возбудимости">
							<option>есть</option>
							<option>нет</option>
							<option>Труссо</option>
							<option>Хвостека</option>
						</select>
						<input name="e_diag_spnmv_in_text" value="">
					</li>
					<li>
						<b>Письмо и чтение:</b>
						<select multiple="multiple" name="e_diag_pismoichten_in[]" value="{{e_diag_pismoichten_in}}" from="firstView@Письмо и чтение">
							<option>нарушено</option>
							<option>не нарушено</option>
							<option>ценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_pismoichten_in_text" value="">
					</li>
					<li>
						<b>Апраксия:</b>
						<select multiple="multiple" name="e_diag_apraksia_in[]" value="{{e_diag_apraksia_in[}}" from="firstView@Апраксия">
							<option>есть</option>
							<option>нет</option>
							<option>оценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_apraksia_in_text" value="">
					</li>
					<li>
						<b>Агнозия:</b>
						<select multiple="multiple" name="e_diag_agnosia_in[]" value="{{e_diag_agnosia_in}}" from="firstView@Агнозия">
							<option>есть</option>
							<option>нет</option>
							<option>оценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_agnosia_in_text" value="">
					</li>
					<li>
						<b>Вегетативная нервная система:</b>
						<select multiple="multiple" name="e_diag_vegnervnsys_in[]" value="{{e_diag_vegnervnsys_in}}" from="firstView@Вегетативная нервная система">
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
						<input name="e_diag_vegnervnsys_in_text" value="">
					</li>

					<!-- <li>
						<b><h3>Status vascularis:</h3></b>
						<textarea name="e_diag_statusvasc_in" from="firstView@Status vascularis">{{e_diag_statusvasc_in}}</textarea>
					</li> -->
					<!-- <li>
						<b><h3>Status localis</h3>:</b>
						<textarea name="e_diag_statuslocalis_in" from="firstView@Status localis">{{e_diag_statuslocalis_in}}</textarea>
					</li> -->
				</ul>
			</li>
		</ul>
			<li class="status_vascularis_in"><b><h3 name="status_vascularis_in" class="section subsection">Status vascularis</h3></b>
				<span style="display:none;" name="status_vascularis_in" from='firstView@status_vascularis_in'></span>
				<table class="status">
					<tr><th colspan="2">Пульс справа</th><th colspan="2">Пульс слева</th></tr>
					<tr><td>Сонные:</td><td><input name="e_sv_sonsprav_in" from="firstView@сонные справа"></input></td><td>Сонные:</td><td><input name="e_sv_sonslev_in" from="firstView@сонные слева"></input></td></tr>
					<tr><td>Аскилярная:</td><td><input name="e_sv_aksilarspar_in" from="firstView@аксиллярная справа"></input></td><td>Аскилярная:</td><td><input name="e_sv_aksilslev_in" from="firstView@аксиллярная слева"></input></td></tr>
					<tr><td>Плечевая на плече:</td><td><input name="e_sv_plecnaplecspar_in" from="firstView@плечевая на плече справа"></input></td><td>Плечевая на плече:</td><td><input name="e_sv_plechnaplechslev_n" from="firstView@плечевая на плече слева"></input></td></tr>
					<tr><td>Локтевая:</td><td><input name="e_sv_loktspav_in" from="firstView@локтевая справа"></input></td><td>Локтевая:</td><td><input name="e_sv_loktslev_in" from="firstView@локтевая слева"></input></td></tr>
					<tr><td>Лучевая:</td><td><input name="e_sv_luchspav_in" from="firstView@лучевая справа"></input></td><td>Лучевая:</td><td><input name="e_sv_luchslev_in" from="firstView@лучевая слева"></input></td></tr>
					<tr><td colspan="4">Брюшная АОРТА: <input name="e_sv_brushaorta_in" from="firstView@Брюшная АОРТА"></input></td></tr>
					<tr><th colspan="4">Артерии нижних конечностей</th></tr>
					<tr><td>Над пупартовой связкой:</td><td><input name="e_sv_nadpupartsvyazspav_in" from="firstView@Над пупартовой связкой справа"></input></td><td>Над пупартовой связкой:</td><td><input name="e_sv_nadpupartsvyazslev_in" from="firstView@Над пупартовой связкой слева"></input></td></tr>
					<tr><td>Под пупартовой связкой:</td><td><input name="e_sv_podpupartsvyazspav_in" from="firstView@Под пупартовой связкой справа"></input></td><td>Под пупартовой связкой:</td><td><input name="e_sv_podpupartsvyazslev_in" from="firstView@Под пупартовой связкой слева"></input></td></tr>
					<tr><td>ПоА:</td><td><input name="e_sv_poasprav_in" from="firstView@ПоА справа"></input></td><td>ПоА:</td><td><input name="e_sv_poaslev_in" from="firstView@ПоА слева"></input></td></tr>
					<tr><td>ПББА:</td><td><input name="e_sv_pbbasprav_in" from="firstView@ПББА справа"></input></td><td>ПББА:</td><td><input name="e_sv_pbbaslev_in" from="firstView@ПББА слева"></input></td></tr>
					<tr><td>ЗББА:</td><td><input name="e_sv_zbbaspav_in" from="firstView@ЗББА справа"></input></td><td>ЗББА:</td><td><input name="e_sv_zbbaslev_in" from="firstView@ЗББА слева"></input></td></tr>
					<tr><td>Положительные симптомы:</td><td><input name="e_sv_polozhsimpspav_in" from="firstView@Положительные симптомы справа"></input></td><td>Положительные симптомы:</td><td><input name="e_sv_polozhsimpslev_in" from="firstView@Положительные симптомы слева"></input></td></tr>
				</table>
			</li>
			<li class="status_localis_in"><b><h3 name="status_localis_in" class="section subsection"> Status localis:</h3></b>
				<span style="display:none;" name="status_localis_in" from='firstView@status_localis_in'></span>
				<table class="status">
					<tr><th colspan="2">Справа</th><th colspan="2">Слева</th></tr>
					<tr><td>Цвет:</td><td><input name="e_si_cvetspav_in" from="firstView@цвет справа"></input></td><td>Цвет:</td><td><input name="e_si_cvetsleva_in" from="firstView@Цвет слева"></input></td></tr>
					<tr><td>Температура:</td><td><input name="e_si_tempsprav_in" from="firstView@температура справа"></input></td><td>Температура:</td><td><input name="e_si_tempslev_in" from="firstView@температура слева"></input></td></tr>
					<tr><td>Чувствительность:</td><td><input name="e_si_chuvstsprav_in" from="firstView@чувствительность справа"></input></td><td>Чувствительность:</td><td><input name="e_si_chuvstslev_in" from="firstView@чувствительность слева"></input></td></tr>
					<tr><td>Движения:</td><td><input name="e_si_dvizspav_in" from="firstView@движения справа"></input></td><td>Движения:</td><td><input name="e_si_dvizslev_in" from="firstView@движения слева"></input></td></tr>
					<tr><td>Субфасциальный отек:</td><td><input name="e_si_subfcalnoteksprav_in" from="firstView@субфасциальный отек справа"></input></td><td>Субфасциальный отек:</td><td><input name="e_si_subfcalnotekslev_in" from="firstView@субфасциальный отек слева"></input></td></tr>
					<tr><td>Контрактура:</td><td><input name="e_si_contracturasprav_in" from="firstView@контрактура справа"></input></td><td>Контрактура:</td><td><input name="e_si_contracturaslev_in" from="firstView@контрактура слева"></input></td></tr>
					<tr><td>Трофические нарушения:</td><td><input name="e_si_trofnarsrav_in" from="firstView@трофические нарушения справа"></input></td><td>Трофические нарушения:</td><td><input name="e_si_trofnarslev_in" from="firstView@трофические нарушения слева"></input></td></tr>
					<tr><td>Отек:</td><td><input name="e_si_oteksprav_in" from="firstView@отек справа"></input></td><td>Отек:</td><td><input name="e_si_otekslev_in" from="firstView@отек слева"></input></td></tr>
					<tr><td>Подкожные вены:</td><td><input name="e_si_podkozhvensrav_in" from="firstView@подкожные вены справа"></input></td><td>Подкожные вены:</td><td><input name="e_si_podkozhvenslev_in" from="firstView@подкожные вены слева"></input></td></tr>
				</table>
			</li>
		</ul>
		</li>

		<h2>Течение заболевания</h2>
		<ul>
			<div class="ui-widget sugc"><textarea type="text" class="large suggest" suggest="move_techenie_zabolevania" type="text" name="e_techenie_zabolevania" >{{e_techenie_zabolevania}}</textarea><a href="#saveTechen" class="ui-button" title="Сохранить"><span class="ui-icon ui-icon-disk"></span></a></div>
		</ul>
		<h2 name="sost_out" class="section">Состояние при переводе</h2>
		<ul class='bottom-bord'>
			<li>
				<h3><b>Status praesens</b></h3> 
				<ul class="container nob">
					<li>
						<b>Общее состояние</b> 
						<select multiple="multiple" name="e_diag_sost_out[]"  from="lastView@Status praesens: Общее состояние:" >
							<option>удовлетворительное</option>
							<option>средней тяжести</option>
							<option>тяжелое</option>
							<option>крайне тяжелое</option>
						</select>
						<input name="e_diag_sost_out_text" value="">
					</li>
					<li><b>Сознание</b> <textarea class="medium" name="e_diag_mind_out" from="lastView@Сознание">{{e_diag_mind_out}}</textarea></li>
					<li><b>Кожные покровы и видимые слизистые:</b> <textarea class="medium" name="e_diag_skin_out" from="lastView@Кожные покровы и видимые слизистые">{{e_diag_skin_out}}</textarea></li>
					<li><b>Отёки:</b>
						<textarea class="medium" name="e_diag_edema_out" from="lastView@Отёки">{{e_diag_edema_out}}</textarea>
					</li>
				</ul>
			</li> 


			<li>
				<b><h3 name="org_dih_out" class="section subsection">Органы дыхания</h3></b>
				<ul class="container nob">
					<li>
						<b>Форма грудной клетки</b>
						<select multiple="multiple" name='e_diag_formgrkl_out[]' value='{{e_diag_formgrkl_out}}' from="lastView@Форма грудной клетки">
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
						<select multiple="multiple" name='e_diag_uchakdh_out[]' value='{{e_diag_uchakdh_out}}' from="lastView@Участвует в акте дыхания">
							<option>равномерно</option>
							<option>нет</option>
						</select>
						<input name="e_diag_uchakdh_out_text" value="">
					</li>
					<li>
						<b>Дыхание</b>
						<select multiple="multiple" name='e_diag_dihan_out[]' value='{{e_diag_dihan_out}}' from="lastView@Аускультативно: Дыхание" >
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
						<select multiple="multiple"  name='e_diag_hrip_out[]' value='{{e_diag_hrip_out}}' from="lastView@Хрипы">
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
				<b><h3 name="org_krov_out" class="section subsection">Органы кровообращения</h3></b>
				<ul class="container nob">
					
				<li>
					<b>Область сердца</b>
					<select multiple="multiple"  name='e_diag_oblserd_out[]' value='{{e_diag_oblserd_out}}' from="lastView@Область сердца">
						<option>не изменена</option>
						<option>расширена</option>
					</select>
					<input name="e_diag_oblserd_out_text" value="">
				</li>
				<li>
					<b>Границы сердца:</b>
					<select multiple="multiple"  name='e_diag_granserd_out[]' value='{{e_diag_granserd_out}}' from="lastView@Границы сердца">
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
					<select multiple="multiple"  name='e_diag_tonserd_out[]' value='{{e_diag_tonserd_out}}' from="lastView@Тоны сердца">
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
					<select multiple="multiple"  name='e_diag_shumi_out[]' value='{{e_diag_shumi_out}}' from="lastView@Шумы">
						<option>есть</option>
						<option>нет</option>
					</select>
					<input name="e_diag_shumi_out_text" value="">
				</li>
				<li>
					<b>Пульсация на периферических артериях:</b>
					<select multiple="multiple"  name='e_diag_pulsnaperar_out[]' value='{{e_diag_pulsnaperar_out}}' from="lastView@Пульсация на периферических артериях">
						<option>есть</option>
						<option>нет</option>
					</select>
					<input name="e_diag_pulsnaperar_out_text" value="">
				</li>
				<li><b>ЧСС:</b> <textarea class="medium" name="e_diag_chss_out" from="lastView@ЧСС">{{e_diag_chss_out}}</textarea></li>
				<li><b>Пульс:
				</b> <textarea class="medium" name="e_diag_ps_out" from="lastView@PS">{{e_diag_ps_out}}</textarea>  в минуту</li>
				<li><b>АД систолическое
				</b> <textarea class="medium" name="e_diag_adsist_out" from="lastView@АД систолическое">{{e_diag_adsist_out}}</textarea> мм. рт.ст.</li>
				<li><b>АД диастолическое
				</b> <textarea class="medium" name="e_diag_addist_out" from="lastView@АД диастолическое">{{e_diag_addist_out}}</textarea> мм. рт.ст.</li>			

				</ul>



			</li>
			<li>
				<b><h3 name="org_pish_out" class="section subsection">Органы пищеварения</h3></b>
				<ul class="container nob">
					<li>
						<b>Живот</b>
						<select multiple="multiple" name='e_diag_belly_out[]' value='{{e_diag_belly_out}}' from="lastView@Живот">
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
						<select multiple="multiple"  name='e_diag_yazikpish_out[]' value='{{e_diag_yazikpish_out}}' from="lastView@Язык">
							<option>чистый</option>
							<option>обложен налетом</option>
							<option>сухой</option>
							<option>влажный</option>
						</select>
						<input name="e_diag_yazikpish_out_text" value="">
					</li>
					<li>
						<b>Печень:</b>
						<select multiple="multiple"  name='e_diag_liver_out[]' value='{{e_diag_liver_out}}' from="lastView@Печень">
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
						<select multiple="multiple" name='e_diag_simp_pok_poys_obl_out[]' value='{{e_diag_simp_pok_poys_obl_out}}' from="lastView@ОСимптом поколачивания по поясничной области">
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
						<select multiple="multiple" name='e_diag_obl_pochk_out[]' value='{{e_diag_obl_pochk_out}}' from="lastView@Область почек">
							<option>изменена</option>
							<option>не изменена</option>
						</select>
						<input name="e_diag_obl_pochk_out_text" value="">
					</li>
					<li>
						<b>Симптом поколачивания по поясничной области:</b>
						<select multiple="multiple" name='e_diag_simp_pok_poys_obl_out[]' value='{{e_diag_simp_pok_poys_obl_out}}' from="lastView@ОСимптом поколачивания по поясничной области">
							<option>отрицательный с обеих сторон</option>
							<option>положительный справа</option>
							<option>положительный слева</option>
						</select>
						<input name="e_diag_simp_pok_poys_obl_out_text" value="">
					</li>
					<li>
						<b>Мочеиспускание:</b>
						<select multiple="multiple" name='e_diag_mocheisp_out[]' value='{{e_diag_mocheisp_out}}' from="lastView@Мочеиспускание">
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
				<span><b><h3 name="org_nevr_out" class="section subsection" style=" display: inline;">Неврологический и психический статус</h3> <button name="nevr-toggle-in">Скрыть</button></b></span>
				<ul class="container nob" name='nevr-status-in'>
					<li>
						<b>Уровень сознания:</b>
						<select multiple="multiple"  name="e_diag_soznur_out[]" value="{{e_diag_soznur_out}}" multiple="multiple" from="lastView@Уровень сознания">
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
					</b> <textarea class="medium" name="e_diag_shkg_out" from="lastView@ШКГ">{{e_diag_shkg_out}}</textarea></li>
					<li><b>NIHSS: 
					</b> <textarea class="medium" name="e_diag_nihss_out" from="lastView@NIHSS">{{e_diag_nihss_out}}</textarea></li>
					<li><b>Ривермид: 
					</b> <textarea class="medium" name="e_diag_rivermid_out" from="lastView@Ривермид">{{e_diag_rivermid_out}}</textarea></li>
					<li><b>Ранкин: 
					</b> <textarea class="medium" name="e_diag_rankin_out" from="lastView@Ранкин">{{e_diag_rankin_out}}</textarea></li>


					<li>
						<b>Речевому контакту:</b>
						<select multiple="multiple"  name="e_diag_rechkont_out[]" value="{{e_diag_rechkont_out}}" from="lastView@Речевому контакту">
							<option>доступен</option>
							<option>недоступен из-за речевых нарушений</option>
							<option>контакту недоступен по тяжести состояния</option>
						</select>
						<input name="e_diag_rechkont_out_text" value="">
					</li>
					<li>
						<b>Простые инструкции:</b>
						<select multiple="multiple"  name="e_diag_prostinsrt_out[]" value="{{e_diag_prostinsrt_out}}" from="lastView@Простые инструкции">
							<option>выполняет</option>
							<option>выполняет частично</option>
							<option>не выполняет</option>
						</select>
						<input name="e_diag_prostinsrt_out_text" value="">
					</li>
					<li>
						<b>Речь:</b>
						<select multiple="multiple"  name="e_diag_rech_out[]" value="{{e_diag_rech_out}}" from="lastView@Речь">
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
						<select multiple="multiple"  name="e_diag_reaktnaosm_out[]" value="{{e_diag_reaktnaosm_out}}" from="lastView@Реакция на осмотр">
							<option>сохранена</option>
							<option>адекватная</option>
							<option>вялая</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_reaktnaosm_out_text" value="">
					</li>
					<li>
						<b>Изменения психики:</b>
						<select multiple="multiple"  name="e_diag_izmpsyh_out[]" value="{{e_diag_izmpsyh_out}}" from="lastView@Изменения психики">
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
						<select multiple="multiple"  name="e_diag_cognfun_out[]" value="{{e_diag_cognfun_out}}" from="lastView@Когнитивные функции">
							<option>сохранены</option>
							<option>снижены</option>
							<option>оценить не представляется возможным</option>
						</select>
						<input name="e_diag_cognfun_out_text" value="">
					</li>
					<li>
						<b>Менингеальный синдром:</b>
						<select multiple="multiple"  name="e_diag_miningalsynd_out[]" value="{{e_diag_miningalsynd_out}}" from="lastView@Менингеальный синдром">
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
						<select multiple="multiple"  name="e_diag_obshemozg_out[]" value="{{e_diag_obshemozg_out}}" from="lastView@Общемозговые симптомы">
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
					</b> <textarea class="medium" name="e_diag_chemone_out" from="lastView@Черепно-мозговые нервы">{{e_diag_chemone_out}}</textarea></li>
					<li>
						<b>Обоняние:</b>
						<select multiple="multiple"  name="e_diag_obon_out[]" value="{{e_diag_obon_out}}" from="lastView@Обоняние">
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
						<select multiple="multiple"  name="e_diag_ostrzren_out[]" value="{{e_diag_ostrzren_out}}" from="lastView@Острота зрения"> 
							<option>не нарушена</option>
							<option>нарушена</option>
							<option>не исследована</option>
							<option>снижена</option>
						</select>
						<input name="e_diag_ostrzren_out_text" value="">
					</li>
					<li>
						<b>Поля зрения:</b>
						<select multiple="multiple" name="e_diag_polezren_out[]" value="{{e_diag_polezren_out}}" from="lastView@Поля зрения">
							<option>выпадения контрольным путем не выявлено</option>
							<option>выпадения контрольным путем выявлено</option>
							<option>проверить невозможно</option>
						</select>
						<input name="e_diag_polezren_out_text" value="">
					</li>
					<li>
						<b>Гемианопсия:</b>
						<select multiple="multiple"  name="e_diag_gepoksia_out[]" value="{{e_diag_gepoksia_out}}" from="lastView@Гемианопсия">
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
					</b> <textarea class="medium" name="e_diag_cvetoosh_out" from="lastView@Цветоощущение">{{e_diag_cvetoosh_out}}</textarea></li>
					<li><b>Глазное дно:
					</b> <textarea class="medium" name="e_diag_glazyabl_out" from="lastView@Глазное дно">{{e_diag_glazyabl_out}}</textarea></li>
					<li><b>Зрачки: 
					</b> <textarea class="medium" name="e_diag_zrachki_out" from="lastView@Зрачки">{{e_diag_zrachki_out}}</textarea></li>
					<li>
						<b>Фотореакция:</b>
						<select multiple="multiple"  name="e_diag_fotoreact_out[]" value="{{e_diag_fotoreact_out}}" from="lastView@Фотореакция">
							<option>сохранена</option>
							<option>снижена</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_fotoreact_out_text" value="">
					</li>
					<li>
						<b>Нистагм:</b>
						<select multiple="multiple"  name="e_diag_nistagm_out[]" value="{{e_diag_nistagm_out}}" from="lastView@Нистагм">
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
						<select multiple="multiple"  name="e_diag_glazovidnar_out[]" value="{{e_diag_glazovidnar_out}}" from="lastView@Глазодвигательные нарушения">
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
						<select multiple="multiple"  name="e_diag_ekzoftalm_out[]" value="{{e_diag_ekzoftalm_out}}" from="lastView@Экзофтальм">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_ekzoftalm_out_text" value="">
					</li>
					<li>
						<b>Энофтальм:</b>
						<select multiple="multiple"  name="e_diag_enoftalm_out[]" value="{{e_diag_enoftalm_out}}" from="lastView@Энофтальм">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_enoftalm_out_text" value="">
					</li>
					<li>
						<b>Птоз:</b>
						<select multiple="multiple"  name="e_diag_ptoz_out[]" value="{{e_diag_ptoz_out}}" from="lastView@Птоз">
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
						<select multiple="multiple"  name="e_diag_diplonia_out[]" value="{{e_diag_diplonia_out}}" from="lastView@Диплопия">
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
						<select multiple="multiple"  name="e_diag_dvizhnizhnche_out[]" value="{{e_diag_dvizhnizhnche_out}}" from="lastView@Движение нижней челюстью, жевательные мышцы">
							<option>не изменены</option>
							<option>изменены</option>
						</select>
						<input name="e_diag_dvizhnizhnche_out_text" value="">
					</li>
					<li>
						<b>Роговичный, конъюнктивальный рефлекс:</b>
						<select multiple="multiple"  name="e_diag_rogovichkon_out[]" value="{{e_diag_rogovichkon_out}}" from="lastView@Роговичный, конъюнктивальный рефлекс">
							<option>живой</option>
							<option>вялый</option>
							<option>отсутствует</option>
						</select>
						<input name="e_diag_rogovichkon_out_text" value="">
					</li>
					<li>
						<b>Чувствительность на лице:</b>
						<select multiple="multiple"  name="e_diag_chuvsctnalic_out[]" value="{{e_diag_chuvsctnalic_out}}" from="lastView@Чувствительность на лице">
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
						<select multiple="multiple"  name="e_diag_lico_out[]" value="{{e_diag_lico_out}}" from="lastView@Лицо">
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
						<select multiple="multiple"  name="e_diag_lagoftalm_out[]" value="{{e_diag_lagoftalm_out}}" from="lastView@Лагофтальм">
							<option>есть</option>
							<option>нет</option>
							<option>справа</option>
							<option>слева</option>
						</select>
						<input name="e_diag_lagoftalm_out_text" value="">
					</li>
					<li>
						<b>Мимические пробы:</b>
						<select multiple="multiple"  name="e_diag_mimiprob_out[]" value="{{e_diag_mimiprob_out}}" from="lastView@Мимические пробы">
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
						<select multiple="multiple"  name="e_diag_giperakuz_out[]" value="{{e_diag_giperakuz_out}}" from="lastView@Гиперакузия">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_giperakuz_out_text" value="">
					</li>
					<li>
						<b>Сухость глаз:</b>
						<select multiple="multiple"  name="e_diag_suhglaz_out[]" value="{{e_diag_suhglaz_out}}" from="lastView@Сухость глаз">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_suhglaz_out_text" value="">
					</li>
					<li>
						<b>Слюноотделение:</b>
						<select multiple="multiple"  name="e_diag_slunotd_out[]" value="{{e_diag_slunotd_out}}" from="lastView@Слюноотделение">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_slunotd_out_text" value="">
					</li>
					<li>
						<b>Слух:</b>
						<select multiple="multiple"  name="e_diag_sluh_out[]" value="{{e_diag_sluh_out}}" from="lastView@Слух">
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
						<select multiple="multiple"  name="e_diag_parezmyagneba_out[]" value="{{e_diag_parezmyagneba_out}}" from="lastView@Парез мягкого неба">
							<option>есть</option>
							<option>нет</option>
							<option>слева</option>
							<option>справа</option>
						</select>
						<input name="e_diag_parezmyagneba_out_text" value="">
					</li>
					<li>
						<b>Глоточный рефлекс:</b>
						<select multiple="multiple"  name="e_diag_glotreflex_out[]" value="{{e_diag_glotreflex_out}}" from="lastView@Глоточный рефлекс">
							<option>сохранен</option>
							<option>дисфагия</option>
							<option>дисфония</option>
						</select>
						<input name="e_diag_glotreflex_out_text" value="">
					</li>
					<li>
						<b>Вкусовой анализатор:</b>
						<select multiple="multiple"  name="e_diag_vkusovoianalizator_out[]" value="{{e_diag_vkusovoianalizator_out}}" from="lastView@Вкусовой анализатор">
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
						<select multiple="multiple"  name="e_diag_polozhgolov_out[]" value="{{e_diag_polozhgolov_out}}" from="lastView@Положение головы и поднимание плеч">
							<option>не нарушено</option>
							<option>насильственный поворот влево</option>
							<option>насильственный поворот вправо</option>
						</select>
						<input name="e_diag_polozhgolov_out_text" value="">
					</li>
					<li>
						<b>Язык:</b>
						<select multiple="multiple"  name="e_diag_yaziknerv_out[]" value="{{e_diag_yaziknerv_out}}" from="lastView@Язык">
							<option>по средней линии</option>
							<option>девиирует вправо</option>
							<option>девиирует влево</option>
							<option>в полости рта легко</option>
						</select>
						<input name="e_diag_yaziknerv_out_text" value="">
					</li>
					<li>
						<b>Прикус языка:</b>
						<select multiple="multiple"  name="e_diag_prikus_out[]" value="{{e_diag_prikus_out}}" from="lastView@Прикус языка">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_prikus_out_text" value="">
					</li>
					<li>
						<b>Фибриллярные подергивания:</b>
						<select multiple="multiple"  name="e_diag_fibrpod_out[]" value="{{e_diag_fibrpod_ou}}" from="lastView@Фибриллярные подергивания">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_fibrpod_out_text" value="">
					</li>
					<li><b>Двигательная сфера:  
					</b> <textarea class="medium" name="e_diag_dvigsph_out" from="lastView@Двигательная сфера">{{e_diag_dvigsph_out}}</textarea></li>
					<li>
						<b>Положение тела:</b>
						<select multiple="multiple"  name="e_diag_poloztela_out[]" value="{{e_diag_poloztela_out}}" from="lastView@Положение тела">
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
						<select multiple="multiple"  name="e_diag_neprdviz_out[]" value="{{e_diag_neprdviz_out}}" from="lastView@Непроизвольные движения">
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
						<select multiple="multiple"  name="e_diag_musmass_out[]" value="{{e_diag_musmass_out}}" from="lastView@Мышечная масса">
							<option>норма</option>
							<option>атрофия</option>
							<option>гипертрофия</option>
							<option>гипотрофия</option>
						</select>
						<input name="e_diag_musmass_out_text" value="">
					</li>
					<li>
						<b>Мышечный тонус:</b>
						<select multiple="multiple"  name="e_diag_masstonus_out[]" value="{{e_diag_masstonus_out[]}}" from="lastView@Мышечный тонус">
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
						<select multiple="multiple"  name="e_diag_masssil_out[]" value="{{e_diag_masssil_out}}" from="lastView@Мышечная сила">
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
					</b> <textarea class="medium" name="e_diag_coordsph_out" from="lastView@Координаторная сфера">{{e_diag_coordsph_out}}</textarea></li>
					<li>
						<b>Координация движений:</b>
						<select multiple="multiple"  name="e_diag_koorddiz_out[]" value="{{e_diag_koorddiz_out}}" from="lastView@Координация движений">
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
						<select multiple="multiple"  name="e_diag_pohodka_out[]" value="{{e_diag_pohodka_out}}" from="lastView@Походка">
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
						<select multiple="multiple"  name="e_diag_zast_out[]" value="{{e_diag_zast_out}}" from="lastView@Застывание в определенных позах">
							<option>нет</option>
							<option>есть</option>
						</select>
						<input name="e_diag_zast_out_text" value="">
					</li>
					<li>
						<b>Координаторные пробы:</b>
						<select multiple="multiple"  name="e_diag_koordprob_out[]" value="{{e_diag_koordprob_out}}" from="lastView@Координаторные пробы">
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
						<select multiple="multiple"  name="e_diag_statravn_out[]" value="{{e_diag_statravn_ou}}" from="lastView@Статическое равновесие">
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
						<select multiple="multiple"  name="e_diag_staksia_out[]" value="{{e_diag_staksia_out}}" from="lastView@Атаксия">
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
						<select multiple="multiple"  name="e_diag_narushchuvs_out[]" value="{{e_diag_narushchuvs_out}}" from="lastView@Нарушения чувствительности">
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
						<select multiple="multiple"  name="e_diag_bolchuvst_out[]" value="{{e_diag_bolchuvst_out}}" from="lastView@Болевая чувствительность">
							<option>аналгезия</option>
							<option>гипералгезия</option>
							<option>гипалгезия</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_bolchuvst_out_text" value="">
					</li>
					<li>
						<b>Температурная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_tempchuvst_out[]" value="{{e_diag_tempchuvst_out}}" from="lastView@Температурная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>терманестезия</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_tempchuvst_out_text" value="">
					</li>
					<li>
						<b>Тактильная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_tempchuvst_out[]" value="{{e_diag_tempchuvst_out}}" from="lastView@Тактильная чувствительность">
							<option>анестезия</option>
							<option>гиперестезия</option>
							<option>гипестезия</option>
						</select>
						<input name="e_diag_tempchuvst_out_text" value="">
					</li>
					<li>
						<b>Вибрационная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_vibrchuvst_out[]" value="{{e_diag_vibrchuvst_out[]}}" from="lastView@Вибрационная чувствительность">
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_vibrchuvst_out_text" value="">
					</li>
					<li>
						<b>Проприоцептивная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_propchucst_out[]" value="{{e_diag_propchucst_out}}" from="lastView@Проприоцептивная чувствительность"> 
							<option>нарушена</option>
							<option>не нарушена</option>
							<option>не исследована</option>
						</select>
						<input name="e_diag_propchucst_out_text" value="">
					</li>
					<li>
						<b>Дискриминационная чувствительность:</b>
						<select multiple="multiple"  name="e_diag_discrchuvst_out[]" value="{{e_diag_discrchuvst_out}}" from="lastView@Дискриминационная чувствительность">
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
					</b> <textarea class="medium" name="e_diag_reflsph_out" from="lastView@Рефлекторная сфера">{{e_diag_reflsph_out}}</textarea></li>
					<li>
						<b>Поверхностные кожные рефлексы:</b>
						<select multiple="multiple"  name="e_diag_porverhkozref_out[]" value="{{e_diag_porverhkozref_out}}" from="lastView@Поверхностные кожные рефлексы">
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
						<select multiple="multiple"  name="e_diag_syhozhilirepref_out[]" value="{{e_diag_syhozhilirepref_out}}" from="lastView@Сухожильные и периостальные рефлексы">
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
						<select multiple="multiple"  name="e_diag_klonusi_out[]" value="{{e_diag_klonusi_out}}" from="lastView@Клонусы">
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
						<select multiple="multiple"  name="e_diag_tremor_out[]" value="{{e_diag_tremor_out}}" from="lastView@Тремор">
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
						<select multiple="multiple"  name="e_diag_patologkistznak_out[]" value="{{e_diag_patologkistznak_out}}" from="lastView@Патологические кистевые знаки">
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
						<select multiple="multiple"  name="e_diag_patologstopznak_out[]" value="{{e_diag_patologstopznak_out}}" from="lastView@Патологические стопные знаки">
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
						<select multiple="multiple"  name="e_diag_vertstat_out[]" value="{{e_diag_vertstat_out}}" from="lastView@Вертебральный статус">
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
						<select multiple="multiple"  name="e_diag_simptomnatyz_out[]" value="{{e_diag_simptomnatyz_out}}" from="lastView@Симптомы натяжения">
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
						<select multiple="multiple"  name="e_diag_symptomoralavt_out[]" value="{{e_diag_symptomoralavt_out}}" from="lastView@Симптомы орального автоматизма">
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
						<select multiple="multiple"  name="e_diag_spnmv_out[]" value="{{e_diag_spnmv_out}}" from="lastView@Симптомы повышенной нервно-мышечной возбудимости">
							<option>есть</option>
							<option>нет</option>
							<option>Труссо</option>
							<option>Хвостека</option>
						</select>
						<input name="e_diag_spnmv_out_text" value="">
					</li>
					<li>
						<b>Письмо и чтение:</b>
						<select multiple="multiple"  name="e_diag_pismoichten_out[]" value="{{e_diag_pismoichten_out}}" from="lastView@Письмо и чтение">
							<option>нарушено</option>
							<option>не нарушено</option>
							<option>ценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_pismoichten_out_text" value="">
					</li>
					<li>
						<b>Апраксия:</b>
						<select multiple="multiple"  name="e_diag_apraksia_out[]" value="{{e_diag_apraksia_out}}" from="lastView@Апраксия">
							<option>есть</option>
							<option>нет</option>
							<option>оценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_apraksia_out_text" value="">
					</li>
					<li>
						<b>Агнозия:</b>
						<select multiple="multiple"  name="e_diag_agnosia_out[]" value="{{e_diag_agnosia_out}}" from="lastView@Агнозия">
							<option>есть</option>
							<option>нет</option>
							<option>оценить не предоставляется возможным</option>
						</select>
						<input name="e_diag_agnosia_out_text" value="">
					</li>
					<li>
						<b>Вегетативная нервная система:</b>
						<select multiple="multiple"  name="e_diag_vegnervnsys_out[]" value="{{e_diag_vegnervnsys_out}}" from="lastView@Вегетативная нервная система">
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
						<textarea name="e_diag_statusvasc_out" from="lastView@Status vascularis">{{e_diag_statusvasc_out}}</textarea>
					</li>
					<li>
						<b><h3>Status localis:</h3></b>
						<textarea name="e_diag_statuslocalis_out" from="lastView@Status localis">{{e_diag_statuslocalis_out}}</textarea>
					</li> -->
				</ul>
					<li class="status_vascularis_out"><b><h3 name="status_vascularis_out" class="section subsection">Status vascularis при переводе:</h3></b>
						<span style="display:none;" name="status_vascularis_out" from='lastView@status_vascularis_out'></span>
						<table class="status">
						<tr><th colspan="2">Пульс справа</th><th colspan="2">Пульс слева</th></tr>
						<tr><td>Сонные:</td><td><input name="e_sv_sonsprav_out" from="lastView@сонные справа"></input></td><td>Сонные:</td><td><input name="e_sv_sonslev_out" from="lastView@сонные слева"></input></td></tr>
						<tr><td>Аскилярная:</td><td><input name="e_sv_aksilarspar_out" from="lastView@аксиллярная справа"></input></td><td>Аскилярная:</td><td><input name="e_sv_aksilslev_out" from="lastView@аксиллярная слева"></input></td></tr>
						<tr><td>Плечевая на плече:</td><td><input name="e_sv_plecnaplecspar_out" from="lastView@плечевая на плече справа"></input></td><td>Плечевая на плече:</td><td><input name="e_sv_plechnaplechslev_n" from="lastView@плечевая на плече слева"></input></td></tr>
						<tr><td>Локтевая:</td><td><input name="e_sv_loktspav_out" from="lastView@локтевая справа"></input></td><td>Локтевая:</td><td><input name="e_sv_loktslev_out" from="lastView@локтевая слева"></input></td></tr>
						<tr><td>Лучевая:</td><td><input name="e_sv_luchspav_out" from="lastView@лучевая справа"></input></td><td>Лучевая:</td><td><input name="e_sv_luchslev_out" from="lastView@лучевая слева"></input></td></tr>
						<tr><td colspan="4">Брюшная АОРТА: <input name="e_sv_brushaorta_out" from="lastView@Брюшная АОРТА"></input></td></tr>
						<tr><th colspan="4">Артерии нижних конечностей</th></tr>
						<tr><td>Над пупартовой связкой:</td><td><input name="e_sv_nadpupartsvyazspav_out" from="lastView@Над пупартовой связкой справа"></input></td><td>Над пупартовой связкой:</td><td><input name="e_sv_nadpupartsvyazslev_out" from="lastView@Над пупартовой связкой слева"></input></td></tr>
						<tr><td>Под пупартовой связкой:</td><td><input name="e_sv_podpupartsvyazspav_out" from="lastView@Под пупартовой связкой справа"></input></td><td>Под пупартовой связкой:</td><td><input name="e_sv_podpupartsvyazslev_out" from="lastView@Под пупартовой связкой слева"></input></td></tr>
						<tr><td>ПоА:</td><td><input name="e_sv_poasprav_out" from="lastView@ПоА справа"></input></td><td>ПоА:</td><td><input name="e_sv_poaslev_out" from="lastView@ПоА слева"></input></td></tr>
						<tr><td>ПББА:</td><td><input name="e_sv_pbbasprav_out" from="lastView@ПББА справа"></input></td><td>ПББА:</td><td><input name="e_sv_pbbaslev_out" from="lastView@ПББА слева"></input></td></tr>
						<tr><td>ЗББА:</td><td><input name="e_sv_zbbaspav_out" from="lastView@ЗББА справа"></input></td><td>ЗББА:</td><td><input name="e_sv_zbbaslev_out" from="lastView@ЗББА слева"></input></td></tr>
						<tr><td>Положительные симптомы:</td><td><input name="e_sv_polozhsimpspav_out" from="lastView@Положительные симптомы справа"></input></td><td>Положительные симптомы:</td><td><input name="e_sv_polozhsimpslev_out" from="lastView@Положительные симптомы слева"></input></td></tr>
						</table>
					</li>
					<li class="status_localis_out"><b><h3 name="status_localis_out" class="section subsection">Status localis при переводе:</h3></b>
						<span style="display:none;" name="status_localis_out" from='lastView@status_localis_out'></span>
						<table class="status">
						<tr><th colspan="2">Справа</th><th colspan="2">Слева</th></tr>
						<tr><td>Цвет:</td><td><input name="e_si_cvetspav_out" from="lastView@цвет справа"></input></td><td>Цвет:</td><td><input name="e_si_cvetsleva_out" from="lastView@Цвет слева"></input></td></tr>
						<tr><td>Температура:</td><td><input name="e_si_tempsprav_out" from="lastView@температура справа"></input></td><td>Температура:</td><td><input name="e_si_tempslev_out" from="lastView@температура слева"></input></td></tr>
						<tr><td>Чувствительность:</td><td><input name="e_si_chuvstsprav_out" from="lastView@чувствительность справа"></input></td><td>Чувствительность:</td><td><input name="e_si_chuvstslev_out" from="lastView@чувствительность слева"></input></td></tr>
						<tr><td>Движения:</td><td><input name="e_si_dvizspav_out" from="lastView@движения справа"></input></td><td>Движения:</td><td><input name="e_si_dvizslev_out" from="lastView@движения слева"></input></td></tr>
						<tr><td>Субфасциальный отек:</td><td><input name="e_si_subfcalnoteksprav_out" from="lastView@субфасциальный отек справа"></input></td><td>Субфасциальный отек:</td><td><input name="e_si_subfcalnotekslev_out" from="lastView@субфасциальный отек слева"></input></td></tr>
						<tr><td>Контрактура:</td><td><input name="e_si_contracturasprav_out" from="lastView@контрактура справа"></input></td><td>Контрактура:</td><td><input name="e_si_contracturaslev_out" from="firstView@контрактура слева"></input></td></tr>
						<tr><td>Трофические нарушения:</td><td><input name="e_si_trofnarsrav_out" from="lastView@трофические нарушения справа"></input></td><td>Трофические нарушения:</td><td><input name="e_si_trofnarslev_out" from="lastView@трофические нарушения слева"></input></td></tr>
						<tr><td>Отек:</td><td><input name="e_si_oteksprav_out" from="lastView@отек справа"></input></td><td>Отек:</td><td><input name="e_si_otekslev_out" from="lastView@отек слева"></input></td></tr>
						<tr><td>Подкожные вены:</td><td><input name="e_si_podkozhvensrav_out" from="lastView@подкожные вены справа"></input></td><td>Подкожные вены:</td><td><input name="e_si_podkozhvenslev_out" from="lastView@подкожные вены слева"></input></td></tr>
						</table>
					</li>
			</li>
		</ul>
</ul>
<h2 name="rez_diag_isl" class="section">Результаты диагностических исследований</h2>
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
	<li name="transfer_orgstructure">
		<b>Переводится в:</b>
	</li>
	<li>
		<b>Причина перевода:</b>
		<textarea class="medium" name="e_move_reason"></textarea>
	</li>

</ul>
<h2 name="rekom_po_daln_ved" class="section" class="section subsection"><b>Рекомендации по дальнейшему ведению пациента </b></h2>
<ol>
<li><b>Диета:</b>
<textarea name="e_recom_dieta">{{e_recom_dieta}}</textarea>
</li>
<li><b>Лекарственные препараты:</b>
<textarea name="e_Drugs">{{e_Drugs}}</textarea>
</li>
<li><b>Дополнительная информация:</b>
<textarea name="e_dop_information">{{e_dop_information}}</textarea> 
</li>
<br/>
</ol>
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

$(document).on('keyup','.tel input',function(e) {
	if ($(this).val().trim() == '') {
		console.log($(this).parent());
		$('.tel').addClass('noprint')
	} else {
		if ($('.tel').hasClass('noprint')) {
			$('.tel').removeClass('noprint');
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
