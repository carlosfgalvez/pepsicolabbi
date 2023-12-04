<?=$view_header?>
<?=$view_navbar?>

<div class="subbanner toggle-quit">
	<img src="<?=$url_base;?>public/ui/images/<?=$encuestacod?>/subbanner.webp" alt="subbanner" />
	<div class="title fs-2 text-white">Gracias por contestar la encuesta, tu opinión es muy valiosa.</div>
	<div class="separador"></div>
	<div class="text fs-5 text-white" id="msg_enviar">
		Si te gustaría ser de las primeras personas en conocer las innovaciones<br />
		no olvides dejar tus datos y nosotros te contactaremos
	</div>
</div>

<?php if (isset($encuesta['datos_personales'])) { ?>
	<?php if ($encuesta['datos_personales']=='S') { ?>
			<main class="px-3 pb-5 mb-5 container toggle-quit" id="datospersonales">
				<div class="row">
					<div class="col-12 col-md-6 text-start mb-4">
						<div class="fs-3">¿Te gustaría probar nuestra innovaciones?</div>
						<div class="text-red">Dejanos tus datos y podrías ser seleccionado para ser de los primeros en probar lo nuevo de tus marcas favoritas.</div>
					</div>
					<div class="col-12 col-md-6 row text-start">
						<div class="col-12 mb-3">
							<input type="text" class="form-control" placeholder="Nombre completo"  id="nombrecompleto"  autocomplete="off"/>
							<div class="invalid-feedback" id="msg_nombre">Error</div>
						</div>
						<div class="col-12 mb-3">
							<input type="text" class="form-control" placeholder="Correo electrónico"  id="email"  autocomplete="off"/>
							<div class="invalid-feedback" id="msg_email">Error</div>
						</div>
						<div class="col-12 mb-3">
							<input type="text" class="form-control" placeholder="Teléfono"  id="celular"  autocomplete="off"/>
							<div class="invalid-feedback" id="msg_celular">Error</div>
						</div>

						<div class="col-12 col-md-6 mb-3 text-center text-md-start">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="avisodeprivasidad" id="avisodeprivasidad" />
								<label class="form-check-label" for="mejor1">
									<a href="#" class="nav-link px-2  text-underline verAvisoprivacidad" id="">Acepto aviso de privacidad</a	>
								</label>
								<div class="invalid-feedback" id="msg_aviso">Debes aceptar el aviso de privacidad</div>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<a href="#" class="btn btn-sm ripple center enviar red d-flex align-items-center justify-content-center" id="btnEnviar">ENVIAR</a>
						</div>
						<div class="invalid-feedback" id="msg_enviar_error"></div>

					</div>
				</div>
			</main>

		<?php } ?>
<?php } ?>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script>
	$(document).ready(function() {
    console.log('Gracias...');
		var url = "<?=$url_base; ?>";
		var idenv = "<?=$idenv; ?>";

		$('#btnEnviar').on('click', function (e) {
				e.preventDefault();
				var nombre 					= $("#nombrecompleto").val();
				var email	  				= $("#email").val();
				var celular 		  	= $("#celular").val();
				var aviso     		  = $('#avisodeprivasidad').prop('checked');

				if (validarEncuestaDatosPersonales(nombre,email,celular,aviso)) {
						enviarDatosPersonales(nombre,email,celular,url);
				}
		});

		$('#avisodeprivasidad').on('click', function (e) {
			$('#msg_aviso').text('');
		});

	});
</script>
