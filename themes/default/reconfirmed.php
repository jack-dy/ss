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
                            <div class="item">
                                <p class="pd_type"><?=$item['category_name']?></p>
                            </div>
                            <div class="item">
                                <h4 class="pd_price text-right"><?=$sel_rate['name']." ".sprintf("%01.2f",$sel_rate['rate']*$item['goods_price'])?></h4>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="cart_totle">
                        <div class="row p15">
                            <div class="col-sm-10 col-xs-8 text-right">Cart subototal:</div>
                            <div class="col-sm-2 col-xs-4 text-left"><?=$sel_rate['name']?><span class="ml10 subototal"><?=$calculation['subototal']?></span> </div>
                            <div class="col-sm-10 col-xs-8 text-right">Postage:</div>
                            <div class="col-sm-2 col-xs-4 text-left"><?=$sel_rate['name']?><span class="ml10 postage"><?=$calculation['postage']?></div>
                            <div class="col-sm-10 col-xs-8 text-right">Total amount:</div>
                            <div class="col-sm-2 col-xs-4 text-left"><?=$sel_rate['name']?><span class="ml10 amount"><?=$calculation['amount']?></div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="box_t">
                            <h2>Contact information</h2>
                        </div>
                        <div class="order_form">
                            <div class="form-group row">
                                <div class="col-xs-3 text-right">Country:</div>
                                <div class="col-xs-9"><?=$country[$cart_option['cart']['country']]['cy_name_en']?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 text-right">Name:</div>
                                <div class="col-xs-9"><?=$cart_option['cart']['name']?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 text-right">Address:</div>
                                <div class="col-xs-9"><?=$cart_option['cart']['address']?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 text-right">Email:</div>
                                <div class="col-xs-9"><?=$cart_option['cart']['email']?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 text-right">Phone:</div>
                                <div class="col-xs-9"><?=$cart_option['cart']['phone']?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 text-right">Postal code:</div>
                                <div class="col-xs-9"><?=$cart_option['cart']['postal']?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6  ">
                                    <a href="<?=site_url('cart/index')?>" class="check_out   form-control" style="background:#fff; color:#000; text-align: center;">Back</a>
                                </div>
                                <div class="col-xs-6  ">
                                    <button type="button" class="check_out reconfirm   form-control">Confirm</button>
                                </div>

                            </div>
                        </form>
                        </div>
                </div>
                </div>
               
                <?php endif;?>
            </div>
        </div>
        

        
        <script>
    $(function (){
        $.swiper({
            id:'.gallery-top'
        });
        // $.sortable({
        //     id:'#sortable'
        // });
        $('.reconfirm').click(function(){
            $(this).css('pointer-events','none');
            ajax("<?=site_url('cart/toOrder')?>",'post','',back_finish);
        })

    })
    function back_finish(res){
        if(res.code===1){
            //console.log(res);
            window.location.href=site_url+"order/finish";
        }else{
            $.show_error(res.msg);
            $('.reconfirm').css('pointer-events','visible')
        }
    }
    </script>
