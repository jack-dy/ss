<div class=" container p15">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box_t"><h2><?=$title?></h2></div>
                    <section class="lists">
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