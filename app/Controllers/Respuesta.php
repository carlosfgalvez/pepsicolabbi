<?php
namespace App\Controllers;

class Respuesta extends BaseController
{
  /* Acción llamadas AJAX*/
  public function acc()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_POST["acc"]) || isset($_GET["acc"])) {
        /* Obtener la acción como parámetro*/
        $acc    =   strip_tags($this->request->getVar('acc'));
        $result = "";

        switch ($acc) {
      /******************************************************************************/
      /*******************  ENVIO ENCUESTA/LOGIN/LOGOUT ********************/
      /******************************************************************************/
      case 1:  /* envio encuesta */
           /* Obtener parametros */
           $ide   	= encrypt_decrypt('d',strip_tags($this->request->getVar('ide')));
           $pre   	= strip_tags($this->request->getVar('pre'));
           $res   	= strip_tags($this->request->getVar('res'));
           $inp   	= strip_tags($this->request->getVar('inp'));
           $uid     = strip_tags($this->request->getVar('uid'));

           if (validarEntradaSql($pre)&&validarEntradaSql($res)&validarEntradaSql($inp))
           {
             $result = enviar_encuesta($ide,$pre,$res,$inp,$uid);
           }
           else { mensaje_error(); }

           break;
      case 2:  /* envio datos personales */
           /* Obtener parametros */
           $nom   	= strip_tags($this->request->getVar('nom'));
           $ema     = strip_tags($this->request->getVar('ema'));
           $cel     = strip_tags($this->request->getVar('cel'));

           if (validarEntradaSql($nom)&&validarEntradaSql($ema)&validarEntradaSql($cel))
           {
             $result = enviar_encuesta_datospersonales($nom,$ema,$cel);
           }
           else { mensaje_error(); }

           break;
      case 3:  /* login */
  	      /* Obtener parametros */
          $ema     = strip_tags($this->request->getVar('ema'));
          $pass    = strip_tags($this->request->getVar('pass'));

  	      $result =  ingresar($ema,$pass);
       	  break;
      case 4:  /* logout */
          $result = logout(); // hacer logout
       	  break;
      case 5:  /* recuperar contraseña */
       	  break;
      case 6:  /* envio email recuperar contraseña*/
       	  break;
      case 7:  /* registro home */
          /* Obtener parametros */
          $nom   	= strip_tags($this->request->getVar('nom'));
          $ema     = strip_tags($this->request->getVar('ema'));
          $cel     = strip_tags($this->request->getVar('cel'));

          if (validarEntradaSql($nom)&&validarEntradaSql($ema)&validarEntradaSql($cel))
          {
            $result = enviar_form_registro_home($nom,$ema,$cel);
          }
          else { mensaje_error(); }

          break;

      /***************************************************/
      /*******************  CONSULTAS ********************/
      /***************************************************/
      case 100:  /* get_encuesta_count  */
            $id  = strip_tags($this->request->getVar('ide'));
            if ($id!="0") { $ide= encrypt_decrypt('d',$id);} else { $ide = $id;}

            if (is_numeric($ide)) {
              $count =0;
              $registros = get_encuesta_descarga_count($ide,$count);
              // $data['count_enviadas'] = $count;
              $result = $count;
              // $result = get_enviadas_count($ide);
              $result .= "|".get_enviadas_ultima($ide);
            }
            else {  mensaje_error(); }
   	        break;
      case 101:  /*  get registros */
   		     break;
      case 102:  /* get_encuesta_filtradas  */
              $id  = strip_tags($this->request->getVar('ide'));
              $inicio  = strip_tags($this->request->getVar('inicio'));
              $fin  = strip_tags($this->request->getVar('fin'));
              $ide= encrypt_decrypt('d',$id);
                $count =0;
                $registros = get_encuestas_filtradas($ide,$count,$inicio,$fin);
              return $registros;
          break;
      default:
            //$result = "Parámetro incorrecto: ".$acc);
            //break;
            mensaje_error();
    }
    } else {
      mensaje_error();
    }
  } else {
    mensaje_error();
  }

  $data['result'] = $result;

  return view('template/respuesta',$data);
 }

} // Respuesta controller
?>