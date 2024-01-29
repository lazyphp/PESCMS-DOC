<div class="home-doc-list">
    <?php foreach ($attr as $key => $item): ?>
        <div class="hom-doc-piece">
            <strong>
                <?= $item['attr_name'] ?? '默认文档'; ?>
            </strong>
            <?php if (!empty($list[$item['attr_id']])): ?>

                <ul>
                    <?php foreach ($list[$item['attr_id']] as $value): ?>
                        <li>
                            <a href="<?= $label->url('Doc-Article-index', ['id' => $value['doc_id']]) ?>">
                                <img src="<?= $value['doc_cover'] ?>" style="width: 20px">
                                <?= $value['doc_title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>