<?=$view_header?>
<?=$view_navbar?>

<?php helper('form');?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Nueva Pregunta</h5>
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

        <form method="post" action="<?=site_url('preguntas/savepreg')?>" enctype="multipart/form-data">
            <div class="form-group left color-gray font-admin">

                <label for="id_encuesta" class="hide">Id Encuesta</label>
                <input id="id_encuesta" value="<?=$ide?>" class="form-control hide" type="text"
                    name="id_encuesta"></input>

                <label for="pregunta">Pregunta</label>
                <input id="pregunta" value="<?= old('pregunta');?>" class="form-control" type="text"
                    name="pregunta"></input>

                <label for="tipo">Tipo (RADIO,CHECK,INPUT,SELECT)</label>
                <select name="tipo" id="tipo" class="form-control">
                    <?php echo $tipos;?>
                </select>

                <label for="requerido">Requerido (S/N)</label>
                <select name="requerido" id="requerido" class="form-control">
                    <?php echo $requerido;?>
                </select>

                <label for="orden">Orden</label>
                <input id="orden" value="<?= old('orden');?>" class="form-control" type="text" name="orden"></input>

                <label for="activo">Activo (S/N)</label>
                <select name="activo" id="activo" class="form-control">
                    <?php echo $activo;?>
                </select>
            </div>
            <br />
            <a href="<?=$url_base.'preguntas/0/'.$ideencryp;?>" class="btn btn-outline-warning"
                role="button">Cancelar</a>
            <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>