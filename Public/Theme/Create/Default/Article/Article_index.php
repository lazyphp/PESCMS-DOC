<div class="pes-article-left-sidebar">
    <div class="am-text-center am-margin-top">
        <a href="javascript:;" data-id="new" class="am-btn am-btn-default pes-add-article"><i class="am-icon-plus"></i> 新文档</a>
        <a href="<?= $label->url('Create-Article-index', ['id' => $doc['doc_id']]) ?>" class="am-btn am-btn-default"><i class="am-icon-home"></i> 文档首页</a>
    </div>
    <hr/>
    <div class="pes-doc-path-container">
        <?= $path ?>
    </div>

</div>
<div class="pes-article-paper" >
    <div class="pes-article-tips am-alert am-margin-bottom-0 am-hide"></div>
    <h1><i class="am-icon-edit"></i> <?= $doc['doc_title'] ?> - 文档首页</h1>
    <form action="<?= empty($_GET['aid']) ? $label->url('Create-Article-doc') : '' ?>" id="pes-article-submit" class="am-form" method="post" data-am-validator>
        <?= $label->token() ?>
        <input type="hidden" name="id" value="<?= $doc['doc_id'] ?>">
        <div class="pes-form-wrapper">
            <?php if (empty($_GET['aid'])): ?>
                <?php require_once __DIR__ . '/Article_doc.php' ?>
            <?php else: ?>
                <?php require_once __DIR__ . '/Article_write.php' ?>
            <?php endif; ?>
        </div>
        <a href="javascript:;" class="pes-article-save am-btn am-btn-default"><i class="am-icon-save"></i> 保存 <small class="am-text-secondary">[Ctrl + 回车]</small></a>
    </form>
</div>
<div class="pes-article-right-sidebar am-text-center">
    <?php require_once __DIR__.'/Article_index_right.php'?>
</div>

<?php require_once __DIR__.'/Article_indexjs.php'?>