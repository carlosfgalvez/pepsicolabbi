<?php

namespace App\Controllers;

class Encuesta extends BaseController
{
    public function formulario($id_cod=1): string
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData($id_cod);  // BaseController

      // encuesta
      $data['encuesta']  = "";
      $data['preguntas'] = "";
      $data['mensaje']   = "";

      $id_cod =strip_tags($id_cod);

      if (validarEntradaSql($id_cod))
      {

        if ($id_cod!=null) {
          //$id  = encrypt_decrypt('d',$idencrypt);

          // get encuesta
          $enc  = get_encuesta($id_cod);

          if ($enc!="" && $enc!=null) {
            $id = $enc['id'];
            $idencrypt  = encrypt_decrypt('e',$id);
            $data['encuesta']  = $enc;
            $data['idenc']     = $idencrypt;
            $data['view_navbar'] = view('template/navbar',$data);

            $mensaje = valid_encuesta($enc);

            if ($mensaje=="") { // Encuesta Ok
                $data['preguntas'] = get_encuesta_preguntas_opciones($id);
            }
          } else {
             //$mensaje = "Encuesta no encontrada";
             mensaje_error();
          }
          $data['mensaje'] = $mensaje;
        } else {
          mensaje_error();
        }

      } else {
        mensaje_error();
      }

      //var_dump($data);
      //var_dump($enc);
      return view("encuesta/index",$data);
    }

    public function gracias(): string
    {
      $idenv = getParamSession('idenv');
      $idenc = getParamSession('idenc');

      if ($idenc==null) { $$idenc=1;}

      // get encuesta
      $enc  = get_encuesta($idenc);

      // Obtener datos comunes a todas las vistas
      $data = $this->getData($enc['codigo'].'gracias');  // BaseController

      $data['encuesta'] = $enc;
      $data['idenv']    = $idenv;
      $data['idenc']    = $idenc;

      //var_dump($data);
      //var_dump($enc);
      //echo $idenv.' '.$idenc;
      return view("encuesta/gracias",$data);
  }
} // EncuestaController
?>
