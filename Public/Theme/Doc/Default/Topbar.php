<header class="topbar">
    <div class="topbar-container">
        <h1 class="topbar-logo">
            <a href="/"><?= $system['siteTitle'] ?></a>
        </h1>

        <?php \Model\Menu::recursion('0', __DIR__ . '/menu.php') ?>

        <?php require_once THEME_PATH.'/Topbar_login.php'?>
    </div>
</header>