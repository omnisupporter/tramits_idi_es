<?php
require_once 'conectar_a_bbdd.php';
echo "------". mysqli_real_escape_string($conn, $_POST["fecha_REC"])."-------";
$id = mysqli_real_escape_string($conn, $_POST["id"]); 
$empresa = mysqli_real_escape_string($conn, $_POST["empresa"]);
$email_rep = mysqli_real_escape_string($conn, $_POST["email_rep"]);
$nombre_rep = mysqli_real_escape_string($conn, $_POST["nombre_rep"]); 
$nif_rep = mysqli_real_escape_string($conn, $_POST["nif_rep"]);
$domicilio_rep = mysqli_real_escape_string($conn, $_POST["domicilio_rep"]);
$nom_consultor = mysqli_real_escape_string($conn, $_POST["nom_consultor"]);
$tel_consultor = mysqli_real_escape_string($conn, $_POST["tel_consultor"]); 
$tecnicoAsignado = mysqli_real_escape_string($conn, $_POST["tecnicoAsignado"]);
$situacion = mysqli_real_escape_string($conn, $_POST["situacion"]);
$importeAyuda = mysqli_real_escape_string($conn, $_POST["importeAyuda"]);
$porcentajeConcedido = mysqli_real_escape_string($conn, $_POST["porcentajeConcedido"]);
$fecha_de_pago = mysqli_real_escape_string($conn, $_POST["fecha_de_pago"]);
$fecha_REC = date('Y-m-d H:i:s', mysqli_real_escape_string($conn, $_POST["fecha_REC"])); //mysqli_real_escape_string($conn, $_POST["fecha_REC"]); //date_format(mysqli_real_escape_string($conn, $_POST["fecha_REC"]),"Y-m-d H:i:s"); 
$ref_REC = mysqli_real_escape_string($conn, $_POST["ref_REC"]);
$fecha_REC_enmienda = mysqli_real_escape_string($conn, $_POST["fecha_REC_enmienda"]); 
$ref_REC_enmienda = mysqli_real_escape_string($conn, $_POST["ref_REC_enmienda"]);
$fecha_requerimiento = mysqli_real_escape_string($conn, $_POST["fecha_requerimiento"]);
$fecha_requerimiento_notif = mysqli_real_escape_string($conn, $_POST["fecha_requerimiento_notif"]);
$fecha_infor_fav_desf = mysqli_real_escape_string($conn, $_POST["fecha_infor_fav_desf"]);
$fecha_propuesta_resolucion = mysqli_real_escape_string($conn, $_POST["fecha_propuesta_resolucion"]);
$fecha_propuesta_resolucion_notif = mysqli_real_escape_string($conn, $_POST["fecha_propuesta_resolucion_notif"]);
$fecha_resolucion = mysqli_real_escape_string($conn, $_POST["fecha_resolucion"]);
$fecha_notificacion_resolucion = mysqli_real_escape_string($conn, $_POST["fecha_notificacion_resolucion"]);
$fecha_kick_off = mysqli_real_escape_string($conn, $_POST["fecha_kick_off"]);
$fecha_limite_consultoria = mysqli_real_escape_string($conn, $_POST["fecha_limite_consultoria"]);
$fecha_reunion_cierre = mysqli_real_escape_string($conn, $_POST["fecha_reunion_cierre"]);
$fecha_limite_justificacion = mysqli_real_escape_string($conn, $_POST["fecha_limite_justificacion"]);
$fecha_max_desp_ampliacion = mysqli_real_escape_string($conn, $_POST["fecha_max_desp_ampliacion"]);
$fecha_max_desp_ampliacion = mysqli_real_escape_string($conn, $_POST["fecha_max_desp_ampliacion"]);
$fecha_REC_amp_termino = mysqli_real_escape_string($conn, $_POST["fecha_REC_amp_termino"]);
$ref_REC_amp_termino = mysqli_real_escape_string($conn, $_POST["ref_REC_amp_termino"]);
$fecha_amp_termino = mysqli_real_escape_string($conn, $_POST["fecha_amp_termino"]);
$fecha_REC_justificacion = mysqli_real_escape_string($conn, $_POST["fecha_REC_justificacion"]);
$ref_REC_justificacion = mysqli_real_escape_string($conn, $_POST["ref_REC_justificacion"]);
$fecha_res_liquidacion = mysqli_real_escape_string($conn, $_POST["fecha_res_liquidacion"]);
$fecha_not_liquidacion = mysqli_real_escape_string($conn, $_POST["fecha_not_liquidacion"]);
$fecha_firma_requerimiento_justificacion = mysqli_real_escape_string($conn, $_POST["fecha_firma_requerimiento_justificacion"]);
$fecha_REC_requerimiento_justificacion = mysqli_real_escape_string($conn, $_POST["fecha_REC_requerimiento_justificacion"]);
$ref_REC_requerimiento_justificacion = mysqli_real_escape_string($conn, $_POST["ref_REC_requerimiento_justificacion"]);
$fecha_REC_desestimiento = mysqli_real_escape_string($conn, $_POST["fecha_REC_desestimiento"]);
$ref_REC_desestimiento = mysqli_real_escape_string($conn, $_POST["ref_REC_desestimiento"]); 
$fecha_firma_resolucion_desestimiento = mysqli_real_escape_string($conn, $_POST["fecha_firma_resolucion_desestimiento"]);
$fecha_notificacion_desestimiento = mysqli_real_escape_string($conn, $_POST["fecha_notificacion_desestimiento"]);


$query = "UPDATE pindust_expediente 
    SET  
    empresa = '" . $empresa ."', 
    email_rep = '" . $email_rep ."', 
    nombre_rep = '" . $nombre_rep ."', 
    nif_rep = '" . $nif_rep ."', 
    domicilio_rep = '" . $domicilio_rep ."', 
    nom_consultor = '" . $nom_consultor ."', 
    tel_consultor = '" . $tel_consultor ."', 
    tecnicoAsignado = '" . $tecnicoAsignado ."', 
    situacion = '" . $situacion ."', 
    importeAyuda = '" . $importeAyuda ."', 
    porcentajeConcedido = '" . $porcentajeConcedido ."', 
    fecha_de_pago = '" . $fecha_de_pago ."', 
    fecha_REC = '" . $fecha_REC ."', 
    ref_REC = '" . $ref_REC ."', 
    fecha_REC_enmienda = '" . $fecha_REC_enmienda ."', 
    ref_REC_enmienda = '" . $ref_REC_enmienda ."', 
    fecha_requerimiento = '" . $fecha_requerimiento ."', 
    fecha_requerimiento_notif = '" . $fecha_requerimiento_notif ."', 
    fecha_infor_fav_desf = '" . $fecha_infor_fav_desf ."', 
    fecha_propuesta_resolucion = '" . $fecha_propuesta_resolucion ."', 
    fecha_propuesta_resolucion_notif = '" . $fecha_propuesta_resolucion_notif ."', 
    fecha_resolucion = '" . $fecha_resolucion ."', 
    fecha_notificacion_resolucion = '" . $fecha_notificacion_resolucion ."', 
    fecha_kick_off = '" . $fecha_kick_off ."',  
    fecha_limite_consultoria = '" . $fecha_limite_consultoria ."', 
    fecha_reunion_cierre = '" . $fecha_reunion_cierre ."', 
    fecha_limite_justificacion = '" . $fecha_limite_justificacion ."', 
    fecha_max_desp_ampliacion = '" . $fecha_max_desp_ampliacion ."', 
    fecha_REC_amp_termino = '" . $fecha_REC_amp_termino ."', 
    ref_REC_amp_termino = '" . $ref_REC_amp_termino ."', 
    fecha_amp_termino = '" . $fecha_amp_termino ."', 
    fecha_REC_justificacion = '" . $fecha_REC_justificacion ."', 
    ref_REC_justificacion = '" . $ref_REC_justificacion ."', 
    fecha_res_liquidacion = '" . $fecha_res_liquidacion ."', 
    fecha_not_liquidacion = '" . $fecha_not_liquidacion ."', 
    fecha_firma_requerimiento_justificacion = '" . $fecha_firma_requerimiento_justificacion ."', 
    fecha_REC_requerimiento_justificacion = '" . $fecha_REC_requerimiento_justificacion ."', 
    ref_REC_requerimiento_justificacion = '" . $ref_REC_requerimiento_justificacion ."', 
    fecha_REC_desestimiento = '" . $fecha_REC_desestimiento ."', 
    ref_REC_desestimiento = '" . $ref_REC_desestimiento ."', 
    fecha_firma_resolucion_desestimiento = '" . $fecha_firma_resolucion_desestimiento ."', 
    fecha_notificacion_desestimiento = '" . $fecha_notificacion_desestimiento ."'  
    WHERE  id = " . $id;
echo $query;
$result = mysqli_query($conn, $query);
echo $result;
mysqli_close($conn);

?>