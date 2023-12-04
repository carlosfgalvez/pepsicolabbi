<?php namespace App\Models;

use CodeIgniter\Model;

class EncuestaModel extends Model
{
        protected $table      = 'encuestas';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['nombre','descripcion','codigo','img_portada','img_fondo','color_txt','fecha_inicio','fecha_fin','datos_personales','duplicidad','orden','activo'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
