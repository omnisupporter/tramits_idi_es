<?php
require_once 'conectar_a_bbdd.php';

$id = mysqli_real_escape_string($conn, $_POST["id"]);

$estado = mysqli_real_escape_string($conn, $_POST["estado"]);


$query = "UPDATE pindust_documentos_justificacion 
    SET  
    estado = '" . $estado . "'
    WHERE  id = " . $id;

$result = mysqli_query($conn, $query);

mysqli_close($conn);
echo $result;

?>