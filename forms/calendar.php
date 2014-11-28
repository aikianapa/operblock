<?
include_once($_SERVER['DOCUMENT_ROOT']."/engine/phpQuery/phpQuery.php");
include_once($_SERVER['DOCUMENT_ROOT']."/engine/functions.php");
engineSettingsRead();
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
include($_SERVER["DOCUMENT_ROOT"]."/functions.php");
/* Функция генерации календаря */
function draw_calendar($month,$year){
	$mon=array("","январь","февраль","март","апрель","май","июнь","июль","август","сентябрь","октябрь","ноябрь","декабрь");
	$head=$mon[$month]." ".$year;
  /* Начало таблицы */
  $calendar = '<h2>'.$head.'</h2><table cellpadding="0" cellspacing="3" class="calendar">';
  /* Заглавия в таблице */
  $headings = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head ui-header ui-bar-inherit">'.implode('</td><td class="calendar-day-head ui-header ui-bar-inherit">',$headings).'</td></tr>';
  /* необходимые переменные дней и недель... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $running_day = $running_day - 1;
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();
  /* первая строка календаря */
  $calendar.= '<tr class="calendar-row">';
  /* вывод пустых ячеек в сетке календаря */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;
  /* дошли до чисел, будем их писать в первую строку */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
    $calendar.= '<td class="calendar-day day-'.$list_day.' ui-btn ui-corner-all">';
      /* Пишем номер в ячейку */
      $calendar.= '<div class="day-number ui-btn  ui-shadow">'.$list_day.'</div>';
      /** ЗДЕСЬ МОЖНО СДЕЛАТЬ MySQL ЗАПРОС К БАЗЕ ДАННЫХ! ЕСЛИ НАЙДЕНО СОВПАДЕНИЕ ДАТЫ СОБЫТИЯ С ТЕКУЩЕЙ - ВЫВОДИМ! **/

	$date="$year-$month-$list_day";
      //$calendar.= "<p></p>";
      
    $calendar.= '</td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;
  /* Выводим пустые ячейки в конце последней недели */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;
  /* Закрываем последнюю строку */
  $calendar.= '</tr>';
  /* Закрываем таблицу */
  $calendar.= '</table>';
  
  /* Все сделано, возвращаем результат */
  $calendar=phpQuery::newDocumentHTML($calendar);
  $calendar=monthData($month,$year,$calendar);
  return $calendar->htmlOuter();
}

function monthData($month,$year,$calendar) {
$oper=json_decode(getOperationsByDate($month,$year,$_GET["oid"]),1);
	// status 0 - (серый) назначена
	// status 1 - (зелёный) утверждена замглавврача
	// status 2 - (синий) проведена
	// stasus 3 - (красный) отменена
	// status 4 - (жёлтый) утверждена завотдел и старшей сестрой
$stext=array("запланирована","в ожидании","проведена","отменена","утверждена");
foreach ($oper as $day => $data) {
	$day=$day*1;
	pq($calendar)->find("td.day-$day")->append("<ul>");
	$count=0;
	foreach($data as $status => $qnt) {
		$li="<li class='status-$status'>$stext[$status]: $qnt</li>";
		$count+=$qnt;
		pq($calendar)->find("td.day-$day ul")->append($li);
	}
	if ($count>0) {pq($calendar)->find("td.day-$day ul")->append("<li class='total'>Всего: $count</li>");}
}

return $calendar;
}

/* СПОСОБ ПРИМЕНЕНИЯ */
if ($_GET["date"]>"") {
	$date=strtotime($_GET["date"]);
	$month=date("m",$date); $year=date("Y",$date);
} else { $month=date("m"); $year=date("Y"); }
echo draw_calendar($month,$year);
?>
