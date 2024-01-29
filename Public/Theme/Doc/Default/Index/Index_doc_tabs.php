<?php if (!empty($attr)): ?>
    <div class="home-doc-tabs">
        <div class="am-tabs" data-am-tabs="{noSwipe: 1}">
            <ul class="am-tabs-nav am-nav">
                <?php foreach ($attr as $key => $item): ?>
                    <li class="<?= $key == 0 ? 'am-active' : '' ?>"><a
                                href="#tab_<?= $item['attr_id'] ?>"><?= $item['attr_name'] ?? '默认文档'; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="am-tabs-bd">
                <?php foreach ($attr as $key => $item): ?>

                    <div class="am-tab-panel am-fade <?= $key == 0 ? 'am-in am-active' : '' ?>"
                         id="tab_<?= $item['attr_id'] ?>">
                        <ul class="am-gallery am-gallery-bordered ">
                            <?php if (!empty($list[$item['attr_id']])): ?>
                                <?php foreach ($list[$item['attr_id']] as $value): ?>
                                    <li>
                                        <a href="<?= $label->url('Doc-Article-index', ['id' => $value['doc_id']]) ?>">
                                            <img src="<?= $value['doc_cover'] ?>">
                                        </a>
                                        <a href="<?= $label->url('Doc-Article-index', ['id' => $value['doc_id']]) ?>"><?= $value['doc_title'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
<?php endif; ?>