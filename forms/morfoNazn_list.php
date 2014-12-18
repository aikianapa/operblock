<div data-role="page" data-theme="a" id="morfoNaznList" data-ajax="false">
<div data-role="header"><h2>Назначенные исследования</h2></div>
<div data-role="content" >

<div data-role="foreach" from="result">
<a href="/morfoNazn/edit/{{0}}.htm">{{id}} {{plannedEndDate}}</a><br />
</div>
	
</div>
</div>
