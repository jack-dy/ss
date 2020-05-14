<?php foreach($page as $pageItem):?>

<?php endforeach;?>
<style>
    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
    }
    .swiper-container {
        width: 500px;
        height: 300px;
        margin: 20px auto;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    </style>
<header id="header" class="header">
        <div class="swiper-container header-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image:url(<?=base_url('public/images/d1.jpg')?>)"></div>
                <div class="swiper-slide" style="background-image:url(<?=base_url('public/images/d2.jpg')?>)"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        
    </header>
<script>
$(function(){
    $.swiper({id:'.header-swiper',number:1})
})

</script>