<?php
$estadoDocs = "";
require_once 'conectar_a_bbdd.php';
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$query = "SELECT id, corresponde_documento, estado  FROM pindust_documentos WHERE (id_sol = " . $id ." AND docRequerido = 'SI')";
$result = mysqli_query($conn, $query);
if ( $result ) {

    while( $obj = $result->fetch_object() ){
        /* $line.=$obj->estado."#".$obj->corresponde_documento; */
        $line.=$obj->estado;
        $estadoDocs .= $line.",";
        $line = "";
    }
    $estadoDocs = substr($estadoDocs, 0, -1);
}

mysqli_close($conn);
echo $estadoDocs;
?>