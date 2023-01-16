<?php
require_once 'conectar_a_bbdd.php';
$textoMotivoRenuncia = mysqli_real_escape_string($conn, $_POST["textoMotivoRenuncia"]);
$query = "UPDATE pindust_expediente SET motivoDesestimientoRenuncia = '" . $textoMotivoRenuncia . "' WHERE  id = " . $_POST["id"];

$result = mysqli_query($conn, $query);
//mysqli_close($conn);
echo $result;
?>