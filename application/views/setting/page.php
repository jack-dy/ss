<link rel="stylesheet" href="<?=base_url('public/vendor/umeditor/themes/default/css/umeditor.css')?>">
<link rel="stylesheet" href="<?=base_url('public/admin/css/diy.css')?>">
<div class="row-content am-cf">
    <div class="widget am-cf">
        <div class="widget-body">
            <!-- diy 工作区 -->
            <div class="work-diy dis-flex flex-x-between">
                <!-- 工具栏 -->
                <div id="diy-menu" class="diy-menu">
                    <div class="menu-title"><span>组件库</span></div>
                    <div class="navs">
                        <div class="navs-group">
                            <div class="title">媒体组件</div>
                            <div class="navs-components am-cf">
                                <nav class="special" data-type="banner">
                                    <p class="item-icon"><i class="iconfont icon-tupianlunbo"></i></p>
                                    <p>图片轮播</p>
                                </nav>
                                <nav class="special" data-type="imageSingle">
                                    <p class="item-icon"><i class="iconfont icon-tupian1"></i></p>
                                    <p>单图组</p>
                                </nav>
                                <nav class="special" data-type="window">
                                    <p class="item-icon"><i class="iconfont icon-newbilayout"></i></p>
                                    <p>图片橱窗</p>
                                </nav>
                            </div>
                            <div class="title">商城组件</div>
                            <div class="navs-components am-cf">
                                
                                <nav class="special" data-type="goods">
                                    <p class="item-icon"><i class="iconfont icon-shangpin5"></i></p>
                                    <p>商品组</p>
                                </nav>
                            </div>
                            <div class="title">工具组件</div>
                            <div class="navs-components am-cf">
                                <nav class="special" data-type="blank">
                                    <p class="item-icon"><i class="iconfont icon-kongbai"></i></p>
                                    <p>辅助空白</p>
                                </nav>
                                <nav class="special" data-type="guide">
                                    <p class="item-icon"><i class="iconfont icon-fengexian1"></i></p>
                                    <p>辅助线</p>
                                </nav>
                                <nav class="special" data-type="richText">
                                    <p class="item-icon"><i class="iconfont icon-wenbenbianji"></i></p>
                                    <p>富文本</p>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="action">
                        <button id="submit" type="button" class="am-btn am-btn-xs am-btn-secondary">
                            保存页面
                        </button>
                    </div>
                </div>
                <!--手机diy容器-->
                <div class="diy-phone">
                    <!-- 手机顶部标题 -->
                    <!-- <div id="diy-page" class="phone-top optional __no-move" data-type="page"></div> -->
                    <!-- 小程序内容区域 -->
                    <div id="phone-main" class="phone-main am-scrollable-vertical"></div>
                </div>
                <!-- 编辑器容器 -->
                <div id="diy-editor" class="diy-editor form-horizontal">
                    <div class="inner"></div>
                </div>
            </div>
            <!-- 提示 -->
        </div>
    </div>
</div>

<!-- 文件库弹窗 -->
<!-- {{include file="layouts/_template/file_library" /}} -->

<!--diy元素-->
<?php $this->load->view('setting/diy');?>
<!-- {{include file="setting/page/diy" /}} -->

<!--编辑器: 搜索栏-->
<?php $this->load->view('setting/editor');?>
<!-- {{include file="wxapp/page/tpl/editor" /}} -->

<script src="<?=base_url('public/js/ddsort.js')?>"></script>
<script src="<?=base_url('public/admin/js/select.data.js')?>"></script>
<script src="<?=base_url('public/vendor/umeditor/umeditor.config.js')?>"></script>
<script src="<?=base_url('public/vendor/umeditor/umeditor.min.js')?>"></script>
<script src="<?=base_url('public/admin/js/diy.js')?>"></script>
<script>
    $(function () {

        // 渲染diy页面
        new diyPhone(<?= $jsonData ?: '{}' ?>);

    });
</script>
