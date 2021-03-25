$.fn.exists = function(){
	return this.length;
};
$(".pliz").on("click",function(){
    var cid = $(this).data("id");
    var uid = $(this).data("uid");
    $("."+uid).css("display","none");
    $("."+cid).toggle();
});
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
        var quanprice = ($(".quanprice-detail input:checked").val()) ? $(".quanprice-detail input:checked").val() : 0;
        var id = $(this).data("id");
        var action = $(this).data("action");
        var quantity = ($(".qty-pro").val()) ? $(".qty-pro").val() : 1;
        if(quanprice == 0){
            alert("Bạn chưa chọn loại cần mua");
            return;
        }
        if(id)
        {
            $.ajax({
                url:'ajax/ajax_cart.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'add-cart',id:id,mau:mau,size:size,quantity:quantity,quanprice:quanprice},
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
                        $(".procart."+code).remove();
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
        var quantity = 1;
        var input = $button.parent().find("input");
        var id = input.data('pid');
        var code = input.data('code');
        var oldValue = $button.parent().find("input").val();
        if($button.text() == "+") quantity = parseFloat(oldValue) + 1;
        else if(oldValue > 1) quantity = parseFloat(oldValue) - 1;
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
                        $('.left-pro-detail').html(result);
                        MagicZoom.refresh("Zoom-1");
                        NN_FRAMEWORK.OwlProDetail();
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
NN_FRAMEWORK.BackToTop = function(){
	$(window).scroll(function(){
		if(!$('.scrollToTop').length) $("body").append('<div class="scrollToTop" style="position:fixed;bottom:30px;right:15px;z-index:9999;cursor:pointer;"><img src="'+GOTOP+'" alt="Go Top"/></div>');
		if($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
		else $('.scrollToTop').fadeOut();
	});

	$('body').on("click",".scrollToTop",function() {
		$('html, body').animate({scrollTop : 0},800);
		return false; 
	});
};


$(".tieuchi-header-item").hover(function(){
	var t  = $(this).data("src");
	$(".tieuchi-item-content").removeClass('active');
	$(t).addClass('active');
});
var index_hotsale;
$(document).ready(function(){
	NN_FRAMEWORK.BackToTop();
	NN_FRAMEWORK.Cart();
    NN_FRAMEWORK.Icon_Search();
    $("#menu_repsonsive").mmenu();
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

  var  index_slider_Quangcao= new Swiper("#slider_Quangcao .swiper-container", {
    loop: false,
    slidesPerView: 1,
    spaceBetween: 0,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    pagination: {
        el: '#slider_Quangcao .swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '#slider_Quangcao .swiper-button-next',
        prevEl: '#slider_Quangcao .swiper-button-prev',
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});
  var index_sliderindex= new Swiper("#sliderindex .swiper-container", {
    loop: false,
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
        el: '#sliderindex .swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '#sliderindex .swiper-button-next',
        prevEl: '#sliderindex .swiper-button-prev',
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});
 if ($(".gallery-thumb-pro").exists()) {
    var index_thumb_product_options = {
        loop: false,
        pagination: {
            el: '.gallery-thumb-pro .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.gallery-thumb-pro .swiper-button-next',
            prevEl: '.gallery-thumb-pro .swiper-button-prev',
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
 if(website_com =='san-pham'){
        var index_gallery_product_slider = new Swiper(".gallery-thumb-pro .swiper-container", index_thumb_product_options);
    }

  var index_slider_tieuchi= new Swiper("#index-tieuchi .swiper-container", {
      loop: false,
      slidesPerView: 4,
      spaceBetween: 30,
      pagination: {
       el: '#index-tieuchi .swiper-pagination',
       clickable: true,
   },
   navigation: {
       nextEl: '#index-tieuchi .swiper-button-next',
       prevEl: '#index-tieuchi .swiper-button-prev',
   },
   autoplay: {
       delay: 2500,
       disableOnInteraction: false,
   },
   breakpoints: {
    1: {
        slidesPerView: 1,
        spaceBetween: 0,
    },
    480: {
        slidesPerView: 2,
        spaceBetween: 20,
    },
    768: {
        slidesPerView: 3,
        spaceBetween: 30,
    },
    1024: {
        slidesPerView: 4,
        spaceBetween: 30,
    },
}
});
  index_hotsale = new Swiper(".hotsale-wrap .swiper-container", {
    loop: true,
    slidesPerView: 5,
    spaceBetween: 2,
    pagination: {
        el: '.hotsale-wrap .swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.hotsale-wrap .swiper-button-next',
        prevEl: '.hotsale-wrap .swiper-button-prev',
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});

  if ($("#product-moi").exists()) {
    var index_slider_psanpham= new Swiper("#product-moi .swiper-container",{
        loop: false,
        pagination: {
            el: '#product-moi .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '#product-moi .swiper-button-next',
            prevEl: '#product-moi .swiper-button-prev',
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
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 10,
            },
        }
    }
    );
};
if ($("#product-banchay").exists()) {
    var index_slider_psanpham= new Swiper("#product-banchay .swiper-container",{
        loop: false,
        pagination: {
            el: '#product-banchay .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '#product-banchay .swiper-button-next',
            prevEl: '#product-banchay .swiper-button-prev',
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
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 10,
            },
        }
    }
    );
};
if ($("#sliderindex_quangcao").exists()) {
    var index_slider_psanpham= new Swiper("#sliderindex_quangcao .swiper-container",{
        loop: false,
        pagination: {
            el: '#sliderindex_quangcao .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '#sliderindex_quangcao .swiper-button-next',
            prevEl: '#sliderindex_quangcao .swiper-button-prev',
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
        }
    }
    );
};
});
$(".h-prev").on("click",function(){
    index_hotsale.slidePrev();
});
$(".h-next").on("click",function(){
    index_hotsale.slideNext();
});