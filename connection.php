<?php
$data = new PDO( "mysql:host=$host;dbname=$db",$user, $db_password) or die('не удалось подключиться к базе данных');