<?php
$id = $_GET['id'];
$row_detail = $d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1",array($id));

?>
<div class="wrap-user col-lg-5 col-md-6 col-sm-8 col-11 p-0">
    <div class="title-user">
        <span><?=kichhoat?></span>
    </div>
    <?php if(!empty($row_detail['maxacnhan'])){ ?>
        <form class="form-user validation-user" novalidate method="post" action="account/kich-hoat?id=<?=$id?>" enctype="multipart/form-data">
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-qrcode"></i></div>
                </div>
                <input type="text" class="form-control" id="maxacnhan" name="maxacnhan" placeholder="<?=nhapmakichhoat?>" required>
                <div class="invalid-feedback"><?=vuilongnhapmakichhoat?></div>
            </div>
            <div class="button-user">
                <input type="submit" class="btn btn-primary" name="kichhoat" value="<?=kichhoat?>" disabled>
            </div>
        </form>
    <?php }else{ ?>
    <div class="w-100">
        <p class="card-info"><?=dakichhoat?></p>
    </div>
        <?php } ?>s
</div>