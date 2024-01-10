/*********************************************************/
/********************* encuesta   ************************/
/*********************************************************/

// validarEncuesta
function validarEncuesta(preg, pregreq, resp, input, inputreq) {
  var msgError = "";
  var validOk = true;

  // buscar preguntas requeridas
  for (let i = 0; i < pregreq.length; i++) {
    idpreg = preg[i];
    $("#msg_" + idpreg).css("display", "none");
    req = pregreq[i];
    //console.log('pregunta: '+idpreg+' resp: '+resp[i]);
    if (req == "S") {
      // validar que tenga respuesta
      //console.log('pregunta: '+idpreg+' resp: '+resp[i]);
      if (resp[i] == 0) {
        $("#msg_" + idpreg).css("display", "block");
        validOk = false;
      }
    }
  }

  // buscar inputs requeridas
  for (let i = 0; i < input.length; i++) {
    idpreg = preg[i];
    idresp = resp[i];
    $("#msg_" + idpreg + "_" + idresp).css("display", "none");
    req = inputreq[i];
    //console.log('pregunta '+idpreg+' opcion '+idresp+' input '+input[i]);
    if (req == "S") {
      // validar que tenga respuesta
      if (input[i] == "" || input[i] == null) {
        $("#msg_" + idpreg + "_" + idresp).css("display", "block");
        validOk = false;
      }
    }
  }

  if (!validOk) {
    $("#msg_enviar_error").css("display", "block");
  } else {
    $("#msg_enviar_error").css("display", "none");
  }
  return validOk;
}

// enviar encuesta
function enviar(idenc, preg, resp, input, url) {
  var uid = "";
  if (typeof fp !== "undefined") {
    uid = fp.get();
  } // finger prints
  var dataString =
    "acc=1&ide=" +
    idenc +
    "&pre=" +
    preg +
    "&res=" +
    resp +
    "&inp=" +
    input +
    "&uid=" +
    uid;
  //console.log('enviar encuesta:'+dataString);
  muestraProcesando();
  $.ajax({
    type: "POST",
    url: url + "respuesta",
    data: dataString,
    success: function (data) {
      console.log("enviar resultado: " + data);
      ocultaProcesando();
      if (data != "") {
        var res = data.split(";")[0];
        var msg = data.split(";")[1];
        var id = data.split(";")[2];
        if (res == 0) {
          location.href = url + "gracias";
          //location.href="gracias?id="+id;
        } else {
          $("#msg_enviar_error").text(msg);
          $("#msg_enviar_error").css("display", "block");
        }
      } else {
        $("#msg_enviar_error").text(
          "No se pudo enviar la encuesta, vuelva a intentarlo."
        );
        $("#msg_enviar_error").css("display", "block");
      }
    },
  });
}

// validarEncuestaDatosPersonales
function validarEncuestaDatosPersonales(nombre, email, celular, aviso) {
  var msgError = "";
  var validOk = true;

  $("#msg_nombre").text(msgError);
  $("#msg_email").text(msgError);
  $("#msg_celular").text(msgError);
  $("#msg_aviso").text(msgError);

  if (typeof nombre !== "undefined") {
    if (nombre == "") {
      msgError = "Campo obligatorio";
      $("#msg_nombre").text(msgError);
      $("#msg_nombre").css("display", "block");
      validOk = false;
    }
    if (nombre.length > 50) {
      msgError = "El máximo de caracteres es de 50";
      $("#msg_mombre").text(msgError);
      $("#msg_mombre").css("display", "block");
      validOk = false;
    }
    if (email != "" && !emailIsValid(email)) {
      msgError = "Debes proporcionar un correo válido";
      $("#msg_email").text(msgError);
      $("#msg_email").css("display", "block");
      validOk = false;
    }
    if (email.length > 50) {
      msgError = "El máximo de caracteres permitido es de 50";
      $("#msg_email").text(msgError);
      $("#msg_email").css("display", "block");
      validOk = false;
    }
    if (email == "") {
      msgError = "Campo obligatorio";
      $("#msg_email").text(msgError);
      $("#msg_email").css("display", "block");
      validOk = false;
    }
    //if (cel=="")  { msgError = "Campo obligatorio"; $('#msgCelular').text(msgError);$('#msgCelular').css("display","block");validOk = false; }
    if (celular.length > 45) {
      msgError = "El máximo de caracteres es de 45";
      $("#msg_celular").text(msgError);
      $("#msg_celular").css("display", "block");
      validOk = false;
    }
    if (!aviso) {
      msgError = "Debes aceptar el aviso de privacidad";
      $("#msg_aviso").text(msgError);
      $("#msg_aviso").css("display", "block");
      validOk = false;
    }
  }

  if (!validOk) {
    $("#msg_enviar_error").css("display", "block");
  } else {
    $("#msg_enviar_error").css("display", "none");
  }
  return validOk;
}

// enviar encuesta datos personales
function enviarDatosPersonales(nombre, email, celular, url) {
  var dataString = "acc=2&nom=" + nombre + "&ema=" + email + "&cel=" + celular;
  console.log("enviar encuesta datos personales:" + dataString);
  muestraProcesando();
  $.ajax({
    type: "POST",
    url: url + "respuesta",
    data: dataString,
    success: function (data) {
      console.log("enviar datos: " + data);
      ocultaProcesando();
      if (data != "") {
        var res = data.split(";")[0];
        var msg = data.split(";")[1];
        //var id  = data.split(";")[2];
        if (res == 0) {
          $("#datospersonales").css("display", "none");
          $("#msg_enviar").text(msg);
          //$('#msg_enviar').css("display","block");
        } else {
          $("#msg_enviar_error").text(msg);
          $("#msg_enviar_error").css("display", "block");
        }
      } else {
        $("#msg_enviar_error").text(
          "No se pudo enviar la encuesta, vuelva a intentarlo."
        );
        $("#msg_enviar_error").css("display", "block");
      }
    },
  });
}

// enviarDatosPersonalesRegistroHome
function enviarDatosPersonalesRegistroHome(nombre, email, celular, url) {
  var dataString = "acc=7&nom=" + nombre + "&ema=" + email + "&cel=" + celular;
  console.log("enviar encuesta datos personales:" + dataString);
  muestraProcesando();
  $.ajax({
    type: "POST",
    url: url + "respuesta",
    data: dataString,
    success: function (data) {
      console.log("enviar datos: " + data);
      ocultaProcesando();
      if (data != "") {
        var res = data.split(";")[0];
        var msg = data.split(";")[1];
        //var id  = data.split(";")[2];
        if (res == 0) {
          $("#datospersonales").css("display", "none");
          $("#msg").text(msg);
          $("#mainmsg").removeClass("hide");
        } else {
          $("#msg_enviar_error").text(msg);
          $("#msg_enviar_error").css("display", "block");
        }
      } else {
        $("#msg_enviar_error").text(
          "No se pudo enviar la encuesta, vuelva a intentarlo."
        );
        $("#msg_enviar_error").css("display", "block");
      }
    },
  });
}

/*********************************************************/
/******************** login/logout  **********************/
/*********************************************************/

/******** ingresar  *******/
function ingresar(email, pass, url) {
  var dataString = "acc=3&ema=" + email + "&pass=" + pass;
  console.log("ingresar:" + dataString);
  muestraProcesando();
  $.ajax({
    type: "POST",
    url: url + "respuesta",
    data: dataString,
    success: function (data) {
      console.log("ingresar respuesta: " + data);
      ocultaProcesando();
      //data = data.replaceAll("<!-- DEBUG-VIEW START 1 APPPATH/Views/template/respuesta.php -->", "");
      //data = data.replaceAll("<!-- DEBUG-VIEW ENDED 1 APPPATH/Views/template/respuesta.php -->", "");
      if (data != "") {
        var res = data.split(";")[0];
        var msg = data.split(";")[1];
        var id = data.split(";")[2];
        var tp = data.split(";")[3];

        if (res == 0) {
          location.href = url + "admin";
        } else {
          $("#msgErrorLogin").text(msg);
          $("#modalLoginError").modal("show");
        }
      } else {
        $("#msgErrorLogin").text("Error al ingresar");
        $("#modalLoginError").modal("show");
      }
    },
  });
}

/******** validar ingreso  *******/
function validarIngreso(email, pass) {
  var msgError = "";
  var validOk = true;

  $("#msgEmail").text(msgError);
  $("#msgContrasena").text(msgError);

  // Validaciones
  //if (!emailIsValid (email) ) { msgError = "Debes proporcionar un correo válido"; $('#msgEmail').text(msgError);$('#msgEmail').css("display","block");validOk = false; }
  if (email == "") {
    msgError = "Campo obligatorio";
    $("#msgEmail").text(msgError);
    $("#msgEmail").css("display", "block");
    validOk = false;
  }
  if (pass == "") {
    msgError = "Campo obligatorio";
    $("#msgContrasena").text(msgError);
    $("#msgContrasena").css("display", "block");
    validOk = false;
  }
  if (pass.length < 8 || pass.length > 20) {
    msgError = "Debe contener entre 8 y 20 caracteres";
    $("#msgContrasena").text(msgError);
    $("#msgContrasena").css("display", "block");
    validOk = false;
  }

  return validOk;
}

/******** logout *******/
function logout(url) {
  var dataString = "&acc=4";
  console.log("logout...");
  muestraProcesando();
  $.ajax({
    type: "POST",
    url: url + "respuesta",
    data: dataString,
    success: function (data) {
      //console.log(data);
      ocultaProcesando();
      window.location.href = "index";
    },
  });
}

/*********************************************************/
/************************ admin  *************************/
/*********************************************************/

// get_encuesta_count
function get_encuesta_count(ide, url) {
  var dataString = "&acc=100&ide=" + ide;
  console.log("get_encuesta_count: " + dataString);
  var count = 0;
  var query = "";
  var urldescarga = url + "admin/encuestadescarga/" + ide;
  var urlvista = url + "admin/verenviadas/" + ide;

  $.ajax({
    type: "POST",
    url: url + "respuesta",
    data: dataString,
    success: function (data) {
      console.log(data);
      var count = data.split("|")[0];
      var fecha = data.split("|")[1];
      if (data != "" && count > 0) {
        $("#count_enviadas").text(count);
        $("#ultima_enviada").text(fecha);
        if (ide != "0") {
          $("#btnDescargaEncuesta").attr("href", urldescarga);
          $("#btnDescargaEncuesta").removeClass("hide");
          $("#btnVerEnviadas").attr("href", urlvista);
          $("#btnVerEnviadas").removeClass("hide");
        } else {
          $("#btnDescargaEncuesta").attr("href", "");
          $("#btnDescargaEncuesta").addClass("hide");
          $("#btnVerEnviadas").attr("href", "");
          $("#btnVerEnviadas").addClass("hide");
        }
      } else {
        $("#count_enviadas").text(0);
        $("#ultima_enviada").text("");
        $("#btnDescargaEncuesta").attr("href", "");
        $("#btnDescargaEncuesta").addClass("hide");
        $("#btnVerEnviadas").attr("href", "");
        $("#btnVerEnviadas").addClass("hide");
      }
    },
  });
  return count;
}

/*********************************************************/
/********************* utilities  ************************/
/*********************************************************/

// emailIsValid
function emailIsValid(email) {
  return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(
    email
  );
}

// muestraProcesando
function muestraProcesando() {
  //$("#loading-overlay").show();
  $("#loading-overlay").css("display", "block");
}

// ocultaProcesando
function ocultaProcesando() {
  //$("#loading-overlay").hide();
  $("#loading-overlay").css("display", "none");
}

