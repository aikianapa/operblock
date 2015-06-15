<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Этапный эпикриз</h2></div>
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
{{OrgAddr}}                                                   тел. +7 (499) 369-34-75</b>
<br />
<b>Дата:</b> <input type="text" class="medium datepicker" name="endDate" value="{{endDate}}">
<h2>{{docType}} ЭПИКРИЗ ИЗ  ИСТОРИИ  БОЛЕЗНИ    № {{externalId}}</h2>
</p>
		<ul class="fields">
		<li><b>Фамилия, Имя, Отчество:</b> {{client}}</li>
		<li><b>Возраст:</b> {{age}}</li>
		<li><b>Дата госпитализации:</b> {{s_date1}}</li>
		<li><b>Койко-дней:</b> 
			<input autofocus type="text" class="medium" name="e_bedday" value="{{e_bedday}}">
			<input type="hidden" name="setDate" value="{{setDate}}">
		</li>
		
		<li><b>ДИАГНОЗ:</b>
			<ul class="block">
				<li><b>Основное заболевание:</b><textarea name="e_diag_main" from="firstView@Основное заболевание">{{e_diag_main}}</textarea> </li>
				<li><b>Фоновые заболевания:</b><textarea name="e_diag_fon" from="firstView@Фоновые заболевания">{{e_diag_fon}}</textarea></li>
				<li><b>Осложнения основного заболевания:</b><textarea name="e_diag_comp" from="firstView@Осложнения основного заболевания:">{{e_diag_comp}}</textarea></li>
				<li><b>Сопутствующие заболевания:</b><textarea name="e_diag_satt" from="firstView@Сопутствующие заболевания:">{{e_diag_satt}}</textarea></li>
			</ul>
		</li>
		<li><p><b>Код стандарта:</b> <input name="e_code1" class="small"> <b>Шифр по МКБ-10:</b> <input name="e_code2" class="small"></p></li>
		<li><b>Жалобы:</b><br><textarea name="e_complaint1" from="firstView@Жалобы">{{e_complaint1}}</textarea> </li>
		<li><b>An.morbi:</b><br><textarea name="e_anamnez1" from="firstView@Anamnesis morbi">{{e_anamnez1}}</textarea> </li>
		<li><b>An.vitae:</b><br><textarea name="e_an_vitae" from="firstView@Anamnesis vitae">{{e_an_vitae}}</textarea> </li>
		<li><b>Состояние при поступлении:</b><br><textarea name="e_stateIn">{{e_stateIn}}</textarea></li>
		
		<li><b>Дыхание:</b>
			<ul class="inline">
				<li><input name="e_pulm_in" class="medium" from="firstView@Дыхание через нос"></li>
				<li><b>ЧДД:</b> <input class="medium" name="e_pulmFreq_in" from="firstView@ЧДД"></li>
			</ul>
		</li>
		
		<li><b>Сердце:</b>
			<ul class="inline">
			<li><b>Тоны сердца:</b> <input class="medium" name="e_corTone_in" from="firstView@Тоны сердца"></li>
			<li><b>ЧСС: </b><input class="medium" name="e_corFreq" from="firstView@ЧСС"></li>
			<li><b>АД:</b> <input class="medium" name="e_corPress_in" from="firstView@АД"></li>
			</ul>
		</li>	
		
		<li><b>Течение заболевания в стационаре:</b><br><textarea name="e_stationar">{{e_stationar}}</textarea> </li>
		
		<li><b>Терапия: </b>
		<ul>
		<div data-role="foreach" from="Drugs">
		<li>{{drugs}}</li>
		
		</div>
		</ul>
		<textarea name="e_drugsText">{{e_drugsText}}</textarea></li>
	
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
	<textarea name="e_anayseText">{{e_anayseText}}</textarea></li>
	
	<li><b>Консультации: </b>
	<ul>
		<div data-role="foreach" from="cons">
			<li>{{cons}}</li>
		</div>
	</ul>
	<textarea name="e_consultText">{{e_consultText}}</textarea></li>
</ul>

<ul>
<li><textarea name="e_recom7">{{e_recom7}}</textarea></li>

</ul>

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
	$("#epic_window").delegate(".datepicker","mouseenter",function(){$(".datepicker").datepick();});
	$("#form-027u select[multiple]").each(function(){
		$(this).css("height",$(this).find("option").length*18+"px");
	});
</script>
