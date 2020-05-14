<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="renderer" content="webkit"/>
    <link rel="stylesheet" href="<?=base_url('public/css/amazeui.min.css')?>"/>
    <link rel="stylesheet" href="<?=base_url('public/admin/css/app.css?v=time()')?>"/>
    <script src="<?=base_url('public/js/jquery.min.js')?>"></script>
    <title>商品列表</title>
</head>
<body class="select-data">
<div class="am-scrollable-horizontal am-u-sm-12">
    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black am-text-nowrap">
        <thead>
        <tr>
            <th>
                <label class="am-checkbox">
                    <input data-am-ucheck data-check="all" type="checkbox">
                </label>
            </th>
            <th>商品ID</th>
            <th>商品图片</th>
            <th>商品名称</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($list)): foreach ($list as $item): ?>
            <tr>
                <td class="am-text-middle">
                    <label class="am-checkbox">
                        <input data-am-ucheck data-check="item" data-params='<?= json_encode([
                            'goods_id' => (string)$item['goods_id'],
                            'goods_name' => $item['goods_name'],
                            'image' =>base_url('uploads/thumb/').$item['image'][0],
                            'goods_price' => $item['goods_price'],
                        ], JSON_UNESCAPED_SLASHES) ?>' type="checkbox">
                    </label>
                </td>
                <td class="am-text-middle"><?= $item['goods_id'] ?></td>
                <td class="am-text-middle">
                    <a href="<?=base_url('uploads/').$item['image'][0] ?>"
                       title="点击查看大图" target="_blank">
                        <img src="<?=base_url('uploads/thumb/').$item['image'][0] ?>"
                             width="50" height="50" alt="商品图片">
                    </a>
                </td>
                <td class="am-text-middle">
                    <p class="item-title"><?= $item['goods_name'] ?></p>
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
<div class="am-u-lg-12 am-cf">
    <div class="am-fr"><?= $links ?> </div>
</div>

<script src="<?=base_url('public/js/amazeui.min.js')?>"></script>
<script>

  /**
   * 获取已选择的数据
   * @returns {Array}
   */
  function getSelectedData() {
    var data = [];
    $('input[data-check=item]:checked').each(function () {
      data.push($(this).data('params'));
    });
    return data;
  }

  $(function () {

    // 全选框元素
    var $checkAll = $('input[data-check=all]')
      , $checkItem = $('input[data-check=item]')
      , itemCount = $checkItem.length;

    // 复选框: 全选和反选
    $checkAll.change(function () {
      $checkItem.prop('checked', this.checked);
    });

    // 复选框: 子元素
    $checkItem.change(function () {
      if (!this.checked) {
        $checkAll.prop('checked', false);
      } else {
        var checkedItemNum = $checkItem.filter(':checked').length;
        checkedItemNum === itemCount && $checkAll.prop('checked', true);
      }
    });

  });
</script>
</body>
</html>
