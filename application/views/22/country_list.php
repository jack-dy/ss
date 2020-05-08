<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">国家</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <div class="am-u-sm-12 am-u-md-3">
                                <div class="am-form-group">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-success"
                                               href="<?=site_url('admin/area/add') ?>">
                                                <span class="am-icon-plus"></span> 新增
                                            </a>
                                        </div>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-9">
                                <div class="am fr">
                                    <div class="am-form-group am-fl">
                                        <?php $postage_pid = $this->input->get('postage_pid') ?: null; ?>
                                        <select name="postage_pid"
                                                data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder: '邮费地区分类', maxHeight: 400}">
                                            <option value=""></option>
                                            <?php if (isset($postage)): foreach ($postage as $first): ?>
                                                <option value="<?= $first['pt_id'] ?>"
                                                    <?= $postage_pid == $first['pt_id'] ? 'selected' : '' ?>>
                                                    <?= $first['pt_name'] ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $continent_pid = $this->input->get('continent_pid') ?: null; ?>
                                        <select name="continent_pid"
                                                data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder: '大洲分类', maxHeight: 400}">
                                            <option value=""></option>
                                            <?php if (isset($continent)): foreach ($continent as $first): ?>
                                                <option value="<?= $first['c_id'] ?>"
                                                    <?= $continent_pid == $first['c_id'] ? 'selected' : '' ?>>
                                                    <?= $first['c_name'] ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $status = $this->input->get('status') ?: null; ?>
                                        <select name="status"
                                                data-am-selected="{btnSize: 'sm', placeholder: '邮寄国家状态'}">
                                            <option value=""></option>
                                            <option value="10"
                                                <?= $status == 10 ? 'selected' : '' ?>>上线
                                            </option>
                                            <option value="20"
                                                <?= $status == 20 ? 'selected' : '' ?>>下线
                                            </option>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="country_name"
                                                   placeholder="请国家名称"
                                                   value="<?= $this->input->get('country_name') ?>">
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
                                <th>国家ID</th>
                                <th>国家名称(中文)</th>
                                <th>国家名称(英文)</th>
                                <th>国家状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['cy_id'] ?></td>
                                    <td class="am-text-middle">
                                        <p class="item-title"><?=$item['cy_name_cn'] ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p class="item-title"><?=$item['cy_name_en'] ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                           <span class="j-state am-badge x-cur-p
                                           am-badge-<?= $item['cy_status'] == 10 ? 'success' : 'warning' ?>"
                                                 data-id="<?= $item['cy_id'] ?>"
                                                 data-state="<?= $item['cy_status'] ?>">
                                               <?=  $item['cy_status'] == 10 ? '上线' : '下线' ?>
                                           </span>
                                    </td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                                <a href="<?=site_url('admin/area/edit?country_id='.$item['cy_id'])   ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                                   data-id="<?= $item['cy_id'] ?>">
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

        // 商品状态
        $('.j-state').click(function () {
            // 验证权限

            var data = $(this).data();
            layer.confirm('确定要' + (parseInt(data.state) === 10 ? '下线' : '上线') + '该国家吗？'
                , {title: '友情提示'}
                , function (index) {
                    var param = {};
                    param['cy_id'] = data.id;
                    param['state'] = parseInt(data.state) === 10?20:10;
                    console.log(param);
                    $.ajax({
							type: "POST",
							url: "<?= site_url('admin/area/state') ?>",  //同目录下的php文件
							data:param,  // 等号前后不要加空格
							dataType:"JSON",
                            success: function(result){  //请求成功后的回调函数
							    result.code === 1 ? $.show_success(result.msg, result.url)
                                : $.show_error(result.msg);
                            }
						})
                    layer.close(index);
                });

        });

        // 删除元素
        var url = "<?=site_url('admin/area/delete') ?>";
        $('.item-delete').delete('cy_id', url);

    });
</script>

