<main>
    <div class="home-page">
        <?php if ($themeSetting['title_display'] == '1'): ?>
            <?php require_once __DIR__ . '/Index_title.php' ?>
        <?php endif; ?>

        <?php if ($themeSetting['search'] == '1'): ?>
            <?php require_once __DIR__ . '/Index_search.php' ?>
        <?php endif; ?>

        <?php
        switch ($themeSetting['doc_type']) {
            case 0:
                require_once __DIR__ . '/Index_doc_tabs.php';
                break;
            case 1:
                require_once __DIR__ . '/Index_doc_list.php';
                break;
            case 2:
                require_once __DIR__ . '/Index_doc_cover.php';
                break;
        }
        ?>
    </div>
</main>
