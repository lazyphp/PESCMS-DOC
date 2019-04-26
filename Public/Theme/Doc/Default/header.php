<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= empty($title) ? '' : "{$title} - "; ?><?= $system['sitetitle']; ?></title>
    <meta name="author" content="PESCMS">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?= DOCUMENT_ROOT ?>/favicon.ico">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/amazeui.min.css?=<?= $system['version'] ?>"/>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/timelog.css?=<?= $system['version'] ?>"/>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/admin.css?=<?= $system['version'] ?>"/>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/ui-dialog.css?=<?= $system['version'] ?>">


    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.min.js?=<?= $system['version'] ?>"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js?=<?= $system['version'] ?>"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js?=<?= $system['version'] ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.ie8polyfill.min.js?=<?= $system['version'] ?>"></script>
    <![endif]-->
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/amazeui.min.js?=<?= $system['version'] ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-min.js?=<?= $system['version'] ?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-plus-min.js?=<?= $system['version'] ?>"></script>

    <?php if(!empty(\Core\Func\CoreFunc::session()->get('user')['user_id'])): ?>
        <!--加载百度编辑器-->
        <script>var path = '<?= DOCUMENT_ROOT; ?>';</script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.config.js?=<?= $system['version'] ?>"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.all.js?=<?= $system['version'] ?>"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/lang/zh-cn/zh-cn.js?=<?= $system['version'] ?>"></script>
        <!--加载百度编辑器-->
        <!--让百度支持Markdown-->
        <script type="text/javascript" charset="utf-8" src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/dialogs/markdown/editorshowdown.js?=<?= $system['version'] ?>"></script>
        <!--让百度支持Markdown-->
        <!--百度上传控件-->
        <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/webuploader.css?=<?= $system['version'] ?>"/>
        <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/webuploader.js?=<?= $system['version'] ?>"></script>
        <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/AMUIwebuploader.js?=<?= $system['version'] ?>"></script>
        <script>
            $(function(){
                $.webuploaderConfig({
                    server:'<?=$label->url(GROUP.'-Upload-ueditor', ['method' => 'POST', 'action' => 'uploadimage'])?>'
                });
            })
        </script>
        <!--百度上传控件-->
    <?php endif; ?>

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/app.js?=<?= $system['version'] ?>"></script>

</head>
<body>
