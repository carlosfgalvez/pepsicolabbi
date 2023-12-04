<?php
  $time = str_replace('-','',str_replace(':','',str_replace(' ', '',date("Y-m-d H:i:s"))));
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <title> Labbi | PepsiCo</title>

  <!-- Open Graph Meta -->
  <meta property="og:title" content="Inicio">
  <meta property="og:site_name" content="PepsiCo - México">
  <meta property="og:type" content="webpage">
  <meta property="og:url" content="http://www.pepsico.com.mx/?gclid=CjwKCAjw15eqBhBZEiwAbDomEiIOuJA26EzZ9KwX8ThQiN_ZSFFVL2fiQMPOEJ9xKQNRzhWrnZg6kBoCmGgQAvD_BwE">
  <meta property="og:image" content="http://www.pepsico.com.mx/assets/images/logos/pepsico-og-image.png">
  <!-- /Open Graph Meta -->

  <!-- bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- css -->
  <link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/icons/bootstrap-icons.css" >
  <!--<link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/css/owl.carousel.css" >-->
  <!-- css propios-->
  <link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/css/global.css"/>
  <link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/css/navbar.min.css"/>

  <?php if ($encuestacod!=null) { ?> <!-- css particular de la vista -->
    <link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/css/<?=$encuestacod;?>.css"  />
  <?php } else { ?>
    <link rel="stylesheet" type="text/css" href="<?=$url_base;?>public/ui/css/style.css" />
  <?php } ?>

  <!-- favicon -->
  <link rel="shortcut icon" href="<?=$url_base;?>public/ui/images/favicon.ico" />
  <!--
  <link rel="icon" sizes="32x32" type="image/png" href="<?=$url_base;?>public/ui/icons/favicon-32.png" >
  <link rel="icon" sizes="16x16" type="image/png" href="<?=$url_base;?>public/ui/icons/favicon-16.png" >
  -->

</head>

<body class="text-center">
  <div id="loading-overlay"><div class="spinner-border text-primary"></div></div>
