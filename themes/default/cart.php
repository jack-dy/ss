<!-- <div class="container"></div> -->
        
        <div class=" container p15">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box_t">
                        <h2>Order Form</h2>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2 border-top">
                </div>
                <?php if(!empty($list)):?>
                <div class="cart_box">
                <div class="col-md-8 col-md-offset-2">
                    <ul class="cart_lists">
                        <?php  foreach($list as $item):?>
                        <li class="pd_<?=$item['goods_id']?>">
                            <div class="item pc_pic_box">
                                <img class="pc_pic" src="<?=base_url('uploads/thumb/').$item['image'][0]?>" alt="">
                            </div>
                            <div class="item">
                                <p class="pd_name"><?=$item['goods_name']?></p>
                            </div>
                            <!-- <div class="item">
                                <p class="pd_type"><?=$item['category_name']?></p>
                            </div> -->
                            <div class="item">
                                <p class="to_del" goods_id=<?=$item['goods_id']?>><i class="fa fa-trash"></i> Remove</p>
                            </div>
                            <div class="item">
                                <h4 class="pd_price text-right"><?=$sel_rate['name']." ".sprintf("%01.2f",$sel_rate['rate']*$item['goods_price'])?></h4>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="cart_totle">
                        <div class="row p15">
                            <div class="col-sm-10 col-xs-8 text-right">Subototal:</div>
                            <div class="col-sm-2 col-xs-4 text-left"><?=$sel_rate['name']?><span class="ml10 subototal"><?=$calculation['subototal']?></span> </div>
                            <div class="col-sm-10 col-xs-8 text-right">Postage:</div>
                            <div class="col-sm-2 col-xs-4 text-left"><?=$sel_rate['name']?><span class="ml10 postage"><?=$calculation['postage']?></div>
                            <div class="col-sm-10 col-xs-8 text-right">Total amount:</div>
                            <div class="col-sm-2 col-xs-4 text-left"><?=$sel_rate['name']?><span class="ml10 amount"><?=$calculation['amount']?></div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="box_t">
                            <h2>Contact information</h2>
                        </div>
                        <div class="order_form">
                        <form id="my-form" method="post" action="">
                            
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <select class="user_country form-control"  id="country" name="cart[country]" style="">
                                        <option value="">select Country</option>
                                        <?php $code =array(); foreach($country as $k=>$item): $code[]=strtolower($item['cy_code']);?>
                                        <option <?php if(!empty($cart_option['cart']) &&  !empty($cart_option['cart']['country']) &&$cart_option['cart']['country']==$item['cy_id']):?>selected='selected'<?php endif;?> value="<?=$item['cy_id']?>"><?=$item['cy_name_en']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <p>* The postage varies according to the country</p>
                                </div>
                                <div class="col-lg-12 form-group">
                                        <input class=" form-control" id="name" minlength="2" name="cart[name]"  placeholder="Name"  value="<?php  if(!empty($cart_option['cart']) && !empty($cart_option['cart']['name'])){echo $cart_option['cart']['name'];}?>"/>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class=" form-control" id="address" name="cart[address]"  placeholder="Shopping address" value="<?php if(!empty($cart_option['cart']) && !empty($cart_option['cart']['address'])){echo $cart_option['cart']['address'];}?>"/>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class=" form-control" id="email" name="cart[email]"  placeholder="Email" value="<?php if(!empty($cart_option['cart']) && !empty($cart_option['cart']['email'])){echo $cart_option['cart']['email'];}?>"/>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class=" form-control" id="phone" name="cart[phone]"  placeholder="(201) 555-0123" value=""/>
                                    <span id="valid-msg" class="hide">✓</span>
                                    <span id="error-msg" class="hide">Invalid number</span>
                                    <input id="hidden" type="hidden"  name="phone_full">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class=" form-control" id="postal" name="cart[postal]" placeholder="Postal code" value="<?php if(!empty($cart_option['cart']) && !empty($cart_option['cart']['postal'])){echo $cart_option['cart']['postal'];}?>"/>
                                </div>
                                <div class="col-xs-6  col-xs-offset-3">
                                    <button type="submit" class="check_out j-submit  form-control">Check Out</button>
                                </div>

                            </div>
                        </form>
                        </div>
                </div>
                </div>
                <div class="empty_box">
                    <div class="col-md-8 col-md-offset-2 back_index">
                    <p>Empty shopping cart Oh ~, to see the right merchandise it ~</p>
                    <a href="<?=site_url('home/index2')?>" class="to_shop_list">Go shopping &gt;</a>
                    </div>
                </div>
                <?php else:?>
                    <div class="col-md-8 col-md-offset-2 back_index">
                    <p>Empty shopping cart Oh ~, to see the right merchandise it ~</p>
                    <a href="<?=site_url('home/index2')?>" class="to_shop_list">Go shopping &gt;</a>
                    </div>
                <?php endif;?>
            </div>
        </div>
        

        <!--guess like  -->
        <div class=" container p15 mt15  border-top">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box_t">
                        <h2>You May Also Like</h2>
                    </div>
                        <section class="">
                        <ul  id="sortable" class="portfolio sjs-default">
                        <?php if (!empty($like)): foreach ($like as $item):?>
                            <li data-sjsel="b">
                                <div class="card">
                                    <a href="<?=site_url('goods/detail?id=').$item['goods_id']?>" >
                                        <img class="card_picture" src="<?=base_url('uploads/thumb/').$item['image'][0]?>" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php endforeach;endif;?>
                        </ul>
                        </section>
                </div>
            </div>
        </div>

        <script src="<?=base_url('public/js/jquery.form.min.js')?>"></script>
        <script src="<?=base_url('public/vendor/intlTelInput/js/intlTelInput.js')?>"></script>
        <script src="<?=base_url('public/js/jquery.validate.js')?>"></script>
        <script>
        var country = <?=json_encode($country)?>;
        var postage=<?=json_encode($postage)?>;
        var cart = <?=json_encode($cart)?>;
        var list = <?=json_encode($list)?>;
        var cart_option = <?=json_encode($cart_option)?>;
        var sel_rate = <?=json_encode($sel_rate)?>;
        
        //console.log(list);
    $(function (){
        // $.swiper({
        //     id:'.gallery-top'
        // });
        $.sortable({
            id:'#sortable'
        });
        

        
    })
    </script>
    <script src="<?=base_url('public/home/js/cart.js')?>"></script>
    <script>
        // function back_del(res){
        //     if(res.code===1){
        //         delete list[res.goods_id];
        //         if(JSONLength(list)==0){
        //             $('.cart_box').remove();
        //             $('.empty_box').css('display','block');
        //         }
        //         $('.pd_'+res.goods_id).remove();

        //     }

        // }
        // function JSONLength(obj) {
        //     var size = 0, key;
        //     for (key in obj) {
        //     if (obj.hasOwnProperty(key)) size++;
        //     }
        //     return size;
        // };
        // function count(){

        // }
        // $.validator.setDefaults({
        //     submitHandler: function() {
        //         if($('#error-msg').hasClass('hide')){
                    
        //         }
        //     alert("提交事件!");
        //     }
        // });

    var telInput = $("#phone"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");

    telInput.intlTelInput({
    initialCountry: "<?php if(!empty($cart_option['cart']) && !empty($cart_option['cart']['country'])){ echo $country[$cart_option['cart']['country']]['cy_code'];}?>",
        utilsScript: "<?=base_url('public/vendor/intlTelInput/js/utils.js')?>",
        onlyCountries: <?=json_encode($code)?>
    });
    var reset = function() {
        telInput.removeClass("error");
        errorMsg.addClass("hide");
        validMsg.addClass("hide");
    };
    if($('#phone').val()!=''){
        $('#valid-msg').removeClass("hide");
    }
    // on blur: validate
    telInput.blur(function() {
        reset();
        if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {
            validMsg.removeClass("hide");
            } else {
            telInput.addClass("error");
            errorMsg.removeClass("hide");
            }
        }
    });
    telInput.on("keyup change", reset);

    </script>