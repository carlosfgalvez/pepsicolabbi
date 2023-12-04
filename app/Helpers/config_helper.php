<?php
use App\Models\SettingModel;

/* get_bd_config */
function get_config_bd(){
  $configcfg = [];  // arreglo asociativo

  try {
    $settingModel = new SettingModel();
    $registros    = $settingModel->where('tipo','config')->findAll();

    foreach($registros as $reg) {
      switch ($reg["nombre"]) {
        case "activo":            $configcfg['cfg_activo']           = $reg["valor"];  break;
        case "titulo":            $configcfg['cfg_titulo']           = $reg["valor"];  break;
        case "descripcion":       $configcfg['cfg_descripcion']      = $reg["valor"];  break;
        case "traza":             $configcfg['cfg_traza']            = $reg["valor"];  break;
        case "pagesize":          $configcfg['cfg_pagesize']         = $reg["valor"];  break;
        case "home":              $configcfg['cfg_home']             = $reg["valor"];
                                  $configcfg['cfg_encuesta']         = $reg["descripcion"];break;
      }
    }
  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $configcfg;
}

function get_reserv_config(){
  $reserv = [];  // arreglo asociativo

  try {
    $settingModel = new SettingModel();
    $registros    = $settingModel->where('tipo','reserv')->findAll();
    foreach($registros as $reg) {
      $reserv[] = $reg["nombre"];
    }
  } catch (\Exception $e) {
      $reserv = ['SELECT'];
      return ($e->getMessage());
  }
  if (count($reserv)==0) {  $reserv = ['SELECT'];}
  return $reserv;
}

/* get_img_config */
function get_config_img() {
  $configimg = [];  // arreglo asociativo

  $config = config('Config');
  $configimg['img_logonavbar'] = $config->img_logonavbar;
  $configimg['img_background'] = $config->img_background;
  $configimg['img_x']          = $config->img_x;
  $configimg['upload_dir']     = $config->upload_dir;

  return $configimg;
}

/* get_config_upload */
function get_config_upload(&$dir,&$max,&$ext,&$qlt) {
  $config = config('Config');
  $dir = $config->upload_dir;
  $max = $config->upload_maxsize;
  $ext = $config->upload_ext;
  $qlt = $config->upload_quality;
}
?>
