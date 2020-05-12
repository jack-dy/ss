<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf"><?= $title ?></div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form id="form-search" class="toolbar-form" action="">
                            
                            <div class="am-u-sm-12 am-u-md-9">
                                <div class="am fr">
                                    <div class="am-form-group tpl-form-border-form am-fl">
                                        <input type="text" name="start_time"
                                               class="am-form-field"
                                               autocomplete="off"
                                               value="<?= $this->input->get('start_time') ?: ''; ?>" placeholder="请选择起始日期"
                                               data-am-datepicker>
                                    </div>
                                    <div class="am-form-group tpl-form-border-form am-fl">
                                        <input type="text" name="end_time"
                                               class="am-form-field"
                                               autocomplete="off"
                                               value="<?= $this->input->get('end_time') ?: ''; ?>" placeholder="请选择截止日期"
                                               data-am-datepicker>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="order_no"
                                                   placeholder="请输入订单号"
                                                   value="<?= $this->input->get('order_no') ?: ''; ?>">
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
                    <div class="order-list am-scrollable-horizontal am-u-sm-12 am-margin-top-xs">
                        <table width="100%" class="am-table am-table-centered
                        am-text-nowrap am-margin-bottom-xs">
                            <thead>
                            <tr>
                                <th width="30%" class="goods-detail">商品信息</th>
                                <th width="10%">单价/数量</th>
                                <th width="15%">实付款</th>
                                <th>买家</th>
                                <th>交易状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $order): ?>
                                <tr class="order-empty">
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                    <td class="am-text-middle am-text-left" colspan="6">
                                        <span class="am-margin-right-lg"> <?= date('Y-m-d H:i:s',$order['create_time']) ?></span>
                                        <span class="am-margin-right-lg">订单号：<?= $order['order_no'] ?></span>
                                    </td>
                                </tr>
                                <?php $i = 0;

                                foreach ($order['goods'] as $goods): $i++;  ?>
                                    <tr>
                                        <td class="goods-detail am-text-middle">
                                            <!-- <div class="goods-image">
                                                <img src="<?= $goods['image'] ?>" alt="">
                                            </div> -->
                                            <div class="goods-info">
                                            <a href="<?=base_url('uploads/thumb/').$goods['image']?>" target="_block"><img src="<?=base_url('uploads/thumb/').$goods['image']?>" alt=""></a>
                                                <p class="goods-title"><?= $goods['goods_name'] ?></p>
                                                
                                            </div>
                                        </td>
                                        <td class="am-text-middle">
                                            <p><?=$order['currency']?> <?= $goods['goods_price'] ?></p>
                                            <p>×<?= $goods['total_num'] ?></p>
                                        </td>
                                        <?php if ($i === 1) : $goodsCount = count($order['goods']); ?>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p><?=$order['currency']?> <?= $order['pay_price'] ?></p>
                                                <p class="am-link-muted">(含运费：<?=$order['currency']?> <?= $order['express_price'] ?>)</p>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                               用户名
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p>订单状态：
                                                <?php if ($order['order_status'] == 10 ): ?>
                                                    <?php if ($order['delivery_status'] == 10 ): ?>   
                                                        <span class="am-badge ">进行中</span>
                                                    <?php else: ?>
                                                        <span class="am-badge am-badge-success">已发货</span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($order['order_status'] == 20 || $order['order_status'] == 21): ?>
                                                        <span class="am-badge am-badge-warning">已取消</span>
                                                <?php endif; ?>
                                                <?php if ($order['order_status'] == 30 ): ?>
                                                        <span class="am-badge am-badge-success">已完成</span>
                                                <?php endif; ?>
                                                </p>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <div class="tpl-table-black-operation">
                                                        <a class="tpl-table-black-operation-green"
                                                           href="<?= site_url('admin/order/detail?order_id='.$order['order_id']) ?>">
                                                            订单详情</a>
                                                        <?php if ( $order['order_status']== 10): ?>

                                                            <?php if ( $order['pay_status']== 10): ?>
                                                            <a class="tpl-table-black-operation item-pay"  data-id="<?= $order['order_id'] ?>" href="javascript:;" >手动付款</a>
                                                            <?php elseif($order['delivery_status']== 10):?>
                                                            <a class="tpl-table-black-operation"  href="<?= site_url('admin/order/detail?order_id='.$order['order_id'].'#send') ?>">去发货</a>
                                                            <?php endif; ?>
                                                            <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                                            data-id="<?= $order['order_id'] ?>">
                                                                <i class="am-icon-trash"></i> 取消订单
                                                            </a>
                                                        <?php endif; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $links ?> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {

        /**
         * 订单导出
         */
        // 取消订单
        var url = "<?=site_url('admin/order/delete') ?>";
        $('.item-delete').delete('order_id', url);

        var pay_url ="<?=site_url('admin/order/toPay')?>";
        $('.item-pay').topay('order_id', pay_url);

    });

</script>

