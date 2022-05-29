<?php

header('Content-Type:text/html; charset=utf-8');
$host='localhost';
$user ='u99924i2_db';
$password='hsBt3&9g';
$db = 'u99924i2_db';
$con=mysqli_connect($host, $user, $password, $db);
if ($con) {
    // echo 'yes';
}
else{
    // echo 'no'; 
}
session_start();
ob_start();
?>
