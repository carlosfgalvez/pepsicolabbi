<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 toggle-quit">

<div class="text-center">
  <h3 class="text-center mt-5">Settings <span class="number"> <?=$count;?></span></h3>
  <div class="text-right" style="text-align: right!important;">
    <a href="<?=$url_base.'settings/create';?>" class="btn btn-success btn-sm" role="button">Nuevo</a>
  </div>
  <br>

  <!-- mensaje -->
  <?=$view_message?>

 <div class="center mt-3" style="background-color: white;font-family: monospace!important;font-size: small;">
    <table class="table center">
      <thead>
        <tr>
          <!--<th>Id</th>-->
          <th class="center">Tipo</th>
          <th class="center ">Nombre</th>
          <th class="center ">Valor</th>
          <th class="center ">Descripción</th>
          <th class="center ">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($registros as $reg): ?>
            <tr>
              <!--<td><?=$reg['id']?></td>-->
              <td class="center"><?=$reg['tipo']?></td>
              <td class="center"><?=$reg['nombre']?></td>
              <td class="center "><?=$reg['valor']?></td>
              <td class="center"><?=$reg['descripcion']?></td>
              <td class="center ">
                <a href="<?=$url_base.'settings/edit/'.$reg['id'];?>" class="btn btn-primary btn-sm" role="button">Editar</a>
                <a href="<?=$url_base.'settings/delete/'.$reg['id'];?>" class="btn  btn-outline-danger btn-sm" role="button">Borrar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <div class="text-center">
      <a href="<?=$url_base;?>admin" class="btn btn-outline-secondary btn-sm" role="button">Regresar</a>
      <?php if ($page>0) {?>
        <a href="<?=$url_base.'settings/'.$page;?>" class="btn btn-secondary btn-sm" role="button">Ver más</a>
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
    console.log('settings...');
    //$('#container').css('background-color','white');
  });
</script>
