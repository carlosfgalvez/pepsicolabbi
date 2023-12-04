<nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
  <a class="navbar-brand" href="#">
    <img src="<?=$url_base;?><?=$img_logonavbar;?>" width="100" class="d-inline-block align-top" alt="">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- secciones del inicio -->
  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
    <!--
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="<?=$url_base;?>index">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$url_base;?>index#premios">Premios</a>
      </li>
    </ul>
    -->
  </div>
  <div>
    <ul class="navbar-nav justify-content-end">
      <?php if ($token =="") { ?>
        <!--
        <li class="nav-item">
          <a class="btn btn-outline-secondary" href="<?=$url_base;?>login">Iniciar sessión</a>
        </li>
        -->
      <?php } else { ?>
        <?php if ($home == "1") { ?>
          <li class="nav-item" style="margin-right: 15px;">
            <a class="btn btn-outline-secondary" href="<?=$url_base;?>index">Ir al home</a>
          </li>
        <?php } else { ?>
          <li class="nav-item" style="margin-right: 15px;">
            <a class="btn btn-outline-secondary" href="<?=$url_base;?>admin">Ir al admin</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="btn btn-outline-secondary btnLogout" href="#">Cerrar sesión</a>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<!-- botones -->
