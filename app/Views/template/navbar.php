<header>
    <ul class="nav d-md-none">
        <li class="nav-item">
            <span class="nav-link show-nav-bar fs-5"><i class="fas fa-bars"></i></span>
        </li>
    </ul>
    <ul class="nav nav-fill d-none d-md-flex">
        <li class="nav-item">
            <!--<a class="nav-link" href="#">LOREM</a>-->
        </li>
        <li class="nav-item">
            <!--<a class="nav-link" href="#">LOREM</a>-->
        </li>
        <li class="nav-item">
            <!--<a class="nav-link" href="#">LOREM</a>-->
        </li>
        <li class="nav-item">
            <?php if ($token !=0) { ?>
            <a class="nav_link btn btn-outline-secondary btnLogout" href="#">Cerrar sesión</a>
            <?php } else { ?>
            <!--<a class="nav-link" href="#">LOREM</a>-->
            <?php }  ?>
        </li>
    </ul>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div class="nav_list">
                <span class="nav_link show-nav-bar"> <i class="fas fa-bars nav_icon"></i></span>
                <!--
        <a href="#" class="nav_link"> <span class="nav_name">LOREM</span> </a>
        <a href="#" class="nav_link"> <span class="nav_name">LOREM</span> </a>
        <a href="#" class="nav_link"> <span class="nav_name">LOREM</span> </a>
        -->
                <?php if ($token !=0) { ?>
                <a class="nav_link btn btn-outline-secondary btnLogout" href="#">Cerrar sesión</a>
                <?php } else { ?>
                <!--  <a href="#" class="nav_link"> <span class="nav_name">LOREM</span> </a>-->
                <?php }  ?>

            </div>
        </nav>
    </div>

    <?php if ($encuestacod!='admin') { ?>
    <div class="banner toggle-quit">
        <img src="<?=$url_base;?>/public/ui/images/<?=$encuestacod?>/banner.webp" alt="banner" />
    </div>
    <?php } ?>

</header>