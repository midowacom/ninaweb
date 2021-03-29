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