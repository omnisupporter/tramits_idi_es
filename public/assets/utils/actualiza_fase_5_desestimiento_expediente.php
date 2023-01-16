<?php
require_once 'conectar_a_bbdd.php';
setlocale(LC_TIME,"es_ES");
$id = mysqli_real_escape_string($conn, $_POST["id"]); 
$fecha_completado = mysqli_real_escape_string($conn, $_POST["fecha_completado"]);
$fecha_REC_desestimiento = mysqli_real_escape_string($conn, $_POST["fecha_REC_desestimiento"]); 
$ref_REC_desestimiento = mysqli_real_escape_string($conn, $_POST["ref_REC_desestimiento"]); 
$fecha_firma_resolucion_desestimiento = mysqli_real_escape_string($conn, $_POST["fecha_firma_resolucion_desestimiento"]); 
$fecha_notificacion_desestimiento = mysqli_real_escape_string($conn, $_POST["fecha_notificacion_desestimiento"]);

/* Si hay / entonces convertir De 21/11/2021 08:00:00 a 2021-11-21 08:00:00 */
if (strpos($fecha_REC_desestimiento, "/") > 0) {
    $fecha_REC_desestimiento = explode(" ", $fecha_REC_desestimiento);
    $hora_REC_desestimiento = $fecha_REC_desestimiento[1];
    $fecha_fecha_REC_desestimiento = $fecha_REC_desestimiento[0];
    $fecha_fecha_REC_desestimiento = explode("/", $fecha_fecha_REC_desestimiento);
    $fecha_REC_desestimiento = $fecha_fecha_REC_desestimiento[2]."-".$fecha_fecha_REC_desestimiento[1]."-".$fecha_fecha_REC_desestimiento[0] ." ".$hora_REC_desestimiento;
}

if ( strlen($fecha_REC_desestimiento) != 0) {
    $date_REC_REC_desestimiento = date_format(date_create($fecha_REC_desestimiento), "Y-m-d H:i:s");
} else {
    $date_REC_REC_desestimiento = "";
}

if ( (strlen($date_REC_REC_desestimiento) != 0) && ($date_REC_REC_desestimiento > $fecha_completado)) {
    $fecha_completado = $date_REC_REC_desestimiento;
}


$query = "UPDATE pindust_expediente 
    SET  
    fecha_REC_desestimiento = '" .$date_REC_REC_desestimiento ."',
    ref_REC_desestimiento = '" . mb_strtoupper($ref_REC_desestimiento) ."',
    fecha_firma_resolucion_desestimiento = '" . $fecha_firma_resolucion_desestimiento ."',
    fecha_completado = '" . $fecha_completado ."',
    fecha_notificacion_desestimiento = '" . $fecha_notificacion_desestimiento ."'
    WHERE  id = " . $id;
/* echo $query; */
$result = mysqli_query($conn, $query);
mysqli_close($conn);
echo $result;

?>