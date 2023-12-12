<?=$view_header?>
<?=$view_navbar?>

<main class="px-3 pb-5 mb-5 container toggle-quit">

<div class="row mt-80 msg-gen">
	<div class="col-sm-1 col-md-1 col-lg-3 col-xl-3"></div>
	<div class="col-sm-11 col-md-11 col-lg-6 col-xl-6">
			<div class="login-cuadro">
					<div class="">
							<div class="row mb-4">
									<div class="col-12">&nbsp;</div>
							</div>
							<div class="row mb-4">
									<div class="col-12">
											<h3 class="text-center">INICIA SESIÓN</h3>
									</div>
							</div>
							<form>
									<div class="row mb-3">
											<div class="col-2"></div>
											<div class="col-8 left">
												<label for="inputEmail" class="form-label">Usuario:</label>
												<input type="text" id="correo" class="form-control" placeholder="Ingrese el usuario" autocomplete="off"/>
												<div class="invalid-feedback" id="msgEmail">No válido</div>
											</div>
									</div>
									<div class="row mb-3">
											<div class="col-2"></div>
											<div class="col-8 left">
												<label for="inputPassword" class="form-label">Contraseña:</label>
												<div class="password-container input-group">
														<input type="password" id="password" class="form-control" placeholder="Ingrese la contraseña" required autocomplete="off"/>
														<span class="input-group-text">
															<i class="bi bi-eye" id="eyeInputPassword"></i>
														</span>
												</div>
												<div class="invalid-feedback" id="msgContrasena">No válido</div>
											</div>
									</div>
									<div class="row mb-5">
											<div class="col-xs-12 col-12 text-center">
													<a href="#" id="btnIngresar" class="btn btn-primary">Continuar</a>
											</div>
									</div>

									<div class="row mb-5">
											<div class="col-12 text-center">
													<a href="<?=$url_base;?>index" class="btn btn-outline-secondary">Volver</a>
											</div>
									</div>

									<div class="row mt-5">
											<div class="col-12 text-center">
													&nbsp;
											</div>
									</div>
							</form>

					</div>
			</div>
	</div>
</div>

<!-- Modal login erroneo -->
<div class="modal fade" id="modalLoginError" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content registro-resultado-cuadro">
            <div class="modal-body">
								<div class="row mb-5">
									<div class="col-12">
											<a href="#" class="position-absolute end-0" data-bs-dismiss="modal" aria-label="Close">
													<img src="<?=$url_base;?><?=$img_x;?>" class="" style="width: 50px;"/>
											</a>
									</div>
								</div>
                <div class="row mb-5"><div class="col-12">&nbsp;</div></div>
                <div class="row mb-5"><div class="col-12">&nbsp;</div></div>
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h5 id="msgErrorLogin">Error al ingresar</h5>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12 text-center">
											<a href="#" class="btn btn-outline-secondary text-center m-5" data-bs-dismiss="modal" aria-label="Close">
													Regresar
											</a>
                    </div>
                </div>
                <div class="row mb-5"><div class="col-12">&nbsp;</div></div>
                <div class="row mb-5"><div class="col-12">&nbsp;</div></div>
            </div>
        </div>
    </div>
</div>

</main>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script type="application/javascript">
    $( document ).ready( function() {
      console.log('Login...');
      var url   = "<?php echo $url_base; ?>";

      //$('#container').addClass('login-background');

  		$('#btnIngresar').on('click', function (e) {
  			e.preventDefault();
  			loginClick(url);
  		});

      $(document).on("keypress", function(e){
        if(e.which == 13){
          loginClick(url);
        }
      });

			$('#eyeInputPassword').on('click', function(){
			    $(this).toggleClass('bi-eye').toggleClass('bi-eye-slash');
			    let tipo = $('#password').attr('type') === "password" ? "text" : "password";
			    $('#password').attr('type', tipo);
			});

    });

    function loginClick(url) {
      var email	  				= $("#correo").val();
      var pass 				  	= $("#password").val();

     if (validarIngreso(email,pass)) {
         ingresar(email,pass,url);
     }
    }


</script>
