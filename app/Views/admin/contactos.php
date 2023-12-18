<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 ">

    <div class="text-center">

        <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
            <p>
            <h5><?=$titulo; ?></h5>
            </p>
            <p>
            <h5>Total <?= $count; ?></h5>
            </p>
        </div>
        <br />
        <div class="center mt-3"
            style="background-color: white;font-family: monospace!important;font-size: small; overflow-x: auto;">
            <table class="table center">
                <tr>
                    <th style='padding: 5px; color: white; background-color: #28458E'>ID</th>
                    <th style='padding: 5px; color: white; background-color: #28458E'>Nombre</th>
                    <th style='padding: 5px; color: white; background-color: #28458E'>Correo</th>
                    <th style='padding: 5px; color: white; background-color: #28458E'>Telefono</th>
                    <th style='padding: 5px; color: white; background-color: #28458E'>Fecha de registro</th>
                </tr>
                <tbody>
                    <?php if (isset($registros)) { echo $registros; }; ?>
                </tbody>
            </table>
            <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
            <a class="btn btn-success" href="<?=$url_base;?>contactos/descargaContactos"
                id="btnDescargaEncuesta">Descargar Excel</a>
        </div>

        </body>

        </html>