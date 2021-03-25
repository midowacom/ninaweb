<?php
if(!defined('SOURCES')) die("Error");

if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
if($func->check_permission())
{
	$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
	exit;
}


switch($act)
{
	case "man_group":
	get_man_group();
	$template = 'user/visitor_group/index';
	break;
	case "edit_group":
	get_group();
	$template = 'user/visitor_group/add_group';
	break;
	case "add_group":
	$template = 'user/visitor_group/add_group';
	break;
	case "save_group":
	save_group();
	break;
	case "delete_group":
	delete_group();
	break;
	default:
	$template = "404";
}
function get_group()
{
	global $d, $func, $curPage, $item;
	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_group&p=".$curPage, false);
	$item = $d->rawQueryOne("select * from #_member_group where id = ? limit 0,1",array($id));
	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=man_group&p=".$curPage, false);
}
function get_man_group(){
	global $d, $func, $curPage, $items, $paging, $config;

	$where = "";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and (username LIKE '%$keyword%' or ten LIKE '%$keyword%')";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_member_group where id <> 0 $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql);
	$sqlNum = "select count(*) as 'num' from #_member_group where id <> 0 $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum);
	$total = $count['num'];
	$url = "index.php?com=user&act=man";
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}
function save_group(){
	global $d, $func, $curPage;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_group&p=".$curPage, false);

		$id = htmlspecialchars($_POST['id']);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		/* Kiểm tra title */
		$title = isset($data['title']) ? $data['title'] : '';

		$check_title = $d->rawQueryOne("select id from #_member_group where title = ? and id <> ? limit 0,1",array($title, $id));
		if(!empty($check_title)) $func->transfer("Tên nhóm này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=man_group&p=".$curPage, false);

		if($id)
		{
			$d->where('id', $id);
			if($d->update('member_group',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=man_group&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man_group&p=".$curPage, false);
		}
		else
		{		
			if($d->insert('member_group',$data)){
				$func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=man_group&p=".$curPage);
				
			} 
			else {
				$func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man_group&p=".$curPage, false);
			}
		}
}