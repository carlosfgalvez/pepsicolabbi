<?=$view_header?>
<?=$view_navbar?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Editar Setting</h5>

    <p class="card-text"></p>
    <form method="post" action="<?=site_url('settings/save')?>" enctype="multipart/form-data">
    <input id="id" value="<?=$reg['id']?>" type="hidden" name="id"></input>
    <div class="form-group left color-gray font-admin">
      <label for="tipo">Tipo</label>
      <input id="tipo" value="<?=$reg['tipo']?>" class="form-control" type="text" name="tipo"></input>

      <label for="nombre">Nombre</label>
      <input id="nombre" value="<?=$reg['nombre']?>" class="form-control" type="text" name="nombre"></input>

      <label for="valor">Valor</label>
      <input id="valor" value="<?=$reg['valor']?>" class="form-control" type="text" name="valor"></input>

      <label for="descripcion">Descripción</label>
      <input id="descripcion" value="<?=$reg['descripcion']?>" class="form-control" type="text" name="descripcion"></input>
    </div>
    <br/>
    <a href="<?=$url_base.'settings';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
    <button class="btn btn-success" type="submit">Guardar</button>
  </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>
