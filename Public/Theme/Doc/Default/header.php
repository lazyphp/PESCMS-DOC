<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= empty($title) ? $system['siteTitle'] : "{$title} - {$system['siteTitle']}" ?></title>
    <meta name="author" content="PESCMS">
    <meta name="keywords" content="<?= $docKeyword ?? ($system['keyword'] ?? '') ?>">
    <meta name="description" content="<?= $docDescription ?? ($system['description'] ?? '') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?= DOCUMENT_ROOT ?>/favicon.ico">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/assets/css/amazeui.min.css?v=<?=$resources?>"/>

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/ui-dialog.min.css?v=<?=$resources?>">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/main.min.css?v=<?=$resources?>">

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.min.js?v=<?=$resources?>"></script>


    <script>var PESCMS_PATH = '<?= DOCUMENT_ROOT; ?>';</script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/amazeui.min.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-min.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-plus-min.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.datetimepicker.min.js?v=<?=$resources?>"></script>

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/Vditor.min.css?=<?=$resources?>"/>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/Vditor.min.js?v=<?=$resources?>"></script>

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/app.min.js?v=<?= $resources ?>"></script>
    <?php if(!empty($system['siteStyle'])): ?>
        <style><?= $system['siteStyle'] ?></style>
    <?php endif; ?>
</head>
<body>
