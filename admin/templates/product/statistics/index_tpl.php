<?php
$linkStatistics = "index.php?com=product&act=statistics&kind=man&type=".$type."&p=".$curPage;
$linkStatistics_save = "index.php?com=product&act=statistics&kind=save&idc=".$idc."&type=".$type."&p=".$curPage;
$linkMan= "index.php?com=product&act=man&type=".$type;
?>
<!-- Content Header -->
<section class="content-header text-sm">
	<div class="container-fluid">
		<div class="row">
			<ol class="breadcrumb float-sm-left">
				<li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
			</ol>
		</div>
	</div>
</section>
<section class="content">
	<div class="card card-primary card-outline text-sm">
		<form class="validation-form" novalidate method="post" action="<?=$linkStatistics_save?>" enctype="multipart/form-data">
			<div class="card-header">
				<h3 class="card-title">Thông tin chính</h3>
			</div>
			<div class="card-body table-responsive p-0">
				<table class="table table-hover">
					<thead>
						<tr>
							<td>Label</td>
							<?php foreach($item_size_arr as $id_size){
								$_size = $class_product->get_size($id_size);
								?>
								<td class="mdw-label"><?=$_size["tenvi"]?></td>
							<?php } ?>	
						</tr>
					</thead>
					<tbody>
						<?php foreach($item_mau_arr as $id_mau){
							$_mau = $class_product->get_mau($id_mau);
							?>
							<tr>
								<td class="mdw-label"><?=$_mau["tenvi"]?></td>
								<?php foreach($item_size_arr as $id_size){
									$_size = $class_product->get_size($id_size);
									$_code =$class_product->hash_code($idc,$id_mau,$id_size);
									?>
									<td><input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[<?=$_code?>]" id="<?=$_code?>" placeholder="Số thứ tự" value="<?=isset($product_statistics[$_code]) ? $product_statistics[$_code]['quantity'] : 0?>"></td>
								<?php } ?>	
							</tr>
						<?php } ?>	
					</tbody>

				</table>
			</div>
			<div class="card-footer text-sm">
				<button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
				<a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
				<input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
			</div>
		</form>
	</div>
</section>