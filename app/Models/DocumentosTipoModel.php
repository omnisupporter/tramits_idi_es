<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class DocumentosTipoModel extends Model
{
    protected $table = 'pindust_documentos_tipo';
 
    protected $allowedFields = ['id', 'convocatoria', 'name', 'type', 'created_at', 'tipo_tramite', 'corresponde_documento'];
}