<?=$view_header?>
<?=$view_navbar?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Opción</h5>

        <p class="card-text"></p>
        <form method="post" action="<?=site_url('opciones/saveopc')?>" enctype="multipart/form-data">
            <input id="id" value="<?=$reg['id']?>" type="hidden" name="id"></input>
            <div class="form-group left color-gray font-admin">


                <label for="id_encuesta" class="hide">Id Encuesta</label>
                <input id="id_encuesta" value="<?= $reg['id_encuesta'];?>" class="form-control hide" type="text"
                    name="id_encuesta"></input>

                <label for="id_pregunta" class="hide">Id Pregunta</label>
                <input id="id_pregunta" value="<?= $reg['id_pregunta'];?>" class="form-control hide" type="text"
                    name="id_pregunta"></input>

                <label for="opcion">Opción</label>
                <input id="opcion" value="<?= $reg['opcion'];?>" class="form-control" type="text" name="opcion"></input>

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
                <input id="img_alto" value="<?= $reg['img_alto'];?>" class="form-control" type="text"
                    name="img_alto"></input>

                <label for="img_ancho">Imagen Ancho (Pixeles)</label>
                <input id="img_ancho" value="<?= $reg['img_ancho'];?>" class="form-control" type="text"
                    name="img_ancho"></input>

                <label for="activo">Activo (S/N)</label>
                <select name="activo" id="activo" class="form-control">
                    <?php echo $activo;?>
                </select>
            </div>
            <br />
            <a href="<?=$back;?>" class="btn btn-outline-warning cancela" role="button">Cancelar</a>
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
    var image = $("#img_opcion").val();
    change_image(url + dir, image);
    $("#img_opcion").on("change", function(e) {
        var image = $("#img_opcion").val();
        change_image(url + dir, image);
    });
});
</script>