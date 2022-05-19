<?php
function createDateRangeArray($strDateFrom, $strDateTo): array
{
	$aryRange = [];

	$iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
	$iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

	if ($iDateTo >= $iDateFrom) {
		$aryRange[] = date('Y-m-d', $iDateFrom);
		while ($iDateFrom < $iDateTo) {
			$iDateFrom += 86400;
			$aryRange[] = date('Y-m-d', $iDateFrom);
		}
	}
	return $aryRange;
}

function getYear($currentDate): string
{
	$date = DateTime::createFromFormat("Y-m-d", $currentDate);
	return $date->format("Y");
}
function swapDate($currentDate): string
{
	$date = DateTime::createFromFormat("d-m-Y", $currentDate);
	$date->format("Y-m-d");
	return $date;
}
function getMonth($currentDate): string
{
	$date = DateTime::createFromFormat("Y-m-d", $currentDate);
	return $date->format("m");
}

function IsDateInclude($Date, $DateArr): bool
{
	foreach ($DateArr as $date) {
		if ($Date == $date) {
			return true;
		}
	}
	return false;
}