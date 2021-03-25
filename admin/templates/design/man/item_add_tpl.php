<?php
$count_other_photo = 0;
	function get_mau($id=0)
	{
		global $d, $type;

		if($id)
		{
			$temps = $d->rawQueryOne("select id_mau from #_design where id = ? and type = ? limit 0,1",array($id,$type));
			$arr_mau = explode(',', $temps['id_mau']);
			
			for($i=0;$i<count($arr_mau);$i++) $temp[$i]=$arr_mau[$i];
		}

		$row_mau = $d->rawQuery("select tenvi, id from #_design_mau where type = ? order by stt,id desc",array($type));

		$str = '<select id="mau_group" name="mau_group[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_mau);$i++)
		{
			if(isset($temp) && count($temp) > 0)
			{
				if(in_array($row_mau[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			else
			{
				$selected = '';
			}
			$str .= '<option value="'.$row_mau[$i]["id"].'" '.$selected.' /> '.$row_mau[$i]["tenvi"].'</option>';
		}
		$str .= '</select>';

		return $str;
	}

	function get_size($id=0)
	{
		global $d, $type,$config_product_type;

		if($id)
		{
			$temps = $d->rawQueryOne("select id_size from #_design where id = ? and type = ? limit 0,1",array($id,$type));
			$arr_size = explode(',', $temps['id_size']);
			
			for($i=0;$i<count($arr_size);$i++) $temp[$i]=$arr_size[$i];
		}

		$row_size = $d->rawQuery("select tenvi, id from #_product_size where type = ? order by stt,id desc",array($config_product_type));

		$str = '<select id="size_group" name="size_group[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_size);$i++)
		{
			if(isset($temp) && count($temp) > 0)
			{	
				if(in_array($row_size[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			else
			{
				$selected = '';
			}
			$str .= '<option value="'.$row_size[$i]["id"].'" '.$selected.' /> '.$row_size[$i]["tenvi"].'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}

	if($act=="add") $labelAct = "Thêm mới";
	else if($act=="edit") $labelAct = "Chỉnh sửa";
	else if($act=="copy")  $labelAct = "Sao chép";

	$linkMan = "index.php?com=design&act=man&type=".$type."&p=".$curPage;
	if($act=='add') $linkFilter = "index.php?com=design&act=add&type=".$type."&p=".$curPage;
	else if($act=='edit') $linkFilter = "index.php?com=design&act=edit&type=".$type."&p=".$curPage."&id=".$id;
    if($act=="copy") $linkSave = "index.php?com=design&act=save_copy&type=".$type."&p=".$curPage;
    else $linkSave = "index.php?com=design&act=save&type=".$type."&p=".$curPage;

    /* Check cols */
    if(isset($config['design'][$type]['gallery']) && count($config['design'][$type]['gallery']) > 0)
    {
	    foreach($config['design'][$type]['gallery'] as $key => $value)
	    {
	        if($key == $type)
	        {
	            $flagGallery = true;
	            break;
	        }
	    }
    }

    if(
    	(isset($config['design'][$type]['dropdown']) && $config['design'][$type]['dropdown'] == true) || 
    	(isset($config['design'][$type]['brand']) && $config['design'][$type]['brand'] == true) || 
    	(isset($config['design'][$type]['tags']) && $config['design'][$type]['tags'] == true) || 
    	(isset($config['design'][$type]['mau']) && $config['design'][$type]['mau'] == true) || 
    	(isset($config['design'][$type]['product_size']) && $config['design'][$type]['product_size'] == true) || 
    	(isset($config['design'][$type]['images']) && $config['design'][$type]['images'] == true))
    {
    	$colLeft = "col-xl-8";
    	$colRight = "col-xl-4";
    }
    else
    {
    	$colLeft = "col-12";
    	$colRight = "d-none";	
    }
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?=$labelAct?> <?=$config['design'][$type]['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
        	<div class="<?=$colLeft?>">
	            <?php
                	if(isset($config['design'][$type]['slug']) && $config['design'][$type]['slug'] == true)
	                {
	                	$slugchange = ($act=='edit') ? 1 : 0;
	                	$copy = ($act!='copy') ? 0 : 1;
						include TEMPLATE.LAYOUT."slug.php";
				    }
			    ?>
	        	<div class="card card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Nội dung <?=$config['design'][$type]['title_main']?></h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		            </div>
		            <div class="card-body">
		                <div class="card card-primary card-outline card-outline-tabs">
		                    <div class="card-header p-0 border-bottom-0">
		                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <li class="nav-item">
		                                    <a class="nav-link <?=($k==$lang_default)?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
		                                </li>
		                            <?php } ?>
		                        </ul>
		                    </div>
		                    <div class="card-body card-article">
		                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <div class="tab-pane fade show <?=($k==$lang_default)?'active':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
		                                    <div class="form-group">
		                                        <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
		                                        <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>" <?=($k=='vi')?'required':''?>>
		                                    </div>
		                                    <?php if(isset($config['design'][$type]['mota']) && $config['design'][$type]['mota'] == true) { ?>
		                                        <div class="form-group">
		                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
		                                            <textarea class="form-control for-seo <?=(isset($config['design'][$type]['mota_cke']) && $config['design'][$type]['mota_cke'] == true)?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                    <?php if(isset($config['design'][$type]['noidung']) && $config['design'][$type]['noidung'] == true) { ?>
		                                        <div class="form-group">
		                                            <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
		                                            <textarea class="form-control for-seo <?=(isset($config['design'][$type]['noidung_cke']) && $config['design'][$type]['noidung_cke'] == true)?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                </div>
		                            <?php } ?>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
	        </div>
        	<div class="<?=$colRight?>">
        		<?php if(
        			(isset($config['design'][$type]['dropdown']) && $config['design'][$type]['dropdown'] == true) || 
        			(isset($config['design'][$type]['brand']) && $config['design'][$type]['brand'] == true) || 
        			(isset($config['design'][$type]['tags']) && $config['design'][$type]['tags'] == true) || 
        			(isset($config['design'][$type]['mau']) && $config['design'][$type]['mau'] == true) || 
        			(isset($config['design'][$type]['product_size']) && $config['design'][$type]['product_size'] == true)
        		) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Danh mục <?=$config['design'][$type]['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
		            		<div class="form-group-category row">
				            	<?php if(isset($config['design'][$type]['dropdown']) && $config['design'][$type]['dropdown'] == true) { ?>
				            		<?php if(isset($config['design'][$type]['list']) && $config['design'][$type]['list'] == true) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_list">Danh mục cấp 1:</label>
											<?=$func->get_ajax_category('design', 'list', $type)?>
						                </div>
						            <?php } ?>
						            <?php if(isset($config['design'][$type]['cat']) && $config['design'][$type]['cat'] == true) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_cat">Danh mục cấp 2:</label>
											<?=$func->get_ajax_category('design', 'cat', $type)?>
						                </div>
						            <?php } ?>
					                <?php if(isset($config['design'][$type]['item']) && $config['design'][$type]['item'] == true) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_item">Danh mục cấp 3:</label>
											<?=$func->get_ajax_category('design', 'item', $type)?>
						                </div>
						            <?php } ?>
					                <?php if(isset($config['design'][$type]['sub']) && $config['design'][$type]['sub'] == true) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_sub">Danh mục cấp 4:</label>
						                    <?=$func->get_ajax_category('design', 'sub', $type)?>
						                </div>
						            <?php } ?>
					            <?php } ?>
					            <?php if(isset($config['design'][$type]['brand']) && $config['design'][$type]['brand'] == true) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_brand">Danh mục <?=$config['design'][$type]['title_main_brand']?>:</label>
					                    <?=$func->get_ajax_category('design', 'brand', $type, 'Chọn Collection')?>
					                </div>
							    <?php } ?>
							    <?php if(isset($config['design'][$type]['tags']) && $config['design'][$type]['tags'] == true) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_tags">Danh mục tags:</label>
					                    <?=$func->get_tags(@$item['id'], 'tags_group', 'design', $type)?>
					                </div>
							    <?php } ?>
							    <?php if(isset($config['design'][$type]['mau']) && $config['design'][$type]['mau'] == true) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_mau">Danh mục màu sắc:</label>
					                    <?=get_mau(@$item['id'])?>
					                </div>
							    <?php } ?>
							    <?php if(isset($config['design'][$type]['product_size']) && $config['design'][$type]['product_size'] == true) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_size">kích thước sản phẩm:</label>
					                    <?=get_size(@$item['id'])?>
					                </div>
							    <?php } ?>
							</div>
			            </div>
			        </div>
			    <?php } ?>
				
				<?php if(isset($config['design'][$type]['images']) && $config['design'][$type]['images'] == true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Hình ảnh <?=$config['design'][$type]['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
	                    	<?php
	                    		$photoDetail = ($act != 'copy') ? UPLOAD_DESIGN.@$item['photo'] : '';
	                    		$dimension = "Width: ".$config['design'][$type]['width']." px - Height: ".$config['design'][$type]['height']." px (".$config['design'][$type]['img_type'].")";
	                    		include TEMPLATE.LAYOUT."image.php";
	                    	?>
			            </div>
			        </div>
		        <?php } ?>
		        <?php if(isset($config['design'][$type]['photo2']) && $config['design'][$type]['photo2'] == true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Hình ảnh <?=isset($config['design'][$type]['title_photo2']) ?$config['design'][$type]['title_photo2']: ++$count_other_photo?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
	                    	<?php
	                    		$photoDetail = ($act != 'copy') ? UPLOAD_DESIGN.@$item['photo2'] : '';
	                    		$dimension = "Width: ".$config['design'][$type]['width']." px - Height: ".$config['design'][$type]['height']." px (".$config['design'][$type]['img_type'].")";
	                    		$image_target="photo2";
	                    		$image_target_arr[]=$image_target;
	                    		include TEMPLATE.LAYOUT."image_other.php";
	                    	?>
			            </div>
			        </div>
		        <?php } ?>
				
				<?php if(isset($config['design'][$type]['photo3']) && $config['design'][$type]['photo3'] == true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Hình ảnh <?=isset($config['design'][$type]['title_photo3']) ?$config['design'][$type]['title_photo3']: ++$count_other_photo?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
	                    	<?php
	                    		$photoDetail = ($act != 'copy') ? UPLOAD_DESIGN.@$item['photo3'] : '';
	                    		$dimension = "Width: ".$config['design'][$type]['width']." px - Height: ".$config['design'][$type]['height']." px (".$config['design'][$type]['img_type'].")";
	                    		$image_target="photo3";
	                    		$image_target_arr[]=$image_target;
	                    		include TEMPLATE.LAYOUT."image_other.php";
	                    	?>
			            </div>
			        </div>
		        <?php } ?>

		        <?php if(isset($config['design'][$type]['photo4']) && $config['design'][$type]['photo4'] == true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Hình ảnh <?=isset($config['design'][$type]['title_photo4']) ?$config['design'][$type]['title_photo4']: ++$count_other_photo?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
	                    	<?php
	                    		$photoDetail = ($act != 'copy') ? UPLOAD_DESIGN.@$item['photo4'] : '';
	                    		$dimension = "Width: ".$config['design'][$type]['width']." px - Height: ".$config['design'][$type]['height']." px (".$config['design'][$type]['img_type'].")";
	                    		$image_target="photo4";
	                    		$image_target_arr[]=$image_target;
	                    		include TEMPLATE.LAYOUT."image_other.php";
	                    	?>
			            </div>
			        </div>
		        <?php } ?>
	        </div>
	    </div>
	    <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin <?=$config['design'][$type]['title_main']?></h3>
                <div class="card-tools">
                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
				<div class="form-group">
                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                        <label for="hienthi-checkbox" class="custom-control-label"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                </div>
                <div class="row">
	                <?php if(isset($config['design'][$type]['ma']) && $config['design'][$type]['ma'] == true) { ?>
	                    <div class="form-group col-md-4">
	                        <label class="d-block" for="masp">Mã sản phẩm:</label>
	                        <input type="text" class="form-control" name="data[masp]" id="masp" placeholder="Mã sản phẩm" value="<?=@$item['masp']?>">
	                    </div>
	                <?php } ?>
					<?php if(isset($config['design'][$type]['gia']) && $config['design'][$type]['gia'] == true) { ?>
				    	<div class="form-group col-md-4">
	                        <label class="d-block" for="gia">Giá bán:</label>
	                        <div class="input-group">
	                        	<input type="text" class="form-control format-price gia_ban" name="data[gia]" id="gia" placeholder="Giá bán" value="<?=@$item['gia']?>">
	                        	<div class="input-group-append">
	                        		<div class="input-group-text"><strong>VNĐ</strong></div>
	                        	</div>
	                        </div>
	                    </div>
				    <?php } ?>
				    <?php if(isset($config['design'][$type]['giamoi']) && $config['design'][$type]['giamoi'] == true) { ?>
				    	<div class="form-group col-md-4">
	                        <label class="d-block" for="giamoi">Giá mới:</label>
	                        <div class="input-group">
	                        	<input type="text" class="form-control format-price gia_moi" name="data[giamoi]" id="giamoi" placeholder="Giá mới" value="<?=@$item['giamoi']?>">
	                        	<div class="input-group-append">
	                        		<div class="input-group-text"><strong>VNĐ</strong></div>
	                        	</div>
	                        </div>
	                    </div>
				    <?php } ?>
				    <?php if(isset($config['design'][$type]['giakm']) && $config['design'][$type]['giakm'] == true) { ?>
				    	<div class="form-group col-md-4">
	                        <label class="d-block" for="giakm">Chiết khấu:</label>
	                        <div class="input-group">
	                        	<input type="text" class="form-control gia_km" name="data[giakm]" id="giakm" placeholder="Chiết khấu" value="<?=@$item['giakm']?>" maxlength="3" readonly>
	                        	<div class="input-group-append">
	                        		<div class="input-group-text"><strong>%</strong></div>
	                        	</div>
	                        </div>
	                    </div>
				    <?php } ?>
				</div>
            </div>
        </div>
        <?php if(isset($flagGallery) && $flagGallery == true) { ?>
        	<div class="card card-primary card-outline text-sm">
        		<div class="card-header">
        			<h3 class="card-title">Bộ sưu tập <?=$config['design'][$type]['title_main']?></h3>
        			<div class="card-tools">
        				<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        			</div>
        		</div>
        		<div class="card-body">
        			<div class="form-group">
        				<label for="filer-gallery" class="label-filer-gallery mb-3">Album hình: (<?=$config['design'][$type]['gallery'][$key]['img_type_photo']?>)</label>
        				<input type="file" name="files[]" id="filer-gallery" multiple="multiple">
        				<input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
        				<input type="hidden" class="act-filer" value="man">
        				<input type="hidden" class="folder-filer" value="design">
        			</div>
        			<?php if(isset($gallery) && count($gallery) > 0) { ?>
        				<div class="form-group form-group-gallery">
        					<label class="label-filer">Album hiện tại:</label>
        					<div class="action-filer mb-3">
        						<a class="btn btn-sm bg-gradient-primary text-white check-all-filer mr-1"><i class="far fa-square mr-2"></i>Chọn tất cả</a>
        						<button type="button" class="btn btn-sm bg-gradient-success text-white sort-filer mr-1"><i class="fas fa-random mr-2"></i>Sắp xếp</button>
        						<a class="btn btn-sm bg-gradient-danger text-white delete-all-filer"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        					</div>
        					<div class="alert my-alert alert-sort-filer alert-info text-sm text-white bg-gradient-info"><i class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>
        					<div class="jFiler-items my-jFiler-items jFiler-row">
        						<ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
        							<?php foreach($gallery as $v) echo $func->galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenvi'],'design','col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6'); ?>
        						</ul>
        					</div>
        				</div>
        			<?php } ?>
        		</div>
        	</div>
        <?php } ?>
        <?php if(isset($config['design'][$type]['seo']) && $config['design'][$type]['seo'] == true) { ?>
			<div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Nội dung SEO</h3>
	                <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
	            </div>
	            <div class="card-body">
                    <?php
                    	$seoDB = $seo->getSeoDB($id,$com,'man',$type);
                    	include TEMPLATE.LAYOUT."seo.php";
                    ?>
	            </div>
	        </div>
	    <?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>

<?php if(isset($config['design'][$type]['giakm']) && $config['design'][$type]['giakm'] == true) { ?>
	<script type="text/javascript">
		function roundNumber(rnum, rlength)
		{
			return Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);
		}
		$(document).ready(function(){

			$(".gia_ban, .gia_moi").keyup(function(){
				var gia_ban = $('.gia_ban').val();
				var gia_moi = $('.gia_moi').val();
				var gia_km = 0;

				if(gia_ban=='' || gia_ban=='0' || gia_moi=='' || gia_moi=='0')
				{
					gia_km=0;
				}
				else
				{
					gia_ban = gia_ban.replace(/,/g,"");
					gia_moi = gia_moi.replace(/,/g,"");
					gia_ban = parseInt(gia_ban);
					gia_moi = parseInt(gia_moi);

					if(gia_moi < gia_ban)
					{
						gia_km = 100-((gia_moi * 100) / gia_ban);
						gia_km = roundNumber(gia_km,0);
					}
					else
					{
						gia_km=0;
					}
				}
				$('.gia_km').val(gia_km);
			})
		})
	</script>
<?php } ?>