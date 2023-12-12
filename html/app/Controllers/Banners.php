<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BannerModel;

class Banners extends BaseController
{
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
        $bannerModel = new BannerModel();
        $count       = $bannerModel->countAllResults();

        if ($page*$size < $count){
           $registros      = $bannerModel->OrderBy('id','Asc')->findAll($page*$size,0);$page++;
           $data['page']   = $page;
        } else {
          $registros       = $bannerModel->OrderBy('id','Asc')->findAll();
          $data['count']   = $count;
          $data['page']    = 0;
        }

        $data['registros']   = $registros;
        $data['count']       = $count;
        $data['view_navbar'] = view('template/navbar',$data);

        $view = "banners/list";
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

      $data['view_navbar'] = view('template/navbar',$data);
      return view('banners/create',$data);
    }

    /* Edit */
    public function edit($id=null)
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController

      $id = strip_tags($id);
      $bannerModel = new BannerModel();
      $data['reg'] = $bannerModel->where('id',$id)->first();
      $data['view_navbar'] = view('template/navbar',$data);
      
      return view('banners/edit',$data);
    }

    /* Save: insert/update */
    public function save() {
      $msg = "";$cod = 0;
      $bannerModel = new BannerModel();

      $id           = $this->request->getVar('id');
      $tipo         = $this->request->getVar('tipo');
      $nombre       = $this->request->getVar('nombre');
      $descripcion  = $this->request->getVar('descripcion');
      $imagen1      = $this->request->getVar('imagen1');
      $imagen2      = $this->request->getVar('imagen2');
      $url1         = $this->request->getVar('url1');
      $url2         = $this->request->getVar('url2');
      $orden        = $this->request->getVar('orden');
      $activo       = $this->request->getVar('activo');

      if ($this->validate('banners')) {  // Ok
        $datos=[
          'tipo'=>$tipo,
          'nombre'=>$nombre,
          'descripcion'=>$descripcion,
          'imagen1'=>$imagen1,
          'imagen2'=>$imagen2,
          'url1'=>$url1,
          'url2'=>$url2,
          'orden'=>$orden,
          'activo'=>$activo
        ];

        if ($id==null) {
           $bannerModel->insert($datos);
            $msg = "El banner fue agregado";$cod=1;
        } else {
           $bannerModel->update($id,$datos);
           $msg = "El banner fue guardado";$cod=1;
        }

        return redirect()->to( site_url('/banners') )->with('msg', $msg)->with('cod', $cod);
        //return $this->response->redirect(site_url('/settings'));

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
      $bannerModel = new BannerModel();
      $reg = $bannerModel->where('id',$id)->delete($id);
      $msg = "El banner fue eliminado";$cod=0;

      return redirect()->to( site_url('/banners') )->with('msg', $msg)->with('cod', $cod);
      //return $this->response->redirect(site_url('/settings'));
    }

} // Banners Controller
?>
