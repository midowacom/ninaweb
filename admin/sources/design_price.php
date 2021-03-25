<?php 
switch($act)
{
	/* Price */
	case "man_price":
	get_items_price();
	$template = "design/price/items";
	break;
	case "add_price":
	$template = "design/price/item_add";
	break;
	case "edit_price":
	get_item_price();
	$template = "design/price/item_add";
	break;
	case "save_price":
	save_item_price();
	break;
	case "delete_price":
	delete_item_price();
	break;
	default:
			$template = "404";	
	/* List */
}
/* Get price */
function get_items_price()
{
	global $d, $func, $curPage, $items, $paging, $type;

	$where = "";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_design_price where type = ? $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql,array($type));
	$sqlNum = "select count(*) as 'num' from #_design_price where type = ? $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,array($type));
	$total = $count['num'];
	$url = "index.php?com=design&act=man_price&type=".$type;
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}

/* Edit price */
function get_item_price()
{
	global $d, $func, $curPage, $item, $type;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);

	$item = $d->rawQueryOne("select * from #_design_price where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);
}

/* Save price */
function save_item_price()
{
	global $d, $func, $curPage, $config, $type;

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);

	/* Post dữ liệu */

	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
		$data['giatu'] = (isset($data['giatu']) && $data['giatu']!=='') ? str_replace(",","",$data['giatu']) : 0;
		$data['giaden'] = (isset($data['giaden']) && $data['giaden']!=='') ? str_replace(",","",$data['giaden']) : 0;
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;
	}

	$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

	if($id)
	{
		$data['ngaysua'] = time();

		$d->where('id', $id);
		$d->where('type', $type);
		if($d->update('design_price',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);
	}
	else
	{
		$data['ngaytao'] = time();

		if($d->insert('design_price',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);
	}
}

/* Delete price */
function delete_item_price()
{
	global $d, $func, $curPage, $type;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$row = $d->rawQueryOne("select id from #_design_price where id = ? and type = ? limit 0,1",array($id,$type));

		if($row['id'])
		{
			$d->rawQuery("delete from #_design_price where id = ? and type = ?",array($id,$type));
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage);
		}
		else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$row = $d->rawQueryOne("select id from #_design_price where id = ? and type = ? limit 0,1",array($id,$type));

			if($row['id']) $d->rawQuery("delete from #_design_price where id = ? and type = ?",array($id,$type));
		}

		$func->transfer("Xóa dữ liệu thành công", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage);
	} 
	else $func->transfer("Không nhận được dữ liệu", "index.php?com=design&act=man_price&type=".$type."&p=".$curPage, false);
}