<?php namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
        protected $table      = 'banners';
        protected $primaryKey = 'id';

        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['tipo', 'nombre','descripcion','imagen1','imagen2','url1','url2','orden','activo'];

        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
}
