<?php
require_once 'Functions/DateSplit.php';

function build_calendar($month,$year,$arrOfDays) {
    
    $daysOfWeek = array('Пн','Вт','Ср','Чт','Пт','Сб','Вс');

    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    $numberDays = date('t',$firstDayOfMonth);

    $dateComponents = getdate($firstDayOfMonth);

    $monthName = $dateComponents['month'];

    $dayOfWeek = $dateComponents['wday'];


    $calendar = "<div class='calendar'><table>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr class='week'>";


    foreach($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }


    $currentDay = 1;

    $calendar .= "</tr><tr>";


    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {


        if ($dayOfWeek == 7) {

            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";

        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

        $date = "$year-$month-$currentDayRel";
        if (IsDateInclude($date,$arrOfDays))
        {
            $calendar .= "<td class='busy_day' rel='$date'>$currentDay</td>";
        }
        else
        {
            $calendar .= "<td class='day' rel='$date'>$currentDay</td>";
        }



        $currentDay++;
        $dayOfWeek++;

    }


    if ($dayOfWeek != 7) {

        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";

    }

    $calendar .= "</tr>";

    $calendar .= "</table></div>";

    return $calendar;

}

?>


