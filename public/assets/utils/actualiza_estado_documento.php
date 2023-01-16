<?php
require_once 'conectar_a_bbdd.php';

$id = mysqli_real_escape_string($conn, $_GET["id"]);

$estado = mysqli_real_escape_string($conn, $_GET["estado"]);

$query = "UPDATE pindust_documentos 
    SET  
    estado = '" . $estado . "'
    WHERE  id = " . $id;

$result = mysqli_query($conn, $query);
mysqli_close($conn);
echo $result;
?>