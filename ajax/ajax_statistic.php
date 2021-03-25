<?php
include "ajax_config.php";
$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
$mau = (isset($_POST['mau']) && $_POST['mau'] > 0) ? htmlspecialchars($_POST['mau']) : 0;
$size = (isset($_POST['size']) && $_POST['size'] > 0) ? htmlspecialchars($_POST['size']) : 0;
$quantity = (isset($_POST['quantity']) && $_POST['quantity'] > 0) ? htmlspecialchars($_POST['quantity']) : 1;
$code = (isset($_POST['code']) && $_POST['code'] != '') ? htmlspecialchars($_POST['code']) : '';
$cmd = (isset($_POST['cmd']) && $_POST['cmd'] != '') ? htmlspecialchars($_POST['cmd']) : '';

$check_size = $d->rawQueryOne("select quantity from #_product_statistics where id_product=? and id_mau=? and id_size=? ",array($id,$mau,$size));
// check current quantity of items

$tmp_quantity = 0;
if($cmd=='input-quantity'){
	

}else{
	$code_i = md5($id.$mau.$size);
	$max = count(isset($_SESSION['cart'])?$_SESSION['cart']:array());
	for($i=0;$i<$max;$i++)
	{
		if($code_i == $_SESSION['cart'][$i]['code'])
		{
			$tmp_quantity = $_SESSION['cart'][$i]['qty'];
			break;
		}
	}
	$quantity = $quantity + $tmp_quantity;
}

$ten_mau = Product::get_mau($mau);
$ten_mau = $ten_mau["ten$lang"];

$ten_size = Product::get_size($size);
$ten_size = $ten_size["ten$lang"];

$title_z = $ten_mau." - ".$ten_size.":";
if(!$check_size || $check_size['quantity'] == 0){
	$result = array(
		'status' => "failstock",
		'msg' => $title_z._out_stock
	);
}

if($check_size['quantity'] < $quantity){
	$result = array(
		'status' => "fail",
		'msg' =>$title_z. _not_enough_items
	);
}

if($check_size['quantity'] >= $quantity){
	$result = array(
		'status' => "success",
		'msg' => $title_z."success"
	);
}

echo json_encode($result);
