<ul>
    <?php foreach ($result as $key => $value): ?>
        <li class="<?= $value['article_parent'] != 0 ? 'sidebar-hide' : '' ?> <?= $value['article_mark'] == $_GET['aid'] ? 'am-active' : '' ?>">
            <?php if(in_array($value['article_node'], ['0', '2'])): ?>
                <a href="<?= $value['article_node'] == 2 ? $value['article_external_link'] : self::url('Doc-Article-index', ['id' => $value['article_doc_id'], 'aid' => $value['article_mark']]) ?>" <?= $value['article_node'] == 2 ? 'target="_blank"' : '' ?> ><?= $value['article_title'] ?> <?= $value['article_node'] == 2 ? '<i class="am-icon-external-link"></i>' : '' ?></a>

            <?php else: ?>
                <span><i class="am-icon-caret-right"></i> <?= $value['article_title'] ?></span>

                <?php self::article($value['article_doc_id'], $value['article_version'], $value['article_id']); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
