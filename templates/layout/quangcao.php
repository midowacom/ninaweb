	<?php if($quangcao){ ?>
		<div id="quangcao">
			<div class="container">
				<a href="<?=$quangcao["link"]?>" target="_blank">
					<img onerror="this.src='<?=THUMBS?>/1366x340x1/assets/images/default/noimage.png';" src="<?=THUMBS?>/1366x340x1/<?=UPLOAD_PHOTO_L.$quangcao['photo']?>" class="img-fluid w-100"/>
				</a>
			</div>
		</div>
	<?php } ?>