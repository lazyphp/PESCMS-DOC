<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="x-pjax-version" content="v123">

    <title><?= empty($title) ? $system['siteTitle'] : "{$title} - {$system['siteTitle']}" ?></title>

    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <link rel="icon" type="image/png" href="<?= DOCUMENT_ROOT ?>/favicon.ico?v=<?= $resources ?>">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/amazeui.min.css?v=<?=$resources?>">

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/ui-dialog.min.css?v=<?= $resources ?>">

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/create.min.css?v=<?=$resources?>">
    <script>
        var PESCMS_URL = '<?= PESCMS_URL ?>';
        var PESCMS_PATH = '<?= DOCUMENT_ROOT; ?>';
        //MD编辑器渲染作用
        var pesMD = {};
        //MD编辑器上传路径
        var pesMDUploadURL = '<?= $label->url('Create-Upload-mdUpload', ['method' => 'POST']) ?>';
    </script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.min.js?v=<?= $resources ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.min.js?v=<?= $resources ?>"></script>

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-min.js?v=<?= $resources ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-plus-min.js?v=<?= $resources ?>"></script>

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.datetimepicker.min.js?v=<?= $resources ?>"></script>

    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.config.min.js?v=<?= $resources ?>"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.all.min.js?v=<?= $resources ?>"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/lang/zh-cn/zh-cn.min.js?v=<?= $resources ?>"></script>

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/Vditor.min.css?v=<?= $resources ?>"/>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/Vditor.min.js?v=<?= $resources ?>"></script>

    <!--百度上传控件-->
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/webuploader.min.css?v=<?= $resources ?>"/>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/webuploader.min.js?v=<?= $resources ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/AMUIwebuploader.min.js?v=<?= $resources ?>"></script>
    <script>
        $(function(){
            $.webuploaderConfig({
                server:'<?=$label->url('Create-Upload-ueditor', ['method' => 'POST', 'action' => 'uploadimage'])?>'
            });
        })
    </script>
    <!--百度上传控件-->

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/app.min.js?v=<?= $resources ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/create.min.js?v=<?= $resources ?>"></script>
</head>
<body>