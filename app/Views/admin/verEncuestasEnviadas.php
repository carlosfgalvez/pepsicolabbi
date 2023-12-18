<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 ">

    < class="text-center">

        <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
            <h3><?php if (isset($config)) { echo $config['cfg_titulo']; } ?></h3>
            <p>
            <h5><?=$titulo; ?></h5>
            </p>
            <p>
            <h5>Total <?=$count ?></h5>
            </p>
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
                <tbody>
                    <?php if (isset($registros)) { echo $registros; }; ?>
                </tbody>
            </table>
        </div>

        <div class="center mt-3">
            <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
            <a class="btn btn-success" href="<?=$url_base;?>admin/encuestadescarga/<?=$id_encuesta;?>"
                id="btnDescargaEncuesta">Descargar Excel</a>
        </div>

        </body>

        </html>