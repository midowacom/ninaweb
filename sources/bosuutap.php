<?php  
if(!defined('SOURCES')) die("Error");
@$idb = htmlspecialchars($_GET['id']);


if($idb){
	/* Lấy brand detail */
	$pro_brand = $d->rawQueryOne("select ten$lang, tenkhongdauvi, tenkhongdauen, id, type, photo, options from #_product_brand where id = ? and type = ? limit 0,1",array($idb,$type));

	/* SEO */
	$title_cat = $pro_brand['ten'.$lang];
	$seoDB = $seo->getSeoDB($pro_brand['id'],'product','man_brand',$pro_brand['type']);
	$seo->setSeo('h1',$pro_brand['ten'.$lang]);
	if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
	else $seo->setSeo('title',$pro_brand['ten'.$lang]);
	if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
	if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
	$seo->setSeo('url',$func->getPageURL());
	$img_json_bar = (isset($pro_brand['options']) && $pro_brand['options'] != '') ? json_decode($pro_brand['options'],true) : null;
	if($img_json_bar == null || ($img_json_bar['p'] != $pro_brand['photo']))
	{
		$img_json_bar = $func->getImgSize($pro_brand['photo'],UPLOAD_PRODUCT_L.$pro_brand['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar),'product_brand',$pro_brand['id']);
	}
	if(count($img_json_bar) > 0)
	{
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_brand['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
	}

	/* Lấy sản phẩm */
	$where = "";
	$where = " find_in_set(?,id_brand) and type = ? and hienthi > 0";
	$params = array($pro_brand['id'],$type);

	$curPage = $get_page;
	$per_page = 20;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_product where $where order by stt,id desc $limit";
	$product = $d->rawQuery($sql,$params);
	
	$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,$params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total,$per_page,$curPage,$url);

	/* breadCrumbs */
	$breadcr->setBreadCrumbs($pro_brand[$sluglang],$title_cat);
	$breadcrumbs = $breadcr->getBreadCrumbs();
}else{



}