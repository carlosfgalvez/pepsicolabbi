<?php namespace App\Models;

use CodeIgniter\Model;

class EnviadaRespuestaModel extends Model
{
        protected $table      = 'enviadas_respuestas';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['id_enviada','id_encuesta','id_pregunta','id_opcion','respuesta','fecha'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
