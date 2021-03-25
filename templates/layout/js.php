<!-- Js Config -->
<script type="text/javascript">
  var NN_FRAMEWORK = NN_FRAMEWORK || {};
  var CONFIG_BASE = '<?=$config_base?>';
  var WEBSITE_NAME = '<?=(isset($setting['ten'.$lang]) && $setting['ten'.$lang] != '') ? addslashes($setting['ten'.$lang]) : ''?>';
  var TIMENOW = '<?=date("d/m/Y",time())?>';
  var SHIP_CART = <?=(isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false'?>;
  var GOTOP = 'assets/images/top.png';
  var website_com = '<?=$com?>';
  var LANG = {
    'no_keywords': '<?=chuanhaptukhoatimkiem?>',
    'delete_product_from_cart': '<?=banmuonxoasanphamnay?>',
    'no_products_in_cart': '<?=khongtontaisanphamtronggiohang?>',
    'wards': '<?=phuongxa?>',
    'back_to_home': '<?=vetrangchu?>',
  };
</script>

<!-- Js Files -->
<?php
$js->setCache("cached");
$js->setJs("./assets/js/jquery-3.5.1.min.js");
$js->setJs("./assets/addons/swiper/swiper-bundle.min.js");
$js->setJs("./assets/addons/mmenu/mmenu.js");
$js->setJs("./assets/addons/fotorama/fotorama.js");
$js->setJs("./assets/addons/simplyscroll/jquery.simplyscroll.js");
$js->setJs("./assets/addons/magiczoomplus/magiczoomplus.js");
$js->setJs("./assets/addons/fancybox/jquery.fancybox.min.js");
echo $js->getJs();
?>
<script src="assets/addons/uikit/js/uikit.min.js"></script>
<script src="assets/addons/uikit/js/uikit-icons.min.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/cart.js"></script>
<script src="assets/js/apps.js"></script>


<?php if(isset($config['googleAPI']['recaptcha']['active']) && $config['googleAPI']['recaptcha']['active'] == true) { ?>
  <!-- Js Google Recaptcha V3 -->
  <script src="https://www.google.com/recaptcha/api.js?render=<?=$config['googleAPI']['recaptcha']['sitekey']?>"></script>
  <script type="text/javascript">
    grecaptcha.ready(function () {
      grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'Newsletter' }).then(function (token) {
        var recaptchaResponseNewsletter = document.getElementById('recaptchaResponseNewsletter');
        recaptchaResponseNewsletter.value = token;
      });
      <?php if($source=='contact') { ?>
        grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'contact' }).then(function (token) {
          var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
          recaptchaResponseContact.value = token;
        });
      <?php } ?>
    });
  </script>
<?php } ?>

<?php if(isset($config['oneSignal']['active']) && $config['oneSignal']['active'] == true) { ?>
  <!-- Js OneSignal -->
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script type="text/javascript">
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        appId: "<?=$config['oneSignal']['id']?>"
      });
    });
  </script>
<?php } ?>
<!-- Js Structdata -->
<?php include TEMPLATE.LAYOUT."strucdata.php"; ?>
<!-- Js Addons -->
<?=$addons->setAddons('script-main', 'script-main', 0.5);?>
<?=$addons->getAddons();?>
<!-- Js Body -->
<?=htmlspecialchars_decode($setting['bodyjs'])?>
<?php include TEMPLATE.LAYOUT."strucdata.php"; ?>
<div class="right_fix">
    <?php  echo $addons->setAddons('cart-fixed', 'cart-fixed', 10);?>
    <?php  echo $addons->setAddons('zalo-fixed', 'zalo-fixed', 10);?>
    <?php  echo $addons->setAddons('facebook-fixed', 'facebook-fixed', 10);?>
    <?php  echo $addons->setAddons('phone-fixed', 'phone-fixed', 10);?>   
</div>