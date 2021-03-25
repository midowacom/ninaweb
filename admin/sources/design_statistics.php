<?php	if(!defined('SOURCES')) die("Error");
$global_colors = $d->rawQuery("select id,photo,tenvi,tenen,mau,loaihienthi,hienthi,type from #_design_mau where hienthi=1 order by stt asc, id desc");

$global_sizes = $d->rawQuery("select id,tenvi,tenen,hienthi,type from #_design_size where hienthi=1 order by stt asc, id desc");

switch($kind){
	case 'man':
	get_design_statistics();
	$template = 'design/statistics/index';
	break;
	case 'save':
	save_design_statistics();
	$template = 'design/statistics/index';
	break;
}

function get_design_statistics(){
	global $d, $func, $curPage, $items, $paging, $type, $kind, $val, $idc, $com,$class_design,$item_mau_arr,$item_size_arr,$pcode,$design_statistics;
	$item = $class_design->get_info($idc);
	$item_mau = $item['id_mau'];
	$item_size = $item['id_size'];

	$item_mau_arr = explode(',', $item_mau);
	$item_size_arr = explode(',', $item_size);

	$design_statistics_tmp = $d->rawQuery("select id,id_design,id_mau,id_size,quantity,code from #_design_statistics where id_design=? ",array($idc));
	$design_statistics = array();
	foreach($design_statistics_tmp as $itm){
		$design_statistics[$itm['code']]['id'] 		 = $itm['id'];
		$design_statistics[$itm['code']]['id_design'] = $itm['id_design'];
		$design_statistics[$itm['code']]['id_mau'] 	 = $itm['id_mau'];
		$design_statistics[$itm['code']]['id_size'] 	 = $itm['id_size'];
		$design_statistics[$itm['code']]['quantity'] 	 = $itm['quantity'];
		// $design_statistics[$item['code']]['type'] = $itm['type'];
	}
// $func->dump($design_statistics,1);

}
function save_design_statistics(){
	global $d, $func, $curPage, $items, $paging, $type, $kind, $val, $idc, $com,$class_design,$item_mau_arr,$item_size_arr;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php", false);
	// $func->dump($_POST['data'],1);
	foreach($_POST['data'] as $code =>$quantity){
		if((int)$quantity == 0) continue;
		$data['code'] = $code;
		$code_piecess = explode('-', $code);
		$data['id_design'] = preg_replace('/[^0-9]/','',$code_piecess[0]);
		$data['id_mau'] = preg_replace('/[^0-9]/','',$code_piecess[1]);
		$data['id_size'] =preg_replace('/[^0-9]/','',$code_piecess[2]);
		$data['quantity'] = (int) $quantity;
		$data['ngaysua'] = time();
		$data['type'] = $type;
		$ptm = $class_design->data_design_exist($code);

		if($ptm == false){
			$d->insert('design_statistics',$data);
		}else{
			$d->where('code', $code);
			$d->update('design_statistics',$data);
		}


	}
	$func->transfer("Đã cập nhật lại dữ liệu kho", "index.php?com=design&act=statistics&type=".$type."&kind=man&p=".$curPage."&idc=".$idc);

}