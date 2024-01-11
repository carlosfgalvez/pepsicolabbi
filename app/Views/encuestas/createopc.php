<?=$view_header?>
<?=$view_navbar?>

<?php helper('form');?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Nueva Opción</h5>
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

        <form method="post" action="<?=site_url('opciones/saveopc')?>" enctype="multipart/form-data">
            <div class="form-group left color-gray font-admin">

                <label for="id_encuesta" class="hide">Id Encuesta</label>
                <input id="id_encuesta" value="<?=$ide?>" class="form-control hide" type="text"
                    name="id_encuesta"></input>

                <label for="id_pregunta" class="hide">Id Pregunta</label>
                <input id="id_pregunta" value="<?=$idp?>" class="form-control hide" type="text"
                    name="id_pregunta"></input>

                <label for="opcion">Opción</label>
                <input id="opcion" value="<?= old('opcion');?>" class="form-control" type="text" name="opcion"></input>

                <label for="input">Input (S/N)</label>
                <select name="input" id="input" class="form-control">
                    <?php echo $input;?>
                </select>

                <label for="requerido">Requerido (S/N)</label>
                <select name="requerido" id="requerido" class="form-control">
                    <?php echo $requerido;?>
                </select>

                <div class="container mt-3">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center justify-content-center">
                            <label for="img_opcion">Imagen Opción</label>
                            <select name="img_opcion" id="img_opcion" class="form-control">
                                <?php echo $imagesopc;?>
                            </select>
                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-center">
                            <img id="preview" src="" style="width:35%;">
                        </div>
                    </div>
                </div>

                <label for="img_clase">Clase Imagen</label>
                <select name="img_clase" id="img_clase" class="form-control">
                    <?php echo $clases ;?>
                </select>

                <label for="img_alto">Imagen Alto (Pixeles)</label>
                <input id="img_alto" value="<?= old('img_alto');?>" class="form-control" type="text"
                    name="img_alto"></input>

                <label for="img_ancho">Imagen Ancho (Pixeles)</label>
                <input id="img_ancho" value="<?= old('img_ancho');?>" class="form-control" type="text"
                    name="img_ancho"></input>

                <label for="orden">Orden</label>
                <input id="orden" value="<?= old('orden');?>" class="form-control" type="text" name="orden"></input>

                <label for="activo">Activo (S/N)</label>
                <select name="activo" id="activo" class="form-control">
                    <?php echo $activo;?>
                </select>
            </div>
            <br />
            <a href="<?=$url_base.'opciones/0/'.$ideencryp;?>;?>" class="btn btn-outline-warning"
                role="button">Cancelar</a>
            <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
$(document).ready(function() {
    var url = "<?=$url_base; ?>";
    var dir = "<?=$upload_dir; ?>";
    $("#img_opcion").on("change", function(e) {
        var image = $("#img_opcion").val();
        change_image(url + dir, image);
    });
});
</script>