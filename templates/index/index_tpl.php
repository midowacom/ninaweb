<div class="mw">
	<div id="index-tieuchi">
		<div id="slider-index-tieuchi">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach($index_news_tieuchi as $stt => $item){ ?>
						<div class="swiper-slide">
							<a href="<?=$item[$sluglang]?>" class="row-item box-flex tieuchi default-hover text-decoration-none align-items-center">
								<div class="image">
									<img onerror="this.src='<?=THUMBS?>/60x60x1/assets/images/noimage.png';" src="<?=THUMBS?>/60x60x1/<?=UPLOAD_NEWS_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" class="img-fluid">
								</div>
								<div class="detail">
									<h3 class="title"><?=$item['ten'.$lang]?></h3>
									<div class="mota line-limit to-2">
										<?=$item['mota'.$lang]?>
									</div>
								</div>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="product-moi">
	<?=$func->title_main("SẢN PHẨM MỚI")?>
	<div class="mw wrap">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach($index_product_moi as $stt => $item){ ?>
					<div class="swiper-slide">
						<?=$func->get_product_item($item)?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php
$slider_quangcao = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide_quangcao'));
if(!empty($slider_quangcao)){
	?>
	<div id="sliderindex_quangcao">
		<div class="mw">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach($slider_quangcao as $stt => $item){ ?>
						<div class="swiper-slide">
							<a href="<?=$item['link']?>" target="_blank" title="<?=$item['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/630x250x1/assets/images/default/noimage.png';" src="<?=THUMBS?>/630x250x2/<?=UPLOAD_PHOTO_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" title="<?=$item['ten'.$lang]?>" class="img-fluid w-100"/></a>
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
	</div>

<?php } ?>


<div id="product-banchay">
	<?=$func->title_main("SẢN PHẨM BÁN CHẠY")?>
	<div class="mw wrap">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach($index_product_banchay as $stt => $item){ ?>
					<div class="swiper-slide">
						<?=$func->get_product_item($item)?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php if($index_product_sanpham_list){ ?>
	<div id="mdw-product-list">
		<?php foreach($index_product_sanpham_list as $stl => $list):
			$pidc = $d->rawQuery("select * from #_product_cat where id_list = ? and hienthi=1 and type= ? order by stt asc ",array($list['id'],'san-pham'));
			$pid_count = $d->rawQueryOne("select count(id) as c from #_product where id_list = ? and hienthi=1 and type= ? and id_cat > 0 order by stt asc ",array($list['id'],'san-pham'));
			if($pid_count['c'] > 0){ 
				?>
				<div class="block-product-list" id="idl-<?=$list[$sluglang]?>">
					<?=$func->title_main($list["ten$lang"])?>
					<div class="__content">
						<ul class="uk-tab-label" uk-switcher>
							<?php foreach($pidc as $stc => $cat): ?>
								<li><a href="#" class="inherit-text <?=$stc==0?'active':''?>"><?=$cat["ten$lang"]?></a></li>
							<?php endforeach; ?>
						</ul>
						<ul class="uk-switcher multi-iframe-value">
							<?php foreach($pidc as $stc => $cat):
								$product = $d->rawQuery("select * from #_product where id_list = ? and id_cat=? and  hienthi=1 and noibat=1 and type= ? order by stt asc ",array($list['id'],$cat['id'],'san-pham'));
								?>
								<li class="mw wrap gutters-10">
									<?=$func->get_product_tpl($product,'san-pham')?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="xemthem text-center">
						<a href="<?=$list[$sluglang]?>" class="btn-xemthem">Xem thêm</a>
					</div>
				</div>
			<?php } ?>
		<?php endforeach; ?>
	</div>
<?php } ?>

<?php if($quangcao){ ?>
	<div id="quangcao">
		<div class="container">
			<a href="<?=$quangcao["link"]?>" target="_blank">
				<img onerror="this.src='<?=THUMBS?>/1300x450x1/assets/images/default/noimage.png';" src="<?=THUMBS?>/1300x450x1/<?=UPLOAD_PHOTO_L.$quangcao['photo']?>" class="img-fluid w-100"/>
			</a>
		</div>
	</div>
<?php } ?>
<div id="mdw-minibox">
	<div class="mw wrap">
		<div class="row">
			<div class="col-lg-6 col-12">
				<h2 class="minibox-title">TIN TỨC MỚI NHẤT</h2>
				<div class="scroller-wrap newshome-scroll">
					<ul>
						<li>
							<?php foreach($index_news_tintuc as $stt => $item){ ?>
								<div class="row-item minibox-news-item default-hover">
									<div class="box-flex">
										<div class="image">
											<a class="inherit-text" href="<?=$item[$sluglang]?>" title="<?=$item['ten'.$lang]?>">
												<img onerror="this.src='<?=THUMBS?>/230x135x1/assets/images/noimage.png';" src="<?=THUMBS?>/230x135x2/<?=UPLOAD_NEWS_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" class="img-fluid">
											</a>
										</div>
										<div class="detail">
											<div class="title-wrap">
												<h3 class="title uk-h3 line-limit to-2"><a class="inherit-text" href="<?=$item[$sluglang]?>" title="<?=$item['ten'.$lang]?>"><?=$item['ten'.$lang]?></a>	</h3>										</div>
												<div class="desc line-limit to-2"><?=$item['mota'.$lang]?></div>
												<a class="xemthem">[Xem thêm]</a>
											</div>
										</div>
									</div>
								<?php } ?>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<h2 class="minibox-title">VIDEO CLIP</h2>
					<div>
						<?php echo $addons->setAddons('video-fotorama','video-fotorama', 10);?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="mdw-newsletter">
		<div class="mw wrap">
			<?=$func->title_main("ĐĂNG KÝ ĐỂ NHẬN KHUYẾN MÃI","Đăng ký ngay để nhận thông tin khuyến mãi mới nhất !")?>
			<div class="desc uk-margin text-center"></div>
			<form class="form-newsletter validation-newsletter d-form" method="post" action="newsletter" enctype="multipart/form-data" id="index-newsletter">
				<div>
					<input type="email" id="email-newsletter" name="email-newsletter" placeholder="Email" required />
					<input type="submit" name="submit-newsletter" class="submit-newsletter" value="ĐĂNG KÝ NGAY" >
					<input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
				</div>
			</form>
		</div>
	</div>