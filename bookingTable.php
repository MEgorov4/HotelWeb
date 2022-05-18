<?php
session_start();
require_once "DATE_BASE_SOURCE/connect.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <title>Document</title>
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th>Номер комнаты</th>
        <th>Начало заезда</th>
        <th>Конец заезда</th>
        <th>Количество человек</th>
        <th>Цена(за человека)</th>
        <th>Финальная Цена</th>
        <th>Количество дней</th>
    </tr>
    </thead>
	<?php
	$query = mysqli_query($connect, "SELECT * FROM v_booking");
	$query = mysqli_fetch_all($query);
	foreach ($query as $item) {
		echo '   
       <tbody>
            <tr>
                <td>' . $item[1] . '</td>
                <td>' . $item[2] . '</td>
                <td>' . $item[3] . '</td>
                <td>' . $item[4] . '</td>
                <td>' . $item[5] . '</td>
                <td>' . $item[6] . '</td>
                <td>' . $item[7] . '</td>
            </tr>
       </tbody>';
	}


	?>
</table>
<a href="MainPage.php">Главная</a>
</body>
</html>