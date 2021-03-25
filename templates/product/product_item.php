<div class="product">
				<a class="box-product text-decoration-none" href="<?=$item[$sluglang]?>" title="<?=$item['ten'.$lang]?>">
					<p class="pic-product scale-img"><img onerror="this.src='<?=THUMBS?>/270x270x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/270x270x1/<?=UPLOAD_PRODUCT_L.$item['photo']?>" alt="<?=$item['ten'.$lang]?>"/></p>
					<h3 class="name-product text-split"><?=$item['ten'.$lang]?></h3>
					<p class="price-product">
						<?php if($item['giakm']) { ?>
							<span class="price-new"><?=$this->format_money($item['giamoi'])?></span>
							<span class="price-old"><?=$this->format_money($item['gia'])?></span>
							<span class="price-per"><?='-'.$item['giakm'].'%'?></span>
						<?php } else { ?>
							<span class="price-new"><?=($item['gia']) ? $this->format_money($item['gia']) : lienhe?></span>
						<?php } ?>
					</p>
				</a>
				<p class="cart-product w-clear">
					<span class="cart-add addcart transition" data-id="<?=$item['id']?>" data-action="addnow">Thêm vào giỏ hàng</span>
					<span class="cart-buy addcart transition" data-id="<?=$item['id']?>" data-action="buynow">Mua ngay</span>
				</p>
			</div>