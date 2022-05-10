<ul class="pes-doc-path">
    <?php foreach ($result as $key => $value): ?>
        <li class="<?= ($value['article_node'] == 1 && $value['article_parent'] != 0) || ($value['article_node'] == 0 && $value['article_parent'] != 0) ? 'sidebar-hide' : '' ?>">

            <a href="javascript:;" data-link="<?= $label->url('Create-Article-index', ['id' => $value['article_doc_id'], 'aid' => $value['article_id'], 'back_url' => $label->xss($_GET['back_url'] ?? '')]) ?>" class="<?= $value['article_node'] == 1 ? 'pes-doc-path-node' : ($value['article_node'] == 2 ? 'am-link-danger' : '') ?>" data-id="<?= $value['article_id'] ?>">

                <?= $value['article_node'] == 1 ? '<i class="am-icon-caret-down"></i> ' : '<i class="am-icon-copy pes-article-copy-link" link="'.( $value['article_node'] == 2 ? $value['article_external_link'] : $label->url('Doc-Article-index', ['id' => $value['article_doc_id'], 'aid' => $value['article_mark']]) ).'" title="复制文档链接"></i>' ?>
                <?= $value['article_title'] ?> <sup class="am-text-warning" title="文档的权重值">[<?= $value['article_listsort'] ?>]</sup>
            </a>

            <?php if($value['article_node'] == 1): ?>
                <?php self::article($value['article_doc_id'], $value['article_version'], $value['article_id']); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>