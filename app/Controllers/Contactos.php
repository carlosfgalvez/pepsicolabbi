<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Contactos extends BaseController
{
public function VerContactos() {
  $data = $this->getData('admin');  // BaseController

  // Validar la sessión
  if (validDataSession($token,$rol)) {

    $id  = $data['id'];

    $titulo     = 'Contactos registrados';
    $count      = 0;
    $data_records  = get_all_records();
    $config     = get_config_bd();
    $records = explode("<->", $data_records);
    $registros = $records[0];
    $count = $records[1];

    $data['titulo']    = $titulo;
    $data['count']     = $count;
    $data['registros'] = $registros;

    $data['view_navbar'] = view('template/navbar',$data);
    $view = "admin/contactos";
  } else {
    $view = "home/login";
  }

  return view($view,$data);
}

public function DescargaContactos() {

  $data = $this->getData('admin');  // BaseController

  // Validar la sessión
  if (validDataSession($token,$rol)) {

    // Obtener datos del usuario
    $id  = $data['id'];


    $hoy 	      = date("d-m-Y H:i:s");
    $filename 	= "Contactos_Registrados_".$hoy.".xls";
    $titulo     = "Contactos Registrados";
    $count      = 0;
    $data_records  = get_all_records();
    $config     = get_config_bd();
    $records = explode("<->", $data_records);
    $registros = $records[0];
    $count = $records[1];

    $data['config']    = $config;
    $data['filename']  = $filename;
    $data['titulo']    = $titulo;
    $data['count']     = $count;
    $data['hoy']       = $hoy;
    $data['registros'] = $registros;

    $data['view_navbar'] = view('template/navbar',$data);
    $view = "admin/descargacontactos";
  } else {
    $view = "home/login";
  }

  return view($view,$data);
}

} 
?>