<div data-role="page" data-theme="a" id="hirurgOperation" >
<div data-role="header"  data-position="fixed"><h2>Выписной эпикриз</h2></div>
<div data-role="content" >
<div class="copytext">
<div id="form-027u"  class="print_page">
<form method="post">
<input type="hidden" name="action_id">
<input type="hidden" name="event_id">
<input type="hidden" name="person_id">
		<table>
		<tr><td>Министерство здравоохранения РФ</td><td rowspan="2" style="vertical-align:middle;">{{orgStr}}</td></tr>
		<tr><td>{{org}}</td></tr>
		</table>
<br>
<h2>ВЫПИСНОЙ ЭПИКРИЗ</h2>
<br />
		<div class="text">
		<ol style="list-style-type:none;">
		<li><span style="position:absolute;margin-left:-20px;">В</span><u><sup class="remark">наименование и адрес учреждения, куда направляется выписка</sup><input data-role="none" name="toOrg"></u></li>
		</ol>
		</div>

		<ol class="fields">
		<li>Фамилия, имя, отчество больного <u>{{client}}</u></li>
		<li>Дата рождения <u>{{bDate}}</u></li>
		<li>Дата поступления <u>{{s_date1}}</u></li>
		<li>Дата выбытия <u>{{s_date2}}</u></li>
		<div data-role="foreach" from="fields">
		<li>
			<a href='#del' class='del_fld'>Уд.</a>
			<input data-role="none" name="fld[]" value="{{fld}}">
			<u><textarea name="val[]">{{val}}</textarea></u>
		</li>
		</div>
		</ol>

<br>
{{docDate}}г.<br />
Лечащий врач _________________ /{{person}}/
<br />
</form>
</div>

</div>
</div>
</div>

<link rel="stylesheet" href="/style.css" />
<style>
@media screen {
#form-027u * {font-size:14px;}
#form-027u input {width:95%; font-style: italic; padding: 3px;}
#form-027u textarea {width:95%; resize:none; text-decoration:underline; font-style: italic; padding: 3px;}
#form-027u textarea.current, #form-027u input.current {border: 1px solid #000;}
#form-027u u {font-style: italic;}
#form-027u .text {line-height:32px; }
#form-027u .text .remark {position:absolute; width:100%; margin-top: 22px; text-align:center; font-size:70%;}
#form-027u table {border:0; border-top:1px #000 solid; border-bottom:1px #000 solid; clear:both; width: 100%; }
#form-027u table td {text-align:center; vertical-align:top;}
#form-027u table td:first-child {border-right:1px #000 solid;}
#form-027u table tr:first-child td:first-child {border-bottom:1px #000 solid;}
#form-027u h2 {text-align:center; font-size:18px;}
#form-027u h2 * {font-size:18px;}
#form-027u a.del_fld {position:absolute; margin-left: -25px; margin-top: 30px;;}
}

@media print {
body {display:none;}
#form-027u * {font-size:14px; }
#form-027u input {width:99%; font-style: italic; border:0; color: #000;}
#form-027u input[name=toOrg] {border-bottom: 1px #000 solid; text-align:center;}
#form-027u textarea {width:99%; resize:none; text-decoration:underline; font-style: italic; border:0; display:none;}
#form-027u u {font-style: italic;}
#form-027u .text {line-height:32px; }
#form-027u .text .remark {position:absolute; width:100%; margin-top: 15px; text-align:center; font-size:70%;}
#form-027u table {border:0; border-top:1px #000 solid; border-bottom:1px #000 solid; clear:both; width: 100%; }
#form-027u table td {text-align:center; vertical-align:top;}
#form-027u table td:first-child {border-right:1px #000 solid;}
#form-027u table tr:first-child td:first-child {border-bottom:1px #000 solid;}
#form-027u h2 {text-align:center; font-size:18px;}
#form-027u h2 * {font-size:18px;}
#form-027u a.del_fld {display:none;}
}
</style>
