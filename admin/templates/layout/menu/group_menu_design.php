<?php
$design_type = array_keys($config['design']);
// Check dropdown
$menu_not_dropdown= array();

foreach($design_type as $_type){
	if(!isset($config['design'][$_type]['dropdown']) && $config['design'][$_type]['dropdown'] == false){
		$menu_not_dropdown[] = $_type;
	}
}
foreach($config['design'] as $k => $v){

if(isset($v['dropdown']) && $v['dropdown']==true){
	$menu_title_man = $v['title_man'];
}
?>
<li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
	<a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$menu_title_man?>">
		<i class="nav-icon text-sm fas fa-boxes"></i>
		<p>
			Quản lý <?=$menu_title_man?>
			<i class="right fas fa-angle-left"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<?php
		$none = "";
		$active = "";
		if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man', $k, null, 'phrase-1')) $none = "d-none";
		if($com=='design' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
		?>
		<li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm far fa-caret-square-right"></i><p><?=$v['title_main']?></p></a></li>
	</ul>
</li>
<?php } ?>	