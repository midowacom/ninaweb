<?php
$bg = array('text-warning','text-primary','text-danger','text-success','text-danger');

?>
<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include __DIR__."/layout/menu_info.php";?>
        </div>
        <div class="col-9">
            <div class="wrap-user">
                <div class="title-user">
                    <span>Lịch sử mua hàng</span>
                </div>
                <div class="table-wrapper-responsive">
                    <div class="content-table ">
                     <div class="row-order-item header">
                        <span class="stt">STT</span>
                        <span class="madonhang"><?=madonhang?></span>
                        <span class="ngaydat"><?=ngaydat?></span>
                        <span class="ngaydat"><?=tonggia?></span>
                        <span class="tinhtrang"><?=tinhtrang?></span>
                        <span class="action"></span>
                    </div>
                    <?php foreach($orders as $stt =>  $order){ ?>
                        <div class="row-order-item">
                            <span class="stt"><?=$stt+1?></span>
                            <span class="madonhang"><a href="<?=$func->getCurrentPageURL()?>/<?=$order["madonhang"]?>"><?=$order["madonhang"]?></a></span>
                            <span class="ngaydat"><?=date("h:i:s A - d/m/Y", $order['ngaytao'])?></span>
                            <span class="tonggia text-danger txt bold"><?=$func->format_money($order['tonggia'])?></span>
                            <?php
                            if(isset($order['tinhtrang']) && $order['tinhtrang'] > 0)
                            {
                                $id_tinhtrang = $order['tinhtrang'];
                                $tinhtrang = $d->rawQueryOne("select trangthai from #_status where id = ?",array($id_tinhtrang));
                            }
                            ?>
                            <span class="tinhtrang tt <?=$bg[$order['tinhtrang']]?>"><?=$tinhtrang['trangthai']?></span>
                            <span class="action">
                                <a href="<?=$func->getCurrentPageURL()?>/<?=$order["madonhang"]?>" class="btn btn-sm btn-outline-secondary"><?=Svg::list_ol()?></a>
                                <a data-href="<?=$order["madonhang"]?>" class="d-inline-block btn btn-sm btn-outline-secondary user_delete_order"><?=Svg::cancel_fill()?></a>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>