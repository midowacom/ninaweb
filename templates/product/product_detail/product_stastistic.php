<?php
$idc = $row_detail['id'];
$item = Product::get_info($idc);
$item_mau = $item['id_mau'];
$item_size = $item['id_size'];

$item_mau_arr = explode(',', $item_mau);
$item_size_arr = explode(',', $item_size);


$product_statistics_tmp = $d->rawQuery("select id,id_product,id_mau,id_size,quantity,code from #_product_statistics where id_product=? ",array($idc));
$product_statistics = array();
foreach($product_statistics_tmp as $itm){
	$product_statistics[$itm['code']]['id'] 		 = $itm['id'];
	$product_statistics[$itm['code']]['id_product'] = $itm['id_product'];
	$product_statistics[$itm['code']]['id_mau'] 	 = $itm['id_mau'];
	$product_statistics[$itm['code']]['id_size'] 	 = $itm['id_size'];
	$product_statistics[$itm['code']]['quantity'] 	 = $itm['quantity'];
		// $product_statistics[$item['code']]['type'] = $itm['type'];
}
?>
<table class="table-statistic" border="1">
	<thead>
		<tr>
			<td class="stock-label" colspan="2"><?=dathangnhanh?></td>
			<?php foreach($item_size_arr as $id_size){
				$_size = Product::get_size($id_size);
				?>
				<td scope="col"><?=$_size["ten$lang"]?></td>
			<?php } ?>	
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="<?=count($item_size_arr) + 2?>" style="height: 30px;"></td>
		</tr>
		<?php foreach($item_mau_arr as $id_mau){
			$_mau = Product::get_mau($id_mau);
			?>
			<tr data-idmau="<?=$id_mau?>" class="tr-data">
				<td class="td_color">
					<div class="color_item" data-idmau="<?=$id_mau?>" data-idproduct="#product-item-<?=$idc?>" style="background-color:#<?=$colors[$id_mau]["mau"]?>;"></div>
				</td>
				<td class="pl-1"><?=$_mau["ten$lang"]?></td>
				<?php foreach($item_size_arr as $id_size){
					$_size = Product::get_size($id_size);
					$_code =Product::hash_code($idc,$id_mau,$id_size);
					$_quantity =isset($product_statistics[$_code]) ? $product_statistics[$_code]['quantity'] : 0;
					?>
					<td class="product-stock <?=$_quantity==0?'no-click':''?>" data-idsize="<?=$id_size?>">
						<input type="tel" data-id="<?=$idc?>" data-idmau="<?=$id_mau?>"  data-idsize="<?=$id_size?>" class="form-reset stock-quantity checkStockNumber" min="0" data-title="<?=$_mau["ten$lang"]?> - <?=$_size["ten$lang"]?>" data-max="<?=$_quantity?>" pattern="[0-9]*" name="data[<?=$_code?>]" id="<?=$_code?>" value="" autocomplete="no" data-target-size=".size_<?=$id_size?>" <?=$_quantity==0?'disabled':''?>>
						<span class="stock-value"><?=$_quantity > 0 ? ($_quantity > 100?'100+':$_quantity) :outstock?></span>
					</td>
				<?php } ?>	
			</tr>
		<?php } ?>	
	</tbody>

</table>