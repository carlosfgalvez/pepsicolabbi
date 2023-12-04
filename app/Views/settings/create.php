<?=$view_header?>
<?=$view_navbar?>

<?php helper('form');?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Create Setting</h5>
    <p class="card-text"></p>
    <?= validation_list_errors() ?>
    <?php /* $validation->listErrors('tipo'); */?>

    <?php if (! empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
  <?php endif ?>

    <form method="post" action="<?=site_url('settings/save')?>" enctype="multipart/form-data">
    <div class="form-group left color-gray font-admin">
      <label for="tipo">Tipo</label>
      <input id="tipo" value="<?= old('tipo');?>" class="form-control" type="text" name="tipo" ></input>

      <label for="nombre">Nombre</label>
      <input id="nombre"  value="<?= old('nombre');?>" class="form-control" type="text" name="nombre"></input>

      <label for="valor">Valor</label>
      <input id="valor" value="<?= old('valor');?>" class="form-control" type="text" name="valor"></input>

      <label for="descripcion">Descripción</label>
      <input id="descripcion" value="<?= old('Descripción');?>" class="form-control" type="text" name="descripcion"></input>
    </div>
    <br/>
    <a href="<?=$url_base.'settings';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
    <button class="btn btn-success" type="submit">Guardar</button>
  </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>
