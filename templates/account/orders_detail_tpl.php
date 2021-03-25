<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <?php include __DIR__."/layout/menu_info.php";?>
        </div>
        <div class="col-lg-9">
            <div class="wrap-user">
                <div class="title-user">
                    <span><?=$title_crumb?></span>
                </div>
                <div class="content">
                 <div class="table-wrapper-responsive">
                    <div class="content-table ">
                        <div class="row-order-item header">
                            <span class="stt">STT</span>
                            <span class="hinhanh"><?=hinhanh?></span>
                            <span class="title"><?=tensanpham?></span>
                            <span class="price"><?=gia?></span>
                            <span class="quantity"><?=soluong?></span>
                        </div>
                        <?php foreach($orders_detail as $stt =>  $order){
                            $item = Product::get_info($order["id_product"]);
                            if(empty($item)) continue;
                            ?>
                            <div class="row-order-item">
                                <span class="stt"><?=$stt+1?></span>
                                <span class="hinhanh"><img onerror="this.src='<?=THUMBS?>/45x45x1/assets/images/default/noimage.png';" src="<?=THUMBS?>/45x45x1/<?=UPLOAD_PRODUCT_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>" class="img-fluid w-100"></span>
                                <span class="title"><?=$item["ten$lang"]?></span>
                                <span class="price text-danger font-weight-bold"><?=$func->format_money($order['gia'])?></span>
                                <span class="quantity"><?=$order["soluong"]?></span>
                            </div>
                        <?php } ?>
                        <div class="row-order-item">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span><?=phiship?></span>
                            <span><?=$func->format_money($orders["phiship"])?></span>
                        </div>
                        <div class="row-order-item">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span><?=tamtinh?></span>
                            <span><?=$func->format_money($orders["tamtinh"])?></span>
                        </div>

                        <div class="row-order-item">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span><?=chietkhau?></span>
                            <span><?=$info_member_group["chietkhau"]?>%</span>
                        </div>

                        <div class="row-order-item">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span><?=tonggia?></span>
                            <span class="text-danger font-weight-bold"><?=$func->format_money($orders["tonggia"])?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right my-4">
            <a href="account/lich-su-mua-hang" class="btn btn-secondary">OK</a>
        </div>
    </div>
</div>
</div>