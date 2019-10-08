<?php include 'sidebar_header.php'; ?>
<?php include 'sidebar_topbar.php'; ?>
    <main>
        <?php include 'sidebar.php'; ?>
        <?php include $file; ?>

        <?php include 'sidebar_listsort.php'; ?>
        <a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
            <span class="am-icon-btn am-icon-th-list"></span>
        </a>
    </main>
<?php include "sidebar_footer.php"; ?>