function ajax_beforeSend(){
	return;
}
function update_cart(id=0,code='',quantity=1)
{
    if(id)
    {
        var ship = $(".price-ship").val();

        $.ajax({
            type: "POST",
            url: "ajax/ajax_cart.php",
            dataType: 'json',
            data: {cmd:'update-cart',id:id,code:code,quantity:quantity,ship:ship},
            success: function(result){
                if(result)
                {
                    $('.load-price-'+code).html(result.gia);
                    $('.load-price-new-'+code).html(result.giamoi);
                    $('.price-temp').val(result.temp);
                    $('.load-price-temp').html(result.tempText);
                    $('.price-total').val(result.total);
                    $('.load-price-total').html(result.totalText);
                }
            }
        });
    }
}
function doAjax(obj) {
	return new Promise((resolve, reject) => {
		$.ajax({
			url: obj.url,
			type: obj.type,
			dataType: obj.dataTyppe,
			async: false,
			data: obj.data,
			beforeSend: function(){
				ajax_beforeSend();
			},
			success: function (data) {
				resolve(data)
			},
			error: function (error) {
				reject(error)
			},
		})
	})
}
function fn_add_cart(quantity,id_product,id_color,id_size){
	return doAjax({
		url:'ajax/ajax_cart.php',
		type: 'POST',
		dataType: 'json',
		data: {cmd:'add-cart',id:id_product,mau:id_color,size:id_size,quantity:quantity}
	});
}
function fn_delete_cart(id_product,id_color,id_size){
	return doAjax({
		url:'ajax/ajax_cart.php',
		type: 'POST',
		dataType: 'json',
		data: {cmd:'delete-cart',id:id_product,mau:id_color,size:id_size}
	});
}

function fn_update_count_cart(count){
	$('.count-cart').html(count);
}
function load_modal_cart(){
	$.ajax({
		url:'ajax/ajax_cart.php',
		type: "POST",
		dataType: 'html',
		async: false,
		data: {cmd:'popup-cart'},
		success: function(result){
			$("#popup-cart .modal-body").html(result);

		}
	});
	$('#popup-cart').modal('show');
}

function check_size(quantity,id_product,id_color,id_size){
	return $.ajax({
		url: 'ajax/ajax_statistic.php',
		method: "POST",
		dataType: 'json',
		data:{cmd:'check-size',id:id_product,mau:id_color,size:id_size,quantity:quantity}
	});
}
function check_size_byCode(quantity,id_product,id_color,id_size){
	return $.ajax({
		url: 'ajax/ajax_statistic.php',
		method: "POST",
		dataType: 'json',
		data:{cmd:'input-quantity',id:id_product,mau:id_color,size:id_size,quantity:quantity}
	});
}
$(".button-addToCart").on("click",function(){

	var chosen_color = $(".chosen_color.active");
	var chosen_size = $(".chosen_size.active");
	var quantity = $(".input-quantities").val();
	var id_product = $(this).data("product");
	var id_color = chosen_color.data("idmau");
	var id_size = chosen_size.data("idsize");
	var action = $(this).data("action");
	if(!id_color){
		modalNotify(LANG['no_color_choosen']);
		return;
	}
	if(!id_size){
		modalNotify(LANG['no_size_choosen']);
		return;
	}
	var checksize = check_size(quantity,id_product,id_color,id_size);
	$.when(checksize).done(function(r){
		if(r.status === 'fail'){
			modalNotify(r.msg);
			return;
		}
		if(r.status === 'success'){
			fn_add_cart(quantity,id_product,id_color,id_size)
			.then(function(data){
				var r = JSON.parse(data);
				fn_update_count_cart(r.count_cart);
				modalNotify(LANG['add_card_success']);
			}).catch((error) => {
				console.log(error)
			});	
		}
	});
	
	
});

$("#cart-fixed").on("click",function(){
	load_modal_cart();
});
$("body").on("click",".del-procart",function(){
	if(confirm(LANG['delete_product_from_cart']))
	{
		var code = $(this).data("code");
		var id_product = $('.'+code).data("id");
		var id_color = $('.'+code).data("idmau");
		var id_size = $('.'+code).data("idsize");
		fn_delete_cart(id_product,id_color,id_size).then(function(result){
			$('.price-temp').val(result.temp);
			$('.load-price-temp').html(result.tempText);
			$('.price-total').val(result.total);
			$('.load-price-total').html(result.totalText);
			$('.'+code).remove();
		});

	}
});
$("body").on("click",".counter-procart",function(){
	var $button = $(this);
	var quantity = 1;
	var input = $button.parent().find("input");
	var id = input.data('pid');
	var code = input.data('code');
	var id_color = input.data('mau');
	var id_size = input.data('size');
	var oldValue = $button.parent().find("input").val();
	if($button.text() == "+") quantity = parseFloat(oldValue) + 1;
	else if(oldValue > 1) quantity = parseFloat(oldValue) - 1;
	$button.parent().find("input").val(quantity);

	var checksize = check_size_byCode(quantity,id,id_color,id_size);
	$.when(checksize).done(function(r){
		if(r.status === 'fail'){
			modalNotify(r.msg);
			input.val(oldValue);
			return;
		}
		if(r.status === 'success'){
			update_cart(id,code,quantity);
		}
	});
});

$("body").on("change","input.quantity-procat",function(){
	var quantity = $(this).val();
	var id = $(this).data("pid");
	var code = $(this).data("code");
	var id_color = $(this).data('mau');
	var id_size = $(this).data('size');
	
	var checksize = check_size_byCode(quantity,id,id_color,id_size);
	$.when(checksize).done(function(r){
		if(r.status === 'fail'){
			modalNotify(r.msg);
			return;
		}
		if(r.status === 'success'){
			update_cart(id,code,quantity);
			
		}
	});

	
});
// $("body").on("click",".del-procart",function(){
//         if(confirm(LANG['delete_product_from_cart']))
//         {
//             var code = $(this).data("code");
//             var ship = $(".price-ship").val();

//             $.ajax({
//                 type: "POST",
//                 url:'ajax/ajax_cart.php',
//                 dataType: 'json',
//                 data: {cmd:'delete-cart',code:code,ship:ship},
//                 success: function(result){
//                     $('.count-cart').html(result.max);
//                     if(result.max)
//                     {
//                         $('.price-temp').val(result.temp);
//                         $('.load-price-temp').html(result.tempText);
//                         $('.price-total').val(result.total);
//                         $('.load-price-total').html(result.totalText);
//                         $(".procart."+code).remove();
//                     }
//                     else
//                     {
//                         $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>'+LANG['no_products_in_cart']+'</p><span>'+LANG['back_to_home']+'</span></a>');
//                     }
//                 }
//             });
//         }
//     });

// if($(".quantity-pro-detail span").exists())
//     {
//         $(".quantity-pro-detail span").click(function(){
//             var $button = $(this);
//             var oldValue = $button.parent().find("input").val();
//             if($button.text() == "+")
//             {
//                 var newVal = parseFloat(oldValue) + 1;
//             }
//             else
//             {
//                 if(oldValue > 1) var newVal = parseFloat(oldValue) - 1;
//                 else var newVal = 1;
//             }
//             $button.parent().find("input").val(newVal);
//         });
//     }


$("#button-stastisticToCart").on("click",function(){
	var empty_stock_input = true;
	$("input.stock-quantity").each(function(){
		let input = $(this);
		let quantity = input.val();
		if(quantity == 0){
		}else{
			empty_stock_input = false;
			let id_product = input.data("id");
			let id_color = input.data("idmau");
			let id_size = input.data("idsize");
			var checksize = check_size(quantity,id_product,id_color,id_size);
			$.when(checksize).done(function(r){
				if(r.status === 'fail'){
					modalNotify(r.msg);
					return;
				}
				if(r.status === 'success'){
					fn_add_cart(quantity,id_product,id_color,id_size)
					.then(function(data){
						var r = JSON.parse(data);
						fn_update_count_cart(r.count_cart);
						modalNotify(LANG['add_card_success']);
					}).catch((error) => {
						console.log(error)
					});	
				}
			});


			
		}

		
	});
	if(empty_stock_input == true){
		console.log("empty-cart");
		modalNotify(LANG["chua_nhap_so_luong"]);
	}
});

$(".user_delete_order").on("click",function(){
	var id_donhang = $(this).attr("data-href");
	bootbox.confirm("<?=user_delete_order_question?>", function(result){
		doAjax({
			url:'account/update-status-order',
			type: 'POST',
			dataType: 'json',
			data: {madonhang:id_donhang}
		});
	});
});