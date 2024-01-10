<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EncuestaModel;
use App\Models\EncuestaPreguntasModel;
use App\Models\EncuestaPreguntaOpcionesModel;

class Encuestas extends BaseController
{
    /**************************** Encuestas encabezado***************************/

    /* Index */
    public function index($page=null) {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController

      // Validar la sessión
      if (validDataSession($token,$rol)) {
        // Obtener datos del usuario
        $id  = $data['id'];
        $data['reg'] = get_registro_admin($id);

        $page =strip_tags($page);  if ($page==null) { $page=1;}
        $size = $data['cfg_pagesize']; if ($size==null) { $size=10;}

        $registros = []; // array
        $encuestaModel = new EncuestaModel();
        $count         = $encuestaModel->countAllResults();
        $registros     = $encuestaModel->OrderBy('id','Asc')->findAll($size,($page-1)*$size); //Limit, offset;

        if ($page*$size < $count){
           $page++;
           $data['page']   = $page;
        } else {
          $data['count']   = $count;
          $data['page']    = 0;
        }

        // Agregar el id encryptado
        $result = [];  // arreglo
        foreach($registros as $reg) {
          $reg['idenc']  = encrypt_decrypt('e',$reg['id']);
          $result[] = $reg;
        }

        $data['count']       = count($registros); //$count;
        $data['registros']   = $result;
        $data['view_navbar'] = view('template/navbar',$data);

        $view = "encuestas/list";
      } else {
        $view = "home/login";
      }

      //var_dump($data);
      return view($view,$data);
    }

    /* Create */
    public function create() {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController

      return view('encuestas/create',$data);
    }

    /* Edit */
    public function edit($id=null)
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController
      $id = encrypt_decrypt('d',$id);

      $id = strip_tags($id);
      $encuestaModel = new EncuestaModel();
      $data['reg'] = $encuestaModel->where('id',$id)->first();
      $data['view_navbar'] = view('template/navbar',$data);

      return view('encuestas/edit',$data);
    }

    /* Save: insert/update */
    public function save() {
      $msg = "";$cod = 0;
      $encuestaModel = new EncuestaModel();

      $id               = $this->request->getVar('id');
      $nombre           = $this->request->getVar('nombre');
      $descripcion      = $this->request->getVar('descripcion');
      $codigo           = $this->request->getVar('codigo');
      $imgportada       = $this->request->getVar('img_portada');
      $imgfondo         = $this->request->getVar('img_fondo');
      $colortxt         = $this->request->getVar('color_txt');
      $fechainicio      = $this->request->getVar('fecha_inicio');
      $fechafin         = $this->request->getVar('fecha_fin');
      $datospersonales  = $this->request->getVar('datos_personales');
      $duplicidad       = $this->request->getVar('duplicidad');
      $orden            = $this->request->getVar('orden');
      $activo           = $this->request->getVar('activo');

      if ($this->validate('encuestas')) {  // Ok
        $datos=[
          'nombre'=>$nombre,
          'descripcion'=>$descripcion,
          'codigo'=>$codigo,
          'img_portada'=>$imgportada,
          'img_fondo'=>$imgfondo,
          'color_txt'=>$colortxt,
          'fecha_inicio'=>$fechainicio,
          'fecha_fin'=>$fechafin,
          'datos_personales'=>$datospersonales,
          'duplicidad'=>$duplicidad,
          'orden'=>$orden,
          'activo'=>$activo
        ];

        if ($id==null) {
           $encuestaModel->insert($datos);
           $msg = "La encuesta fue agregada";$cod=1;
        } else {
           $encuestaModel->update($id,$datos);
           $msg = "La encuesta fue guardada";$cod=1;
        }
        //return $this->response->redirect(site_url('/encuestas'))->with('msg', $msg)->with('cod', $cod);
        return redirect()->to( site_url('/encuestas') )->with('msg', $msg)->with('cod', $cod);

      } else {

        //var_dump($validation);
        //$session = session();
        //$session->setFlashdata('mensaje','Revise la información.');
        //$data['validation'] = $this->validator;
        //echo view('settings/'create, $data);
        return redirect()->back()->withInput();
      }

    }

    /* Delete */
    public function delete($id=null) {
      $id =strip_tags($id);
      $id = encrypt_decrypt('d',$id);

      $encuestaModel = new EncuestaModel();
      $reg = $encuestaModel->delete($id);
      $msg = "La encuesta fue eliminada";$cod=0;

      return redirect()->to( site_url('/encuestas') )->with('msg', $msg)->with('cod', $cod);
    }

    /**************************** Preguntas ****************************/

    /* Index preguntas*/
    public function indexpreg($page=null,$ideencryp=0) {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController

      // Validar la sessión
      if (validDataSession($token,$rol)) {
        // Obtener datos del usuario
        $id  = $data['id'];
        $data['reg'] = get_registro_admin($ideencryp);
        $data['ideencryp']  = $ideencryp;

        // filtro encuesta
        $ide  = encrypt_decrypt('d',$ideencryp);

        // Listas
        $data['list_encuestas']  = get_list_encuestas($ide,"(Seleccione una encuesta)");

        $page =strip_tags($page);  if ($page==null) { $page=1;}
        $size = $data['cfg_pagesize']; if ($size==null) { $size=10;}

        $registros = []; // array
        $encuestapreguntasModel = new EncuestaPreguntasModel();
        $count      = $encuestapreguntasModel->Where('id_encuesta',$ide)->countAllResults();

        if ($page*$size < $count){
          //if ($ide!="0"){
            $registros  = $encuestapreguntasModel->Where('id_encuesta',$ide)->OrderBy('id_encuesta','Asc')->OrderBy('orden','Asc')->findAll($page*$size,0); //Limit, offset
            $page++;
          //}
          $data['page']   = $page;
        } else {
          $registros  = $encuestapreguntasModel->Where('id_encuesta',$ide)->OrderBy('id_encuesta','Asc')->OrderBy('orden','Asc')->findAll();
          $data['page']    = 0;
        }

        // Agregar el id de la encuesta encryptado
        $result = [];  // arreglo
        foreach($registros as $reg) {
          $reg['idenc']  = encrypt_decrypt('e',$reg['id']);
          $result[] = $reg;
        }

        $data['registros']   = $result;
        $data['count']       = $count;
        //$data['count']       = count($registros); //$count;
        $data['view_navbar'] = view('template/navbar',$data);

        $view = "encuestas/listpreg";
      } else {
        $view = "home/login";
      }

      return view($view,$data);
    }

    /* Create preguntas */
    public function createpreg($ideencryp=0) {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController
      $data['ideencryp']  = $ideencryp;
      $data['ide']        = encrypt_decrypt('d',$ideencryp);
      $data['view_navbar'] = view('template/navbar',$data);

      return view('encuestas/createpreg',$data);
    }

    /* Edit preguntas */
    public function editpreg($id=null,$ideencryp=0)
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController
      $data['ideencryp']  = $ideencryp;
      $data['ide']        = encrypt_decrypt('d',$ideencryp);

      $id = strip_tags($id);
      $encuestapreguntasModel = new EncuestaPreguntasModel();
      $data['reg'] = $encuestapreguntasModel->where('id',$id)->first();
      $data['view_navbar'] = view('template/navbar',$data);

      return view('encuestas/editpreg',$data);
    }

    /* Save: insert/update preguntas */
    public function savepreg() {
      $msg = "";$cod = 0;
      $encuestapreguntasModel = new EncuestaPreguntasModel();

      $id               = $this->request->getVar('id');
      $idencuesta       = $this->request->getVar('id_encuesta');
      $pregunta         = $this->request->getVar('pregunta');
      $tipo             = $this->request->getVar('tipo');
      $requerido        = $this->request->getVar('requerido');
      $orden            = $this->request->getVar('orden');
      $activo           = $this->request->getVar('activo');

      if ($this->validate('preguntas')) {  // Ok
        $datos=[
          'id_encuesta'=>$idencuesta,
          'pregunta'=>$pregunta,
          'tipo'=>$tipo,
          'requerido'=>$requerido,
          'orden'=>$orden,
          'activo'=>$activo
        ];

        if ($id==null) {
           $encuestapreguntasModel->insert($datos);
           $msg = "La pregunta fue agregada";$cod=1;
        } else {
           $encuestapreguntasModel->update($id,$datos);
           $msg = "La preguta fue guardada";$cod=1;
        }
        $ide  = encrypt_decrypt('e',$idencuesta);
        return redirect()->to( site_url('preguntas/1/'.$ide) )->with('msg', $msg)->with('cod', $cod);

      } else {

        return redirect()->back()->withInput();
      }

    }

    /* Delete preguntas */
    public function deletepreg($id=null,$ideencryp=0) {
      $id =strip_tags($id);
      $encuestapreguntasModel = new EncuestaPreguntasModel();
      $reg = $encuestapreguntasModel->delete($id);
      $msg = "La pregunta fue eliminada";$cod=0;

      return redirect()->to( site_url('/preguntas/1/'.$ideencryp) )->with('msg', $msg)->with('cod', $cod);
    }

      /**************************** Opciones ****************************/

      /* Index opciones*/
      public function indexopc($page=null,$ideencryp=0,$idpencryp=0) {
        // Obtener datos comunes a todas las vistas
        $data = $this->getData('admin');  // BaseController
        $data['page']   = $page;
        $count = 0;

        // Validar la sessión
        if (validDataSession($token,$rol)) {
          // Obtener datos del usuario
          $id  = $data['id'];
          $data['reg'] = get_registro_admin($id);
          $data['ideencryp'] = $ideencryp;
          $data['idpencryp'] = $idpencryp;

          // filtro encuesta / pregunta
          $ide  = encrypt_decrypt('d',$ideencryp);
          $idp  = encrypt_decrypt('d',$idpencryp);
          $data['idp'] = $idp;

          //return 'indexopc: '.$ideencryp.' '.$ide.' '.$idpencryp.' '.$idp.' x:'.encrypt_decrypt('d',$idpencryp);

          // Listas
          $data['list_encuestas']  = get_list_encuestas($ide,"(Seleccione una encuesta)");
          $data['list_preguntas']  = get_list_preguntas($ide,$idp,"(Todas las preguntas)");

          $page =strip_tags($page);  if ($page==null) { $page=1;}
          $size = $data['cfg_pagesize']; if ($size==null) { $size=10;}

          $registros = []; // array

          if ($idp!="0"){
              $encuestapreguntaopcionesModel = new EncuestaPreguntaOpcionesModel();
              $multiClause   = array('id_encuesta'=> $ide, 'id_pregunta' => $idp);
              $count       = $encuestapreguntaopcionesModel->Where($multiClause)->countAllResults();

              //$multiClause   = array('id_encuesta'=> $ide, 'id_pregunta' => $idp);
              //$registros   = $encuestapreguntaopcionesModel->Where($multiClause)->OrderBy('id_pregunta','Asc')->OrderBy('id_encuesta','Asc')->OrderBy('orden','Asc')->findAll($size,($page-1)*$size); //Limit, offset

              if ($page*$size < $count){
                //if ($ide!="0"){
                  $registros  = $encuestapreguntaopcionesModel->Where($multiClause)->OrderBy('id_pregunta','Asc')->OrderBy('id_encuesta','Asc')->OrderBy('orden','Asc')->findAll($page*$size,0); //Limit, offset
                  $page++;
                //}
                $data['page']   = $page;
              } else {
                $registros  = $encuestapreguntaopcionesModel->Where($multiClause)->OrderBy('id_pregunta','Asc')->OrderBy('id_encuesta','Asc')->OrderBy('orden','Asc')->findAll();
                $data['page']    = 0;
              }
          } // idp = 0
          // Agregar el id de la encuesta encryptado
          $result = [];  // arreglo
          foreach($registros as $reg) {
            $reg['idenc']  = encrypt_decrypt('e',$reg['id']);
            $result[] = $reg;
          }

          $data['registros']   = $result;
          $data['count']       = $count;
          //$data['count']       = count($registros); //$count;
          $data['view_navbar'] = view('template/navbar',$data);

          $view = "encuestas/listopc";
        } else {
          $view = "home/login";
        }

      //var_dump($data);
      return view($view,$data);
    }

    /* Create opciones */
    public function createopc($idp=null,$ideencryp=0) {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController
      $data['ideencryp']  = $ideencryp;
      $data['ide']        = encrypt_decrypt('d',$ideencryp);
      $data['idp']        = $idp;
      $data['view_navbar'] = view('template/navbar',$data);

      $data['clases'] = get_clases_css(null);

      $upload_dir = $data['upload_dir'];
      $data['imagesopc'] = get_images_anebles($upload_dir,null);

      return view('encuestas/createopc',$data);
    }

    /* Edit opciones */
    public function editopc($ido=null,$idp=null,$ideencryp=0)
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController
      $data['ideencryp']  = $ideencryp;
      $data['ide']        = encrypt_decrypt('d',$ideencryp);
      $data['ido']        = $ido;
      $data['idp']        = $idp;

      $ido = strip_tags($ido);
      $encuestapreguntaOpcionesModel = new EncuestaPreguntaOpcionesModel();
      $data['reg'] = $encuestapreguntaOpcionesModel->where('id',$ido)->first();
      $data['view_navbar'] = view('template/navbar',$data);

      
      $imgclass = '';
      $imgname = '';
      if($data['reg']['img_opcion'] != ''){
        $image = explode(";", $data['reg']['img_opcion']);
        $imgname = $image[0];
        if(sizeof($image) >= 2){
          $imgclass = $image[1];
        }
      }
      
      $data['clases'] = get_clases_css($imgclass);

      $upload_dir = $data['upload_dir'];
      $data['imagesopc'] = get_images_anebles($upload_dir,$imgname); 
      
      return view('encuestas/editopc',$data);
    }

    /* Save: insert/update opciones */
    public function saveopc() {
      $msg = "";$cod = 0;
      $encuestapreguntaOpcionesModel = new EncuestaPreguntaOpcionesModel();

      $id               = $this->request->getVar('id');
      $idencuesta       = $this->request->getVar('id_encuesta');
      $idpregunta       = $this->request->getVar('id_pregunta');
      $opcion           = $this->request->getVar('opcion');
      $input            = $this->request->getVar('input');
      $requerido        = $this->request->getVar('requerido');
      $imgopcion        = $this->request->getVar('img_opcion');
      $claseopcion      = $this->request->getVar('img_clase');
      $imgalto          = $this->request->getVar('img_alto');
      $imgancho         = $this->request->getVar('img_ancho');
      $orden            = $this->request->getVar('orden');
      $activo           = $this->request->getVar('activo');

      if($claseopcion != ''){
        $imagenoption = $imgopcion.';'.$claseopcion;
      }else{
        $imagenoption = $imgopcion;
      }
      

      if ($this->validate('opciones')) {  // Ok
        $datos=[
          'id_encuesta'=>$idencuesta,
          'id_pregunta'=>$idpregunta,
          'opcion'=>$opcion,
          'input'=>$input,
          'requerido'=>$requerido,
          'img_opcion'=>$imagenoption,
          'img_alto'=>$imgalto,
          'img_ancho'=>$imgancho,
          'orden'=>$orden,
          'activo'=>$activo
        ];

        if ($id==null) {
           $encuestapreguntaOpcionesModel->insert($datos);
           $msg = "La opción fue agregada";$cod=1;
        } else {
           $encuestapreguntaOpcionesModel->update($id,$datos);
           $msg = "La opción fue guardada";$cod=1;
        }
        $ide  = encrypt_decrypt('e',$idencuesta);
        $idp  = encrypt_decrypt('e',$idpregunta);
        return redirect()->to( site_url('/opciones/1/'.$ide.'/'.$idp))->with('msg', $msg)->with('cod', $cod);

      } else {

        return redirect()->back()->withInput();
      }

    }

    /* Delete opciones */
    public function deleteopc($ido=null,$idp=null,$ideencryp=0) {
      $ido =strip_tags($ido);
      $encuestapreguntaopcionesModel = new EncuestaPreguntaOpcionesModel();
      $reg = $encuestapreguntaopcionesModel->delete($ido);
      $msg = "La opción fue eliminada";$cod=0;

      $idp  = encrypt_decrypt('e',$idp);

      return redirect()->to( site_url('/opciones/1/'.$ideencryp.'/'.$idp))->with('msg', $msg)->with('cod', $cod);
    }

} // Encuestas Controller
?>