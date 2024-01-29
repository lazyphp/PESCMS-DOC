<?php if(!empty($space)): ?>
<div class="am-dropdown-layer">
<?php endif; ?>
<ul class="<?= !empty($space) ? '' : 'topbar-menu' ?>">
    <?php foreach ($result as $item): ?>

        <li class="am-dropdown-hover" >
            <a class="am-dropdown-toggle" href="<?= empty($item['menu_link']) ? 'javascript:;' : ($item['menu_type'] == 0 ? $label->url($item['menu_link']) : $item['menu_link']) ?>" <?= $item['menu_window_open'] == 1 ? 'target="_blank"' : '' ?> ><?= $item['menu_name'] ?></a>

            <?php if ($item['menu_type'] == 2 && !empty(\Model\Doc::getDocList())): ?>
                <div class="am-dropdown-layer doc-layer">
                    <div class="am-dropdown-content topbar-submenu">
                        <ul>
                            <?php foreach (\Model\Doc::getDocList() as $doc): ?>
                                <li>
                                    <a href="<?= $label->url('Doc-Article-index', ['id' => $doc['doc_id']]) ?>" <?= $item['menu_window_open'] == 1 ? 'target="_blank"' : '' ?> >
                                        <img src="<?= $doc['doc_cover'] ?>">
                                        <?= $doc['doc_title'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <?php \Model\Menu::recursion($item['menu_id'], $template, 1); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php if(!empty($space)): ?>
    </div>
<?php endif; ?>