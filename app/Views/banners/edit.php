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
                <input id="tipo" value="<?=$reg['tipo'];?>" class="form-control" type="text" name="tipo"></input>

                <label for="nombre">Nombre</label>
                <input id="nombre" value="<?=$reg['nombre'];?>" class="form-control" type="text" name="nombre"></input>

                <label for="descripcion">Descripción</label>
                <input id="descripcion" value="<?=$reg['descripcion'];?>" class="form-control" type="text"
                    name="descripcion"></input>

                <div class="container mt-3">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center justify-content-center">
                            <label for="imagen1">Imagen 1</label>
                            <select name="imagen1" id="imagen1" class="form-control">
                                <?php echo $imagesopc1;?>
                            </select>
                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-center">
                            <img id="preview" src="" style="width:35%;">
                        </div>
                    </div>
                </div>

                <div class="container mt-3">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center justify-content-center">
                            <label for="imagen2">Imagen 2</label>
                            <select name="imagen2" id="imagen2" class="form-control">
                                <?php echo $imagesopc2;?>
                            </select>
                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-center">
                            <img id="preview2" src="" style="width:35%;">
                        </div>
                    </div>
                </div>

                <label for="url1">Url 1</label>
                <input id="url1" value="<?=$reg['url1'];?>" class="form-control" type="text" name="url1"></input>

                <label for="url2">Url 2</label>
                <input id="url2" value="<?=$reg['url2'];?>" class="form-control" type="text" name="url2"></input>

                <label for="orden">Orden</label>
                <input id="orden" value="<?=$reg['orden'];?>" class="form-control" type="text" name="orden"></input>

                <label for="activo">Activo (S/N)</label>
                <input id="activo" value="<?=$reg['activo'];?>" class="form-control" type="text" name="activo"></input>

            </div>
            <br />
            <a href="<?=$url_base.'banners';?>" class="btn btn-outline-warning" role="button">Cancelar</a>
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

    var image1 = $("#imagen1").val();
    var image2 = $("#imagen2").val();

    change_image(url + dir, image1);
    change_image_fondo(url + dir, image2);

    $("#imagen1").on("change", function(e) {
        var image1 = $("#imagen1").val();
        change_image(url + dir, image1);
    });

    $("#imagen2").on("change", function(e) {
        var image2 = $("#imagen2").val();
        change_image_fondo(url + dir, image2);
    });
});
</script>