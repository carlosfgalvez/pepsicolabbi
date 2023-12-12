<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SettingModel;

class Settings extends BaseController
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
        $settingModel = new SettingModel();
        $count       = $settingModel->countAllResults();

        if ($page*$size < $count){
           $registros      = $settingModel->OrderBy('id','Asc')->findAll($page*$size,0);$page++;
           $data['page']   = $page;
        } else {
          $registros       = $settingModel->OrderBy('id','Asc')->findAll();
          $data['page']    = 0;
        }

        $data['registros']   = $registros;
        $data['count']       = $count;
        $data['view_navbar'] = view('template/navbar',$data);

        $view = "settings/list";
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

      return view('settings/create',$data);
    }

    /* Edit */
    public function edit($id=null)
    {
      // Obtener datos comunes a todas las vistas
      $data = $this->getData('admin');  // BaseController

      $id = strip_tags($id);
      $settingModel = new SettingModel();
      $data['reg'] = $settingModel->where('id',$id)->first();

      return view('settings/edit',$data);
    }

    /* Save: insert/update */
    public function save() {
      $msg = "";$cod = 0;
      $settingModel = new SettingModel();

      $id     = $this->request->getVar('id');
      $tipo   = $this->request->getVar('tipo');
      $nombre = $this->request->getVar('nombre');
      $valor  = $this->request->getVar('valor');
      $descripcion = $this->request->getVar('descripcion');

      if ($this->validate('settings')) {  // Ok
        $datos=[
          'tipo'=>$tipo,
          'nombre'=>$nombre,
          'valor'=>$valor,
          'descripcion'=>$descripcion
        ];

        if ($id==null) {
           $settingModel->insert($datos);
            $msg = "La configuración fue agregada";$cod=1;
        } else {
           $settingModel->update($id,$datos);
           $msg = "La configuración fue guardada";$cod=1;
        }

        return redirect()->to( site_url('/settings') )->with('msg', $msg)->with('cod', $cod);
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
      $settingModel = new SettingModel();
      $reg = $settingModel->where('id',$id)->delete($id);
      $msg = "La configuración fue eliminada";$cod=0;

      return redirect()->to( site_url('/settings') )->with('msg', $msg)->with('cod', $cod);
      //return $this->response->redirect(site_url('/settings'));
    }

} // Settings Controller
?>
