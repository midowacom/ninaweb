<?php
	$item_designs_category = $d->rawQuery("select * from #_design_list where type='thiet-ke' and hienthi=1");

	$item_designs = $d->rawQuery("select * from #_design where type='thiet-ke' and hienthi=1");
	$func->dump($item_designs);
	$array_design = array();
	foreach ($item_designs as $k => $v) {
		$array_design[$k][0]['title'] = 'Mặt trước';
		$array_design[$k][0]['thumbnail'] = $config_base.UPLOAD_DESIGN_L.$v['photo'];
		$array_design[$k][0]['elements'][0]['type'] = 'image';
		$array_design[$k][0]['elements'][0]['source'] = $config_base.UPLOAD_DESIGN_L.$v['photo'];
		$array_design[$k][0]['elements'][0]['title'] = 'Mặt trước';
		$array_design[$k][0]['elements'][0]['parameters']['left'] = $v['left_i'];
		$array_design[$k][0]['elements'][0]['parameters']['top'] = $v['top_i'];
		$array_design[$k][0]['elements'][0]['parameters']['colors'] = "#d59211";
		$array_design[$k][0]['elements'][0]['parameters']['price'] = (int)$v['giaban'];
		$array_design[$k][0]['elements'][0]['parameters']['colorLinkGroup'] = "Base";
		$array_design[$k][0]['elements'][0]['parameters']['fill'] = false;
		
		$array_design[$k][1]['title'] = 'Mặt sau';
		$array_design[$k][1]['thumbnail'] = $config_base.UPLOAD_DESIGN_L.$v['photo2'];
		$array_design[$k][1]['elements'][0]['type'] = 'image';
		$array_design[$k][1]['elements'][0]['source'] = $config_base.UPLOAD_DESIGN_L.$v['photo2'];
		$array_design[$k][1]['elements'][0]['title'] = 'Mặt sau';
		$array_design[$k][1]['elements'][0]['parameters']['left'] = $v['left_i'];
		$array_design[$k][1]['elements'][0]['parameters']['top'] = $v['top_i'];
		$array_design[$k][1]['elements'][0]['parameters']['colors'] = "#d59211";
		$array_design[$k][1]['elements'][0]['parameters']['price'] = 0;
		$array_design[$k][1]['elements'][0]['parameters']['colorLinkGroup'] = "Base";
		$array_design[$k][1]['elements'][0]['parameters']['fill'] = false;
		if($v['photo2']!=''){
			$array_design[$k][2]['title'] = 'Vai trái';
			$array_design[$k][2]['thumbnail'] = $config_base.UPLOAD_DESIGN_L.$v['photo3'];
			$array_design[$k][2]['elements'][0]['type'] = 'image';
			$array_design[$k][2]['elements'][0]['source'] = $config_base.UPLOAD_DESIGN_L.$v['photo3'];
			$array_design[$k][2]['elements'][0]['title'] = 'Vai trái';
			$array_design[$k][2]['elements'][0]['parameters']['left'] = $v['left_i'];
			$array_design[$k][2]['elements'][0]['parameters']['top'] = $v['top_i'];
			$array_design[$k][2]['elements'][0]['parameters']['colors'] = "#d59211";
			$array_design[$k][2]['elements'][0]['parameters']['price'] = 0;
			$array_design[$k][2]['elements'][0]['parameters']['colorLinkGroup'] = "Base";
			$array_design[$k][2]['elements'][0]['parameters']['fill'] = false;
		}
		if($v['photo3']!=''){
			$array_design[$k][3]['title'] = 'Vai phải';
			$array_design[$k][3]['thumbnail'] = $config_base.UPLOAD_DESIGN_L.$v['photo4'];
			$array_design[$k][3]['elements'][0]['type'] = 'image';
			$array_design[$k][3]['elements'][0]['source'] = $config_base.UPLOAD_DESIGN_L.$v['photo4'];
			$array_design[$k][3]['elements'][0]['title'] = 'Vai phải';
			$array_design[$k][3]['elements'][0]['parameters']['left'] = $v['left_i'];
			$array_design[$k][3]['elements'][0]['parameters']['top'] = $v['top_i'];
			$array_design[$k][3]['elements'][0]['parameters']['colors'] = "#d59211";
			$array_design[$k][3]['elements'][0]['parameters']['price'] = 0;
			$array_design[$k][3]['elements'][0]['parameters']['colorLinkGroup'] = "Base";
			$array_design[$k][3]['elements'][0]['parameters']['fill'] = false;
		}
	}
	
	$design_json = json_encode($array_design,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	file_put_contents("json/products.json", $design_json);




	$item_colors = $d->rawQuery("select * from #_design where type='logo' and hienthi=1");
	$array_color = array();

	foreach ($item_colors as $k => $v) {
		$array_color[$k]['source'] = $config_base.UPLOAD_DESIGN_L.$v['thumb'];
		$array_color[$k]['title'] = $v['ten_vi'];
		$array_color[$k]['parameters']['zChangeable'] = true;
		$array_color[$k]['parameters']['left'] =215;
		$array_color[$k]['parameters']['top'] = 215;
		$array_color[$k]['parameters']['removable'] = true;
		$array_color[$k]['parameters']['draggable'] = true;
		$array_color[$k]['parameters']['rotatable'] = true;
		$array_color[$k]['parameters']['resizable'] = true;
		$array_color[$k]['parameters']['boundingBox'] = "Base";
		$array_color[$k]['parameters']['autoCenter'] = true;
		$array_color[$k]['parameters']['price'] = (int)$v['giaban'];
	}
	
	$color_json = json_encode($array_color,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	file_put_contents("json/designs.json", $color_json);
