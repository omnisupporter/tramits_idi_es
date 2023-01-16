<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class UseriTramitsModel extends Model
{
    protected $table = 'userTramits';
 
    protected $allowedFields = ['id', 'user_name', 'password', 'full_name', 'servicio', 'rol', 'telefono', 'googleID'];
}