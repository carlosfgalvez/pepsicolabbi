<?php namespace App\Models;

use CodeIgniter\Model;

class EncuestaPreguntaOpcionesModel extends Model
{
        protected $table      = 'encuestas_opciones';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['id_encuesta','id_pregunta','opcion','input','requerido','img_opcion','img_alto','img_ancho','orden','activo'];


        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
