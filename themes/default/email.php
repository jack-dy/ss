<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    a{text-decoration:none}
        li{list-style:none}
        .wap{width:100%}
        .area{margin:0 auto;padding:0 12px}
        .w1000{margin:0 auto}
        .cart_title{padding:20px 0;position:relative;border-bottom:1px solid #f2f2f2}
        .cart_title h3{color:grey;font-size:20px;font-weight:700;line-height:40px;text-align:center}
        .cart_title .user_country{width:200px;height:28px;margin:0;display:block}
        .cart_list table{width:100%}
        .cart_list table tr{border-top:1px solid #ccc}
        .cart_list table tr td{color:grey;font-size:16px;padding:10px;text-align:center;border-bottom:1px solid#f2f2f2}
        .cart_list table tr td a{color:#005ea7}
        .cart_list table tr td.del_pd a{width:21px;height:25px;background-image:url(../images/del.png);background-repeat:no-repeat;display:block;margin:0 auto}
        .cart_list table tr td.pd_img img{width:100px}
        .cart_list table tr td.pd_qty .pd_qty_cl{height:19px;width:55px;overflow:hidden}
        .cart_list table tr td.pd_qty .pd_qty_cl .decrease{background-position:0 -38px}
        .all_postal{text-align:right;text-align:right;margin:10px 0;margin-right:10px;font-size:16px;color:grey}
        .Cart_totle{text-align:right;margin:10px 0;margin-right:10px;font-size:16px;color:grey}
        .all_totle{text-align:right;text-align:right;margin:10px 0;margin-right:10px;font-size:16px;color:grey}
        .all_postal span{color:grey;font-size:16px}
        .all_totle span{color:red;font-size:26px}
        .user_area{margin:0 auto}
        .user_area .user_title{text-align:center;font-size:21px;line-height:40px;color:grey;clear:both}
        dl.mds{position:relative;margin:0 auto;width:341px}
        dl.mds dt{width:90px;position:absolute;left:0;top:13px;text-align:right;font-size:16px;color:grey}
        dl.mds dt span{margin-right:4px;color:#c00}
        dl.mds dd{margin:0;padding:8px 0 8px 110px;position:relative;color:grey}
        dl.mds dd input{width:227px}
        dl.mds dd textarea{width:227px}
        dl.mds dd label{position:absolute;left:350px;top:10px}
        .user_message{margin-bottom:20px;padding:0}
        .user_message li{float:left}
        .user_message li div{margin:0 5px;font-size:16px;line-height:24px}
        .user_message li div span{margin-right:5px;color:grey;font-size:16px;line-height:24px}
        .user_message li div big{margin-right:35px;border-bottom:1px solid #ccc;color:grey}
        .ky_message{visibility:visible;position:fixed;z-index:11;transition:opacity .3s ease;opacity:1;top:50%;left:50%;transform:translate3d(-50%,-50%,0);-moz-transform:translate3d(-50%,-50%,0);-webkit-transform:translate3d(-50%,-50%,0);text-align:center;font-size:18px;margin:0 auto;text-align:center;padding:27px 34px}
        .back_pd{width:450px;padding-left:70px;padding-top:60px;margin:0 auto;background-image:url(../images/empty_car.png);background-position:left 60px;background-repeat:no-repeat}
        .back_pd p{font-size:14px;line-height:14px;margin:0;margin-bottom:20px;color:grey}
        .back_pd a{font-size:14px;line-height:14px;color:#f0353e;display:block}
        .reconfirm_area dl.mds{width:400px}
        .reconfirm_area dl.mds dt{top:2px;line-height:16px;width:140px}
        .reconfirm_area dl.mds dd{padding:0;padding-left:5px;margin:8px 0 8px 150px;border-bottom:1px solid #ccc;height:23px}
        .operation:after,.prodict_nav ul:after,.top_big_area:after,.top_big_r ul:after,.user_message:after{content:"";display:block;clear:both;height:0;width:0;visibility:hidden}
        @media screen and (max-width:600px){.area{width:100%;margin:0 auto;padding:0 12px}
        
        }
    </style>
</head>
<body>
    <div class="w1000 cart_list cart_title">
		<h3> Order </h3>
        </div>
        <div class="w1000 cart_list">
    	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
        	<tr>

                <td>Product</td>
                <td></td>
                <td>Unit Price</td>
                <td>Qty</td>
                <td>Subtotal</td>
            </tr>

                <?php foreach($list as $item):?>
                    <tr>
                            <td class="pd_img"><img  src="'.base_url('uploads/thumb/').$item['image'][0]?>" /></td>
                            <td class="pd_name"><?=$item['goods_name']?></td>
                            <td class="pd_price"><?=$sel_rate['name']." ".sprintf("%01.2f",$sel_rate['rate']*$item['goods_price'])?></td>
                            <td class="pd_qty"><div class="pd_qty_cl">1</div></td>
                            <td class="pd_single_totle"><?=$sel_rate['name']." ".sprintf("%01.2f",$sel_rate['rate']*$item['goods_price'])?></td>
                        </tr>';
                <?php endforeach;?>  
                </table>
                    <div class="Cart_totle">Cart subtotal : <span><?=$sel_rate['name']?> <?=$calculation['subototal']?></span></div>
                        <div class="all_postal"> Postage : <span><?=$sel_rate['name']?> <?=$calculation['postage']?></span></div>
                        <div class="all_totle">Grand Total amount : <span><?=$sel_rate['name']?> <?=$calculation['amount']?></span></div>
                    </div>
                    <div class="user_area reconfirm_area">
                    <div class="user_title">Contact information</div>
                        <dl class="mds">
                            <dt>Country </dt>
                            <dd><?=$country[$cart_option['cart']['country']]['cy_name_en']?></dd>
                        </dl>
                        <dl class="mds">
                            <dt>Name </dt>
                            <dd><?=$cart_option['cart']['name']?></dd>
                        </dl>
                        <dl class="mds">
                            <dt>Shipping address </dt>
                            <dd style="height:auto;"><?=$cart_option['cart']['address']?></dd>
                        </dl>
                        <dl class="mds">
                            <dt>Email </dt>
                            <dd><?=$cart_option['cart']['email']?></dd>
                        </dl>
                        <dl class="mds">
                            <dt>Phone </dt>
                            <dd><?=$cart_option['cart']['phone']?></dd>
                        </dl>
                        <dl class="mds">
                            <dt>Postal code </dt>
                            <dd><?=$cart_option['cart']['postal']?></dd>
                        </dl>

                    </div>
    
</body>
</html>