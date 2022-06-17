
$(document).on('change','[name="customer_id"]',function(){
    getAddrss(this);
});


function getAddrss(_this){
    let val = $(_this).val();
    const url = location.protocol + '//' + location.host;
    $.ajax({
        url:url+'/customerId/'+val,
        dataType:'json',
        beforeSend:function(){
            $('*[name="customer_address_id"]').empty();
        },
        success:function(addresses){
            $('*[name="customer_address_id"]').append('<option value="">Select address</option>');
            $.each(addresses,function(key,val){

                $('*[name="customer_address_id"]').append('<option value="'+key+'">'+val+'</option>');
            })
            // console.log(res)
            // customer_address_id
        },
        error:function(exception){
            console.log(exception);
        }
    })
}
$(document).ready(function(){
    if($('#has-many-order_products .has-many-order_products-form').length==0){
         $('#has-many-order_products .add').click();
         
    }
    $('#has-many-order_products .remove').click(function(){
        if($('#has-many-order_products .has-many-order_products-form').length<2){
            alert("You cannot remove all products")
            return false;
        }
    });
});



// $('#has-many-order_products-form .remove')