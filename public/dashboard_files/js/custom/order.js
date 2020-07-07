$(document).ready(function(){


$('.add-product-btn').on('click',function(){


    var name = $(this).data('name');
    var id = $(this).data('id');
    var price =
    parseFloat( $.number($(this).data('price'),2).replace(/,/g,''));
    
    
$(this).removeClass('btn-success').addClass('btn-default disabled');
    var html = 
    `<tr>
    <td>${name}</td>
    <input type="hidden" name="prdouct_ids[]" value='${id}'>
    <td><input type="number" name="quantities[]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1" ></td>
    <td class="product-price">${price}</td>
    <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
     </tr>` 
    
$('.order-list').append(html);  
Calculate_Total();

});
 


$('body').on('click','.remove-product-btn',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $(this).closest('tr').remove();
    $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');
    Calculate_Total();
    });


    $('body').on('change','.product-quantity',function(){
        var ProductQuantity =parseInt($(this).val()); 
        var ProductPrice = $(this).data('price');
        $(this).closest('tr').find('.product-price').html($.number(ProductQuantity*ProductPrice,2));
    
       Calculate_Total();
    });


function Calculate_Total(){

    var price = 0;
    $('.order-list .product-price').each(function(index){
    price += parseFloat($(this).html().replace(/,/g,''));
   

});

$('.total-price').html($.number(price,2));
if(price>0){
$('#add-order-form-btn').removeClass('disabled');

}else{
    $('#add-order-form-btn').addClass('disabled');

}
}

$('.order-produts').on('click',function(e){
e.preventDefault();
$('#loading').css('display','flex');
var url = $(this).data('url');
var method = $(this).data('method');

$.ajax({
url:url,
method:method,
success: function(data){
    $('#loading').css('display','none');
$('#order-product-list').append(data);
}
})


});

 $(document).on('click','.print-btn',function(){
$('#print-area').printThis();
});



$('body').on('click','.btn-to-find-stock',function(){


      $('.sto_no').each(function(index){
       var stock = $(this).html();
   if( parseInt( stock )== 0){
$(this).addClass('btn btn-danger btn-sm').html($(this).data('str'));
$(this).closest('tr').find('.add-product-btn').removeClass('btn-success').addClass('btn-default disabled');

   }

});

    
});

});