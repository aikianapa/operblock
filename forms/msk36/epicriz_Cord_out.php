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
		<li><b>Фамилия, Имя, Отчество:</b> <u>{{client}}</u></li>
		<li><b>Возраст:</b> <u>{{age}}</u></li>
		<li><b>Дата госпитализации:</b> <u>{{s_date1}}</u></li>
		<li><b>Дата выписки:</b> <u><input type="text" class="medium" name="s_date2" value="{{s_date2}}"></u></li>

		<li><b>ДИАГНОЗ:</b>
			<ul>
				<li><b>Основной:</b><br><u><textarea name="e_diag_main">{{e_diag_main}}</textarea></u> </li>
				<li><b>Фон:</b><br><u><textarea name="e_diag_fon">{{e_diag_fon}}</textarea></u></li>
				<li><b>Осложнения:</b><br><u><textarea name="e_diag_comp">{{e_diag_comp}}</textarea></u></li>
				<li><b>Сопутствующий:</b><br><u><textarea name="e_diag_satt">{{e_diag_satt}}</textarea></u></li>
			</ul>
		</li>
		<li><p><b>Код стандарта:</b> <u><input name="e_code1" class="small"></u> <b>Шифр по МКБ-10:</b> <u><input name="e_code2" class="small"></u></p></li>
		<li><b>Жалобы:</b><br><u><textarea name="e_complaint1">{{e_complaint1}}</textarea></u> </li>
		<li><b>An.morbi:</b><br><u><textarea name="e_anamnez1">{{e_anamnez1}}</textarea></u> </li>
		<li><b>Состояние при поступлении:</b><br><u><textarea name="e_stateIn">{{e_stateIn}}</textarea></u></li>
		
		<li><b>Дыхание:</b>
			<ul class="inline">
				<li><u>{{e_pulm_in}}</u></li>
				<li><b>ЧДД:</b> <u>{{e_pulmFreq_in}}</u></li>
			</ul>
		</li>
		
		<li><b>Сердце:</b>
			<ul class="inline">
			<li><b>Тоны сердца:</b> <u>{{e_corTone_in}}</u></li>
			<li><u>{{e_corFreq}}</u></li>
			<li><b>АД:</b> <u>{{e_corPress_in}}</u></li>
			</ul>
		</li>	
		
		<li><b>Течение заболевания в стационаре:</b><br><u><textarea name="e_stationar">{{e_stationar}}</textarea></u> </li>
		
		<li><b>Терапия: </b>
		<ul>
		<div data-role="foreach" from="Drugs">
		<li>{{drugs}}</li>
		
		</div>
		</ul>
		<u><textarea name="e_drugsText">{{e_drugsText}}</textarea></u></li>
		
		<li><b>Состояние при выписке:</b> 
		<select name="e_stateOut" value="{{e_stateOut}}">
			<option>удовлетворительное</option>
			<option>относительно удовлетворительное</option>
			<option>средней тяжести</option>
			<option>ближе к тяжелому</option>
			<option>тяжелое</option>
			<option>крайне тяжелое</option>
		</select>
		<br><u><textarea name="e_stateOutText">{{e_stateOutText}}</textarea></u> </li>

		<li><b>Дыхание:</b>
			<ul class="inline">
				<li>
						<select name="e_pulm1" multiple="multiple"  value="{{e_pulm1}}">
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
				<li><b>ЧДД:</b> <input name="e_pulmFreq" class="small"> в 1 мин.</li>
				<li><textarea name="e_pulm">{{e_pulm}}</textarea></u></li>
			</ul>
		</li>
		
		<li><b>Сердце:</b>
			<ul class="inline">
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
		<li><b>Печень:</b><br><u><textarea name="e_liverText">{{e_liverText}}</textarea></u></li>
		

		<li><b>Живот:</b>
		<select name="e_belly1" multiple="multiple" value="{{e_belly1}}">
		<option>мягкий</option>
		<option>болезненный</option>
		<option>безболезненный</option>
		</select>
		</li>
			
	
<!--		<div data-role="foreach" from="fields">
		<li>
			<a href='#del' class='del_fld'>Уд.</a>
			<input data-role="none" name="fld[]" value="{{fld}}">
			<u><textarea name="val[]">{{val}}</textarea></u>
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
				<p>{{lab}}</p></li>
		</div>
	</ul>
	</li>

	<li><b>Лабораторная диагностика: </b>
	<ul>
		<div data-role="foreach" from="lab">
			<li>
				<a href='#del' class='del_fld'><span class="ui-icon ui-icon-circle-close"></span></a>
				<p>{{lab}}</p></li>
		</div>
	</ul>
	<u><textarea name="e_anayseText">{{e_anayseText}}</textarea></u></li>
	
	<li><b>Консультации: </b>
	<ul>
		<div data-role="foreach" from="cons">
			<li>{{cons}}</li>
		</div>
	</ul>
	<u><textarea name="e_consultText">{{e_consultText}}</textarea></u></li>
	
	<li><b>Больничный лист: </b>
	<select name="e_hospList" value="{{e_hospList}}">
		<option>не выдавался</option>
		<option>выдавался</option>
	</select>
	</li>
</ul>

<ul>
<b>Рекомендации по дальнейшему ведению пациента: </b>
<li><textarea name="e_recom7">{{e_recom7}}</textarea></u></li>

</ul>

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
