/**
 * jquery全局函数封装
 */
(function ($) {
    /**
     * Jquery类方法
     */
    $.fn.extend({    
        
    });

        /**
     * Jquery全局函数
     */
    $.extend({
        /*  $.uploadImage({id:'#aa'}) */
        sortable:function(option){
            document.querySelector(option.id).sortablejs();
        },
         /*  $.swiper({id:'#aa'}) */
        swiper:function(option){
            var galleryTop = new Swiper(option.id, {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                spaceBetween: 10,
                //loop:true,
                loopedSlides: 5, //looped slides should be the same     
            });
            // var galleryThumbs = new Swiper('.gallery-thumbs', {
            //     spaceBetween: 10,
            //     slidesPerView: option.number,
            //     touchRatio: 0.2,
            //     loop:true,
            //     loopedSlides: 5, //looped slides should be the same
            //     slideToClickedSlide: true
            // });

            galleryTop.params.control = galleryThumbs;
            //galleryThumbs.params.control = galleryTop;
        },

        /**
         * 操作成功弹框提示
         * @param msg
         * @param fn
         */
        show_success: function (msg, fn,url) {
            layer.msg(msg, {
                icon: 1
                , time: 1200
                // , anim: 1
                , shade: 0.5
                , end: function () {
                    (fn !== undefined && url.length > 0) ? '' : '';
                }
            });
        },

        /**
         * 操作失败弹框提示
         * @param msg
         * @param reload
         */
        show_error: function (msg, reload) {
			console.log(msg);
            var time = reload ? 1200 : 0;
            layer.alert(msg, {
                title: '提示'
                , icon: 2
                , time: time
                , anim: 6
                , end: function () {
                    reload && window.location.reload();
                }
            });
        }

    });

})(jQuery);

$(function () {
    // 封装绑定PC端的点击事件与mobile端点击事件，zepto.js
    var UA = window.navigator.userAgent;
    var CLICK = 'click';
    if(/ipad|iphone|android/.test(UA)){
        CLICK = 'tap';
    }
    clickShowMask('.navbar-toggle');//方法调用
    var returnBtn = $(".returnBtn");
    returnBtn[CLICK](function(){
        $(".mask").hide(); 
        $(".navbar-nav").hide();
        $("body").css({overflow:'auto',position:'relative'});
    });

    function clickShowMask(docBtn){
        
        var item = $(docBtn);
        var width = "";
        item[CLICK](function(){
            if($(".mask").css('display')=='none'){
                $(".mask").show();
                $(".navbar-nav").show();
                $("body").css({overflow:'hidden',position:'fixed'});
            }else{
                $(".mask").hide();
                $(".navbar-nav").hide();
                $("body").css({overflow:'auto',position:'relative'});
            }
            
        });
        // 点击遮罩层隐藏侧边栏
        var mask = $(".mask");
        mask[CLICK](function(){
            $(this).hide(); 
            $(".navbar-nav").hide();
            $("body").css({overflow:'auto',position:'relative'});
        });
    };



})


function ajax(url, type, params,successfn){
    console.log(params);
    $.ajax({
        url: url,
        type: type,
        data: params,
        dataType:'json',
        
        success: function (res) {
            successfn(res);
        },
        error: function (res) {
            //console.log(res);
            //errorfn(res);            
        },
        complete:function(){
            //console.log('结束 看需要写不写');
        }
    });
}

// function ajax(url, type, params, beforefn, successfn, errorfn){
//     $.ajax({
//         url: url,
//         type: type,
//         data: params,
//         dataType:'json',
//         beforeSend:function(res){
//             beforefn(res)
//             console.log('看需要写不写,发送前的就是放加载图标的地方,这里显示,success和error函数里就隐藏');
//         },
//         success: function (res) {
//             successfn(res);
//         },
//         error: function (res) {
//             errorfn(res);            
//         },
//         complete:function(){
//             console.log('结束 看需要写不写');
//         }
//     });
// }



    
    
