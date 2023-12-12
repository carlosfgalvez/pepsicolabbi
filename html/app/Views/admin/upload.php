<?=$view_header?>
<?=$view_navbar?>


<!-- Encabezado -->
<div class="row mt-80 mt-5" id="divPerfilHeader">
   <div class="col-1"></div>
   <div class="col-xs-4 col-4">
       <p>Bienvenido <strong><?=$reg['nombre'];?></strong></br></p>
   </div>
   <div class="col-1"></div>
</div>

<!-- Título principal -->
<div class="row">
    <div class="col-12">
        <h3 class="text-center">Subir Archivos</h3>
    </div>
</div>

<!-- mensaje -->
<?=$view_message?>

<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
  <form method="post" action="<?=$url_base;?>Admin/uploadFiles" enctype="multipart/form-data">
    <div class="form-group mt-3">
      <input type="file" name='images[]' id="uploadFiles" multiple="" class="form-control" accept="image/png, image/jpeg">
    </div>

    <div class="form-group text-center mt-5 mb-5">
      <button type="submit" class="btn btn-success">Subir Archivo(s)</button>
    </div>
  </form>
  </div>
  <div class="col-3"></div>
</div>
<div class="invalid-feedback text-center" id="msgUpload">Favor seleccionar el(los) archivo(s)</div>


<div class="row ">
  <div class="col-12 text-center mt-5 mb-5">
    <a href="<?=$url_base;?>admin" class="end-0 btn btn-outline-secondary" id="">
      <!--<img src="<?=$url_base;?>ui/images/Subir-imagen_BOTON_Ir-al-perfil.png" class="w-190px" />-->
      Volver
    </a>
  </div>
</div>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
	$(document).ready(function() {
		console.log('upload...');
	});

  $(document).on("click", ":submit", function (e) {
    if (!$('#uploadFiles').val()) {
      e.preventDefault();
      $('#msgUpload').css("display","block");
    } else {
      $('#msgUpload').css("display","none");
    }
  });
</script>
