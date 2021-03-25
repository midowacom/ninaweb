<!DOCTYPE html>
<html lang="<?=$config['website']['lang-doc']?>">
<head>
  <?php include TEMPLATE.LAYOUT."head.php"; ?>
  <?php include TEMPLATE.LAYOUT."css.php"; ?>
</head>
<body <?php echo "class='page-".str_replace(array('/','\\'), '-', $template)."'"; ?>> 
  <div id="body-wrapper" class="<?=$com?>">
    <?php 
    include TEMPLATE.LAYOUT."seo.php";
    //Header
    include TEMPLATE.LAYOUT."header.php";
    if($source =='index'){
      include TEMPLATE."uikits/large_slider.php";
    }else{ 
      include TEMPLATE.LAYOUT."breadcrumb.php";
    }

    ?>
    <?php include TEMPLATE.$template."_tpl.php";?>
    <?php
    include TEMPLATE.LAYOUT."footer.php";
    include TEMPLATE.LAYOUT."js.php";
    include TEMPLATE.LAYOUT."modal.php";
        // if($deviceType=='mobile') include TEMPLATE.LAYOUT."phone.php";
    ?>
  </div>
</body>
</html>