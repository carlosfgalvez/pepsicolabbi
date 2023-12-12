<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController

      // banners
      $data['banners'] = get_banners();

      // encuestas
      $data['encuestas'] = get_encuestas();

      //var_dump($data);
      if (isset($data['cfg_home'])) {
        $mostrarhome = $data['cfg_home'];
        $encuestadefecto = $data['cfg_encuesta'];
        $urlenc = str_replace("index.php/","",site_url('/encuesta/'.$encuestadefecto));

        if ($mostrarhome==0) {// redireccionar encuestas
            return redirect()->to($urlenc);
        }
      }
      $data['view_navbar'] = view('template/navbar',$data);

      return view("home/index",$data);

    }

    /* login */
    public function login()  {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController
      $data['view_navbar'] = view('template/navbar',$data);
      
      //var_dump($data);
      return view("home/login",$data);
    }

} // HomeController
?>
