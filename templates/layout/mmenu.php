<div class="menu-res">
    <div class="menu-bar-res">
        <a id="hamburger" href="#menu" title="Menu"><span></span></a>
        <div class="search-res">
            <p class="icon-search transition"><i class="fa fa-search"></i></p>
            <div class="search-grid w-clear">
                <input type="text" name="keyword2" id="keyword2" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword2');"/>
                <p onclick="onSearch('keyword2');"><i class="fa fa-search"></i></p>
            </div>
        </div>
    </div>
    <nav id="menu">
        <ul>
            <li><a class="transition <?php if($com=='' || $com=='index') echo 'active'; ?>" href="" title="<?=trangchu?>"><span><?=trangchu?></span></a></li>

        <li><a class="transition <?php if($com=='gioi-thieu') echo 'active'; ?>" href="gioi-thieu" title="<?=gioithieu?>"><span><?=gioithieu?></span></a></li>
        
        <li>
            <a class="transition <?php if($com=='san-pham') echo 'active'; ?>" href="san-pham" title="<?=sanpham?>"><span><?=sanpham?></span></a>
            <?php if(count($splistmenu)) { ?>
                <ul>
                    <?php for($i=0;$i<count($splistmenu); $i++) {
                        $spcatmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($splistmenu[$i]['id'])); ?>
                        <li>
                            <a class="transition" title="<?=$splistmenu[$i]['ten'.$lang]?>" href="<?=$splistmenu[$i][$sluglang]?>"><span><?=$splistmenu[$i]['ten'.$lang]?></span></a>
                            <?php if(count($spcatmenu)>0) { ?>
                                <ul>
                                    <?php for($j=0;$j<count($spcatmenu);$j++) {
                                        $spitemmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_item where id_cat = ? and hienthi > 0 order by stt,id desc",array($spcatmenu[$j]['id'])); ?>
                                        <li>
                                            <a class="transition" title="<?=$spcatmenu[$j]['ten'.$lang]?>" href="<?=$spcatmenu[$j][$sluglang]?>"><span><?=$spcatmenu[$j]['ten'.$lang]?></span></a>
                                            <?php if(count($spitemmenu)) { ?>
                                                <ul>
                                                    <?php for($u=0;$u<count($spitemmenu);$u++) {
                                                        $spsubmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_sub where id_item = ? and hienthi > 0 order by stt,id desc",array($spitemmenu[$u]['id'])); ?>
                                                        <li>
                                                            <a class="transition" title="<?=$spitemmenu[$u]['ten'.$lang]?>" href="<?=$spitemmenu[$u][$sluglang]?>"><span><?=$spitemmenu[$u]['ten'.$lang]?></span></a>
                                                            <?php if(count($spsubmenu)) { ?>
                                                                <ul>
                                                                    <?php for($s=0;$s<count($spsubmenu);$s++) { ?>
                                                                        <li>
                                                                            <a class="transition" title="<?=$spsubmenu[$s]['ten'.$lang]?>" href="<?=$spsubmenu[$s][$sluglang]?>"><span><?=$spsubmenu[$s]['ten'.$lang]?></span></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
        
        <li><a class="transition <?php if($com=='dich-vu') echo 'active'; ?>" href="dich-vu" title="<?=dichvu?>"><span><?=dichvu?></span></a></li>
        

        <li>
            <a class="transition <?php if($com=='tin-tuc') echo 'active'; ?>" href="tin-tuc" title="<?=tintuc?>"><span>TIN TỨC & SỰ KIỆN</span></a>
            <?php if(count($ttlistmenu)) { ?>
                <ul>
                    <?php for($i=0;$i<count($ttlistmenu); $i++) {
                        $ttcatmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($ttlistmenu[$i]['id'])); ?>
                        <li>
                            <a class="transition" title="<?=$ttlistmenu[$i]['ten'.$lang]?>" href="<?=$ttlistmenu[$i][$sluglang]?>"><span><?=$ttlistmenu[$i]['ten'.$lang]?></span></a>
                            <?php if(count($ttcatmenu)>0) { ?>
                                <ul>
                                    <?php for($j=0;$j<count($ttcatmenu);$j++) {
                                        $ttitemmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_item where id_cat = ? and hienthi > 0 order by stt,id desc",array($ttcatmenu[$j]['id'])); ?>
                                        <li>
                                            <a class="transition" title="<?=$ttcatmenu[$j]['ten'.$lang]?>" href="<?=$ttcatmenu[$j][$sluglang]?>"><span><?=$ttcatmenu[$j]['ten'.$lang]?></span></a>
                                            <?php if(count($ttitemmenu)) { ?>
                                                <ul>
                                                    <?php for($u=0;$u<count($ttitemmenu);$u++) {
                                                        $ttsubmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_sub where id_item = ? and hienthi > 0 order by stt,id desc",array($ttitemmenu[$u]['id'])); ?>
                                                        <li>
                                                            <a class="transition" title="<?=$ttitemmenu[$u]['ten'.$lang]?>" href="<?=$ttitemmenu[$u][$sluglang]?>"><span><?=$ttitemmenu[$u]['ten'.$lang]?></span></a>
                                                            <?php if(count($ttsubmenu)) { ?>
                                                                <ul>
                                                                    <?php for($s=0;$s<count($ttsubmenu);$s++) { ?>
                                                                        <li>
                                                                            <a class="transition" title="<?=$ttsubmenu[$s]['ten'.$lang]?>" href="<?=$ttsubmenu[$s][$sluglang]?>"><span><?=$ttsubmenu[$s]['ten'.$lang]?></span></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
        
        <li><a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he" title="<?=lienhe?>"><span><?=lienhe?></span></a></li>
        </ul>
    </nav>
</div>