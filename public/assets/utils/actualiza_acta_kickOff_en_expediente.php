<?php
require_once 'conectar_a_bbdd.php';

$actaNumKickOff = mysqli_real_escape_string($conn, $_POST["actaNumKickOff"]);
$fecha_kick_off = mysqli_real_escape_string($conn, $_POST["fecha_kick_off"]);
$horaInicioSesionKickOff = mysqli_real_escape_string($conn, $_POST["horaInicioSesionKickOff"]);  
$horaFinSesionKickOff = mysqli_real_escape_string($conn, $_POST["horaFinSesionKickOff"]);
$lugarSesionKickoff  = mysqli_real_escape_string($conn, $_POST["lugarSesionKickoff"]);
$asistentesKickOff = mysqli_real_escape_string($conn, $_POST["asistentesKickOff"]);
$tutorKickOff = mysqli_real_escape_string($conn, $_POST["tutorKickOff"]);
$plazoRealizacionPlan = mysqli_real_escape_string($conn, $_POST["plazoRealizacionPlan"]); 
$fecha_HastaRealizacionPlan = mysqli_real_escape_string($conn, $_POST["fecha_HastaRealizacionPlan"]);
$observacionesKickOff = mysqli_real_escape_string($conn, $_POST["observacionesKickOff"]);

$query = "UPDATE pindust_expediente SET actaNumKickOff = '" . $actaNumKickOff . "',
                    fecha_kick_off = '" . $fecha_kick_off . "',
                    horaInicioSesionKickOff = '" . $horaInicioSesionKickOff . "',
                    horaFinSesionKickOff = '" . $horaFinSesionKickOff . "',
                    lugarSesionKickoff =  '" . $lugarSesionKickoff . "',
                    asistentesKickOff = '" . $asistentesKickOff . "',
                    tutorKickOff = '" . $tutorKickOff . "',
                    plazoRealizacionPlan = '" . $plazoRealizacionPlan . "',
                    fecha_HastaRealizacionPlan = '" . $fecha_HastaRealizacionPlan . "',
                    observacionesKickOff = '" . $observacionesKickOff . "'

    WHERE  id = " . $_POST["id"];
// echo "#".$query."#";
$result = mysqli_query($conn, $query);
echo $result;
mysqli_close($conn);
?>