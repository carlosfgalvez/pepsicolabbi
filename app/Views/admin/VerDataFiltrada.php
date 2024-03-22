<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 ">
    <div class="mt-3 mb-3">
        <div class="row">
            <div class="col-4 text-center"></div>
            <div class="col-4 text-center">
                <select class="form-control mb-3" id="list_encuestas">
                    <?=$list_encuestas?>
                </select>
            </div>
            <div class="col-4 text-center"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <input id="list_year" class="form-control mb-3" type="date"></input>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <input id="list_month" class="form-control mb-3" type="date"></input>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-1 text-center"><a href="<?=$url_base;?>admin" class="btn btn-secondary"
                    role="button">Regresar</a></div>
        </div>
    </div>


    <br />
    <div class="center mt-3"
        style="background-color: white;font-family: monospace!important;font-size: small; overflow-x: auto;">
    </div>

    <div class="center mt-3">
        <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
        <a class="btn btn-success" id="btnRespuestas">Filtrar Respuestas</a>
        <a class="btn btn-success" id="btnEncuestas">Filtrar Encuestas</a>
        <a class="btn btn-success" id="btnJoin">Beta Join</a>
    </div>

</main>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script type="application/javascript">
$(document).ready(function() {
    console.log('Ver filtros...');
    var url = "<?=$url_base; ?>";


    // $('#list_year').on('change', function(e) {
    //     var year = $('#list_year').val();
    //     var month = $('#list_month').val();
    //     var ide = $('#list_encuestas').val();

    //     var respuestas = url + "admin/filtrarRespuesta/" + ide + "/" + year + "/" + month;
    //     var encuestas = url + "admin/filtraEncuesta/" + ide + "/" + year + "/" + month;
    //     var join = url + "admin/filtraBetaJoin/" + ide + "/" + year + "/" + month;

    //     $("#btnRespuestas").attr("href", respuestas);
    //     $("#btnEncuestas").attr("href", encuestas);
    //     $("#btnJoin").attr("href", join);
    // });

    $('#list_month').on('change', function(e) {
        var year = $('#list_year').val();
        var month = $('#list_month').val();
        var ide = $('#list_encuestas').val();

        var respuestas = url + "admin/filtrarRespuesta/" + ide + "/" + year + "/" + month;
        var encuestas = url + "admin/filtraEncuesta/" + ide + "/" + year + "/" + month;
        var join = url + "admin/filtraBetaJoin/" + ide + "/" + year + "/" + month;

        $("#btnRespuestas").attr("href", respuestas);
        $("#btnEncuestas").attr("href", encuestas);
        $("#btnJoin").attr("href", join);
    });

});
</script>