<!doctype html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= empty($title) ? '' : "{$title} - "; ?>PESCMS DOC</title>
        <meta name="author" content="PESCMS">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="/favicon.ico">
        <!--部分样式和脚本在页脚-->
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/jquery.min.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.config.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.all.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/lang/zh-cn/zh-cn.js"></script>
    </head>
    <body>
        <header class="am-topbar am-margin-bottom-0 tm-background-color-white">
            <h1 class="am-topbar-brand">
                <a href="/">PESCMS 文档系统</a>
            </h1>

            <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">

                <div class="am-topbar-right">
                    <?php if ($login === false): ?>
                        <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm tm-text-color-white" href="/d/login">管理</a>
                    <?php else: ?>
                        <a class="am-btn am-btn-success am-topbar-btn am-btn-sm tm-text-color-white" href="/d/new"><i class="am-icon-edit"></i> 新文档</a>
                        <a class="am-btn am-btn-warning am-topbar-btn am-btn-sm tm-text-color-white" href="/d/manage"><i class="am-icon-code-fork"></i> 管理文档</a>
                        <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm tm-text-color-white" href="/d/logout"><i class="am-icon-power-off"></i> 注销</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>