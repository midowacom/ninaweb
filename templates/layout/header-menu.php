<div id="header-menu">
	<div class="container">
		<div id="logo">
			<a class="logo-header" href=""><img onerror="this.src='<?=THUMBS?>/170x75x2/assets/images/noimage.png';" src="<?=THUMBS?>/170x75x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>"/></a>
		</div>
		<div id="header">
			<div class="header-top">
				<div class="header-top-left">
					<span class="mx-2 text-white reset-flex"><?=html_entity_decode($index_slogan["noidung$lang"])?></span>
				</div>
				
				<div class="header-top-right">
					<span class="mx-2"><a href="gioi-thieu" class="menu-text"><?=gioithieu?></a></span>
					<span class="mx-2"><a href="su-kien" class="menu-text"><?=sukien?></a></span>
					<span class="mx-2"><a href="lien-he" class="menu-text"><?=lienhe?></a></span>
					<span class="mx-2 sub_menu">
						<a class="menu-text"><?=$func->checkMemberLogin()?$member_info['ten']:taikhoan?></a>
						<div class="sub_menu_item">
				<?php if($func->checkMemberLogin()){ ?>
								<a href="account/thong-tin"><span class="far fa-user mr-2"></span><span><?=thongtincanhan?></span></a>
								<a href="account/dang-xuat"><span class="far fa-user mr-2"></span><?=dangxuat?></a>
				<?php }else{ ?>
								<a href="account/dang-nhap"><span class="far fa-user mr-2"></span><span><?=dangnhap?></span></a>
								<a href="account/dang-ky"><span class="far fa-user mr-2"></span><span><?=dangky?></span></a>
							<?php } ?>
						</div>
					</span>
					<span class="mx-2  icr"><a href="gio-hang">
						<span class="icon cart">
							<span class="svg-cart">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
									<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</svg>
							</span>
						</span>
					</a>
				</span>
				<span class="ml-2 icr"><a href="ngon-ngu/<?=$lang=='vi'?'en':'vi'?>/" class="text-uppercase"><?=$lang=='vi'?'en':'vi'?></a></span>
			</div>
		</div>
		<div class="header-bottom">
			<?php include TEMPLATE."layout/menu.php" ;?>
		</div>
	</div>
</div>
</div>