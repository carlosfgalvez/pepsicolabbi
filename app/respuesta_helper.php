<?php
use App\Models\EncuestaModel;
use App\Models\EncuestaPreguntasModel;

/***************************************************************************/
/*****************************    ENCUESTAS   ***********************************/
/***************************************************************************/

/* get_encuestas_vigentes */
function get_encuestas_vigentes(){
  $result = [];  // arreglo

  try {
    $hoy 		       = date("Y-m-d H:i:s");
    $encuestaModel = new EncuestaModel();
    $registros     = $encuestaModel->where('activo','S')->OrderBy('orden','Asc')->findAll();

    foreach($registros as $reg) {
      if ($reg['fecha_inicio'] <= $hoy && $reg['fecha_fin'] >= $hoy) {
        $reg['idenc']  = encrypt_decrypt('e',$reg['id']);
        $result[] = $reg;
      }
    }

  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* get_encuesta */
function get_encuesta($id){
  $result = "";

  try {
    $encuestaModel = new EncuestaModel();
    $multiClause   = array('id' => $id, 'activo' => 'S');
    $result     = $encuestaModel->where($multiClause)->first();

    //$result = $registros;
  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}

/* get_encuesta_preguntas */
function get_encuesta_preguntas($idenc){
  $result = [];  // arreglo

  try {
    $encuestaPreguntasModel = new EncuestaPreguntasModel();
    $multiClause   = array('id_encuesta' => $idenc, 'activo' => 'S');
    $registros     = $encuestaPreguntasModel->where($multiClause)->OrderBy('orden','Asc')->findAll();

    /*
    foreach($registros as $reg) {
        $result[] = $reg;
    }
    */

    $result = $registros;
  } catch (\Exception $e) {
    return ($e->getMessage());
  }
  return $result;
}



/***************************************************************************/
/*****************************    UTILITIES   ***********************************/
/***************************************************************************/

 function validarEntradaSql($param)
 {
   $existe=true;
   $cadena = strtoupper($param);

  // $palabras_a_buscar = array("SCRIPT", "SELECT" , "UPDATE",  "INSERT" , "DELETE" , "GRANT" , "REVOKE"  ,"UNION" , "DROP" , "CREATE", "SUBSTR", "ASCII");
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
