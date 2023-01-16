<?php
require_once 'conectar_a_bbdd.php';
$textoMotivo = mysqli_real_escape_string($conn, $_POST["textoMotivo"]);
$query = "UPDATE pindust_expediente SET motivoDenegacion = '" . $textoMotivo . "' WHERE  id = " . $_POST["id"];
$result = mysqli_query($conn, $query);
//mysqli_close($conn);
echo $result;
?>