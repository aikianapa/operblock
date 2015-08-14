<div id="tables">
	<div class="drag-zone-apps common-list">
		<ul class="ui-draggable ui-sortable" id="common-list">
		<div data-role="foreach" from="result">
		<li tid='{{table}}' class="status-{{status}}" oid="{{orgid}}" aid="{{id}}"  title="{{id}}" idx="{{index}}">
			<a href="#" title="{{id}}">
			<span class="ui-hidden">{{tooltip}}</span>
			Пациент: {{client}}<br />
			Хирург: {{person}}</a>
			<div class="warn">
			<div class="time">{{begTime}}</div>
			<div class="blood-warn-{{blood_warning}} ui-red">!</div>
			<div class="urgent-warn-{{isUrgent}} ui-red">Э</div>
			</div>
			</li>
		</div>
		</ul>
	</div>

<div class="drag-zone-apps common-tables">
<ul id="common-tables" class="ui-draggable ui-sortable" > 
<div data-role="foreach" from="optables"> 
		<div class="drag-zone-apps table-drop">
		<a href="#opMenu" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-icon-left">{{name}}</a>
		<ul class="ui-draggable ui-sortable table" id="table-{{tid}}" tid="{{tid}}" oid="{{oid}}" opr="{{opr}}" idx="{{idx}}">
		</ul>
</div>

</div> 
</ul>
</div>
</div>
<div id="oprooms">
<div data-role="header"><h3>Операционные</h3></div> 
	<div data-role="foreach" from="oprooms">
		<div class="drag-zone-apps oproom-drop"> 
		<a href="#oproomMenu" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-icon-left">{{name}}</a>
		<ul class="ui-draggable ui-sortable oproom" id="oproom-{{id}}" oid="{{id}}">
		</ul>
		</div>
	</div>
</div>
