<div class="container">
    <?=title_main((@$title_cat!='')?$title_cat:@$title_crumb)?>
    <div class="content-main w-clear">
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