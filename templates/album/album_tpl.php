<div class="mw wrap">
    <?=$func->title_main((@$title_cat!='')?$title_cat:@$title_crumb)?>
    <div class="row">
    <?php if(count($product)>0) { for($i=0;$i<count($product);$i++) { ?>
        <div class="col-lg-3 col-md-4 col-6">
            <div class="product-item default-hover">
                <div class="image">
                    <a class="album text-decoration-none" data-fancybox="images" href="<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" title="<?=$product[$i]['ten'.$lang]?>">
                        <img onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="<?=THUMBS?>/480x360x1/<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/>
                    </a>
                    </div>
                    <div class="detail">
                        <h3 class="name-album text-split"><a class="inherit-text text-decoration-none" data-fancybox="images" href="<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" title="<?=$product[$i]['ten'.$lang]?>"><?=$product[$i]['ten'.$lang]?></a></h3>
                    </div>
                </a>
            </div>
        </div>
    <?php } } else { ?>
        <div class="alert alert-warning" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
    </div>
    <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
</div>