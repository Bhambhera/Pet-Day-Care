<?php
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'petdaycaredatabase');

if (!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}