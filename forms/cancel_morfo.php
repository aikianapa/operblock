<div data-role="popup" data-theme="a" id="cancelOp" datatransition="flip" data-ajax="false">
<div data-role="header"><h2>Отмена исследования</h2><a href="#" data-rel="back" class="ui-btn ui-btn-inline ui-btn-icon-notext ui-icon-delete ui-btn-right ui-corner-all">Back</a></div>

<div data-role="content" >
<form>
<input type="hidden" name="person_id">
<input type="hidden" name="action_id">
<div class="filter">
Отменить исследование: 
    <select id="filter" name="filter" data-role="flipswitch" data-inline="true" >
        <option selected="" value="0">Нет</option> 
        <option value="1">Да</option>
    </select> 
</div>
<div data-role="fieldcontain"><label>Причина</label><textarea name="cancelNote" required></textarea></div> 
<a href="" data-ajax="false" class="cancel_op ui-btn ui-corner-all">Отменить исследование</a>
</form>
</div>

</div>


