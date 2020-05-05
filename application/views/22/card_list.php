<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">卡片列表</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <div class="am-u-sm-12 am-u-md-3">
                                <div class="am-form-group">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-success"
                                               href="<?=site_url('admin/card/add') ?>">
                                                <span class="am-icon-plus"></span> 新增
                                            </a>
                                        </div>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-9">
                                
                                    <!-- <div class="am-form-group am-fl">
                                        <?php $goods_status = $this->input->get('goods_status') ?: null; ?>
                                        <select name="goods_status"
                                                data-am-selected="{btnSize: 'sm', placeholder: '商品状态'}">
                                            <option value=""></option>
                                            <option value="10"
                                                <?= $goods_status == 10 ? 'selected' : '' ?>>上架
                                            </option>
                                            <option value="20"
                                                <?= $goods_status == 20 ? 'selected' : '' ?>>下架
                                            </option>
                                        </select>
                                    </div> -->
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="card_name"
                                                   placeholder="请输入卡片名称"
                                                   value="<?= $this->input->get('card_name') ?>">
                                            <div class="am-input-group-btn">
                                                <button class="am-btn am-btn-default am-icon-search"
                                                        type="submit"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>卡片ID</th>
                                <th>卡片背景图片</th>
                                <th>卡片名称</th>
                                <th>商品排序</th>
                                <!-- <th>商品状态</th> -->
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['card_id'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if(!empty($item['card_backgroundImage'])): ?>
                                            <a href="<?= $item['card_backgroundImage'] ?>"
                                           title="点击查看大图" target="_blank">
                                            <img src="<?= base_url('uploads/thumb/').$item['card_backgroundImage'] ?>"
                                                 width="50" height="50" alt="卡片背景图片">
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle">
                                        <p class="item-title"><?=$item['card_name'] ?></p>
                                    </td>
                                    <td class="am-text-middle"><?=$item['sort'] ?></td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                                <a href="<?=site_url('admin/card/edit?card_id='.$item['card_id'])   ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                                   data-id="<?= $item['card_id'] ?>">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="9" class="am-text-center">暂无记录</td>
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
        var url = "<?=site_url('admin/card/delete') ?>";
        $('.item-delete').delete('card_id', url);

    });
</script>

