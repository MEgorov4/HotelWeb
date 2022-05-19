<?php
session_start();
require_once 'connect.php';
require_once '../FUNCTIONS/dateOperations.php';

$RoomId = $_POST['RoomId'];
$StartDate = $_POST['StartDate'];
$DateEnd = $_POST['DateEnd'];
$result = $StartDate > $DateEnd;
$CountVisitors = $_POST['CountVisitors'];

if (false) {
	$_SESSION['message'] = 'Дата начала больше даты окончания заезда';
} else {
	$queryDates = mysqli_fetch_all(mysqli_query($connect, "SELECT v_booking.StartDate, v_booking.DateEnd FROM `hotelrooms`,`v_booking` WHERE hotelrooms.id = '1'"));
	foreach ($queryDates as $Dates) {
		if((strtotime($DateEnd) <= strtotime($Dates[1]) && strtotime($StartDate) >= strtotime($Dates[0])) || ((strtotime($DateEnd) >= strtotime($Dates[1]) && strtotime($StartDate) <= strtotime($Dates[0]))))
		{
			
		}
	}


	mysqli_query($connect, "INSERT INTO `booking` ( `RoomId`, `StartDate`, `DateEnd`, `CountVisitors`) VALUES ( '$RoomId', '$StartDate', '$DateEnd', '$CountVisitors')");
	$_SESSION['message'] = 'Регистрация успешно завершена';
	header("Location: ../postForm.php");
}