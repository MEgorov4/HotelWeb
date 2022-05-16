<?php
require_once 'DATE_BASE_SOURCE/connect.php';
function createDateRangeArray($strDateFrom,$strDateTo)
{
    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom));
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400;
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}
function getYear($pdate)
{
    $date = DateTime::createFromFormat("Y-m-d", $pdate);
    return $date->format("Y");
}

function getMonth($pdate)
{
    $date = DateTime::createFromFormat("Y-m-d", $pdate);
    return $date->format("m");
}
function IsDateInclude($Date,$DateArr)
{
    foreach ($DateArr as $date)
    {
        if ($Date == $date)
        {
            return true;
        }
    }
    return false;
}