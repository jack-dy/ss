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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">中文名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="country[cy_name_en]"
                                            value="<?= $row['cy_name_en'] ?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">英文名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="country[cy_name_cn]"
                                        value="<?= $row['cy_name_cn'] ?>" required>
                                </div>
                            </div>
                            
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">大洲分类 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="country[continent_pid]" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',
                                             placeholder:'请选择大洲分类', maxHeight: 400}">
                                        <option value=""></option>
                                        <?php if (isset($continent)): foreach ($continent as $first): ?>
                                            <option value="<?= $first['c_id'] ?>"
                                            <?= $row['continent_pid'] == $first['c_id'] ? 'selected' : '' ?>
                                            ><?= $first['c_name'] ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= site_url('admin/area_continent/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">邮费地区分类 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="country[postage_pid]" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',
                                             placeholder:'请选择邮费地区分类', maxHeight: 400}">
                                        <option value=""></option>
                                        <?php if (isset($postage)): foreach ($postage as $first): ?>
                                            <option value="<?= $first['pt_id'] ?>"
                                            <?= $row['postage_pid'] == $first['pt_id'] ? 'selected' : '' ?>
                                            ><?= $first['pt_name'] ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= site_url('admin/area_postage/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">国家状态 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="country[cy_status]" value="10" data-am-ucheck
                                        <?= $row['cy_status'] == 10 ? 'checked' : '' ?>>
                                        上线
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="country[cy_status]" value="20" data-am-ucheck
                                        <?= $row['cy_status'] == 20 ? 'checked' : '' ?>>
                                        下线
                                    </label>
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
<script src="<?=base_url('public/admin/js/goods.spec.js')?>"></script>

<script>
    $(function () {

       




        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
        });

    });
</script>
