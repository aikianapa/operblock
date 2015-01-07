<div class="print_page">
<h2>Патологическая лаборатория<br>
ФГБУ "НИИ онкологии им. Н.Н. Петрова" Минздрава России </h2>
<h2>Регистрация биоматериала</h2>
<p class="center">{{actionTypeName}}</p>

<ol>
<li>Отделение <b><u><i>{{orgStructure}}</i></u></b></li>
<li>Лечащий врач <u><b><i>{{person}}</i></b></u></li>
<li>Ф.И.О. пациента  <u><b><i><big>{{client}}</big></i></b></u></li>
<li>Возраст <u><b><i>{{age}}</i></b></u></li>
<li>Пол <u><b><i>{{sex}}</i></b></u></li>

<li>Клинический диагноз<b><i><big>
{{diagnose}}
</big></i></b></li>
<div data-role="foreach" from="fields">
<li>{{label}} <u><b><i>{{value}}</i></b></u></li>
</div>
</ol>
Подпись врача:_______________________________<u><b><i>{{person}} ({{docDate}})</i></b></u><br>
<div class="result">
Результаты исследования: <b><i>
<div style=" width:100%; display:block;">
{{fld_19}}
</div>
</i></b>
</div>
</div>
<script language="javascript">
	print();
</script> 
