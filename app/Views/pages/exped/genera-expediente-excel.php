<?php
date_default_timezone_set("Europe/Madrid");
$fechaCreacion = str_replace("/","_", date("Y/m/d h:s"));
// header('Content-type: application/vnd.ms-excel;charset=utf-8');
header('Content-type: application/vnd.ms-excel;charset=UTF-16LE');

header("Content-Disposition: attachment; filename=listado-control-auditores_". $fechaCreacion .".xls");

header("Pragma: no-cache");

header("Expires: 0");

if ($expedientes) { 
   
   $print = "<table><tr>
   
   <td><strong>idExp</strong></td>
   <td><strong>convocatoria</strong></td>
   <td><strong>tipo_tramite</strong></td>
   <td><strong>situacion</strong></td>
   <td><strong>nif</strong></td>
   <td><strong>empresa</strong></td>
   <td><strong>domicilio</strong></td>
   <td><strong>localidad</strong></td>
   <td><strong>cpostal</strong></td>
   <td><strong>telefono</strong></td>
   <td><strong>iae</strong></td>
   <td><strong>importeAyuda</strong></td>
   <td><strong>porcentajeConcedido</td>
   <td><strong>fecha_acta_cierre</strong></td>
   <td><strong>fecha_REC</strong></td>
   <td><strong>fecha_REC_enmienda</strong></td>
   <td><strong>fecha_REC_amp_termino</strong></td>
   <td><strong>fecha_REC_justificacion</strong></td>
   <td><strong>fecha_REC_requerimiento_justificacion</strong></td>
   <td><strong>fecha_REC_desestimiento</strong></td>
   <td><strong>fecha_enmienda</strong></td>
   <td><strong>fecha_kick_off</strong></td>
   <td><strong>fecha_completado</strong></td>
   <td><strong>fecha_limite_consultoria</strong></td>
   <td><strong>fecha_reunion_cierre</strong></td>
   <td><strong>fecha_limite_justificacion</strong></td>
   <td><strong>fecha_propuesta_resolucion</strong></td>
   <td><strong>fecha_propuesta_resolucion_notif</strong></td>
   <td><strong>fecha_resolucion</strong></td>
   <td><strong>fecha_notificacion_resolucion</strong></td>
   <td><strong>fecha_requerimiento</strong></td>
   <td><strong>fecha_requerimiento_notif</strong></td>
   <td><strong>fecha_firma_requerimiento_justificacion</strong></td>
   <td><strong>fecha_firma_resolucion_desestimiento</strong></td>
   <td><strong>fecha_notificacion_desestimiento</strong></td>
   <td><strong>fecha_infor_fav_desf</strong></td>
   <td><strong>fecha_amp_termino</strong></td>
   <td><strong>fecha_res_liquidacion</strong></td>
   <td><strong>fecha_not_liquidacion</strong></td>
   <td><strong>fecha_justificacion_ayuda_acta_cierre</strong></td>
   <td><strong>fecha_de_pago</strong></td>
   <td><strong>fecha_max_desp_ampliacion</strong></td>
   <td><strong>ref_REC</strong></td>
   <td><strong>ref_REC_enmienda</strong></td>
   <td><strong>ref_REC_amp_termino</strong></td>
   <td><strong>ref_REC_justificacion</strong></td>
   <td><strong>ref_REC_requerimiento_justificacion</strong></td>
   <td><strong>ref_REC_desestimiento</strong></td>
   <td><strong>importe_minimis</strong></td>
   <td><strong>tecnicoAsignado</strong></td>
  
   </tr>";  

     foreach ($expedientes as $item) { 
       
        $print .= "<tr>
        
            <td>".$item['idExp']."</td>
            <td>".$item['convocatoria']."</td>
            <td>".$item['tipo_tramite']."</td>
            <td>".$item['situacion']."</td>
            <td>".$item['nif']."</td>
            <td>".$item['empresa']."</td>
            <td>".$item['domicilio']."</td>
            <td>".$item['localidad']."</td>
            <td>".$item['cpostal']."</td>
            <td>".$item['telefono']."</td>
            <td>".$item['iae']."</td>
            <td>".$item['importeAyuda']."</td>
            <td>".$item['porcentajeConcedido']."</td>
            <td>".$item['fecha_acta_cierre']."</td>
            <td>".$item['fecha_REC']."</td>
            <td>".$item['fecha_REC_enmienda']."</td>
            <td>".$item['fecha_REC_amp_termino']."</td>
            <td>".$item['fecha_REC_justificacion']."</td>
            <td>".$item['fecha_REC_requerimiento_justificacion']."</td>
            <td>".$item['fecha_REC_desestimiento']."</td>
            <td>".$item['fecha_enmienda']."</td>
            <td>".$item['fecha_kick_off']."</td>
            <td>".$item['fecha_completado']."</td>
            <td>".$item['fecha_limite_consultoria']."</td>
            <td>".$item['fecha_reunion_cierre']."</td>
            <td>".$item['fecha_limite_justificacion']."</td>
            <td>".$item['fecha_propuesta_resolucion']."</td>
            <td>".$item['fecha_propuesta_resolucion_notif']."</td>
            <td>".$item['fecha_resolucion']."</td>
            <td>".$item['fecha_notificacion_resolucion']."</td>
            <td>".$item['fecha_requerimiento']."</td>
            <td>".$item['fecha_requerimiento_notif']."</td>
            <td>".$item['fecha_firma_requerimiento_justificacion']."</td>
            <td>".$item['fecha_firma_resolucion_desestimiento']."</td>
            <td>".$item['fecha_notificacion_desestimiento']."</td>
            <td>".$item['fecha_infor_fav_desf']."</td>
            <td>".$item['fecha_amp_termino']."</td>
            <td>".$item['fecha_res_liquidacion']."</td>
            <td>".$item['fecha_not_liquidacion']."</td>
            <td>".$item['fecha_justificacion_ayuda_acta_cierre']."</td>
            <td>".$item['fecha_de_pago']."</td>
            <td>".$item['fecha_max_desp_ampliacion']."</td>
            <td>".$item['ref_REC']."</td>
            <td>".$item['ref_REC_enmienda']."</td>
            <td>".$item['ref_REC_amp_termino']."</td>
            <td>".$item['ref_REC_justificacion']."</td>
            <td>".$item['ref_REC_requerimiento_justificacion']."</td>
            <td>".$item['ref_REC_desestimiento']."</td>
            <td>".$item['importe_minimis']."</td>
            <td>".$item['tecnicoAsignado']."</td>

            </tr>";

     }
} else {

    $print .= "<tr><td>No s'ha trobat cap informació coincident amb els seus criteris de filtrat.</td></tr>";

}
$print .= "</table>";
echo $print;
?>

