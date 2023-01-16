<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class DocumentosGeneradosModel extends Model
{
    protected $table = 'pindust_documentos_generados';
 
    protected $allowedFields = ['id', 'id_sol', 'cifnif_propietario', 'convocatoria', 'name', 'type', 'created_at', 'tipo_tramite', 'corresponde_documento', 'datetime_uploaded', 'selloDeTiempo'];
}