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
<form action="index.php">
<select name="room">
    <?php
        $queryHotelrooms = mysqli_query($connect, "SELECT * FROM `hotelrooms`");
        $queryHotelrooms = mysqli_fetch_all($queryHotelrooms);
        foreach ($queryHotelrooms as $item)
        {
            echo "<option value='$item[0]'>$item[1]</option>";
        }
        /*$selectRoomId = $_POST['room'];*/
    ?>
</select>
</form>
<?php
$arrOfDays = array();
$years = array();
$months = array();

$query = mysqli_query($connect,"SELECT * FROM `v_booking`");
$query = mysqli_fetch_all($query);
foreach ($query as $item)
{
    array_push($years,getYear(($item[2])));
    array_push($months,getMonth($item[2]));

    foreach (createDateRangeArray($item[2],$item[3]) as $Date)
    {
        array_push($arrOfDays,$Date);
    }

}
$years = array_unique($years);
$months = array_unique($months);
foreach ($months as $month)
{
    $year = $years[0];
    echo build_calendar($month,$year,$arrOfDays);
}
?>
<a href="index.php">Перейдите в форму</a>
</body>
</html>

