<?php
include('db_data.php');
//$data = new PDO( "mysql:host=$host;dbname=$db",$user, $db_password) or die('не удалось подключиться к базе данных');
$data = mysqli_connect($host, $user, $db_password, $db);