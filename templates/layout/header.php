<div id="topbar">
    <div class="mw wrap d-flex justify-content-between">
        <div class="topbar-left"></div>
        <div class="topbar-right">
           <span class="mxh_top"><?=$func->get_mxh($social,30,30)?></span>
       </div>
   </div>
</div>
<div id="header">
    <div class="mw wrap">
        <div id="logo">
            <a href="index.php">
                <img onerror="this.src='<?=THUMBS?>/150x100x1/assets/images/default/noimage.png';" src="<?=THUMBS?>/150x100x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>" class="img-fluid"/>
            </a>
        </div>
        <a href="#menu_repsonsive" class="text-decoration-none menu_repsonsive">
            <span class="icon bar"></span>
        </a>
        <div id="menu">
            <div class="mw">
                <ul class="menu-ul">
                 <li class="menu <?php if($com=='about-us') echo 'active';?>">
                    <a href="about-us" class="inherit-text menu-a" title="About Us">
                     <span>About Us</span>
                 </a>
             </li>
             <?php if(!empty($index_product_list_menu)){ ?>
                <?php foreach($index_product_list_menu as $list){
                    $index_dichvu_cat_item= $d->rawQuery("select tenkhongdauvi,ten$lang,id,photo from #_product_cat where id_list = ? and hienthi=1  order by stt asc ",array($list['id']));
                    ?>
                    <li class="menu <?php if($com=='san-pham' && $idl == $list[$sluglang]) echo 'active';?>">
                        <a href="<?=$list[$sluglang]?>" class="inherit-text menu-a" title="<?=$list["ten$lang"]?>">
                            <span><?=$list["ten$lang"]?></span>
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
        <?php } ?>              



        <li class="menu <?php if($com=='gallery') echo 'active';?>">
            <a href="gallery" class="inherit-text menu-a" title="Gallery">
                <span>Gallery</span>
            </a>
        </li>
        <li class="menu <?php if($com=='contact') echo 'active';?>">
            <a href="contact" class="inherit-text menu-a" title="Contact">
                <span>Contact</span>
            </a>
        </li>
    </ul>
</div>
</div>
</div>



<div id="menu_repsonsive">
    <ul>
                 <li>
                    <a href="about-us" title="About Us">
                     <span>About Us</span>
                 </a>
             </li>
             <?php if(!empty($index_product_list_menu)){ ?>
                <?php foreach($index_product_list_menu as $list){
                    $index_dichvu_cat_item= $d->rawQuery("select tenkhongdauvi,ten$lang,id,photo from #_product_cat where id_list = ? and hienthi=1  order by stt asc ",array($list['id']));
                    ?>
                    <li>
                        <a href="<?=$list[$sluglang]?>" title="<?=$list["ten$lang"]?>">
                            <span><?=$list["ten$lang"]?></span>
                        </a>
                        <?php if(!empty($index_dichvu_cat_item)){ ?>
                            <ul>
                                <?php foreach($index_dichvu_cat_item as $item){
                                   ?>
                                   <li >
                                    <a href="<?=$item[$sluglang]?>" class="inherit-text" title="<?=$item["ten$lang"]?>">
                                        <span><?=$item["ten$lang"]?></span>
                                    </a>

                                    
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?> 
        <?php } ?>              
        

        
        <li >
            <a href="gallery" >
                <span>Gallery</span>
            </a>
        </li>
        <li>
            <a href="contact" class="inherit-text menu-a" title="Contact">
                <span>Contact</span>
            </a>
        </li>
    </ul>
</div>
</div>