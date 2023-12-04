<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        helper('config');
        helper('session');
        helper('util');
        helper('log');
        helper('respuesta');
        helper('email');
        helper(['form', 'url']);
        // E.g.: $this->session = \Config\Services::session();
    }

    public function getData($encuesta=null) {
      $data = [];

      /* get Session */
      $token = getDataSession($id,$rol);
      $data['token'] = $token;
      $data['id']    = $id;
      $data['rol']   = $rol;

      /* css particular de la vista*/
      $data['encuestacod'] = $encuesta;

      /* Esta en el home o no */
      if (strpos($_SERVER['REQUEST_URI'],'admin')!== false) { $data['home'] = 1;} else {$data['home'] =0;}

      /* Configs */
      $data += get_config_bd();
      $data += get_config_img();

      /* urls */
      $data['url_base'] = base_url();

      /* views */
      $data['view_header'] = view('template/header',$data);
      $data['view_footer'] = view('template/footer',$data);
      $data['view_navbar'] = view('template/navbar',$data);
      $data['view_message'] = view('template/message',$data);
      $data['view_avisoprivacidad']      = view('template/avisoprivacidad',$data);
      $data['view_terminosycondiciones'] = view('template/terminosycondiciones',$data);

      return $data;
  }

}
