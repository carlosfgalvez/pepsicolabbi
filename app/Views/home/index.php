<?=$view_header?>
<?=$view_navbar?>

<div class="container text-center">
    <h1 class="pt-5">
        <center><?=$cfg_titulo?></center>
    </h1>
    <p class="">
        <center><?=$cfg_descripcion?></center>
    </p>
    <!--
  <p><center>Acumula puntos registrando tus tickets de compra de productos de Ricitos de Oro y<br>
             obten acceso a material exclusivo, increibles recompensas y muchas más sorpresas.</center></p>
  -->

    <!--<h3 class="mt-5"> BANNER CON LOS DIFERENTES PRODUCTOS DE INNOVACIÓN </h3>-->
    <ul id="bannershome" class="owl-carousel">
        <?php foreach($banners as $reg): ?>
        <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['imagen1'];?>" width="100" class="d-inline-block align-top"
            style="border-radius: 5px;" alt="">
        <?php endforeach; ?>
    </ul>

    <?php foreach($encuestas as $reg): ?>
    <div class="row" style="padding: 50px;">
        <div class="col-2"></div>
        <div class="col-2" style="text-align: right;">
            <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['img_portada'];?>" width="100"
                class="d-inline-block align-top" style="border-radius: 5px;" alt="">
        </div>
        <div class="col-2" style="text-align: left;">
            <span><strong><?=$reg['nombre']?></strong></span><br>
            <span><?php
            if (strlen($reg['descripcion']) < 45 ){
              echo $reg['descripcion'];
            } else {
                echo  substr($reg['descripcion'],0,45).'...';
            }
          ?></span><br>
            <span><small><?=$reg['fecha']?></small></span>
        </div>
        <div class="col-4" style="text-align: left;">
            <?php if ($reg['vigente']=='S') { ?>
            <a class="btn btn-primary  btn-lg" href="<?=$url_base;?>encuesta/<?=$reg['url'];?>">Responder encuesta</a>
            <?php } else { ?>
            <span class="alerta">Encuesta ya no se encuentra vigente</span>
            <?php } ?>
        </div>
        <div class="col-2"></div>
    </div>
    <?php endforeach; ?>

    <!-- form registro -->
    <main class="px-3 pb-5 mb-5 container toggle-quit" id="datospersonales">
        <div class="row">
            <div class="col-12 col-md-6 text-start mb-4">
                <div class="fs-3">¿Te gustaría probar nuestra innovaciones?</div>
                <div class="text-red">Dejanos tus datos y podrías ser seleccionado para ser de los primeros en probar lo
                    nuevo de tus marcas favoritas.</div>
            </div>
            <div class="col-12 col-md-6 row text-start">
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Nombre completo" id="nombrecompleto"
                        autocomplete="off" />
                    <div class="invalid-feedback" id="msg_nombre">Error</div>
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Correo electrónico" id="email"
                        autocomplete="off" />
                    <div class="invalid-feedback" id="msg_email">Error</div>
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" placeholder="Teléfono" id="celular" autocomplete="off" />
                    <div class="invalid-feedback" id="msg_celular">Error</div>
                </div>

                <div class="col-12 col-md-6 mb-3 text-center text-md-start">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="avisodeprivasidad"
                            id="avisodeprivasidad" />
                        <label class="form-check-label" for="mejor1">
                            <a href="#" class="nav-link px-2  text-underline verAvisoprivacidad" id="">Acepto aviso de
                                privacidad</a>
                        </label>
                        <div class="invalid-feedback" id="msg_aviso">Debes aceptar el aviso de privacidad</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <a href="#"
                        class="btn btn-sm ripple center enviar red d-flex align-items-center justify-content-center"
                        id="btnEnviar">ENVIAR</a>
                </div>
                <div class="invalid-feedback" id="msg_enviar_error"></div>

            </div>
        </div>
    </main>
    <!-- end form registro -->
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
$(document).ready(function() {
    var url = "<?=$url_base; ?>";

    $('#btnEnviar').on('click', function(e) {
        e.preventDefault();
        var nombre = $("#nombrecompleto").val();
        var email = $("#email").val();
        var celular = $("#celular").val();
        var aviso = $('#avisodeprivasidad').prop('checked');

        if (validarEncuestaDatosPersonales(nombre, email, celular, aviso)) {
            enviarDatosPersonalesRegistroHome(nombre, email, celular, url);
        }
    });

    //$('.owl-carousel').owlCarousel();
});
</script>