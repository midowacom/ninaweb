<?php
$css->setCache("cached");
$css->setCss("./assets/addons/swiper/swiper-bundle.min.css");
$css->setCss("./assets/addons/fancybox/jquery.fancybox.min.css");
$css->setCss("./assets/addons/mmenu/mmenu.css");
$css->setCss("./assets/addons/magiczoomplus/magiczoomplus.css");
$css->setCss("./assets/addons/fotorama/fotorama.css");
$css->setCss("./assets/addons/sweetalert2/sweetalert2.min.css");
$css->setCss("./assets/addons/simplyscroll/jquery.simplyscroll.css");
echo $css->getCss();
?>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/new-cart.css">
<!-- Js Google Analytic -->
<?=htmlspecialchars_decode($setting['analytics'])?>
<!-- Js Head -->
<?=htmlspecialchars_decode($setting['headjs'])?>