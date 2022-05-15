<?php
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

function getDay($pdate)
{
    $date = DateTime::createFromFormat("Y-m-d", $pdate);
    return $date->format("d");
}