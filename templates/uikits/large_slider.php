<?php
$width=1366;//1440 - 17px
$height =480;
$sliderzc = 1;
$slider_indicators = false;
$slider_pagination = false;
$slider_thumb =$width.'x'.$height.'x'.$sliderzc;
$slider = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide'));
if(!empty($slider)){  ?>
	<div uk-slider="autoplay: true,autoplay-interval: 3000,pause-on-hover: true">
		<div class="uk-slider-container uk-position-relative">
			<ul class="uk-slider-items uk-child-width  uk-visible-toggle uk-dark" >
				<?php foreach($slider as $stt => $item){ ?>
					<li>
						<a href="<?=$item['link']?>" target="_blank" title="<?=$item['ten'.$lang]?>">
							<img onerror="this.src='<?=THUMBS?>/<?=$slider_thumb?>/assets/images/default/noimage.png';" data-src="<?=THUMBS?>/<?=$slider_thumb?>/<?=UPLOAD_PHOTO_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" title="<?=$item['ten'.$lang]?>" class="img-fluid w-100" width="<?=$width?>" height="<?=$height?>" uk-img/>
						</a>
					</li>
				<?php } ?>
			</ul>
			<a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
			<a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
		</div>
	</div>
	<?php } ?>