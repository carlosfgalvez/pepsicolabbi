<?=$view_header?>
<?=$view_navbar?>

<div class="container text-center">
    <!-- BANNER CON LOS DIFERENTES PRODUCTOS DE INNOVACIÓN -->
    <ul id="bannershome" class="owl-carousel owl-theme">
        <?php foreach($banners as $reg): ?>
        <div>
            <p>
              <span class="fs-3 mt-5"><?=$reg['nombre'];?></span>
            </p>
            <?php if ($reg['url1']!='') { ?>
              <a class="" href="<?=$url_base;?>/<?=$reg['url1'];?>">
                <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['imagen1'];?>"
                  class="d-inline-block align-top" style="border-radius: 5px;width: 250px" alt="">
              </a>
            <?php } else { ?>
              <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['imagen1'];?>"
                class="d-inline-block align-top" style="border-radius: 5px;width: 250px" alt="">
            <?php } ?>
            <p><?=$reg['descripcion'];?></p>
        </div>
        <?php endforeach; ?>

    </ul>

    <!-- LABBI -->
    <div class="row">
      <div class="col-6">
        <div class="fs-3 pt-5">
            <center><?=$cfg_titulo?></center>
        </div>
        <p class="left">
            <?=$cfg_descripcion?>
        </p>
      </div>
      <div class="col-6">
        <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$cfg_img;?>" width="200"
            class="d-inline-block align-top" style="border-radius: 5px;" alt="">
      </div>
    </div>

    <!-- ENCUESTAS -->
    <div class="fs-3 pt-5">
        <center>¿Haz probado alguno? ¡Queremos escucharte!</center>
    </div>
    <div class="row" style="padding: 50px;">
    <?php foreach($encuestas as $reg): ?>

        <div class="col-3" style="text-align: center;">
            <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['img_portada'];?>" width="100"
                class="d-inline-block align-top" style="border-radius: 5px;" alt="" title="<?=$reg['descripcion']?>">
            <br><span><?=$reg['nombre']?></span>
            <?php if ($reg['vigente']=='S') { ?>
              <br><a class="btn btn-primary btn-sm" href="<?=$url_base;?>encuesta/<?=$reg['url'];?>">Ir a la encuesta</a>
            <?php } else { ?>
              <br><span class="alerta">Encuesta ya no se encuentra vigente</span>
            <?php } ?>
        </div>
    <?php endforeach; ?>
    </div>

    <!-- FORMULARIO DE CONTACTO -->
    <main class="px-3 pb-5 mb-5 mt-5 container toggle-quit hide" id="mainmsg">
        <div class="fs-3" id="msg"></div>
    </main>
    <main class="px-3 pb-5 mb-5 container toggle-quit" id="datospersonales">
      <div class="fs-3 pt-5 mb-5">
          <center>¿Te gustaría probar nuestra innovaciones?</center>
      </div>
        <div class="row">
            <div class="col-12 col-md-6 text-start mb-4">
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
    <!-- end form contacto -->

</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
$(document).ready(function() {
    var url = "<?=$url_base; ?>";
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
    });

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

});
</script>
