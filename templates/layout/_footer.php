<div id="mdw-footer">
    <div class="mdw-footer">
        <div class="container">
            <div class="ft-1">
                <div class="mb-3 ft-title"><?=$setting["ten$lang"]?></div>
                <div class="ft-info">
                    <div class="d-flex flex-wrap w-100 mb-3 delay-3">
                        <span class="icon marker"></span>
                        <span class="d-flex fill ml-3">
                            <span class="label">Địa chỉ: </span>
                            <span class="value ml-2 fill"><?=$optsetting["diachi"]?></span>
                        </span>
                    </div>
                    <div class="d-flex flex-wrap w-100 mb-3 delay-4">
                        <span class="icon hotline"></span>
                        <span class="d-flex fill ml-3">
                            <span class="label">Hotline: </span>
                            <span class="value ml-2 fill"><?=$optsetting["hotline"]?></span>
                        </span>
                    </div>
                    <div class="d-flex flex-wrap w-100 mb-3 delay-5">
                        <span class="icon email"></span>
                        <span class="d-flex fill ml-3">
                            <span class="label">Email: </span>
                            <span class="value ml-2 fill"><?=$optsetting["email"]?></span>
                        </span>
                    </div>

                    <div class="d-flex flex-wrap w-100 mb-3 delay-5">
                        <span class="icon global"></span>
                        <span class="d-flex fill ml-3">
                            <span class="label">Website: </span>
                            <span class="value ml-2 fill"><?=$optsetting["website"]?></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="ft-2">
                <h2 class="title mb-3">CHÍNH SÁCH HỖ TRỢ</h2>
                <ul class="ft-list">
                    <?php foreach($cs as $item){
                        $sn_link = isset($item[$sluglang])?$item[$sluglang]:'';
                        ?>
                        <li class="mb-2">
                            <a href="<?=$sn_link?>"><?=$item["ten$lang"]?></a>
                        </li>
                    <?php } ?>
                </ul class="ft-list">
            </div>
            <div class="ft-3">
                <div>
                  <?php  //echo $addons->setAddons('footer-map', 'footer-map', 10);?>
                  <?php echo $addons->setAddons('fanpage-facebook', 'fanpage-facebook', 5);?>
              </div>
          </div>
      </div>

  </div>

</div>
<div id="mdw-copyright">
   <div class="container">
    <span class="copyright">2021 Copyright <?=$setting["ten$lang"]?>. Design by Nina.vn</span>
</div>
</div>
<div class="right_fix">
    <?php // $addons->setAddons('cart-fixed', 'cart-fixed', 5);?>
    <?php // $addons->setAddons('phone-fixed', 'phone-fixed', 5);?>
    <?php echo $addons->setAddons('zalo-fixed', 'zalo-fixed', 5);?>
    <?php echo $addons->setAddons('facebook-fixed', 'facebook-fixed', 5);?>
    <?php //$addons->setAddons(' fanpage-facebook', ' fanpage-facebook', 5);?>
</div>

<button type="button" class="btn btn-primary open-modal-cart btn-datlich" data-toggle="modal" data-target=".exampleModal">
    Đặt lịch
</button>
<div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <form class="form-newsletter validation-newsletter gutters-10" method="post" action="newsletter" enctype="multipart/form-data" id="index-newsletter">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Đăng ký đặt lịch</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="w-100">
                        <input type="text" class="input-control" id="name-newsletter" name="name-newsletter" placeholder="<?=nhaphoten?>" required />
                        <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
                    </div>
                    <div class="w-100">
                        <input type="email" class="input-control" id="email-newsletter" name="email-newsletter" placeholder="Email" required />
                        <div class="invalid-feedback">Vui Lòng nhập email</div>
                    </div>

                    <div class="w-100">
                        <input type="phone" class="input-control" id="phone-newsletter" name="phone-newsletter" placeholder="<?=sodienthoai?>" />
                    </div>
                    <div class="w-100">
                        <textarea type="text" class="input-control" id="noidung-newsletter" name="noidung-newsletter" placeholder="Nội dung"/></textarea>
                    </div>
                </div>
                <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
                
            </div>
            <div class="modal-footer">
                <input type="submit" name="submit-newsletter" class="submit-newsletter" value="ĐĂNG KÝ NGAY" >
            </div>
        </form>
    </div>
</div>
</div>