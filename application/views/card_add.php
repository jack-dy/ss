<link href="<?=base_url('public/css/bootstrap-colorpicker.css')?>" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('public/admin/css/goods.css')?>">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">基本信息</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">卡片名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="card[card_name]"
                                           value="" required>
                                </div>
                            </div>
                            

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label  form-require">卡片颜色 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input card_background" id="card_background" name="card[card_background]"
                                            value="" required readonly/>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label  form-require">卡片尺寸 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="card[card_size]" value="10" data-am-ucheck
                                               checked>
                                        小
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="card[card_size]" value="20" data-am-ucheck>
                                        中
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="card[card_size]" value="30" data-am-ucheck>
                                        大
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">背景图片 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <div class="am-form-file">
                                            <div class="j-upload" name='card[card_backgroundImage]'>上传图片</div>
         
                                            <div class="uploader-list am-cf">
                                            </div>
                                        </div>
                                        <div class="help-block am-margin-top-sm">
                                            <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">字体</div>
                            </div>
                            

                            <!-- 商品单规格 -->
                            <div class="goods-spec-single">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label  form-require">字体大小 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="text" class="tpl-form-input" name="card[card_fontSize]"
                                               value="" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label  form-require">字体颜色 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="text" class="tpl-form-input card_fontColor" name="card[card_fontColor]"
                                               value="" required readonly/>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">其他</div>
                            </div>
                            
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">卡片排序 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="card[sort]"
                                           value="100" required>
                                    <small>数字越小越靠前</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?=base_url('public/js/vue.min.js')?>"></script>
<script src="<?=base_url('public/js/ddsort.js')?>"></script>
<script src="<?=base_url('public/admin/js/goods.spec.js')?>"></script>
<script src="<?=base_url('public/js/bootstrap-colorpicker.js')?>"></script>

<script>
    

    $(function () {
        $('.card_background').colorpicker();
        $('.card_fontColor').colorpicker();
        $('.card_background').on('change', function (event) {
            $('.card_background').css('color', event.color.toString());
        });
        
        $('.card_fontColor').on('change', function (event) {
            $('.card_fontColor').css('color', event.color.toString());
        });


        //上传图片
        $.uploadImage({
           pick: '.j-upload',  // 上传按钮
           list: '.uploader-list', // 缩略图容器
         });


        // 图片列表拖动
        // $('.uploader-list').DDSort({
        //     target: '.file-item',
        //     delay: 100, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
        //     floatStyle: {
        //         'border': '1px solid #ccc',
        //         'background-color': '#fff'
        //     }
        // });


        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
            
        });

    });
</script>
