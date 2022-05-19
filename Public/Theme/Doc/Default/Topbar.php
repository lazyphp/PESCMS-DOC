<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="<?= DOCUMENT_ROOT ?>"><?= $system['siteTitle'] ?></a>
        </h1>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}">
            <span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse am-topbar-hover " id="doc-topbar-collapse">

            <?php \Model\Menu::recursion('0', __DIR__ . '/menu.php') ?>

            <?php require_once THEME_PATH.'/Topbar_login.php'?>
        </div>
    </div>
</header>