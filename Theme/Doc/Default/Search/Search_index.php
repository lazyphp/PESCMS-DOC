<div class="tm-content am-margin">
    <div class="am-g">
        <div class="am-u-sm-11 am-u-lg-centered">
            <h3><font color="#0BB54B" class="am-padding-right-xs"><?= htmlentities($_GET['keyword']); ?></font>的搜索结果:</h3>
            <ul class="am-list am-list-static">
                <?php foreach ($list as $key => $value): ?>
                    <li><a href="<?= $label->url("Doc-Index-view", ['tree' => $value['tree_parent'], 'id' => $value['doc_id']]); ?>" class="am-padding-0" target="_blank"><?= $value['doc_title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="am-pagination am-pagination-right am-text-sm">
                <?= $page; ?>
            </ul>
        </div>
    </div>

</div>