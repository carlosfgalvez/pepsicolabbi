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
            <div class="col-6 d-flex align-items-center justify-content-center">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input id="fecha_inicio" value="<?= old('fecha_inicio');?>" class="form-control mb-3" type="date"
                    name="fecha_inicio"></input>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <label for="fecha_fin">Fecha Fin</label>
                <input id="fecha_fin" value="<?= old('fecha_fin');?>" class="form-control mb-3" type="date"
                    name="fecha_fin"></input>
            </div>
        </div>
        <div class="row">
            <div class="col-4 text-center"><a href="<?=$url_base;?>admin" class="btn btn-secondary" role="button">Regresar</a></div>
            <div class="col-4 text-center"><a class="btn btn-success" href="#" id="btnConsultar">Consultar</a></div>
            <div class="col-4 text-center" id="descarga"></div>
        </div>
    </div>
    <br />
    <div class="center mt-3"
        style="background-color: white;font-family: monospace!important;font-size: small; overflow-x: auto;">
        <table class="table center">
            <!-- <table style='margin-left: auto;  margin-right: auto;'> -->
            <tr>
                <th style='padding: 5px; color: white; background-color: #28458E'>Fecha</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Hora</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Nombre</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Correo</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Teléfono</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>IP</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 1</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 1</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 2</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 2</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 3</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 3</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 4</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 4</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 5</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 5</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 6</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 6</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 7</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 7</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 8</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 8</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 9</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 9</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 10</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 10</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 11</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 11</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 12</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 12</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 13</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 13</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 14</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 14</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 15</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 15</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 16</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 16</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 17</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 17</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 18</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 18</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 19</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 19</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 20</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 20</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 21</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 21</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 22</th>
                <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 22</th>
            </tr>
            <tbody id="listRegistros">
                
            </tbody>
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
        filtrarEncuestas(id_encuesta, inicio, fin, url);
    });
});
</script>