<?php
require_once 'DATE_BASE_SOURCE/connect.php';
require_once 'FUNCTIONS/calendarBuilder.php';
require_once 'FUNCTIONS/dateOperations.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/employmentСhart.css" type="text/css">
    <title>Document</title>
</head>
<body>

<?php


$queryRooms = mysqli_query($connect, "SELECT * FROM `hotelrooms`");
$queryRooms = mysqli_fetch_all($queryRooms);

echo '<div class="calendarMassive">';
foreach ($queryRooms as $item)
{
    BuildCalendarForRoom($item[1], $connect);
}
echo '</div>';

function BuildCalendarForRoom($selectRoom, $connect): void
{
    $arrOfDays = array();
    $years = array();
    $months = array();

    $query = mysqli_query($connect,"SELECT * FROM `v_booking` WHERE RoomNumer = $selectRoom");
    $query = mysqli_fetch_all($query);
    foreach ($query as $item)
    {
        $years[] = getYear(($item[2]));
        foreach (createDateRangeArray($item[2],$item[3]) as $Date)
        {
            $arrOfDays[] = $Date;
        }
    }

    $count = 0;
    while (true)
    {
        $month = date('m',strtotime("+".$count." month"));
        $months[] = $month;
        $count = $count + 1;
        if ($count == 12)
        {
            break;
        }
    }

    $years = array_unique($years);
    $months = array_unique($months);
    echo '<div><h1>Room:'.$selectRoom.'</h1>';
    foreach ($years as $year)
    {
        foreach ($months as $month)
        {
            echo build_calendar($month,$year,$arrOfDays);
        }
    }
    echo '</div>';
}
?>
<a href="postForm.php">Перейдите в форму</a>
</body>
</html>

