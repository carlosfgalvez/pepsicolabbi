<?=$view_header?>
<?=$view_navbar?>

<div class="container text-center">
  <h1 class="pt-5"><center><?=$cfg_titulo?></center></h1>
  <p class=""><center><?=$cfg_descripcion?></center></p>
  <!--
  <p><center>Acumula puntos registrando tus tickets de compra de productos de Ricitos de Oro y<br>
             obten acceso a material exclusivo, increibles recompensas y muchas más sorpresas.</center></p>
  -->

  <!--<h3 class="mt-5"> BANNER CON LOS DIFERENTES PRODUCTOS DE INNOVACIÓN </h3>-->
  <ul id="bannershome" class="owl-carousel">
  <?php foreach($banners as $reg): ?>
    <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['imagen1'];?>" width="100" class="d-inline-block align-top" style="border-radius: 5px;" alt="">
  <?php endforeach; ?>
  </ul>

  <?php foreach($encuestas as $reg): ?>
    <div class="row" style="padding: 50px;">
      <div class="col-2"></div>
      <div class="col-2" style="text-align: right;">
        <img src="<?=$url_base;?><?=$upload_dir;?>/<?=$reg['img_portada'];?>" width="100" class="d-inline-block align-top" style="border-radius: 5px;" alt="">
      </div>
      <div class="col-2" style="text-align: left;">
          <span><strong><?=$reg['nombre']?></strong></span><br>
          <span><?php
            if (strlen($reg['descripcion']) < 45 ){
              echo $reg['descripcion'];
            } else {
                echo  substr($reg['descripcion'],0,45).'...';
            }
          ?></span><br>
          <span><small><?=$reg['fecha']?></small></span>
      </div>
      <div class="col-4" style="text-align: left;">
        <?php if ($reg['vigente']=='S') { ?>
          <a class="btn btn-primary  btn-lg" href="<?=$url_base;?>encuesta/<?=$reg['url'];?>">Responder encuesta</a>
        <?php } else { ?>
          <span class="alerta">Encuesta ya no se encuentra vigente</span>
        <?php } ?>
      </div>
      <div class="col-2"></div>
    </div>
  <?php endforeach; ?>

</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
	$(document).ready(function() {
		var url = "<?=$url_base; ?>";
    console.log('index...'+url);

    //$('.owl-carousel').owlCarousel();
	});
</script>
