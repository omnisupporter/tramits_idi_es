<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class DocumentosJustificacionModel extends Model
{
    protected $table = 'pindust_documentos_justificacion';
 
    protected $allowedFields = ['id', 'cifnif_propietario', 'convocatoria', 'name', 'type', 'created_at', 'tipo_tramite', 'corresponde_documento', 'datetime_uploaded', 'selloDeTiempo', 'id_sol'];
}