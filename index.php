<?php
session_start()
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"userdb
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Document</title>
</head>
<body>
<form action="Connection/postform.php" method="post">
    <p>Начало заезда<input type="Date" required name="StartDate" ></p>
    <p>Конец заезда<input type="Date" required name="DateEnd" ></p>
    <p>Количество человек<input type="" required name="CountVisitors" placeholder="Укажите количество человек"></p>
    <p> Выберите номер<select name="RoomId">
        <?php
        require_once 'Connection/connect.php';
        $query = mysqli_query($connect, "SELECT * FROM `hotelrooms`");
        $query = mysqli_fetch_all($query);
        foreach ($query as $item)
        {
            echo '<option value = '.$item[0].'>'.$item[1].'</option>';
        }
        ?>
    </select></p>
    <button type="submit">Оформить</button>
    <p>Просмотреть заказы:<a href="ShowTable.php">Заказы</a></p>
    <p>Просмотреть заказы:<a href="ShowTable.php">Шахматка</a></p>
            <?php
            if (isset($_SESSION['message']))
            {
                echo '<p class="msg">'.$_SESSION['message'].'</p>';
            }
            unset($_SESSION['message']);
            ?>
</form>

</body>
</html>