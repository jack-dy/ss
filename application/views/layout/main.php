<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?=base_url('public/i/favicon.ico')?>"/>
    <meta name="apple-mobile-web-app-title" content="后台"/>
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.min.css')?>"/>
    <link rel="stylesheet" href="<?=base_url('public/css/amazeui.min.css')?>"/>
    <link rel="stylesheet" href="<?=base_url('public/admin/css/app.css?v=time()')?>"/>
    <link rel="stylesheet" href="<?=base_url('public/css/font_783249_3sbba6jrt9y.css')?>"/>
    <script src="<?=base_url('public/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('public/js/font_783249_e5yrsf08rap.js')?>"></script>
    <script>
        //BASE_URL = '<?= isset($base_url) ? $base_url : '' ?>';
        //STORE_URL = '<?= isset($admin_url) ? $admin_url : '' ?>';
        BASE_URL = '<?= base_url('')?>';
        STORE_URL ='<?=site_url('admin')?>';
    </script>
</head>

<body data-type="">
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header class="tpl-header">
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-button switch-button">
                <i class="iconfont icon-menufold"></i>
            </div>
            <!-- 刷新页面 -->
            <div class="am-fl tpl-header-button refresh-button">
                <i class="iconfont icon-refresh"></i>
            </div>
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="<?=site_url('admin/main/index') ?>">欢迎你，<span>admin</span>
                        </a>
                    </li>
                    <!-- 退出 -->
                    <li class="am-text-sm">
                        <a href="<?=site_url('admin/privilege/logout') ?>">
                            <i class="iconfont icon-tuichu"></i> 退出
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- 侧边导航栏 -->
    <div class="left-sidebar dis-flex">
        <?php $menus = $menus ?: array(); ?>
        <?php $group = $group ?: 0;  ?>
        <!-- 一级菜单 -->
        <ul class="sidebar-nav">
            <li class="sidebar-nav-heading">后台管理</li>
            <?php foreach ($menus as $key => $item): ?>
                <li class="sidebar-nav-link">
                    <a href="<?= isset($item['index']) ? site_url($item['index']) : 'javascript:void(0);' ?>"
                       class="<?= $item['active'] ? 'active' : '' ?>">
                        <?= $item['name'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- 子级菜单-->
        <?php $second = isset($menus[$group]['submenu']) ? $menus[$group]['submenu'] : array();  ?>
        <?php if (!empty($second)) : ?>
            <ul class="left-sidebar-second">
                <li class="sidebar-second-title"><?= $menus[$group]['name'] ?></li>
                <li class="sidebar-second-item">
                    <?php foreach ($second as $item) : ?>
                        <?php if (!isset($item['submenu'])): ?>
                            <!-- 二级菜单-->
                            <a href="<?= site_url($item['index']) ?>"
                               class="<?= (isset($item['active']) && $item['active']) ? 'active' : '' ?>">
                                <?= $item['name']; ?>
                            </a>
                        <?php else: ?>
                            <!-- 三级菜单-->
                            <div class="sidebar-third-item">
                                <a href="javascript:void(0);"
                                   class="sidebar-nav-sub-title <?= $item['active'] ? 'active' : '' ?>">
                                    <i class="iconfont icon-caret"></i>
                                    <?= $item['name']; ?>
                                </a>
                                <ul class="sidebar-third-nav-sub">
                                    <?php foreach ($item['submenu'] as $third) : ?>
                                        <li>
                                            <a class="<?= $third['active'] ? 'active' : '' ?>"
                                               href="<?= site_url($third['index']) ?>">
                                                <?= $third['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
            </ul>
        <?php endif; ?>
    </div>

    <!-- 内容区域 start -->
    <div class="tpl-content-wrapper <?= empty($second) ? 'no-sidebar-second' : '' ?>">
        <?php echo $content;?>
    </div>
    <!-- 内容区域 end -->

</div>
<script src="<?=base_url('public/vendor/layer/layer.js')?>"></script>
<script src="<?=base_url('public/js/jquery.form.min.js') ?>"></script>
<script src="<?=base_url('public/js/amazeui.min.js') ?>"></script>
<script src="<?=base_url('public/js/webuploader.html5only.js') ?>"></script>
<script src="<?=base_url('public/js/art-template.js') ?>"></script>

<!-- <script src="<?=base_url('public/vendor/fileupload/jquery.ui.widget.js')?>"></script> -->
<!-- <script src="<?=base_url('public/vendor/fileupload/jquery.iframe-transport.js')?>"></script> -->
<!-- <script src="<?=base_url('public/vendor/fileupload/jquery.fileupload.js')?>"></script> -->

<script src="<?=base_url('public/admin/js/app.js?v=time()') ?>"></script>
<script src="<?=base_url('public/admin/js/file.library.js?v=time()') ?>"></script>
<script src="<?=base_url('public/admin/js/diy.js?v=time()') ?>"></script>
<!-- <script src="<?=base_url('public/admin/js/file2.library.js?v=time()') ?>"></script> -->
</body>

</html>
