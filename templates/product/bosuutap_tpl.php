<div class="container">
<?php 
$index_product_collection = $d->rawQuery("select * from #_product_brand where type = ? and hienthi > 0 and noibat > 0 order by stt,id desc",array('san-pham'));
if(count($index_product_collection)){ ?>
	<div id="index-slider-collection">
		<?=title_main((@$title_cat!='')?$title_cat:@$title_crumb)?>
		<div class="wrap-collection gutters-20">
				<div class="row">
					<?php foreach($index_product_collection as $item){ ?>
						<div class="col-3">
							<div class="collection-item text-decoration-none text-center d-flex d-hover flex-wrap">
								<div class="image hieuung w-100">
									<a title="<?=$item['ten'.$lang]?>" href="<?=$item[$sluglang]?>">
										<img class="img-fluid w-100" onerror="this.src='<?=THUMBS?>/460x410x2/assets/images/default/noimage.png';" src="<?=THUMBS?>/460x410x1/<?=UPLOAD_PRODUCT_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>">
									</a>
								</div>
								<div class="detail">
									<h3 class="h3-title line-limit to-1">
										<a href="<?=$item[$sluglang]?>" class="inherit-text"  title="<?=$item['ten'.$lang]?>"><?=$item['ten'.$lang]?></a>
									</h3>
									<a href="<?=$item[$sluglang]?>" class="xemthem">XEM THÊM</a>
								</div>
							</div>
						</div>
					<?php } ?>
			</div>
		</div>
	</div>
</div>	
	<?php
	$js_container[] = 
<<<JS_PARTNER
	if($("#index-slider-collection").exists()){
		var index_slider_collection_options = {slidesPerView: 3, spaceBetween: 0, loop:false, pagination: {el: '#index-slider-collection .swiper-pagination', clickable: true, }, navigation: {nextEl: '#index-slider-collection .swiper-button-next', prevEl: '#index-slider-collection .swiper-button-prev', }, autoplay: {delay: 2500, disableOnInteraction: false, }, }; var index_cungcap_slider = new Swiper("#index-slider-collection .swiper-container",index_slider_collection_options); }; 
JS_PARTNER;
	} ?>
