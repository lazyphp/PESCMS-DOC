<ul class="am-nav am-list-border am-text-sm am-link-muted">
    <?php foreach ($tree as $tk => $tv) : ?>
        <li class="am-nav-header"><?= $tv['title']; ?></li>
            <?php foreach ($tv['child'] as $key => $value) : ?>
            <li class="am-margin-top-0 <?= $_GET['id'] == $key ? 'am-active' : '' ?>">
                <a href="/d/<?= $key; ?>"><?= $value['title']; ?></a>
            </li>
        <?php endforeach; ?>
    <?php endforeach; ?>
</ul>