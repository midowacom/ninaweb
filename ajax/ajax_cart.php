<?php
	include "ajax_config.php";

    $cmd = (isset($_POST['cmd']) && $_POST['cmd'] != '') ? htmlspecialchars($_POST['cmd']) : '';
    $id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
    $mau = (isset($_POST['mau']) && $_POST['mau'] > 0) ? htmlspecialchars($_POST['mau']) : 0;
	$size = (isset($_POST['size']) && $_POST['size'] > 0) ? htmlspecialchars($_POST['size']) : 0;
	$quanprice = (isset($_POST['quanprice']) && $_POST['quanprice'] > 0) ? htmlspecialchars($_POST['quanprice']) : 0;
	$quantity = (isset($_POST['quantity']) && $_POST['quantity'] > 0) ? htmlspecialchars($_POST['quantity']) : 1;
	$code = (isset($_POST['code']) && $_POST['code'] != '') ? htmlspecialchars($_POST['code']) : '';
	$ship = (isset($_POST['ship']) && $_POST['ship'] > 0) ? htmlspecialchars($_POST['ship']) : 0;
	$pid = $id;
		
	if(!empty($_SESSION['cart'])){
		if($quanprice == 0){

		}
	}

	$code_md5 = md5($id.$mau.$size.$quanprice);


	if($cmd == 'add-cart' && $id > 0)
	{
		$cart->addtocart($quantity,$id,$mau,$size,$quanprice);
		$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
		$data = array('count_cart' => $max);

		echo json_encode($data);
	}
	else if($cmd == 'update-cart' && $id > 0 && $code != '')
	{
		if(isset($_SESSION['cart']))
		{
			$max = count($_SESSION['cart']);
			for($i=0;$i<$max;$i++)
			{
				if($code == $_SESSION['cart'][$i]['code'])
				{
					$quanprice = $_SESSION['cart'][$i]['quanprice'];
					if($quantity) $_SESSION['cart'][$i]['qty'] = $quantity;
					break;
				}
			}
		}
		
		$proinfo = $cart->get_product_info($id);
		$gia_tmp = $cart->get_product_gia($id,$quanprice);
		$gia = $func->format_money($gia_tmp*$quantity);

		$temp = $cart->get_order_total_tamtinh();
		$tempText = $func->format_money($temp);
		$total = $cart->get_order_total();
		if($ship) $total += $ship;
		$totalText = $func->format_money($total);
		$data = array('gia' => $gia, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText);

		echo json_encode($data);
	}
	else if($cmd == 'delete-cart')
	{
		$cart->remove_product($code);

		$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
		$temp = $cart->get_order_total();
		$tempText = $func->format_money($temp);
		$total = $cart->get_order_total();
		if($ship) $total += $ship;
		$totalText = $func->format_money($total);
		$data = array('max' => $max, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText);

		echo json_encode($data);
	}
	else if($cmd == 'ship-cart')
	{
		$shipData = array();
		$shipPrice = 0;
		$shipText = '0đ';
		$total = 0;
		$totalText = '';

		if($id) $shipData = $d->rawQueryOne("select gia from #_wards where id = ? limit 0,1",array($id));

		$total = $cart->get_order_total();
		if(isset($shipData['gia']) && $shipData['gia'] > 0)
		{
			$total += $shipData['gia'];
			$shipText = $func->format_money($shipData['gia']);
		}
		$totalText = $func->format_money($total);
		$shipPrice = (isset($shipData['gia'])) ? $shipData['gia'] : 0;
		$data = array('shipText' => $shipText, 'ship' => $shipPrice, 'totalText' => $totalText, 'total' => $total);

		echo json_encode($data);
	}
	else if($cmd == 'popup-cart')
	{ ?>
		<form method="post" action="" enctype="multipart/form-data">
		    <div class="wrap-cart">
		        <div class="top-cart">
		            <div class="list-procart">
		            	<div class="list-procart-wrap">
		                <div class="procart procart-label d-flex align-items-start justify-content-between">
		                    <div class="pic-procart"><?=hinhanh?></div>
		                    <div class="info-procart"><?=tensanpham?></div>
		                    <div class="quantity-procart">
		                        <p><?=soluong?></p>
		                        <p><?=thanhtien?></p>
		                    </div>
		                    <div class="price-procart"><?=thanhtien?></div>
		                </div>
		                <?php if(isset($_SESSION['cart'])) { for($i=0;$i<count($_SESSION['cart']);$i++) {
		                    $pid = $_SESSION['cart'][$i]['productid'];
		                    $quantity = $_SESSION['cart'][$i]['qty'];
		                    $mau = ($_SESSION['cart'][$i]['mau'])?$_SESSION['cart'][$i]['mau']:0;
		                    $size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
		                    $quanprice = ($_SESSION['cart'][$i]['quanprice'])?$_SESSION['cart'][$i]['quanprice']:0;
		                    $code = ($_SESSION['cart'][$i]['code'])?$_SESSION['cart'][$i]['code']:"";
		                    $proinfo = $cart->get_product_info($pid);
		              
		                    $pro_price = $cart->get_product_gia($pid,$quanprice);
		                    $pro_price_qty = $pro_price * $quantity;



		                    ?>
		                    <div class="procart <?=$code?> d-flex align-items-start justify-content-between" data-idmau="<?=$mau?>" data-idsize="<?=$size?>" data-id="<?=$pid?>">
		                        <div class="pic-procart">
		                            <a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
		                            <a class="del-procart text-decoration-none" data-code="<?=$code?>">
		                                <i class="fa fa-times-circle"></i>
		                                <span><?=xoa?></span>
		                            </a>
		                        </div>
		                        <div class="info-procart">
		                            <h3 class="name-procart"><a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>
		                            <div class="properties-procart">
		                                <?php if($mau) { $maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1",array($proinfo['type'],$mau)); ?>
		                                    <p>Màu: <strong><?=$maudetail['ten'.$lang]?></strong></p>
		                                <?php } ?>
		                                <?php if($size) { $sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1",array($proinfo['type'],$size)); ?>
		                                    <p>Size: <strong><?=$sizedetail['ten'.$lang]?></strong></p>
		                                <?php } ?>
		                                <?php if($quanprice) { $quanpricedetail = $d->rawQueryOne("select ten$lang from #_product_quanprice where id_product = ? and id = ? limit 0,1",array($pid,$quanprice)); ?>
									<p>Loại: <strong><?=$quanpricedetail['ten'.$lang]?></strong></p>
								<?php } ?>
		                            </div>
		                        </div>
		                        <div class="quantity-procart">
		                            <div class="price-procart price-procart-rp">
		                              
		                                    <p class="price-new-cart load-price-<?=$code?>">
		                                        <?=$func->format_money($pro_price_qty)?>
		                                    </p>
		                            </div>
		                            <div class="quantity-counter-procart quantity-counter-procart-<?=$code?> d-flex align-items-stretch justify-content-between">
		                                <span class="counter-procart-minus counter-procart">-</span>
		                                <input type="number" class="quantity-procat" min="1" value="<?=$quantity?>" data-pid="<?=$pid?>" data-code="<?=$code?>" data-mau="<?=$mau?>" data-size="<?=$size?>"/>
		                                <span class="counter-procart-plus counter-procart">+</span>
		                            </div>
		                            <div class="pic-procart pic-procart-rp">
		                                <a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
		                                <a class="del-procart text-decoration-none" data-code="<?=$code?>">
		                                    <i class="fa fa-times-circle"></i>
		                                    <span><?=xoa?></span>
		                                </a>
		                            </div>
		                        </div>
		                        <div class="price-procart">
		                           
		                                <p class="price-new-cart load-price-<?=$code?>">
		                                    <?=$func->format_money($pro_price_qty)?>
		                                </p>
		                        </div>
		                    </div>
		                <?php } } ?>
		            </div>
		            </div>
		            <div class="uk-panel">
		                <div class="total-procart d-flex align-items-center justify-content-between">
		                    <span><?=tamtinh?>:</span>
		                    <span class="total-price load-price-temp"><?=$func->format_money($cart->get_order_total_tamtinh())?></span>
		                </div>
		            </div>
		            <div class="modal-footer uk-margin">
		                <a href="san-pham" class="uk-button uk-button-primary" title="<?=tieptucmuahang?>">
		                    <span><?=tieptucmuahang?></span>
		                </a>
		                <a class="uk-button uk-button-danger uk-margin-small-left" href="gio-hang" title="<?=thanhtoan?>"><?=thanhtoan?></a>
		            </div>
		        </div>
		    </div>
		</form>
	<?php }
?>