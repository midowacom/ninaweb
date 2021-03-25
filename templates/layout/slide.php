<?php
$width=1366;//1440 - 17px
$height =480;
$sliderzc = 1;
$slider_indicators = false;
$slider_pagination = false;
$slider_thumb =$width.'x'.$height.'x'.$sliderzc;

$slider = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide'));

$slider_quangcao = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide_quangcao'));
if(!empty($slider)){
  ?>
    <div id="sliderindex">
      <div class="swiper-container">
        <div class="swiper-wrapper">
         <?php foreach($slider as $stt => $item){ ?>
           <div class="swiper-slide">
             <a href="<?=$item['link']?>" target="_blank" title="<?=$item['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/<?=$slider_thumb?>/assets/images/default/noimage.png';" src="<?=THUMBS?>/<?=$slider_thumb?>/<?=UPLOAD_PHOTO_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" title="<?=$item['ten'.$lang]?>" class="img-fluid w-100"/></a>
           </div>
         <?php } ?>
       </div>
       <!-- Add Arrows -->
       <?php if($slider_pagination){ ?>
        <div class="swiper-pagination"></div>
      <?php } ?>
      <?php if($slider_indicators){ ?>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      <?php } ?>
    </div>
  </div>
 
<?php } ?>
