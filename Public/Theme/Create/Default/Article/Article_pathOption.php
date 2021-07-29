<?php foreach ($result as $key => $value): ?>
    <?php if($value['article_node'] == 1): ?>
        <option value="<?= $value['article_id'] ?>" <?= self::$selectedID == $value['article_id'] ? 'selected="selected"' : '' ?> ><?= $space ?><?= $value['article_parent'] == 0 ? '' :'└─' ?><?= $value['article_title'] ?></option>
        <?php self::article($value['article_doc_id'], $value['article_version'], $value['article_id'], $template, $space.'&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
    <?php endif; ?>
<?php endforeach; ?>