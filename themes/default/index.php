<div class=" container p15">
    <div class="row">
        <div class="col-lg-12">
                <section class="home_lists">
                <ul  id="sortable" class="portfolio sjs-default">
                    <?php if (!empty($list)): foreach ($list as $item):?>
                    <?php if($item['type']=='goods'):?>
                    <li data-sjsel="b">
                        <div class="card">
                            <a href="<?=site_url('goods/detail?id=').$item['goods_id']?>" >
                                <img class="card_picture" src="<?=base_url('uploads/thumb/').$item['image'][0]?>" alt="">
                            </a>
                        </div>
                    </li> 
                    <?php elseif($item['type']=='card'): ?>
                    <li data-sjsel="b">
                    <div class="card" style="<?php if($item['card_backgroundImage']==''):?>background:<?=$item['card_background']?>;<?php endif;?>">
                        <?php if($item['card_backgroundImage']!=''):?>
                        <div class="card_bg" style=" background-image: url(<?=base_url('uploads/thumb/').$item['card_backgroundImage']?>);<?php if(empty($item['card_name'])):?>opacity: 0.8;<?php endif;?>">

                            </div>
                            
                            <?php endif;?>
                            <div class="word_card size<?=$item['card_size']?>" style=" color:<?=$item['card_fontColor']?>;font-size:<?=$item['card_fontSize']?>px; line-height:<?=$item['card_fontHeight']?>px;"><?=$item['card_name']?></div>
                            
                        </div>
                    </li>   
                    <?php endif;?>
                    <?php endforeach;endif;?>
                    
                </ul>
                </section>
        </div>
    </div>
</div>
<script>
$(function () {
$.sortable({id:'#sortable'});
})

</script>