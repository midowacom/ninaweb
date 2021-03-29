$.fn.exists = function(){
	return this.length;
};
var product_item_collection = [];
var current_product_item;
var current_product_item_position;
function move_item(cmd){
    var arr_count = product_item_collection.length;
    console.log(arr_count);
    current_product_item_position = product_item_collection.indexOf(current_product_item);
}
function product_item_next(){
    var target_pos = current_product_item_position + 1;
    if(target_pos == product_item_collection.length){}
}
function collect_product_item(){
    if($(".product-item").exists()){
        $(".product-item").each(function(){
                product_item_collection.push($(this).data("id"));
        });
    }
}
$(document).ready(function(){
    collect_product_item();
    console.log(product_item_collection);
    $("#menu_repsonsive").mmenu();

    var modal = UIkit.modal('.uk-modal-product', {
        
    });
    $(".modal-product-btn.modal-product-next").on("click",function(){
        product_item_next();
    });
    $(".modal-product-btn.modal-product-next").on("click",function(){
        product_item_prev();
    });
    $(".uikit-product-modal").on("click",function(){
       var id_product =  $(this).data("id");
       current_product_item = id_product;
       move_item('next_item');
       $.ajax({
            url: ''
       })
       modal.show();
    });
    
    
});
