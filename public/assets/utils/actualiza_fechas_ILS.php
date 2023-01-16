<?php
require_once 'conectar_a_bbdd.php';
$url =  $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$items = parse_url( $url);
$nuevosParametros = explode  ("/", $items['query']);

$query = "UPDATE pindust_expediente SET fecha_adhesion_ils = '" . $nuevosParametros[0] ."', 
fecha_seguimiento_adhesion_ils = '" . $nuevosParametros[1] ."', 
fecha_renovacion = '". $nuevosParametros[2] . "' WHERE  id = " . $nuevosParametros[3];
/* echo $query; */

$result = mysqli_query($conn, $query);
echo $result;
mysqli_close($conn);

?>