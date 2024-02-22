<?php
use App\Models\ContactosModel;
use App\Models\EncuestaModel;
use App\Models\EncuestaPreguntasModel;
use App\Models\EncuestaPreguntaOpcionesModel;
use App\Models\EnviadaModel;
use App\Models\EnviadaRespuestaModel;
use App\Models\SettingModel;
use App\Models\BannerModel;

/***************************************************************************/
/*****************************    ENCUESTAS   ***********************************/
/***************************************************************************/

/* enviar_encuesta */
function enviar_encuesta($ide,$pre,$res,$inp,$uid){
  $result 	    = 0;
  $mensaje      = "";

  try{
    $hoy 		      = date("Y-m-d H:i:s");
    /* obtener encuesta */
    $enc          = get_encuesta($ide);

    /* Validar encuesta */
    if ($enc!="") {
      $mensaje = valid_encuesta($enc);
    } else  {
      $mensaje  = "Encuesta no se encontro.";
    }

    if ($mensaje=="") { // Encuesta Ok
      if ($enc["duplicidad"]=="S") { // Validar duplicidad
        $existe = existe_envio($ide,$uid);
      } else {
        $existe = 0;
      }
      if($existe==0) {
          // parámetros
          //$idenc        = encrypt_decrypt('d',$ide);
          $preguntas    = strtoupper(strip_tags($pre));
          $respuestas   = strtoupper(strip_tags($res));
          $inputs       = strtoupper(strip_tags($inp));

          // Arrays
          $preguntas    = explode( ',', $preguntas);
          $respuestas   = explode( ',', $respuestas);
          $inputs       = explode( ',', $inputs);

          //var_dump( $preguntas);

          // Guardar encabezado encuesta
          $ip               = getRealIP();
          $country_code     = "";$country_region="";$codpais="";
          $huella           = $uid;

          $datos=[
            'id_encuesta'=>$ide,
            'fecha'      =>$hoy,
            'huella'     =>$huella,
            'ip'         =>$ip,
            'cod_pais'   =>$codpais,
            'cod_region' =>$country_region,
            'activo'     =>'S'
          ];

          // Agregar el registro
          $enviadaModel = new EnviadaModel();
      		if ($enviadaModel->insert($datos)) {
            $idenv     = $enviadaModel->insertID;
            setParamSession('idenv',$idenv);
            setParamSession('idenc',$ide);

            // guardar las respuestas de las preguntas
            for($i = 0;$i < count($preguntas);$i++) {
      	       $idp = $preguntas[$i];
               $ido = $respuestas[$i];
               $inp = $inputs[$i];


               //if ($ido==null) { $inp = null;}
               if (!is_numeric($ido) && $ido!=null) { $inp = $ido; $ido = null;}
               if (strtoupper($inp)=='NULL' || $inp=='') {$inp=null;}
               //if (is_numeric($ido) && $ido==0) { $inp = null; $ido = null;}
               //$inp = str_replace("&&",",",$inp);

               $datos2=[
                 'id_enviada' =>$idenv,
                 'id_encuesta'=>$ide,
                 'id_pregunta'=>$idp,
                 'id_opcion'  =>$ido,
                 'respuesta'  =>$inp,
                 'fecha'      =>$hoy
               ];

               $enviadaRespuestaModel = new EnviadaRespuestaModel();
               $enviadaRespuestaModel->insert($datos2);
            }

            $result       = "0;Registro Ok;$idenv";
            log_write_bd($idenv,'ENCUESTA',$ide,'Encuesta enviada satisfactoriamente',$uid);

          } else {
            $result = "-1;Ha ocurrido un error al realizar al guardar la encuesta;";
            log_write_bd(0,'ENCUESTA','ERROR','Ha ocurrido un error el guardar la encuesta');
          }
      } else {
        $result = "-2;Ya has contestado esta encuesta el día ".$existe.";";
        log_write_bd(0,'ENCUESTA','ERROR','Ya ha contestado esta encuesta el día '.$existe,$uid);
      }
    } else { // No Ok
      $result = "-3;".$mensaje.";";
      log_write_bd(0,'ENCUESTA','ERROR',$mensaje);
    }
  } catch (\Exception $e) {
    $result = "-4;Error de validación de datos;";
    //$result = "-4;Error de validación de datos".$e.";";
  }
 	return $result;
}

/* enviar_encuesta_datospersonales */
function enviar_encuesta_datospersonales($nom,$ema,$cel){
  $result 	    = 0;
  $cod          = 0;
  $mensaje      = "";

  try{
    $hoy   = date("Y-m-d H:i:s");
    $idenv = getParamSession('idenv');

    if ($idenv!="") { // id envio
          $nombre     = strtoupper(strip_tags($nom));
          $email      = strtoupper(strip_tags($ema));
          $celular    = strtoupper(strip_tags($cel));

          $nombre           = substr(str_replace("'","\'",$nombre),0,50);
          $email            = substr($email,0,50);
          $celular          = substr($celular,0,45);

          $datos=[
            'nombre'     =>$nombre,
            'correo'     =>$ema,
            'telefono'   =>$celular
          ];

          // Guardar el registro
          $enviadaModel = new EnviadaModel();
      		if ($enviadaModel->update($idenv,$datos)) {

            //$enviadaModel  = new EnviadaModel();
            //$multiClause   = array('id'=> $idenv);
            //$registros     = $enviadaModel->where($multiClause)->findAll();
            //$ide           = $registros['id_encuesta'];
            $cod           = 0;
            $mensaje       = "Tus datos fueron recibidos y pronto te contactaremos";
            log_write_bd($idenv,'ENCUESTA',0,$mensaje.' '.$nombre.' '.$ema.' '.$celular,0);

          } else {
            $cod    = -1;
            $mensaje = "Ha ocurrido un error al guardar la encuesta con los datos personales";
            log_write_bd(0,'ENCUESTA','ERROR',$mensaje.' ('.$cod.')');
          }
    } else { // No Ok
      $cod      = -2;
      $mensaje = "No se encontro la encuesta, favor vuelva a intentarlo";
      log_write_bd(0,'ENCUESTA','ERROR',$mensaje.' ('.$cod.')');
    }
  } catch (\Exception $e) {
    $cod      = -3;
    $mensaje = "Error de validación de datos";
    log_write_bd(0,'ENCUESTA','ERROR',$mensaje.' ('.$cod.')');
    //$mensaje = "Error de validación de datos ".$e->getMessage();
  }
 	return $result = $cod.';'.$mensaje;
}

/* enviar datos registro home */
function enviar_form_registro_home($nom,$ema,$cel){
  $result 	    = 0;
  $cod          = 0;
  $mensaje      = "";

  try{
    $hoy   = date("Y-m-d H:i:s");
    // $idenv = getParamSession('idenv');
          $nombre     = strtoupper(strip_tags($nom));
          $email      = strtoupper(strip_tags($ema));
          $celular    = strtoupper(strip_tags($cel));

          $nombre           = substr(str_replace("'","\'",$nombre),0,50);
          $email            = substr($email,0,50);
          $celular          = substr($celular,0,45);

          $datos=[
            'nombre'     =>$nombre,
            'correo'     =>$ema,
            'telefono'   =>$celular,
            'fecha' =>$hoy,
          ];

          // Guardar el registro
          $contactomodel = new ContactosModel();
      		if ($contactomodel->insert($datos)) {
            $cod           = 0;
            $mensaje       = "Tus datos fueron recibidos y pronto te contactaremos";
            log_write_bd(Null,'REGISTRO HOME','OK',$mensaje.' '.$nombre.' '.$ema.' '.$celular,0);

          } else {
            $cod    = -1;
            $mensaje = "Ha ocurrido un error al guardar el registro con los datos personales";
            log_write_bd(0,'REGISTRO HOME','ERROR',$mensaje.' ('.$cod.')');
          }

  } catch (\Exception $e) {
    $cod      = -3;
    $mensaje = "Error de validación de datos";
    log_write_bd(0,'REGISTRO HOME','ERROR',$mensaje.' ('.$cod.')');
    //$mensaje = "Error de validación de datos ".$e->getMessage();
  }
 	return $result = $cod.';'.$mensaje;
}

/* existe_envio: verifica que no haya contestado la encuesta */
function existe_envio($ide,$huella) {
  $salida=0;

  try {
    if ($huella!="" && $huella != null) {
      $enviadaModel = new EnviadaModel();
      $multiClause   = array('id_encuesta'=> $ide,'huella' => $huella, 'activo' => 'S');
      $registros     = $enviadaModel->where($multiClause)->findAll();
      foreach($registros as $reg) {
        $fecha  = date_format(date_create($reg["fecha"]),"d/m/Y");
        $hora   = date_format(date_create($reg["fecha"]),"H:i:s");
        $salida = $fecha.' '.$hora;
      }
    }
  } catch (\Exception $e) {
    $salida = 0;
  }
  return $salida;
}

/* get_encuestas */
function get_encuestas(){
  $result = [];  // arreglo

  try {
    $hoy 		       = date("Y-m-d H:i:s");
    $encuestaModel = new EncuestaModel();
    $registros     = $encuestaModel->where('activo','S')->OrderBy('orden','Asc')->findAll();

    foreach($registros as $reg) {
      if ($reg['fecha_inicio'] <= $hoy && $reg['fecha_fin'] >= $hoy) {
        $reg['vigente'] = 'S';
      } else {
        $reg['vigente'] = 'N';
      }
      $reg['fecha'] = date_format(date_create($reg["fecha_inicio"]),"d/m/Y");
      $reg['idenc']  = encrypt_decrypt('e',$reg['id']);
      if ($reg['codigo']=="") { $reg['url'] = $reg['id'];} else { $reg['url'] = $reg['codigo'];};
      $result[] = $reg;
    }

  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* get_banners */
function get_banners(){
  $result = [];  // arreglo

  try {
    $hoy 		       = date("Y-m-d H:i:s");
    $bannerModel   = new BannerModel();
    $registros     = $bannerModel->where('activo','S')->OrderBy('orden','Asc')->findAll();
    $result        = $registros;
  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* get_encuesta */
function get_encuesta($id_cod){
  $result = "";

  try {
    $encuestaModel = new EncuestaModel();

    if (is_numeric($id_cod)) {
      $multiClause  = array('id' => $id_cod);
    } else {
      $multiClause   = array('codigo' => $id_cod);
    }

    $result     = $encuestaModel->where($multiClause)->first();

    //$result = $registros;
  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* valid_encuesta */
function valid_encuesta($enc){
  $result = "";

  // verificar vigencia y que este activa
  if ($enc['activo']=='S') {
    $hoy  = date("Y-m-d H:i:s");
    if ($enc['fecha_inicio'] <= $hoy && $enc['fecha_fin'] >= $hoy) {
      $result = "";
    } else {
      $result  = "Encuesta no se encuentra vigente.";
    }
  } else  {
    $result  = "Encuesta no se encuentra activa.";
  }
  return $result;
}

/* get_encuesta_preguntas_opciones */
function get_encuesta_preguntas_opciones($idenc){
  $result = [];  // arreglo

  try {
    $encuestaPreguntasModel = new EncuestaPreguntasModel();
    $multiClause   = array('id_encuesta' => $idenc, 'activo' => 'S');
    $registros     = $encuestaPreguntasModel->where($multiClause)->OrderBy('orden','Asc')->findAll();

    foreach($registros as $reg) {
        /* Obtener las opciones */
        $idpre = $reg['id'];
        $reg['opciones'] = get_encuesta_pregunta_opciones($idenc,$idpre);
        $result[] = $reg;
    }

  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* get_encuesta_pregunta_opciones */
function get_encuesta_pregunta_opciones($idenc,$idpre){
  $result = [];  // arreglo

  try {
    $encuestaPreguntaOpcionesModel = new EncuestaPreguntaOpcionesModel();
    $multiClause   = array('id_encuesta' => $idenc,'id_pregunta' => $idpre, 'activo' => 'S');
    $registros     = $encuestaPreguntaOpcionesModel->where($multiClause)->OrderBy('orden','Asc')->findAll();

    $result = $registros;

  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/***************************************************************************/
/*****************************    ADMIN   **********************************/
/***************************************************************************/

/* get_registro admin */
function get_registro_admin($id){
  $salida   = 0;

  try {
    $id     = strip_tags($id);
    if ($id>0) {
      $settingModel = new SettingModel();
      $multiClause   = array('id'=> $id,'tipo' => 'user');
      $registros     = $settingModel->where($multiClause)->first();
      $salida        = $registros;
    }
  } catch (\Exception $e) {
    $salida=0;
  }
  return $salida;
}

/* get_encuesta_count */
function get_encuesta_count($todas='S') {
  $encuestas = [];  // arreglo
  $result = 0;

  try {
    $hoy 		       = date("Y-m-d H:i:s");
    $encuestaModel = new EncuestaModel();
    $registros     = $encuestaModel->where('activo','S')->OrderBy('orden','Asc')->findAll();

    foreach($registros as $reg) {
      if ($todas!='S') {
        if ($reg['fecha_inicio'] <= $hoy && $reg['fecha_fin'] >= $hoy) {
           $encuestas[] = $reg;
        }
      } else {
        $encuestas[] = $reg;
      }
    }
    $result = count($encuestas);

  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* get_enviadas_count */
function get_enviadas_count($id=0) {
  $count   = 0;

  try {
    $enviadaModel = new EnviadaModel();
    if ($id>0) {
      $multiClause   = array('id_encuesta'=> $id,'activo' => 'S');
    } else {
      $multiClause   = array('activo' => 'S');
    }
    $count         = $enviadaModel->where($multiClause)->countAllResults();

  } catch (\Exception $e) {
    $count=0;
  }
  return $count;
}

/* get_enviadas_ultima */
function get_enviadas_ultima($id) {
  $result   = "";

  if ($id>0) {
  try {
    $enviadaModel = new EnviadaModel();
    if ($id>0) {
      $multiClause   = array('id_encuesta'=> $id,'activo' => 'S');
    } else {
      $multiClause   = array('activo' => 'S');
    }
    $reg     = $enviadaModel->where($multiClause)->OrderBy('fecha','Desc')->first();

    if ($reg!=null) {
      $fecha  = date_format(date_create($reg["fecha"]),"d/m/Y");
      $hora   = date_format(date_create($reg["fecha"]),"H:i:s");
      $result  = $fecha.' '.$hora;
    } else { $result="(Ninguna)";}

  } catch (\Exception $e) {
    $result="";
  }
  }
  return $result;
}

/* get_list_encuestas */
 function get_list_encuestas($id,$primero="") {
   if ($primero!="") {
     $salida  = "<option value='0' selected>".$primero."</option>";
   } else {
     $salida  = "";
   }

   try {
     $encuestaModel = new EncuestaModel();
     $registros     = $encuestaModel->where('activo','S')->OrderBy('orden','Asc')->findAll();

     foreach($registros as $reg) {
       $idenc = encrypt_decrypt('e',$reg["id"]);
       if ($reg["id"]==$id) {
         $salida  .= "<option value=".$idenc." selected>".$reg["nombre"]."</option>";
      } else {
         $salida  .= "<option value=".$idenc.">".$reg["nombre"]."</option>";
      }
     }

   } catch (\Exception $e) {
      $salida = "";
   }
   return $salida;
 }

 /* get_list_preguntas */
  function get_list_preguntas($ide,$id,$primero="") {
    if ($primero!="") {
      $salida  = "<option value='0' selected>".$primero."</option>";
    } else {
      $salida  = "";
    }

    try {
      $registros = [];
      $encuestapreguntasModel = new EncuestaPreguntasModel();
      if ($ide!="0") {
        $multiClause   = array('id_encuesta'=> $ide, 'activo' => 'S');
        $registros     = $encuestapreguntasModel->where($multiClause)->OrderBy('orden','Asc')->findAll();
      }

      foreach($registros as $reg) {
        $idenc = encrypt_decrypt('e',$reg["id"]);
        if ($reg["id"]==$id) {
          $salida  .= "<option value=".$idenc." selected>".$reg["pregunta"]."</option>";
       } else {
          $salida  .= "<option value=".$idenc.">".$reg["pregunta"]."</option>";
       }
      }

    } catch (\Exception $e) {
       $salida = "";
    }
    return $salida;
  }

 /* get_encuesta_descarga_count */
 function get_encuesta_descarga_count($ide,&$count) {
  $salida = "";
  $count  = 0;

  if($ide > 0){
    try {
      $db = db_connect();
      $ide  = $db->escapeString(strip_tags($ide));
      if($ide > 0){
        $query = "SELECT 'x' total FROM v_encuestas_enviadas WHERE id_encuesta = ".$ide;
      }else{
        $query = "SELECT 'x' total FROM v_encuestas_enviadas";
      }
      $registros = $db->query($query);
      /*
      foreach ($registros->getResultArray() as $reg) {
        $count = $reg["total"];
      }
      */
      $count  = $registros->getNumRows();
      $db->close();
    } catch (\Exception $e) {
      $salida = $e->getMessage();
    }
  }
  return $salida;
  //return $salida =$count."<separador>".$consulta;
}


  /* get_encuesta_descarga */
function get_encuesta_descarga($ide,&$count,$year,$month) {
  $salida = "";
  $count  = 0;
  $nombre = "";

  try {
    $db = db_connect();
    $ide  = $db->escapeString(strip_tags($ide));
    if($ide > 0){
      $query = "SELECT * FROM v_encuestas_enviadas
               WHERE id_encuesta = ".$ide."
               AND DATE_FORMAT(STR_TO_DATE(fecha,'%d/%m/%Y'),'%m/%Y') ='".$month."/".$year."'
               ORDER BY STR_TO_DATE(fecha,'%d/%m/%Y'), hora";
    }else{
      $query = "SELECT * FROM v_encuestas_enviadas
                WHERE DATE_FORMAT(STR_TO_DATE(fecha,'%d/%m/%Y'),'%m/%Y') ='".$month."/".$year."'
               ORDER BY STR_TO_DATE(fecha,'%d/%m/%Y'), hora";
    }

    $registros = $db->query($query);
    foreach ($registros->getResultArray() as $reg) {
            $salida  .= "<tr>
                          <td style='text-align: center;'>".$reg["fecha"]."</td>
                          <td style='text-align: center;'>".$reg["hora"]."</td>
                          <td style='text-align: left;'>".$reg["nombre"]."</td>
                          <td style='text-align: left;'>".$reg["correo"]."</td>
                          <td style='text-align: left;'>".$reg["telefono"]."</td>
                          <td style='text-align: center;'>".$reg["ip"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_1"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_1"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_2"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_2"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_3"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_3"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_4"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_4"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_5"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_5"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_6"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_6"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_7"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_7"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_8"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_8"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_9"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_9"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_10"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_10"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_11"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_11"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_12"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_12"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_13"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_13"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_14"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_14"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_15"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_15"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_16"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_16"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_17"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_17"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_18"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_18"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_19"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_19"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_20"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_20"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_21"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_21"]."</td>
                          <td style='text-align: left;'>".$reg["Pregunta_22"]."</td>
                          <td style='text-align: left;'>".$reg["Respuesta_22"]."</td>
                      </tr>";
    }
    $count  = $registros->getNumRows();
    $db->close();
  } catch (\Exception $e) {
    $salida = $e->getMessage();
  }
  return $salida;
  //return $salida =$count."<separador>".$consulta;
}

 /* get_logs_descarga */
function get_logs_descarga(&$count) {
  $salida = "";
  $count  = 0;
  $nombre = "";

  try {
    $db = db_connect();
    $query = "SELECT logs.*,
                     '' registro,
                     settings.nombre admin
               FROM logs
               LEFT JOIN settings ON settings.id = logs.usuario
               ORDER BY logs.id DESC";

    $registros = $db->query($query);
    foreach ($registros->getResultArray() as $reg) {
          if ($reg["registro"]!="") {$nombre = $reg["registro"];} else {$nombre = $reg["admin"];}
          $salida  .= "<tr>
                          <td style='text-align: center;'>".$reg["id"]."</td>
                          <td style='text-align: center;font-weight: bold;'>".$reg["id_accion"]."</td>
                          <td style='text-align: left;'>".$reg["modulo"]."</td>
                          <td style='text-align: center;'>".$reg["accion"]."</td>
                          <td style='text-align: left;'>".$reg["descripcion"]."</td>
                          <td style='text-align: center;'>".$reg["ip"]."</td>
                          <td style='text-align: center;'>".$reg["fecha_log"]."</td>
                          <td style='text-align: center;'>".$reg["usuario"]."</td>
                          <td style='text-align: center;'>".$reg["rol"]."</td>
                          <td style='text-align: left;'>".$nombre."</td>
                      </tr>";
    }
    $count  = $registros->getNumRows();
    $db->close();
  } catch (\Exception $e) {
    $salida = $e;
  }
  return $salida;
  //return $salida =$count."<separador>".$consulta;
}

function get_all_records(){
  $salida = "";
  $count  = 0;
  $nombre = "";

  try {
    $db = db_connect();
    $query = "SELECT * FROM contactos ORDER BY fecha";

    $registros = $db->query($query);
    foreach ($registros->getResultArray() as $reg) {
            $salida  .= "<tr>
                          <td style='text-align: center;'>".$reg["id"]."</td>
                          <td style='text-align: center;'>".$reg["nombre"]."</td>
                          <td style='text-align: left;'>".$reg["correo"]."</td>
                          <td style='text-align: left;'>".$reg["telefono"]."</td>
                          <td style='text-align: left;'>".$reg["fecha"]."</td>
                      </tr>";
    }
    $count  = $registros->getNumRows();
    $db->close();
  } catch (\Exception $e) {
    $salida = $e->getMessage();
  }
  return $salida.'<->'.$count;

}

/***************************************************************************/
/**********************    LOGIN/LOGOUT   **********************************/
/***************************************************************************/

/* ingresar  */
function ingresar($user,$pass) {
  	$result 	    = 0;
  	$hoy 		      = date("Y-m-d H:i:s");
    $rol    	    = 0;  // 0=usuario, 1=admin

    try {
      $user = strip_tags($user);
      $pass = strip_tags($pass);
      if ($user!="" && $pass!="") {
        if (get_registro_id($user,$passreg,$id,$rol,$fconfirma)>0) {
          if ($fconfirma!=null) {
            if (valid_pass($pass,$passreg,$user,$rol)) {
              $token = encrypt_decrypt('e',$id);
              login($token,$id,$rol);
              $result  = "0;Ingreso Ok;".$token.";".$rol;
              log_write_bd($id,'LOGIN','OK',$user);
            } else {
              $result = "-1;Contraseña es incorrecta;";
              log_write_bd($id,'LOGIN','ERROR','Contraseña es incorrecta');
            }
          } else {
            $result = "-4;Usuario ".$user." no se encuentra confirmado;";
            log_write_bd(0,'LOGIN','ERROR','Usuario '.$user.' no se encuentra confirmado');
          }
        } else {
            $result = "-4;Usuario ".$user." no se encuentra registrado;";
            log_write_bd(0,'LOGIN','ERROR','Usuario '.$user.' no se encuentra registrado');
        }
      } else {
        $result = "-3;Usuario no especificado;";
        log_write_bd(0,'LOGIN','ERROR','Usuario '.$user.' no se encuentra registrado');
      }
    } catch (\Exception $e) {
      $result = "-4;Error de validación de datos;";
      //$result = "-4;Error de validación de datos ".$e->getMessage().";";
    }

 	return $result;
}

/* get_registro_id: tipo 0=usuario, 1=admin */
function get_registro_id($user,&$pass,&$idreg,&$tipo,&$fconfirma) {
  $salida= 0;
  $hoy 	 = date("Y-m-d H:i:s");

  try {
    $user     = strip_tags($user);
    if ($user!="" && $user != null) {
        /* Buscar en la tabla settings si es admin */
        $settingModel  = new SettingModel();
        $multiClause   = array('nombre'=> $user,'tipo' => 'user');
        $registros     = $settingModel->where($multiClause)->first();
        $idreg         = $registros["id"];
        $pass          = $registros["valor"];
        $tipo          = $registros["descripcion"];
        $fconfirma     = $hoy;
        $salida        = $idreg;
      }

  } catch (\Exception $e) {
    $salida=0;
  }
  return $salida;
}

/* valid_pass  */
function valid_pass($pass,$passreg,$user,$rol) {
  $valid=false;$id=0;
  try {
    $pass      = strip_tags($pass);
    $passreg   = strip_tags($passreg);
    $user      = strip_tags($user);
    $rol       = strip_tags($rol);

    if ($pass==encrypt_decrypt('d',$passreg)) { $valid = true;}
    if ($rol!=0 && !$valid && $passreg=="") {
      set_pass($user,$pass); $valid = true;
    }
  } catch (\Exception $e) {
    $valid = false;
  }
  return $valid;
}

/* set_pass */
function set_pass($user,$pass) {
  try {
    $user     = strip_tags($user);
    $pass     = strip_tags($pass);
    $passenc  = encrypt_decrypt('e',$pass);

    $settingModel  = new SettingModel();
    $multiClause   = array('nombre'=> $user);
    $registros     = $settingModel->where($multiClause)->first();
    $id            = $registros["id"];

    if ($id > 0) {
      $datos=['valor'=>$passenc];
      $settingModel->update($id,$datos);
    }
  } catch (\Exception $e) {

  }
}

/* set Login rol:  0=usuario, 1=admin */
function login($token,$id,$rol) {
  $reg    = 0;
  $salida = 0;
  $hoy    = date("Y-m-d H:i:s");

  try{
    $token   = strip_tags($token);
    $id      = strip_tags($id);
    $rol     = strip_tags($rol);

    if ($id>0) {
      setDataSession($token,$rol); // set session
      if ($rol==0) { // usuario
        update_login($id);
       }
    }
  } catch (\Exception $e) {
    $salida = 0;
  }
  return $salida;
}

/* logout  */
function logout() {
  $reg    = 0;
  $salida = 0;
  $hoy    = date("Y-m-d H:i:s");

  try {
    $token = 0; $rol= 0;
    $validtoken = validDataSession($token,$rol);
    $id         = encrypt_decrypt('d',$token);

    if ($id>0) {
      destroyDataSession(); // set session
      if ($rol==0) { // usuario
        update_logout($id);
       }
    }
  } catch (\Exception $e) {
    $salida = 0;
  }
  return $salida;
}

/***************************************************************************/
/*****************************    UTILITIES   ***********************************/
/***************************************************************************/

 function validarEntradaSql($param)
 {
   $existe=true;
   $cadena = strtoupper($param);

   $palabras_a_buscar = get_reserv_config();
   // Escapar las palabras a buscar para evitar problemas con caracteres especiales
   $palabras_a_buscar = array_map('preg_quote', $palabras_a_buscar); // Crear el patrón de regex combinando las palabras con el operador OR (|)
   $patron = '/\b(' . implode('|', $palabras_a_buscar) . ')\b/i';

   // Realizar la búsqueda utilizando preg_match_all
   if (preg_match_all($patron, $cadena, $matches)) {
    $existe=false;
  }
  return $existe;
 }

 function mensaje_error() {
  ob_start();
  header('HTTP/1.0 401 Unauthorized');
  echo '401 Unauthorized';
  exit;
}

?>
