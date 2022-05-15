<?php
require_once 'Functions/CalendarBuilder.php';
require_once 'Functions/DateSplit.php';
require_once 'Connection/connect.php';
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
$query = mysqli_query($connect,"SELECT * FROM `v_booking`");
$query = mysqli_fetch_all($query);
foreach ($query as $item)
{
    $year = getYear(($item[2]));
    $month = getMonth($item[2]);

    echo build_calendar($month,$year);
}





?>
</body>
</html>

