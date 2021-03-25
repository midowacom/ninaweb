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
