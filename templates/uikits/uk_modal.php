<?php
$proit = $d->rawQueryOne("select * from #_product where id=?",array(258));
?>
<div id="modal-center" class="uk-flex-top uk-modal-product" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-product-wrapper">
        	<div class="modal-product-btn modal-product-next"></div>
        	<div class="modal-product-btn modal-product-prev"></div>
        	<div class="modal-product-item">
        		<div class="image">
        			<img onerror="this.src='<?=THUMBS?>/640x480x1/assets/images/noimage.png';" src="<?=THUMBS?>/640x480x2/<?=UPLOAD_PRODUCT_L.$proit['photo']?>" alt="<?=$proit['ten'.$lang]?>" class="img-fluid w-100"/>
        		</div>
        		<div class="detail">
        			<h3><?=$proit["ten$lang"]?></h3>
        			<hr>
        			<div class="content">
        				<?=htmlspecialchars_decode($proit["noidung$lang"])?>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>