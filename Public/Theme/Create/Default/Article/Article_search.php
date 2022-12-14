<?php foreach ($list as $key => $value): ?>
    <li><a href="javascript:;" aid="<?= $value['article_id'] ?>"><?= $value['article_title'] ?></a></li>
<?php endforeach; ?>