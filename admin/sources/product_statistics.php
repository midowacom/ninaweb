<?php	if(!defined('SOURCES')) die("Error");
$global_colors = $d->rawQuery("select id,photo,tenvi,tenen,mau,loaihienthi,hienthi,type from #_product_mau where hienthi=1 order by stt asc, id desc");

$global_sizes = $d->rawQuery("select id,tenvi,tenen,hienthi,type from #_product_size where hienthi=1 order by stt asc, id desc");

switch($kind){
	case 'man':
	get_product_statistics();
	$template = 'product/statistics/index';
	break;
	case 'save':
	save_product_statistics();
	$template = 'product/statistics/index';
	break;
}

function get_product_statistics(){
	global $d, $func, $curPage, $items, $paging, $type, $kind, $val, $idc, $com,$class_product,$item_mau_arr,$item_size_arr,$pcode,$product_statistics;
	$item = $class_product->get_info($idc);
	$item_mau = $item['id_mau'];
	$item_size = $item['id_size'];

	$item_mau_arr = explode(',', $item_mau);
	$item_size_arr = explode(',', $item_size);

	$product_statistics_tmp = $d->rawQuery("select id,id_product,id_mau,id_size,quantity,code from #_product_statistics where id_product=? ",array($idc));
	$product_statistics = array();
	foreach($product_statistics_tmp as $itm){
		$product_statistics[$itm['code']]['id'] 		 = $itm['id'];
		$product_statistics[$itm['code']]['id_product'] = $itm['id_product'];
		$product_statistics[$itm['code']]['id_mau'] 	 = $itm['id_mau'];
		$product_statistics[$itm['code']]['id_size'] 	 = $itm['id_size'];
		$product_statistics[$itm['code']]['quantity'] 	 = $itm['quantity'];
		// $product_statistics[$item['code']]['type'] = $itm['type'];
	}
// $func->dump($product_statistics,1);

}
function save_product_statistics(){
	global $d, $func, $curPage, $items, $paging, $type, $kind, $val, $idc, $com,$class_product,$item_mau_arr,$item_size_arr;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php", false);
	// $func->dump($_POST['data'],1);
	foreach($_POST['data'] as $code =>$quantity){
		if((int)$quantity == 0) continue;
		$data['code'] = $code;
		$code_piecess = explode('-', $code);
		$data['id_product'] = preg_replace('/[^0-9]/','',$code_piecess[0]);
		$data['id_mau'] = preg_replace('/[^0-9]/','',$code_piecess[1]);
		$data['id_size'] =preg_replace('/[^0-9]/','',$code_piecess[2]);
		$data['quantity'] = (int) $quantity;
		$data['ngaysua'] = time();
		$data['type'] = $type;
		$ptm = $class_product->data_product_exist($code);

		if($ptm == false){
			$d->insert('product_statistics',$data);
		}else{
			$d->where('code', $code);
			$d->update('product_statistics',$data);
		}


	}
	$func->transfer("Đã cập nhật lại dữ liệu kho", "index.php?com=product&act=statistics&type=".$type."&kind=man&p=".$curPage."&idc=".$idc);

}