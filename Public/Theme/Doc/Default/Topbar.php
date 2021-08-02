<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="/"><?= $system['siteTitle'] ?></a>
        </h1>

        <div class="am-collapse am-topbar-collapse am-topbar-hover ">

            <?php \Model\Menu::recursion('0', __DIR__ . '/menu.php') ?>

            <?php require_once THEME_PATH.'/Topbar_login.php'?>
        </div>
    </div>
</header>