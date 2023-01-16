<?php
require_once 'conectar_a_bbdd.php';
$textoMotivoDenegacion = mysqli_real_escape_string($conn, $_POST["textoMotivoDenegacion"]); 
$query = "UPDATE pindust_expediente SET motivoDenegacion = '" . $textoMotivoDenegacion . "' WHERE  id = " . $_POST["id"];
$result = mysqli_query($conn, $query);
echo $result;
mysqli_close($conn);
?>