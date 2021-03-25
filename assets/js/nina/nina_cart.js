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