<?php
require_once 'conectar_a_bbdd.php';

$id = mysqli_real_escape_string($conn, $_POST["id"]);
$fecha_completado = mysqli_real_escape_string($conn, $_POST["fecha_completado"]);
$fecha_kick_off = mysqli_real_escape_string($conn, $_POST["fecha_kick_off"]);
$fecha_limite_consultoria = mysqli_real_escape_string($conn, $_POST["fecha_limite_consultoria"]);
$fecha_reunion_cierre = mysqli_real_escape_string($conn, $_POST["fecha_reunion_cierre"]);
$fecha_limite_justificacion = mysqli_real_escape_string($conn, $_POST["fecha_limite_justificacion"]);
$fecha_max_desp_ampliacion = mysqli_real_escape_string($conn, $_POST["fecha_max_desp_ampliacion"]);
$fecha_REC_amp_termino = mysqli_real_escape_string($conn, $_POST["fecha_REC_amp_termino"]);
$ref_REC_amp_termino = mysqli_real_escape_string($conn, $_POST["ref_REC_amp_termino"]);
$fecha_amp_termino = mysqli_real_escape_string($conn, $_POST["fecha_amp_termino"]);

/* Si hay / entonces convertir De 21/11/2021 08:00:00 a 2021-11-21 08:00:00 */
if (strpos($fecha_REC_amp_termino, "/") > 0) {
    $fecha_REC_amp_termino = explode(" ", $fecha_REC_amp_termino);
    $hora_REC_amp_termino = $fecha_REC_amp_termino[1];
    $fecha_fecha_REC_amp_termino = $fecha_REC_amp_termino[0];
    $fecha_fecha_REC_amp_termino = explode("/", $fecha_fecha_REC_amp_termino);
    $fecha_REC_amp_termino = $fecha_fecha_REC_amp_termino[2]."-".$fecha_fecha_REC_amp_termino[1]."-".$fecha_fecha_REC_amp_termino[0] ." ".$hora_REC_amp_termino;
}

if ( strlen($fecha_REC_amp_termino) != 0) {
    $date_REC_amp_termino = date_format(date_create($fecha_REC_amp_termino), "Y-m-d H:i:s");
} else {
    $date_REC_amp_termino = "";
}

if ( (strlen($date_REC_amp_termino) != 0) && ($date_REC_amp_termino > $fecha_completado)) {
    $fecha_completado = $date_REC_amp_termino;
}

$query = "UPDATE pindust_expediente 
    SET  
    fecha_kick_off = '" . $fecha_kick_off ."', 
    fecha_limite_consultoria = '" . $fecha_limite_consultoria ."', 
    fecha_reunion_cierre = '" . $fecha_reunion_cierre ."', 
    fecha_limite_justificacion = '" . $fecha_limite_justificacion ."', 
    fecha_max_desp_ampliacion = '" . $fecha_max_desp_ampliacion ."', 
    fecha_REC_amp_termino = '" . $date_REC_amp_termino ."',
    ref_REC_amp_termino = '" . mb_strtoupper($ref_REC_amp_termino) ."',
    fecha_completado = '" . $fecha_completado ."',
    fecha_amp_termino = '" . $fecha_amp_termino ."'

    WHERE  id = " . $id;
/* echo $query; */
$result = mysqli_query($conn, $query);
mysqli_close($conn);
echo $result;

?>