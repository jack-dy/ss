<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="<?=base_url('public/js/jquery.min.js')?>"></script>
</head>
<body>
<!-- <form action="<?php echo site_url('admin/upload/image'); ?>" method="post" enctype="multipart/form-data"> -->
<div id="uploadBtn" class="btn btn-upload">上传文件</div>
        <!-- <input type="submit" name="submit" value="submit">
    </form> -->
</body>
<!-- <script type="text/javascript" src="<?=base_url('jquery-1.10.1.min.js')?>"></script> -->
<!-- <script type="text/javascript" src="<?=base_url('webuploader.js')?>"></script> -->
<script src="<?=base_url('public/js/webuploader.html5only.js') ?>"></script>
<script>
    //初始化WebUploader
var uploader = WebUploader.create({
    //swf文件路径
    //swf: 'http://www.ssss.com.cn/js/webuploader/Uploader.swf',
    //文件接收服务端。
    //server: 'webuploader-master/server/fileupload.php',
    server:'<?=site_url("admin/upload/image")?>',
    //选择文件的按钮，可选。内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#uploadBtn',
    //不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
    resize: false,
    auto:true,
    //是否分片
    chunked :true,
    //分片大小
    chunkSize :1024*1024*2,
    chunkRetry :3,
    threads :3,//最大并发
    fileNumLimit :1,
    fileSizeLimit :1024*1024*1024*1024,
    fileSingleSizeLimit: 1024*1024*1024,
    duplicate :true,
    accept: {
        title: 'file',
        extensions: 'jpg,png,ai,zip,rar,psd,pdf,cdr,psd,tif',
        mimeTypes: '*/*'
    }
});

//当文件被加入队列之前触发，此事件的handler返回值为false，则此文件不会被添加进入队列。
uploader.on('beforeFileQueued',function(file){
    console.log(111);
    if(",jpg,png,ai,zip,rar,psd,pdf,cdr,psd,tif,".indexOf(","+file.ext+",")<0){
        alert("不支持的文件格式");
    }
});

</script>
</html>