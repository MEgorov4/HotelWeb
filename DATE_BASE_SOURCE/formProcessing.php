<?php
session_start();
require_once 'connect.php';
require_once '../FUNCTIONS/dateOperations.php';

$RoomId = $_POST['RoomId'];
$StartDate = $_POST['StartDate'];
$DateEnd = $_POST['DateEnd'];
$result = $StartDate > $DateEnd;
$CountVisitors = $_POST['CountVisitors'];
if ($result) {
	$_SESSION['message'] = 'Дата начала больше даты окончания заезда';
	header("Location: ../postForm.php");
} else {

	if (IsOnDate($StartDate, $DateEnd, $RoomId, $connect)) {
		$_SESSION['message'] = 'Дата входит в радиус брони других клиентов';
		header("Location: ../postForm.php");
	} else {
		mysqli_query($connect, "INSERT INTO `booking` (`RoomId`, `StartDate`, `DateEnd`, `CountVisitors`) VALUES ( '$RoomId', '$StartDate', '$DateEnd', '$CountVisitors')");
		$_SESSION['message'] = 'Регистрация прошла успешно';
		header("Location: ../postForm.php");
	}


}
function IsOnDate($StartDate, $DateEnd, $RoomId, $connect): bool
{
	$queryDates = mysqli_fetch_all(mysqli_query($connect, "SELECT v_booking.StartDate, v_booking.DateEnd FROM `hotelrooms`,`v_booking` WHERE hotelrooms.id = '$RoomId'"));
	$CurrentRange = createDateRangeArray($StartDate, $DateEnd);
	foreach ($queryDates as $Dates) {
		foreach (createDateRangeArray($Dates[0], $Dates[1]) as $value) {
			foreach ($CurrentRange as $item) {
				if (strtotime($value) === strtotime($item)) {
					return true;
				}
			}
		}
	}
	return false;
}