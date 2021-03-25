<div class="vertical-menu">
            <div class="menu">
                <img src="assets/images/mm.jpg" class="mr-3">
            DANH MỤC DỊCH VỤ
            <?php if(!empty($index_dichvu_menu)){ ?>
            <ul class="vertical-menu-content sub-nav-ul">
                <?php foreach($index_dichvu_menu as $list){

                   $index_dichvu_cat_item= $d->rawQuery("select tenkhongdauvi,ten$lang,id,photo from #_product_icat where id_list = ? and hienthi=1  order by stt asc ",array($list['id']));
                   ?>
                   <li class="menu">
                    <a href="<?=$list[$sluglang]?>" class="inherit-text" title="<?=$list["ten$lang"]?>">
                        <span class="mmtt"><?=$list["ten$lang"]?></span>
                    </a>
                    <?php if(!empty($index_dichvu_cat_item)){ ?>
                        <ul class="vertical-menu-content sub-nav-ul">
                            <?php foreach($index_dichvu_cat_item as $item){
                               ?>
                               <li class="menu">
                                <a href="<?=$item[$sluglang]?>" class="inherit-text" title="<?=$item["ten$lang"]?>">
                                    <span class="mmtt"><?=$item["ten$lang"]?></span>
                                </a>

                                
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>

            </li>
        <?php } ?>
    </ul>
<?php } ?>
        </div>
        </div>