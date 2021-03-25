$.fn.exists = function(){
	return this.length;
};
if($(".newshome-scroll ul").exists())
{
	$(".newshome-scroll ul").simplyScroll({
		customClass: 'vert',
		orientation: 'vertical',
            // orientation: 'horizontal',
            auto: true,
            manualMode: 'auto',
            pauseOnHover: 1,
            speed: 1,
            loop: 0
        });
}
if ($("#index-slider-doitac").exists()) {
	var index_slider_doitac_options = {
		loop: false,
		pagination: {
			el: '#index-slider-doitac .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '#index-slider-doitac .swiper-button-next',
			prevEl: '#index-slider-doitac .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			319: {
				slidesPerView: 3,
				spaceBetween: 1,
			},
			768: {
				slidesPerView: 4,
				spaceBetween: 1,
			},
			991: {
				slidesPerView: 5,
				spaceBetween: 1,
			},
			1229: {
				slidesPerView: 7,
				spaceBetween: 1,
			},
		}
	};
	
};
if ($("#index-slider-tintuc").exists()) {
	var index_slider_tintuc_options = {
		loop: false,
		pagination: {
			el: '#index-slider-tintuc .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '#index-slider-tintuc .swiper-button-next',
			prevEl: '#index-slider-tintuc .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			480: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
		}
	};
};

if ($("#index-slider-khachhang").exists()) {
	var index_slider_tintuc_options = {
		loop: false,
		pagination: {
			el: '#index-slider-khachhang .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '#index-slider-khachhang .swiper-button-next',
			prevEl: '#index-slider-khachhang .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			480: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
		}
	};
};	
if ($(".list_video_vertical").exists()) {
	var list_video_vertical_options = {
		
		
		pagination: {
			el: '.list_video_vertical .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.list_video_vertical .swiper-button-next',
			prevEl: '.list_video_vertical .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			480: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 10,
				direction: 'vertical',
			},
			1024: {
				slidesPerView: 3,
				direction: 'vertical',
			},
		}
	};
};

$(".bactive").on("click",function(){
	$(this).toggleClass("d-remove");
});

NN_FRAMEWORK.BackToTop = function(){
	$(window).scroll(function(){
		if(!$('.scrollToTop').length) $("body").append('<div class="scrollToTop" style="position:fixed;bottom:30px;right:15px;"><img src="'+GOTOP+'" alt="Go Top"/></div>');
		if($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
		else $('.scrollToTop').fadeOut();
	});

	$('body').on("click",".scrollToTop",function() {
		$('html, body').animate({scrollTop : 0},800);
		return false; 
	});
};


if ($("#index-sp-noibat").exists()) {
	var index_slider_spnoibat_options = {
		loop: false,
		pagination: {
			el: '#index-sp-noibat .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '#index-sp-noibat .swiper-button-next',
			prevEl: '#index-sp-noibat .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			319: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			480: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			991: {
				slidesPerView: 4,
				spaceBetween: 20,
			},
			1229: {
				slidesPerView: 4,
				spaceBetween: 30,
			},
		}
	};
	
};
if ($(".gallery-thumb-pro").exists()) {
	var index_thumb_product_options = {
		loop: false,
		pagination: {
			el: '#gallery-thumb-pro .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '#gallery-thumb-pro .swiper-button-next',
			prevEl: '#gallery-thumb-pro .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			319: {
				slidesPerView: 3,
				spaceBetween: 10,
			},
			480: {
				slidesPerView: 3,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 10,
			},
			991: {
				slidesPerView: 4,
				spaceBetween: 10,
			},
			1229: {
				slidesPerView: 5,
				spaceBetween: 10,
			},
		}
	};
	
};
NN_FRAMEWORK.Icon_Search = function(){
	var show = 0;
	$('a.search').click(function() {

		if (show == 1) {

			$('.form-row-search').css({'width': 0});

			$('.search-form').css({'width': 0, 'opacity':0});

			$('a.search').removeClass('active');

			show = 0;

			execSearch();

		} else {

			$('.form-row-search').css({'width': '100%'});

			if ($(window).width() <= 1100) {

				$('.search-form').css({'width': 250, 'opacity':1});

			}else{

				$('.search-form').css({'width': 250, 'opacity':1});

			}

			$('a.search').addClass('active');

			document.getElementById("frm_search").reset();

			show = 1;
		}
		$('#keyword_2').keydown(function(e) {

			if (e.keyCode == 13) {

				execSearch();

			}

		});

	});

	function execSearch() {

		var keyword = $('#keyword_2').val();

		var href_search = $('#href_search').val();

		var defaultvalue = $('#defaultvalue').val();

		if (keyword == defaultvalue){
			return false;
			
		}


		if (keyword != '') {

			var url = href_search + '?keyword=' + encodeURIComponent(keyword);

			window.location = url;

			return false;
		}
	}
};

NN_FRAMEWORK.Cart = function(){
    $("body").on("click",".addcart",function(){
        var mau = ($(".color-pro-detail input:checked").val()) ? $(".color-pro-detail input:checked").val() : 0;
        var size = ($(".size-pro-detail input:checked").val()) ? $(".size-pro-detail input:checked").val() : 0;
        var id = $(this).data("id");
        var action = $(this).data("action");
        var quantity = ($(".qty-pro").val()) ? $(".qty-pro").val() : 1;

        if(id)
        {
            $.ajax({
                url:'ajax/ajax_cart.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'add-cart',id:id,mau:mau,size:size,quantity:quantity},
                success: function(result){
                    if(action=='addnow')
                    {
                        $('.count-cart').html(result.max);
                        $.ajax({
                            url:'ajax/ajax_cart.php',
                            type: "POST",
                            dataType: 'html',
                            async: false,
                            data: {cmd:'popup-cart'},
                            success: function(result){
                                $("#popup-cart .modal-body").html(result);
                                $('#popup-cart').modal('show');
                            }
                        });
                    }
                    else if(action=='buynow')
                    {
                        window.location = CONFIG_BASE + "gio-hang";
                    }
                }
            });
        }
    });

    $("body").on("click",".del-procart",function(){
        if(confirm(LANG['delete_product_from_cart']))
        {
            var code = $(this).data("code");
            var ship = $(".price-ship").val();

            $.ajax({
                type: "POST",
                url:'ajax/ajax_cart.php',
                dataType: 'json',
                data: {cmd:'delete-cart',code:code,ship:ship},
                success: function(result){
                    $('.count-cart').html(result.max);
                    if(result.max)
                    {
                        $('.price-temp').val(result.temp);
                        $('.load-price-temp').html(result.tempText);
                        $('.price-total').val(result.total);
                        $('.load-price-total').html(result.totalText);
                        $(".procart-"+code).remove();
                    }
                    else
                    {
                        $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>'+LANG['no_products_in_cart']+'</p><span>'+LANG['back_to_home']+'</span></a>');
                    }
                }
            });
        }
    });

    $("body").on("click",".counter-procart",function(){
        var $button = $(this);
        var input = $button.parent().find("input");
        var id = input.data('pid');
        var code = input.data('code');
        var oldValue = $button.parent().find("input").val();
        if($button.text() == "+") quantity = parseFloat(oldValue) + 1;
        else if(oldValue > 1) quantity = parseFloat(oldValue) - 1;
        else quantity = 1;
        $button.parent().find("input").val(quantity);
        update_cart(id,code,quantity);
    });

    $("body").on("change","input.quantity-procat",function(){
        var quantity = $(this).val();
        var id = $(this).data("pid");
        var code = $(this).data("code");
        update_cart(id,code,quantity);
    });

    if($(".select-city-cart").exists())
    {
        $(".select-city-cart").change(function(){
            var id = $(this).val();
            load_district(id);
            load_ship();
        });
    }

    if($(".select-district-cart").exists())
    {
        $(".select-district-cart").change(function(){
            var id = $(this).val();
            load_wards(id);
            load_ship();
        });
    }

    if($(".select-wards-cart").exists())
    {
        $(".select-wards-cart").change(function(){
            var id = $(this).val();
            load_ship(id);
        });
    }

    if($(".payments-label").exists())
    {
        $(".payments-label").click(function(){
            var payments = $(this).data("payments");
            $(".payments-cart .payments-label, .payments-info").removeClass("active");
            $(this).addClass("active");
            $(".payments-info-"+payments).addClass("active");
        });
    }

    if($("#is-cty").exists()){
      $("#is-cty").click(function(){
         var is_cty = $("input[name=iscty]:checked").val();
         if(is_cty == 1){
             $("#iscty_enable").removeClass("d-none");   
         }else{
            $("#iscty_enable").addClass("d-none");   
         }
      });
    }

    if($("#coin-input").exists()){
      $(".btn-submit-coin").click(function(){
         var use_coin = $("input[name=used-coin]:checked").val();
         var coin_input = $("#coin-input").val();
         $.ajax({
                url:'ajax/ajax_coin.php',
                type: "POST",
                dataType: 'json',
                data: {coin:coin_input,active:use_coin},
                success: function(result){
                    console.log(result);
                    if(result.status==0)
                    {
                        alert(result.msg);
                    }else{
                        alert(result.msg);
                       
                    }
                    location.reload();
                }
            });


      });
    }
    if($("#order-coupon").exists()){
        
        $("input[name=used-coin]").click(function(){
            // var use_coin = $("input[name=used-coin]:checked").val();
                $(".coin-load-wrapper").toggleClass("d-none");
                $(".total-procart.used_coin").toggleClass("d-none");




        });
        $(".btn-order-magiamgia").click(function(){
            var magiamgia = $("#order-magiamgia-input").val();

             $.ajax({
                url:'ajax/ajax_coupon.php',
                type: "POST",
                dataType: 'json',
                data: {id_coupon:magiamgia},
                success: function(result){
                    console.log(result);
                    if(result.status==0)
                    {
                        alert(result.msg);
                        $(".status-coupon").addClass("d-none");
                    }else{
                        alert(result.msg);
                        $(".status-coupon .coupon_used").html(result.ma);
                        $(".status-coupon .coupon_chietkhau").html(result.chietkhau);
                        $(".status-coupon").removeClass("d-none");
                    }
                    location.reload();
                }
            });
        });
    }
    if($(".color-pro-detail").exists())
    {
        $(".color-pro-detail").click(function(){
            $(".color-pro-detail").removeClass("active");
            $(this).addClass("active");
            
            var id_mau=$("input[name=color-pro-detail]:checked").val();
            var idpro=$(this).data('idpro');

            $.ajax({
                url:'ajax/ajax_color.php',
                type: "POST",
                dataType: 'html',
                data: {id_mau:id_mau,idpro:idpro},
                success: function(result){
                    if(result!='')
                    {
                        // $('.left-pro-detail').html(result);
                        // MagicZoom.refresh("Zoom-1");
                        // NN_FRAMEWORK.OwlProDetail();
                    }
                }
            });
        });
    }

    if($(".size-pro-detail").exists())
    {
        $(".size-pro-detail").click(function(){
            $(".size-pro-detail").removeClass("active");
            $(this).addClass("active");
        });
    }

    if($(".quantity-pro-detail span").exists())
    {
        $(".quantity-pro-detail span").click(function(){
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if($button.text() == "+")
            {
                var newVal = parseFloat(oldValue) + 1;
            }
            else
            {
                if(oldValue > 1) var newVal = parseFloat(oldValue) - 1;
                else var newVal = 1;
            }
            $button.parent().find("input").val(newVal);
        });
    }
};

$(document).ready(function(){
	NN_FRAMEWORK.BackToTop();
	NN_FRAMEWORK.Icon_Search();
	NN_FRAMEWORK.Cart();
	var index_spnoibat_slider = new Swiper("#index-sp-noibat .swiper-container", index_slider_spnoibat_options);
	var index_doitac_slider = new Swiper("#index-slider-doitac .swiper-container", index_slider_doitac_options);
	var index_cungcap_slider = new Swiper("#index-slider-tintuc .swiper-container", index_slider_tintuc_options);
	var index_list_video_verticalp_slider = new Swiper(".list_video_vertical .swiper-container", list_video_vertical_options);
	var index_slider_khachhang = new Swiper("#index-slider-khachhang .swiper-container", index_slider_tintuc_options);
	var index_slider_daotao = new Swiper("#index-slider-daotao .swiper-container", {
		loop: false,
		pagination: {
			el: '#index-slider-daotao .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '#index-slider-daotao .swiper-button-next',
			prevEl: '#index-slider-daotao .swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		breakpoints: {
			480: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
		}
	});
	var index_slider_news_video = new Swiper(".index-news .swiper-container", {
		loop: false,
		pagination: {
			el: '.index-news .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.index-news .swiper-button-next',
			prevEl: '.index-news .swiper-button-prev',
		},
		// autoplay: {
		// 	delay: 2500,
		// 	disableOnInteraction: false,
		// },
		breakpoints: {
			480: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 2,
				spaceBetween: 30,
			},
		}
	});

	if ($(".paging-news-khuvuc").exists()) {
		loadPagingAjax("ajax/ajax_news.php?perpage=8&type=khu-vuc", '.paging-news-khuvuc');
	};
	if ($(".paging-news-dichvu").exists()) {
		loadPagingAjax("ajax/ajax_news.php?perpage=8&type=dich-vu", '.paging-news-dichvu');
	};
	$("#menu_responsive").mmenu();


	if(website_com =='san-pham'){
		var index_gallery_product_slider = new Swiper(".gallery-thumb-pro .swiper-container", index_thumb_product_options);
	}
});