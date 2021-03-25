<?php 
switch($kind)
{
	case "man":
	get_items_quanprice();
	$template = "product/quanprice/items";
	break;
	case "add":
	$template = "product/quanprice/item_add";
	break;
	case "edit":
	get_item_quanprice();
	$template = "product/quanprice/item_add";
	break;
	case "save":
	save_item_quanprice();
	break;
	case "delete":
	delete_item_quanprice();
	break;
	default:
			$template = "404";	
	/* List */
}
/* Get price */
function get_items_quanprice()
{
	global $d, $func, $curPage, $items, $paging, $type,$idc;

	$where = " and id_product=? ";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_product_quanprice where type = ? $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql,array($type,$idc));
	$sqlNum = "select count(*) as 'num' from #_product_quanprice where type = ? $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,array($type,$idc));
	$total = $count['num'];
	$url = "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type;
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}

/* Edit price */
function get_item_quanprice()
{
	global $d, $func, $curPage, $item, $type,$idc;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=quanprice&kind=man&idc=".$idc."&type=".$type."&p=".$curPage, false);

	$item = $d->rawQueryOne("select * from #_product_quanprice where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage, false);
}

/* Save price */
function save_item_quanprice()
{
	global $d, $func, $curPage, $config, $type, $idc;

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=quanprice&kind=man&idc=".$idc."&type=".$type."&p=".$curPage, false);

	/* Post dữ liệu */

	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
		$data['gia'] = (isset($data['gia']) && $data['gia']!=='') ? str_replace(",","",$data['gia']) : 0;
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;
	}

	$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

	if($id)
	{
		$data['ngaysua'] = time();

		$d->where('id', $id);
		$d->where('type', $type);
		if($d->update('product_quanprice',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=quanprice&kind=man&idc=".$idc."&type=".$type."&p=".$curPage);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage, false);
	}
	else
	{
		$data['ngaytao'] = time();

		if($d->insert('product_quanprice',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage, false);
	}
}

/* Delete price */
function delete_item_quanprice()
{
	global $d, $func, $curPage, $type,$idc;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$row = $d->rawQueryOne("select id from #_product_quanprice where id = ? and type = ? limit 0,1",array($id,$type));

		if($row['id'])
		{
			$d->rawQuery("delete from #_product_quanprice where id = ? and type = ?",array($id,$type));
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage);
		}
		else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=quanprice&kind=man&idc=".$idc."&type=".$type."&p=".$curPage, false);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$row = $d->rawQueryOne("select id from #_product_quanprice where id = ? and type = ? limit 0,1",array($id,$type));

			if($row['id']) $d->rawQuery("delete from #_product_quanprice where id = ? and type = ?",array($id,$type));
		}

		$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage);
	} 
	else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=quanprice&idc=".$idc."&kind=man&type=".$type."&p=".$curPage, false);
}