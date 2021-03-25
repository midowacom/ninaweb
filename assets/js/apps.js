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