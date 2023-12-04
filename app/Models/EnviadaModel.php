<?php namespace App\Models;

use CodeIgniter\Model;

class EnviadaModel extends Model
{
        protected $table      = 'enviadas';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['id_encuesta','nombre','correo','telefono','fecha','huella','ip','cod_pais','cod_region','activo'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
