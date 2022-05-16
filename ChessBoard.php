<?php
require_once 'Connection/connect.php';

require_once 'Functions/CalendarBuilder.php';
require_once 'Functions/DateSplit.php';
require_once 'Functions/DBfunc.php'

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/ChessBoard.css" type="text/css">
    <title>Document</title>
</head>
<body>
<?php

$queryRooms = mysqli_query($connect, "SELECT * FROM `hotelrooms`");
$queryRooms = mysqli_fetch_all($queryRooms);
echo '<div class="calendarMassive">';
foreach ($queryRooms as $item)
{
    BildCalendarForRoom($item[1], $connect);
}
echo '</div>';
function BildCalendarForRoom($selectRoom, $connect)
{
    $arrOfDays = array();
    $years = array();
    $months = array();

    $query = mysqli_query($connect,"SELECT * FROM `v_booking` WHERE RoomNumer = $selectRoom");
    $query = mysqli_fetch_all($query);
    foreach ($query as $item)
    {
        array_push($years,getYear(($item[2])));
        foreach (createDateRangeArray($item[2],$item[3]) as $Date)
        {
            array_push($arrOfDays,$Date);
        }
    }
    $count = 0;
    while (true)
    {
        $month = date('m',strtotime("+".$count." month"));
        array_push($months,$month);
        $count = $count + 1;
        if ($month =='12')
        {
            break;
        }
    }

    $years = array_unique($years);
    $months = array_unique($months);
    echo '<div><p>room:'.$selectRoom.'</p>';
    foreach ($months as $month)
    {
        $year = $years[0];
        echo build_calendar($month,$year,$arrOfDays);
    }


    echo '</div>';
}
?>
<a href="index.php">Перейдите в форму</a>
</body>
</html>

