<?php if(!empty($space)): ?>
<div class="am-dropdown-layer">
<?php endif; ?>

<ul class="<?= $result[0]['menu_pid'] == 0 ? 'am-nav am-nav-pills am-topbar-nav' : 'am-dropdown-content' ?>">
    <?php foreach ($result as $item): ?>

        <li class="<?= $result[0]['menu_pid'] == 0 ? 'am-dropdown' : '' ?>" >
            <a class="am-dropdown-toggle" href="<?= empty($item['menu_link']) ? 'javascript:;' : ($item['menu_type'] == 0 ? $label->url($item['menu_link']) : $item['menu_link']) ?>"><?= $item['menu_name'] ?></a>

            <?php if($item['menu_type'] == 2 && !empty(\Model\Doc::getDocList())): ?>
                <div class="am-dropdown-layer">
                    <ul class="am-dropdown-content">
                        <?php foreach(\Model\Doc::getDocList() as $doc): ?>
                        <li><a href="<?= $label->url('Doc-Article-index', ['id' => $doc['doc_id']]) ?>"><?= $doc['doc_title'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
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
