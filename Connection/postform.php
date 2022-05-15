<?php
session_start();
require_once 'connect.php';

$RoomId = $_POST['RoomId'];
$StartDate = $_POST['StartDate'];
$DateEnd = $_POST['DateEnd'];
$result = $StartDate > $DateEnd;
$CountVisitors = $_POST['CountVisitors'];


if ($result)
{
    $_SESSION['message'] = 'Дата начала больше даты окончания заезда';
    header("Location: ../index.php");

}
else
{
    mysqli_query($connect, "INSERT INTO `booking` ( `RoomId`, `StartDate`, `DateEnd`, `CountVisitors`) VALUES ( '$RoomId', '$StartDate', '$DateEnd', '$CountVisitors')");
    header("Location: ../index.php");
}