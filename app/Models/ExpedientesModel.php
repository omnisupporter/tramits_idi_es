<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class ExpedientesModel extends Model
{
    protected $table = 'pindust_expediente';
 
    protected $allowedFields = ['id', 'fecha_kick_off', 'fecha_enmienda', 'fecha_completado', 'fecha_limite_consultoria', 
    'fecha_reunion_cierre', 'fecha_limite_justificacion', 'fecha_propuesta_resolucion', 'fecha_propuesta_resolucion_notif', 
    'fecha_resolucion', 'fecha_notificacion_resolucion', 'fecha_requerimiento', 'fecha_requerimiento_notif', 
    'fecha_amp_termino', 'fecha_REC', 'ref_REC', 'empresa', 'nif', 'telefono', 'email', 'domicilio', 'fecha_solicitud', 
    'tipo_tramite', 'convocatoria', 'hay_consultor', 'situacion', 'importeAyuda', 'porcentajeConcedido',
    'canales_comercializacion_empresa', 'sitio_web_empresa', 'video_empresa', 'fecha_creacion_empresa', 'publicar_en_web'];
}