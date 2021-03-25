 <?php if(!empty($splistmenu)){ ?>
    <div class="vertical-menu-content vertical-menu">
        <h2 class="text-center">DANH MỤC SẢN PHẨM</h2>
        <ul class="vertical-menu-items">
            <?php foreach($splistmenu as $list){ ?>
                <li class="menu-v  <?php if($com=='dich-vu' && $_GET['idl'] == $list["tenkhongdauvi"]) echo 'active'; ?>">
                    <a href="<?=$list[$sluglang]?>" class="inherit-text" title="<?=$list["ten$lang"]?>">
                        <img onerror="this.src='<?=THUMBS?>/40x40x1/assets/images/default/noimage.png';" src="<?=UPLOAD_PRODUCT_L.$list['photo']?>" class="img-fluid"/>
                        <span class="mmtt"><?=$list["ten$lang"]?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>