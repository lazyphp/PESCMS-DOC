<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= empty($title) ? '' : "{$title} - "; ?><?= $siteTitle; ?></title>
    <meta name="author" content="PESCMS">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?= DOCUMENT_ROOT ?>/favicon.ico">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/timelog.css"/>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/admin.css"/>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/ui-dialog.css">


    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.min.js"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/amazeui.min.js"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-min.js"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-plus-min.js"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/timelog.js"></script>

    <!--加载百度编辑器-->
    <script>var path = '<?= DOCUMENT_ROOT; ?>';</script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.config.js"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.all.js"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/lang/zh-cn/zh-cn.js"></script>
    <!--加载百度编辑器-->

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/app.js"></script>

</head>
<body>
<header class="am-topbar am-margin-bottom-0 tm-background-color-white">
    <h1 class="am-topbar-brand">
        <a href="<?= DOCUMENT_ROOT; ?>/"><?= $siteTitle; ?></a>
    </h1>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
            class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    文档列表 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <?php foreach ($treeList as $key => $value): ?>
                        <?php if ($value['tree_parent'] == '0'): ?>
                            <li class="<?= ($key == 0 && empty($_GET['tree'])) || $_GET['tree'] == $value['tree_id'] ? 'am-active' : ''; ?>">
                                <a href="<?= $label->url("/d/index/{$value['tree_id']}", true); ?>"><?= $value['tree_title']; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
        <form class="am-topbar-form am-topbar-left am-form-inline" method="GET" action="<?= DOCUMENT_ROOT ?>/" role="search">
            <input type="hidden" name="m" value="Search">
            <input type="hidden" name="a" value="index">
            <input type="hidden" name="tree" value="<?= (int) $_GET['tree']; ?>">
            <div class="am-form-group am-input-group">
                <input type="text" class="am-form-field" name="keyword" value="<?= htmlspecialchars($_GET['keyword']); ?>" placeholder="搜索">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="submit"><span class="am-icon-search"></span></button>
                </span>
            </div>
        </form>

        <div class="am-topbar-right">
            <?php if ($login === false): ?>
                <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('/d/login', true); ?>">管理</a>
            <?php else: ?>
                <a class="am-btn am-btn-success am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('/d/new', true); ?>"><i
                        class="am-icon-edit"></i> 新文档</a>
                <a class="am-btn am-btn-warning am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('/d/manage', true); ?>"><i
                        class="am-icon-code-fork"></i> 管理文档</a>
                <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm tm-text-color-white" href="<?= $label->url('/d/logout', true); ?>"><i
                        class="am-icon-power-off"></i> 注销</a>
            <?php endif; ?>
        </div>
    </div>
</header>