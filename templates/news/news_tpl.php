<div class="mw uk-margin">
   <?=$func->title_main((@$title_cat!='')?$title_cat:@$title_crumb)?>
   <div class="row">
    <?php if(count($news)>0) { 
        foreach($news as $item) { ?>
            <div class="col-3">
             <div class="index-news-item <?=in_array($com, array('tin-tuc'))?'tintuc':'dichvu'?>-item default-hover mb-3">
                <div class="image">
                    <a class="text-decoration-none" href="<?=$item[$sluglang]?>" title="<?=$item['ten'.$lang]?>">
                        <img onerror="this.src='<?=THUMBS?>/275x220x1/assets/images/noimage.png';" src="<?=THUMBS?>/275x220x1/<?=UPLOAD_NEWS_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" class="img-fluid w-100">
                    </a>
                    <div class="time-news">
                        <div class="time-news-wrap">
                            <span class="date-ngay">
                                <span><?=date("d",$item['ngaytao'])?></span>
                            </span>
                            <span class="date-thang">
                                <span>thg <?=date("m",$item['ngaytao'])?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <h3 class="title-news"><a class="text-decoration-none inherit-text" href="<?=$item[$sluglang]?>" title="<?=$item['ten'.$lang]?>"><?=$item['ten'.$lang]?></a></h3>
                    <div class="desc-news line-limit to-3"><?=$item['mota'.$lang]?></div>
                </div>
            </div>
        </div>
    <?php } } else { ?>
        <div class="alert alert-warning" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
</div>
<div class="clear"></div>
<div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
</div>