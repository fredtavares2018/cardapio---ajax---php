<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'seu_banco';

$conn = mysqli_connect($servername, $username, $password, $database);

?>
