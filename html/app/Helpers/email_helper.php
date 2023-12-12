<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\RegistroModel;
use App\Models\TicketModel;

//SMTP needs accurate times, and the PHP time zone MUST be set
date_default_timezone_set('America/Mexico_City');

//Create a new PHPMailer instance
require_once __DIR__.'/../ThirdParty/phpmailer/Exception.php';
require_once __DIR__.'/../ThirdParty/phpmailer/PHPMailer.php';
require_once __DIR__.'/../ThirdParty/phpmailer/SMTP.php';

 /* send_email_registro */
 function send_email_registro($idenc) {
   $id 	= encrypt_decrypt('d',$idenc);
   $accion = "send_email_registro: ".$id;
   $salida = "";

 	 if ($id != '') {
 	 	/* Registro */
    $registro = new RegistroModel();
    $registro = get_registro($id);

 		$fechahora  = date("d-m-Y H:i:s");
    $url        = base_url();
    /* Configs */
 		config_mail($emailout,$password,$host,$port,$logo,$correocontacto);

 		//$texto_mail = html_email_registro($registro['nombres'],$url,$registro['correo'],encrypt_decrypt('d',$registro['password']));

    $texto_mail  = '<img height="auto" src="'.$url.$logo.'" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100px;font-size:13px;" width="100"><br><br>';
    $texto_mail .= 'Hola '.$registro['nombres'].'<br><br> ¡Te damos la bienvenida a Ricitos de Oro Plan de Lealtad! Nos alegras que estes aquí.<br><br>';
    $texto_mail .= 'Tus accesos son los siguientes:';
    $texto_mail .= "<br>usuario: ".$registro['correo'];
    $texto_mail .= "<br>contraseña: ".encrypt_decrypt('d',$registro['password']);
    $texto_mail .= "<br><br><a href = '".$url."confirma?id=".$idenc."'>Confirma tu correo</a>";
    $texto_mail .= '<br><br>Saludos<br>Ricitos de Oro';

 	  $para  		= $registro['correo'];
 	  $de    		= $emailout;
 		$titulo   = '=?UTF-8?B?'.base64_encode("Registro Ricitos de Oro - Plan de lealtad").'?=';
    $cc 			= '';
    $bcc 			= '';

 		$mail = new PHPMailer();
 		//Tell PHPMailer to use SMTP
 		$mail->isSMTP();
 		//Enable SMTP debugging
 		// SMTP::DEBUG_OFF = off (for production use)
 		// SMTP::DEBUG_CLIENT = client messages
 		// SMTP::DEBUG_SERVER = client and server messages
 		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
 		//Set the hostname of the mail server
 		$mail->Host = $host;
 		//Set the SMTP port number - likely to be 25, 465 or 587
 		$mail->Port = $port;
 		//Whether to use SMTP authentication
 		$mail->SMTPAuth = true;
 		//Username to use for SMTP authentication
 		$mail->Username =  $de;
 		//CC copia
 		if ($cc!="") {$mail->addCC($cc);}
 		//BCC copia oculta
 		if ($bcc!="") {$mail->addBCC($bcc);}
 		//Password to use for SMTP authentication
 		$mail->Password = $password;
 		//Set who the message is to be sent from
 		$mail->setFrom( $de, utf8_decode('Ricitos de Oro'));
 		//Set an alternative reply-to address
 		//$mail->addReplyTo('correo@dominio.tld', 'Magic');
 		//Set who the message is to be sent to
 		$mail->addAddress($para);
 		//Set the subject line
 		$mail->Subject 	= $titulo;
 		$mail->Body 		= utf8_decode($texto_mail); // Mensaje a enviar
 		$mail->AltBody  = utf8_decode($texto_mail);

 		if ($registro['fecha_registro_email']==null) { // Si no se ha enviado el email
 		//if ($email!=null) {
 			//send the message, check for errors

 			if (!$mail->send()) {
 				$accion='Email NO enviado de registro id: '.$id.' para:'.$para.' de:'.$de.' host:'.$host.' port:'.$port.' error: '. $mail->ErrorInfo;
 			} else {
 				$salida = update_sendemail($id);
 				$accion='Email enviado de registro id: '.$id.' fecha actualizada: '.$salida;
 			}
 		} else {
 			$accion='Email ya habia sido enviado previamente de registro id: '.$id.' fecha: '.$registro['fecha_registro_email'];
 		}

     // fin envio email
     // log_write($accion,$iddinamica,'din');
  }
 	return $accion;
 }

 /* send_email_recuperar */
 function send_email_recuperar($id) {
    $accion = "send_email_recuperar: ".$id;
    $salida = "";

    if ($id != '') {
      /* Registro */
      $registro = get_registro($id);
      $idenc = encrypt_decrypt('e',$id);

      $fechahora  = date("d-m-Y H:i:s");
      $url        = base_url();

      /* configs */
      config_mail($emailout,$password,$host,$port,$logo,$correocontacto);
      $config = get_config_bd();

      //$texto_mail = html_email_recuperar($registro['nombres'],$url,$registro['correo'],encrypt_decrypt('e',$id),$config['tokenvigencia']);

      $texto_mail  = '<img height="auto" src="'.$url.$logo.'" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100px;font-size:13px;" width="100"><br><br>';
      $texto_mail .= "Hola ".$registro['nombres'].'<br><br> Soliciaste un restabecimiento de contraseña para la cuenta <strong>'.$registro["correo"].'</strong>, haz clic en el botón que aparece a continuación para cambiar tu contraeña';
      $texto_mail .= "<br><br><a href = '".$url."cambiar?id=".$idenc."'>Cambiar contraseña </a>";
      $texto_mail .= "<br><br>Si tu no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje.";
      $texto_mail .= "<br><br>Este enlace es solo válido dentro de los próximos ".$config["cfg_tokenvigencia"]." minutos.";
      $texto_mail .= '<br><br>Saludos<br>Ricitos de Oro';

/*
      $urlcambiar = $url."cambiar.php?id=".$id;
      $texto_mail  = '<img height="auto" src="'.$url.'/logo-doritos.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100px;font-size:13px;" width="100"><br><br>';
      $texto_mail .= "Hola ".$reg->nombres.'<br><br> Soliciaste un restabecimiento de contraseña para la cuenta <strong>'.$reg->correo.'</strong> haz clic en el botón que aparece a continuación para cambiar tu contraeña';
      $texto_mail .= "<br><br><a href = '$urlcambiar'>Cambiar contraseña </a>";
      $texto_mail .= "<br><br>Si tu no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje.";
      $texto_mail .= "<br><br>Este enlace es solo válido dentro de los próximos ".$reg->$tokenvigencia." minutos.";
      $texto_mail .= '<br><br>Saludos<br>Doritos';
*/
     $para  		= $registro['correo'];
     $de    		= $emailout;
     $titulo    = '=?UTF-8?B?'.base64_encode("Recuperar contraseña Ricitos de Oro - Plan de lealtad").'?=';
     $cc        = '';
     $bcc 			= '';

     $mail = new PHPMailer();
     //Tell PHPMailer to use SMTP
     $mail->isSMTP();
     //Enable SMTP debugging
     // SMTP::DEBUG_OFF = off (for production use)
     // SMTP::DEBUG_CLIENT = client messages
     // SMTP::DEBUG_SERVER = client and server messages
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     //Set the hostname of the mail server
     $mail->Host = $host;
     //Set the SMTP port number - likely to be 25, 465 or 587
     $mail->Port = $port;
     //Whether to use SMTP authentication
     $mail->SMTPAuth = true;
     //Username to use for SMTP authentication
     $mail->Username =  $de;
     //CC copia
     if ($cc!="") {$mail->addCC($cc);}
     //BCC copia oculta
     if ($bcc!="") {$mail->addBCC($bcc);}
     //Password to use for SMTP authentication
     $mail->Password = $password;
     //Set who the message is to be sent from
     $mail->setFrom( $de, utf8_decode('Ricitos de Oro'));
     //Set an alternative reply-to address
     //$mail->addReplyTo('correo@dominio.tld', 'Magic');
     //Set who the message is to be sent to
     $mail->addAddress($para);
     //Set the subject line
     $mail->Subject 	= $titulo;
     $mail->Body 		= utf8_decode($texto_mail); // Mensaje a enviar
     $mail->AltBody  = utf8_decode($texto_mail);

     if (!$mail->send()) {
       $accion='Email NO enviado de recuperar contraseña id: '.$id.' para:'.$para.' de:'.$de.' host:'.$host.' port:'.$port.' error: '. $mail->ErrorInfo;
     } else {
       $salida = update_sendemail_recuperar($id);
       $accion='Email enviado de recuperar contraseña id: '.$id.' fecha actualizada: '.$salida;
     }

     // fin envio email
     // log_write($accion,$iddinamica,'din');
    }

    return $accion;
   }

   /* send_email_ticket_rechazo */
   function send_email_ticket_rechazo($id) {
     $accion = "send_email_ticket_rechazo: ".$id;
     $salida = "";

   	 if ($id != '') {
   	 	/* Ticket */
      $ticket = new TicketModel();
      $ticket = get_ticket($id);

      /* Registro */
      $registro = get_registro($ticket['id_registro']  );

   		$fechahora  = date("d-m-Y H:i:s");
      $url        = base_url();
      /* Configs */
   		config_mail($emailout,$password,$host,$port,$logo,$correocontacto);

   		//$texto_mail = html_email_registro($registro['nombres'],$url,$registro['correo'],encrypt_decrypt('d',$registro['password']));

      $texto_mail  = '<img height="auto" src="'.$url.$logo.'" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100px;font-size:13px;" width="100"><br><br>';
      $texto_mail .= 'Hola '.$registro['nombres'].'<br><br> Tu ticket cargado el día '.$ticket['fechacarga'].' fue rechazado<br><br>';
      $texto_mail .= '<img height="auto" src="'.$url.'public/uploads/'.$ticket['archivo'].'" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:400px;font-size:13px;" width="400"><br><br>';
      $texto_mail .= $ticket['motivo_rechazo'];
      $texto_mail .= "<br><br><a href = '".$url."carga'>Carga otro ticket</a>";
      $texto_mail .= '<br><br>Saludos<br>Ricitos de Oro';

   	  $para  		= $registro['correo'];
   	  $de    		= $emailout;
   		$titulo   = '=?UTF-8?B?'.base64_encode("Ticket rechazado Ricitos de Oro - Plan de lealtad").'?=';
      $cc 			= '';
      $bcc 			= '';

   		$mail = new PHPMailer();
   		//Tell PHPMailer to use SMTP
   		$mail->isSMTP();
   		//Enable SMTP debugging
   		// SMTP::DEBUG_OFF = off (for production use)
   		// SMTP::DEBUG_CLIENT = client messages
   		// SMTP::DEBUG_SERVER = client and server messages
   		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
   		//Set the hostname of the mail server
   		$mail->Host = $host;
   		//Set the SMTP port number - likely to be 25, 465 or 587
   		$mail->Port = $port;
   		//Whether to use SMTP authentication
   		$mail->SMTPAuth = true;
   		//Username to use for SMTP authentication
   		$mail->Username =  $de;
   		//CC copia
   		if ($cc!="") {$mail->addCC($cc);}
   		//BCC copia oculta
   		if ($bcc!="") {$mail->addBCC($bcc);}
   		//Password to use for SMTP authentication
   		$mail->Password = $password;
   		//Set who the message is to be sent from
   		$mail->setFrom( $de, utf8_decode('Ricitos de Oro'));
   		//Set an alternative reply-to address
   		//$mail->addReplyTo('correo@dominio.tld', 'Magic');
   		//Set who the message is to be sent to
   		$mail->addAddress($para);
   		//Set the subject line
   		$mail->Subject 	= $titulo;
   		$mail->Body 		= utf8_decode($texto_mail); // Mensaje a enviar
   		$mail->AltBody  = utf8_decode($texto_mail);

      if (!$mail->send()) {
        $accion='Email NO enviado de rechazo de ticket id: '.$id.' error: '. $mail->ErrorInfo;
      } else {
        $accion='Email de rechazo de ticket id: '.$id.' enviado.';
      }

       // fin envio email
       // log_write($accion,$iddinamica,'din');
    }
   	return $accion;
   }


   // Configuración correo saliente
   function config_mail(&$emailout,&$password,&$host,&$port,&$logo,&$correocontacto) {
    $config = config('Config');
    $correocontacto = $config->email_contacto;
    $logo           = $config->img_logomail;

    $config2  = config('Email');
    $host     = $config2->SMTPHost;
    $emailout = $config2->SMTPUser;
    $password = $config2->SMTPPass;
    $port     = $config2->SMTPPort;
   }


/*************************************************************************/
/***********************   HTML de los correos ***************************/
/*************************************************************************/

/* html_email_registro */
function html_email_registro($nombre,$url,$usuario,$password) {
  $redesSociales = html_email_redessociales($url);
  $texto_mail =	'
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style type="text/css">
              v\:* { behavior: url(#default#VML); display:inline-block}
          </style>
          <link href="'.$url.'/fonts/DoritosHeadline_MdIt[1].woff2" rel="stylesheet" type="text/css">
          <style type="text/css">
            @import url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2);
            @font-face {
                font-family: "DoritosHeadline_MdIt";
                font-style: normal;
                src: url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2) format("woff2");
            }
            .fondo {
                  width: 100%;
                  position: absolute;
                  top: 0px;
                  left: 0px;
                  z-index: -1;
              }
          </style>
      </head>

      <body  style="word-spacing:normal;">
          <div>
          <table align="center" background="'.$url.'/images/Mail-Fondo-Full.jpg" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff url('.$url.'/images/Mail-Fondo-Full.jpg) top center / cover repeat;width:100%;">
              <tr>
                  <td align="center">
                      <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;margin-top: 215px;width: 600px;">
                          Hola '.$nombre.',
                      </div>
                  </td>
              </tr>
              <tr>
                  <td align="center">
                      <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                          ¡Te damos la bienvenida a Doritos! Nos alegra que estés aquí.
                      </div>
                  </td>
              </tr>
              <tr>
                  <td align="center">
                      <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                          Doritos cuenta con una gran y divertida comunidad en el mundo y hemos apartado un lugar solo para ti.
                      </div>
                  </td>
              </tr>
              <tr>
                  <td align="center">
                      <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                          Con la promoción Doritos Loot podrás participar y ganar grandes premios.
                      </div>
                  </td>
              </tr>
              <tr>
                <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Tus accesos son los siguientes:
                  </div>
                </td>
              </tr>
              <tr>
                <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Usuario: '.$usuario.'
                  </div>
                </td>
              </tr>
              <tr>
                <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Contraseña: '.$password.'
                  </div>
                </td>
              </tr>
              <tr>
                  <td style="text-align: center; padding-top:25px;">
                      <a href="'.base_url('login').'">
                          <img alt="boton-iniciar-sesion"
                              src="'.$url.'/images/Inicia-Sesion_Boton.png"
                              class="boton-img centrado ax-center" />
                      </a>
                  </td>
              </tr>
              <tr>
                  <td style="text-align: center;">
                      '.$redesSociales.'
                      <div class="col-12 ps-0 pe-0 text-center" width="100%" style="text-align: center;">
                          <img alt="separador"
                              src="'.$url.'/images/Doritos-Home_SEPARADOR-COLORES.png"
                              class="w-25" style="width:25%;margin-top:30px; margin-bottom: 20px;" />
                          <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:12px;line-height:1;text-align:left;color:gray; text-align: center;margin-bottom: 30px;">
                              Estás recibiendo este correo porque eres un participante muy valioso para la comunidad de Doritos.
                          </div>
                      </div>
                  </td>
              </tr>
          </table>
          </div>
      </body>

  </html>';

  return $texto_mail;
}

/* html_email_recuperar */
function html_email_recuperar($nombre,$url,$correo,$id,$tiempo) {
  $redesSociales = html_email_redessociales($url);
  $texto_mail =	'
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style type="text/css">
              v\:* { behavior: url(#default#VML); display:inline-block}
          </style>
          <link href="'.$url.'/fonts/DoritosHeadline_MdIt[1].woff2" rel="stylesheet" type="text/css">
          <style type="text/css">
            @import url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2);
            @font-face {
                font-family: "DoritosHeadline_MdIt";
                font-style: normal;
                src: url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2) format("woff2");
            }
            .fondo {
                  width: 100%;
                  position: absolute;
                  top: 0px;
                  left: 0px;
                  z-index: -1;
              }
          </style>
      </head>

      <body  style="word-spacing:normal;">
          <div>
          <table align="center" background="'.$url.'/images/Mail-Fondo-Full.jpg" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff url('.$url.'/images/Mail-Fondo-Full.jpg) top center / cover repeat;width:100%;">

          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;margin-top: 215px;width: 600px;">
                      Hola '.$nombre.',
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Se solicitó un reestablecimiento de contraseña para tu cuenta '.$correo.', haz clic en el botón que aparece a continuación para cambiar tu contraseña.
                  </div>
              </td>
          </tr>
          <tr>
              <td style="text-align: center; padding:45px;">
                  <a href="'.replace_http(base_url('cambiar')).'">
                      <img alt="boton-cambio-pass" height="50px"
                          src="'.$url.'/images/Mail_BOTON_Cambiar-Contraseña.png"
                          class="boton-img centrado ax-center" />
                  </a>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:10pt;line-height:1;text-align:left;color:gray;width: 600px;margin-top: 20px;">
                      Si tu no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje.
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:10pt;line-height:1;text-align:left;color:gray;width: 600px;margin-top: 20px;">
                      Este enlace solo es válido dentro de los próximos <span style="color:white">'.$tiempo.'</span> minutos.
                  </div>
              </td>
          </tr>

              <tr>
                  <td style="text-align: center;">
                      '.$redesSociales.'
                      <div class="col-12 ps-0 pe-0 text-center" width="100%" style="text-align: center;">
                          <img alt="separador"
                              src="'.$url.'/images/Doritos-Home_SEPARADOR-COLORES.png"
                              class="w-25" style="width:25%;margin-top:30px; margin-bottom: 20px;" />
                          <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:12px;line-height:1;text-align:left;color:gray; text-align: center;margin-bottom: 30px;">
                              Estás recibiendo este correo porque eres un participante muy valioso para la comunidad de Doritos.
                          </div>
                      </div>
                  </td>
              </tr>
          </table>
          </div>
      </body>

  </html>';

  return $texto_mail;
}

/* html_email_rechazo */
function html_email_rechazo($nombre,$url) {
  $redesSociales = html_email_redessociales($url);
  $texto_mail =	'
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style type="text/css">
              v\:* { behavior: url(#default#VML); display:inline-block}
          </style>
          <link href="'.$url.'/fonts/DoritosHeadline_MdIt[1].woff2" rel="stylesheet" type="text/css">
          <style type="text/css">
            @import url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2);
            @font-face {
                font-family: "DoritosHeadline_MdIt";
                font-style: normal;
                src: url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2) format("woff2");
            }
            .fondo {
                  width: 100%;
                  position: absolute;
                  top: 0px;
                  left: 0px;
                  z-index: -1;
              }
          </style>
      </head>

      <body  style="word-spacing:normal;">
          <div>
          <table align="center" background="'.$url.'/images/Mail-Fondo-Full.jpg" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff url('.$url.'/images/Mail-Fondo-Full.jpg) top center / cover repeat;width:100%;">

          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;margin-top: 215px;width: 600px;">
                      Hola '.$nombre.',
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Esperamos que este mensaje te encuentre bien. Queríamos informarte que hemos recibido tu imagen para nuestra promoción con Doritos en nuestro sitio web.
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Sin embargo, lamentablemente no podemos aceptarla debido a que no cumple con los lineamientos establecidos para esta dinámica en particular.
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                  Nosotros valoramos tu participación y apreciamos el interés que has mostrado en nuestra promoción. Te invitamos a seguir participando y puedas compartir tus creaciones.
                  </div>
              </td>
          </tr>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                  Saludos,<br>
                  Doritos
                  </div>
              </td>
          </tr>

          <tr>
              <td style="text-align: center; padding-top:25px;">
                  <a href="'.replace_http(base_url('login')).'">
                      <img alt="boton-cambio-pass" height="50px"
                          src="'.$url.'/images/Mail_BOTON_Cargar-Otra-Imagen.png"
                          class="boton-img centrado ax-center" />
                  </a>
              </td>
          </tr>

              <tr>
                  <td style="text-align: center;">
                      '.$redesSociales.'
                      <div class="col-12 ps-0 pe-0 text-center" width="100%" style="text-align: center;">
                          <img alt="separador"
                              src="'.$url.'/images/Doritos-Home_SEPARADOR-COLORES.png"
                              class="w-25" style="width:25%;margin-top:30px; margin-bottom: 20px;" />
                          <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:12px;line-height:1;text-align:left;color:gray; text-align: center;margin-bottom: 30px;">
                              Estás recibiendo este correo porque eres un participante muy valioso para la comunidad de Doritos.
                          </div>
                      </div>
                  </td>
              </tr>
          </table>
          </div>
      </body>

  </html>';

  return $texto_mail;
}

/* html_email_contacto */
function html_email_contacto($nom,$url,$men,$ema) {
  $redesSociales = html_email_redessociales($url);
  $texto_mail =	'
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style type="text/css">
              v\:* { behavior: url(#default#VML); display:inline-block}
          </style>
          <link href="'.$url.'/fonts/DoritosHeadline_MdIt[1].woff2" rel="stylesheet" type="text/css">
          <style type="text/css">
            @import url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2);
            @font-face {
                font-family: "DoritosHeadline_MdIt";
                font-style: normal;
                src: url('.$url.'/fonts/DoritosHeadline_MdIt[1].woff2) format("woff2");
            }
            .fondo {
                  width: 100%;
                  position: absolute;
                  top: 0px;
                  left: 0px;
                  z-index: -1;
              }
          </style>
      </head>

      <body  style="word-spacing:normal;">
          <div>
          <table align="center" background="'.$url.'/images/Mail-Fondo-Full.jpg" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff url('.$url.'/images/Mail-Fondo-Full.jpg) top center / cover repeat;width:100%;">

          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;margin-top: 215px;width: 600px;">
                      <span style="for-weight:bold">'.$nom.'</span> escribió,
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                        '.$men.'
                  </div>
              </td>
          </tr>
          <tr>
              <td align="center">
                  <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:14pt;line-height:1;text-align:left;color:white;width: 600px;margin-top: 20px;">
                      Correo de contacto: '.$ema.'
                  </div>
              </td>
          </tr>
          <br><br><br>

              <tr>
                  <td style="text-align: center;">
                      '.$redesSociales.'
                      <div class="col-12 ps-0 pe-0 text-center" width="100%" style="text-align: center;">
                          <img alt="separador"
                              src="'.$url.'/images/Doritos-Home_SEPARADOR-COLORES.png"
                              class="w-25" style="width:25%;margin-top:30px; margin-bottom: 20px;" />
                          <div style="font-family:DoritosHeadline_MdIt, Arial;font-size:12px;line-height:1;text-align:left;color:gray; text-align: center;margin-bottom: 30px;">
                              Estás recibiendo este correo porque eres un participante muy valioso para la comunidad de Doritos.
                          </div>
                      </div>
                  </td>
              </tr>
          </table>
          </div>
      </body>

  </html>';

  return $texto_mail;
}

function html_email_redessociales($url) {
  $redessociales = '
  <div class="col-12 ps-0 pe-0 text-center" width="100%" style="text-align: center;margin-top:25px;">
  <a href="https://www.facebook.com/DoritosMX/" style="padding:7px;text-decoration:none;">
      <img alt="facebook" height="38px"
          src="'.$url.'/images/Mail_REDES_FB.png"
          class="boton-img centrado ax-center" />
  </a>
  <a href="https://twitter.com/Doritos_Mx" style="padding:7px;text-decoration:none;">
      <img alt="twitter" height="38px"
          src="'.$url.'/images/Mail_REDES_TW.png"
          class="boton-img centrado ax-center" />
  </a>
  <a href="https://www.instagram.com/doritos_mx/" style="padding:7px;text-decoration:none;">
      <img alt="instagram" height="38px"
          src="'.$url.'/images/Mail_REDES_IG.png"
          class="boton-img centrado ax-center" />
  </a>
  <a href="https://www.youtube.com/user/DoritosMXOficial" style="padding:7px;text-decoration:none;">
      <img alt="youtube" height="38px"
          src="'.$url.'/images/Mail_REDES_YT.png"
          class="boton-img centrado ax-center" />
  </a>
  </div>';
  return $redessociales;
}

?>
