<?php 
$chinhanh = $d->rawQuery("select ten$lang, photo, link,mota$lang from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('chi-nhanh'));
?>
<div class="multi-iframe">
  <ul class="multi-iframe-label" uk-switcher>
    <?php foreach($chinhanh as $stt => $it){ ?>
    <li><a href="#" class="inherit-text <?=$stt==0?'active':''?>"><?=$it["ten$lang"]?></a></li>
  <?php } ?>
  </ul>
  <ul class="uk-switcher multi-iframe-value">
     <?php foreach($chinhanh as $stt => $it){ ?>
    <li class="block-iframe"><?=htmlspecialchars_decode($it["mota$lang"])?></li>
  <?php } ?>
  </ul>
</div>