<?php namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
        protected $table      = 'logs';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['id_accion','modulo','accion','descripcion','ip','fecha_log','usuario','rol'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
