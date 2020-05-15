<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>珠宝</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?=base_url('public/i/favicon.ico')?>"/>
    <meta name="apple-mobile-web-app-title" content="后台"/>
    <link rel="stylesheet" href="<?=base_url("public/vendor/font-awesome/css/font-awesome.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/vendor/bootstrap/css/bootstrap.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/vendor/sortable/sortable.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/vendor/Swiper/dist/css/swiper.min.css")?>">
    <link rel="stylesheet" href="<?=base_url('public/vendor/intlTelInput/css/intlTelInput.css')?>">
    <link rel="stylesheet" href="<?=base_url("public/home/css/css.css")?>">
    <script src="<?=base_url("public/js/jquery.min.js")?>"></script>
    <script>
    var base_url ="<?=base_url()?>";
    var site_url ='<?=site_url()?>/';
    </script>
</head>

<body data-spy="scroll">
    <div class="mask"></div>
<nav class="navbar navbar-custom navbar-fixed-top">
        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="<?=site_url('home/index2')?>"><img src="<?=base_url('public/images/logo.svg')?>" alt="alternative"></a>
        <!-- Mobile Menu Toggle Button -->
        
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon">
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar bottom-bar"></span>
                <span class="icon-bar middle-bar"></span>
            </span>
        </button>
        <a class="cart_btn" href="<?=site_url('cart/index')?>"><i class="fa fa-gift"></i>
        <?php $cart_num =count($cart);  if($cart_num):?>
        <span class="carnum"><?=$cart_num?></span>
        <?php endif;?>
        </a>
        <!-- end of mobile menu toggle button -->
        
        <!-- <div class="collapse navbar-collapse" id="navbarsExampleDefault"> -->
            <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?=site_url('home/index2')?>">Home </a>
                    </li>
                    <?php foreach($category as $item):?>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?=site_url('goods/index')."?id=".$item['category_id']?>"><?=$item['name']?></a>
                    </li>
                    <?php endforeach;?>
                    <div class="empty_box1"></div>
                    <?php foreach($style as $item):?>  
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?=site_url('style/index')."?id=".$item['style_id']?>"><?=$item['name']?></a>
                    </li>      
                    <?php endforeach;?>       
            </ul>
        <!-- </div> -->
    </nav>
    

    <!-- 内容区域 start -->
    <section id="content">
        <?php echo $content;?>
    </section>
    <!-- 内容区域 end -->
    <!-- <script src="<?=base_url('public/js/jquery.validate.js')?>"></script> -->
    <script src="<?=base_url('public/vendor/sortable/sortable.min.js')?>"></script>
    <script src="<?=base_url('public/vendor/Swiper/dist/js/swiper.js')?>"></script>
    <script src="<?=base_url('public/vendor/layer/layer.js')?>"></script>
    <script src="<?=base_url('public/js/jquery.form.min.js')?>"></script>
    
    <script src="<?=base_url('public/js/jquery.validate.js')?>"></script>
    <script src="<?=base_url('public/home/js/app.js')?>"></script>
    
</body>
</html>