<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class ResolucionModel extends Model
{
    protected $table = 'pindust_resoluciones';
    protected $allowedFields = ['id', 'id_sol', 'tipo_resolucion', 'motivo_resol', 'fecha_resol', 'fecha_modificación', 'nom_PDF'];
}