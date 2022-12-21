<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'iteh_domaci1';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
  die('Konekcija neuspela ' . mysqli_connect_error());
}
?>