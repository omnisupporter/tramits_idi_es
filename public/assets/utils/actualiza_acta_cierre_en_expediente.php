<?php
require_once 'conectar_a_bbdd.php';

$actaNumCierre = mysqli_real_escape_string($conn, $_POST["actaNumCierre"]);
$fecha_reunion_cierre = mysqli_real_escape_string($conn, $_POST["fecha_reunion_cierre"]);
$horaInicioActaCierre = mysqli_real_escape_string($conn, $_POST["horaInicioActaCierre"]);  
$horaFinActaCierre = mysqli_real_escape_string($conn, $_POST["horaFinActaCierre"]);
$lugarActaCierre = mysqli_real_escape_string($conn, $_POST["lugarActaCierre"]);
$asistentesActaCierre = mysqli_real_escape_string($conn, $_POST["asistentesActaCierre"]);
$fecha_limite_justificacion_modal = mysqli_real_escape_string($conn, $_POST["fecha_limite_justificacion_modal"]); 
$observacionesActaCierre = mysqli_real_escape_string($conn, $_POST["observacionesActaCierre"]);

$query = "UPDATE pindust_expediente SET actaNumCierre = '" . $actaNumCierre . "',
                    fecha_reunion_cierre = '" . $fecha_reunion_cierre . "',
                    horaInicioActaCierre = '" . $horaInicioActaCierre . "',
                    horaFinActaCierre = '" . $horaFinActaCierre . "',
                    lugarActaCierre = '" . $lugarActaCierre . "',
                    asistentesActaCierre = '" . $asistentesActaCierre . "',
                    fecha_justificacion_ayuda_acta_cierre = '" . $fecha_limite_justificacion_modal . "',
                    observacionesActaCierre = '" . $observacionesActaCierre . "'

    WHERE  id = " . $_POST["id"];
// echo "#".$query."#";
$result = mysqli_query($conn, $query);
// mysqli_close($conn);
echo $result;
?>