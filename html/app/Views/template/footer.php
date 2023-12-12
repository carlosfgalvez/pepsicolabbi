
<footer>
  <ul class="nav nav-fill d-flex justify-content-center align-items-center">
    <li class="nav-item">
      <a class="nav-link" href="#"><img alt="pepsico" class="img-fluid pepsico" src="<?=$url_base;?>public/ui/images/pepsico.webp" /></a>
    </li>
    <li class="nav-item">
      <span class="nav-link" href="#">&copy;Copyright 2023 PepsiCo, Inc., Todos los Derechos Reservados <!--<br />AVISO DE PRIVACIDAD--></span>
    </li>
    <li class="nav-item">
      <a class="nav-link verAvisoprivacidad" href="#">Aviso de privacidad</a>
    </li>
  </ul>
</footer>

<script type="text/javascript" src="<?=$url_base;?>public/ui/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?=$url_base;?>public/ui/js/jquery-3.7.0.min.js"></script>
<!--<script type="text/javascript" src="<?=$url_base;?>public/ui/js/owl.carousel.js"></script>-->
<!-- propio -->
<script type="text/javascript" src="<?=$url_base;?>public/ui/js/app.js"></script>

<script type="application/javascript">
  $(document).ready(function () {
    console.log('Footer...');
    var url   = "<?=$url_base; ?>";

    ocultaProcesando();

    $('.verAvisoprivacidad').on('click', function(){
        $('#modalAvisoprivacidad').modal('show');
    });

    $('.verTerminosycondiciones').on('click', function(){
        $('#modalTerminosycondiciones').modal('show');
    });

    $('.btnLogout').on('click', function (e) {
      e.preventDefault();
      logout(url);
    });

  });

</script>

</body>
</html>
