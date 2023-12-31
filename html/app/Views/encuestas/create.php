<?=$view_header?>
<?=$view_navbar?>

<?php helper('form');?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Encuesta</h5>
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

    <form method="post" action="<?=site_url('encuestas/save')?>" enctype="multipart/form-data">
    <div class="form-group left color-gray font-admin">

      <label for="nombre">Nombre</label>
      <input id="nombre"  value="<?= old('nombre');?>" class="form-control" type="text" name="nombre"></input>

      <label for="descripcion">Descripción</label>
      <input id="descripcion" value="<?= old('descripción');?>" class="form-control" type="text" name="descripcion"></input>

      <label for="codigo">Código (forma parte de la url)</label>
      <input id="codigo" value="<?= old('codigo');?>" class="form-control" type="text" name="codigo"></input>

      <label for="img_portada">Imagen Portada</label>
      <input id="img_portada"  value="<?= old('img_portada');?>" class="form-control" type="text" name="img_portada"></input>

      <label for="img_fondo">Imagen Fondo</label>
      <input id="img_fondo"  value="<?= old('img_fondo');?>" class="form-control" type="text" name="img_fondo"></input>

      <label for="color_txt">Color txt</label>
      <input id="color_txt"  value="<?= old('color_txt');?>" class="form-control" type="text" name="color_txt"></input>

      <label for="fecha_inicio">Fecha Inicio (aaaa-mm-dd hh:mi:se)</label>
      <input id="fecha_inicio"  value="<?= old('fecha_inicio');?>" class="form-control" type="text" name="fecha_inicio"></input>

      <label for="fecha_fin">Fecha Fin (aaaa-mm-dd hh:mi:se)</label>
      <input id="fecha_fin"  value="<?= old('fecha_fin');?>" class="form-control" type="text" name="fecha_fin"></input>

      <label for="datos_personales">Solicitar Datos personales (S/N)</label>
      <input id="datos_personales"  value="<?= old('datos_personales');?>" class="form-control" type="text" name="datos_personales"></input>

      <label for="duplicidad">Validar duplicidad (S/N)</label>
      <input id="duplicidad"  value="<?= old('duplicidad');?>" class="form-control" type="text" name="duplicidad"></input>

      <label for="orden">Orden</label>
      <input id="orden"  value="<?= old('orden');?>" class="form-control" type="text" name="orden"></input>

      <label for="activo">Activo (S/N)</label>
      <input id="activo"  value="<?= old('activo');?>" class="form-control" type="text" name="activo"></input>

    </div>
    <br/>
    <a href="<?=$url_base.'encuestas';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
    <button class="btn btn-success" type="submit">Guardar</button>
  </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>
