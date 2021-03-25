<?php
if($func->checkMemberLogin()){
	$id_member = $_SESSION[$login_member]['id'];
	$member = Member::info($id_member);
	$member_group = Member::info_group($member["id_member_group"],array("title","chietkhau"));

}
?>
<div class="mw">
	

	<form class="form-cart validation-cart" method="post" action="" enctype="multipart/form-data">
		<div class="wrap-cart d-flex align-items-stretch justify-content-between">
			<?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])) { ?>
				<div class="top-cart">
					<p class="title-cart"><?=giohangcuaban?>:</p>
					<div class="list-procart">
						<div class="procart procart-label d-flex align-items-start justify-content-between">
							<div class="pic-procart"><?=hinhanh?></div>
							<div class="info-procart"><?=tensanpham?></div>
							<div class="quantity-procart">
								<p><?=soluong?></p>
								<p><?=thanhtien?></p>
							</div>
							<div class="price-procart"><?=thanhtien?></div>
						</div>
						<?php $max = count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
							$pid = $_SESSION['cart'][$i]['productid'];
							$quantity = $_SESSION['cart'][$i]['qty'];
							$mau = ($_SESSION['cart'][$i]['mau'])?$_SESSION['cart'][$i]['mau']:0;
							$size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
							$quanprice = ($_SESSION['cart'][$i]['quanprice'])?$_SESSION['cart'][$i]['quanprice']:0;
							$code = ($_SESSION['cart'][$i]['code'])?$_SESSION['cart'][$i]['code']:'';
							$proinfo = $cart->get_product_info($pid);
							$pro_price = $cart->get_product_gia($pid,$quanprice);
							$pro_price_qty = $quantity * $pro_price;
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
								<input type="tel" class="quantity-procat" min="1" value="<?=$quantity?>" data-pid="<?=$pid?>" data-code="<?=$code?>" data-mau="<?=$mau?>" data-size="<?=$size?>"/>
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
				<?php } ?>
			</div>
			<div class="money-procart">
				
				<?php if($config['order']['ship']) { ?>
					<div class="total-procart">
						<p><?=tamtinh?>:</p>
						<p class="total-price load-price-temp"><?=$func->format_money($cart->get_order_total_tamtinh())?></p>
					</div>
					<div class="total-procart">
						<p><?=phivanchuyen?>:</p>
						<p class="total-price load-price-ship">0đ</p>
					</div>
				<?php } ?>

				<?php if($func->checkMemberLogin()){
					
					?>
					<div class="total-procart">
						<p><?=giam.' '.chietkhau?>:</p>
						<p class="total-price load-price-ship"><?=$member_group["chietkhau"]?>% (<?=$member_group["title"]?>)</p>
					</div>

				<?php } ?>

				<div class="total-procart">
					<p><?=tongtien?>:</p>
					<p class="total-price load-price-total"><?=$func->format_money($cart->get_order_total())?></p>
				</div>
				<input type="hidden" class="price-temp" name="price-temp" value="<?=$cart->get_order_total_tamtinh()?>">
				<input type="hidden" class="price-ship" name="price-ship">
				<input type="hidden" class="price-total" name="price-total" value="<?=$cart->get_order_total()?>">
			</div>
		</div>
		<div class="bottom-cart">
			<div class="section-cart">
				<p class="title-cart"><?=hinhthucthanhtoan?>:</p>
				<div class="information-cart">
					<?php foreach($httt as $key => $value) { ?>
						<div class="payments-cart uk-animation-toggle" tabindex="0">
							<div class="payments-label">
								<input type="radio" class="custom-control-input" id="payments-<?=$value['id']?>" name="payments" value="<?=$value['id']?>" required>
								<label class="payments-options custom-control-label" for="payments-<?=$value['id']?>" data-payments="<?=$value['id']?>"><?=$value['ten'.$lang]?></label>
							</div>
							<div class="payments-info payments-info-<?=$value['id']?> transition uk-animation-fade"><?=str_replace("\n","<br>",$value['mota'.$lang])?></div>
						</div>
					<?php } ?>
				</div>
				<p class="title-cart"><?=thongtingiaohang?>:</p>
				<?php include __DIR__."/order_info.php";?>
				<input type="submit" class="btn-cart btn btn-primary btn-lg btn-block" name="thanhtoan" value="<?=thanhtoan?>">
			</div>
		</div>
	<?php } else { ?>
		<a href="" class="empty-cart text-decoration-none">
			<p><?=khongtontaisanphamtronggiohang?></p>
			<span><?=vetrangchu?></span>
		</a>
	<?php } ?>
</div>
</form>
</div>