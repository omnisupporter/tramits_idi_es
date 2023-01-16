<?php
require_once 'conectar_a_bbdd.php';

$id = mysqli_real_escape_string($conn, $_POST["id"]); 

$fecha_infor_fav_desf = mysqli_real_escape_string($conn, $_POST["fecha_infor_fav_desf"]);
$fecha_propuesta_resolucion = mysqli_real_escape_string($conn, $_POST["fecha_propuesta_resolucion"]);
$fecha_propuesta_resolucion_notif = mysqli_real_escape_string($conn, $_POST["fecha_propuesta_resolucion_notif"]);
$fecha_resolucion = mysqli_real_escape_string($conn, $_POST["fecha_resolucion"]);
$fecha_requerimiento = mysqli_real_escape_string($conn, $_POST["fecha_requerimiento"]);
$fecha_notificacion_resolucion = mysqli_real_escape_string($conn, $_POST["fecha_notificacion_resolucion"]);

$query = "UPDATE pindust_expediente 
    SET  
    fecha_infor_fav_desf = '" . $fecha_infor_fav_desf ."', 
    fecha_propuesta_resolucion = '" . $fecha_propuesta_resolucion ."', 
    fecha_propuesta_resolucion_notif = '" . $fecha_propuesta_resolucion_notif ."', 
    fecha_resolucion = '" . $fecha_resolucion ."', 
    fecha_requerimiento = '" . $fecha_requerimiento ."', 
    fecha_notificacion_resolucion = '" . $fecha_notificacion_resolucion ."'
    WHERE  id = " . $id;

$result = mysqli_query($conn, $query);
mysqli_close($conn);
echo $result;

?>