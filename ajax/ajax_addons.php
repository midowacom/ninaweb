<?php
include "ajax_config.php";

$sqlCache = "select * from #_setting";
$setting = $cache->getCache($sqlCache,'fetch',7200);
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;
$type = (isset($_GET["type"])) ? htmlspecialchars($_GET["type"]) : '';
?>
<?php if($type == 'video-fotorama') {
	$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and noibat > 0 and hienthi > 0 order by stt, id desc",array('video','photo_static')); if(count($videonb)) { ?>
		<!-- Video Fotorama -->
		<div id="fotorama-videos" data-width="100%" data-thumbmargin="5" data-height="320" data-fit="cover" data-thumbwidth="100" data-thumbheight="85" data-allowfullscreen="false" data-nav="thumbs" data-navposition="right">
			<?php for($i=0;$i<count($videonb);$i++) { ?>
				<a href="https://youtube.com/watch?v=<?=$func->getYoutube($videonb[$i]['link_video'])?>" title="<?=$videonb[$i]['ten'.$lang]?>"></a>
			<?php } ?>
		</div>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#fotorama-videos").fotorama();
			});
		</script>
	<?php } } ?>

	<?php if($type == 'video-select') {
		$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and noibat > 0 and hienthi > 0 order by stt, id desc",array('video','photo_static')); if(count($videonb)) { ?>
			<!-- Video Select -->
			<div class="d-form">
				<div class="video-main">
					<iframe width="100%" height="380" src="//www.youtube.com/embed/<?=$func->getYoutube($videonb[0]['link_video'])?>" frameborder="0" allowfullscreen></iframe>
				</div>
				<select class="listvideos uk-select">
					<?php for($i=0; $i<count($videonb); $i++) {?>
						<option value="<?=$videonb[$i]['id']?>"><?=$videonb[$i]['ten'.$lang]?></option>
					<?php } ?>
				</select>
			</div>
			<script type="text/javascript">
				$(document).ready(function()
				{
					$('.listvideos').change(function() 
					{
						var id = $(this).val();
						$.ajax({
							url:'ajax/ajax_video.php',
							type: "POST",
							dataType: 'html',
							data: {id:id},
							success: function(result){
								$('.video-main').html(result);
							}
						});
					});
				});
			</script>
		<?php } } ?>

		<?php if($type == 'footer-map') {
			/* Map Footer */
			echo htmlspecialchars_decode($optsetting['toado_iframe']);
		} ?>

		<?php if($type == 'fanpage-facebook') { ?>
			<!-- Fanpage -->
			<div class="fb-page" 
			data-href="<?=$optsetting['fanpage']?>" 
			data-tabs="timeline" 
			data-width="500" 
			data-height="430" 
			data-small-header="true" 
			data-adapt-container-width="true" 
			data-hide-cover="false" data-show-facepile="true">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="<?=$optsetting['fanpage']?>">
					<a href="<?=$optsetting['fanpage']?>">Facebook</a>
				</blockquote>
			</div>
		</div>
	<?php } ?>

	<?php if($type == 'messages-facebook') { ?>
		<!-- Chat Messenger 2 -->
		<div class="js-facebook-messenger-box onApp rotate bottom-right cfm rubberBand animated" data-anim="rubberBand">
			<svg id="fb-msng-icon" data-name="messenger icon" xmlns="//www.w3.org/2000/svg" viewBox="0 0 30.47 30.66"><path d="M29.56,14.34c-8.41,0-15.23,6.35-15.23,14.19A13.83,13.83,0,0,0,20,39.59V45l5.19-2.86a16.27,16.27,0,0,0,4.37.59c8.41,0,15.23-6.35,15.23-14.19S38,14.34,29.56,14.34Zm1.51,19.11-3.88-4.16-7.57,4.16,8.33-8.89,4,4.16,7.48-4.16Z" transform="translate(-14.32 -14.34)" style="fill:#fff"></path></svg>
			<svg id="close-icon" data-name="close icon" xmlns="//www.w3.org/2000/svg" viewBox="0 0 39.98 39.99"><path d="M48.88,11.14a3.87,3.87,0,0,0-5.44,0L30,24.58,16.58,11.14a3.84,3.84,0,1,0-5.44,5.44L24.58,30,11.14,43.45a3.87,3.87,0,0,0,0,5.44,3.84,3.84,0,0,0,5.44,0L30,35.45,43.45,48.88a3.84,3.84,0,0,0,5.44,0,3.87,3.87,0,0,0,0-5.44L35.45,30,48.88,16.58A3.87,3.87,0,0,0,48.88,11.14Z" transform="translate(-10.02 -10.02)" style="fill:#fff"></path></svg>
		</div>
		<div class="js-facebook-messenger-container">
			<div class="js-facebook-messenger-top-header">
				<span><?=$setting['ten'.$lang]?></span>
			</div>
			<div class="fb-page" data-href="<?=$optsetting['fanpage']?>" data-tabs="messages" data-small-header="true" data-height="300" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$optsetting['fanpage']?>" class="fb-xfbml-parse-ignore"><a href="<?=$optsetting['fanpage']?>">Facebook</a></blockquote></div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".js-facebook-messenger-box").on("click", function(){
					$(".js-facebook-messenger-box, .js-facebook-messenger-container").toggleClass("open"), $(".js-facebook-messenger-tooltip").length && $(".js-facebook-messenger-tooltip").toggle()
				}), $(".js-facebook-messenger-box").hasClass("cfm") && setTimeout(function(){
					$(".js-facebook-messenger-box").addClass("rubberBand animated")
				}, 3500), $(".js-facebook-messenger-tooltip").length && ($(".js-facebook-messenger-tooltip").hasClass("fixed") ? $(".js-facebook-messenger-tooltip").show() : $(".js-facebook-messenger-box").on("hover", function(){
					$(".js-facebook-messenger-tooltip").show()
				}), $(".js-facebook-messenger-close-tooltip").on("click", function(){
					$(".js-facebook-messenger-tooltip").addClass("closed")
				}))
				$(".search_open").click(function(){
					$(".search_box_hide").toggleClass('opening');
				});
			});
		</script>
	<?php } ?>

	<?php if($type == 'script-main') { ?>
		<!-- SDK Facebook -->
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="vYFN8dej"></script>
		<!-- Like Share -->
		<script src="//sp.zalo.me/plugins/sdk.js"></script>
		<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>
		<script type="text/javascript">
			var addthis_config = addthis_config||{};
			addthis_config.lang = 'vi'
		</script>
	<?php } ?>
	<?php if($type=='phone-fixed'){ ?>
		<a class="ictbtn btn-fixed" id="btn-chat-phone" target="_blank" href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>">
			<div class="animated infinite zoomIn chat-facebook"></div>
			<div class="animated infinite pulse chat-facebook-fill"></div>
			<span class="wrapper">
				<span class="content bg">
					<i class="fas fa-phone-alt"></i>
					<span class="rp-label">Call</span>
				</span>
			</span>
		</a>
	<?php } ?>

	<?php if($type=='zalo-fixed'){ ?>
		<a class="ictbtn btn-fixed" id="btn-chat-zalo" target="_blank" href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$optsetting['zalo']);?>">
			<div class="animated infinite zoomIn chat-facebook"></div>
			<div class="animated infinite pulse chat-facebook-fill"></div>
			<span class="wrapper">
				<span class="content">
					<img class="icon-size" src="assets/images/default/zalo_icon.png" alt="zalo" />
					<span class="rp-label">Zalo</span>
				</span>
			</span>
		</a>
	<?php } ?>
	<?php if($type=='facebook-fixed'){ ?>
		<div class="ictbtn btn-fixed btn-chat-facebook" id="btn-chat-facebook">
			<div class="animated infinite zoomIn chat-facebook"></div>
			<div class="animated infinite pulse chat-facebook-fill"></div>
			<span class="wrapper">
				<img class="icon-size" src="assets/images/default/facebook_icon.png" alt="facebook">
				<span class="rp-label">Facebook</span>
			</span>
		</div>
		<div id="khungchatn">
			<div class='fb-page chat-item' data-adapt-container-width='true' data-height='300' data-hide-cover='false' data-href='<?=$optsetting['fanpage']?>' data-show-facepile='true' data-show-posts='false' data-small-header='false' data-tabs='messages' data-width='300'></div>
		</div>
		<script>
			$(document).ready(function(){
				$('.btn-chat-facebook').click(function(){
					$('#khungchatn').toggle(300);
				});
			});
		</script>
	<?php } ?>

	<?php if($type=='cart-fixed'){ ?>
		<span class="ictbtn btn-fixed btn_open_slideout" id="btn-chat-phone">
			<div class="animated infinite zoomIn chat-facebook"></div>
			<div class="animated infinite pulse chat-facebook-fill"></div>
			<span class="wrapper">
				<span class="content bg">
					<i class="icon cart"></i>
					<span class="rp-label">Cart</span>
					<span class="count-cart"><?=(isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0?></span>
				</span>
			</span>
		</span>
	<?php } ?>
	<?php if($type=='btn-backtotop'){ ?>
		<div class="scrollToTop"><img src="assets/images/default/top.png" alt="Go Top"></div>
	<?php } ?>

