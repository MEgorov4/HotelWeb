<?php
$connect = mysqli_connect('localhost','root','','userdb');
if(!$connect)
{
    die('MysqlError');
}