<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">订单详情</div>
                </div>
                <div class="widget-body am-fr">
                <div class="widget-head am-cf">
                        <div class="widget-title am-fl">基本信息</div>
                    </div>
                    <div class="am-scrollable-horizontal">
                        <table class="regional-table am-table am-table-bordered am-table-centered
                            am-text-nowrap am-margin-bottom-xs">
                            <tbody>
                            <tr>
                                <th>订单号</th>
                                <th>买家</th>
                                <th>订单金额</th>
                                <th>交易状态</th>
                                <!-- <?php if ($detail['pay_status']['value'] == 10 && $detail['order_status']['value'] == 10) : ?>
                                    <th>操作</th>
                                <?php endif; ?> -->
                            </tr>
                            <tr>
                                <td><?=$detail['order_no'] ?></td>
                                <td>
                                    <p><?=$address['name'] ?></p>
                                </td>
                                <td class="">
                                    <div class="td__order-price am-text-left">
                                        <ul class="am-avg-sm-2">
                                            <li class="am-text-right">订单总额：</li>
                                            <li class="am-text-right"><?=$detail['currency']?> <?= $detail['total_price'] ?> </li>
                                        </ul>
                                        <ul class="am-avg-sm-2">
                                            <li class="am-text-right">运费金额：</li>
                                            <li class="am-text-right">+ <?=$detail['currency']?> <?= $detail['express_price'] ?></li>
                                        </ul>
                                        <ul class="am-avg-sm-2">
                                            <li class="am-text-right">实付款金额：</li>
                                            <li class="x-color-red am-text-right">
                                            <?=$detail['currency']?> <?= $detail['pay_price'] ?></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <p>付款状态：
                                        <span class="am-badge
                                        <?= $detail['pay_status'] == 20 ? 'am-badge-success' : '' ?>">
                                        <?= $detail['pay_status'] == 20 ? '已支付':'没支付' ?></span>
                                    </p>
                                    <p>发货状态：
                                        <span class="am-badge
                                        <?= $detail['delivery_status'] == 20 ? 'am-badge-success' : '' ?>">
                                        <?= $detail['pay_status'] == 20 ? '已发货':'没发货' ?></span>
                                    </p>

                                    <?php if ($detail['order_status'] == 20 || $detail['order_status'] == 21): ?>
                                        <p>订单状态：
                                            <span class="am-badge am-badge-warning">已取消</span>
                                        </p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">商品信息</div>
                    </div>
                    <div class="am-scrollable-horizontal">
                        <table class="regional-table am-table am-table-bordered am-table-centered
                            am-text-nowrap am-margin-bottom-xs">
                            <tbody>
                            <tr>
                                <th>商品名称</th>
                                <th>商品编码</th>
                                <th>重量(Kg)</th>
                                <th>单价</th>
                                <th>购买数量</th>
                                <th>商品总价</th>
                            </tr>
                            <?php foreach ($goods as $good): ?>
                                <tr>
                                    <td class="goods-detail am-text-middle">
                                        <div class="goods-image">
                                            <img src="<?= base_url('uploads/thumb/').$good['image'] ?>" alt="">
                                        </div>
                                        <div class="goods-info">
                                            <p class="goods-title"><?= $good['goods_name'] ?></p>
                                        </div>
                                    </td>
                                    <td><?= $good['goods_no'] ?: '--' ?></td>
                                    <td><?= $good['goods_weight'] ?: '--' ?></td>
                                    <td><?=$detail['currency']?> <?= $good['goods_price'] ?></td>
                                    <td>×<?= $good['total_num'] ?></td>
                                    <td><?=$detail['currency']?> <?= $good['total_price'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="6" class="am-text-right am-cf">
                                    <span class="am-fr">总计金额：<?=$detail['currency']?> <?= $detail['total_price'] ?></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">收货信息</div>
                    </div>
                    <div class="am-scrollable-horizontal">
                        <table class="regional-table am-table am-table-bordered am-table-centered
                            am-text-nowrap am-margin-bottom-xs">
                            <tbody>
                            <tr>
                                <th>收货人</th>
                                <th>收货电话</th>
                                <th>收货地址</th>
                                <th>邮箱地址</th>
                                <th>国家</th>
                            </tr>
                            <tr>
                                <td><?= $address['name'] ?></td>
                                <td><?= $address['phone'] ?></td>
                                <td><?= $address['detail'] ?></td>
                                <td><?= $address['email'] ?></td>
                                <td><?= $address['country'] ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- 发货信息 -->
                    <?php if ($detail['pay_status'] == 20 && $detail['order_status'] != 20 && $detail['order_status'] != 21): ?>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">发货信息</div>
                        </div>
                        <?php if ($detail['delivery_status'] == 10): ?>
                           <!-- 去发货 -->
                                <a href="javascript:;"  name="send"></a>
                                <form id="delivery" class="my-form am-form tpl-form-line-form" method="post"
                                      action="<?= site_url('admin/order/delivery?order_id='.$detail['order_id']) ?>">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">物流公司 </label>
                                        <div class="am-u-sm-9 am-u-end am-padding-top-xs">
                                            <select name="order[express_id]"
                                                    data-am-selected="{btnSize: 'sm', maxHeight: 240}" required>
                                                <option value=""></option>
                                                <?php if (isset($express_list)): foreach ($express_list as $expres): ?>
                                                    <option value="<?= $expres['express_id'] ?>">
                                                        <?= $expres['express_name'] ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <div class="help-block am-margin-top-xs">
                                                <small>可在 <a href="<?= site_url('admin/setting_express/index') ?>" target="_blank">物流公司列表</a>
                                                    中设置
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">物流单号 </label>
                                        <div class="am-u-sm-9 am-u-end">
                                            <input type="text" class="tpl-form-input" name="order[express_no]" required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                            <button type="submit" class="j-submit am-btn am-btn-sm am-btn-secondary">
                                                确认发货
                                            </button>
                                        </div>
                                    </div>
                                </form>     
                        <?php else: ?>
                            <div class="am-scrollable-horizontal">
                                <table class="regional-table am-table am-table-bordered am-table-centered
                                    am-text-nowrap am-margin-bottom-xs">
                                    <tbody>
                                    <tr>
                                        <th>物流公司</th>
                                        <th>物流单号</th>
                                        <th>发货状态</th>
                                        <th>发货时间</th>
                                    </tr>
                                    <tr>
                                        <td><?= $detail['express_company'] ?></td>
                                        <td><?= $detail['express_no'] ?></td>
                                        <td>
                                             <span class="am-badge
                                            <?= $detail['delivery_status'] == 20 ? 'am-badge-success' : '' ?>">
                                                    已发货</span>
                                        </td>
                                        <td>
                                            <?= date('Y-m-d H:i:s', $detail['delivery_time']) ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {

       

    });

</script>

