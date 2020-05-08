<!-- <div class="container"></div> -->
<div class=" container p15">
            <div class="row">
                <div class="col-md-5">
                    <div class="gallery">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <?php foreach($goods['image'] as $image):?>
                                    <div class="swiper-slide down_img" style="background-image:url(<?=base_url('uploads/').$image ?>)"><img src="<?=base_url('uploads/').$image ?>" alt=""></div>
                                <?php endforeach;?>
                                
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <?php foreach($goods['image'] as $image):?>
                                    <div class="swiper-slide" style="background-image:url(<?=base_url('uploads/thumb/').$image?>)"></div>

                                <?php endforeach;?>
                            </div>
                        </div> 
                    </div>
                      
                </div>
                <div class="col-md-7">
                    <div class="product_content">
                        <h3 class="product_name"><?=$goods['goods_name']?></h3>
                        <p class="product_title"><?=$goods['content']?></p>
                        <?php if(!empty($goods['goodsStyle'])):?>
                        <ul>
                            <?php foreach($goods['goodsStyle'] as $v):?>
                                <li><?=$goods_style[$v]['goodsStyle_name']?></li>
                            <?php endforeach;?>
                        </ul>
                            <?php endif;?>
                        <p class="product_price">
                                <select  name="rate" class="rate" id="">
                        <?php foreach($rate as $k=>$item):?>
                        <option <?php if($item['name']==$rign): $sel_id = $k;?>selected='selected'<?php endif;?>  value="<?=$item['name']?>"><?=$item['name']?></option>
                        <?php endforeach;?>
                        
                        </select>
                         :
                         <span class="price"><?= sprintf("%01.2f",$rate[$sel_id]['rate']*$goods['goods_price'])?></p></span>
                         
                                <button class="add_toCart <?php foreach($cart as $k=>$v):if($k==$goods['goods_id']):?>disabled<?php endif;endforeach;?>" goods_id ='<?=$goods['goods_id']?>' <?php foreach($cart as $k=>$v):if($k==$goods['goods_id']):?>disabled="disabled"<?php endif;endforeach;?> >ADD TO BAG</button>
                        <div class="shair"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--guess like  -->
        <div class=" container p15 mt15 border-top">
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
        <script>
        var rate = <?=json_encode($rate)?>;
        var price = <?=$goods['goods_price']?>;
    $(function (){
        $.swiper({
            id:'.gallery-top',
            number:<?=count($goods['image'])<3?:5?>
        });
        $.sortable({
            id:'#sortable'
        });
        $('.add_toCart').click(function(){
            data ={'goods_id':$(this).attr('goods_id')};
            $(this).attr('disabled','disabled');
            ajax("<?=site_url('cart/add')?>", 'post', data, back_addTocart);
        });
        $(document).on('change','.rate',function(){
            var name=$(this).find("option:selected").text();
            for(var key in rate){
                if(rate[key]['name']==name){
                    ajax('<?=site_url('goods/rign')?>','post','rign='+name);
                    $('.price').html((rate[key]['rate']*price).toFixed(2));
                }
                
                
                //console.log(rate[key]['rate']);
            }

        })
    })
    function back_addTocart($res){
        console.log($res);
        if($res['code']===1){
            $('.add_toCart').addClass('disabled');
            if($('span').is('.carnum')){
                $('.carnum').html(Number($('.carnum').html())+1);
            }else{
                $('.cart_btn').append('<span class="carnum">1</span>');
            }
        }else{
            $('.add_toCart').removeAttr('disabled');
            $.show_error($res.msg)
        }
        
    }
    </script>