<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 toggle-quit">

    <div class="text-center">
        <h3 class="text-center mt-5">Encuestas <span class="number"> <?=$count;?> </span></h3>
        <div class="text-right" style="text-align: right!important;">
            <a href="<?=$url_base.'encuestas/create';?>" class="btn btn-success btn-sm" role="button">Nuevo</a>
        </div>
        <br>

        <!-- mensaje -->
        <?=$view_message?>

        <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
            <table class="table center">
                <thead>
                    <tr>
                        <!--<th>Id Encuesta</th>-->
                        <th class="center ">Nombre</th>
                        <!--<th class="center ">Descripción</th>-->
                        <th class="center ">Código</th>

                        <th class="center ">Imagen Portada</th>
                        <th class="center ">Imagen Fondo</th>
                        <!--<th class="center ">Color txt</th>-->
                        <th class="center ">Fecha Inicio</th>
                        <th class="center ">Fecha Fin</th>
                        <th class="center ">Solicitar Datos personales</th>
                        <th class="center ">Validar duplicidad</th>
                        <th class="center ">Orden</th>
                        <th class="center ">Activo</th>
                        <th class="center ">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($registros as $reg): ?>
                    <tr>
                        <!--<td class="center"><?=$reg['id']?></td>-->
                        <td class="center"><?=$reg['nombre']?></td>
                        <!--<td class="center"><?=$reg['descripcion']?></td>-->
                        <td class="center"><?=$reg['codigo']?></td>
                        <td class="center"><img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['img_portada']?>"
                                alt="<?=$reg['img_portada']?>" style="width:20%;"></td>
                        <td class="center"><img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['img_fondo']?>"
                                alt="<?=$reg['img_fondo']?>" style="width:20%;"></td>
                        <!--
              <td class="center"><?=$reg['img_portada']?></td>
              <td class="center"><?=$reg['img_fondo']?></td>
              <td class="center"><?=$reg['color_txt']?></td>-->
                        <td class="center"><?=$reg['fecha_inicio']?></td>
                        <td class="center"><?=$reg['fecha_fin']?></td>
                        <td class="center"><?=$reg['datos_personales']?></td>
                        <td class="center"><?=$reg['duplicidad']?></td>
                        <td class="center"><?=$reg['orden']?></td>
                        <td class="center"><?=$reg['activo']?></td>
                        <td class="center ">
                            <a href="<?=$url_base.'encuestas/edit/'.$reg['idenc'];?>" class="btn btn-primary btn-sm"
                                role="button">Editar</a>
                            <a href="<?=$url_base.'encuestas/delete/'.$reg['idenc'];?>"
                                class="btn  btn-outline-danger btn-sm" role="button">Borrar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="text-center">
                <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
                <?php if ($page>0) {?>
                <a href="<?=$url_base.'encuestas/'.$page;?>" class="btn btn-secondary btn-sm" role="button">Ver más</a>
                <?php } else { ?>
                <a href="#" class="btn btn-secondary btn-sm" role="button">No hay más registros</a>
                <?php } ?>
            </div>
            <br>
        </div>
    </div>
</main>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script type="application/javascript">
$(document).ready(function() {
    console.log('Encuestas...');
});
</script>