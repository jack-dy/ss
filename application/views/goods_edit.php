<link rel="stylesheet" href="<?=base_url('public/admin/css/goods.css')?>">
<link rel="stylesheet" href="<?=base_url('public/vendor/umeditor/themes/default/css/umeditor.css')?>">
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="goods[goods_name]"
                                           value="<?= $row['goods_name'] ?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品分类 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="goods[category_id]" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',
                                             placeholder:'请选择商品分类', maxHeight: 400}">
                                        <option value=""></option>
                                        <?php if (isset($category)): foreach ($category as $first): ?>
                                            <option value="<?= $first['category_id'] ?>"
                                                <?= $row['category_id'] == $first['category_id'] ? 'selected' : '' ?>>
                                                <?= $first['name'] ?></option>
                                            <?php if (isset($first['child'])): foreach ($first['child'] as $two): ?>
                                                <option value="<?= $two['category_id'] ?>"
                                                    <?= $row['category_id'] == $two['category_id'] ? 'selected' : '' ?>>
                                                    　　<?= $two['name'] ?></option>
                                                <?php if (isset($two['child'])): foreach ($two['child'] as $three): ?>
                                                    <option value="<?= $three['category_id'] ?>"
                                                        <?= $row['category_id'] == $three['category_id'] ? 'selected' : '' ?>>
                                                        　　　<?= $three['name'] ?></option>
                                                <?php endforeach; endif; ?>
                                            <?php endforeach; endif; ?>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small class="am-margin-left-xs">
                                    <a href="<?= site_url('admin/goods_category/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品风格 </label>
                                <div class="am-u-sm-6 ">
                                    <?php foreach($goods_style as $key=>$item):?>
                                    <input type="checkbox" <?php if(in_array($key,$row['goodsStyle'])):?>checked<?php endif;?> name="goods[goodsStyle][]" value="<?=$key?>" id="goods_style_<?=$key?>"><label class="am-form-label2" for="goods_style_<?=$key?>"><?=$item['goodsStyle_name']?></label>
                                    <?php endforeach;?>
                                </div>
                                <div class="am-u-sm-3 am-u-end">
                                    
                                    <small class="am-margin-left-xs">
                                        <a href="<?= site_url('admin/goods_style/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品图片 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                    <div class="j-upload" name='goods[images][]'>上传图片</div>
                                        <!-- <button type="button"
                                                class="upload-file am-btn am-btn-secondary am-radius">
                                            <i class="am-icon-cloud-upload"></i> 选择图片
                                        </button> -->
                                        <div class="uploader-list am-cf">
                                            <?php foreach ($row['image'] as $key => $item): ?>
                                                <div class="file-item">
                                                    <a href="<?= $item ?>" title="点击查看大图" target="_blank">
                                                        <img src="<?= base_url('uploads/thumb/').$item ?>">
                                                    </a>
                                                    <input type="hidden" name="goods[images][]"
                                                           value="<?= $item ?>">
                                                    <i class="iconfont icon-shanchu file-item-delete"></i>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="help-block am-margin-top-sm">
                                        <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">规格/库存</div>
                            </div>
                            

                            

                            <!-- 商品单规格 -->
                            <div class="goods-spec-single">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品编码 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="text" class="tpl-form-input" name="goods[goods_no]"
                                               value="<?= $row['goods_no'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品价格 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[goods_price]"
                                               value="<?= $row['goods_price'] ?>" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">当前库存数量 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[stock_num]"
                                               value="<?= $row['stock_num'] ?>" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品重量(g) </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[goods_weight]"
                                               value="<?= $row['goods_weight'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">商品详情</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品详情 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <!-- 加载编辑器的容器 -->
                                    <textarea id="container" name="goods[content]"><?= $row['content'] ?></textarea>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">其他</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品状态 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[goods_status]" value="10" data-am-ucheck
                                            <?= $row['goods_status'] == 10 ? 'checked' : '' ?> >
                                        上架
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[goods_status]" value="20" data-am-ucheck
                                            <?= $row['goods_status'] == 20 ? 'checked' : '' ?> >
                                        下架
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品排序 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="goods[sort]"
                                           value="<?= $row['sort'] ?>" required>
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

<!-- 图片文件列表模板 -->
<!-- {{include file="layouts/_template/tpl_file_item" /}} -->

<!-- 文件库弹窗 -->
<!-- {{include file="layouts/_template/file_library" /}} -->

<script src="<?=base_url('public/js/vue.min.js')?>"></script>
<script src="<?=base_url('public/js/ddsort.js')?>"></script>
<script src="<?=base_url('public/vendor/umeditor/umeditor.config.js')?>"></script>
<script src="<?=base_url('public/vendor/umeditor/umeditor.min.js')?>"></script>
<script src="<?=base_url('public/admin/js/goods.spec.js')?>"></script>

<script>
    $(function () {

        // 富文本编辑器
        UM.getEditor('container', {
            initialFrameWidth: 375 + 15,
            initialFrameHeight: 600
        });

        //上传图片
        $.uploadImages({
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
