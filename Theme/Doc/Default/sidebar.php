<?php if ($_SESSION['user']['user_id']): ?>
    <button class="am-btn am-btn-success tm-full-width" data-am-offcanvas="{target: '#doc-oc-demo3'}">排序</button>
<?php endif; ?>
<ul class="am-nav am-list-border am-text-sm am-link-muted">
    <?php foreach ($tree as $tk => $tv) : ?>
        <li class="am-nav-header"><?= $tv['title']; ?></li>
        <?php foreach ($tv['child'] as $key => $value) : ?>
            <li class="am-margin-top-0 <?= $_GET['id'] == $key ? 'am-active' : '' ?>">
                <a href="<?= $label->url("Doc-Index-view", ['id' => $key, 'tree' => $_GET['tree']]); ?>"><?= $value['title']; ?></a>
            </li>
        <?php endforeach; ?>
    <?php endforeach; ?>
</ul>