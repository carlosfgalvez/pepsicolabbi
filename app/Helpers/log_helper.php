<?php
use App\Models\LogModel;

/* log_write_bd */
function log_write_bd($idaccion,$modulo,$accion,$descripcion,$huella=null) {
  $ip      = getRealIP();
  $hoy 		 = date("Y-m-d H:i:s");
  $token   = getDataSession($id,$rol);
  $idregistro = 0;

  if ($id==null || $id=="") {$id=$huella;}

  $datos=[
    'id_accion'=>$idaccion,
    'modulo'=>$modulo,
    'accion'=>$accion,
    'descripcion'=>$descripcion,
    'ip'=>$ip,
    'fecha_log'=>$hoy,
    'usuario'=>$id,
    'rol'=>$rol,
  ];

  $logModel = new LogModel();
  $result = $logModel->insert($datos);

  if($result){
    $idregistro = $logModel->insertID;
  }

  return $idregistro;
}

?>
