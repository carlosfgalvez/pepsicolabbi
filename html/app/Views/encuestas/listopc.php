<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 container toggle-quit">

<div class="text-center">
  <h3 class="text-center mt-5">Encuestas - Opciones <span class="number"> <?=$count;?></span></h3>
  <select class="" id="list_encuestas"><?=$list_encuestas;?></select><br>
  <select class="" id="list_preguntas"><?=$list_preguntas;?></select>
  <div class="text-right" style="text-align: right!important;">
    <a href="<?=$url_base.'opciones/createopc/'.$idp.'/'.$ideencryp;?>" class="btn btn-success btn-sm hide"  role="button" id="btnNuevo">Nuevo</a>
  </div>
  <br>

  <!-- mensaje -->
  <?=$view_message?>

  <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
    <table class="table center">
      <thead>
        <tr>
          <!--
          <th class="center ">Id Encuesta</th>
          <th class="center ">Id Pregunta</th>
          <th class="center ">Id Opción</th>-->
          <th class="center ">Opción</th>
          <th class="center ">Input</th>
          <th class="center ">Requerido</th>
          <th class="center ">Imagen Opción</th>
          <th class="center ">Imagen Alto</th>
          <th class="center ">Imagen Ancho</th>
          <th class="center ">Orden</th>
          <th class="center ">Activo</th>
          <th class="center ">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($registros as $reg): ?>
            <tr>
              <!--
              <td class="center"><?=$reg['id_encuesta']?></td>
              <td class="center"><?=$reg['id_pregunta']?></td>
              <td class="center"><?=$reg['id']?></td>-->
              <td class="center"><?=$reg['opcion']?></td>
              <td class="center"><?=$reg['input']?></td>
              <td class="center"><?=$reg['requerido']?></td>
              <td class="center"><?=$reg['img_opcion']?></td>
              <td class="center"><?=$reg['img_alto']?></td>
              <td class="center"><?=$reg['img_ancho']?></td>
              <td class="center"><?=$reg['orden']?></td>
              <td class="center"><?=$reg['activo']?></td>
              <td class="center ">
                <a href="<?=$url_base.'opciones/editopc/'.$reg['id'].'/'.$idp.'/'.$ideencryp;?>" class="btn btn-primary btn-sm" role="button">Editar</a>
                <a href="<?=$url_base.'opciones/deleteopc/'.$reg['id'].'/'.$idp.'/'.$ideencryp;?>" class="btn  btn-outline-danger btn-sm" role="button">Borrar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <div class="text-center">
      <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
      <?php if ($page>0) {?>
        <a href="<?=$url_base.'opciones/'.$page.'/'.$ideencryp.'/'.$idpencryp;?>" class="btn btn-secondary btn-sm" role="button">Ver más</a>
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
  $(document).ready(function () {
    console.log('Opciones...');
    var url = "<?=$url_base; ?>";
    var page = "<?=$page; ?>";

    var idp = $('#list_preguntas').val();

    if (idp!="0") { $("#btnNuevo").removeClass("hide");}

    $('#list_encuestas').on('change', function (e) {
      var ide = $('#list_encuestas').val();

      if (ide!="") { window.location = url+'opciones/1/' + ide; }
    });

    $('#list_preguntas').on('change', function (e) {
      var ide = $('#list_encuestas').val();
      var idp = $('#list_preguntas').val();

      if (idp!="") { window.location = url+'opciones/1/'+ ide+'/'+ idp; }
    });

  });
</script>
