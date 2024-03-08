<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 ">
    <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
        <p>
        <h5><?=$titulo; ?></h5>
        </p>
        <p>
        <h5 id='count'>Total <?=$count ?></h5>
        </p>
    </div>
    <div class="mt-3 mb-3">
        <div class="row">
            <div class="col-4 text-center"></div>
            <div class="col-4 text-center">
                <select class="form-control mb-3" id="list_encuestas">
                    <?=$list_encuestas;?>
                </select>
            </div>
            <div class="col-4 text-center"></div>
        </div>
        <div class="row">
           <div class="col-4"></div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <label for="fecha_inicio">Desde</label>
                <input id="fecha_inicio" value="<?= old('fecha_inicio');?>" class="form-control mb-3" type="date"
                    name="fecha_inicio"></input>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <label for="fecha_fin">Hasta</label>
                <input id="fecha_fin" value="<?= old('fecha_fin');?>" class="form-control mb-3" type="date"
                    name="fecha_fin"></input>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
           <div class="col-4"></div>
            <div class="col-1 text-center"><a href="<?=$url_base;?>admin" class="btn btn-secondary"
                    role="button">Regresar</a></div>
            <div class="col-1 text-center"><a class="btn btn-success" href="#" id="btnConsultar">Consultar</a></div>
            <div class="col-2 text-center" id="descarga"></div>
            <div class="col-4"></div>
        </div>
    </div>
    <br />
    <div class="center mt-3"
        style="background-color: white;font-family: monospace!important;font-size: small; overflow-x: auto;">
        <table class="table center">
            <tr id="headTable"></tr>
            <tbody id="listRegistros"></tbody>
        </table>
    </div>

</main>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script type="application/javascript">
$(document).ready(function() {
    console.log('Ver encuestas...');
    var url = "<?=$url_base; ?>";

    $('#btnConsultar').on('click', function(e) {
        var id_encuesta = $('#list_encuestas').val();
        var inicio = $('#fecha_inicio').val();
        var fin = $('#fecha_fin').val();
        filtrarEncuestas2(id_encuesta, inicio, fin, url);
    });
});
</script>
