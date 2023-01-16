<?php
require_once 'conectar_a_bbdd.php';
$query = "UPDATE pindust_expediente SET situacion = '" . $_POST["situacion"] . "' WHERE  id = " . $_POST["id"];
$result = mysqli_query($conn, $query);
echo $query;
?>