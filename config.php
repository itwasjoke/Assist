<?php

header('Content-Type:text/html; charset=utf-8');
$host='localhost';
$user ='';
$password='';
$db = '';
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
