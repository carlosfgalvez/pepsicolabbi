<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 toggle-quit">
<div class="text-center">
  <h3 class="text-center mt-5">Encuestas - Preguntas <span class="number"> <?=$count;?></span></h3>
  <select class="" id="list_encuestas"><?=$list_encuestas;?></select>
  <div class="text-right" style="text-align: right!important;">
    <a href="<?=$url_base.'preguntas/createpreg/'.$ideencryp;?>" class="btn btn-success btn-sm hide" role="button" id="btnNuevo">Nuevo</a>
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
          <th class="center ">Id Pregunta</th>-->
          <th class="center ">Pregunta</th>
          <th class="center ">Tipo</th>
          <th class="center ">Requerido</th>
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
              <td class="center"><?=$reg['id']?></td>-->
              <td class="center"><?=$reg['pregunta']?></td>
              <td class="center"><?=$reg['tipo']?></td>
              <td class="center"><?=$reg['requerido']?></td>
              <td class="center"><?=$reg['orden']?></td>
              <td class="center"><?=$reg['activo']?></td>
              <td class="center ">
                <a href="<?=$url_base.'preguntas/editpreg/'.$reg['id'].'/'.$ideencryp;?>" class="btn btn-primary btn-sm" role="button">Editar</a>
                <a href="<?=$url_base.'preguntas/deletepreg/'.$reg['id'].'/'.$ideencryp;?>" class="btn  btn-outline-danger btn-sm" role="button">Borrar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <div class="text-center">
      <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
      <?php if ($page>0) {?>
        <a href="<?=$url_base.'preguntas/'.$page.'/'.$ideencryp;?>" class="btn btn-secondary btn-sm" role="button">Ver más</a>
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
    console.log('Preguntas...');
    var url = "<?=$url_base; ?>";
    var page = "<?=$page; ?>";
    var id = $('#list_encuestas').val();

    if (id!="0") { $("#btnNuevo").removeClass("hide");}

    $('#list_encuestas').on('change', function (e) {
      var id = $('#list_encuestas').val();

      if (id!="") {
        window.location = url+'preguntas/1/' + id;
      }
    });

  });
</script>
