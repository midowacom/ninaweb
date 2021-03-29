<div class="mw wrap">
    <?=$func->title_main((@$title_cat!='')?$title_cat:@$title_crumb)?>
    <div class="product-list-desc mbb text-center">
        <?=htmlspecialchars_decode($pro_list["mota$lang"])?>
    </div>
    <div class="content-main w-clear">
        <?php if(isset($product) && count($product) > 0) { ?>
                <?=$func->get_product_tpl($product,$com)?>
        <?php } else { ?>
            <div class="uk-alert-warning uk-margin uk-panel" uk-alert>
                <div><?=khongtimthayketqua?></div>
            </div>
        <?php } ?>
        <div class="clear"></div>
        <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
    </div>
</div>