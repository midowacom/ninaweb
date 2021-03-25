<div id="product_detail">
    <div class="container">
        <div class="prod__grid d-flex flex-wrap">
            <div class="prod__grid-left">
                <a id="Zoom-1" class="MagicZoom" data-options="zoomMode: on; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=THUMBS?>/product/630x680x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/630x680x1/assets/images/noimage.png';" src="<?=THUMBS?>/product/630x680x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
            </div>
            <div class="prod__grid-right">
                <div class="grid-wrap pl-60 pt-20">
                    <p class="title-prod"><?=$row_detail['ten'.$lang]?></p>
                    <p class="desc-prod text-uppercase"><?=thongtinchitietsanpham?></p>
                    <?php if(!empty($row_quanprice)){ ?>
                        <div class="prod-wrap mb-3">
                            <p class="prod-label text-uppercase"><?=dathangsoluonglon?>:</p>
                            <div class="prod-quanprice">
                                <?php foreach($row_quanprice as $item){ ?>
                                    <div class="quanprice-item">
                                        <span class="quanprice-value"><?=$func->format_money($item['gia'])?></span>
                                        <span class="quanprice-label"><?=$item["ten$lang"]?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(!empty($row_detail['id_mau'])){ ?>
                        <div class="prod-wrap  mb-3 choose-color">
                            <p class="prod-label">COLOR</p>
                            <div class="product-item__color-slide">
                                <?php 
                                $item_mau_arr = explode(',',$row_detail['id_mau']);
                                foreach($item_mau_arr as $id_mau){
                                    $_mau = Product::get_mau($id_mau);
                                    ?>
                                    <span>
                                        <div class="color_item" data-idmau="<?=$id_mau?>" data-idproduct="#product-item-<?=$row_detail['id']?>" style="background-color:#<?=$colors[$id_mau]["mau"]?>;"></div>
                                    </span>
                                <?php } ?>
                            </div>  
                        </div>
                    <?php } ?>

                    <?php if(!empty($row_detail['id_size'])){ ?>
                        <div class="prod-wrap mb-3 choose-size">
                            <p class="prod-label">SIZE</p>
                            <?=$func->get_size_slide(array('id_product' =>$row_detail['id'],'id_size' =>$row_detail['id_size']))?>
                        </div>
                    <?php } ?>

                  

                </div>
            </div>

        </div>

    </div>
    <div class="container">
        <div class="prod__grid d-flex flex-wrap">
         <div class="prod__grid-left d-none">
            <div class="w-100 pr-5 pt-4">
                <form action="" id="form_quick_cart">
                 <?php //include __DIR__."/product_detail/product_stastistic.php";?>
                
            </form>
        </div>
    </div>
    <div class="prod__grid-right w-100" style="background-color: #f5f5f5">
        <div class="grid-wrap pl-60 pt-20">
         <div class="prod-wrap  mb-3">
            <p class="prod-label"><?=chitietsanpham?></p>
            <div>
                <?=(isset($row_detail['mota'.$lang]) && $row_detail['mota'.$lang] != '') ? htmlspecialchars_decode($row_detail['mota'.$lang]) : ''?>
            </div>
        </div>

    </div>

</div>
</div>
</div>
<div class="container">
    <hr/>
    <h2 class="prod-h2"><?=sanphamcungloai?></h2>
    <div class="grid-wrap ">
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


</div>