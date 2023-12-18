<?php namespace App\Models;

use CodeIgniter\Model;

class ContactosModel extends Model
{
        protected $table      = 'contactos';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields =
        ['nombre','correo','telefono','fecha'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}