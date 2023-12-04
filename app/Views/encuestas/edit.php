<?=$view_header?>
<?=$view_navbar?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Encuesta</h5>

    <p class="card-text"></p>
    <form method="post" action="<?=site_url('encuestas/save')?>" enctype="multipart/form-data">
    <input id="id" value="<?=$reg['id']?>" type="hidden" name="id"></input>
    <div class="form-group left color-gray font-admin">

      <label for="nombre">Nombre</label>
      <input id="nombre"  value="<?=$reg['nombre']?>" class="form-control" type="text" name="nombre"></input>

      <label for="descripcion">Descripción</label>
      <input id="descripcion" value="<?=$reg['descripcion']?>" class="form-control" type="text" name="descripcion"></input>

      <label for="codigo">Código (forma parte de la url)</label>
      <input id="codigo" value="<?=$reg['codigo']?>" class="form-control" type="text" name="codigo"></input>

      <label for="img_portada">Imagen Portada</label>
      <input id="img_portada"  value="<?=$reg['img_portada'];?>" class="form-control" type="text" name="img_portada"></input>

      <label for="img_fondo">Imagen Fondo</label>
      <input id="img_fondo"  value="<?=$reg['img_fondo'];?>" class="form-control" type="text" name="img_fondo"></input>

      <label for="color_txt">Color txt</label>
      <input id="color_txt"  value="<?=$reg['color_txt'];?>" class="form-control" type="text" name="color_txt"></input>

      <label for="fecha_inicio">Fecha Inicio (aaaa-mm-dd hh:mi:se)</label>
      <input id="fecha_inicio"  value="<?=$reg['fecha_inicio'];?>" class="form-control" type="text" name="fecha_inicio"></input>

      <label for="fecha_fin">Fecha Fin (aaaa-mm-dd hh:mi:se)</label>
      <input id="fecha_fin"  value="<?=$reg['fecha_fin'];?>" class="form-control" type="text" name="fecha_fin"></input>

      <label for="datos_personales">Solicitar Datos personales (S/N)</label>
      <input id="datos_personales"  value="<?=$reg['datos_personales'];?>" class="form-control" type="text" name="datos_personales"></input>

      <label for="duplicidad">Validar duplicidad (S/N)</label>
      <input id="duplicidad"  value="<?=$reg['duplicidad'];?>" class="form-control" type="text" name="duplicidad"></input>

      <label for="orden">Orden</label>
      <input id="orden"  value="<?=$reg['orden'];?>" class="form-control" type="text" name="orden"></input>

      <label for="activo">Activo (S/N)</label>
      <input id="activo"  value="<?=$reg['activo'];?>" class="form-control" type="text" name="activo"></input>

    </div>
    <br/>
    <a href="<?=$url_base.'encuestas';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
    <button class="btn btn-success" type="submit">Guardar</button>
  </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>
