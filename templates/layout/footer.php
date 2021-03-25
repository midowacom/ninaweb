<div class="mdw-footer">
  <div class="mw wrap box-flex justify-content-between">
    <div class="ft-c-1">
      <div>
        <?=htmlspecialchars_decode($footer["noidung$lang"])?>
      </div>
    </div>
    <div class="ft-c-2">
      <h3>CHÍNH SÁCH MUA HÀNG</h3>
      <ul class="uk-list">
        <?php foreach($cs as $item){
        $sn_link = isset($item[$sluglang])?$item[$sluglang]:'';
        ?>
        <li>
          <a class="inherit-text" href="<?=$sn_link?>"><?=$item["ten$lang"]?></a>
        </li>
        <?php } ?>
      </ul>
    </div>
    <div class="ft-c-3">
      <h3>CÂU HỎI THƯỜNG GẶP</h3>
      <ul class="uk-list">
        <?php foreach($cauhoi as $item){
        $sn_link = isset($item[$sluglang])?$item[$sluglang]:'';
        ?>
        <li>
          <a class="inherit-text" href="<?=$sn_link?>"><?=$item["ten$lang"]?></a>
        </li>
        <?php } ?>
      </ul>
    </div>
    <div class="ft-c-4">
      <?php echo $addons->setAddons('fanpage-facebook','fanpage-facebook', 10);?>
    </div>
  </div>
</div>
<div class="mdw-copyright">
  <div class="mw wrap box-flex align-items-center justify-content-between">
    <span class="mdw-copyright__left">2021 Copyright <a><?=$setting["ten$lang"]?></a>. Design by <a>Nina.vn</a></span>
    <span class="mdw-copyright__right">
      <span><?=dangonline?>: <?=$online?></span><span class="mx-2">|</span>
      <span><?=trongtuan?>: <?=$counter['week']?></span><span class="mx-2">|</span>
      <span><?=tongtruycap?>: <?=$counter['total']?></span>
    </span>
  </div>
</div>

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