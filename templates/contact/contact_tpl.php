<div class="mw wrap">
    <?=$func->title_main($title_crumb)?>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="article-contact"><?=(isset($lienhe['noidung'.$lang]) && $lienhe['noidung'.$lang] != '') ? htmlspecialchars_decode($lienhe['noidung'.$lang]) : ''?></div>
        </div>
        <div class="col-lg-6 col-12">
        <form class="form-contact validation-contact" method="post" action="" enctype="multipart/form-data">
            <div class="uk-margin">
                <input class="uk-input" type="text" id="ten" name="ten" placeholder="<?=hoten?>" required />
            </div>
            <div class="uk-margin">    
                <input class="uk-input" type="number" id="dienthoai" name="dienthoai" placeholder="<?=sodienthoai?>" required />
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" id="diachi" name="diachi" placeholder="<?=diachi?>" required />
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="email" id="email" name="email" placeholder="Email" required />
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" id="tieude" name="tieude" placeholder="<?=chude?>" required />
            </div>
            <div class="uk-margin">
                <textarea class="uk-textarea" id="noidung" name="noidung" placeholder="<?=noidung?>" required /></textarea>
            </div>
            <div class=" uk-form-custom">
                <input type="file" class="custom-file-input" name="file">
                <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
            </div>
            <div class="uk-margin">
                 <input type="submit" class="uk-button uk-button-danger" name="submit-contact" value="<?=gui?>" />
            <input type="reset"value="<?=nhaplai?>" class="uk-button uk-button-dark"/>
            </div>
           
            <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
        </form>
        </div>
    </div>
    <div class="bottom-contact uk-margin"><?=htmlspecialchars_decode($optsetting['toado_iframe'])?></div>
</div>