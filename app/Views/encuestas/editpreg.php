<?=$view_header?>
<?=$view_navbar?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Pregunta</h5>

        <p class="card-text"></p>
        <form method="post" action="<?=site_url('preguntas/savepreg')?>" enctype="multipart/form-data">
            <input id="id" value="<?=$reg['id']?>" type="hidden" name="id"></input>
            <div class="form-group left color-gray font-admin">

                <label for="id_encuesta" class="hide">Id Encuesta</label>
                <input id="id_encuesta" value="<?= $reg['id_encuesta'];?>" class="form-control hide" type="text"
                    name="id_encuesta"></input>

                <label for="pregunta">Pregunta</label>
                <input id="pregunta" value="<?= $reg['pregunta'];?>" class="form-control" type="text"
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
                <input id="orden" value="<?= $reg['orden'];?>" class="form-control" type="text" name="orden"></input>

                <label for="activo">Activo (S/N)</label>
                <select name="activo" id="activo" class="form-control">
                    <?php echo $activo;?>
                </select>

            </div>
            <br />
            <a href="<?=$url_base.'preguntas/1/'.$ideencryp;?>" class="btn btn-outline-warning"
                role="button">Cancelar</a>
            <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>