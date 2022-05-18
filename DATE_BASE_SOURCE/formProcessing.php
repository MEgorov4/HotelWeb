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
	$CurrentDatesArr = createDateRangeArray(strtotime($StartDate),strtotime($DateEnd),);
	$StartDate = date_create_from_format('d-m-Y', strtotime($StartDate))->format('Y-m-d');
	foreach ($queryDates as $Dates) {
		foreach (createDateRangeArray($Dates[0], $Dates[1]) as $item) {
			foreach ($CurrentDatesArr as $Date) {
				if ($Date == $item) {
					$_SESSION['message'] = 'В это время номер забронирован';
					header("Location: ../postForm.php");
				}
			}
		}
	}


	mysqli_query($connect, "INSERT INTO `booking` ( `RoomId`, `StartDate`, `DateEnd`, `CountVisitors`) VALUES ( '$RoomId', '$StartDate', '$DateEnd', '$CountVisitors')");
	$_SESSION['message'] = 'Регистрация успешно завершена';
	header("Location: ../postForm.php");
}