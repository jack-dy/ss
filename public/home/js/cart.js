/**
 * jquery全局函数封装
 */
(function ($) {
    $.extend({
        /*  $.uploadImage({id:'#aa'}) */
        telInput:function(option){
           
        }
    })
        
})(jQuery);

    

function back_del(res){
    if(res.code===1){
        delete list[res.goods_id];
        $('.pd_'+res.goods_id).remove();
        $('.carnum').html(parseInt($('.carnum').html())-1);
        if(JSONLength(list)===0){
            $('.cart_box').remove();
            $('.empty_box').css('display','block');
        }else{
            count();
        }
        

    }

}
function back_change(res){

}
function back_form($res){
    window.location.href=site_url+"cart/reconfirmed";
    //console.log($res);
}
function JSONLength(obj) {
    var size = 0, key;
    for (key in obj) {
    if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
function count(){
    weight=0;
    subototal=0;
    for(let key in list){
        subototal = subototal + parseFloat(list[key]['goods_price'])*sel_rate['rate'];
        weight = weight + parseFloat(list[key]['goods_weight']);
    }
    subototal = subototal.toFixed(2);
    if(cart_option['cart']['country']){
        if(weight<0.5 && weight>0){
            console.log(1);
            postage_price = (parseFloat(postage[country[cart_option['cart']['country']]['pt_pid']]['pt_price'])*sel_rate['rate']).toFixed(2);
        }else if(weight>0.5){
            console.log(2);
            postage_price =(parseFloat(postage[country[cart_option['cart']['country']]['pt_pid']]['pt_price'])*sel_rate['rate'] + Math.ceil((weight-0.5)/0.5)*parseFloat(postage[country[cart_option['cy_id']]['pt_pid']]['pt_price_add'])*sel_rate['rate'] ).toFixed(2);
        }
       
    }else{
        console.log(3);
        postage_price =0;
    }
    amount=(parseFloat(postage_price)+parseFloat(subototal)).toFixed(2);
    $('.subototal').html(subototal);
    $('.postage').html(postage_price);
    $('.amount').html(amount);
    // if(val!=''){
    //     $
    // }else{
    //     postage_price =0;
    // }
}
$.validator.setDefaults({
    submitHandler: function() {
        if($('#error-msg').hasClass('hide')){
            data=$('#my-form').serialize();
            ajax(site_url+"cart/submit", 'post',data,back_form);
        }
    //alert("提交事件!");
    }
});

    

$(function(){
    $(document).on('change','.user_country',function(){
        var val=$(this).find("option:selected").val();
        if(cart_option['address'] === undefined ){
            cart_option['address']=Array(); 
        }
        cart_option['address']['country']=val;
        console.log(val);
        ajax(site_url+'country/change_country','post','country='+val,back_change);
        count();
        

    })
    $('.to_del').click(function(){
        $goods_id=$(this).attr('goods_id');
        $(this).css('pointer-events','none');
        ajax(site_url+'cart/reduce','post','goods_id='+$goods_id,back_del);
    })
    /**
     * 表单验证提交
     * @type {*}
     */
    $("#my-form").validate({
            rules: {
                'cart[country]':{
                    required: true,
                },
                'cart[name]': {
                    required: true, //该项表示该字段为必填项
                    minlength: 2 //表示该字段的最大长度为5
                },
                'cart[address]': {
                    required: true,
                },
                'cart[email]': {
                    required: true,
                    email:true,
                },
                'cart[phone]': {
                    required: true,
                }
            },
            messages: {
                'cart[country]':{
                    required: "please select country",
                },
                'cart[name]': {
                    required: 'Name  is required',
                    minlength: "Please enter ata lest 3 characters"
                },
                'cart[address]': {
                    required: 'Address  is required',
                },
                'cart[email]': {
                    required: 'Email  is required',
                    email:"Please enter a valid email address",
                },
                'cart[phone]': {
                    required: 'Phone  is required',
                }
            }   
        });
})
