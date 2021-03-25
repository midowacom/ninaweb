<div id="menu">
    <div class="container d-flex jc-between ai-center">
        <a href="#menu_responsive" id="menu_responsive_btn"><span class="icon bar"></span></a>
        <ul class="menu-ul fill d-flex align-items-center mb-0">
            <li class="menu <?php if($com=='index') echo 'active'; ?>">
                <a href="" class="inherit-text" title="trang chủ"><span>Trang Chủ</span></a>
            </li>
            <span class="slice"></span>
            <li class="menu <?php if($com=='gioi-thieu') echo 'active'; ?>">
                <a href="gioi-thieu" class="inherit-text" title="Giới Thiệu"><span>Giới Thiệu</span></a>
            </li>

            <li class="menu <?php if($com=='dich-vu') echo 'active'; ?>">
                <a href="dich-vu" class="inherit-text" title="Giới Thiệu"><span>Dịch Vụ</span></a>
            </li>
            <li class="menu <?php if($com=='dao-tao') echo 'active'; ?>">
                <a href="dao-tao" class="inherit-text" title="Đào Tạo"><span>Đào Tạo</span></a>
            </li>

            <span class="slice"></span>
            <li class="menu <?php if($com=='san-pham') echo 'active'; ?>">
                <a href="san-pham" class="inherit-text" title="Sản phẩm"><span>Sản Phẩm</span></a>
                <?php if(!empty($index_product_list)){ ?>
                    <ul class="vertical-menu-content sub-nav-ul">
                        <?php foreach($index_product_list as $list){ ?>
                            <li class="menu">
                                <a href="<?=$list[$sluglang]?>" class="inherit-text" title="<?=$list["ten$lang"]?>">
                                    <span class="mmtt"><?=$list["ten$lang"]?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>

            <span class="slice"></span>
            <li class="menu <?php if($com=='tin-tuc') echo 'active'; ?>">
                <a href="tin-tuc" class="inherit-text" title="Tin Tức"><span>Tin Tức</span></a>
            </li>
            <span class="slice"></span>
            <li class="menu <?php if($com=='lien-he') echo 'active'; ?>">
                <a href="lien-he" class="inherit-text" title="Liên Hệ"><span>Liên Hệ</span></a>
            </li>
        
    </ul>
    <div id="timkiem_icon" class="d-inline-flex align-items-center">
        <div class="timkiem_icon">
            <a href="javascript:void(0);" class="search meun-text">
                <span>
                    <img src="assets/images/timkiem_icon.png">
                </span>
            </a>
        </div>
        <div class="search-form" style="width: 0px; opacity: 0;">
            <div class="form-row-search">
                <form action="" method="GET" name="frm_search" id="frm_search" onsubmit="return false;">
                    <input id="keyword_2" name="keyword" type="text" class="search-field" placeholder="Nhập tên cần tìm kiếm...">
                    <input id="defaultvalue" type="hidden" class="search-field" value="Tìm nhanh...">
                    <input type="hidden" id="href_search" value="http://<?=$config_url?>tim-kiem" />
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<div id="menu_responsive">
    <ul>
        <li>
            <a href=""  title="trang chủ"><span class="text-uppercase">Trang Chủ</span></a>
        </li>
        <li>
            <a href="gioi-thieu" title="Giới Thiệu"><span class="text-uppercase">Về Chúng Tôi</span></a>
        </li>
        <li>
            <a href="san-pham" class="inherit-text" title="Sản phẩm"><span class="text-uppercase">Sản Phẩm Chính</span></a>
            <?php if(!empty($index_product_list)){ ?>
                <ul>
                    <?php foreach($index_product_list as $list){ ?>
                        <li>
                            <a href="<?=$list[$sluglang]?>" title="<?=$list["ten$lang"]?>">
                                <span class="mmtt"><?=$list["ten$lang"]?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>


        <li class="<?php if($com=='chinh-sach') echo 'active'; ?>">
            <a href="chinh-sach" class="inherit-text" title="Chính Sách"><span class="text-uppercase">Chính Sách</span></a>

        </li>
        <li class="<?php if($com=='bao-gia') echo 'active'; ?>">
            <a href="bao-gia" class="inherit-text" title="Báo Giá"><span class="text-uppercase">Báo Giá</span></a>
        </li>

        <li class="<?php if($com=='tin-tuc') echo 'active'; ?>">
            <a href="tin-tuc" class="inherit-text" title="Tin Tức"><span class="text-uppercase">Tin Tức</span></a>
        </li>
        
        <li class="<?php if($com=='lien-he') echo 'active'; ?>">
            <a href="lien-he" class="inherit-text" title="Liên Hệ"><span class="text-uppercase">Liên Hệ</span></a>
        </li>
    </ul>
</div>