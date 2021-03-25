<div class="mw wrap">
    <?=$func->title_main((@$title_cat!='')?$title_cat:@$title_crumb)?>
    <div class="grid-pro-detail w-clear">
        <div class="left-pro-detail w-clear">
            <a id="Zoom-1" class="MagicZoom" data-options="zoomMode: on; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
            <?php if($hinhanhsp) { if(count($hinhanhsp) > 0) { ?>
                <div class="gallery-thumb-pro">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach($hinhanhsp as $v) { ?>
                                <div class="swiper-slide">
                                    <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
                                        <img class="img-fluid" onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                    </a>
                                </div>

                            <?php } ?>
                        </div>

                    </div>
                </div>
            <?php } } ?>
        </div>
        <div class="right-pro-detail w-clear">
            <p class="title-pro-detail"><?=$row_detail['ten'.$lang]?></p>
            <div class="social-plugin social-plugin-pro-detail w-clear">
                <div class="addthis_inline_share_toolbox_qj48"></div>
                <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
            </div>
            <div class="desc-pro-detail"><?=(isset($row_detail['mota'.$lang]) && $row_detail['mota'.$lang] != '') ? htmlspecialchars_decode($row_detail['mota'.$lang]) : ''?></div>
            <ul class="attr-pro-detail">
                <li class="w-clear"> 
                    <label class="attr-label-pro-detail"><?=masp?>:</label>
                    <div class="attr-content-pro-detail"><?=(isset($row_detail['masp']) && $row_detail['masp'] != '') ? $row_detail['masp'] : 0?></div>
                </li>
                <?php if(isset($pro_brand['id']) && $pro_brand['id'] > 0) { ?>
                    <li class="w-clear">
                        <label class="attr-label-pro-detail"><?=thuonghieu?>:</label>
                        <div class="attr-content-pro-detail"><a class="text-decoration-none" href="<?=$pro_brand[$sluglang]?>" title="<?=$pro_brand['ten'.$lang]?>"><?=$pro_brand['ten'.$lang]?></a></div>
                    </li>
                <?php } ?>
                <li class="w-clear">
                    <label class="attr-label-pro-detail"><?=gia?>:</label>
                    <div class="attr-content-pro-detail">
                        <?php if($row_detail['giacu']) { ?>
                            <span class="price-new-pro-detail"><?=$func->format_money($row_detail['giacu'])?></span>
                            <span class="price-old-pro-detail"><?=$func->format_money($row_detail['gia'])?></span>
                        <?php } else { ?>
                            <span class="price-new-pro-detail"><?=($row_detail['gia']) ? $func->format_money($row_detail['gia']) : lienhe?></span>
                        <?php } ?>
                    </div>
                </li>

                <li class="w-clear"> 
                    <label class="attr-label-pro-detail"><?=luotxem?>:</label>
                    <div class="attr-content-pro-detail"><?=$row_detail['luotxem']?></div>
                </li>
                <?php include __DIR__."/product_cart.php";?>
            </ul>

        </div>

        <div class="clear"></div>

        <div class="tags-pro-detail w-clear">
            <?php if(isset($pro_tags) && count($pro_tags) > 0) { foreach($pro_tags as $v) { ?>
                <a class="transition text-decoration-none w-clear" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><i class="fas fa-tags"></i><?=$v['ten'.$lang]?></a>
            <?php } } ?>
        </div>

        <div class="clear"></div>

        <div class="tabs-pro-detail">
            <ul class="uk-tab" uk-switcher>
    <li><a href="#" class="inherit-text active"><?=thongtinsanpham?></a></li>
    <li><a href="#" class="inherit-text"><?=binhluan?></a></li>
  </ul>
  <ul class="uk-switcher">
    <li><?=(isset($row_detail['noidung'.$lang]) && $row_detail['noidung'.$lang] != '') ? htmlspecialchars_decode($row_detail['noidung'.$lang]) : ''?></li>
    <li><div class="fb-comments" data-href="<?=$func->getCurrentPageURL()?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div></li>
  </ul>

        </div>
    </div>

    <?=$func->title_main(sanphamcungloai)?>
    <div class="content-main gutters-10">
        <?php if(isset($product) && count($product) > 0) { ?>
            <?=$func->get_product_tpl($product)?>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                <strong><?=khongtimthayketqua?></strong>
            </div>
        <?php } ?>
        <div class="clear"></div>
        <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
    </div>
</div>