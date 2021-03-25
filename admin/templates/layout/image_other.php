<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="<?=$image_target?>-preview"><img class="rounded" src="<?=@$photoDetail?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/></div>
	<label class="photoUpload-file" id="<?=$image_target?>-photo-zone" for="<?=$image_target?>-zone">
		<input type="file" name="<?=$image_target?>" id="<?=$image_target?>-zone">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
	<div class="photoUpload-dimension"><?=@$dimension?></div>
</div>