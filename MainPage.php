<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/MainPage.css">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

    <title>Document</title>
</head>
<body>
<h1 id="Header">Главная</h1>
<table class="table">
    <thead>
    <tr>
        <th>Номер комнаты</th>
        <th>Тип комнаты</th>
        <th>Стоимость</th>
        <th>Внешний вид номера</th>
    </tr>
    </thead>
    <?php
    require_once 'DATE_BASE_SOURCE/connect.php';
    $query = mysqli_query($connect,"SELECT * FROM hotelrooms");
    $query = mysqli_fetch_all($query);
    foreach ($query as $item)
    {
        echo '   
       <tbody>
            <tr>
                <td>'.$item[1].'</td>
                <td>'.$item[2].'</td>
                <td>'.$item[3].'</td>
                <td><img class="image" src=" '.$item[4].' "></td>
            </tr>
       </tbody>';
    }


    ?>
</table>
<nav class="breadcrumb" aria-label="breadcrumb">
    <ul>
        <li><a href="MainPage.php">Главная</a></li>
        <li><a href="postForm.php">Оформление заказа</a></li>
        <li><a href="bookingTable.php">Шахматка</a></li>
    </ul>
</nav>
</body>
</html>