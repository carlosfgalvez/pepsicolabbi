<?=$view_header?>
<?=$view_navbar?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Banner</h5>

    <p class="card-text"></p>
    <form method="post" action="<?=site_url('banners/save')?>" enctype="multipart/form-data">
    <input id="id" value="<?=$reg['id']?>" type="hidden" name="id"></input>
    <div class="form-group">

      <label for="tipo">Tipo (HOME)</label>
      <input id="tipo" value="<?=$reg['tipo'];?>" class="form-control" type="text" name="tipo" ></input>

      <label for="nombre">Nombre</label>
      <input id="nombre"  value="<?=$reg['nombre'];?>" class="form-control" type="text" name="nombre"></input>

      <label for="descripcion">Descripción</label>
      <input id="descripcion" value="<?=$reg['descripcion'];?>" class="form-control" type="text" name="descripcion"></input>

      <label for="imagen1">Imagen 1</label>
      <input id="imagen1" value="<?=$reg['imagen1'];?>" class="form-control" type="text" name="imagen1"></input>

      <label for="imagen2">Imagen 2</label>
      <input id="imagen2" value="<?=$reg['imagen2'];?>" class="form-control" type="text" name="imagen2"></input>

      <label for="url1">Url 1</label>
      <input id="url1" value="<?=$reg['url1'];?>" class="form-control" type="text" name="url1"></input>

      <label for="url2">Url 2</label>
      <input id="url2" value="<?=$reg['url2'];?>" class="form-control" type="text" name="url2"></input>

      <label for="orden">Orden</label>
      <input id="orden" value="<?=$reg['orden'];?>" class="form-control" type="text" name="orden"></input>

      <label for="activo">Activo (S/N)</label>
      <input id="activo" value="<?=$reg['activo'];?>" class="form-control" type="text" name="activo"></input>

    </div>
    <br/>
    <a href="<?=$url_base.'banners';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
    <button class="btn btn-success" type="submit">Guardar</button>
  </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>
