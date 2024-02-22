<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 container toggle-quit">

    <!-- Encabezado -->
    <div class="row mt-80 mt-5" id="divPerfilHeader">
        <div class="col-1"></div>
        <div class="col-xs-4 col-4">
            <p>Bienvenido <strong><?= $nombre='admin'?></strong></br></p>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- Título principal -->
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">DASHBOARD</h3>
        </div>
    </div>

    <!-- filtros -->
    <div class="row">
        <div class="col-12 text-center">
            <select class="" id="list_encuestas">
                <?=$list_encuestas;?>
            </select>
        </div>
    </div>

    <!-- Indicadores -->
    <div class="row">
        <div class="col-4"></div>
        <div class="col-2" style="text-align: right;">Total encuestas</div>
        <div class="col-2 number" style="text-align: left;"><strong><?= number_format($count_encuestas);?></strong>
        </div>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-2" style="text-align: right;">Total encuestas vigentes</div>
        <div class="col-2 number" style="text-align: left;">
            <strong><?= number_format($count_encuestas_vigentes);?></strong>
        </div>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-2" style="text-align: right;">Total encuestas enviadas</div>
        <div class="col-2 number" style="text-align: left;"><strong><span
                    id="count_enviadas"><?= $count_enviadas;?></span></strong>

            <a class="btn btn-success btn-sm hide" style="margin-left: 20px;--bs-btn-font-size: 0.600rem!important;"
                href="<?=$url_base;?>admin/encuestadescarga" id="btnDescargaEncuesta">Descargar</a>

        </div>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-2" style="text-align: right;">Última encuesta enviada</div>
        <div class="col-2 number" style="text-align: left;"><strong><span
                    id="ultima_enviada"><?=$enviada_ultima;?></span></strong> </div>
        <div class="col-4"></div>
    </div>

    <!-- Botones -->
    <div class="row mt-5">
        <div class="col-1"></div>
        <div class="col-10" style="text-align: center;">
            <a class="btn btn-primary" style="margin: 5px;" href="<?=$url_base;?>encuestas/1">Configurar Encuesta</a>
            <a class="btn btn-primary" style="margin: 5px;" href="<?=$url_base;?>preguntas/1">Configurar Preguntas</a>
            <a class="btn btn-primary" style="margin: 5px;" href="<?=$url_base;?>opciones/1">Configurar Opciones</a>
            <a class="btn btn-primary hide" id="btnVerEnviadas" style="margin: 5px;"
                href="<?=$url_base;?>admin/verenviadas">Encuestas Enviadas
            </a>            
            <a class="btn btn-primary" style="margin: 5px;" href="<?=$url_base;?>contactos ">Contactos</a>
            <a class="btn btn-outline-success" style="margin: 5px;" href="<?=$url_base;?>upload">Subir Archivos</a>
            <!--<a class="btn btn-primary" style="margin: 5px;" href="<?=$url_base;?>enviadas">Ver Enviadas</a>-->
        </div>
        <div class="col-1"></div>
    </div>

    <!-- botones adicionales rol admin = 2 -->
    <?php if ($rol==2) { ?>
    <div class="row mt-5">
        <div class="col-1"></div>
        <div class="col-10" style="text-align: center;">
            <a class="btn btn-outline-secondary" style="margin: 5px;" href="<?=$url_base;?>settings/1">Settings</a>
            <a class="btn btn-outline-secondary" style="margin: 5px;" href="<?=$url_base;?>banners/1">Banners</a>
            <a class="btn btn-outline-secondary" style="margin: 5px;" href="<?=$url_base;?>admin/logdescarga">Log
                descarga</a>
        </div>
        <div class="col-1"></div>
    </div>

</main>

<?php } ?>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
$(document).ready(function() {
    console.log('index admin...');
    var url = "<?=$url_base; ?>";

    //$('#container').addClass('admin-fondo');

    $('#list_encuestas').on('change', function(e) {
        var id = $('#list_encuestas').val();

        if (id != "") {
            total = get_encuesta_count(id, url);
        }
    });

});
</script>
