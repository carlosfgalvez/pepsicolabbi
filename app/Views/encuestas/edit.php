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
                <input id="nombre" value="<?=$reg['nombre']?>" class="form-control mb-3" type="text" name="nombre"></input>

                <label for="descripcion">Descripción</label>
                <input id="descripcion" value="<?=$reg['descripcion']?>" class="form-control mb-3" type="text"
                    name="descripcion"></input>

                <label for="codigo">Código (forma parte de la url)</label>
                <input id="codigo" value="<?=$reg['codigo']?>" class="form-control mb-3" type="text" name="codigo"></input>

                <div class="mt-3">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center justify-content-center">
                            <label for="img_portada">Imagen Portada</label>
                            <select name="img_portada" id="img_portada" class="form-control mb-3">
                                <?php echo $imagesopcpor;?>
                            </select>
                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-center">
                            <img id="preview" src="" style="max-width: 150px;">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center justify-content-center">
                            <label for="img_fondo">Imagen Fondo</label>
                            <select name="img_fondo" id="img_fondo" class="form-control mb-3">
                                <?php echo $imagesopcfon;?>
                            </select>
                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-center">
                            <img id="preview2" src="" style="max-width: 150px;">
                        </div>
                    </div>
                </div>

                <label for="color_txt">Color txt</label>
                <input id="color_txt" value="<?=$reg['color_txt'];?>" class="form-control mb-3" type="text"
                    name="color_txt"></input>

                <!--  -->
                <div class="mt-3 mb-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <label for="fecha_inicio">Fecha/Hora Inicio</label>
                            <input id="fecha_inicio" value="<?=$reg['fecha_inicio'];?>" class="form-control mb-3"
                                type="datetime-local" name="fecha_inicio"></input>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <label for="fecha_fin">Fecha/Hora Fin</label>
                            <input id="fecha_fin" value="<?=$reg['fecha_fin'];?>" class="form-control mb-3"
                                type="datetime-local" name="fecha_fin"></input>
                        </div>
                    </div>
                </div>

                <label for="datos_personales">Solicitar Datos personales</label>
                <select name="datos_personales" id="datos_personales" class="form-control mb-3">
                    <?php echo $personales;?>
                </select>

                <label for="duplicidad">Validar duplicidad</label>
                <select name="duplicidad" id="duplicidad" class="form-control mb-3">
                    <?php echo $duplicidad;?>
                </select>

                <label for="orden">Orden</label>
                <input id="orden" value="<?=$reg['orden'];?>" class="form-control mb-3" type="text" name="orden"></input>

                <label for="activo">Activo</label>
                <select name="activo" id="activo" class="form-control">
                    <?php echo $activo;?>
                </select>
            </div>
            <br />
            <a href="<?=$url_base.'encuestas';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
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

    var image = $("#img_portada").val();
    var fondo = $("#img_fondo").val();

    $("footer").css('position','unset');

    change_image(url + dir, image);
    change_image_fondo(url + dir, fondo);

    $("#img_portada").on("change", function(e) {
        var image = $("#img_portada").val();
        change_image(url + dir, image);
    });

    $("#img_fondo").on("change", function(e) {
        var fondo = $("#img_fondo").val();
        change_image_fondo(url + dir, fondo);
    });
});
</script>
