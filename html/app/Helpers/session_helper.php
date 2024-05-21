<?php

  /* setDataSession */
  function setDataSession($token,$rol){
    $config = config('Session');
    $sessionExpiration = $config->expiration;

    $session = \Config\Services::session();

    $id      = encrypt_decrypt('d',$token);

    $newdata=['token'=>$token, 'id'=>$id,'rol'=>$rol];
    $session->set($newdata);

    // set expiration time
    //$session->markAsTempdata('token', $sessionExpiration);
    //$session->markAsTempdata('id', $sessionExpiration);
    //$session->markAsTempdata('rol', $sessionExpiration);
  }

  /* getDataSession */
  function getDataSession(&$id,&$rol){
    $session= \Config\Services::session();
    $token  = 0;
    $rol    = 0;

    if($session->has('token')){
      $token  = $session->get('token');
      $id     = $session->get('id');
      $rol    = $session->get('rol');
    }

    return $token;
  }

  /* destroyDataSession */
  function destroyDataSession(){
    $session= \Config\Services::session();
    $session->destroy();
  }

  /* validDataSession 0=no valido, 1=valido*/
  function validDataSession(&$token,&$rol){
    $valid  = false;
    $token  = getDataSession($id,$rol);
    $iddesc = encrypt_decrypt('d',$token);

    // Validar que exista el token y que sea igual al Id
    //if ($token!="" && $id == $iddesc) { $valid = true;}
    if ($token!="") { $valid = true;}

    return $valid;
  }

  /* setParamSession */
  function setParamSession($param,$value){
    $config = config('Session');
    $sessionExpiration = $config->expiration;

    $session= \Config\Services::session();

    $newdata=[$param=>$value];
    $session->set($newdata);

    // set expiration time
    //$session->markAsTempdata($param, $sessionExpiration);
  }

  /* getParamSession */
  function getParamSession($param){
    $session= \Config\Services::session();
    $value  = "";

    if($session->has($param)){
      $value  = $session->get($param);
    }
    return $value;
  }

 ?>