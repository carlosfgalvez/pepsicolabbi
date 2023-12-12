<?=$view_header?>
<?=$view_navbar?>

<div class="disclaimer d-flex justify-content-center toggle-quit">
  <div class="left"></div>
  <div class="right"></div>
  <div class="text">
    <?php if (isset($encuesta['descripcion'])) { ?>
      <h4 class=""><center><?=$encuesta['descripcion']?></center></h4>
    <?php } ?>
  </div>
</div>

<main class="px-3 pb-5 mb-5 container toggle-quit">
  <?php if ($mensaje=='') { ?>
  <form action="#" autocomplete="off">
    <div class="card" style="border-top-right-radius: 0; border-top-left-radius: 0; border-top: none">
      <div class="card-title banner_encuesta" style="border-radius: 30px"></div>
    </div>

    <!-- Loop preguntas -->
    <?php foreach($preguntas as $regpre): ?>

      <!-- preguntas settings-->
      <?php
        $lblPreg = "";
        $tipo    = "";
        $cssrow  = "";
        $csscol  = "";
        $countopc = count($regpre['opciones']);

        /* Pregunta Check */
        if ($regpre['tipo']=='CHECK') {
          if ($regpre['requerido']=='S') { $lblPreg ="(Puedes elegir más de una opción)";}
          else { $lblPreg ="(Opcional puedes elegir más de una opción)";}
          $tipo = "checkbox";
          if ($countopc<=4) {
            $cssrow = "m-auto ps-4 d-md-contents";
            $csscol = "col-6 col-lg-2";
          } else {
            $cssrow = "m-auto ps-4";
            $csscol = "col-12 col-lg-4";
          }
          foreach($regpre['opciones'] as $regopc):
             if ($regopc['img_opcion']!='') { $cssrow = "";}
          endforeach;
        } /* fin check */

        /* Pregunta Radio */
        if ($regpre['tipo']=='RADIO') {
           if ($regpre['requerido']=='N') { $lblPreg = "(Opcional)";}
           $tipo = "radio";
           /*
           if ($countopc==5) {
             $cssrow = "m-auto ps-4 d-md-contents";
             $csscol = "col-6 col-lg-2";
           }
           */

           if ($countopc<4) {
             $cssrow = "m-auto ps-4 ";
             $csscol = "col-12 col-lg-4";
           } elseif ($countopc==4) {
             $cssrow = "m-auto ps-4";
             $csscol = "col-6 col-lg-3";
           } elseif ($countopc==5) {
             $cssrow = "m-auto ps-4";
             $csscol = "col-6 col-lg-4";
           } else {
             $cssrow = "m-auto ps-4";
             $csscol = "col-12 col-lg-4";
           }

           /* excepciones */
           if ($regpre['id']==23) {
             $cssrow = "m-auto ps-4";
             $csscol = "col-12 col-lg-6";
           }

           foreach($regpre['opciones'] as $regopc):
              if ($regopc['img_opcion']!='') { $cssrow = "";}
           endforeach;
        } /* fin radio */

        /* Pregunta Select */
        if ($regpre['tipo']=='SELECT') {
           if ($regpre['requerido']=='S') { $lblPreg ="(Debes seleccionar una opción)";}
           $tipo = "select";
           $cssrow = "d-flex justify-content-center";
           $csscol = "col-12 col-md-6";
        } /* fin Select */

        /* Pregunta Input */
        if ($regpre['tipo']=='INPUT') {
           $tipo = "input";
           $lblPreg = "(Opcional)";
        } /* fin Select */

       ?>

        <div class="card mt-2 pregunta" name="pregunta_<?=$regpre['id']?>" id="<?=$regpre['id']?>" type="<?=$regpre['tipo']?>" reque="<?=$regpre['requerido']?>" >
          <!-- Pregunta -->
          <div class="card-title pt-3">
            <h4><?=$regpre['pregunta'];?> <span class="opcional"><?=$lblPreg;?></span></h4>
          </div>

          <!-- Preguntas - opciones -->
          <div class="card-body pt-0">
            <div class="row <?=$cssrow?>">

              <!-- Pregunta Input -->
              <?php if ($regpre['tipo']=='INPUT') { ?>
                  <?php if ($regpre['id']==27)  { ?>  <!-- excepcion preg 27 -->
                      <div class="col-4"></div>
                      <div class="col-4">
                        <input id="inputpreg_<?=$regpre['id']?>" name="inputpreg_<?=$regpre['id']?>" class="form-control" placeholder="C.P." autocomplete="off"></input>
                      </div>
                      <div class="col-4"></div>
                  <?php } else { ?>
                    <textarea id="inputpreg_<?=$regpre['id']?>" name="inputpreg_<?=$regpre['id']?>" rows="2" class="form-control" style="width: 90%;margin-left: 5%;"  placeholder="Coloque su respuesta..." autocomplete="off"></textarea>
                  <?php } ?>
              <?php } ?>

              <!-- Pregunta Select -->
              <?php if ($regpre['tipo']=='SELECT') { ?>
                <div class="<?=$csscol?>">
                  <select class="form-select" id="select_<?=$regpre['id']?>"><option value="0" selected hidden>(Seleccione una opción)</option>
              <?php } ?>

              <!-- Loop preguntas - opciones -->
              <?php foreach($regpre['opciones'] as $regopc): ?>
                <!-- Opciones Select -->
                <?php if ($regpre['tipo']=='SELECT') { ?>
                  <option value="<?=$regopc['id']?>" input="<?=$regopc['input']?>" reque="<?=$regopc['requerido']?>"><?=$regopc['opcion']?></option>
                <?php } else { ?>

                <!-- Con Imangen -->
                <?php if ($regopc['img_opcion']!='') {
                    $img    = explode( ';', $regopc['img_opcion']);
                    $imagen = $img[0];
                    if (count($img)>1) { $css = $img[1];} else {$css = "";}
                    $col    = "col-6";
                    if ($countopc>2) { $col="col-3";}
                    if ($countopc>=5) { $col="col-4 col-md-2";}
                    /* excepciones */
                    if ($regpre['id']==5) {  $col="col-6 col-md-4"; }
                    ?>
                    <div class="<?=$col?> d-flex justify-content-center">
                      <label class="mouse_select">
                        <?php if ($regpre['tipo']=='CHECK') { ?>
                          <input type="<?=$tipo?>" name="pregunta_<?=$regpre['id']?>" input="<?=$regopc['input']?>" reque="<?=$regopc['requerido']?>" value="<?=$regopc['id']?>"  id="<?=$regopc['id']?>" onclick="opcOtroCheckClick(<?php echo $regopc['id']; ?>);" autocomplete="off"/>
                        <?php } else { ?>
                          <input type="<?=$tipo?>" name="pregunta_<?=$regpre['id']?>" input="<?=$regopc['input']?>" reque="<?=$regopc['requerido']?>" value="<?=$regopc['id']?>"  id="<?=$regopc['id']?>" onclick="opcOtroRadioClick(<?php echo $regpre['id'].','.$regopc['id']; ?>);" autocomplete="off"/>
                        <?php } ?>
                        <div class="option">
                            <img class="img-fluid <?=$css?>" src="<?=$url_base;?><?=$upload_dir;?>/<?=$imagen;?>" alt="<?=$regopc['img_opcion'];?>">
                            <div><?=$regopc['opcion']?></div>
                            <!-- Opciones tiene input -->
                            <?php if ($regopc['input']=='S') { ?>
                              <input type="text" class="form-control  form-control-sm d-inline hide inputs<?=$regpre['id']?>"  style="width: auto" placeholder="Coloque su respuesta..."  id="input_<?=$regopc['id']?>" autocomplete="off"/>
                              <div class="invalid-feedback" id="msg_<?=$regpre['id']?>_<?=$regopc['id']?>">Debes proporcionar una respuesta</div>
                            <?php } ?>
                        </div>
                      </label>
                    </div>
                <?php } else { ?> <!-- sin imagen -->
                  <div class="<?=$csscol?> form-check form-check-inline text-start">
                    <?php if ($regpre['tipo']=='CHECK') { ?>
                      <input class="form-check-input" type="<?=$tipo?>" name="pregunta_<?=$regpre['id']?>" input="<?=$regopc['input']?>" reque="<?=$regopc['requerido']?>" value="<?=$regopc['id']?>"  id="<?=$regopc['id']?>" onclick="opcOtroCheckClick(<?php echo $regopc['id']; ?>);" autocomplete="off"/>
                    <?php } else { ?>
                      <input class="form-check-input" type="<?=$tipo?>" name="pregunta_<?=$regpre['id']?>" input="<?=$regopc['input']?>" reque="<?=$regopc['requerido']?>" value="<?=$regopc['id']?>"  id="<?=$regopc['id']?>" onclick="opcOtroRadioClick(<?php echo $regpre['id'].','.$regopc['id']; ?>);" autocomplete="off"/>
                    <?php } ?>
                    <label class="form-check-label" for="diariamente"><?=$regopc['opcion']?>
                      <!-- Opciones tiene input -->
                      <?php if ($regopc['input']=='S') { ?>
                        <input type="text" class="form-control  form-control-sm d-inline hide inputs<?=$regpre['id']?>"  style="width: auto" placeholder="Coloque su respuesta..."  id="input_<?=$regopc['id']?>" autocomplete="off"/>
                        <div class="invalid-feedback" id="msg_<?=$regpre['id']?>_<?=$regopc['id']?>">Debes proporcionar una respuesta</div>
                      <?php } ?>
                    </label>
                  </div>
                <?php } } ?>
              <?php endforeach; ?>   <!-- Fin Loop opciones -->

              <!-- Pregunta Select -->
              <?php if ($regpre['tipo']=='SELECT') { ?>
              </select></div>
              <?php } ?>

              <!-- Mensajes validaciones -->
              <?php if ($regpre['tipo']=='INPUT') { ?>
                <div class="invalid-feedback" id="msg_<?=$regpre['id']?>">Debes proporcionar una respuesta</div>
              <?php } elseif ($regpre['tipo']=='CHECK') { ?>
                <div class="invalid-feedback" id="msg_<?=$regpre['id']?>">Debes seleccionar al menos una opción</div>
              <?php } else { ?>
                  <div class="invalid-feedback" id="msg_<?=$regpre['id']?>">Debes seleccionar una opción</div>
              <?php } ?>

            </div>

          </div>
          <!-- #pregunta -->
          <span class="position-absolute top-0 start-0 translate-middle badge rounded-circle bg-danger fs-5"> <?=$regpre['orden'];?> </span>
        </div>

    <?php endforeach; ?>  <!-- Fin Loop preguntas -->

    <!-- botón de enviar -->
    <div class="mt-4">
        <a class="btn btn-lg ripple center red d-flex align-items-center justify-content-center"
           href="#" id="btnEnviar">
          ENVIAR ENCUESTA
        </a>
        <div class="invalid-feedback" style="color:#14179a;font-size: 1.2em;" id="msg_enviar_error">Favor verificar, faltan respuestas requeridas</div>
    </div>

  </form>

  <?php } else { ?>
    <p class="alerta"> <?=$mensaje;?></p>
  <?php } ?>
</main>

<?=$view_footer?>
<?=$view_avisoprivacidad?>
<?=$view_terminosycondiciones?>

<script type="text/javascript" src="<?=$url_base;?>public/ui/js/fingerprint.js"></script>

<script>
	$(document).ready(function() {
		var url       = "<?=$url_base; ?>";
    var dir       = "<?=$upload_dir; ?>";
    var idenc     = "<?=$idenc; ?>";
    var imgfondo  = "<?php if (isset($encuesta['img_fondo'])) { echo $encuesta['img_fondo']; } else { echo "";} ?>";
    var colortxt  = "<?php if (isset($encuesta['color_txt'])) { echo $encuesta['color_txt']; } else { echo "";} ?>";

    var imgUrl    = url+dir+'/'+imgfondo;
    console.log('index encuesta '+idenc+'...');

    //if (imgfondo!="") { $("body").css("background-image", "url(" + imgUrl + ")");}
    //if (colortxt!="") {$(".text-color").css("color",colortxt);}

    $('#btnEnviar').on('click', function (e) {
        e.preventDefault();
        //var nombre 					= $("#nombrecompleto").val();
        //var email	  				= $("#email").val();
        //var celular 		  	= $("#celular").val();

        var preg      = [];
        var resp      = [];
        var input     = [];
        var pregreq   = [];
        var inputreq  = [];

        $('.pregunta').each(function(index, value) {
          idpre   = $(this).attr('id');
          name    = $(this).attr('name');
          tipo    = $(this).attr('type');
          reque   = $(this).attr('reque');
          //console.log('pregunta: '+idpre+' '+name+' '+tipo+' '+reque);

          if (tipo=='INPUT') {
            var txtresp = $('#inputpreg_'+idpre).val();
            txtresp = txtresp.replaceAll(",", " ");

            //console.log('#inputpreg_'+idpre+': '+txtresp);
            //if (txtresp=='') { resp.push("null");} else {resp.push(txtresp);}
            resp.push(0);
            input.push(txtresp);
            inputreq.push(reque)
            preg.push(idpre);
            pregreq.push(reque);
          }

          if (tipo=='RADIO') {
            var id = $('input[name = "'+name+'"]:checked').val();
            if (id=='undefined' || id==null) { resp.push(0); } else { resp.push(id);}
            esinput   = $("#"+id).attr('input');
            requeinput   = $("#"+id).attr('reque');
            if (esinput=='S') {
              var val = $("#input_"+id).val();
              val = val.replaceAll(",", " ");
              input.push(val);
              inputreq.push(requeinput);
            } else {
              input.push(null);
              inputreq.push(null);
            }
            preg.push(idpre);
            pregreq.push(reque);
          }

          if (tipo=='CHECK') {
            cont = 0;
            $('input:checkbox[name="'+name+'"]:checked').each(function() {
                id = $(this).val();
                cont++;
                if (id=='undefined' || id==null) {
                  resp.push(0);
                  input.push(null);
                  inputreq.push(null);
                } else {
                  resp.push(id);
                  esinput = $("#"+id).attr('input');
                  requeinput   = $("#"+id).attr('reque');
                  if (esinput=='S') {
                    var val = $("#input_"+id).val();
                    val = val.replaceAll(",", " ");
                    input.push(val);
                    inputreq.push(requeinput);
                  } else {
                    input.push(null);
                    inputreq.push(null);
                  }
                }
                preg.push(idpre);
                pregreq.push(reque);
            });
            if (cont==0) {
              input.push(null);
              inputreq.push(null);
              preg.push(idpre);
              pregreq.push(reque);
              resp.push(0);
            }
          }

          if (tipo=='SELECT') {
            var val = $('#select_'+idpre).val();
            if (val>0) { resp.push(val); } else { resp.push(0);}
            input.push(null);
            inputreq.push(null);
            preg.push(idpre);
            pregreq.push(reque);
          }

        }); // fin loop preguntas
/*
        console.log('preg:'+preg);
        console.log('pregreq:'+pregreq);
        console.log('resp:'+resp);
        console.log('input:'+input);
        console.log('inputreq:'+inputreq);
*/
        //if (validarEncuesta(preg,pregreq,resp,input,inputreq,nombre,email,celular)) {
        if (validarEncuesta(preg,pregreq,resp,input,inputreq)) {
            enviar(idenc,preg,resp,input,url);
        }
	   });

	}); // Ready

  function opcOtroRadioClick(idp,ido) {
    $(".inputs"+idp).addClass("hide");
    $("#input_"+ido).removeClass("hide");
    $('#msg_'+idp).css("display","none");
  }

  function opcOtroCheckClick(ido) {
    if($('#'+ido).is(':checked') ){
      $("#input_"+ido).removeClass("hide");
    }
    else{
      $("#input_"+ido).addClass("hide");
    }

  }
</script>
