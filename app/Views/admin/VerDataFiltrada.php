<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 ">
    <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
        <select class="mb-3" id="list_year"><?=$list_year;?></select><br>
        <select class="mb-3" id="list_month"><?=$list_month;?></select>
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
    var ide = "<?=$id_encuesta;?>";

    $('#list_year').on('change', function(e) {
        var year = $('#list_year').val();
        var month = $('#list_month').val();

        var respuestas = url + "admin/filtrarRespuesta/" + ide + "/" + year + "/" + month;
        var encuestas = url + "admin/filtraEncuesta/" + ide + "/" + year + "/" + month;
        var join = url + "admin/filtraBetaJoin/" + ide + "/" + year + "/" + month;

        $("#btnRespuestas").attr("href", respuestas);
        $("#btnEncuestas").attr("href", encuestas);
        $("#btnJoin").attr("href", join);
    });

    $('#list_month').on('change', function(e) {
        var year = $('#list_year').val();
        var month = $('#list_month').val();

        var respuestas = url + "admin/filtrarRespuesta/" + ide + "/" + year + "/" + month;
        var encuestas = url + "admin/filtraEncuesta/" + ide + "/" + year + "/" + month;
        var join = url + "admin/filtraBetaJoin/" + ide + "/" + year + "/" + month;

        $("#btnRespuestas").attr("href", respuestas);
        $("#btnEncuestas").attr("href", encuestas);
        $("#btnJoin").attr("href", join);
    });

});
</script>