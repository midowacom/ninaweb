<?php
    if(!defined('SOURCES')) die("Error");

    /* Query allpage */
    $favicon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('favicon','photo_static'));
    $logo = $d->rawQueryOne("select id, photo, options from #_photo where type = ? and act = ? limit 0,1",array('logo','photo_static'));
    $popup_size = $d->rawQueryOne("select id, photo, options from #_photo where type = ? and act = ? limit 0,1",array('size_guild','photo_static'));
    $logo_footer = $d->rawQueryOne("select id, photo, options from #_photo where type = ? and act = ? limit 0,1",array('logo_footer','photo_static'));
    $xuhuong = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('xuhuong'));

    $all_colors = $d->rawQuery("select id,mau,tenvi,tenen from #_product_mau where type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
    foreach($all_colors as $c){
        $colors[$c['id']] = $c;
    }

    $all_sizes = $d->rawQuery("select id,tenvi,tenen from #_product_size where type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
    foreach($all_sizes as $c){
        $sizes[$c['id']] = $c;
    }

    $quangcao = $d->rawQueryOne("select id, photo, options, link from #_photo where type = ? and act = ? limit 0,1",array('quangcao','photo_static'));
    $quangcao1 = $d->rawQueryOne("select id, photo, options, link from #_photo where type = ? and act = ? limit 0,1",array('quangcao1','photo_static'));
    $banner = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? limit 0,1",array('banner','photo_static'));
    $slogan = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('slogan'));
    $social = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi'));
    $social_tags = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('tags'));
    $social2 = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi2'));
    $splistmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id,photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
    $ttlistmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_list where type = ? and hienthi > 0 order by stt,id desc",array('tin-tuc'));
    $about_index = $d->rawQueryOne("select * from #_static where type = ? limit 0,1",array('gioi-thieu'));
    $index_slogan = $d->rawQueryOne("select * from #_static where type = ? limit 0,1",array('slogan'));
     $footer = $d->rawQueryOne("select * from #_static where type = ? limit 0,1",array('footer'));
    $giolamviec = $d->rawQueryOne("select ten$lang, noidung$lang from #_static where type = ? limit 0,1",array('giolamviec'));
    $cs = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo from #_news where type = ? and hienthi > 0 order by stt,id desc",array('chinh-sach'));
    $cauhoi = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo from #_news where type = ? and hienthi > 0 order by stt,id desc",array('cau-hoi'));

    $index_news_tintuc = $d->rawQuery("select * from #_news where type = ? and hienthi > 0 and noibat > 0 order by stt,id desc",array('tin-tuc'));
$index_dichvu_menu = $d->rawQuery("select * from #_news_list where type = ? and hienthi > 0  order by stt,id desc",array('dich-vu'));
   $index_product_list_menu = $d->rawQuery("select * from #_product_list where type = ? and hienthi > 0  order by stt,id desc",array('san-pham'));

   $index_hotsale= $d->rawQuery("select * from #_product where type = ? and hienthi > 0 and noibat2 > 0 order by stt,id desc",array('san-pham'));
   
    /* Get statistic */
    $counter = $statistic->getCounter();
    $online = $statistic->getOnline();

    /* Newsletter */
    if($func->checkMemberLogin()){
        $id_member = $_SESSION[$login_member]['id'];
        $member_info = Member::info($id_member);
    }
   
?>