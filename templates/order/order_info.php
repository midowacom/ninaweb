<?php
if($func->checkMemberLogin()){ 
	$order_to_name = $member['ten'];
	$order_to_phone = $member['dienthoai'];
	$order_to_email = $member['email'];
	$order_to_address = $member['diachi'];
} ?>
<div class="information-cart d-form gutters-10">
	<div class="row">
		<div class="input-cart col-sm-6 col-12">
			<input type="text" class="uk-input" id="ten" name="ten" placeholder="<?=hoten?>" value="<?=$order_to_name?>" required />
		</div>
		<div class="input-cart col-sm-6 col-12">
			<input type="number" class="fuk-input" id="dienthoai" name="dienthoai" value="<?=$order_to_phone?>" placeholder="<?=sodienthoai?>" required />
		</div>
	</div>
	<div class="row">
		<div class="input-cart col-12">
			<input type="email" class="uk-input" id="email" name="email" placeholder="Email" required value="<?=$order_to_email?>"/>
		</div>
	</div>
	<div class="row w-clear">
		<div class="input-cart col-sm-4 col-12">
			<select class="select-city-cart uk-select" required id="city" name="city">
				<option value=""><?=tinhthanh?></option>
				<?php for($i=0;$i<count($city);$i++) { ?>
					<option value="<?=$city[$i]['id']?>"><?=$city[$i]['ten']?></option>
				<?php } ?>
			</select>
		</div>
		<div class="input-cart col-sm-4 col-12">
			<select class="select-district-cart select-district uk-select" required id="district" name="district">
				<option value=""><?=quanhuyen?></option>
			</select>
		</div>
		<div class="input-cart col-sm-4 col-12">
			<select class="select-wards-cart select-wards uk-select" required id="wards" name="wards">
				<option value=""><?=phuongxa?></option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="input-cart col-12">
			<input type="text" class="uk-select" id="diachi" name="diachi" placeholder="<?=diachi?>" value="<?=$order_to_address?>" required />
		</div>
	</div>
	<div class="row">
		<div class="input-cart col-12">
			<textarea class="uk-textarea" id="yeucaukhac" name="yeucaukhac" placeholder="<?=yeucaukhac?>" /></textarea>
		</div>
	</div>
</div>
