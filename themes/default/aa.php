<?php $swiper=0; foreach($page as $pageItem):?>


    <?php if($pageItem['type']=='richText'):?>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <div style="padding-top: <?=$pageItem['style']['paddingTop']?>px; padding-buttom:<?=$pageItem['style']['paddingTop']?>px; padding-left: <?=$pageItem['style']['paddingLeft']?>px; background: <?=$pageItem['style']['background']?>;";><?=$pageItem['params']['content']?></div>
                </div>
            </div>
        </div>   
    <?php endif;?>  


    <?php if($pageItem['type']=='banner'): $swiper++?>
        <?php if($swiper==1): ?>
            <header class="">
                <div class="swiper-container swiper_box <?=$pageItem['id']?>">
                    <div class="swiper-wrapper">
                        <?php foreach($pageItem['data'] as $images):?>
                        <div class="swiper-slide swiper-bg" style="background-image:url(<?=$images['imgUrl']?>)"></div>   
                        <?php endforeach;?> 
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </header>
            <script>
            $(function(){
                $.swiper({id:'.<?=$pageItem['id']?>',number:1})
            })
            </script>
        <?php else: ?>
            <div class=" container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="swiper-container <?=$pageItem['id']?>">
                            <div class="swiper-wrapper">
                            <?php foreach($pageItem['data'] as $images):?>
                            <div class="swiper-slide swiper-bg" style="background-image:url(<?=$images['imgUrl']?>)"></div>   
                            <?php endforeach;?> 
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
            $(function(){
                $.swiper({id:'.<?=$pageItem['id']?>',number:1})
            })
            </script>
        <?php endif; ?>
    <?php endif;?>


    <?php if($pageItem['type']=='goods'):?>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                <section class="home_lists">
                <ul  id="<?=$pageItem['id']?>" class="portfolio sjs-default">
                    <?php foreach($pageItem['data'] as $item):?>
                    <li data-sjsel="<?=$pageItem['id']?>">
                        <div class="card">
                            <a href="<?=site_url('goods/detail?id=').$item['goods_id']?>" >
                                <img class="card_picture" src="<?=$item['image']?>" alt="">
                            </a>
                        </div>
                    </li> 
                    <?php endforeach;?>
                                        
                </ul>
                </section>  
                </div>
            </div>
        </div> 
        <script>
        $(function () {
        $.sortable({id:'#<?=$pageItem['id']?>'});
        })

        </script>  
    <?php endif;?> 

    
    <?php if($pageItem['type']=='imageSingle'):?>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <div style="padding-top: <?=$pageItem['style']['paddingTop']?>px; padding-left: <?=$pageItem['style']['paddingLeft']?>px; background: <?=$pageItem['style']['background']?>;">
                        <?php foreach($pageItem['data'] as $item):?>
                        <img style="width:100%;" src="<?=$item['imgUrl']?>" alt="" srcset="">
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>   
    <?php endif;?> 

    <?php if($pageItem['type']=='blank'):?>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <div style="height: <?=$pageItem['style']['height']?>px; width:100%; background: <?=$pageItem['style']['background']?>;">
                        
                    </div>
                </div>
            </div>
        </div>   
    <?php endif;?> 

    <?php if($pageItem['type']=='guide'):?>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <div style="border-bottom:<?=$pageItem['style']['lineHeight']?>px <?=$pageItem['style']['lineStyle']?> <?=$pageItem['style']['lineColor']?> ; padding-top:<?=$pageItem['style']['paddingTop']?>px; width:100%; background: <?=$pageItem['style']['background']?>;">
                        
                    </div>
                </div>
            </div>
        </div>   
    <?php endif;?> 
    

<?php endforeach;?>

