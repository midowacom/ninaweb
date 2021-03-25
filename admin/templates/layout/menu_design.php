<!-- Design -->
<?php if(isset($config['design'])) { ?>
    <?php foreach($config['design'] as $k => $v) { if(!isset($disabled['design'][$k])) { ?>
        <?php
        $none = "";
        $active = "";
        $menuopen = "";

        if((($com=='design') || ($com=='import') || ($com=='export')) && ($k==$_GET['type']))
        {
            $active = 'active';
            $menuopen = 'menu-open';
        }
        ?>
        <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
            <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                <i class="nav-icon text-sm fas fa-boxes"></i>
                <p>
                    Quản lý <?=$v['title_main']?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if(!empty($v['dropdown'])) { if(isset($v['list']) && $v['list'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_list&type=<?=$k?>" title="Danh mục cấp 1"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục cấp 1</p></a></li>
                <?php } ?>
                <?php if(isset($v['cat']) && $v['cat'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_cat&type=<?=$k?>" title="Danh mục cấp 2"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục cấp 2</p></a></li>
                <?php } ?>
                <?php if(isset($v['item']) && $v['item'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_item&type=<?=$k?>" title="Danh mục cấp 3"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục cấp 3</p></a></li>
                <?php } ?>
                <?php if(isset($v['sub']) && $v['sub'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_sub' || $act=='add_sub' || $act=='edit_sub' || $kind=='man_sub') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_sub&type=<?=$k?>" title="Danh mục cấp 4"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục cấp 4</p></a></li>
                <?php } } ?>
                <?php if(isset($v['brand']) && $v['brand'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_brand' || $act=='add_brand' || $act=='edit_brand') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_brand&type=<?=$k?>" title="Danh mục hãng"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục <?=$v['title_main_brand']?></p></a></li>
                <?php } ?>

                <?php if(isset($v['material']) && $v['material'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_material', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_material' || $act=='add_material' || $act=='edit_material') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_material&type=<?=$k?>" title="Danh mục chất liệu"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục <?=$v['title_main_material']?></p></a></li>
                <?php } ?>

                <?php if(isset($v['mau']) && $v['mau'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_mau', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_mau' || $act=='add_mau' || $act=='edit_mau') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_mau&type=<?=$k?>" title="Danh mục màu sắc"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục màu sắc</p></a></li>
                <?php } ?>
                <?php if(isset($v['size']) && $v['size'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_size', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_size' || $act=='add_size' || $act=='edit_size') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_size&type=<?=$k?>" title="Danh mục kích thước"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục kích thước</p></a></li>
                <?php } ?>
                <?php if(isset($v['price']) && $v['price'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man_price', $k, null, 'phrase-1')) $none = "d-none";
                    if($com=='design' && ($act=='man_price' || $act=='add_price' || $act=='edit_price') && $k==$_GET['type']) $active = "active"; ?>
                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man_price&type=<?=$k?>" title="Danh mục khoảng giá"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Danh mục khoảng giá</p></a></li>
                <?php } ?>

                <?php
                $none = "";
                $active = "";
                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man', $k, null, 'phrase-1')) $none = "d-none";
                if($com=='design' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                ?>
                <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=design&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm far fa-caret-square-right"></i><p><?=$v['title_main']?></p></a></li>
                <?php if(isset($v['import']) && $v['import'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
                    if(($com=='import') && ($k==$_GET['type'])) $active = "active"; ?>
                    <li class="nav-item <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=import&act=man&type=<?=$k?>" title="Import"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Import</p></a>
                    </li>
                <?php } ?>
                <?php if(isset($v['export']) && $v['export'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                    if(($com=='export') && ($act=='man') && ($k==$_GET['type'])) $active = "active"; ?>
                    <li class="nav-item <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=export&act=man&type=<?=$k?>" title="Export"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Export</p></a>
                    </li>
                <?php } ?>
                <?php if(isset($v['logo_design']) && $v['logo_design'] == true) {
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('design', 'man', $k, null, 'phrase-1')) $none = "d-none";
                    if(($com=='design') && ($act=='man') && ($k==$_GET['type'])) $active = "active"; ?>
                    <li class="nav-item <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=design&act=man_logo&type=<?=$k?>" title="Export"><i class="nav-icon text-sm far fa-caret-square-right"></i><p>Export</p></a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } } ?>
    <?php } ?>