<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class ConsultorModel extends Model
{
    protected $table = 'pindust_consultor';
 
    protected $allowedFields = ['id', 'empresa', 'nif', 'domicilio', 'localidad', 'cpostal', 'telefono', 'email', 'hay_rep', 'nombre_rep', 'nif_rep', 'domicilio_rep', 'telefono_rep', 'email_rep', 'condicion_rep', 'tipo_tramite', 'expMinDos_dec_resp_cons', 'expTransDigital_dec_resp_cons', 'tieneEstudios_dec_resp_cons', 'fechaDeclaracion', 'selloDeTiempo', 'id_sol', 'PublicAccessId'];
}