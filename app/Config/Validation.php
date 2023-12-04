<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $settings = [
      'tipo'   => 'required',
      'nombre'   => 'required'
    ];

    public array $banners = [
      'tipo'   => 'required',
      'nombre'   => 'required',
      'imagen1'   => 'required'
    ];

    public array $encuestas = [
      'nombre'   => 'required',
      'fecha_inicio'   => 'required',
      'fecha_fin'   => 'required'
    ];

    public array $preguntas = [
      'pregunta'   => 'required',
      'id_encuesta'   => 'required',
      'tipo'   => 'required'
    ];

    public array $opciones = [
      'opcion'   => 'required',
      'id_encuesta'   => 'required',
      'id_pregunta'   => 'required'
    ];
}
