﻿<?php

$mysqlhost = '127.0.0.1';
$username = 'prezasq59klvbzx';
$password = 'I923QVVlI923QVVl';
$dbname = 'pretramitidi';

// Crear la conexión

$conn = mysqli_connect($mysqlhost, $username, $password, $dbname);

// Comprobar si se ha conectado correctamente.

if (!$conn) {

    die("Connexió fallida: " . mysqli_connect_error());

}
// Change character set to utf8
mysqli_set_charset($conn,"utf8");
// echo "Connected successfully";
return $conn;

// mysqli_close($conn);
?>