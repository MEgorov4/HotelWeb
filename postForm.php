<?php
session_start();
require_once 'DATE_BASE_SOURCE/connect.php';
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
<h1 id="Header">Оформление заказа</h1>
<form class="Booking" action="DATE_BASE_SOURCE/formProcessing.php" method="post">
    <p>Начало заезда <input type="Date" required name="StartDate"></p>
    <p>Конец заезда <input type="Date" required name="DateEnd"></p>
    <p>Количество человек <input type="" required name="CountVisitors" placeholder="Укажите кол-во человек"></p>
    <p> Выберите номер
        <select name="RoomId">
			<?php


			$query = mysqli_query($connect, "SELECT * FROM `hotelrooms`");
			$query = mysqli_fetch_all($query);

			foreach ($query as $item) {
				echo '<option value = ' . $item[0] . '>' . $item[1] . '</option>';
			}
			?>
        </select></p>
    <button type="submit">Оформить</button>
    <p>Просмотреть заказы: <a href="bookingTable.php">Заказы</a></p>
    <p>Просмотреть заказы: <a href="employmentСhart.php">Шахматка</a></p>
	<?php
	if (isset($_SESSION['message'])) {
		echo '<p class="msg">' . $_SESSION['message'] . '</p>';
	}
	unset($_SESSION['message']);
	?>
</form>

</body>
</html>