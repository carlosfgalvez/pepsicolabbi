<?php namespace App\Models;

use CodeIgniter\Model;

class EncuestaPreguntasModel extends Model
{
        protected $table      = 'encuestas_preguntas';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['id_encuesta','pregunta','tipo','requerido','img_fondo','orden','activo'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
