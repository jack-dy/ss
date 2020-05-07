<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">邮费地区分类</div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a class="am-btn am-btn-default am-btn-success am-radius"
                                        href="<?= site_url('admin/area_postage/add') ?>">
                                        <span class="am-icon-plus"></span> 新增
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                            <thead>
                            <tr>
                                <th>邮费地区ID</th>
                                <th>邮费地区名称</th>
                                <th>首重（50g）</th>
                                <th>续重（50g-100g）</th>
                                <th>续重2（100g以后每10g）</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $first): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $first['pt_id'] ?></td>
                                    <td class="am-text-middle"><?= $first['pt_name'] ?></td>
                                    <td class="am-text-middle"><?= $first['pt_price'] ?></td>
                                    <td class="am-text-middle"><?= $first['pt_price_add'] ?></td>
                                    <td class="am-text-middle"><?= $first['pt_price_add2'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">

                                                <a href="<?= site_url('admin/area_postage/edit?pt_id='.$first['pt_id']) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                                   data-id="<?= $first['pt_id'] ?>">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="5" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        // 删除元素
        var url = "<?= site_url('admin/area_postage/delete') ?>";
        $('.item-delete').delete('pt_id', url);

    });
</script>

