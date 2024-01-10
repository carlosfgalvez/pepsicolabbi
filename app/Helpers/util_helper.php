<?php

/* Listado de dias */
function get_list_dias_fecha($dia=null){
  $salida   ='';

  try {
    $dia  = strip_tags($dia);
    for ($i = 1; $i <= 31; $i++) {
      if ($dia!=null && $dia==$i) {
        $salida .= '<option class="" value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'" selected>'.$i.'</option>';
      } else {
        $salida .= '<option class="" value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.$i.'</option>';
      }
    }
  } catch (\Exception $e) {
    $salida=0;
  }
  return $salida;
}

/* Listado de meses */
function get_list_meses_fecha($mes=null) {
  $salida = "";

  try {
    $meses = array("Enero", "Febrero", "Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $mes  = strip_tags($mes);
    for ($i = 1; $i <= 12; $i++) {
      if ($mes!=null && $mes==$i) {
        $salida .= '<option class="" value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'" selected>'.$meses[$i-1].'</option>';
      } else {
        $salida .= '<option class="" value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.$meses[$i-1].'</option>';
      }
    }
  } catch (\Exception $e) {
    $salida=0;
  }
  return $salida;
}

function get_clases_css($nameimg=null){
  $salida = "";

  try {
    $clases = array("momentos","sopas","tiendas");
    $salida .= '<option value="">Selecciona una opción (opcional)</option>';
    foreach($clases as $clase){ 
      if($nameimg == $clase){ 
        $salida .= '<option value="'.$clase.'" selected>'.$clase.'</option>';
      }else{
        $salida .= '<option value="'.$clase.'">'.$clase.'</option>';
      }
    }
  } catch (\Exception $e) {
    $salida=0;
  }

  return $salida;
}

/* Lista de imagenes disponibles*/
function get_images_anebles($upload_dir,$nameimg=null){
  $salida = "";
  $images = array();
      $arrFiles = scandir($upload_dir);
      foreach($arrFiles as $file){
        if($file != '.' && $file != '..'){
          array_push($images, $file);
        }
      }
  // ----------------------------------
  $salida .= '<option value="">Selecciona una opción (opcional)</option>';
      foreach($images as $img){ 
        if($nameimg == $img){
          $salida .= '<option value="'.$img.'" selected>'.$img.'</option>';
        }else{
          $salida .= '<option value="'.$img.'">'.$img.'</option>';
        }
      }
  // ----------------------------------

  return $salida;
}
/* Listado de años */
function get_list_years_fecha($year=null){
  $salida = "";

  try {
    $yearactual = date("Y"); // año actual
    $year  = strip_tags($year);
    for ($i = $yearactual; $i > 1900; $i--) {
      if ($year!=null && $year == $i) {
        $salida .= '<option class="" value="'.$i.'" selected>'.$i.'</option>';
      } else {
        $salida .= '<option class="" value="'.$i.'">'.$i.'</option>';
      }
    }
  } catch (\Exception $e) {
    $salida=0;
  }
  return $salida;
}

/* encrypt_decrypt */
  function encrypt_decrypt($action, $string) {
    /*
     $config = config('Config');
     $encrypt_method = $config->enc_encryptmethod;
     $secret_iv 		 = $config->enc_secretiv;
     $secret_key 		 = $config->enc_secretkey;
     */
     $config = config('Encryption');
     $encrypt_method = $config->cipher;
     $secret_iv 		 = $config->authKeyInfo;
     $secret_key 		 = $config->encryptKeyInfo;

     $output = false;

     if ($secret_iv!="" && $secret_key!="") {
     // hash
     $key = hash('sha256', $secret_key);

     // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
     $iv = substr(hash('sha256', $secret_iv), 0, 16);

     if( $action == 'e' ) {
         //$output = openssl_encrypt($string, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
         $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
         $output = base64_encode($output);
     }
     else if( $action == 'd' ){
       //$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
       $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
       //$output = $encrypt_method.' '.$secret_iv.' '.$secret_key.' '.$iv;
     }
    } else {
      $output = $string;
    }
     return $output;
}

/* getRealIP */
function getRealIP() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $serv=$_SERVER['HTTP_X_FORWARDED_FOR'];
        //echo $serv;
      return $serv;
    }else{
      $serv=$_SERVER['REMOTE_ADDR'];
      return $serv;
    }
}

// Función de compresión de imágenes
function compressImage($source, $destination, $quality) {
    // Obtenemos la información de la imagen
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];

    // Creamos una imagen
    switch($mime){
        case 'image/jpeg':  $image = imagecreatefromjpeg($source);  break;
        case 'image/png':   $image = imagecreatefrompng($source);   break;
        case 'image/gif':   $image = imagecreatefromgif($source);   break;
        default:            $image = imagecreatefromjpeg($source);
    }

    // Guardamos la imagen
    imagejpeg($image, $destination, $quality);

    // Devolvemos la imagen comprimida
    return $destination;
}


?>