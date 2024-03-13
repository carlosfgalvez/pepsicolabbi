<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RegistroModel;
use App\Models\TicketModel;
use App\Models\SettingModel;

class Admin extends BaseController
{
  /* index */
  public function index(): string
  {
    // Obtener datos comunes a todas las vistas
    $data = $this->getData('admin');  // BaseController

    // Validar la sessión
    if (validDataSession($token,$rol)) {
      // Obtener datos del usuario
      $id  = $data['id'];
      $data['reg'] = get_registro_admin($id);

      // Datos
      $data['count_encuestas']          = get_encuesta_count('S');  // todas
      $data['count_encuestas_vigentes'] = get_encuesta_count('N');  // vigentes
      // $data['count_enviadas']           = get_enviadas_count(0); // enviadas todas encuestas
      $data['enviada_ultima']           = get_enviadas_ultima(0); // enviada última todas encuestas
      $count =0;
      $registros = get_encuesta_descarga_count(0,$count);
      $data['count_enviadas'] = $count;
      // Listas
      $data['list_encuestas']           = get_list_encuestas(0,"(Todas las encuestas)");
      $data['view_navbar'] = view('template/navbar',$data);

      $view = "admin/index";
    } else {
      $view = "home/login";
    }
    //var_dump($data);
    return view($view,$data);  //return view('welcome_message');
  }

  public function encuestadescargas($idencrypt=null,$year=null,$month=null, $opc=null) {
    $ide= encrypt_decrypt('d',$idencrypt);
    // Obtener datos comunes a todas las vistas
    $data = $this->getData('admin');  // BaseController
    if ($year==null) {$year = date("Y");}
    if ($month==null) {$month = date("m");}
    // Validar la sessión
    if (validDataSession($token,$rol)) {
      // get encuesta
      $enc  = get_encuesta($ide);

      // Obtener datos del usuario
      $id  = $data['id'];
      //$data['reg'] = get_registro_admin($id);

      $hoy 	      = date("d-m-Y H:i:s");
      $filename 	= "encuesta ".$enc['nombre']." ".$hoy.".xls";
      $titulo     = $enc['nombre'];
      $count      = 0;
      $registros  = get_encuesta_descarga($ide,$count,$year,$month);
      $config     = get_config_bd();

      // $resultados_filtrados = explode("<separador>", $registros);

      $data['count_enviadas']  = get_enviadas_count($ide);

      $data['config']    = $config;
      $data['filename']  = $filename;
      $data['titulo']    = $titulo;
      // $data['count_enviadas'] = $resultados_filtrados[0];
      $data['hoy']        = $hoy;
      $data['registros']  = $registros;
      $data['year']       = $year;
      $data['month']      = $month;

      $data['view_navbar'] = view('template/navbar',$data);

      $view = "admin/descargaencuesta";
    } else {
      $view = "home/login";
    }

    // echo $registros;
    return view($view,$data);
}

  /* encuesta descarga */
  public function encuestadescarga($idencrypt=null,$year=null,$month=null, $opc=null) {
    $ide= encrypt_decrypt('d',$idencrypt);
    // Obtener datos comunes a todas las vistas
    $data = $this->getData('admin');  // BaseController
    if ($year==null) {$year = date("Y");}
    if ($month==null) {$month = date("m");}
    // Validar la sessión
    if (validDataSession($token,$rol)) {
      // get encuesta
      $enc  = get_encuesta($ide);

      // Obtener datos del usuario
      $id  = $data['id'];
      //$data['reg'] = get_registro_admin($id);

      $hoy 	      = date("d-m-Y H:i:s");
      $filename 	= "encuesta ".$enc['nombre']." ".$hoy.".xls";
      $titulo     = $enc['nombre'];
      $count      = 0;
      $registros  = get_encuestas_filtradas($ide,$count,$year,$month, $opc);
      $config     = get_config_bd();

      $resultados_filtrados = explode("<separador>", $registros);

      // $data['count_enviadas']  = get_enviadas_count($ide);

      $data['config']    = $config;
      $data['filename']  = $filename;
      $data['titulo']    = $titulo;
      $data['count_enviadas'] = $resultados_filtrados[0];
      $data['hoy']        = $hoy;
      $data['registros']  = $resultados_filtrados[1];
      $data['year']       = $year;
      $data['month']      = $month;

      $data['view_navbar'] = view('template/navbar',$data);
      $view = "admin/descargaencuesta";
    } else {
      $view = "home/login";
    }

    return view($view,$data);
}

//--------------------------------------------------------------------------------------
//------------------------INICIO DESCARGA EXCEL BETA------------------------------------
//--------------------------------------------------------------------------------------
public function encuestadescarga2($idencrypt=null,$year=null,$month=null, $opc=null) {
  $ide= encrypt_decrypt('d',$idencrypt);
  // Obtener datos comunes a todas las vistas
  $data = $this->getData('admin');  // BaseController
  if ($year==null) {$year = date("Y");}
  if ($month==null) {$month = date("m");}
  // Validar la sessión
  if (validDataSession($token,$rol)) {
    // get encuesta
    $enc  = get_encuesta($ide);

    // Obtener datos del usuario
    $id  = $data['id'];
    //$data['reg'] = get_registro_admin($id);

    $hoy 	      = date("d-m-Y H:i:s");
    $filename 	= "encuesta ".$enc['nombre']." ".$hoy.".xls";
    $titulo     = $enc['nombre'];
    $count      = 0;
    $registros  = get_encuestas_filtradas2($ide,$count,$year,$month, $opc);
    $config     = get_config_bd();

    $resultados_filtrados = explode("<separador>", $registros);

    // $data['count_enviadas']  = get_enviadas_count($ide);

    $data['config']    = $config;
    $data['filename']  = $filename;
    $data['titulo']    = $titulo;
    $data['count_enviadas'] = $resultados_filtrados[0];
    $data['hoy']        = $hoy;
    $data['registros']  = $resultados_filtrados[1];
    $data['year']       = $year;
    $data['month']      = $month;

    $data['headTable'] = $resultados_filtrados[3];

    $data['view_navbar'] = view('template/navbar',$data);
    $view = "admin/descargaencuesta2";
  } else {
    $view = "home/login";
  }

  return view($view,$data);
}
//--------------------------------------------------------------------------------------
//-------------------------FINAL DESCARGA EXCEL BETA------------------------------------
//--------------------------------------------------------------------------------------


/* ver registros de encuestas enviadas */
public function VerEncuestasEnviadas($idencrypt=null,$year=null,$month=null) {
  $ide= encrypt_decrypt('d',$idencrypt);
  // Obtener datos comunes a todas las vistas
  $data = $this->getData('admin');  // BaseController
  if ($year==null) {$year = date("Y");}
  if ($month==null) {$month = date("m");}
  // Validar la sessión
  if (validDataSession($token,$rol)) {
    // get encuesta
    $enc  = get_encuesta($ide);

    // Obtener datos del usuario
    $id  = $data['id'];
    //$data['reg'] = get_registro_admin($id);

    $hoy 	      = date("d-m-Y H:i:s");
    $filename 	= "encuesta ".$enc['nombre']." ".$hoy.".xls";
    $titulo     = $enc['nombre'];
    $count      = 0;
    $registros  = get_encuesta_descarga($ide,$count,$year,$month);
    $config     = get_config_bd();

    $data['config']     = $config;
    $data['filename']   = $filename;
    $data['titulo']     = $titulo;
    $data['count']      = $count;
    $data['hoy']        = $hoy;
    $data['registros']  = $registros;
    $data['id_encuesta']= $idencrypt;
    $data['year']       = $year;
    $data['month']      = $month;
    $data['list_year']  = get_list_years_fecha($year);
    $data['list_month'] = get_list_meses_fecha($month);

    $data['view_navbar'] = view('template/navbar',$data);
    $view = "admin/verEncuestasEnviadas";
  } else {
    $view = "home/login";
  }

  return view($view,$data);
}

/* ver registros de encuestas enviadas */
public function VerEncuestasEnviadasFiltra() {
  // $ide= encrypt_decrypt('d',$idencrypt);
  $data = $this->getData('admin');  // BaseController
 
  // Validar la sessión
  if (validDataSession($token,$rol)) {
    // get encuesta
    // $enc  = get_encuesta($ide);

    // Obtener datos del usuario
    // $id  = $data['id'];
    //$data['reg'] = get_registro_admin($id);

    $hoy 	      = date("d-m-Y H:i:s");
    // $filename 	= "encuesta ".$enc['nombre']." ".$hoy.".xls";
    // $titulo     = $enc['nombre'];
    $count      = 0;
    // $registros  = get_encuesta_descarga($ide,$count,$year,$month);
    // $config     = get_config_bd();

    // $data['config']     = $config;
    // $data['filename']   = $filename;
    $data['titulo']     = 'Selecciona el rango de fechas a consultar';//$titulo;
    $data['count']      = $count;
    $data['list_encuestas']           = get_list_encuestas(0,"(Todas las encuestas)");
    // $data['hoy']        = $hoy;
    // $data['registros']  = $registros;
    // $data['id_encuesta']= $idencrypt;
    // $data['year']       = $year;
    // $data['month']      = $month;}
    // $data['list_year']  = get_list_years_fecha($year);
    // $data['list_month'] = get_list_meses_fecha($month);

    $data['view_navbar'] = view('template/navbar',$data);
    $view = "admin/verEncuestasEnviadasFiltra";
  } else {
    $view = "home/login";
  }

  return view($view,$data);
}

public function VerEncuestasEnviadasFiltra2() {

  $data = $this->getData('admin');  
  if (validDataSession($token,$rol)) {

    $hoy 	      = date("d-m-Y H:i:s");
    $count      = 0;

    $data['titulo']     = 'Selecciona el rango de fechas a consultar';//$titulo;
    $data['count']      = $count;
    $data['list_encuestas']           = get_list_encuestas(0,"(Todas las encuestas)");

    $data['view_navbar'] = view('template/navbar',$data);
    $view = "admin/verEncuestasEnviadasFiltra2";
  } else {
    $view = "home/login";
  }

  return view($view,$data);
}

  /* log descarga */
  public function logdescarga() {

    // Obtener datos comunes a todas las vistas
    $data = $this->getData('admin');  // BaseController

    // Validar la sessión
    if (validDataSession($token,$rol)) {
      // Obtener datos del usuario
      $id  = $data['id'];
      //$data['reg'] = get_registro_admin($id);

      $hoy 	      = date("d-m-Y H:i:s");
      $filename 	= "logs_".$hoy.".xls";
      $titulo     = "Logs";
      $count      = 0;
      $registros  = get_logs_descarga($count);
      $config     = get_config_bd();

      $data['config']    = $config;
      $data['filename']  = $filename;
      $data['titulo']    = $titulo;
      $data['count']     = $count;
      $data['hoy']       = $hoy;
      $data['registros'] = $registros;

      $view = "admin/descargalog";
    } else {
      $view = "home/login";
    }

    // var_dump($data);
    return view($view,$data);
  }


  /* Upload */
  public function upload() {
    // Obtener datos comunes a todas las vistas
    $data = $this->getData('admin');  // BaseController

    // Validar la sessión
    if (validDataSession($token,$rol)) {
      // Obtener datos del usuario
      $id  = $data['id'];
      $data['reg'] = get_registro_admin($id);

      $data['view_navbar'] = view('template/navbar',$data);
      $view = "admin/upload";
    } else {
      $view = "home/login";
    }
    //var_dump($data);
    return view($view,$data);  //return view('welcome_message');
  }

  /* uploadFiles */
  function uploadFiles() {
    // Obtener datos comunes a todas las vistas
    $data = $this->getData('admin');  // BaseController
    $upload_dir = $data['upload_dir'];
    $files = "";
    $cont = 0;
    $cod = 0;

    $msg = 'Favor seleccionar un archivo válido';
    if ($this->request->getFileMultiple('images')) {
         foreach($this->request->getFileMultiple('images') as $file)
         {
            //$file->move(WRITEPATH . 'uploads');
            $file->move($upload_dir);
            $files .= $file->getName()."<br>";
            $cont++;
         }
         if ($cont>0) {
           $cod = 1;
           if ($cont==1) {
             $msg = '<strong>El archivo fue subido correctamente: </strong><br> '.$files;
           } else {
             $msg = '<strong>Los archivos fueron subidos correctamente: </strong><br> '.$files;
           }
        } else {
            $msg = '<strong>No se encontraron archivo(s) a subir </strong>';
        }
    }

    return redirect()->to( site_url('/upload') )->with('msg', $msg)->with('cod', $cod);
}


} // AdminController
?>